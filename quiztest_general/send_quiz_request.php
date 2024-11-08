<?php
if (!isset($_SESSION)) session_start();
include("config.php");
$id= $_SESSION['userid'];

$subject=$_POST["sub"];
$topic=$_POST["topics"];


$qrt=mysqli_query($con,"INSERT INTO `quiz_requests`(`subject_id`, `topics`, `user_id`, `friend_id`, `entrydt`) VALUES('".$subject."','".$topic."','".$id."','".$_POST["frndid"]."','".date("Y-m-d H:i:s")."')");

$data=array();
$sts=0;
$reqid=0;
if($qrt)
{
    $sts=1;
    $reqid=mysqli_insert_id($con);
}


$data=['sts'=>$sts,'reqid'=>$reqid];

echo json_encode($data);
mysqli_close($con);
?>