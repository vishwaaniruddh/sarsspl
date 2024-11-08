<?php
session_start();
include 'config.php';

if(isset($_POST['catid']))
{
    $cat_id=$_POST['catid'];
    $product_name=$_POST['prodname'];
    $pro_id=$_POST['pid'];
    $prod_id=$_POST['proid'];
    $price=$_POST['price'];
    $pro_img=$_POST['pro_img'];
    $groupid=$_POST['groupid'];

    $type=$_POST['type'];
    
    
    $count=mysqli_num_rows(mysqli_query($con1,"SELECT * FROM `related_group_products` WHERE cat_id='$cat_id' AND pro_id='$pro_id' AND prod_id='$prod_id' AND group_id ='".$groupid."'"));
if($count==0){

  $mydata=  mysqli_query($con1,"INSERT INTO `related_group_products`( cat_id, pro_id, prod_id, product_name, group_id ,price,pro_img) VALUES ('$cat_id','$pro_id','$prod_id','$product_name','".$groupid."','$price','$pro_img')") or die(mysqli_error($con1));
    if($mydata)
    {
        echo 1;

    }
    else
    {
        echo 0;
    }
}
else
{
    echo 0;
}
}
else
{
    echo 0;
}