<?php 
include("config.php");


$City=$_POST['City'];
//echo $City;
$chqr=mysqli_query($con,"select city from quotation1citydet where city='".$City."'");

$nors=mysqli_num_rows($chqr);

if($nors=='0')
{
$City_query=mysqli_query($con,"insert into quotation1citydet(city) values('".$City."')");

echo mysqli_error();

if($City_query)
 {
 echo "City Added";
  }
 else
 {
 echo "failed";
 }
 }
 else
 {
 echo "City already Exists";
 }

?>