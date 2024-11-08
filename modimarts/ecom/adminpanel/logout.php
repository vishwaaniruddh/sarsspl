<?php
	//Start session
	session_start();
	include "config.php";
			
			 $curr_dt=date('Y-m-d H:i:s');
	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid)values('".$_SESSION['SESS_USER_NAME']."','Logout','Logout','".$curr_dt."','".$_SESSION['lastSubID']."') ");
		


		unset($_SESSION['SESS_USER_NAME']);
		session_destroy();
		header("location:index.php");
?>