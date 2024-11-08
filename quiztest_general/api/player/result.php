<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$testid=$_POST['testid'];
$userid=$_POST['userid'];

$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);

/*if($userid == $sql_result['p1'] && $sql_result['p1_status'] == 0){
    mysqli_query($con,"update quiz_result set p1_status=1, p1_status_time=now() where id='".$testid."'");
} else if($userid == $sql_result['p2'] && $sql_result['p2_status'] == 0) {
    mysqli_query($con,"update quiz_result set p2_status=1, p2_status_time=now() where id='".$testid."'");
}*/


$subject=$sql_result['subject'];
           
        $count1=$sql_result['p1_correct_count'];
         $count2=$sql_result['p2_correct_count'];
        $time=$sql_result['p1_time_taken'];

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

$points1=$match_point+$count1+$win_point;

if($result==$sql_result['p2']){
$win_point=5;    
}
 else {
    $win_point=0;
}

$points2=$match_point+$count2+$win_point;


// end leadership



//$sql=mysqli_query($con,"SELECT topic_ids FROM quiz_result WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and p1='".$userid."' and topic_ids='".$sql_result['topic_ids']."'");
$sql1=mysqli_query($con,"SELECT count(*) FROM quiz_result WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE()) and (p1='".$userid."' OR p2='".$userid."') and player_won='".$userid."' and topic_ids='".$topic."'");

$sql_result1=mysqli_fetch_row($sql1);

$cnt=$sql_result1[0];


/*
$array=array();
while($sql_result1=mysqli_fetch_assoc($sql)){
    
     if($sql_result['topic_ids']){
         $array[]=$sql_result['topic_ids'];
 
     }

    
}


 $vals = array_count_values($array);


$topic=$array[0];

*/

if($cnt<3){
     $date=date("Y-m-d");
    if($userid==$sql_result['p1']){
    
    $update_leaderboard=mysqli_query($con,"update quiz_result set is_count_points1=1 where id='".$testid."'");
 mysqli_query($con,"insert into leaderboards values('".$sql_result['p1']."','".$testid."','".$points1."','".$subject."','".$date."')");
    
    }

     if($userid==$sql_result['p2']){
    
    $update_leaderboard=mysqli_query($con,"update quiz_result set is_count_points2=1 where id='".$testid."'");

    mysqli_query($con,"insert into leaderboards values('".$sql_result['p2']."','".$testid."','".$points2."','".$subject."','".$date."')"); 
    }
    
}




$up_sql="update quiz_result set player_won='".$result."' ,points1='".$points1."',points2='".$points2."' where id='".$testid."'";
// echo $up_sql;
mysqli_query($con,$up_sql);



?>