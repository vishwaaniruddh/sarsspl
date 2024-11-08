<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=8;
// $userid=$_POST['userid'];


$sql=mysqli_query($con,"SELECT * from quiz_friends where user_id='".$userid."'");          

                    
while ($sql_result=mysqli_fetch_assoc($sql)) {
    
    
    $friends=$sql_result['friend_id'];
    
    if(!empty($friends) || $friends!=0){
        $data[]=['friend'=>$friends];        
    }

    
}


echo json_encode($data);

?>