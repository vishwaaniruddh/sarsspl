<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
include("config.php");
$status=0;

$errors=0;

// mysqli_query($con,"BEGIN");
mysqli_autocommit($con,FALSE);

if(isset($_POST['cmdsub']))
{
//echo "hi";
$stat='n';
$companyid = '1' ; 

/*if($_POST['cust']=='FSS04' && $_POST['bank']=='ICICI' && $_POST['amount']>'10000')
	$stat='w';
	elseif($_POST['cust']=='FSS04' && $_POST['bank']!='ICICI' && $_POST['amount']>'8000')
	$stat='w';
	else
	$stat='n';*/
	$state = $_POST['state'];
$frmdt=str_replace('/','-',$_POST['fromdt']);
$billdt=str_replace('/','-',$_POST['bill_date']);
$todt=str_replace('/','-',$_POST['todt']);
$duedt=str_replace('/','-',$_POST['duedt']);
$paiddt=str_replace('/','-',$_POST['paiddt']);

 $frmdt2=date('Y-m-d',strtotime($frmdt));
//echo $frmdt2."<br>";
$billdt2=date('Y-m-d',strtotime($billdt));// echo $billdt2."<br>";
 $todt2=date('Y-m-d',strtotime($todt)); //echo $todt2."<br>";
 $duedt2=date('Y-m-d',strtotime($duedt));// echo $duedt2."<br>";
 $paiddt2=date('Y-m-d',strtotime($paiddt)); //echo $paiddt2."<br>";
 if($frmdt2>=$todt2 || $todt2>$billdt2 || $billdt2>$duedt2)
 {
 $status="Invalid Dates";
 }
 else{
$ebchkstr="select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$_POST['cust']."' and atmid='".$_POST['atmid']."' and trackerid='".$_POST['trackid']."' and (due_date like '".$duedt2."%' OR start_date like '".$frmdt2."%' or end_date like '".$todt2."%' or bill_date like '".$billdt2."%' ) and req_no not in (select reqid from ebfundtranscanc where status=0)";
$ebchk=mysqli_query($con,$ebchkstr);
//echo $ebchkstr;
//$x=mysqli_num_rows($ebchk);
//echo $x."<br>";
if(mysqli_num_rows($ebchk)>0)
$status="It seems entry for this month is already made";
else
{
$ebchk2=mysqli_query($con,"select * from ebillfundrequests where reqstatus<>'0'  and req_no not in (select reqid from ebfundtranscanc where status=0) and cust_id='".$_POST['cust']."' and atmid='".$_POST['atmid']."' and trackerid='".$_POST['trackid']."' and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."')  )");
//echo "select * from ebillfundrequests where reqstatus<>'0' and cust_id='".$_POST['cust']."' and atmid='".$_POST['atmid']."' and trackerid='".$_POST['trackid']."' and ((start_date<'".$frmdt2."' and end_date>'".$frmdt2."') or (start_date<'".$todt2."' and end_date>'".$todt2."'))";
//$x=mysqli_num_rows($ebchk2);
//echo $x."<br>";
if(mysqli_num_rows($ebchk2)>0)
{
$status="It seems entry for this month is already made";
}
else{

$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']['name']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{
$status="Your file size is ".$size;
$status.="<br/>File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['email_cpy']['name']; 

//echo $fichier;
 function getExtension1($str)
 {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
 }
	
	//echo $fichier;
if($fichier){
//echo "hi" ;
$filename = stripslashes($_FILES['email_cpy']['name']);
//echo $filename;
			//get the extension of the file in a lower case format
				$extension = getExtension1($filename);
				$extension = strtolower($extension);
				//echo $extension;
				$image_name=time().'.'.$extension;
				//echo $image_name;
$newname="../operations/ebemailcpy/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	$status="<h1>Copy unsuccessfull!</h1>";
		$errors=1;
}
}

//echo $newname;

}
}
//echo $errors;
if($errors==0)
{
//echo "select projectid,bank from ".$_POST['cust']."_sites where trackerid like '".$_POST['trackid']."'";
$pro_qry=mysqli_query($con,"select projectid,bank from ".$_POST['cust']."_sites where trackerid like '".$_POST['trackid']."'");
$pro=mysqli_fetch_array($pro_qry);
//echo "<br/>SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$_POST['cust']."' AND `project_id` LIKE '".$pro[0]."' AND `bank` LIKE '".$pro[1]."'";
$threshhold_qry=mysqli_query($con,"SELECT threshhold FROM `threshhold` WHERE `cust_id` LIKE '".$_POST['cust']."' AND `project_id` LIKE '".$pro[0]."' AND `bank` LIKE '".$pro[1]."'");

if(mysqli_num_rows($threshhold_qry)>0)
{
	$threshhold=mysqli_fetch_array($threshhold_qry);
	$threshhold_val=intval($threshhold[0]);
	
	$nod1=floor((strtotime($todt2)-strtotime($frmdt2)) / 86400);
	$chck_amt=intval($_POST['amount']*30.0/$nod1,2);
	if($chck_amt>$threshhold_val)
	{
		//email attachment
		if($_FILES['email_cpy']['name']!='')
		{


			$dt=date('Y-m-d H:i:s');
			$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($sr);
			//$qry=mysqli_query($con,"INSERT INTO `ebdetails` (`bill_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `print`, `due_date`, `opening_reading`, `closing_reading`, `extracharge`, `entrydt`, `cust_id`, `ebid`, `trackerid`,`supervisor`,`upby`,`paiddt`,`paidamt`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$stat."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$_POST['extra']."', Now(), '".$_POST['cust']."', '0', '".$_POST['trackid']."','".$_POST['sv']."','".$srno[0]."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$_POST['amount']."')");
			
			//echo "INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','".$_POST['cases']."', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."')";
			
$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id`,`amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
			if(!$qry)
			echo mysqli_error();
			//$id=mysqli_insert_id();
			$id=mysqli_query($con,"select max(req_no) from `ebillfundrequests`");
			$idr=mysqli_fetch_row($id);
			$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status`) VALUES ('".$idr[0]."', '".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$dt."','".$_SESSION['user']."','".$_POST['ptype']."')");	
			//echo "INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')";
			$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')");
		}
		else
		{
			$status="<h2>Above threshold value email attachment is compulsory.</h2>";
		}
	}
	else
	{
		$dt=date('Y-m-d H:i:s');
		$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
		$srno=mysqli_fetch_row($sr);
		//$qry=mysqli_query($con,"INSERT INTO `ebdetails` (`bill_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `print`, `due_date`, `opening_reading`, `closing_reading`, `extracharge`, `entrydt`, `cust_id`, `ebid`, `trackerid`,`supervisor`,`upby`,`paiddt`,`paidamt`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$stat."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$_POST['extra']."', Now(), '".$_POST['cust']."', '0', '".$_POST['trackid']."','".$_POST['sv']."','".$srno[0]."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$_POST['amount']."')");
		
		//echo "INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','".$_POST['cases']."', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."')";

		$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id`,`amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','y','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
		if(!$qry)
		echo mysqli_error();
		//$id=mysqli_insert_id();
		$id=mysqli_query($con,"select max(req_no) from `ebillfundrequests`");
		$idr=mysqli_fetch_row($id);
		$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status`) VALUES ('".$idr[0]."', '".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$dt."','".$_SESSION['user']."','".$_POST['ptype']."')");	



                   

		//email attachment
		if($_FILES['email_cpy']['name']!='')
		{
			//echo "INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')";
			$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')");
		}
	}
}//end of if(mysqli_num_rows($threshhold_qry)>0)
else
{

	$dt=date('Y-m-d H:i:s');
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	//$qry=mysqli_query($con,"INSERT INTO `ebdetails` (`bill_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `print`, `due_date`, `opening_reading`, `closing_reading`, `extracharge`, `entrydt`, `cust_id`, `ebid`, `trackerid`,`supervisor`,`upby`,`paiddt`,`paidamt`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$stat."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$_POST['extra']."', Now(), '".$_POST['cust']."', '0', '".$_POST['trackid']."','".$_POST['sv']."','".$srno[0]."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$_POST['amount']."')");
	
	//echo "INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','".$_POST['cases']."', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."')";
	$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id`,`amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".y."','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
	if(!$qry)
	echo mysqli_error();
	//$id=mysqli_insert_id();
	$id=mysqli_query($con,"select max(req_no) from `ebillfundrequests`");
	$idr=mysqli_fetch_row($id);
	$qr=mysqli_query($con,"INSERT INTO `ebpayment` (`Bill_No`, `Paid_Amount`, `Paid_Date`,`entrydt`,`upby`,`status`) VALUES ('".$idr[0]."', '".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$dt."','".$_SESSION['user']."','".$_POST['ptype']."')");
/*
if($_POST['pidnumber']!="")
{ 
    $sqlq=mysqli_query($con,"update ebill_package set status='1' where pid='".$_POST['pidnumber']."'");

}*/

$invd='';
$totcnt='0';
if($_POST['cust']=='Tata05')
{
$totcnt='10';
}
elseif($_POST['cust']=='AGS01')
{
$totcnt='80';
}

elseif($_POST['cust']=='HITACHI07')
{
$totcnt='15';
}
elseif($_POST['cust']=='EPS')
{
$totcnt='20';
}
elseif($_POST['cust']=='DIE002')
{
$totcnt='200';
}
elseif($_POST['cust']=='FIS03')
{
$totcnt='100';
}
else
{
$totcnt='50';
}



if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); }else{ $invd=date('y',strtotime('-1 year'))."-".date('y'); }
$sql5ss="";
if($_POST['cust']=='AGS01')
{


if($_POST['projectid']=='PSU')
{
    // $sql5ss = "select max(inv_no) from send_bill" ; 
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and open='0'";

}
else
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."'  and projectid='".$_POST['projectid']."' and bank='".$_POST['bank']."' and createdby='".$_SESSION['user']."' and open='0'";

}

}
elseif($_POST['cust']=='FIS03')
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and open='0'";
}elseif($_POST['cust']=='EPS'){
    $sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state = '".$state."' and bank='".$_POST['bank']."' and open='0'";
}
else
{
$sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and state = '".$state."' and open='0'";

// $sql5ss="select max(inv_no) from send_bill where fiscalyr like '$invd' and status='0' and customer_name='".$_POST['cust']."' and bank='".$_POST['bank']."' and projectid='".$_POST['projectid']."' and createdby='".$_SESSION['user']."' and open='0'";
}

