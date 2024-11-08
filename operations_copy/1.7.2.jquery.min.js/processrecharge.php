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
$sta='3';
if($_SESSION['designation']=='11')
$sta='2';
$dt=date('Y-m-d H:i:s');
$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
$srno=mysqli_fetch_row($sr);
$str="INSERT INTO `ebillfundrequests` (`req_no`, `atmid`, `amount`, `status`, `supervisor`, `entrydate`, `cust_id`, `reqby`, `trackerid`,`reqstatus`,`memo`,`print`,`priority`,`pstat`,`type`) VALUES (NULL, '".$_POST['atmid']."', '".$_POST['amount']."', '".$_POST['status']."', '".$_POST['sv']."', '".$dt."', '".$_POST['cust']."', '".$srno[0]."', '".$_POST['trackid']."','".$sta."','".$_POST['memo']."','".$stat."','".$_POST['cases']."','1','recharge')";
//echo $str;
$qry=mysqli_query($con,$str);
$id=mysqli_insert_id();
if($qry)
$status="Entry Made Successfully and your docket no is ".$id;
else
$status="Some Error Occurred".mysqli_error();

}


$_SESSION['success']=$status;
header('location:rechargereq.php');

?>TFFS0053