<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];

$sql = mysqli_query($con,"select * from competetion_quiz where p1 ='".$userid."'");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];
    $p1_correct_count = $sql_result['p1_correct_count'];
    $p2_correct_count = $sql_result['p2_correct_count'];
    $player_won = $sql_result['player_won'];
    $created_at = $sql_result['created_at'];
    $topic = $sql_result['topic'];
    
    
       
    $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($topic)");
    $row=mysqli_fetch_assoc($sqlm);
      $topic_name=$row['name'];
      
    $data[] = ['id'=>$id,'p1'=>$p1_correct_count ,'p2'=>$p2_correct_count , 'player_won'=>$player_won ,'created_at'=>$created_at,'name'=>$topic_name];
}

if($data){
    echo json_encode($data);
}
else{
    echo 0;
}
