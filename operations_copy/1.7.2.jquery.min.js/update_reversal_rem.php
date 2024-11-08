<?php

	include("config.php");
mysqli_query($con,
	session_start();
mysqli_query($con,
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");

	$srno=mysqli_fetch_row($sr);

	$qry=mysqli_query($con,"INSERT INTO `reversal_update`(`reqid`, `upby`, `entrydt`, `remarks`) VALUES ('".$_REQUEST['reqid']."','".$srno[0]."','".date('Y-m-d H:m:s')."','".addslashes($_REQUEST['rem'])."')");

	if($qry)

		echo "1";

	else

		echo "0";

?>