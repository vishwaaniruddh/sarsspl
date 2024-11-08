<?php
session_start();
include 'config.php';

if(isset($_POST))
{
    $id=$_POST['id'];

    $status=$_POST['status'];

  $mydata=  mysqli_query($con1,"UPDATE `products_extra_option` SET product_status='$status' WHERE id=$id") or die(mysqli_error($con1));
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
