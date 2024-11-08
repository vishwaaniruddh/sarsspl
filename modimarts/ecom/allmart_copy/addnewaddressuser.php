<?php
session_start();
include('config.php');

if(isset($_SESSION['gid']) & $_SESSION['gid']!="")
{
      $dats=$_POST;
     
    
 $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$dats["zone_id"]."'");
    $stsrw=mysqli_fetch_array($gtsts);

    $qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".mysqli_real_escape_string($dats["address_1"])."','".$stsrw[0]."','".mysqli_real_escape_string($dats["city"])."','".mysqli_real_escape_string($dats["postcode"])."')"); 

     if(!$qryaddrqr){ //echo mysql_error();
     echo 0;
         
     }else
     {
         echo 1;
         
     }
}else
{
    echo 2;
}
       
       ?>