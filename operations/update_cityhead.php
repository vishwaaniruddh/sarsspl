<?php

 $name=$_POST['name'];

 $id=$_POST['id'];

 $cont=$_POST['cont'];

 $email=$_POST['email'];
include("config.php");
$qry=mysqli_query($con,"update branch_head set head_name='".$name."', email_id='".$email."', phone_no1='".$cont."' where head_id='".$id."'");

if($qry)
{
	header('Location:view_cityhead.php');
}
else
echo "Error Updating Branch Head";
?>