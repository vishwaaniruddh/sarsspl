<?php
session_start();

include('config.php');
$query = "select * from Productviewtable where ccode='".$_SESSION["id"]."' and status='1' ";
	$result = mysqli_query($con1,$query);
$total_records = mysqli_num_rows($result);
echo "$total_records";
?>