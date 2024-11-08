<?php 
session_start();
include 'config.php';

 $mainpath = $_SERVER['DOCUMENT_ROOT'];
 $pcat=$_POST['pcat'];
 $img=$_POST['img'];
 $pcode=$_POST['id'];

 $imgpath=$mainpath."/ecom/".$img;



if($pcat==1)
       {
        $slting=mysqli_query($con1,"DELETE FROM `fashion_img` where id='".$pcode."'");

       }
       else if($pcat==190)
       {
        $slting=mysqli_query($con1,"DELETE FROM `electronics_img` where id='".$pcode."'");
       }
        else if($pcat==218)
       {
        $slting=mysqli_query($con1,"DELETE FROM `grocery_img` where id='".$pcode."'");
       }
         else if($pcat==482)
       {
        $slting=mysqli_query($con1,"DELETE FROM `Resale_img` where id='".$pcode."'");
       }
        else
       {

        $slting=mysqli_query($con1,"DELETE FROM `product_img` where id='".$pcode."'");
       }

    if ($slting) 
    {

    	// @chmod($imgpath, 0777);
    	
                   if (unlink($imgpath)) {    
					    echo "success";
					} else {
					    echo "fail";    
					}
              
    	
    }
    else
    {
    	echo "Error";
    }
 ?>