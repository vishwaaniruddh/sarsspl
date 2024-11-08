<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$groupid=$_POST['groupid'];
$testid=$_POST['testid'];
$std=$_POST['std'];
$topic=$_POST['topic'];


$topic_name=get_topic_name($topic);

error_reporting(0);

// $groupid=58;
// $testid=4186;


// echo correct_answer_string(10199);

// return;




$sql=mysql_query("SELECT * FROM quiz_result where id='".$testid."'",$con);
$get_result=mysql_fetch_assoc($sql);

$std=$get_result['standard'];

        $group1=$get_result['p1'];
        $group2=$get_result['p2'];
        $winner=$get_result['player_won'];

        
        $group1 = preg_replace('/[^0-9]/', '', $group1);
        $group2 = preg_replace('/[^0-9]/', '', $group2);
        $winner = preg_replace('/[^0-9]/', '', $winner);
        


if($groupid==$group1){


$group1_name = group_name($group1);
$group2_name = group_name($group2);
$mycount = $get_result['p1_correct_count'];
$oppcount = $get_result['p2_correct_count'];


$q_id = $get_result['questions_ids'];

$q_arr=explode(',',$q_id);

$selected_ans=$get_result['p1_responses'];
$selected_ans_arr=explode(',',$selected_ans);


$opp_selected_ans=$get_result['p2_responses'];
$opp_selected_ans_arr=explode(',',$opp_selected_ans);

$i=0;

foreach($q_arr as $key => $val){
   

    $qid=$val;
    
    // $is_image=is_image($qid);
        
        
        
    if($get_result['imgf']){
      $question_string="http://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$get_result["imgf"];
      $is_image='1';
}
else{
      $question_string=$get_result['mcq'];
      $is_image='0';
}
   
   
   
    $question_string=question_string($qid);
    
    $correct_option=get_correct_ans($qid);
    $get_correct_string=mysql_query("select $correct_option from quiztest where srno='".$qid."'",$con);
    $get_correct_string_result=mysql_fetch_assoc($get_correct_string);
    $correct_string=$get_correct_string_result[$correct_option];
    
    
    
    $mygroupSelectedOption=$selected_ans_arr[$i];
    $mygroupSelectedOption=$selected_ans_arr[$i];
    
    $oppGroupSelectedOption=$opp_selected_ans_arr[$i];
    
    
    $get_selected_ans_string=mysql_query("select $mygroupSelectedOption from quiztest where srno='".$qid."'",$con);
    $get_correct_ans_string_result=mysql_fetch_assoc($get_selected_ans_string);
    $selected_string=$get_correct_ans_string_result[$mygroupSelectedOption];


$opp_string_sql=mysql_query("select $oppGroupSelectedOption from quiztest where srno='".$qid."'",$con);

    $opp_string_sql_result=mysql_fetch_assoc($opp_string_sql);
    $oppString=$opp_string_sql_result[$oppGroupSelectedOption];
    
    


    $sql=mysql_query("select * from group_response where groupid='".$group1."' and testid='".$testid."' and question_id='".$qid."'",$con);
    
    $mygroupresponse='';            
        
        while($sql_result=mysql_fetch_assoc($sql)){
            
        
            $player=$sql_result['player'];
            $response=$sql_result['responses'];
            
            
            $get_string=mysql_query("select $response from quiztest where srno='".$qid."'",$con);
            $get_string_result=mysql_fetch_assoc($get_string);
            
            $ans_string=$get_string_result[$response];
            
            
            $mygroupresponse[]=[
                'name'=>get_name($player,TRUE),
                'player'=>$player,
                'response'=>$response,
                'ans_string'=>$ans_string
            
            ];
        }
        
        $ques[]=['qid'=>$qid,'is_image'=>$is_image,'qstring'=>$question_string,'correct_option'=>$correct_option,'correct_string'=>$correct_string,'mygroupSelectedOption'=>$mygroupSelectedOption,'oppGroupSelected'=>$oppGroupSelectedOption,'oppString'=>$oppString,'selected_string'=>$selected_string,'group_response'=>$mygroupresponse];
  
    $i++;
}


$data[]=['myGroupName'=>$group1_name,'myGroupId'=>$group1,'oppGroupName'=>$group2_name,'oppGroupId'=>$group2,'myGroupCount'=>$mycount,'oppGroupCount'=>$oppcount,'winner'=>$winner,'ques'=>$ques];
 
    echo json_encode($data);
}











