<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "0";
}
else{
$dt=date('Y-m-d H:i:s');
include("config.php");
$reqid=$_GET['reqid'];
$rem=str_replace("'","\'",$_GET['rem']);
$amt=$_GET['amt'];
mysqli_query($con,"BEGIN");
$qry=mysqli_query($con,"INSERT INTO `oldebreq` ( `reqid`, `remark`,`status`,`entrydt`,`updtby`,`amt`) VALUES ( '".$reqid."','".$rem."','5','".$dt."','".$_SESSION['user']."','".$amt."')");
$qry1=mysqli_query($con,"update `ebillfundrequests` set iFund='1' , iFund_status='5' where req_no='".$reqid."'");
if($qry)
{
	mysqli_query($con,"COMMIT");
	echo "1";
}
else
{
	mysqli_query($con,"ROLLBACK");
	echo "2";
}
}
?>