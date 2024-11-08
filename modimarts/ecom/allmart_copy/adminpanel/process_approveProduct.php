<?php
session_start();
/*session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');
var_dump($_POST);
$productModel_id = $_POST['productModel_id'];
$Maincate = $_POST['main_cat'];
//echo 'mid'.$Maincate;
$set =" set status = 1 ";

if(isset($_POST['brand1']) && isset($_POST['is_brand'])){
    $brand = $_POST['brand1'];
    $qry="update  brand set status = 1 where id=".$_POST['bid'];
    $qry_res=mysqli_query($con3,$qry);
    //var_dump($qry_res);
    //if($qry_res){
        $set .= " ,brand = '".$brand."'";
   // }
    
} else if(isset($_POST['new_brand']) && isset($_POST['is_brand'])){
    //insert
    $brand = $_POST['bid'];
    $qry="update  brand set status = 1 where id=".$_POST['bid'];
    $qry_res=mysqli_query($con3,$qry);
    //var_dump($qry_res);
    //if($qry_res){
        $set .= " ,brand = '".$brand."'";
    //}
} else{
     $set .= "";
}
if(isset($_POST['product1']) && isset($_POST['is_product'])){
    $product = $_POST['product1'];
    $qry="update product_model set status = 1 where id=".$_POST['productModel_id'];
    $qry_res=mysqli_query($con3,$qry);
    //var_dump($qry_res);
    //if($qry_res){
        $set .= " ,product_model = '".$_POST['new_product']."'";
    //}
    
} else if(isset($_POST['new_product']) && isset($_POST['is_product'])){
    //$pr=mysqli_query($con3,"SELECT * FROM `product_model` where status=0 and product_model='".$_POST['new_product']."'");
    //echo "SELECT * FROM `product_model` where status=0 and product_model='".$_POST['new_product']."'";
    //var_dump(mysql_fetch_assoc($pr));
    $product = $_POST['productModel_id'];
    $qry="update product_model set status = 1 where id=".$_POST['productModel_id'];
    $qry_res=mysqli_query($con3,$qry);
    //if($qry_res){
        $set .= " ,product_model = '".$_POST['new_product']."'";
   // }
} else {
     $set .= "";
}
if(isset($_POST['new_description']) && isset($_POST['is_description'])){
    $desc = $_POST['new_description'];
    $set .= " ,description = '".$desc."'";
}
if(isset($_POST['new_long_desc']) && isset($_POST['is_long_desc'])){
    $long_desc = $_POST['new_long_desc'];
    $set .= " ,Long_desc = '".$long_desc."'";
}
if(isset($_POST['new_price']) && isset($_POST['is_price'])){
    $price = $_POST['new_price'];
    $set .= " ,price = '".$price."'";
}
if(isset($_POST['new_discount']) && isset($_POST['is_discount'])){
    $discount = $_POST['new_discount'];
    $set .= " ,discount = '".$discount."'";
}
if(isset($_POST['new_discount']) && isset($_POST['is_discount'])){
    $discount = $_POST['new_discount'];
    $set .= " ,discount = '".$discount."'";
}
if(isset($_POST['new_others']) && isset($_POST['is_discount'])){
    $others = $_POST['new_others'];
    $set .= " ,others = '".$others."'";
}

if($Maincate==1){	
    $table = 'fashion';
	/* $slting=mysqli_query($con3,"SELECT * FROM `fashion` where status=0 and name='".$_GET['pid']."'");
	 $pimg=mysqli_query($con3,"SELECT * FROM `fashion_img` where product_id='".$_GET['pid']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `fashionSpecification` where product_id='".$_GET['pid']."'");*/
}
else if($Maincate==190)
{
    $table = 'electronics';
     /*$slting=mysqli_query($con3,"SELECT * FROM `electronics` where status=0 and name='".$_GET['pid']."'");
     //echo "SELECT * FROM `electronics` where name='".$_GET['pid']."'";
     $pimg=mysqli_query($con3,"SELECT * FROM `electronics_img` where product_id='".$_GET['pid']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `electronicsSpecification` where product_id='".$_GET['pid']."'");*/  
}
else if($Maincate==218)
{
    $table = 'grocery';
     /*$slting=mysqli_query($con3,"SELECT * FROM `grocery` where status=0 and name='".$_GET['pid']."'");
     $pimg=mysqli_query($con3,"SELECT * FROM `grocery_img` where product_id='".$_GET['pid']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `grocerySpecification` where product_id='".$_GET['pid']."'");*/
} 
else if($Maincate==482)
{	 
    //$slting=mysqli_query($con3,"SELECT * FROM `Resale` where status=0 and status=0 and name='".$_GET['pid']."'");
} 
else
{
    $table = 'products';
     /*$slting=mysqli_query($con3,"SELECT * FROM `products` where status=0 and name='".$_GET['pid']."'");
     $pimg=mysqli_query($con3,"SELECT * FROM `product_img` where product_id='".$_GET['pid']."'");
	 $pspecification=mysqli_query($con3,"SELECT * FROM `productspecification` where product_id='".$_GET['pid']."'");*/
}
//$name=$_POST['name'];
 
   // $check_duplicate =mysqli_query($con3,"SELECT * FROM product_model where name = '".$name."'");
    //if(!mysql_num_rows($check_duplicate)>0){
       // $qry="insert into resale_category(`name`,status) values('".$name."',1)";
       // $res=mysqli_query($con3,$qry); 
        $message = " Added Successfully !!";   
        // echo $qry;
        //$subid= mysql_insert_id();
$query ="update  product_model ".$set."  where id = ".$_POST['productModel_id'];
$res = mysqli_query($con3,$query);
$query2 ="update  ".$table." set status = 1 where code = ".$_POST['pid'];
$res2 = mysqli_query($con3,$query2);
  echo 'set : '.$set.'<br>' .$query;
  //exit;

    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("productapproval.php", "_self");</script>';

?>
