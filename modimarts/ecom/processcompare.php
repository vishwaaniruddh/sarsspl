<?php
session_start();
include('config.php');
$prid = $_POST['prid'];
$cat = $_POST['cat'];
$usrid=$_SESSION['gid'];
$dt= $date = date('Y-m-d H:i:s');
$errs=0;
if($usrid!=="")
{
    $prdcount=0;
$chknofproducts=mysqli_query($con1,"select count(id) from compare_products where user_id='".$usrid."'");
$chknofproductsrws=mysqli_num_rows($chknofproducts);
    if($chknofproductsrws>0)
    {
        $ftcharr=mysqli_fetch_array($chknofproducts);
       $prdcount=$ftcharr[0];
    }
    
    
$chkqr=mysqli_query($con1,"select * from compare_products where user_id='".$usrid."' and product_id='".$prid."'  ");
$nr=mysqli_num_rows($chkqr);
if($nr>0)
{
    echo 3;
}
else
{
    if($prdcount<4)
    {
$qr=mysqli_query($con1,"INSERT INTO `compare_products`(`user_id`, `product_id`, `entrydt`,category)values('".$usrid."','".$prid."','".$dt."','".$cat."')");
 
if(!$qr)
{
  echo 0;
}else
{
    echo 1;
}
}else
{
    echo 4;
}
    
}
}else
{
    echo 2;
}
?>