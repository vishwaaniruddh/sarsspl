<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');



$data=$_POST['response'];


$data=json_decode($data,true);

foreach($data as $mainkey=>$mainvalue){

$answer[]= $mainvalue['userid'];
// $given_ans[]=$mainvalue['ans'];
// $sub_topic_ids[]=$mainvalue['sub_topic'];
// $time_taken[]=$mainvalue['time'];
// $qid=$_POST['qid'];
}

echo json_encode($answer);
return;
// $testid
// $topic
// $qid
// $sub_topic
// $final_ans
// $ans
// $time
// $opp_ans
// $opp_time


// $update_sql="UPDATE  quiz_result set p1='".$userid."' ,topic_ids='".$topic."',answers='".$final_ans."', p1_responses='".$final_given_ans."', p2_responses='".$final_ans."' ,p1_correct='".$count_p1."',p2_correct='".$p2_correct."', p1_time_taken='".$final_time_taken."', p2_time_taken='".$p2_time_taken."'  WHERE id='".$testid."'";
        
        
        

//         if (mysql_query($update_sql,$con )) {
//             // echo "Updated successfully";
//         } else {
//             echo "Error: " . $update_sql . "<br>" . mysql_error($con);
//         }

}