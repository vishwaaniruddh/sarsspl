<?php
	if(!isset($_SESSION['SESS_USER_NAME']) & ($_SESSION['designation']!="0" & $_SESSION['designation']!="1")) 
	
	{
		header("location: access-denied.php");
		exit();
	}


?>