// echo $sql5ss."<br>";



$res5s = mysqli_query($con,$sql5ss);
$row5 = mysqli_fetch_array($res5s);

// var_dump($row5) ;


//echo $row5[0]."f";
$nwnorws=mysqli_num_rows($res5s);
//echo $nwnorws;
//echo $sql5ss."<br>";
//echo "select send_id from send_bill where inv_no='".$row5[0]."' and fiscalyr like '$invd'";

$totinvcnt="";
$sndid="";
$invsno="";
//echo "sid=".$row5[0]."<br>";
if($row5[0]!=NULL)
{
//echo "select send_id,invoice_no from send_bill where inv_no='".$row5[0]."' and fiscalyr like '$invd'";
$getsndid=mysqli_query($con,"select send_id,invoice_no from send_bill where inv_no='".$row5[0]."' and fiscalyr like '$invd'");
$sdnidrow=mysqli_fetch_array($getsndid);

$invsno=$sdnidrow[1];
$sndid=$sdnidrow[0];
//echo $sndid."<br>";
$getcnt=mysqli_query($con,"select detail_id from send_bill_detail where send_id='".$sdnidrow[0]."'");


$totinvcnt=mysqli_num_rows($getcnt);
}

//80,for fis only if 1-may 2017 then 80 else 50
$s2new="select * from ebillcharges where Cid='".$_POST['cust']."'";
if($_POST['cust']!='AGS01')
{
  if(($_POST['cust']!='EUR08' && $_POST['cust']!='EPS' && $_POST['cust']!='Tata05') && ($_POST['projectid']=='MOF' || $_POST['projectid']=='Mphasis')){
$s2new.=" and type='".$_POST['projectid']."'";


}
elseif($_POST['cust']=='EUR08')
$s2new.=" and type='".$_POST['ptype']."'";
elseif($_POST['cust']=='Tata05')
{
if($_POST['projectid']!='MOF')
$s2new.=" and tp='".$_POST['tata']."'";
else
$s2new.=" and type='".$_POST['projectid']."'";

}
else
$s2new.=" and type=''";
}
//echo $s2;

