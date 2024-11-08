<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');



$userid=$_POST['userid'];
// $userid=166;
$testid=$_POST['testid'];
// $subjectid=3;
$tot_cnt = 0;
$data = [];
/*
if($testid>0){
    $sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' and p2='AI' and id='".$testid."' ORDER by created_at DESC");
    if(mysqli_num_rows($sql)>0){
        while ($sql_result=mysqli_fetch_assoc($sql)) {
            $p2=$sql_result['p2'];
            $p1_correct_count=$sql_result['p1_correct_count'];
            $p2_correct_count=$sql_result['p2_correct_count'];
            $player_won=$sql_result['player_won'];
            
            $data[]=['testid'=>$testid,'p2'=>$p2,'name'=>'Artificial intelligence','p1_correct_count'=>$p1_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p2_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp];        

        }
    }
    
    
}

echo json_encode($data); */


$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);

$winner=$sql_result['player_won'];

 if($userid==$sql_result['p1']){
  
$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);


// get Opp Name
$ai=$sql_result['p2'];
$ai = preg_replace('/[^0-9]/', '', $ai);
$opp_name=ai_player_name($ai);
    
// end

    
    $q_sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
    
    $q_result=mysqli_fetch_assoc($q_sql);
    $q=$q_result['questions_ids'];
    $qarr = explode (",", $q);
    
    $p1_responses=$q_result['p1_responses'];
    $p1_responses_arr = explode (",", $p1_responses);
    
    $opp_percentage=$q_result['p2_correct_count'].'0%';
    $my_percentage=$q_result['p1_correct_count'].'0%';
    
    $opp_score=$q_result['p2_correct_count'];
    $my_score=$q_result['p1_correct_count'];
    
    $opp_time=$q_result['p2_taken_time'];
    $my_time=$q_result['p1_taken_time'];

    
    $data[]=['winnerid'=>$winner,'oppname'=>$opp_name,'oppid'=>$sql_result['p2'],'opp_percentage'=>$opp_percentage,'my_percentage'=>$my_percentage,
             'my_score' => $my_score, 'opp_score'=>$opp_score,'my_time' => $my_time, 'opp_time'=>$opp_time];
         
         
    for($i=0;$i<10;$i++){
        
        $ques_sql=mysqli_query($con,"SELECT * from quiztest where srno='".$qarr[$i]."'");
        
        $ques_sql_result=mysqli_fetch_assoc($ques_sql);
        $id=$ques_sql_result['id'];
        $sub_topic_id=$ques_sql_result['sub_topic'];
        $mcq=$ques_sql_result['mcq'];
        $ans=$ques_sql_result['final_ans'];
        $ans_string=$ques_sql_result[$ans];
        
        $imgf=$ques_sql_result['imgf'];
        $is_img = false;
        if($imgf!=''){
            $is_img = true;
        }
        
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
$a = $ques_sql_result['a'];
$b = $ques_sql_result['b'];
$c = $ques_sql_result['c'];
$d = $ques_sql_result['d'];
$options = array("A"=>$a,"B"=>$b,"C"=>$c,"D"=>$d);

$given_ans = $p1_responses_arr[$i];

        
$questions=array("id"=>$id,"q"=>$mcq,"IsImg"=>$is_img,"subTopicId"=>$sub_topic_id,"final_ans"=>$ans,"ideal_time"=>"30","options"=>$options,"given_ans"=>$given_ans,'ans_string'=>$ans_string,'opp_ans'=>$aid_arr[$i],'my_ans'=>$aid_arr1[$i]);


    
$data[]=['data'=>$questions];


    }
     
    



       
    echo json_encode($data);
    
   }
    
    
if($userid==$sql_result['p2']){
    
      
$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);

// get Opp Name
$get_opp_name_sql=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$sql_result['p1']."'");
$get_opp_name_sql_result=mysqli_fetch_assoc($get_opp_name_sql);
$opp_name=$get_opp_name_sql_result['name'].' '.$get_opp_name_sql_result['lname'];    
// end


$q_sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");

$q_result=mysqli_fetch_assoc($q_sql);
    $q=$q_result['questions_ids'];
    $qarr = explode (",", $q);
    
    
    //  $opp_percentage=$q_result['p2_correct_count'].'0%';
    // $my_percentage=$q_result['p1_correct_count'].'0%';
    
    
            $opp_percentage=$q_result['p1_correct_count'].'0%';
    $my_percentage=$q_result['p2_correct_count'].'0%';

     $data[]=['winnerid'=>$winner,'oppname'=>$opp_name,'oppid'=>$sql_result['p1'],'opp_percentage'=>$opp_percentage,'my_percentage'=>$my_percentage];
     
 
         
    for($i=0;$i<10;$i++){
        
        $ques_sql=mysqli_query($con,"SELECT * from quiztest where srno='".$qarr[$i]."'");
        
        $ques_sql_result=mysqli_fetch_assoc($ques_sql);
        
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