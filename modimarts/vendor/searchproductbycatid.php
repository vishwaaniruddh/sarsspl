<?php
session_start();
include "config.php"; 
$catid=$_POST['id'];
$catid=803;
$id=$_SESSION['id'];

if($catid==1){
    $View = "select * from fashion where  status = 1 and ccode='$id' ";
}
else if($catid==190){
$View = "select * from electronics where status = 1 and ccode='$id' ";
}
else if($catid==218){
$View = "select * from grocery where status = 1 and ccode='$id' ";
}
else if($catid==482){
$View = "select * from Resale where status = 1 and ccode='$id' ";
}
else{
    $View = "select * from products where status = 1 and ccode='$id' ";
}

$table=mysqli_query($con1,$View);
$html = "<option value=''>Select Product</option>";
 while($res=mysqli_fetch_array($table)) {
     $prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$res['name']."'");
     $product_name = mysqli_fetch_assoc($prod);
     $_prod_name = $product_name['product_model'];
     $html = $html."<option value='".$res[0]."'>".$_prod_name."</select>";
 }
 echo $html;