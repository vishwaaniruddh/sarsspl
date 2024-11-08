<?php 
session_start();
include('config.php');
include('adminaccess.php');

$ads_id=$_GET['ads_id'];
$deleteads=mysqli_query($con1,"DELETE FROM `homepage_ads` WHERE id='".$ads_id."'");
if ($deleteads) {
	?>
	<script>
		alert("Delete Ads Successfully");
		window.open("HomepageAds.php", "_self");
	</script>
	<?php
}
else
{
 ?>
 <script>
		alert("Ads Not Deleted");
		window.open("HomepageAds.php", "_self");
	</script>
 <?php
}
