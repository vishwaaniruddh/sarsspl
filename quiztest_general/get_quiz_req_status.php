<?php
session_start();
include 'config.php';
$reqid=$_POST["reqid"];

if($_POST["sts"]=="1")
{
$qr=mysqli_query($con,"select * from quiz_requests where  id='".$reqid."'");
$frt=mysqli_fetch_array($qr);
$sts=$frt["status"];
}

if($_POST["sts"]=="2")
{
$qr=mysqli_query($con,"select * from quiz_requests where  id='".$reqid."'");
$frt=mysqli_fetch_array($qr);
$sts=$frt["player2_avail"];

}


if($_POST["sts"]=="3")
{
$qr=mysqli_query($con,"select * from quiz_requests where  id='".$reqid."'");
$frt=mysqli_fetch_array($qr);
echo mysqli_error($con);
$sts=$frt["test_id"];
if($sts>0)
{

$_SESSION['test_id']=$sts;



$uprt=mysqli_query($con,"update quiz_requests set player2_avail=1 where id='".$reqid."'");
}
}
echo $sts;

?>