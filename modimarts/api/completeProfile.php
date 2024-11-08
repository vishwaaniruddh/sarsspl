<?php 
include($_SERVER['DOCUMENT_ROOT'].'/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$userid= $_GET['userid'];
$name= $_GET['name'];
$country = $_GET['country'];
$mobileNo= $_GET['MobileNo']; 
$address= $_GET['Address'];
$state= $_GET['StateName'];
$city= $_GET['CityName'];
$pinCode= $_GET['PinCode'];

/*$userid = '6036';
$name= 'manish'; 
$country = 'India';
$mobileNo= '5844444545';
$address= 'mumbai t';
$state= 'maharashtra';
$city= 'mumbai';
$pinCode= '485982';
*/

$qry=mysqli_query($con1,"update Registration set `Firstname` = '".$name."' ,`Mobile`='".$mobileNo."' where id='".$userid."'"); 

// echo "update Registration set `Firstname` = '".$name."' ,`Mobile`='".$mobileNo."' where user_id='".$userid."'";
// $res=mysqli_query($con1,$qry);

// var_dump($qry);

if($qry) {
    $qry1 = "insert into address(`userid`,`address`,city,state,pincode) values ('".$userid."','".$address."','".$city."','".$state."','".$pinCode."')";

    $result=mysqli_query($con1,$qry1);
}
// echo $qry1;
// var_dump($result);

if(!empty($result)) {
    $msg =  "Profile updated successfully";
    $status = 1;
    
    $nextPage="https://allmart.world/api/userRegistration.php";
    
} else {
    $msg =  "Profile updation failed!";
    $status = 0;
    $nextPage="https://allmart.world/api/userRegistration.php";
}
$data[]=['userid'=>$userid,'status'=>$status,'message'=>$msg,'nextPage'=>$nextPage];

echo json_encode($data);

?>
