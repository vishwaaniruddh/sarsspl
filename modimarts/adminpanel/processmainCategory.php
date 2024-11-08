<?php

include('config.php');

$cid=$_POST['cid'];

$cname=$_POST['cname'];

         //  echo " ".$code."-".$cname."-".$key;            

			try{  

			  $qry="insert into main_category values('".$cid."','".$cname."')";

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

<p><a href="main.php">Go Back</a> </p>

<p><a href="index.html">Admin Home</a> </p>