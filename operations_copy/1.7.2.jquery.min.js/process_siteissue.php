<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry your session has Expired. you need to login again');window.location='index.php';</script>";
}
else
{
include("config.php");
if($_POST['now']==$_POST['now2'] && $_POST['asst']==$_POST['asst2'] && $_POST['material']==$_POST['material2'])
{
echo "<script type='text/javascript'>alert('Sorry Issue Already Exists');window.location='newatmasst.php';</script>";
}
else
{
$dt=date('Y-m-d H:i:s');
$now=str_replace("&","And",$_POST['now2']);
$prblm=str_replace("&","And",$_POST['asst2']);
$desc=str_replace("&","And",$_POST['material2']);
$ast=mysqli_query($con,"INSERT INTO `atmassets` (`problem`, `description`, `status`, `now`, `entrydt`, `upby`,`incquot`) VALUES ('".$prblm."', '".$desc."', '0', '".$now."', '".$dt."', '".$_SESSION['user']."','".$_POST['inc']."')");
if($ast)
echo "<script type='text/javascript'>alert('Entry made Successfully');window.location='newatmasst.php';</script>";
else
echo "<script type='text/javascript'>alert('Some Error Occurred');window.location='newatmasst.php';</script>";
}
}
?>