<?php

include('access.php');

if(!isset($_SESSION['user'])){

echo "Sorry Your Session Has Expired. Please login Again";

}

else{

include('config.php');



$reqid=$_GET['id'];

mysqli_$_GET['stat'];

$rem=str_replace("'","\'",$_GET['rem']);
mysqli_
$dt=dmysqli_-m-d H:i:s');

if(isset($_GET['chk']))

$qr=" mysqli_='".$_GET['chk']."'";
mysqli_
else
mysqli_
$qr='';
mysqli_
$amt=$_GET['amt'];

/mysqli_"Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";

mysql_query("BEGIN");

if(isset($amt) && $amt>0)
mysqli_
{

	$qry=mysql_query("Update oldebreq set status='".$stat."'  where reqid='".$reqid."'");

	$rr=mysql_query("update ebillfundrequests set approvedamt='".$amt."',iFund_status='".$stat."' where req_no='".$reqid."'");

}

else

{

	$qry=mysql_query("Update oldebreq set status='".$stat."' where reqid='".$reqid."'");

	$rr=mysql_query("update ebillfundrequests set iFund_status='".$stat."' where req_no='".$reqid."'");

}

$ins=mysql_query("INSERT INTO `ebillfundapp` (`appid`, `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '".$reqid."', '".$_SESSION['user']."', '".$dt."', '".$rem."', '".$stat."')");

if(!$qry && !$rr && !$ins)

echo mysql_error();

if($qry && $ins && $rr)

{

	mysql_query("COMMIT");

	echo "1";

}

else

{

	mysql_query("ROLLBACK");

	echo "0";

}

}

?>