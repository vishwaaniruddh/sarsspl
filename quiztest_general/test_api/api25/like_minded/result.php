<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $testid=939;
$testid=$_POST['testid'];

$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
$sql_result=mysql_fetch_assoc($sql);




           
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


$up_sql="update quiz_result set player_won='".$result."' ,points1='".$points1."',points2='".$points2."' where id='".$testid."'";
// echo $up_sql;
mysql_query($up_sql,$con);



?>