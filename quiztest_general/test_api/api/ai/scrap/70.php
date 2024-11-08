<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');



$topic=205;
$total=5;
$testid=246;
$desiredLength=10;
$json=json_encode($topic);




// for test id

$last_id=mysql_query("SELECT test_id FROM quiz_result ORDER BY id DESC LIMIT 1",$con);

$get_result=mysql_fetch_assoc($last_id);

if($get_result['test_id']==null || empty($get_result['test_id'])){
$test_id=1;    
}

else{
$test_id=$get_result['test_id']+1;    
}



// end last id search

$topic_in=str_replace( array('[',']','"') , ''  , $json);


$select_subtopic_sql=mysql_query("SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'",$con);  

while ($select_subtopic_sql_result=mysql_fetch_assoc($select_subtopic_sql)) {
    $main_subtopicArray[] =  $select_subtopic_sql_result['sub_topic'];  
}



$newArray = array();
// create a new array with AT LEAST the desired number of elements by joining the array at the end of the new array
while(count($newArray) <= $desiredLength){
    $newArray = array_merge($newArray, $main_subtopicArray);
}

$main_subtopicArray = array_slice($newArray,1, $desiredLength);

for($i=0;$i<$desiredLength;$i++){
    
  $get_sql=mysql_query("select * from quiztest WHERE topic='".$topic."' and sub_topic='".$main_subtopicArray[$i]."' order by rand() ASC LIMIT 1",$con);
    
  $result=mysql_fetch_assoc($get_sql);
    
     $options=array("a"=>$result["a"],"b"=>$result["b"],"c"=>$result["c"],"d"=>$result["d"]);
     
            
                if($options["a"]==$result['final_ans']){
                    $final_ans="a";
                }
                elseif($options["b"]==$result['final_ans']){
                    $final_ans="b";
                }
                elseif($options["c"]==$result['final_ans']){
                    $final_ans="c";
                }
                elseif($options["d"]==$result['final_ans']){
                    $final_ans="d";
                }
                
                
                $ideal_time=$result['ideal_time'];
                  
                  if($ideal_time=='T1'){
                     $ideal_time=30; 
                  }
                  elseif($ideal_time=='T2'){
                     $ideal_time=20;       
                  }
                    elseif($ideal_time=='T3'){
                     $ideal_time=45;       
                  }
                    elseif($ideal_time=='T4'){
                     $ideal_time=60;       
                  }
                  
                  
   
  
  $insert_sql="INSERT INTO quiz_result(p1,p2,count,test_id,questions_ids,topic_ids,subtopic_ids,total_questions,answers,time) VALUES(21,'AI','".$i."',$test_id,'".$result['srno']."','".$topic."','".$main_subtopicArray[$i]."','".$desiredLength."','".$result['final_ans']."','".$ideal_time."')";
  
    mysql_query($insert_sql,$con );
  
  $data[]= ['data'=>['test_id'=>$test_id,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
}

echo json_encode($data);

?>






























<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');





function get_name($id,$custom){
    
    global $con;

    if($custom==TRUE){
        
        $name_sql=mysql_query("SELECT * from quiz_regdetails where id='".$id."'",$con);
        $name_sql_result=mysql_fetch_assoc($name_sql);
        return  $name_sql_result['name'].' '.$name_sql_result['lname'];    

    }
    else{
        
        $name_sql=mysql_query("SELECT * from quiz_regdetails where id='".$id."'",$con);
        $name_sql_result=mysql_fetch_assoc($name_sql);
        return  $name_sql_result['name'];
    }
      
    
}


function get_avatar($id){
    
    global $con;
    
    $avatar_sql=mysql_query("SELECT avatar_id from quiz_regdetails where id='".$id."'",$con);
    $avatar_sql_result=mysql_fetch_assoc($avatar_sql);
    $avatar_id=$avatar_sql_result['avatar_id'];
    
    
    $avatar=mysql_query("SELECT * from avatar where id='".$avatar_id."'",$con);
    $avatar_result=mysql_fetch_assoc($avatar);
    return  $avatar_result['avatar_url'];
}



function group_name($id){
    
    global $con;
        
        $name_sql=mysql_query("SELECT * from groups where id='".$id."'",$con);
        $name_sql_result=mysql_fetch_assoc($name_sql);
        return  $name_sql_result['group_name'];    


    
}

function get_status($id){
    
    global $con;
    
        $status_sql=mysql_query("SELECT * from online where userid='".$id."'",$con);
        $status_result=mysql_fetch_assoc($status_sql);
        
         $status=$status_result['status']; 
        
        if($status>0){
            return $status;
        }
        else{
            return '0';
        }
}


function is_accepted($id,$groupid){

    global $con;
    
        $accepted=mysql_query("SELECT is_accepted from group_ready_notification where member='".$id."' and group_id='".$groupid."'",$con);
        $accepted_result=mysql_fetch_assoc($accepted);
        
        $is_accepted=$accepted_result['is_accepted'];
        
        return $is_accepted;
        
    
}



function group_start_from($groupid){

    global $con;
    
        $created_by=mysql_query("SELECT created_by from group_ready_notification where group_id='".$groupid."'",$con);
        $created_by_result=mysql_fetch_assoc($created_by);
        
        $created_by=$created_by_result['created_by'];
        
        return $created_by;
        
    
}


function get_topic_name($id){
    
    global $con;
    
        $get_topic=mysql_query("SELECT name from project_catT where id='".$id."'",$con);
        
        $get_topic_name=mysql_fetch_assoc($get_topic);
        
        return $get_topic_name['name']; 
    
}


function array_count_values_of($value, $array) {
    
    global $con;
        
        $counts = array_count_values($array);
        
        return $counts[$value];

    
}



function get_correct_ans($id){
    
    global $con;
    
    $get_correct_ans=mysql_query("SELECT final_ans from quiztest where srno='".$id."'",$con);
    $get_correct_ans_result=mysql_fetch_assoc($get_correct_ans);
    
    return $get_correct_ans_result['final_ans'];
    
}


function get_referral_code($id){
    
    global $con;
    
    $get_referral=mysql_query("select username from quiz_login where user_id='".$id."'",$con);
    $get_referral_result=mysql_fetch_assoc($get_referral);
    
    $referral_code=$get_referral_result['username'];
    
    return $referral_code;
}



function get_id($email){
    
    global $con;
    
    $get_id=mysql_query("select id from quiz_regdetails where emailid='".$email."'",$con);
    $get_id_result=mysql_fetch_assoc($get_id);
    
    $id=$get_id_result['id'];
    
    return $id;
}


function get_student_class($id){
    
    global $con;
    
    $getclass=mysql_query("SELECT class from quiz_regdetails where id='".$id."'",$con);
    $getclass_result=mysql_fetch_assoc($getclass);
    
    return $getclass_result['class'];
}


function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range(0, 9));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}


