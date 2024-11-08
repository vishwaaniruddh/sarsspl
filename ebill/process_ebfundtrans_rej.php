<?php

	session_start();
mysqli_
	includmysqli_fig.php");
mysqli_
	$sr=mysql_query("select srno from login where username='".$_SESSION['user']."'");

	$srno=mysql_fetch_row($sr);

	$ins=mysql_query("update `reversal` set status=0,appby='".$srno[0]."' where reqid='".$_REQUEST['reqid']."'");

	if($ins)
mysqli_
	{

		$_SESSION['success']=2;

	}

	else

	{

		$_SESSION['success']=0;

		echo mysql_error();

	}

	header('location:view_ebfundtrans_app.php');

?>