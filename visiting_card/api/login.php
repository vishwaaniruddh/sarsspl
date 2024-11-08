<?php
include($_SERVER['DOCUMENT_ROOT'].'/visiting_card/config/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json'); 

$data = $_POST;

$response = array();

$mobile_no = isset($data['mobile_no']) ? $data['mobile_no'] : '';
$password = isset($data['password']) ? $data['password'] : '';

if(!empty($mobile_no) && !empty($password)){
    
    if(strlen($mobile_no) !== 10){
        $response['Code'] = "422";  // 422 = senantic errors
        $response['msg'] = "Mobile number exceeds 10 digits";
    } else {
        $checksql = mysqli_query($con, "select * from users where mobile_no = '$mobile_no' and password = '$password'");
        if(mysqli_num_rows($checksql) > 0){
            $fetchres = mysqli_fetch_assoc($checksql);
            $user_id = $fetchres['id'];
            
            $response['Code'] = 200; // 200 = successfull
            $response['msg'] = "Login successful";
            $response['user_id']=$user_id;
            
        } else {
            $response['Code'] = 401; // 401 = unauthorised
            $response['msg'] = "Invalid mobile number or password";
        }
    }
} else {
    $response['Code'] = 404; // 404 = not found
    $response['msg'] = "Mobile number or password is missing";
}

echo json_encode($response);
?>
