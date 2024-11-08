<?php
include('config.php');

$cid=$_POST['cid'];
$status=$_POST['status'];
$id=$_POST['id'];
//           echo " ".$cid."-".$status;            
			try{  
			  $qry="update popular_search set cat_id='".$cid."',status='".$status."' where id='".$id."'";
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