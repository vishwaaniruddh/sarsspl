<?php
session_start();
include('config.php');

if(isset($_SESSION['gid']) & $_SESSION['gid']!="")
{
      $dats=$_POST;
     
     //print_r($dats);
     
     
     //echo "UPDATE `Registration` SET `Firstname`='".mysql_real_escape_string($dats["firstname"])."',`Lastname`='".mysql_real_escape_string($dats["lastname"])."',`email`='".mysql_real_escape_string($dats["email"])."',`Mobile`='".mysql_real_escape_string($dats["telephone"])."',`address`='".mysql_real_escape_string($dats["address_1"])."',`pincode`='".mysql_real_escape_string($dats["postcode"])."',`state`='".mysql_real_escape_string($dats["zone_id"])."',`city`='".mysql_real_escape_string($dats["city"])."' WHERE id='".$_SESSION['gid']."' "; 

 $gtsts=mysqli_query($con1,"SELECT * FROM `states` where state_name='".$dats["zone_id"]."'");
    $stsrw=mysqli_fetch_array($gtsts);

     $qr=mysqli_query($con1,"UPDATE `Registration` SET `Firstname`='".mysqli_real_escape_string($dats["firstname"])."',`Lastname`='".mysqli_real_escape_string($dats["lastname"])."',`email`='".mysqli_real_escape_string($dats["email"])."',`Mobile`='".mysqli_real_escape_string($dats["telephone"])."',`address`='".mysqli_real_escape_string($dats["address_1"])."',`pincode`='".mysqli_real_escape_string($dats["postcode"])."',`state`='".mysqli_real_escape_string($stsrw[0])."',`city`='".mysqli_real_escape_string($dats["city"])."' WHERE id='".$_SESSION['gid']."' ");
    
    $chkinaddrtab=mysqli_query($con1,"select * from user_address where user_id='".$_SESSION['gid']."'");
    $nrrus=mysqli_num_rows($chkinaddrtab);
    if($nrrus>0)
    {
     $qryaddrqr=mysqli_query($con1,"UPDATE `user_address` SET `address`='".mysqli_real_escape_string($dats["address_1"])."',`state`='".$stsrw[0]."',`city`='".mysqli_real_escape_string($dats["city"])."',`pin`='".mysqli_real_escape_string($dats["postcode"])."' WHERE  `user_id`='".$_SESSION['gid']."'");
    
    }else
    {
     $qryaddrqr=mysqli_query($con1,"INSERT INTO `user_address`(`user_id`, `address`, `state`, `city`, `pin`) VALUES('".$_SESSION['gid']."','".mysqli_real_escape_string($dats["address_1"])."','".$stsrw[0]."','".mysqli_real_escape_string($dats["city"])."','".mysqli_real_escape_string($dats["postcode"])."')"); 
    }
     if(!$qr){ //echo mysql_error();
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