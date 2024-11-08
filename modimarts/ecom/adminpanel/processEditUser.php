<?php
/*
session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');

$uid=$_POST['id'];
$pass=$_POST['pass'];
$dept=$_POST['dept'];
          //  echo " ".$code."-".$cname."-".$key;            
			try{  
			  $qry="update users set password='$pass',department='$dept' where id='$uid'";
			  $res=mysql_query($qry);
                if($res)
		 
header('location:user.php');
  
 	
                  else
                 
echo "Error Occured";
  
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>

