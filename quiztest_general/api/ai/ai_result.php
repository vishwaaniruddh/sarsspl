<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




// $userid=$_POST['userid'];
// $userid=88;
// $testid=761;
$testid=$_POST['testid'];

$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");


while($sql_result=mysqli_fetch_assoc($sql)){
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


$up_sql="update quiz_result set player_won='".$result."', points='".$points."' where id='".$testid."'";
echo $up_sql;
// echo "update quiz_result set player_won='".$result."', points='".$points."' where id='".$testid."'";
mysqli_query($con,$up_sql);


?>