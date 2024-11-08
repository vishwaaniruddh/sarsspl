<?php 
include('config.php');
$name=$_POST['fname'];
$lname=$_POST['lname'];
$mobile=$_POST['mobile'];
$amount=$_POST['amount'];
$quantity=$_POST["quantity"];
$donation_Purpose=$_POST['donation_Purpose'];
$Donation_date=date("Y-m-d");;



$result= mysqli_query($conn,"INSERT INTO Transaction( `name`,LastName, `mobile`, `amount`, `days`, `donation_Purpose`, `Donation_date`) VALUES ('".$name."','".$lname."','".$mobile."','".$amount."','".$quantity."','".$purpose."','".$date."')");
//echo "INSERT INTO Transaction( `name`, `mobile`, `amount`, `days`, `donation_Purpose`, `Donation_date`) VALUES ('".$name."','".$mobile."','".$amount."','".$quantity."','".$purpose."','".$date."')";
if($result)
{
   //echo "Successfully";
   header("location:../PHP_Bolt-master/index.php");
}






?>