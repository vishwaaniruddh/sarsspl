<?php
include 'config.php';
//echo "hello world";
$city=$_POST['cname'];

$code=$_POST['code'];
$add1=$_POST['add1'];

 $sql="select * from cities where name='".$city."' and state_code='".$code."' ";
// echo $sql;
         	 $result=mysql_query($sql);
         	 $row=mysql_fetch_array($result);

         	 if (mysql_num_rows($result) > 0) {
         	     echo "1";
         	     
         	 }
         	 else
         	 {
         	   echo "0";
         	 }
         	 
         	
         	 
         	?>