else{
    
    $group2_name = group_name($group2);
$group1_name = group_name($group1);
$mycount = $get_result['p2_correct_count'];
$oppcount = $get_result['p1_correct_count'];


$q_id = $get_result['questions_ids'];

$q_arr=explode(',',$q_id);

$selected_ans=$get_result['p2_responses'];
$selected_ans_arr=explode(',',$selected_ans);


$opp_selected_ans=$get_result['p1_responses'];
$opp_selected_ans_arr=explode(',',$opp_selected_ans);

$i=0;

foreach($q_arr as $key => $val){
   

    $qid=$val;
    
    
           
    if($get_result['imgf']){
      $question_string="http://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$get_result["imgf"];
      $is_image='1';
}
else{
      $question_string=$get_result['mcq'];
      $is_image='0';
}
   
   
   
    //  $is_image=is_image($qid);
    $question_string=question_string($qid);
   
   
    
    $correct_option=get_correct_ans($qid);
    $get_correct_string=mysql_query("select $correct_option from quiztest where srno='".$qid."'",$con);
    $get_correct_string_result=mysql_fetch_assoc($get_correct_string);
    $correct_string=$get_correct_string_result[$correct_option];
    
    
    
    $mygroupSelectedOption=$selected_ans_arr[$i];
    $mygroupSelectedOption=$selected_ans_arr[$i];
    
    $oppGroupSelectedOption=$opp_selected_ans_arr[$i];
    
    
    $get_selected_ans_string=mysql_query("select $mygroupSelectedOption from quiztest where srno='".$qid."'",$con);
    $get_correct_ans_string_result=mysql_fetch_assoc($get_selected_ans_string);
    $selected_string=$get_correct_ans_string_result[$mygroupSelectedOption];


$opp_string_sql=mysql_query("select $oppGroupSelectedOption from quiztest where srno='".$qid."'",$con);

    $opp_string_sql_result=mysql_fetch_assoc($opp_string_sql);
    $oppString=$opp_string_sql_result[$oppGroupSelectedOption];
    
    


    $sql=mysql_query("select * from group_response where groupid='".$group2."' and testid='".$testid."' and question_id='".$qid."'",$con);
    
    $mygroupresponse='';            
        
        while($sql_result=mysql_fetch_assoc($sql)){
            
            $player=$sql_result['player'];
            $response=$sql_result['responses'];
            
            
            $get_string=mysql_query("select $response from quiztest where srno='".$qid."'",$con);
            $get_string_result=mysql_fetch_assoc($get_string);
            
            $ans_string=$get_string_result[$response];
            
            
            $mygroupresponse[]=[
                'name'=>get_name($player,TRUE),
                'player'=>$player,
                'response'=>$response,
                'ans_string'=>$ans_string
            
            ];
        }
        
        $ques[]=['qid'=>$qid,'is_image'=>$is_image,'qstring'=>$question_string,'correct_option'=>$correct_option,'correct_string'=>$correct_string,'mygroupSelectedOption'=>$mygroupSelectedOption,'oppGroupSelected'=>$oppGroupSelectedOption,'oppString'=>$oppString,'selected_string'=>$selected_string,'group_response'=>$mygroupresponse];
  
    $i++;
}


$data[]=['myGroupName'=>$group2_name,'myGroupId'=>$group2,'oppGroupName'=>$group1_name,'oppGroupId'=>$group1,'myGroupCount'=>$mycount,'oppGroupCount'=>$oppcount,'winner'=>$winner,'ques'=>$ques];
 
    echo json_encode($data);
}



?>