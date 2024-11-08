<?php
/*include('access.php');
include('config.php');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$qry=mysqli_query($con,"Update quotation set status='".$stat."' where quotid='".$reqid."'");
$ins=mysqli_query($con,"INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', CURRENT_TIMESTAMP, '".$rem."', '".$stat."')");
//INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`, `status`) VALUES (NULL, '', '', CURRENT_TIMESTAMP, '', NULL, '0')
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{
echo "1";
}
else
echo "0";*/
?>
<?php
include('access.php');
include('config.php');
$cdate=date('Y-m-d H:i:s');
$reqid=$_GET['id'];
$stat=$_GET['stat'];
$rem=str_replace("'","\'",$_GET['rem']);
$str='';
if(isset($_GET['amt']))
$str=" , approvedamt='".$_GET['amt']."'";

if(isset($_GET['amt']))
$str.=" , chequeno='".$_GET['chk']."'";

//echo "Update quotation set status='".$stat."' ".$str." where quotid='".$reqid."'";
$qry=mysqli_query($con,"Update quotation set status='".$stat."' ".$str." where quotid='".$reqid."'");
$ins=mysqli_query($con,"INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$cdate."', '".$rem."', '".$stat."')");
if(!$ins)
echo mysqli_error();
if($qry && $ins)
{

echo "1";
}
else
echo "0";
?>