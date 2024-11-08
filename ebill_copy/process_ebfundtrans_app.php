<?php
session_start();
include ("config.php");
$sr = mysqli_query($con, "select srno from login where username='" . $_SESSION['user'] . "'");
$srno = mysqli_fetch_row($sr);
mysqli_autocommit($con, FALSE);
$up_rev = mysqli_query($con, "update `reversal` set status=1,appby='" . $srno[0] . "' where reqid='" . $_REQUEST['reqid'] . "'");
//echo "update `ebillfundrequests` set reqstatus='0' WHERE `req_no` = '".$_REQUEST['reqid']."'<br/>.";
$up_ebfundreq = mysqli_query($con, "update `ebillfundrequests` set reqstatus='0' WHERE `req_no` = '" . $_REQUEST['reqid'] . "'");
//echo "INSERT INTO `ebillfundapp`( `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES ('".$_REQUEST['reqid']."','".$_SESSION['user']."','".date('Y-m-d H')."','Reversal by software','0')";
$ins_ebillfundapp = mysqli_query($con, "INSERT INTO `ebillfundapp`( `reqid`, `appby`, `apptime`, `remarks`, `level`) VALUES ('" . $_REQUEST['reqid'] . "','" . $_SESSION['user'] . "','" . date('Y-m-d H:m:s') . "','Reversal by software','0')");
if ($up_rev && $ins_ebillfundapp && $up_ebfundreq) {
	mysqli_query($con, "COMMIT");
	$_SESSION['success'] = 1;
} else {
	mysqli_query($con, "ROLLBACK");
	$_SESSION['success'] = 0;
	echo mysqli_error();
}
header('location:view_ebfundtrans_app.php');
?>