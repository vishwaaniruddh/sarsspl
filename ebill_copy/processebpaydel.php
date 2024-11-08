<?php session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
include('config.php');
$error=0;

$reqid=$_POST['reqid'];


mysqli_query($con,'BEGIN');

$delqr=mysqli_query($con,"delete from ebpayment where Bill_No='".$reqid."'");
if(!$delqr)
{
$error++;
}

$updqr=mysqli_query($con,"update ebillfundrequests set print='n',pstat='0' where req_no='".$reqid."'");
if(!$updqr)
{
$error++;
}

if($error==0)
{
mysqli_query($con,'COMMIT');
echo "Updated";
}
else
{
mysqli_query($con,'ROLLBACK');
echo "Error";
}




}
?>