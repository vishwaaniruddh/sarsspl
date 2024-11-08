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

                $banner=$_GET['cmp'];
$pos=$_GET['pos'];
		  $qry1="delete from HomePageImage where sn='$banner'";
			  $result=mysql_query($qry1);
			                  
			if($result)
		{
			 header('location:ViewHomePageImg.php?pos='.$pos);
 }
		else
		
		echo "error updating data";
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>