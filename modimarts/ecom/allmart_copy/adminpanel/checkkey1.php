<?php
include 'config.php';
$city=$_POST['cname'];

$code=$_POST['code'];
$add1=$_POST['add1'];

$sql1="select * from cities where keywords='".$add1."' and state_code='".$code."' ";
         	 $result1=mysql_query($sql1);
         	 $row1=mysql_fetch_array($result1);
         	 
         	 if (mysql_num_rows($result1) > 0) {
         	     echo "1";
         	     
         	 }
         	 else
         	 {
         	     echo "0";
         	 }
         	 ?>