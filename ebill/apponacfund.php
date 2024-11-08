<?php
include('access.php');
include('config.php');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$dt=date('Y-m-d H:i:s');
if(isset($_GET['chk']))
$qr=" ,cheqno='".$_GET['chk']."'";
else
$qr='';
$amt=$_GET['amt'];
//echo "Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";
if(isset($amt) && $amt>0)
{
	//echo "Update onacctransfer set reqstatus='".$stat."',approvedamt='".$amt."' ".$qr." where reqid='".$reqid."'";
	$qry=mysqli_query($con,"Update onacctransfer set reqstatus='".$stat."',approvedamt='".$amt."' ".$qr." where reqid='".$reqid."'");
}
else
$qry=mysqli_query($con,"Update onacctransfer set reqstatus='".$stat."' where reqid='".$reqid."'");


if(!$qry)
echo mysqli_error();
$ins=mysqli_query($con,"INSERT INTO `onacctransferapp` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."')");
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{
echo "1";
}
else
echo "0";
?>