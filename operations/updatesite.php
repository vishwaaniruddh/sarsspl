<?php 
session_start();
include("config.php");

try{	 $id = $_POST['id'];
 $cid1 = $_POST['cid1'];
  $bid = $_POST['bid'];
        $cid = $_POST['cid'];
        $cname = $_POST['cname'];
        $mname = $_POST['mname'];
        $mcont= $_POST['mcont'];
       $houserate= $_POST['houserate'];
       //echo $houserate;
        if(isset($_POST['services2']))
        $sers2='Y';
        else
        $sers2='N';
         if(isset($_POST['services3']))
        $sers3='Y';
        else
        $sers3='N';
         if(isset($_POST['services32']))
        $sers32='Y';
        else
        $sers32='N';
       
        $caretakrate= $_POST['caretakrate'];
        $maintenancerate = $_POST['maintenancerate'];
        $bank = $_POST['bank'];
        $csslocal= $_POST['csslocal'];
        $zone = $_POST['zone'];
        $state = $_POST['state'];
        $regn = $_POST['regn'];
	$sid = $_POST['sid'];
	$atmid1 = $_POST['atmid1'];
	$atmid2 = $_POST['atmid2'];
	$atmid3 = $_POST['atmid3'];
	$dummy = $_POST['dummy'];
	$siteold = $_POST['siteold'];
	$sitenew = $_POST['sitenew'];
	$rsn = $_POST['rsn'];
	$city = $_POST['city'];
	$loctn = $_POST['loctn'];
	$address = $_POST['atmadd'];
	$sitetype = $_POST['sitetype'];
	$citycat = $_POST['citycat'];
	$takeover1 = $_POST['takeover1'];
	$hdate = $_POST['hdate'];
	$hsuper= $_POST['hsuper'];
	$hsupno = $_POST['hsupno'];
	$caretakerid1 = $_POST['caretakerid1'];
	$cdate1 = $_POST['cdate1'];
	$carename1 = $_POST['carename1'];
	$caresalary1 = $_POST['caresalary1'];
	$careacno1 = $_POST['careacno1'];
	$careid2 = $_POST['careid2'];
	$cdate2 = $_POST['cdate2'];
	$carename2 = $_POST['carename2'];
	$caresalary2 = $_POST['caresalary2'];
	$careacno2 = $_POST['careacno2'];
	$careid3= $_POST['careid3'];
        $cdate3 = $_POST['cdate3'];
	$carename3 = $_POST['carename3'];
	$caresalary3 = $_POST['caresalary3'];
	$careacno3 = $_POST['careacno3'];
	$cust_remarks = $_POST['cust_remarks'];
	$css_remarks = $_POST['css_remarks'];
	$cssac_remarks = $_POST['cssac_remarks'];
	
	if(isset($_POST['active']))
        $active='Y';
        else
        $active='N';
	
		//$sdate = DateTime::createFromFormat('d/m/Y', '3/2/2010');
		//echo $cid." ".$sid." ".$address." ".$bank." ".$supervisor." ".$desc." ".$sdate;
		
		$sql = "update `".$cid1."_sites` set `acmanager`='".$mname."',`acmanagerphone`='".$mcont."',`housekeeping`='".$sers2."',`housekeeping_rate`='".$houserate."',`caretaker`='".$sers3."',`caretaker_rate`='".$caretakrate."',`maintenance`='".$sers32."',`maintenance_rate`='".$maintenancerate."',`bank`='".$bank."',`csslocalbranch`='".$csslocal."',`zone`='".$zone."',`state`='".$state."',`region`='".$regn."',`site_id`='".$sid."',`atm_id2`='".$atmid2."',`atm_id3`='".$atmid3."',`dummyatm_id`='".$dummy."',`siteoldmdn_no`='".$siteold."',`sitenewmdn_no`='".$sitenew."',`mdnrsn_no`='".$rsn."',`city`='".$city."',`location`='".$loctn."',`atmsite_address`='".$address."',`site_type`='".$sitetype."',`city_category`='".$citycat."',`takeover_date`=STR_TO_DATE('".$takeover1."','%d/%m/%Y'),`handover_date`=STR_TO_DATE('".$hdate."','%d/%m/%Y'),`hsupervisor_name`='".$hsuper."',`super_contact`='".$hsupno."',`caretakersalary1`='".$caresalary1."',`caretakersalary2`='".$caresalary2."',`caretakersalary3`='".$caresalary3."',`caretaker_id1`='".$caretakerid1."',`caretaker_doj1`=STR_TO_DATE('".$cdate1."','%d/%m/%Y'),`caretaker_name1`='".$carename1."',`caretaker_acc1`='".$careacno1."',`caretaker_id2`='".$careid2."',`caretaker_doj2`=STR_TO_DATE('".$cdate2."','%d/%m/%Y'),`caretaker_name2`='".$carename2."',`caretaker_acc2`='".$careacno2."',`caretaker_id3`='".$careid3."',`caretaker_doj3`=STR_TO_DATE('".$cdate3."','%d/%m/%Y'),`caretaker_name3`='".$carename3."',`caretaker_acc3`='".$careacno3."',`cust_remarks`='".$cust_remarks."',`cssbilling_remark`='".$css_remarks."',`cssacremarks`='".$cssac_remarks."',`active`='".$active."',`projectid`='".$_POST['project']."',atm_id1='".$atmid1."',subcat='".$_POST['subcat']."',maintenance_tkdt=STR_TO_DATE('".$_POST['maintkdt']."','%d/%m/%Y'),maintenance_hodt=STR_TO_DATE('".$_POST['mainhodt']."','%d/%m/%Y'),housekeeping_tkdt=STR_TO_DATE('".$_POST['housetkdt']."','%d/%m/%Y'),housekeeping_hodt=STR_TO_DATE('".$_POST['househodt']."','%d/%m/%Y')  where `trackerid`='".$_POST['trackid']."'";
		
		$u=mysqli_query($con,"Update ".$cid1."_ebill set ATM_ID='".$atmid1."' where  atmtrackid='".$_POST['trackid']."'");
		//echo $sql;
		 if(isset($_POST['services4'])){$res=mysqli_query($con,"select * from ".$cid1."_ebill where atmtrackid='".$_POST['trackid']."'");
		                                if(mysqli_num_rows($res)>0)
										{
										//mysqli_query($con,"insert into ".$cid1."_ebill(ATM_ID) values('$atmid1')");
										//echo "update ".$cid1."_sites set ebill='Y' where atm_id1='$atmid1'";
		                                mysqli_query($con,"update ".$cid1."_sites set ebill='Y' where `trackerid`='".$_POST['trackid']."'");
										}
		                                else
										{
										//echo "update ".$cid1."_sites set ebill='Y' where atm_id1='$atmid1'";
										//echo "insert into ".$cid1."_ebill(ATM_ID) values('$atmid1')";
										 mysqli_query($con,"update ".$cid1."_sites set ebill='Y' where `trackerid`='".$_POST['trackid']."'");
		                                mysqli_query($con,"insert into ".$cid1."_ebill(ATM_ID,atmtrackid) values('$atmid1','".$_POST['trackid']."')");
		                               
		                               mysqli_query($con,"insert into mastersites(atm_id1,cust_id,trackerid) values('$atmid1','".$cid1."','".$_POST['trackid']."')"); 
										}
		                               }
        else {mysqli_query($con,"update ".$cid1."_sites set ebill='N' where atm_id1='$atmid1'");}

		$result = mysqli_query($con,$sql);
		if($result)
		{	
		 mysqli_query($con,"commit");
		// header('Location:managesite.php?id='.$id.'&cid='.$cid1.'&bid='.$bid);
		header('Location:managesite.php?cid='.$cid1);
		}
		else
		echo "error updating data".mysqli_error();
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>