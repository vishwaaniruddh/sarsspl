<?php
include('config.php');

$id=$_GET['id'];
//           echo " ".$cid."-".$status;            
			try{  
			  $qry="delete from popular_search  where id='".$id."'";
			  $res=mysql_query($qry);
                if($res){
		 
header('location:popular_search.php');
  	
				}else
                 
echo "Error Occured".mysql_error();
  
 	
                          }catch(Exception $e)
                           {
                             echo 'Message: ' .$e->getMessage();
                           }
?>