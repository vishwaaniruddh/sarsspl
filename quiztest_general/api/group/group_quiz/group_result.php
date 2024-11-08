<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$testid=$_POST['testid'];
$groupid=$_POST['groupid'];
  
  
//   $testid=4269;
// $groupid=58;


$sql_points=mysqli_query($con,"select * from quiz_result where id='".$testid."'");
$sql_points_result=mysqli_fetch_assoc($sql_points);

$p1=$sql_points_result['p1'];
$p2=$sql_points_result['p2'];

$count1=$sql_points_result['p1_correct_count'];
$time=$sql_points_result['p1_time_taken'];

$count2=$sql_points_result['p2_correct_count'];
$opp_time=$sql_points_result['p2_time_taken'];


if($count1>$count2){
    $result=$p1;
}
else{
    $result=$p2;
}


if($count1==$count2){
    
    if($time > $opp_time){
        $result=$p1;
    }
    
    else if($time < $opp_time){
        $result=$p2;
    }
    else if($time == $opp_time){
        $result='Draw';
    }
    
}



// for leadership points

$match_point=1;
if($result==$sql_points_result['p1']){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points1=$match_point+$count1+$win_point;

if($result==$sql_points_result['p2']){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points2=$match_point+$count2+$win_point;


// end leadership


$up_sql="update quiz_result set player_won='".$result."' ,points1='".$points1."',points2='".$points2."' where id='".$testid."'";
// echo $up_sql;
mysqli_query($con,$up_sql);











$send_sql=mysqli_query($con,"select * from quiz_result where id='".$testid."'");
$send_sql_result=mysqli_fetch_assoc($send_sql);


  // set groupid for group1 or group2

        $group1=$send_sql_result['p1'];
        $group2=$send_sql_result['p2'];
        $winner=$send_sql_result['player_won'];
        
         $group1 = preg_replace('/[^0-9]/', '', $group1);
         $group2 = preg_replace('/[^0-9]/', '', $group2);
         $winner = preg_replace('/[^0-9]/', '', $winner);


if($groupid==$group1){

    $count=$send_sql_result['p1_correct_count'];
    $groupname=group_name($group1);
    $oppcount=$send_sql_result['p2_correct_count'];
    $oppgroupname=group_name($group2);

    $data=['self_count'=>$count,'self_groupName'=>$groupname,'opp_count'=>$oppcount,'opp_groupName'=>$oppgroupname,'winner'=>$winner];
    
    echo json_encode($data);
}
else{
    $count=$send_sql_result['p2_correct_count'];
    $groupname=group_name($group2);
    $oppcount=$send_sql_result['p1_correct_count'];
    $oppgroupname=group_name($group1);

    $data=['self_count'=>$count,'self_groupName'=>$groupname,'opp_count'=>$oppcount,'opp_groupName'=>$oppgroupname,'winner'=>$winner];

        echo json_encode($data);
}


//self count ,self groupname, oppp count, opp groupname
?>