// echo $s2new;


// echo '<br>';
$slnew=mysqli_query($con,$s2new);

$rsnew=mysqli_fetch_row($slnew);





$seramt=$rsnew[2];
$to=$rsnew[2];
$svt=$to*0.18;
//$svt1=$to*0.005;
//$svt2=$to*0.005;
$gtotal=$svt+$to;

$gstqry=mysqli_query($con,"select gst from gst_no_os where ctype='CSS' and gst!='na' and state='".$state."'");

if(mysqli_num_rows($gstqry)>0)
{
    $cgst=$to*0.09;
    $sgst=$to*0.09;
    $igst=0;
   // echo "in1";
}
else
{
    $cgst=0;
    $sgst=0;
    $igst=$to*0.18;
//    echo "in2";
}

$totamtsnd=$_POST['amount'];
$currentdate=date('Y-m-d');
$month=date('F',strtotime($_POST['todt']));	



































// echo '<br>';

// echo $totinvcnt ; 
// echo '<br>';

// echo $totcnt ; 
// echo '<br>';

// if($row5[0]==NULL || $totinvcnt>=$totcnt)
// {
//  echo 'if';   
// }else{
//     echo 'else';
// }

// return ; 



if($row5[0]==NULL || $totinvcnt>=$totcnt)
{

$genmaxinv = "select max(inv_no) from send_bill where fiscalyr like '$invd'  and state='".$state."'";
//echo $genmaxinv."<br>";


$geninv= mysqli_query($con,$genmaxinv);
$prginv= mysqli_fetch_row($geninv);

$newinvoice_no=$prginv[0]+1;

// $invd="";

$cm="";
$new = $newinvoice_no; 

		//echo $new;










if($_POST['cust']=="FIS03")
{

if(strtotime(date("Y-m-d",strtotime($_POST['paiddt'])))<strtotime(date("Y-m-d",strtotime("2017-05-01"))))
{
    $seramt="50";    
}
else
{
    $seramt=$rsnew[2];    
}
}
else
{
$seramt=$rsnew[2];    
}
$to=$rsnew[2];

// $svt=$to*0.18;
// $svt1=$to*0.09;
// $svt2=$to*0.09;
// $gtotal=$svt+$svt1+$svt2+$to;

$totamtsnd=$_POST['amount'];
$currentdate=date('Y-m-d');
$month=date('F',strtotime($_POST['todt']));	


$genmaxinv = "select max(inv_no) from send_bill where fiscalyr like '$invd'";
//echo $genmaxinv."<br>";
$geninv= mysqli_query($con,$genmaxinv);
$prginv= mysqli_fetch_row($geninv);

$newinvoice_no=$prginv[0]+1;

$invd="";

$cm="";
$new = $newinvoice_no;
		//echo $new;
		if($newinvoice_no<=9)
		$newinvoice_no ="000".$newinvoice_no ;
		if($new>9 && $new <=99)
		$newinvoice_no = "00".$newinvoice_no ;
		if($new>99 && $new <=999)
		$newinvoice_no = "0".$newinvoice_no ;
		/*if($new>999 && $new <=9999)
		$newinvoice_no = "0".$newinvoice_no ;
		if($new>9999 && $new <=99999)
		$newinvoice_no="0".$newinvoice_no ;*/
		//echo $newinvoice_no;

$invtype='A';
	$finalinvoice='';
	$final='';
	$invdate='';

if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }

