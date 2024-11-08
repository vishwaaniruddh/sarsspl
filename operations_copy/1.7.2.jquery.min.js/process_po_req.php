<?php
	include("config.php");
	session_start();
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
		$qry=mysqli_query($con,"INSERT INTO `pod_receipt`(`did`, `pod`, `pod_by`, `pod_date`,`to_whom`) VALUES ('".$_REQUEST['did']."','".addslashes($_REQUEST['pod'])."','".$srno[0]."','".date('Y-m-d H:m:s')."','".addslashes($_REQUEST['towhom'])."')");
	if($qry)
		echo "1";
	else
		echo "0";
?>