<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$player1   = $_POST['player1'];
$friend_id = $_POST['friend_id'];

$subjectid=$_POST['subid'];
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];

// $player1=179;
// $friend_id=168;
// $subjectid=1;
// $standard=8;
// $topic=1;



$sql=mysqli_query($con,"SELECT * from quiz_friends WHERE user_id='".$player1."'");


if ($sql_result=mysqli_fetch_assoc($sql)) {

    
    $status=get_status($friend_id);
    

    if($status==1){
        
        
        
    $insert_sql_result="INSERT INTO quiz_result(p1,p2,subject) VALUES('".$player1."','".$friend_id."','".$subjectid."')";

            if (mysqli_query($con,$insert_sql_result) === TRUE) {
            
                $testid = mysqli_insert_id($con);
    
            }



        
        
            $check_sql=mysqli_query($con,"SELECT * from friend_initiate WHERE player1='".$player1."' and testid='".$testid."' and friend_id='".$sql_result['id']."'");
    
            if(!$check_sql_result=mysqli_fetch_assoc($check_sql)){
        

            $insert_sql=mysqli_query($con,"INSERT INTO friend_initiate(player1,testid,friend_id,is_accepted,standard,topic,subject) VALUES('".$player1."','".$testid."','".$friend_id."',0,'".$standard."','".$topic."','".$subjectid."')");
    
                
            }
            
    }
    
}
if($testid){
$data=['testid'=>$testid];    
}
else{
    $data=['testid'=>'0'];    
}
echo json_encode($data);

?>