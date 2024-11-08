<?php
session_start();
 include('header.php'); ?>
	

<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// var_dump($_SESSION['username']);

if(isset($_POST['subtype'])){

$subtype = mysqli_real_escape_string($con,$_POST['subtype']);
$type = mysqli_real_escape_string($con,$_POST['type']);
$createdby=$_SESSION['username'];

$date=date('Y-m-d');


$insert = "INSERT INTO `promotion_sub_type`(`name`, `type_id`, `date`, `craeted_by`) VALUES('".$subtype."','".$type."','".$date."','".$createdby."')";
		
		if(mysqli_query($con,$insert)){ ?>

				<script>
					alert('Added Successfully !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <? }
		 else{
		 	?>

				<script>
					alert('Added Error !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <?
		 }

}

?>