if($_POST['cust']=='Tata05')
		{
		if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
		
 
 		$final.=$cm=$cmpsel."EB";
// 		$final.=$cm="CSSEB";
	
    $final.= $newinvoice_no;
    $finalinvoice=$final."A/".$invdate;
     }
    else
    {
    if(date('m')>='4'){ $invdate=date('y')."-".date('y',strtotime('+1 year')); }else{ $invdate=date('y',strtotime('-1 year'))."-".date('y'); }
		
     
		$final.=$cm="CSSEB";
	
    $final.= $newinvoice_no;
    $finalinvoice=$final."A/".$invdate;
    
    }

$finalinvoice2= $finalinvoice;


if($_POST['cust']=='Tata05')
		{
   
    $finalinvoice=$final."B".$invdate;
    }
    else
    {
     
    $finalinvoice=$final."B/".$invdate;
     
    }
$finalinvoice3= $finalinvoice;
if(date('m')>='4'){ $invd=date('y')."-".date('y',strtotime('+1 year')); 
//echo $invd; 
}else
{ $invd=date('y',strtotime('-1 year'))."-".date('y');//echo $invd; 
 } 

$res4=mysqli_query($con,"insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,entrydt,fiscalyr,amount,servchrg,invoice2,state,sgst,cgst,igst,inv_no) values('".$_POST['cust']."','".$_POST['bank']."','$currentdate','$finalinvoice2','".$companyid."','".$_POST['projectid']."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."','".$invd."','".$totamtsnd."','".$gtotal."','".$finalinvoice3."','".$state."','".$sgst."','".$cgst."','".$igst."','".$newinvoice_no."')");

// $res4=mysqli_query($con,"insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,entrydt,fiscalyr,amount,inv_no,servchrg,invoice2) values('".$_POST['cust']."','".$_POST['bank']."','$currentdate','$finalinvoice2','1','".$_POST['projectid']."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."','".$invd."','".$totamtsnd."','".$newinvoice_no."','".$gtotal."','".$finalinvoice3."')");

//echo "insert into send_bill(customer_name,bank,date,invoice_no,comp,projectid,createdby,entrydt,fiscalyr,amount,inv_no,servchrg,invoice2) values('".$_POST['cust']."','".$_POST['bank']."','$currentdate','$finalinvoice2','1','".$_POST['projectid']."','".$_SESSION['user']."','".date('Y-m-d H:i:s')."','".$invd."','".$totamtsnd."','".$newinvoice_no."','".$gtotal."','".$finalinvoice3."')";


if(!$res4)
{
$errors++;
echo mysqli_error();
}





$sql5new = "select max(send_id) from send_bill";
$res5qr = mysqli_query($con,$sql5new );
$sdiddet= mysqli_fetch_row($res5qr );
$sndid=$sdiddet[0];
$invsno=$finalinvoice2;

//echo $sndid."<br>";
//echo $invsno;

$nsqlnew = "select * from ".$_POST['cust']."_ebill where atmtrackid='".$_POST['trackid']."'";// echo $nsql;
				
        $resultnw = mysqli_query($con,$nsqlnew);
             
		$rownws = mysqli_fetch_row($resultnw);

 $resnw=mysqli_query($con,"select atmsite_address,site_id,bank,projectid from ".$_POST['cust']."_sites where trackerid='".$_POST['trackid']."'");
                $rowsatmadd=mysqli_fetch_row($resnw); 
                $location=mysqli_real_escape_string($rowsatmadd[0]);



$sndbdetins2=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$_POST['trackid']."','".$rownws[2]."','".$location."','".$rownws[1]."',STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'),STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'),'".$_POST['unit']."',STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'),'".$month."','".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$idr[0]."','".$invd."','".$_POST['extra']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$seramt."','".$_SESSION['user']."')");

