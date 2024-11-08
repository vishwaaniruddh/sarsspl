<?php
include ('access.php');
if (!isset($_SESSION['user'])) {
	$_SESSION['success'] = 0;
} else {
	include ('config.php');
	$array = $_REQUEST['mastapp'];
	$stat = $_REQUEST['stat'];
	$rem = addslashes($_REQUEST['remarks']);
	//$reasons=$_REQUEST['reasons'];
	//echo "Update ebillfundrequests set reqstatus='".$stat."' where reqid='".$reqid."'";
	$dt = date('Y-m-d H:i:s');
	mysqli_autocommit($con, FALSE);
	$errors = 0;
	foreach ($array as $reqid) {
		$qry = mysqli_query($con, "Update quotation set status='" . $stat . "' where quotid='" . $reqid . "'");
		$ins = mysqli_query($con, "INSERT INTO `quotapproval` (`appid`, `quotid`, `appby`, `apptime`, `remarks`, `level`) VALUES (NULL, '" . $reqid . "', '" . $_SESSION['user'] . "', '" . $dt . "', '" . $rem . "', '" . $stat . "')");
		if (!$qry || !$ins) {
			$errors++;
		}
	}
	/*if(!$ins)
		   echo mysqli_error();*/
	if ($errors > 0) {
		$_SESSION['success'] = 0;
		mysqli_query($con, "ROLLBACK");
	} else {
		$_SESSION['success'] = 1;
		mysqli_query($con, "COMMIT");
	}
}
header('location:viewquot.php');
?>