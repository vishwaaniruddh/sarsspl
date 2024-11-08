<?php

header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');


$test_id=$_POST['test_id'];
// $question_id=$_POST['qid'];
// $subtopic_id=$_POST['sub_topic'];
// $p1_responses=$_POST['p1_response'];
$time=$_POST['time'];

$p1_responses='a';
$question_id=8962;
$test_id=2;

// time

$get_time=mysql_query("select * from quiztest WHERE srno='".$question_id."'",$con);
    
  $result_time=mysql_fetch_assoc($get_time);

$ideal_time=$result_time['ideal_time'];
                  
                  if($ideal_time=='T1'){
                     $ideal_time=30; 
                  }
                  elseif($ideal_time=='T2'){
                     $ideal_time=20;       
                  }
                    elseif($ideal_time=='T3'){
                     $ideal_time=45;       
                  }
                    elseif($ideal_time=='T4'){
                     $ideal_time=60;       
                  }

// endtime



// $last_count=mysql_query("SELECT * FROM quiz_result where test_id='".$test_id."' and questions_ids='".$question_id."'",$con);


$last_count=mysql_query("SELECT * FROM quiz_result where test_id='".$test_id."' ORDER BY id DESC",$con);

$count_result=mysql_fetch_assoc($last_count);

$count=$count_result['count']+1;

$correct=(70*($count))/100;

$getsql=mysql_query("SELECT * FROM quiz_result where test_id='".$test_id."' and questions_ids='".$question_id."'",$con);

echo "SELECT * FROM quiz_result where test_id='".$test_id."' and questions_ids='".$question_id."'";
$get_result=mysql_fetch_assoc($getsql);
$get_count=$get_result['count'];
$p2_responses=$get_result['answers'];



if($p1_responses==$get_result['answers'] || $p2_responses==$get_result['answers']){
    
    $is_p1_correct='yes';
    $is_p2_correct='yes';

    
}
else{
    
    $is_p1_correct=='no';
    $is_p2_correct=='no';

    
}

if($get_count<$correct){
$sql="update quiz_result set p1_responses='".$p1_responses."', p2_responses='".$p2_responses."',is_p1_correct='".$is_p1_correct."',is_p2_correct='".$is_p2_correct."',p1_time_taken='".$time."',p2_time_taken='".$ideal_time."' where test_id='".$test_id."' and questions_ids='".$question_id."'";

 mysql_query($sql,$con);
}
else{
    $sql="update quiz_result set p1_responses='".$p1_responses."', p2_responses=1,is_p1_correct='".$is_p1_correct."',is_p2_correct='".$is_p2_correct."',p1_time_taken='".$time."',p2_time_taken='".$ideal_time."' where test_id='".$test_id."' and questions_ids='".$question_id."'";    
 mysql_query($sql,$con);
    
}


echo $sql;

?>