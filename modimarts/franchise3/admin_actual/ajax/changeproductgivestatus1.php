<?php
 session_start();
include '../config.php';

$stetus=$_POST['stetus'];

$f_id=$_POST['f_id'];
$sql = mysqli_query($con, "select * from new_member where id='".$f_id."'");
       while ($sql_result = mysqli_fetch_assoc($sql)) {
       	$sqlquery=mysqli_query($con,"UPDATE `greetings_member` SET `is_product_received`='".$stetus."' WHERE id='".$f_id."'");
       	if($sqlquery)
       	{
       		if($stetus)
       		{
       			echo '<span onclick="CNGProst(0,'.$f_id.')">Given<span>';

       		}
       		else
       		{
       			echo '<span onclick="CNGProst(1,'.$f_id.')">Not Given<span>';
       		}
       		
       	}
       	else
       	{

       	}
       }

 ?>