if(!$sndbdetins2)
{
$errors++;
echo mysqli_error();
}

}
else
{
$nsqlnew = "select * from ".$_POST['cust']."_ebill where atmtrackid='".$_POST['trackid']."'";// echo $nsql;
				
                $resultnw = mysqli_query($con,$nsqlnew);
             
		$rownws = mysqli_fetch_row($resultnw);

 $resnw=mysqli_query($con,"select atmsite_address,site_id,bank,projectid from ".$_POST['cust']."_sites where trackerid='".$_POST['trackid']."'");
                $rowsatmadd=mysqli_fetch_row($resnw); 
                $location=mysqli_real_escape_string($rowsatmadd[0]);



$gupdet=mysqli_query($con,"select amount,servchrg,sgst,cgst,igst from send_bill where send_id='".$sndid."'");
$gupdetrws=mysqli_fetch_array($gupdet);

$prevamt=$gupdetrws[0];
$prevserv=$gupdetrws[1];
$psgst=$gupdetrws[2];
$pcgst=$gupdetrws[3];
$pigst=$gupdetrws[4];

$nwamt=$prevamt+$totamtsnd;

$nwseramt=$prevserv+$gtotal;
$nsgst=$psgst+$sgst;
$ncgst=$pcgst+$cgst;
$nigst=$pigst+$igst;


$updqry20=mysqli_query($con,"update send_bill set amount='".$nwamt."',servchrg='".$nwseramt."',sgst='".$nsgst."',cgst='".$ncgst."',igst='".$nigst."' where send_id='".$sndid."' ");

if(!$updqry20)
{
$errors++;
echo mysqli_error();
}


$sndbdetins=mysqli_query($con,"insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date,reqid,fiscalyr, `extrachrg`, `recon_chrg`, `discon_chrg`, `sd`, `after_duedt_chrg`,srvchrg,updtby) values
('".$sndid."','".$_POST['trackid']."','".$rownws[2]."','".$location."','".$rownws[1]."',STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'),STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'),'".$_POST['unit']."',STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'),'".$month."','".$_POST['amount']."',STR_TO_DATE('".$_POST['paiddt']."','%d/%m/%Y'),'".$idr[0]."','".$invd."','".$_POST['extra']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$seramt."','".$_SESSION['user']."')");

if(!$sndbdetins)
{
$errors++;
//echo mysqli_error();

}

$chktotb=mysqli_query($con,"select detail_id from send_bill_detail where send_id='".$sndid."'");
$fchkb=mysqli_num_rows($chktotb);



if($fchkb==$totcnt)
{
$fclqry=mysqli_query($con,"update send_bill set open='1',date='".date('Y-m-d')."',entrydt='".date('Y-m-d H:i:s')."' where send_id='".$sndid."'");
if(!$fclqry)
{
$errors++;
echo mysqli_error();
}
}


//echo mysqli_error();
}

	//email attachment
	if($_FILES['email_cpy']['name']!='')
	{
		//echo "INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')";
		$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')");
	}
}
if($qry & $errors==0)
{
// mysqli_query($con,"COMMIT");
mysqli_commit($con);

$status="Entry Made Successfully and your docket no is ".$idr[0]."<br>"."Invoice No is -".$invsno;
}
else
{
// mysqli_query($con,"ROLLBACK");
mysqli_rollback($con);

$status.="Some Error Occurred";
}
}//end of $errors==0
}//end of else mysqli_num_rows($ebchk2)>0
}
}
}
else
	echo "error in submition";

//echo $status;

$_SESSION['success']=$status;
//if($_POST['podnumber']!="")
//{
header('location:newbillentry2.php?podn='.$_POST['podnumber']);
//}
//else
//{
// header('location:newbillentry2.php');
//}

?>