<?php
if (version_compare(phpversion(), '5.4.0', '<')) {
     if($_SESSION['gid'] == '') {
        session_start();
     }
 }
 else
 {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
 }
 include("config.php");
 
 
 //echo "delete from cart where id='".$_POST['cartid']."'";
 $delqr=mysqli_query($con1,"delete from cart where id='".$_POST['cartid']."'");
 if($delqr)
 {
   echo 1;  
 }else
 {
     echo 0;
 }
 
 ?>