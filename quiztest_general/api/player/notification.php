<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $player2=88;

// $player1=$_POST['userid'];
$player2=$_POST['player2'];
$standard=$_POST['stdid'];

// echo 'userid='.$userid;
// return;








$sql=mysqli_query($con,"select * from friend_initiate WHERE friend_id='".$player2."'  and is_accepted=0");

while($sql_result=mysqli_fetch_assoc($sql)){
$player1=$sql_result['player1'];
$topic=$sql_result['topic'];
$subject=$sql_result['subject'];
$testid=$sql_result['testid'];

// $player1=$sql_result['player2'];






// get player1 name
    
$name_sql=mysqli_query($con,"select * from quiz_regdetails WHERE id='".$player1."'");

$name_sql_result=mysqli_fetch_assoc($name_sql);    

$player1_name=$name_sql_result['name'].' '.$name_sql_result['lname'];
//






// get subject Name with Topic ID
    $get_sub_query=mysqli_query($con,"SELECT * from quiztest where topic='".$topic."'");
    $get_sub_query_result=mysqli_fetch_assoc($get_sub_query);
    
    $subid=$get_sub_query_result['subject'];
    $delete_interval=mysqli_query($con,"DELETE FROM friend_initiate WHERE created_at < (NOW() - INTERVAL 30 SECOND)  and player1='".$player2."'");
       
 
    
    $get_subject=mysqli_query($con,"SELECT * from project_catT where id='".$subid."'");
    $get_sub_result=mysqli_fetch_assoc($get_subject);

    $subject=$get_sub_result['name'];
    
    
    //get topic Name
    
    $get_topic=mysqli_query($con,"SELECT * from project_catT where id='".$topic."'");
    $get_topic_result=mysqli_fetch_assoc($get_topic);
    
    
    $topic=$get_topic_result['name'];
    

    
   
$data[]=['id'=>$id,'player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'standard'=>$standard,'topic'=>$topic,'subject'=>$subject,'notification'=>'friend'];            
}

  
echo json_encode($data);




?>