<?php
	if(!isset($_SESSION['SESS_USER_NAME']) || $_SESSION['designation']!="0") 
	{
		header("location:access-denied.php");
		exit();
	}


?>