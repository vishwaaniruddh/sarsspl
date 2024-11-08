<?php
session_start();

include('config.php');
//var_dump($_POST);
$pname=$_POST['pname'];
$brand=$_POST['brand'];
$price=$_POST['price'];
$desc=$_POST['desc'];
$category=$_POST['category'];
$is_sold=$_POST['is_sold'];

if($_POST['id']>0){
    $update_qry = mysqli_query($con1,"update Resale set name='".$pname."',brand='".$brand."',price='".$price."',description='".$desc."',category='".$category."',sold='".$is_sold."' where code=".$_POST['id']);
   // echo "update Resale set name='".$pname."',brand='".$brand."',price='".$price."',description='".$desc."',category='".$category."',sold='".$is_sold."' where code=".$_POST['id'];exit;
    if($update_qry) {
        foreach($_POST['spec'] as $r){
            /*var_dump($r['id']);exit;*/
            $spec_name = $r['specificationname'];
            $spec =$r['product_specification'];
            $sid =$r['id'];
            $update_spec = mysqli_query($con1,"update ResaleSpecification set product_specification='".$spec."',specificationname='".$spec_name."' where id=".$sid);
        }
        $msg = true;
    }
    if($msg){
        $message = "Product updated successfully!";
    }
    $message = "Product updation failed!";
} 
if(isset($_GET['reapprove'])){
    $reaprv = mysqli_query($con1,"update Resale set status = 0 where code=".$_GET['reapprove']);
    if($reaprv){
        $message = "Product Reapproved successfully!";
    }
}

    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("myaccount.php", "_self");</script>';

?>
