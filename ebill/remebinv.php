<?php
session_start();
if(!isset($_SESSION['user']))
{
echo '0';
}
else
{
include("config.php");
$dt=date("Y-m-d H:i:s");
$rem=str_replace("'","\'",$_GET['rem']);
$req=$_GET['reqid'];
$ins="INSERT INTO `ebillfundcancinv` (`id`, `reqid`, `entrydt`, `updtby`, `status`) VALUES (NULL, '".$req."', '".$dt."', '".$_SESSION['user']."', '0')";
$qry=mysqli_query($con,$ins);
if($qry)
echo "1";
else
echo "2";
}
?>