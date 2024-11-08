<?php
session_start(); //Start the session
include ("config.php");
$id=$_POST['id'];

$sql="update member set Waiting='Y' where id='".$id."'";
$runsql=mysqli_query($conn,$sql);

if($runsql){echo "1";}
else{
    echo "0";
}

// echo json_encode($data);  
?>