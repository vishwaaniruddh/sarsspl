<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// enable live responses 
$player1=$_POST['player1'];
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];
$subjectid=$_POST['subid'];

// end live response

// test response
// $player1=179;
// $standard=8;
// $topic=205;
// $subid=8;

// end test


$insert_sql_result="INSERT INTO quiz_result(p1,subject) VALUES('".$player1."','".$subjectid."')";

if (mysqli_query($con,$insert_sql_result) === TRUE) {

    $testid = mysqli_insert_id($con);

}


$sql=mysqli_query($con,"SELECT * from quiz_friends WHERE user_id='".$player1."'");


while ($sql_result=mysqli_fetch_assoc($sql)) {

    
    $status=get_status($sql_result['friend_id']);
    

    if($status==1){
            $check_sql=mysqli_query($con,"SELECT * from friend_initiate WHERE player1='".$player1."' and testid='".$testid."' and friend_id='".$sql_result['id']."'");
    
            if(!$check_sql_result=mysqli_fetch_assoc($check_sql)){
        
        // if($player1!=$sql_result['id']){
            $insert_sql=mysqli_query($con,"INSERT INTO friend_initiate(player1,testid,friend_id,is_accepted,standard,topic,subject) VALUES('".$player1."','".$testid."','".$sql_result['friend_id']."',0,'".$standard."','".$topic."','".$subjectid."')");            
    
            // }
        }
        
        
    }

        
        


    
}
$data=['testid'=>$testid];
        
        
echo json_encode($data);



?>