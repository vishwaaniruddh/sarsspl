<?php
	include("config.php");
	session_start();
	$sr=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
	if(mysqli_num_rows($sr)>0)
	{
		$srno=mysqli_fetch_row($sr);
		$qry=mysqli_query($con,"INSERT INTO `update_receipt`(`reqid`, `pdate`, `amt` , `remark`, `entrydt`, `entrby`) VALUES ('".$_REQUEST['reqid']."','".date('Y-m-d',strtotime(str_replace('/','-',$_REQUEST['pdate'])))."','".$_REQUEST['amt']."','".addslashes($_REQUEST['rem'])."','".date('Y-m-d H:m:s')."','".$srno[0]."')");
		if($qry)
			echo "1";
		else
			echo "0";
	}
	else
		echo "0";
?>