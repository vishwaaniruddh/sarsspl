<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "Session Expired, Login Again";
}
else
{
include("config.php");
$inv=explode('_',$_GET['id']);
$status=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$dt=date('Y-m-d H:i:s');
$qr=mysqli_query($con,"INSERT INTO `send_bill_dispatch` (`id`, `send_id`, `ficalyr`, `remark`, `status`, `entrydt`,`upby`) VALUES (NULL, '".$inv[0]."', '".$inv[1]."', '".$rem."', '".$status."', '".$dt."','".$_SESSION['user']."')");
if($qr)
echo "Done";
else
echo "1";
}
?>