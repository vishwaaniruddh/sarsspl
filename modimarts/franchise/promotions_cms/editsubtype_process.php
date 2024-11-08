<?php
session_start();
 include('header.php');
 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if(isset($_POST['id'])){

$id = mysqli_real_escape_string($con,$_POST['id']);
$subtype = mysqli_real_escape_string($con,$_POST['subtype']);
$status = mysqli_real_escape_string($con,$_POST['status']);
$type = mysqli_real_escape_string($con,$_POST['type']);



$insert = "UPDATE `promotion_sub_type` SET `name`='".$subtype."',`type_id`='".$type."',`status`='".$status."' WHERE id='".$id."'";
		
		if(mysqli_query($con,$insert)){ ?>

				<script>
					alert('Edit Successfully !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <? }
		 else{
		 	?>

				<script>
					alert('Edit Error !');
					window.location.href='https://allmart.world/franchise/promotions_cms/addsubtype.php';
				</script>

		 <?
		 }

}

?>