function question_string($id){
    
    global $con;
    
    $get_q_string=mysql_query("select mcq from quiztest where srno='".$id."'",$con);
    
    $get_q_string_result=mysql_fetch_assoc($get_q_string);
    
    return $get_q_string_result['mcq'];
}



function correct_answer_string($id){
    
    global $con;
    
    $final_ans=get_correct_ans($id);
     

if($final_ans=='a'){
    $correct_ans=mysql_query("select a from quiztest where srno='".$id."'",$con);    
         $correct_anst=mysql_fetch_assoc($correct_ans);
     return $correct_anst['a'];
    
}

if($final_ans=='b'){
    $correct_ans=mysql_query("select b from quiztest where srno='".$id."'",$con);    
         $correct_anst=mysql_fetch_assoc($correct_ans);
     return $correct_anst['b'];
    
}
if($final_ans=='c'){
    $correct_ans=mysql_query("select c from quiztest where srno='".$id."'",$con);    
         $correct_anst=mysql_fetch_assoc($correct_ans);
     return $correct_anst['c'];
    
}
if($final_ans=='d'){
    $correct_ans=mysql_query("select d from quiztest where srno='".$id."'",$con);    

         $correct_anst=mysql_fetch_assoc($correct_ans);
     return $correct_anst['d'];
}
     
     
     

     
}



function correct_question_string($id){
    
    global $con;
    
    $get_ans=mysql_query("select final_ans from quiztest where srno='".$id."'",$con);
    
    $get_ans_result=mysql_fetch_assoc($get_ans);
    
     $final_ans=$get_ans_result['final_ans'];
     
     $get_correct_ans_string=mysql_query("select '".$final_ans."' from quiztest where srno='".$id."'",$con);
     $get_correct_ans_string_result=mysql_fetch_assoc($get_correct_ans_string);
     
     return $get_correct_ans_string_result[$final_ans];
     
}


?>

