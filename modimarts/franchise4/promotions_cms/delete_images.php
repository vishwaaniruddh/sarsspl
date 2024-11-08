<?php 
include('header.php');
$id=$_GET['id'] ;

$lang_sql = mysqli_query($con,"DELETE FROM `total_promotions` WHERE id='".$id."'");


 ?>
 	<script>
       alert('Promotion Delete Successfully !');
       window.history.back();
   </script>
