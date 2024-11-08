<?php
include('config.php');

$cid=$_POST['cid'];
$status=$_POST['status'];

           //echo " ".$cid."-".$status;            
			try{  
			  $qry="insert into popular_search(cat_id,status) values('$cid','$status')";
			  $res=mysql_query($qry);
                if($res)
		 
header('location:popular_search.php');
  	
                  else
                 
echo "Error Occured".mysql_error();
  
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>