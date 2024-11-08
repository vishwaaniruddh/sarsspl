<?php
include('access.php');
if(!$_SESSION['user']){
echo "Sorry Your Session Has Expired. Please login Again";
}
else{
include('config.php');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$dt=date('Y-m-d H:i:s');


$amt=$_GET['amt'];
//echo "Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";
if(isset($amt) && $amt>0)
$qry=mysqli_query($con,"Update ebillfundrequests set arrearstatus='".$stat."',approvedamt='".$amt."' where req_no='".$reqid."'");
else
$qry=mysqli_query($con,"Update ebillfundrequests set arrearstatus='".$stat."' where req_no='".$reqid."'");
if(!$qry)
echo mysqli_error();
$ins=mysqli_query($con,"INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."')");
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{
echo "1";
}
else
echo "0";

}
?>