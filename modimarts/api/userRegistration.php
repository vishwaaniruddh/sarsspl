
<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$name= $_GET['name']; //
// $lastName= $_GET['LastName'];
$emailID= $_GET['EmailId']; //
// $gender = $_GET['Gender'];
$mobileNo= $_GET['MobileNo']; //
// $address= $_GET['Address'];
/*$state= $_GET['StateName'];
$city= $_GET['CityName'];
$pinCode= $_GET['PinCode'];*/
$Password= $_GET['Password']; //

$date = date("Y-m-d");
/*$name = 'ruchi';
$emailID="test@t.com";
$mobileNo = '54525555';
$Password="123456";
*/
$qry="insert into Registration(`Firstname`,`email`,`Mobile`,`password`,created_at) values('$name','$emailID','$mobileNo','$Password',$date)";
// echo $qry;exit;
$res=mysqli_query($con1,$qry);

$regid = mysqli_insert_id($con1); 
if(!empty($regid)){
$qry1 = "insert into login(`email`,`password`,`regid`) values ('".$emailID."','".$Password."','".$regid."')";

$result=mysqli_query($con1,$qry1);
}
mysqli_error();
if(!empty($result)) {
    $msg =  "register successfully";
    $status = 1;
    //$nextPage="https://allmart.world/allmart/api/dashboard.php?uid=".$regid;
    $nextPage="https://allmart.world/api/userRegistration.php";
    
} else {
    $msg =  "registration failed!";
    $status = 0;
    $nextPage="https://allmart.world/api/userRegistration.php";
}
$data[]=['status'=>$status,'message'=>$msg,'nextPage'=>$nextPage];
//print_r($data);

echo json_encode($data);

?>
