<?php
include('access.php');
include('config.php');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$qry=mysqli_query($con,"Update fundrequest set status='".$stat."' where reqid='".$reqid."'");
$ins=mysqli_query($con,"INSERT INTO `fundrequestapproval` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', Now(), '".$rem."', '".$stat."')");
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{
echo "1";
}
else
echo "0";
?>