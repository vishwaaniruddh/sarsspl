<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



$userid=$_POST["userid"];
$testid=$_POST["testid"];
$groupid=$_POST["groupid"];
$time=$_POST["time"];
$question_id=$_POST["qid"];
$index=$_POST["qindex"];
$submit=$_POST["issubmit"]; // , IsTimeEnd?"0":"1")


// $userid=115;
// $testid=3432;
// $groupid=48;
// $time=15;
// $question_id=14538;
// $submit=1;


// $response=1;
// check if its group1 or group2

$check_sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
    
$check_sql_result=mysqli_fetch_assoc($check_sql);

$group1=$check_sql_result['p1'];
$group2=$check_sql_result['p2'];


        $group1 = preg_replace('/[^0-9]/', '', $group1);
        $group2 = preg_replace('/[^0-9]/', '', $group2);




// get questions key
$qid=$check_sql_result['questions_ids'];

$p1_qid_arr = explode (",", $qid);
$q_key = array_search ($question_id, $p1_qid_arr);

//get answers key
$aid=$get_result['answers'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);


 
if($groupid==$group1){
             
        

       
$sql=mysqli_query($con,"select * from group_response where testid='".$testid."' and groupid='".$groupid."' and question_id='".$question_id."'");


while($sql_result=mysqli_fetch_assoc($sql)){
    
    $ans[]=$sql_result['responses'];
    $timea[]=$sql_result['responses'].$sql_result['timetaken'];

    
}

if($submit == 1) {
$a_count=array_count_values_of('a',$ans);
$b_count=array_count_values_of('b',$ans);
$c_count=array_count_values_of('c',$ans);
$d_count=array_count_values_of('d',$ans);


// get the max_count
    $arr = array( 'a' => $a_count, 'b' => $b_count, 'c' => $c_count,'d' => $d_count );
    $keys = array_keys($arr, max($arr));



if(count($keys)==0){
    $response= $keys[0];
}
else{
    $response= $keys[1];
    
    foreach($timea as $key=>$val){
    
        $numbers[] = preg_replace('/[^0-9]/', '', $val);
        $letters[] = preg_replace('/[^a-zA-Z]/', '', $val);    

    }

    $num_keys = array_keys($numbers, max($numbers));
    
    
    $custom_key=$num_keys[0];
    
    $response=$letters[$custom_key];    
        
    }
}
    
    if($submit=="0" || $submit==0){
        $response='z';
    }





$sql_quiz=mysqli_query($con,"SELECT * FROM quiz_result where id='".$testid."'");
$sql_quiz_result=mysqli_fetch_assoc($sql_quiz);


$p1_responses=$sql_quiz_result['p1_responses'];
$p1_responses_arr = explode (",", $p1_responses);  
array_push($p1_responses_arr,$response);
$json= json_encode($p1_responses_arr);
$p1_response=str_replace( array('[',']','"') , ''  , $json);
$p1_response=trim($p1_response,",");



   $update_sql2="UPDATE quiz_result set p1_responses='".$p1_response."' WHERE id='".$testid."'";
   mysqli_query($con,$update_sql2);







$correct=get_correct_ans($question_id);

       $select_sql=mysqli_query($con,"SELECT * from group_result where groupid='".$groupid."' and question_id='".$question_id."' and testid='".$testid."'");
       
       
       
$select_sql_result=mysqli_fetch_assoc($select_sql);


if($response==$correct){
    
    $points=1;

}
else{
    
    $points=0;

}

$final_ans=$select_sql_result['final_ans'];

if(empty($final_ans)){
    

       $insert_sql="INSERT INTO group_result(groupid,testid,question_id,final_ans,timetaken,point) values('".$group1."' ,'".$testid."' ,'".$question_id."' ,'".$response."','".$time."','".$points."')";
       
   
    

    
    if(mysqli_query($con,$insert_sql)){
     
       $count_sql=mysqli_query($con,"SELECT sum(point) as oppcount from group_result where groupid='".$groupid."' and testid='".$testid."'");
       
       $count_sql_result=mysqli_fetch_assoc($count_sql);
        
        echo $count_sql_result['oppcount'];
     
     
    }
    else{
        echo 0;
    }
    
   
}
else{
     echo -1;
    
}

    
}









































else{
  
  
  $sql=mysqli_query($con,"select * from group_response where testid='".$testid."' and groupid='".$groupid."' and question_id='".$question_id."'");



while($sql_result=mysqli_fetch_assoc($sql)){
    
    $ans[]=$sql_result['responses'];
    $timea[]=$sql_result['responses'].$sql_result['timetaken'];

    
}

if($submit == 1) {
$a_count=array_count_values_of('a',$ans);
$b_count=array_count_values_of('b',$ans);
$c_count=array_count_values_of('c',$ans);
$d_count=array_count_values_of('d',$ans);


// get the max_count
    $arr = array( 'a' => $a_count, 'b' => $b_count, 'c' => $c_count,'d' => $d_count );
    $keys = array_keys($arr, max($arr));

if(count($keys)==0){
    $response= $keys[0];
}
else{
    $response= $keys[1];
    
    foreach($timea as $key=>$val){
    
        $numbers[] = preg_replace('/[^0-9]/', '', $val);
        $letters[] = preg_replace('/[^a-zA-Z]/', '', $val);    

    }

    $num_keys = array_keys($numbers, max($numbers));
    
    
    $custom_key=$num_keys[0];
    $response=$letters[$custom_key];    
        
    }
    
}
        
    if($submit=="0" || $submit==0){
    $response='z';
}






$sql_quiz=mysqli_query($con,"SELECT * FROM quiz_result where id='".$testid."'");
$sql_quiz_result=mysqli_fetch_assoc($sql_quiz);


$p2_responses=$sql_quiz_result['p2_responses'];
$p2_responses_arr = explode (",", $p2_responses);  
array_push($p2_responses_arr,$response);
$json= json_encode($p2_responses_arr);
$p2_response=str_replace( array('[',']','"') , ''  , $json);
$p2_response=trim($p2_response,",");



   $update_sql2="UPDATE quiz_result set p2_responses='".$p2_response."' WHERE id='".$testid."'";
   mysqli_query($con,$update_sql2);







  $correct=get_correct_ans($question_id);

$select_sql=mysqli_query($con,"SELECT * from group_result where groupid='".$group2."' and question_id='".$question_id."' and testid='".$testid."'");


$select_sql_result=mysqli_fetch_assoc($select_sql);

$final_ans=$select_sql_result['final_ans'];


if($response==$correct){
    $points=1;
}
else{
    
    $points=0;
}



if(empty($final_ans)){
    
    
        $insert_sql="INSERT INTO group_result(groupid,testid,question_id,final_ans,timetaken,point) values('".$group2."' ,'".$testid."' ,'".$question_id."' ,'".$response."','".$time."','".$points."')";
     

    if(mysqli_query($con,$insert_sql)){
           $count_sql=mysqli_query($con,"SELECT sum(point) as oppcount from group_result where groupid='".$groupid."' and testid='".$testid."'");
       
       $count_sql_result=mysqli_fetch_assoc($count_sql);
        
        echo $count_sql_result['oppcount'];
     
    }
    else{
        echo 0;
    }    

}

else{
    
    echo -1;
}
  
}

?>