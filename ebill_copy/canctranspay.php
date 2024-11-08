<?php
session_start();
if(!isset($_SESSION['user']))
echo "0";
else
{
$dt=date('Y-m-d H:i:s');
include('config.php');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$qry=mysqli_query($con,"INSERT INTO `ebfundtranscanc` (`id`, `alert_id`, `rem`, `upby`,`entrydt`, `status`) VALUES (NULL, '".$reqid."', '".$rem."', '".$_SESSION['user']."','".$dt."', '0')");
if($qry)
{
$up=mysqli_query($con,"INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."')");
echo "1";
}
else
{
echo "Some Error Occurred".mysqli_error();
}
}
?>