<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');


$test_id=2;
$count1=$count2=0;

$query="SELECT * from player where test_id='".$test_id."'";
$sql=mysql_query($query,$con);
// $result=mysql_fetch_assoc($sql);

    while ($result=mysql_fetch_assoc($sql)) {
        
        if($result['is_p1_correct']=='yes'){
            $count1++;
        }
    
        if($result['is_p2_correct']=='yes'){
            $count2++;
        }
        
        if($result['is_p1_correct']=='yes'){
             $p1_time+=$result['p1_time_taken'];
        }
        if($result['is_p2_correct']=='yes'){
             $p2_time+=$result['p2_time_taken'];
        }
    }


echo $p1_time;
echo $p2_time;


if($count1>$count2){
    $result=['winner'=>'player1'];
    echo json_encode($result);
}
if($count1<$count2){
    $result=['winner'=>'player2'];
    echo json_encode($result);
}

if($count1==$count2){
    if($p1_time>$p2_time){
        $result=['winner'=>'player1'];
        echo json_encode($result);
    }
    if($p1_time<$p2_time){
    $result=['winner'=>'player2'];
    echo json_encode($result);
    }
    if($p1_time==$p2_time){
    $result=['Result'=>'Match Drawn'];
    echo json_encode($result);
    }
}
?>

