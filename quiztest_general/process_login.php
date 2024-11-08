<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');
//session_start();

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');



$email = $_POST['email'];
$pwd =$_POST['pwd'];
$fcm_key = "";
if(isset($_POST['pwd'])){
 $fcm_key =$_POST['fcm_key'];
}

$sql = mysqli_query($con,"select * from quiz_login where email='".$email."' and pass='".$pwd."'");
$sql_result = mysqli_fetch_assoc($sql);

if($sql_result){
    $id = $sql_result['user_id'];
    if($fcm_key!=''){
      $updatesql = mysqli_query($con,"update quiz_login set fcm_key= '".$fcm_key."' where id='".$id."'");
    }
    
    
    $get_sql = mysqli_query($con,"select * from quiz_regdetails where id='".$id."'");
    $get_sql_result = mysqli_fetch_assoc($get_sql);
    
    $name = $get_sql_result['name'];
    $lname = $get_sql_result['lname'];
    $std  = $get_sql_result['class'];
    $email = $get_sql_result['emailid']; 
    $school = $get_sql_result['school'];
    
    $data=['userid'=>$id,'name'=>$name,'std'=>$std,'email'=>$email,'school'=>$school,'lname'=>$lname,'msg'=>'You have successfully logged in'];
    
    echo json_encode($data);
        
}
else{
    echo json_encode('0');
}
?>