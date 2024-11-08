<?php
session_start();

if(isset($_SESSION['id']) & $_SESSION['id']!="")
{
include("config.php");
$qr="";
 $getdetrs=mysqli_query($con1,"select * from Productviewtable where code='".$_POST['newid']."'");
$prdetsrw=mysqli_fetch_array($getdetrs);
if(isset($_POST['typ']) & $_POST['typ']!="")
{
   if($_POST['updid']!="")
   {
    $qr="update latest_featured_product set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where id='".$_POST['updid']."' and typ='".$_POST['typ']."'";
   }else
   {
      $qr="insert into latest_featured_product(cat_id,product_id,typ,user_id,booking_id) values ('".$prdetsrw['category']."','".$_POST['newid']."','".$_POST['typ']."','".$_SESSION['id']."','".$_POST['bookingid']."')";  
   }
}
else
{
   // echo "ok1";
    if($_POST['str']=="deals")
    {
      if($_POST['updid']!="")
   {
    $qr="update deals_of_the_day set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where deal_id='".$_POST['updid']."'";
   }else
   {
      $qr="insert into deals_of_the_day(cat_id,product_id,user_id,booking_id) values ('".$prdetsrw['category']."','".$_POST['newid']."','".$_SESSION['id']."','".$_POST['bookingid']."')";  
   }  
        
    }
    
    
     if($_POST['str']=="toprating")
    {
      if($_POST['updid']!="")
   {
    $qr="update top_rating_details set cat_id='".$prdetsrw['category']."',product_id='".$_POST['newid']."' where id='".$_POST['updid']."'";
   }else
   {
      $qr="insert into top_rating_details(cat_id,product_id,user_id,booking_id) values ('".$prdetsrw['category']."','".$_POST['newid']."','".$_SESSION['id']."','".$_POST['bookingid']."')";  
   }  
        
    }
    
    
}
//echo $qr;
$exwcq=mysqli_query($con1,$qr);
if($exwcq)
{
    echo 1;
}
else
{
    echo 2;
}
}else
{
echo 50;
}
?>