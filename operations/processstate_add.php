<?php 
include("config.php");


$State=$_POST['State'];
// echo $State; die;
$chqr=mysqli_query($con,"select city from quotation1statedet where state='".$State."'");

$nors=mysqli_num_rows($chqr);

if($nors=='0')
{
$State_query=mysqli_query($con,"insert into quotation1statedet(state) values('".$State."')");

echo mysqli_error();

if($State_query)
 {
 echo "State Added";
  }
 else
 {
 echo "failed";
 }
 }
 else
 {
 echo "State already Exists";
 }

?>