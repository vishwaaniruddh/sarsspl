<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$testid=$_POST['testid'];



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

mysql_query($sql,$con);



if($count1>$count2){
    $result='player1';
    
}
if($count1<$count2){
    $result='player2';
    
}

if($count1==$count2){
    if($time>$opp_time){
        $result='player2';

    }
    if($time<$opp_time){
    $result='player1';

    }
    if($time==$opp_time){
    $result='Match Drawn';

    }
}

// for leadership points

$match_point=1;
if($result=='player1'){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points=$match_point+$count1+$win_point;


// end leadership


$up_sql="update quiz_result set player_won='".$result."', points1='".$points."' where id='".$testid."'";
// echo $up_sql;
mysql_query($up_sql,$con);
} else {
    
// $userid=$_POST['userid'];
// $userid=88;
// $testid=761;
$testid=$_POST['userid'];

$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);


while($sql_result=mysql_fetch_assoc($sql)){
$count1=$sql_result['p1_correct_count'];
$count2=$sql_result['p2_correct_count'];
$time=$sql_result['p1_time_taken'];
$opp_time=$sql_result['p2_time_taken'];

}

if($count1>$count2){
    $result='player1';
    
}
if($count1<$count2){
    $result='player2';
    
}

if($count1==$count2){
    if($time>$opp_time){
        $result='player2';

    }
    if($time<$opp_time){
    $result='player1';

    }
    if($time==$opp_time){
    $result='Match Drawn';

    }
}

// for leadership points

$match_point=1;
if($result=='player1'){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points=$match_point+$count1+$win_point;


// end leadership


$up_sql="update quiz_result set player_won='".$result."', points1='".$points."' where id='".$testid."'";


// echo $up_sql;

// echo "update quiz_result set player_won='".$result."', points='".$points."' where id='".$testid."'";
mysql_query($up_sql,$con);


}


?>