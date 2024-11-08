<?php
include('access.php');
include('config.php');
$cdate=date('Y-m-d H:i:s');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$detid=mysqli_query($con,"select quotdetid from quot_details where quotdetid='".$reqid."'");
if($stat=='0')
{
$upal=mysqli_query($con,"update alert set call_status=0,status=0 where quotdetid in (select quotdetid from quot_details where quotid='".$reqid."')");
}
$qry=mysqli_query($con,"Update quotation set status='".$stat."' where quotid='".$reqid."'");
$ins=mysqli_query($con,"INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$cdate."', '".$rem."', '".$stat."')");
//$brfeed=mysqli_query($con,"insert into alert_updates()");
//INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`, `status`) VALUES (NULL, '', '', CURRENT_TIMESTAMP, '', NULL, '0')
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{
echo "1";
}
else
echo "0";
?>