<?php
session_start();

include('config.php');

$pid=$_POST['pid'];
$cat=$_POST['cat'];

$usrid=$_SESSION['gid'];
$dt= $date = date('Y-m-d H:i:s');

$slctqry=mysqli_query($con1,"SELECT * FROM `login` where regid='".$usrid."' and email!='' and password!=''");
$slctchkqry=mysqli_num_rows($slctqry);
 
 if($slctchkqry>0)
 {
 

if(isset($_SESSION['gid']) & $_SESSION['gid']!="")
{
   
   $slctwish=mysqli_query($con1,"select `wishlist_id`, `user_id`, `product_id`, `datetime` FROM `wishlist` WHERE product_id='".$pid."' and categories_id='".$cat."' and user_id='".$usrid."'");
$slctwishr=mysqli_num_rows($slctwish);

if($slctwishr==0){

//echo "INSERT INTO `cart`(`user_id`, `pid`, `qty`, `dt`,p_price,total_amt) VALUES ('".$usrid."','".$pid."','".$qty.",'".$dt."','".$gprws[0]."','".$gprws[0]."')";
$qryinsert=mysqli_query($con1,"INSERT INTO `wishlist`(`user_id`, `product_id`, `datetime`,categories_id) VALUES ('".$usrid."','".$pid."','".$dt."','".$cat."')");


if($qryinsert)
{
echo 1;
}
else
{
    echo mysqli_error($con1);
echo 0;
}
}else{
    echo 2;
    
}
}
else
{
    echo 4;
}
}else
{
    echo 3;
}
?>