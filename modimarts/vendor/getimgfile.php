<?php 
session_start();
include('config.php');

$pcat=803;
$pcode=711;




if($pcat==1)
       {
        $slting=mysqli_query($con1,"SELECT * FROM `fashion_img` where product_id='".$pcode."'");

       }
       else if($pcat==190)
       {
        $slting=mysqli_query($con1,"SELECT * FROM `electronics_img` where product_id='".$pcode."'");
       }
        else if($pcat==218)
       {
        $slting=mysqli_query($con1,"SELECT * FROM `grocery_img` where product_id='".$pcode."'");
       }
         else if($pcat==482)
       {
        $slting=mysqli_query($con1,"SELECT * FROM `Resale_img` where product_id='".$pcode."'");
       }
        else
       {

        $slting=mysqli_query($con1,"SELECT * FROM `product_img` where product_id='".$pcode."'");
       }

  $mainpath = "https://allmart.world/ecom/";
  $sltingf=mysqli_fetch_array($slting);
  var_dump($sltingf['img']);

  echo $mainpath.$sltingf[0]['img'];

 ?>