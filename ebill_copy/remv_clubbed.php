<?php
	include("config.php");
	session_start();
	$qry=mysqli_query($con,"select * from ebillfundcancinv where reqid='".$_POST['reqid']."'");
	$row=mysqli_fetch_array($qry);
	$dt=date('Y-m-d H:i:s');
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	$srno=mysqli_fetch_row($sr);
	$qry1=mysqli_query($con,"INSERT INTO `ebillfundcancinv_deleted`( `reqid`, `entrydt`, `updtby`, `delby`, `deldt`) VALUES ('".$row['reqid']."','".$row['entrydt']."','".$row['updtby']."','".$srno[0]."','".$dt."')");
	if($qry1)
	{
		$qry2=mysqli_query($con,"delete from ebillfundcancinv where reqid='".$_POST['reqid']."'");
		if($qry2)
		echo "Unclubbed";
		else
		echo "Error";
	}
	else
	{
		echo "Query Error";
	}
?>