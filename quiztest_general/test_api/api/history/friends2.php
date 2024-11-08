<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];

$subjectid=$_POST['subid'];


// $userid=166;
// $subjectid=1;


$friends_sql=mysql_query("select * from quiz_friends where user_id='".$userid."'",$con);



while($friends_sql_result=mysql_fetch_assoc($friends_sql)){
    
    $friends[]=$friends_sql_result['friend_id'];
} 


$friends=json_encode($friends);

$friends=str_replace( array('[',']','"') , ''  , $friends);



$arr=explode(',',$friends);


$result_ar = "'" . implode ( "', '", $arr ) . "'";


if($subjectid>0){
$q="SELECT * from quiz_result where p1='".$userid."' and p2 in (".$result_ar.") and subject='".$subjectid."' ORDER by created_at DESC LIMIT 10";    
}
else{
    $q="SELECT * from quiz_result where p1='".$userid."' and p2 in (".$result_ar.") ORDER by created_at DESC LIMIT 10";
}



$sql=mysql_query($q,$con);


while ($sql_result=mysql_fetch_assoc($sql)) {
    

    $p2=$sql_result['p2'];
    $topic=$sql_result['topic_ids'];
    // echo $topic; 
    // echo "SELECT id,name FROM `project_catT` where under in($topic)";
    
    if($topic){
                $testid=$sql_result['id'];
    $sqlm=mysql_query("SELECT id,name FROM `project_catT` where under in($topic)",$con);
    $row=mysql_fetch_assoc($sqlm);
      $topic_name=$row['name'];
    
    
    $sqla=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    
    $subjectid=$sql_resulta['subject'];
    
    $get_sub=mysql_query("SELECT * from project_catT where id='".$subjectid."'",$con);
    $get_sub_result=mysql_fetch_assoc($get_sub);
    
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


    $data[]=['testid'=>$testid,'p2'=>$p2,'name'=>$name,'p1_correct_count'=>$p1_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p2_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp1];        
    }

    
}









if($subjectid>0){
$q="SELECT * from quiz_result where p2='".$userid."' and p1 in (".$result_ar.") and subject='".$subjectid."' ORDER by created_at DESC LIMIT 10";    
}

else{
    $q="SELECT * from quiz_result where p2='".$userid."' and p1 in (".$result_ar.") ORDER by created_at DESC LIMIT 10";
}


$sql=mysql_query($q,$con);

while ($sql_result=mysql_fetch_assoc($sql)) {
    

    $p1=$sql_result['p1'];
    $topic=$sql_result['topic_ids'];
    // echo $topic; 
    // echo "SELECT id,name FROM `project_catT` where under in($topic)";
    
    if($topic){
                $testid=$sql_result['id'];
    $sqlm=mysql_query("SELECT id,name FROM `project_catT` where under in($topic)",$con);
    $row=mysql_fetch_assoc($sqlm);
      $topic_name=$row['name'];
    
    
    $sqla=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $sql_resulta=mysql_fetch_assoc($sqla);
    
    $subjectid=$sql_resulta['subject'];
    
    $get_sub=mysql_query("SELECT * from project_catT where id='".$subjectid."'",$con);
    $get_sub_result=mysql_fetch_assoc($get_sub);
    
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

    $data[]=['testid'=>$testid,'p2'=>$p1,,'name'=>$name,'p1_correct_count'=>$p2_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p1_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp1];        
    }

    
}

$array=$data;

// print_r($data);


$tempArr = array_unique(array_column($array, 'testid'));
echo json_encode(array_intersect_key($array, $tempArr));

// echo json_encode($data);
?>