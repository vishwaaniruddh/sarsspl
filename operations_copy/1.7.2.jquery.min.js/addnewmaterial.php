<?php
session_start();
if(!isset($_SESSION['user']))
echo "10";
else{
include("config.php");
$id=$_GET['id'];
$rt=$_GET['rt'];
$mat=$_GET['mat'];
$qu=$_GET['qu'];
$un=$_GET['un'];
$asst=$_GET['asst'];
$now=$_GET['now'];
$alertdt=date('Y-m-d');

$qr=mysqli_query($con,"INSERT INTO `quot_details` (`quotdetid`, `quotid`, `material`, `qty`, `unit`, `rate`, `status`,`component`,`suprate`,`now`) VALUES (NULL, '".$id."', '".$mat."', '".$qu."', '".$un."', '".$rt."', '0','".$asst."','".$_GET['suprt']."','".$now."')");
$maxid=mysqli_query($con,"select max(quotdetid) from quot_details where quotid='".$id."'");
$max=mysqli_fetch_row($maxid);
if($qr)
{
$log=mysqli_query($con,"Select srno from login where username='".$_SESSION['user']."'");
$logro=mysqli_fetch_row($log);
//echo "select `cust_id`, `atm_id`, `bank_name`,`area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `createdby`, `state1`,quotdetid,cldocno from alert where quotdetid ='".$id."'";


$alt=mysqli_query($con,"select `cust_id`, `atm_id`, `bank_name`,`area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `createdby`, `state1`,quotdetid,cldocno from alert where quotdetid ='".$id."'");
$alertro=mysqli_fetch_row($alt);
if(!$alertro)
echo mysqli_error();
//echo "select * from alert where mattype='".$now."_".$asst."' and quotdetid='".$id."'";
$alertt=mysqli_query($con,"select * from alert where mattype='".$now."_".$asst."' and quotdetid='".$id."'");
if(mysqli_num_rows($alertt)>0)
{
$getal=mysqli_fetch_row($alertt);
$al=mysqli_query($con,"Update alert set problem='".$getal[9].",".$mat."' where alert_id='".$getal[0]."'");
}
else{
$doct=mysqli_query($con,"select count(alert_id) from alert where alert_date='".$alertdt."'");
$doctro=mysqli_fetch_row($doct);
$docketno='';
if(mysqli_num_rows($doct)=='0')
$docketno=$logro[0]."_".date('dmY')."1";
else
$docketno=$logro[0]."_".date('dmY')."".($doctro[0]+1);

$al="INSERT INTO `alert` (`alert_id`, `cust_id`, `atm_id`, `bank_name`,`area`, `address`, `city`, `state`, `pincode`, `problem`, `entry_date`, `alert_date`, `caller_name`, `caller_phone`, `caller_email`, `status`, `call_status`, `alert_type`, `close_date`, `createdby`, `state1`,quotdetid,cldocno,matype) VALUES (NULL, '".$alertro[0]."','".$alertro[1]."', '".$alertro[2]."','".$alertro[3]."', '".$alertro[4]."', '".$alertro[5]."', '".$alertro[6]."', '".$alertro[7]."', '".$mat."', '".date('Y-m-d H:i:s')."', '".$alertdt."','".$alertro[11]."', '".$alertro[12]."', '".$alertro[13]."', '1', '1', '".$alertro[16]."', '0000-00-00 00:00:00','".$docketno."','".$alertro[19]."','".$max[0]."','".$now."_".$asst."')";
}
//echo $al;
$alert=mysqli_query($con,$al);
$val=$rt*$qu;
$up=mysqli_query($con,"update quotation set totalcost=totalcost+".$val.",materialcnt=materialcnt+1 where quotid='".$id."'");
echo "1";
}
else
echo "0";
}
?>