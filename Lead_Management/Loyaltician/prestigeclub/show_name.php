<?php include($_SERVER['DOCUMENT_ROOT'].'/Lead_Management/Loyaltician/application/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
error_reporting(0);


$email=$_REQUEST['email'];
//$email='vk@gmail.com';

$sql=mysqli_query($conn,"select * from signUpBarcodUserDets where email='".$email."'");
$sql_result=mysqli_fetch_assoc($sql);

$fname=$sql_result['firstName'];
$lname=$sql_result['lastName'];

//$data=['barcodeScan'=>[['FName'=>$fname,'LName'=>$lname]]];
echo $fname;//. ' ' . $lname;
//echo 'Email: '.$email;



/*include('config.php');
$data=array();

//$email=$_REQUEST['email'];
$email = "vk@gmail.com";

$sql=mysqli_query($conn,"select * from signUpBarcodUserDets where email='".$email."'");
$sql_result=mysqli_fetch_assoc($sql);

$fname=$sql_result['firstName'];
$lname=$sql_result['lastName'];

$data[]=['FName'=>$fname,'LName'=>$lname];
//echo json_encode($data);
echo "value: ". $email;*/
?>