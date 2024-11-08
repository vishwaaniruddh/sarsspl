<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $testid=939;
// $userid=85;

$testid=$_POST['testid'];
$userid=$_POST['userid'];


// $testid=4775;
// $userid=163;


$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
$sql_result=mysql_fetch_assoc($sql);

$winner=$sql_result['player_won'];

 if($userid==$sql_result['p1']){
  
$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
$sql_result=mysql_fetch_assoc($sql);


// get Opp Name
$ai=$sql_result['p2'];
$ai = preg_replace('/[^0-9]/', '', $ai);
$opp_name=ai_player_name($ai);
    
// end

    
    $q_sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
    
    $q_result=mysql_fetch_assoc($q_sql);
    $q=$q_result['questions_ids'];
    $qarr = explode (",", $q);
    
    $opp_percentage=$q_result['p2_correct_count'].'0%';
    $my_percentage=$q_result['p1_correct_count'].'0%';
    


    
    $data[]=['winnerid'=>$winner,'oppname'=>$opp_name,'oppid'=>$sql_result['p2'],'opp_percentage'=>$opp_percentage,'my_percentage'=>$my_percentage];
         
         
    for($i=0;$i<10;$i++){
        
        $ques_sql=mysql_query("SELECT * from quiztest where srno='".$qarr[$i]."'",$con);
        
        $ques_sql_result=mysql_fetch_assoc($ques_sql);
        
        $mcq=$ques_sql_result['mcq'];
        $ans=$ques_sql_result['final_ans'];
        $ans_string=$ques_sql_result[$ans];
        
// get questions key
$qid=$q_result['questions_ids'];
$p1_qid_arr = explode (",", $qid);


// $q_key = array_search ($questionid, $p1_qid_arr);

//get response1 key
$aid1=$q_result['p1_responses'];
$aid_arr1 = explode (",", $aid1);  


//get response2 key
$aid=$q_result['p2_responses'];
$aid_arr = explode (",", $aid);  

// $a_key = array_search ($response, $aid_arr);
// $correct_answer=$aid_arr[$q_key];

        
$questions=array("mcq"=>$mcq,"ans"=>$ans,'ans_string'=>$ans_string,'opp_ans'=>$aid_arr[$i],'my_ans'=>$aid_arr1[$i]);


    
$data[]=['data'=>$questions];


    }
     
    



       
    echo json_encode($data);
    
   }
    
    
if($userid==$sql_result['p2']){
    
      
$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
$sql_result=mysql_fetch_assoc($sql);

// get Opp Name
$get_opp_name_sql=mysql_query("SELECT * from quiz_regdetails where id='".$sql_result['p1']."'",$con);
$get_opp_name_sql_result=mysql_fetch_assoc($get_opp_name_sql);
$opp_name=$get_opp_name_sql_result['name'].' '.$get_opp_name_sql_result['lname'];    
// end


$q_sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);

$q_result=mysql_fetch_assoc($q_sql);
    $q=$q_result['questions_ids'];
    $qarr = explode (",", $q);
    
    
    //  $opp_percentage=$q_result['p2_correct_count'].'0%';
    // $my_percentage=$q_result['p1_correct_count'].'0%';
    
    
            $opp_percentage=$q_result['p1_correct_count'].'0%';
    $my_percentage=$q_result['p2_correct_count'].'0%';

     $data[]=['winnerid'=>$winner,'oppname'=>$opp_name,'oppid'=>$sql_result['p1'],'opp_percentage'=>$opp_percentage,'my_percentage'=>$my_percentage];
     
 
         
    for($i=0;$i<10;$i++){
        
        $ques_sql=mysql_query("SELECT * from quiztest where srno='".$qarr[$i]."'",$con);
        
        $ques_sql_result=mysql_fetch_assoc($ques_sql);
        
        $mcq=$ques_sql_result['mcq'];
        $ans=$ques_sql_result['final_ans'];
          $ans_string=$ques_sql_result[$ans];

        
    // get questions key
    $qid=$q_result['questions_ids'];
    $p1_qid_arr = explode (",", $qid);
    
    
    // $q_key = array_search ($questionid, $p1_qid_arr);
    
    //get response1 key
    $aid1=$q_result['p1_responses'];
    $aid_arr1 = explode (",", $aid1);  


    //get response2 key
    $aid=$q_result['p2_responses'];
    $aid_arr = explode (",", $aid);  

    // $a_key = array_search ($response, $aid_arr);

    // $correct_answer=$aid_arr[$q_key];
        $questions=array("mcq"=>$mcq,"ans"=>$ans,'ans_string'=>$ans_string,'opp_ans'=>$aid_arr[$i],'my_ans'=>$aid_arr1[$i]);
        $data[]=['data'=>$questions];


    }
   



     
     echo json_encode($data);
    }
    
?>