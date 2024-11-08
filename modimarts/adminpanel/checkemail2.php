<?php
include 'config.php';
$EMAIL=$_POST['emailid'];
 $sql="select username from admin_login where username='".$EMAIL."' ";
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