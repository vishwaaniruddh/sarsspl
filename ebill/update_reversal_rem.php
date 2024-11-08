<?php

	include("config.php");
mysqli_
	sessiomysqli_t();
mysqli_
	$sr=mysql_query("select srno from login where username='".$_SESSION['user']."'");

	$srno=mysql_fetch_row($sr);

	$qry=mysql_query("INSERT INTO `reversal_update`(`reqid`, `upby`, `entrydt`, `remarks`) VALUES ('".$_REQUEST['reqid']."','".$srno[0]."','".date('Y-m-d H:m:s')."','".addslashes($_REQUEST['rem'])."')");

	if($qry)

		echo "1";

	else

		echo "0";

?>