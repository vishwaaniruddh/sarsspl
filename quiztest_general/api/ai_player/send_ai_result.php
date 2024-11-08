<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




$testid=$_POST['testid'];
// $testid=5392;
    //mysqli_query($con,"update quiz_result set p1_status=1, p1_status_time=now() where id='".$testid."'");
    //mysqli_query($con,"update quiz_result set p2_status=1, p2_status_time=now() where id='".$testid."'");


$sql=mysqli_query($con,"select * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);
$subject=$sql_result['subject'];
$ai_player=$sql_result['p2'];
$ai_player = preg_replace('/[^0-9]/', '', $ai_player);



 $state="update ai_players set is_busy=0 where id='".$ai_player."'";
            mysqli_query($con,$state);
            
$data=$_POST['response'];
  
if(isset($_POST['response']))
{
    $data=$_POST['response'];
    $data=json_decode($data,true);
    // $testid=753;
    $topic=$_POST['topic'];
    $time=0;
    $opp_time=0;
    $count1=0;
    $count2=0;
    foreach($data as $mainkey=>$mainvalue){
        $qid[]= $mainvalue['qid'];
        $final_ansa[]=$mainvalue['final_ans'];
        $sub_topic[]=$mainvalue['sub_topic'];
        $ansa[]=$mainvalue['ans'];
        $opp_ansa[]=$mainvalue['opp_ans'];
        
        $final_ans=$mainvalue['final_ans'];
        $ans=$mainvalue['ans'];
        $opp_ans=$mainvalue['opp_ans'];

        if($ans==$final_ans){
            $time+=$mainvalue['time']; 
            $count1++;
        }
    if($opp_ans==$final_ans){
        $opp_time+=$mainvalue['OppTime'];
        $count2++;
    }
}
$qid=json_encode($qid);
$qid=str_replace( array('[',']','"') , ''  , $qid);
// $topic=json_encode($topic);

$sub_topic=json_encode($sub_topic);
$sub_topic=str_replace( array('[',']','"') , ''  , $sub_topic);

$final_ansa=json_encode($final_ansa);
$final_ansa=str_replace( array('[',']','"') , ''  , $final_ansa);

$ansa=json_encode($ansa);
$ansa=str_replace( array('[',']','"') , ''  , $ansa);

$time=json_encode($time);
$time=str_replace( array('[',']','"') , ''  , $time);





$opp_ansa=json_encode($opp_ansa);
$opp_ansa=str_replace( array('[',']','"') , ''  , $opp_ansa);

$opp_time=json_encode($opp_time);
$opp_time=str_replace( array('[',']','"') , ''  , $opp_time);


$sql="update quiz_result set questions_ids='".$qid."' ,topic_ids='".$topic."', subtopic_ids='".$sub_topic."',p1_responses='".$ansa."',p2_responses='".$opp_ansa."',answers='".$final_ansa."', p1_correct_count='".$count1."',p2_correct_count='".$count2."',p1_time_taken='".$time."',p2_time_taken='".$opp_time."' where id='".$testid."'";

mysqli_query($con,$sql);



$sql=mysqli_query($con,"select * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);

if($count1>$count2){
    $result=$sql_result['p1'];
    
}
if($count1<$count2){
    $result=$sql_result['p2'];
    
}

if($count1==$count2){
    if($time>$opp_time){
    $result=$sql_result['p2'];

    }
    if($time<$opp_time){
    $result=$sql_result['p1'];
    }
    if($time==$opp_time){
    $result='Match Drawn';

    }
}

// for leadership points

$match_point=1;
if($result==$sql_result['p1']){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points=$match_point+$count1+$win_point;


// end leadership

// for testing if he has won 3 quiz in same topic in same month
$sql1=mysqli_query($con,"SELECT count(*) FROM quiz_result WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p1='".$sql_result['p1']."' and player_won='".$sql_result['p1']."' and topic_ids='".$topic."'");

$sql_result1=mysqli_fetch_row($sql1);

$cnt=$sql_result1[0];

if($cnt<3){
    $date=date("Y-m-d");
    
    $update_leaderboard=mysqli_query($con,"update quiz_result set is_count_points1=1 where id='".$testid."'");
 mysqli_query($con,"insert into leaderboards values('".$sql_result['p1']."','".$testid."','".$points."','".$subject."','".$date."')");
}


$up_sql="update quiz_result set player_won='".$result."', points1='".$points."' where id='".$testid."'";
// echo $up_sql;
mysqli_query($con,$up_sql);
} else {
  
  echo json_encode('0');
}


?>