<?php

include('config.php');
try {

                 $cmp=$_GET['cmp'];

		  $qry1="delete from users where id='$cmp'";
			  $result=mysql_query($qry1);
			                  
			if($result)
		{
			  header('Location:user.php');  }
		else
		
		echo "error updating data";
		}
		catch(Exception $e)
		{
		 echo "Exception ".$e->getMessage();
		 }
?>