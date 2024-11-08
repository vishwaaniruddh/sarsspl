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

    $type=$_POST['type'];
    if($type=='1')
    {
       $query="is_featured";
     }
    else if($type=='2')
    {
        $query="is_best_selling";
    }
    
    $count=mysqli_num_rows(mysqli_query($con1,"SELECT * FROM `products_extra_option` WHERE cat_id='$cat_id' AND pro_id='$pro_id' AND prod_id='$prod_id' AND $query ='1'"));
if($count==0){

  $mydata=  mysqli_query($con1,"INSERT INTO `products_extra_option`( cat_id, pro_id, prod_id, product_name, $query,price,pro_img) VALUES ('$cat_id','$pro_id','$prod_id','$product_name','1','$price','$pro_img')") or die(mysqli_error($con1));
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