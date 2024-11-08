<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "2";
}
else
{
include("config.php");
$reqid=$_GET['reqid'];
$up=mysqli_query($con,"update ebillfundrequests set reqstatus=8,print='n',pstat='0' where req_no='".$reqid."'");
if($up)
echo "1";
else
echo "0";
}
?>