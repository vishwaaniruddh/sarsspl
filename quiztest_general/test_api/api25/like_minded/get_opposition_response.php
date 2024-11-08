<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// test
// $testid=908;
// $userid=85;
// $questionid=16076;
// end


// enable for live reponses
$testid=$_POST['testid'];
$userid=$_POST['userid'];
$questionid=$_POST['qid'];
// end




$sql=mysql_query("SELECT * FROM quiz_result where id='".$testid."'",$con);
$get_result=mysql_fetch_assoc($sql);

    // set user id
    $player=$get_result['p1'];
    
    if($player==$userid){
        
        $player1=$player;
        
        
        
// get questions key
$qid=$get_result['questions_ids'];
$p1_qid_arr = explode (",", $qid);
$q_key = array_search ($questionid, $p1_qid_arr);

//get response key
$aid=$get_result['p2_responses'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);

$correct_answer=$aid_arr[$q_key];
    
    
    if(empty($correct_answer)){
        echo -1;
    }


        // get correct count
        $correct_count=$get_result['p2_correct_count'];
        
        if(empty($correct_count)){
            echo 0;
        }
        else{
            echo $correct_count;            
        }

    
    }
    else{
        
    $player2=$userid;
    
    
    // get questions key
$qid=$get_result['questions_ids'];
$p1_qid_arr = explode (",", $qid);
$q_key = array_search ($questionid, $p1_qid_arr);

//get response key
$aid=$get_result['p1_responses'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);

    $correct_answer=$aid_arr[$q_key];
    
    if(empty($correct_answer)){
        echo -1;
    }
    
    // get correct count
    $correct_count=$get_result['p1_correct_count'];
    
           if(empty($correct_count)){
            echo 0;
        }
        else{
            echo $correct_count;            
        }

      
    }



?>