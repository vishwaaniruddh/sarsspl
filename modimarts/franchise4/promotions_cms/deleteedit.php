<?php
session_start();
 include('header.php'); ?>
	

<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// var_dump($_SESSION['username']);

if(isset($_GET['id'])){

$id = mysqli_real_escape_string($con,$_GET['id']);


$insert = "DELETE FROM `promotion_sub_type` WHERE id='".$id."'";
		
		if(mysqli_query($con,$insert)){ ?>

				<script>
					alert('Delete Successfully !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <? }
		 else{
		 	?>

				<script>
					alert('Delete Error !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <?
		 }

}

?>