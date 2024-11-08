<?php
	include("config.php");
	session_start();
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
		$qry=mysqli_query($con,"update update_receipt set req_status=1,appby='$srno[0]',adate='".date('Y-m-d')."' where did='".$_REQUEST['did']."'");
	if($qry)
		$_SESSION['success']=1;
	else
		$_SESSION['success']=0;
	header('location:view_dispatch_raised.php');
?>