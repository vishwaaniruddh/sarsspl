<?php
session_start();
/*session_start();
	ob_start();
		if(!isset($_SESSION['admin'])) {
		header('Location:index.php');	
		exit;
	}*/
include('config.php');
//var_dump($_POST);exit;
$pname=$_POST['pname'];
$brand=$_POST['brand'];
$price=$_POST['price'];
$desc=$_POST['desc'];
$category=$_POST['category'];

if($_POST['id']>0){
    $update_qry = mysql_query("update Resale set name='".$pname."',brand='".$brand."',price='".$price."',description='".$desc."',category='".$category."' where code=".$_POST['id']);
    //echo "update Resale set name='".$pname."',brand='".$brand."',price='".$price."',description='".$desc."' where code=".$_POST['id'];
   // exit;
    $message = "Category updated successfully!";
} 


    echo "<script type='text/javascript'>alert('$message');</script>";
    echo '<script>window.open("resale_productapproval.php", "_self");</script>';

?>
