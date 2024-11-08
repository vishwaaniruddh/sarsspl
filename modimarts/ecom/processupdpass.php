<?php 
session_start();
include('config.php');
//if(isset($_SESSION['gid']))
$passwd=$_POST['password'];

echo $confirm;

 $qryupdate=mysqli_query($con1,"update login  set password='".$passwd."' where regid='".$_SESSION['gid']."' ");
 echo "update login  set password='".$confirm."' where regid='".$_SESSION['gid']."' ";
   if($qryupdate)
   {
       echo 1;
   }
?>