<?php //include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
include('config.php');

function get_name($id,$custom){
    
    global $con;

    if($custom==TRUE){ 
        
        $name_sql=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$id."'");
        $name_sql_result=mysqli_fetch_assoc($name_sql);
        return  ucfirst($name_sql_result['name'].' '.$name_sql_result['lname']);    

    }
    else{
        
        $name_sql=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$id."'");
        $name_sql_result=mysqli_fetch_assoc($name_sql);
        return  $name_sql_result['name'];
    }
      
    
}


function get_avatar($id){
    
    global $con;
    
    $avatar_sql=mysqli_query($con,"SELECT avatar_id from quiz_regdetails where id='".$id."'");
    $avatar_sql_result=mysqli_fetch_assoc($avatar_sql);
    $avatar_id=$avatar_sql_result['avatar_id'];
    
    
    $avatar=mysqli_query($con,"SELECT * from avatar where id='".$avatar_id."'");
    $avatar_result=mysqli_fetch_assoc($avatar);
    return  $avatar_result['avatar_url'];
}



function group_name($id){
    
    global $con;
        
        $name_sql=mysqli_query($con,"SELECT * from groups where id='".$id."'");
        $name_sql_result=mysqli_fetch_assoc($name_sql);
        return  $name_sql_result['group_name'];    


    
}

function get_status($id){
    
    global $con;
    
        $status_sql=mysqli_query($con,"SELECT * from online where userid='".$id."'");
        $status_result=mysqli_fetch_assoc($status_sql);
        
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
    
        $accepted=mysqli_query($con,"SELECT is_accepted from group_ready_notification where member='".$id."' and group_id='".$groupid."'");
        $accepted_result=mysqli_fetch_assoc($accepted);
        
        $is_accepted=$accepted_result['is_accepted'];
        
        return $is_accepted;
        
    
}



function group_start_from($groupid){

    global $con;
    
        $created_by=mysqli_query($con,"SELECT created_by from group_ready_notification where group_id='".$groupid."'");
        $created_by_result=mysqli_fetch_assoc($created_by);
        
        $created_by=$created_by_result['created_by'];
        
        return $created_by;
        
    
}


function get_topic_name($id){
    
    global $con;
    
        $get_topic=mysqli_query($con,"SELECT name from project_catT where id='".$id."'");
        
        $get_topic_name=mysqli_fetch_assoc($get_topic);
        
        return $get_topic_name['name']; 
    
}


function array_count_values_of($value, $array) {
    
    global $con;
        
        $counts = array_count_values($array);
        
        return $counts[$value];

    
}



function get_correct_ans($id){
    
    global $con;
    
    $get_correct_ans=mysqli_query($con,"SELECT final_ans from quiztest where srno='".$id."'");
    $get_correct_ans_result=mysqli_fetch_assoc($get_correct_ans);
    
    return $get_correct_ans_result['final_ans'];
    
}


function get_referral_code($id){
    
    global $con;
    
    $get_referral=mysqli_query($con,"select username from quiz_login where user_id='".$id."'");
    $get_referral_result=mysqli_fetch_assoc($get_referral);
    
    $referral_code=$get_referral_result['username'];
    
    return $referral_code;
}



// function get_email($username){
    
//     global $con;
    
//     $sql = mysqli_query($con,"select * from quiz_login where username='".$username."'");
//     $sql_result= mysqli_fetch_assoc($sql); 
    
//     $id= $sql_result['user_id'];
    
//     $get_email_sql=mysqli_query($con,"select * from quiz_regdetails where id='".$id."'");
//     $get_email_sql_result=mysqli_fetch_assoc($get_email_sql);
    
//     $email=$get_email_sql_result['emailid'];
    
//     return $email;
// }


function get_id($email){
    
    global $con;
    
    $get_id=mysqli_query($con,"select id from quiz_regdetails where emailid='".$email."'");
    $get_id_result=mysqli_fetch_assoc($get_id);
    
    $id=$get_id_result['id'];
    
    return $id;
}


function get_student_class($id){
    
    global $con;
    
    $getclass=mysqli_query($con,"SELECT class from quiz_regdetails where id='".$id."'");
    $getclass_result=mysqli_fetch_assoc($getclass);
    
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
    
    $get_q_string=mysqli_query($con,"select mcq from quiztest where srno='".$id."'");
    
    $get_q_string_result=mysqli_fetch_assoc($get_q_string);
    
    return $get_q_string_result['mcq'];
}




function correct_question_string($id){
    
    global $con;
    
    $get_ans=mysqli_query($con,"select final_ans from quiztest where srno='".$id."'");
    
    $get_ans_result=mysqli_fetch_assoc($get_ans);
    
     $final_ans=$get_ans_result['final_ans'];
     
     $get_correct_ans_string=mysqli_query($con,"select '".$final_ans."' from quiztest where srno='".$id."'");
     $get_correct_ans_string_result=mysqli_fetch_assoc($get_correct_ans_string);
     
     return $get_correct_ans_string_result[$final_ans];
     
}

function is_image($id){
    
    global $con;
    
    $is_image_sql=mysqli_query($con,"select imgf from quiztest where srno='".$id."'");
    
  
    $is_image_sql_result=mysqli_fetch_assoc($is_image_sql);
    
    if($is_image_sql_result['imgf']){
        return '1';
    }
    else{
        return '0';
    }
}

function get_subject($std){

    global $con;
    
    $sql=mysqli_query($con,"select distinct(subject) from quiztest where std='".$std."'");
    
    while($result=mysqli_fetch_array($sql))
    {
        
    $sub_sql=mysqli_query($con,"select id,name from project_catT where id='".$result[0]."'");
    
    $sub_result=mysqli_fetch_assoc($sub_sql);
    $data[]=['id'=>$sub_result['id']]; 
 } 
 echo json_encode($data);
}

function get_all_topics($subid){
    $url = 'https://sarmicrosystems.in/quiztest_general/api/get_topics.php';
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
    $sql=mysqli_query($con,"select * from ai_players where id='".$id."'");
    $sql_result=mysqli_fetch_assoc($sql);
    return ucfirst($sql_result['fname'].' '.$sql_result['lname']);    
}

function get_username($userid){
    global $con;
    $sql=mysqli_query($con,"select username from quiz_login where user_id='".$userid."'");
    $sql_result=mysqli_fetch_assoc($sql);
    $username=$sql_result['username'];
    return $username;  
}

function get_competetion_subid($userid){
    global $con;
    $sql = mysqli_query($con,"select * from competetion_registration where userid ='".$userid."' order by id desc");
    
    $sql_result= mysqli_fetch_assoc($sql);
    
    
    return $sql_result['subject'];
    
}

?>