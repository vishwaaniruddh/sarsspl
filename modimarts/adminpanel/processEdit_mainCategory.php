<?php

include('config.php');

$cid=$_POST['cid'];

$cname=$_POST['cname'];

         //  echo " ".$code."-".$cname."-".$key;            

			try{  

			  $qry="update main_category set code='".$cname."' where cid='".$cid."'";

			  $res=mysql_query($qry);

                if($res)
header('location:main_cat.php');

                  else

                 
echo "Error Occured";
  
 	

                          }catch(Exception $e)

                           {

                             echo 'Message: ' .$e->getMessage();

                           }

?>
