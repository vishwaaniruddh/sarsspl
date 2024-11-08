<?php
session_start();
include 'config.php';

if(isset($_POST))
{
    $cat_id=$_POST['catid'];
    $product_name=$_POST['prodname'];
    $pro_id=$_POST['proid'];
    $prod_id=$_POST['pid'];
    $cat_id=$_POST['price'];

    $type=$_POST['type'];
    if($type=='1')
    {
        $is_featured='1';
        $is_best_selling='0';


     }
    else if($type=='2')
    {
        $is_featured='0';
        $is_best_selling='1';
    }
    else
    {
        $is_featured='0';
        $is_best_selling='0';
    }

  $mydata=  mysqli_query($con1,"INSERT INTO `products_extra_option`( `cat_id`, `pro_id`, `prod_id`, `product_name`, `is_featured`, `is_best_selling`) VALUES ($cat_id,$pro_id,$prod_id,$product_name,$is_featured,$is_best_selling)");
    if($mydata)
    {
        echo 1;

    }
    else
    {
        // echo 0;
        echo "eror";
    }
}
else
{
    // echo 0;
    echo "no post data"
}