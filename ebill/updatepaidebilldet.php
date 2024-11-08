<?php
session_start();
if(!$_SESSION['user'])
{
echo "Sorry your session has Expired. Please Login And Try again";
}
else
{

include("config.php");
$stdt=$_GET['stdt'];
//$stdt=date('Y-m-d',strtotime($stdt));
$edt=$_GET['edt'];
$billdt=$_GET['billdt'];
$reqid=$_GET['reqid'];
$duedt=$_GET['duedt'];
$qry=mysqli_query($con,"update ebillfundrequests set bill_date=STR_TO_DATE('".$billdt."','%d/%m/%Y'),start_date=STR_TO_DATE('".$stdt."','%d/%m/%Y'), end_date=STR_TO_DATE('".$edt."','%d/%m/%Y'),due_date=STR_TO_DATE('".$duedt."','%d/%m/%Y') where req_no='".$reqid."'");
if($qry)
echo "1";
else
echo "0";
}
?>