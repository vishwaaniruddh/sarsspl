<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



// enable for live reponses
$testid=$_POST['testid'];
$response=$_POST['ans'];
$response_time=$_POST['timetaken'];
$questionid=$_POST['qid'];
$userid=$_POST['userid'];
$standard=$_POST['std'];
$groupid=$_POST['groupid'];
// end

// test
$testid=5415;
$response='b';
$response_time=15;
$questionid=14223;
$userid=94;
// end



$sql=mysqli_query($con,"SELECT * FROM quiz_result where id='".$testid."'");
$get_result=mysqli_fetch_assoc($sql);

$std=$get_result['standard'];

        $group1=$get_result['p1'];
        $group2=$get_result['p2'];
        
        $group1 = preg_replace('/[^0-9]/', '', $group1);
        $group2 = preg_replace('/[^0-9]/', '', $group2);
        

$sql=mysqli_query($con,"SELECT * from group_response where testid='".$testid."' and groupid='".$groupid."'");


if($groupid==$group1){
    
// $player1=$player;

    $p1_responses=$get_result['p1_responses'];
$p1_responses_arr = explode (",", $p1_responses);  
array_push($p1_responses_arr,$response);
$json= json_encode($p1_responses_arr);
$p1_response=str_replace( array('[',']','"') , ''  , $json);
$p1_response=trim($p1_response,",");



// get questions key
$qid=$get_result['questions_ids'];
$p1_qid_arr = explode (",", $qid);
$q_key = array_search ($questionid, $p1_qid_arr);

//get answers key
$aid=$get_result['answers'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);


// get correct count
$correct_count=$get_result['p1_correct_count'];




    // echo $p1_qid_arr[$q_key];    
    $correct_answer=$aid_arr[$q_key];
    
        // get reponse time    
    if($response==$correct_answer){
        
        $p1_time=$get_result['p1_time_taken'];
        
        $updated_p1_time=$p1_time+$response_time;
        
        $correct_count++;
        $update_sql1="UPDATE quiz_result set p1_correct_count='".$correct_count."',p1_time_taken='".$updated_p1_time."' WHERE id='".$testid."'";
        
        
        mysqli_query($con,$update_sql1);
        // echo $update_sql1;    
        // echo $update_sql;        
    }
    
    // echo "UPDATE quiz_result set p1_responses='".$p1_response."' WHERE id='".$testid."'";
$update_sql2="UPDATE quiz_result set p1_responses='".$p1_response."' WHERE id='".$testid."'";
    
    // echo $update_sql2;    
           if(mysqli_query($con,$update_sql2)){
            echo 1;
        }
        else{
            echo 0;
        }
        
    
}

else{
  
    
// $player2=$group1;

$p2_responses=$get_result['p2_responses'];
$p2_responses_arr = explode (",", $p2_responses);  
array_push($p2_responses_arr,$response);
$json= json_encode($p2_responses_arr);
$p2_response=str_replace( array('[',']','"') , ''  , $json);
$p2_response=trim($p2_response,",");


// get questions key
$qid=$get_result['questions_ids'];
$p2_qid_arr = explode (",", $qid);
$q_key = array_search ($questionid, $p2_qid_arr);

//get answers key
$aid=$get_result['answers'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);


// get correct count
$correct_count=$get_result['p2_correct_count'];


// echo $p2_qid_arr[$q_key];    
    $correct_answer=$aid_arr[$q_key];
    
        // get reponse time    
    if($response==$correct_answer){
        
        $p2_time=$get_result['p2_time_taken'];
        $updated_p2_time=$p2_time+$response_time;
        $correct_count++;
                
        $update_sql3="UPDATE quiz_result set  p2_correct_count='".$correct_count."',p2_time_taken='".$updated_p2_time."' WHERE id='".$testid."'";
        
        
        mysqli_query($con,$update_sql3);

    }
    
// echo "UPDATE quiz_result set p2_responses='".$p2_response."' WHERE id='".$testid."'";
    $update_sql4="UPDATE quiz_result set p2_responses='".$p2_response."' WHERE id='".$testid."'";
        
        
        if(mysqli_query($con,$update_sql4)){
            echo 1;
        }
        else{
            echo 0;
        }


}



?>