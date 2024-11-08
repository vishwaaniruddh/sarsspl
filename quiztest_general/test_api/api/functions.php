<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');

function get_name($id,$custom){
    
    global $con;

    if($custom==TRUE){
        
        $name_sql=mysql_query("SELECT * from quiz_regdetails where id='".$id."'",$con);
        $name_sql_result=mysql_fetch_assoc($name_sql);
        return  ucfirst($name_sql_result['name'].' '.$name_sql_result['lname']);    

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




function correct_question_string($id){
    
    global $con;
    
    $get_ans=mysql_query("select final_ans from quiztest where srno='".$id."'",$con);
    
    $get_ans_result=mysql_fetch_assoc($get_ans);
    
     $final_ans=$get_ans_result['final_ans'];
     
     $get_correct_ans_string=mysql_query("select '".$final_ans."' from quiztest where srno='".$id."'",$con);
     $get_correct_ans_string_result=mysql_fetch_assoc($get_correct_ans_string);
     
     return $get_correct_ans_string_result[$final_ans];
     
}

function is_image($id){
    
    global $con;
    
    $is_image_sql=mysql_query("select imgf from quiztest where srno='".$id."'",$con);
    
  
    $is_image_sql_result=mysql_fetch_assoc($is_image_sql);
    
    if($is_image_sql_result['imgf']){
        return '1';
    }
    else{
        return '0';
    }
}

function get_subject($std){

    global $con;
    
    $sql=mysql_query("select distinct(subject) from quiztest where std='".$std."'",$con);
    
    while($result=mysql_fetch_array($sql))
    {
        
    $sub_sql=mysql_query("select id,name from project_catT where id='".$result[0]."'",$con);
    
    $sub_result=mysql_fetch_assoc($sub_sql);
    $data[]=['id'=>$sub_result['id']]; 
 } 
 echo json_encode($data);
}

function get_all_topics($subid){
    $url = 'http://sarmicrosystems.in/quiztest_general/api/get_topics.php';
    $data = array('sub' => $subid);
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        echo '0';
    }
    else{
    $result=json_decode($result);
    for($i=0;$i<sizeof($result);$i++){
        
        $topicid[]= $result[$i]->id ;
        }
    }
    return json_encode($topicid);    
}


function ai_player_name($id){
    global $con;
    $sql=mysql_query("select * from ai_players where id='".$id."'",$con);
    $sql_result=mysql_fetch_assoc($sql);
    return ucfirst($sql_result['fname'].' '.$sql_result['lname']);    
}

function get_username($userid){
    global $con;
    $sql=mysql_query("select username from quiz_login where user_id='".$userid."'",$con);
    $sql_result=mysql_fetch_assoc($sql);
    $username=$sql_result['username'];
    return $username;  
} ?>