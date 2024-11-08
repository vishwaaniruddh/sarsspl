<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];
// $userid=166;
$subjectid=$_POST['subid'];
// $subjectid=3;

if($subjectid>0){
    $sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' and subject='".$subjectid."' ORDER by created_at DESC LIMIT 10");
}
else{
$sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' ORDER by created_at DESC LIMIT 10");    
}



while ($sql_result=mysqli_fetch_assoc($sql)) {
    

    $p2=$sql_result['p2'];
    $topic=$sql_result['topic_ids'];
    // echo $topic; 
    // echo "SELECT id,name FROM `project_catT` where under in($topic)";
    
    if($topic){
        $testid=$sql_result['id'];
    $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($topic)");
    $row=mysqli_fetch_assoc($sqlm);
      $topic_name=$row['name'];
    
    
    $sqla=mysqli_query($con,"SELECT * from quiztest where topic='".$topic."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    
    $subjectid=$sql_resulta['subject'];
    
    $get_sub=mysqli_query($con,"SELECT * from project_catT where id='".$subjectid."'");
    $get_sub_result=mysqli_fetch_assoc($get_sub);
    
    $subject=$get_sub_result['name'];
    
    $p1_correct_count=$sql_result['p1_correct_count'];
    $p2_correct_count=$sql_result['p2_correct_count'];
    $player_won=$sql_result['player_won'];
    $date=$sql_result['created_at'];


$timestamp1 = $sql_result['created_at'];
$timestamp = strtotime($sql_result['created_at']);
$date = date('d-M-Y', $timestamp);
// $time = date('Gi.s', $timestamp);

$name=get_name($p2,FALSE);

    $data[]=['testid'=>$testid,'p2'=>$p2,'name'=>$name,'p1_correct_count'=>$p1_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p2_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp];        
    }

    
}











if($subjectid>0){
    $sql=mysqli_query($con,"SELECT * from quiz_result where p2='".$userid."' and subject='".$subjectid."' ORDER by created_at DESC LIMIT 10");
}
else{
    $sql=mysqli_query($con,"SELECT * from quiz_result where p2='".$userid."' ORDER by created_at DESC LIMIT 10");    
}



while ($sql_result=mysqli_fetch_assoc($sql)) {
    

    $p1=$sql_result['p1'];
    $topic=$sql_result['topic_ids'];
    // echo $topic; 
    // echo "SELECT id,name FROM `project_catT` where under in($topic)";
    
    if($topic){
        $testid=$sql_result['id'];
    $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($topic)");
    $row=mysqli_fetch_assoc($sqlm);
      $topic_name=$row['name'];
    
    
    $sqla=mysqli_query($con,"SELECT * from quiztest where topic='".$topic."'");
    $sql_resulta=mysqli_fetch_assoc($sqla);
    
    $subjectid=$sql_resulta['subject'];
    
    $get_sub=mysqli_query($con,"SELECT * from project_catT where id='".$subjectid."'");
    $get_sub_result=mysqli_fetch_assoc($get_sub);
    
    $subject=$get_sub_result['name'];
    
    $p1_correct_count=$sql_result['p1_correct_count'];
    $p2_correct_count=$sql_result['p2_correct_count'];
    $player_won=$sql_result['player_won'];
    
    if($player_won){
        
    
    if($player_won=='player1'){
     $player_won='player2';
    }
    
    else{
        $player_won='player1';
    }
    }
    $date=$sql_result['created_at'];


$timestamp1 = $sql_result['created_at'];
$timestamp = strtotime($sql_result['created_at']);
$date = date('d-M-Y', $timestamp);
// $time = date('Gi.s', $timestamp);

$name=get_name($p2,FALSE);
    $data[]=['testid'=>$testid,'p2'=>$p1,'name'=>$name,'p1_correct_count'=>$p2_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p1_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp];        
    }

    
}

$array=$data;

// print_r($data);


$tempArr = array_unique(array_column($array, 'testid'));
echo json_encode(array_intersect_key($array, $tempArr));

?>