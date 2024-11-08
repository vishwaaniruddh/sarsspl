<?php 
include($_SERVER['DOCUMENT_ROOT'].'/allmart/api/config.php');
header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Content-Type: application/json');

$email=$_GET['email'];
$password2=$_GET['password'];
//$typeOfUser=$_GET['typeOfUser'];
$deviceId = $_GET['deviceId'];
$statusOne="1";
$statusZero="0";

$query1=mysqli_query($con1,"Select * from login where  email='".$email."' and password='".$password2."'");

$count=mysqli_num_rows($query1);
$rws2=mysqli_fetch_array($query1);
 
$dataJson=array();
// $dataJson[] = ['userid'=>$rws2[0],'userName'=> $rws2[1],'password'=> $rws2[2],'registerId'=> $rws2[3]];
if($count>0){
    //$userCartUpdate = mysql_query("update cart set user_id='".$rws2['regid']."',guest_id='0' where guest_id='".$deviceId."'");
    //echo "update cart set user_id='".$rws2['regid']."',guest_id='0' where guest_id='".$deviceId."'";
    //echo $statusOne."####".$rws2[3];
    $msg =  "Login  successfull";
    $status = 1;
    $nextPage="https://allmart.world/api/dashboard.php?uid=".$email;
    $dataJson[] = ['id'=>$rws2[0],'userName'=> $rws2[1],'password'=> $rws2[2],'userid'=> $rws2[3],'status'=>$status,'message'=>$msg,'nextPage'=>$nextPage];
}else{
    $msg =  "Invalid login credentials!";
    $status = 0;
    $nextPage="https://allmart.world/api/userRegistration.php";
    $dataJson[] = ['id'=>'','userName'=> '','password'=> '','userid'=> '','status'=>$status,'message'=>$msg,'nextPage'=>$nextPage];
}
 
// $data[]=['status'=>$status,'message'=>$msg,'nextPage'=>$nextPage];
//print_r($data);

echo json_encode($dataJson);

?>
