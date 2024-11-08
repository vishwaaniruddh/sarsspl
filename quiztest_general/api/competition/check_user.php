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
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');

$userid = $_REQUEST['userid'];

if($userid){
    $sql = mysqli_query($con,"select * from competetion_registration where userid ='".$userid."' and status=1");
   if(mysqli_num_rows($sql)>0){ 
        if($sql_result = mysqli_fetch_assoc($sql)){
        
        
        $subject = $sql_result['subject'];
        $std  = $sql_result['id'];
        
        $data=['competetion_registration'=>$id,'subject'=>$subject];
        
        echo json_encode($data);
        }
        else{
            echo json_encode('0');
        }
   }else{
            echo json_encode('0');
        }
}
else{
   echo json_encode('0');
}