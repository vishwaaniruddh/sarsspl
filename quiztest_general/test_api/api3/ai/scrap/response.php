<?php
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');



// $test_id=$_POST['test_id'];

// $question_id=$_POST['qid'];
// $subtopic_id=$_POST['sub_topic'];
// $p1_responses=$_POST['p1_response'];
// $p2_responses=$_POST['p2_response'];

// $time1=$_POST['time1'];
// $time2=$_POST['time2'];

$time1=19;
$time2=15;
$p1_responses='d';
$p2_responses='c';
$question_id=8760;
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



// $last_count=mysql_query("SELECT * FROM player where test_id='".$test_id."' and questions_ids='".$question_id."'",$con);


$last_count=mysql_query("SELECT * FROM player where test_id='".$test_id."' ORDER BY id DESC",$con);

$count_result=mysql_fetch_assoc($last_count);

$count=$count_result['count']+1;

$correct=(70*($count))/100;

$getsql=mysql_query("SELECT * FROM player where test_id='".$test_id."' and questions_ids='".$question_id."'",$con);


$get_result=mysql_fetch_assoc($getsql);
$get_count=$get_result['count'];
$p2_responsesa=$get_result['answers'];


echo $p1_responses;
echo '<br>'.$get_result['answers'];


if($p1_responses==$get_result['answers']){
    $is_p1_correct='yes';
    
}
if($p1_responses!=$get_result['answers'] ){
    $is_p1_correct='no';

}


if($p2_responses==$get_result['answers']){
    $is_p2_correct='yes';
}
if($p2_responses!=$get_result['answers']){
    $is_p2_correct='no';    
}




$sql="update player set p1_responses='".$p1_responses."', p2_responses='".$p2_responses."',is_p1_correct='".$is_p1_correct."',is_p2_correct='".$is_p2_correct."',p1_time_taken='".$time1."',p2_time_taken='".$time2."' where test_id='".$test_id."' and questions_ids='".$question_id."'";

 mysql_query($sql,$con);




// echo $sql;

?>