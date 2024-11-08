<?php
session_start();
if(!$_SESSION['user'])
header('location:index.php');
include("config.php");
$status=0;
if(isset($_POST['cmdsub']))
{
//echo "hi";
$stat='n';
/*if($_POST['cust']=='FSS04' && $_POST['bank']=='ICICI' && $_POST['amount']>'10000')
	$stat='w';
	elseif($_POST['cust']=='FSS04' && $_POST['bank']!='ICICI' && $_POST['amount']>'8000')
	$stat='w';
	else
	$stat='n';*/
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

$errors=0;
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
			$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id``amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
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
		$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id``amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
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
	$qry=mysqli_query($con,"INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `bill_date`, `unit`, `amount`, `status`, `start_date`, `end_date`, `supervisor`, `due_date`, `opening_reading`, `closing_reading`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`extrachrg`,pstat,billfrom,paytype,`recon_chrg`,`discon_chrg`,`sd`,`after_duedt_chrg`,`bill_amt`,`afdt_amt`,`trans_id`,`amt_paid_supervisor`) VALUES (NULL, '".$_POST['atmid']."', STR_TO_DATE('".$_POST['bill_date']."','%d/%m/%Y'), '".$_POST['unit']."', '".$_POST['amount']."', '".$_POST['status']."', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'), STR_TO_DATE('".$_POST['todt']."','%d/%m/%Y'), '".$_POST['sv']."',STR_TO_DATE('".$_POST['duedt']."','%d/%m/%Y'), '".$_POST['openr']."', '".$_POST['closer']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','8','".$_POST['memo']."','".$stat."','Normal', '".$_POST['extra']."','1', STR_TO_DATE('".$_POST['fromdt']."','%d/%m/%Y'),'".$_POST['ptp']."','".$_POST['recon_chrg']."','".$_POST['discon_chrg']."','".$_POST['sd']."','".$_POST['after_duedt_chrg']."','".$_POST['bamt']."','".$_POST['adtamt']."','".$_POST['trsid']."','".$_POST['amtsup']."')");
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


	//email attachment
	if($_FILES['email_cpy']['name']!='')
	{
		//echo "INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')";
		$scan=mysqli_query($con,"INSERT INTO `ebillemailcpy` (`reqid`, `copy`, `status`) VALUES ('".$idr[0]."', '".$image_name."', '0')");
	}
}
if($qry )
$status="Entry Made Successfully and your docket no is ".$idr[0];
else
$status.="Some Error Occurred";
}//end of $errors==0
}//end of else mysqli_num_rows($ebchk2)>0
}
}
}
else
	echo "error in submition";

//echo $status;

$_SESSION['success']=$status;
if($_POST['podnumber']!="")
{
header('location:newbillentry2.php?podn='.$_POST['podnumber']);
}
else
{
header('location:newbillentry2.php');
}

?>