<?php
include("access.php");
include("config.php");
$id=$_GET['id'];
//echo "UPDATE fundaccounts SET status='1' WHERE aid ='".$id."'";
$query_update = "UPDATE fundaccounts SET status='1' WHERE aid ='".$id."'";
$result_update=mysqli_query($con,$query_update);

if($result_update)
echo 1;
else
echo 0;	


?>