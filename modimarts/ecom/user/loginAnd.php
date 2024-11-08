<?php
session_start();
include "config.php";
$user=$_POST['username'];
$passwd=$_POST['password'];
$sql="select id,password,cid from users where department='users' ";
$result=mysqli_query($con1,$sql);
$response =0;

while($row = mysqli_fetch_array($result, MYSQL_ASSOC))
{
	if($user==$row['id'] && $passwd==$row['password'])
	{
		$response =1;
		

	}
} 
echo json_encode($response);
?>



