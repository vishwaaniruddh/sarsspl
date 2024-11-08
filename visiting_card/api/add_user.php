<?php
include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');

$data = $_POST;

$response = array();

$user_name = isset($data['user_name']) ? $data['user_name'] : '';
$mobile_no = isset($data['mobile_no']) ? $data['mobile_no'] : '';
$password = isset($data['password']) ? $data['password'] : '';
$status = 1;

// $_refcode = base64_encode($mobile_no);

function generateReferralCode($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$referral_code = generateReferralCode();



// $referral_code = $_refcode ;

if(strlen($mobile_no) == 10 && !empty($password)) {
    $checksql = mysqli_query($con,"select mobile_no,password from users where mobile_no = '$mobile_no'");
    if(mysqli_num_rows($checksql)>0){
        $response['Code'] = 400; 
        $response['msg'] = "User's Contact Already Exist";
        } else {
            $insertsql = mysqli_query($con,"insert into users(mobile_no,password,status,referral_code,created_at,user_name) values('$mobile_no','$password','$status','$referral_code','$datetime','$user_name')  ");
            if($insertsql){
                $response['Code']=200;
                $response['msg']="User Created Successfully";
                $response['referral_code'] = $referral_code;
            } else{
                $response['Code'] = 250;
                $response['msg'] = "Error Inserting Data!!";
            }
        }
    }else {
        $response['Code']=400;
        $response['msg']="Invalid Mobile Number or Password";
    }

echo json_encode($response);

?>