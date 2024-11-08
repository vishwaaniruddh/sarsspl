<?php

include 'config.php';

//$ref=$_GET['ref'];
$proc=$_GET['proc'];

   
            $qry="SELECT * FROM `service_master` WHERE `id`='$proc'";
 $res=mysqli_query($con,$qry);
		$row = mysqli_fetch_row($res);
		$total=$row[2];
		
		$str=$total."#".$row[0];


					
echo $str;
?>