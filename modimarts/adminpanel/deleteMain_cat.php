<?php

/*

session_start();

	ob_start();

		if(!isset($_SESSION['admin'])) {

		header('Location:index.php');	

		exit;

	}*/

include('config.php');
try {

                 $cmp=$_GET['cmp'];

		  $qry1="delete from main_category where cid='$cmp'";
			  $result=mysql_query($qry1);
			                  
			if($result)
		{
			  header('Location:main_cat.php');  }
		else
		
		echo "error updating data";
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>