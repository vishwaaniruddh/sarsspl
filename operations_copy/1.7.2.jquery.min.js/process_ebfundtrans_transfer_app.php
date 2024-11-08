<?php
	session_start();
	include("config.php");
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	$ins=mysqli_query($con,"update `transfer` set status=1,appby='".$srno[0]."' where reqid='".$_REQUEST['reqid']."'");
	if($ins)
	{
		$_SESSION['success']=1;
	}
	else
	{
		$_SESSION['success']=0;
		echo mysqli_error();
	}
	header('location:view_ebfundtrans_transfer_app.php');
?>