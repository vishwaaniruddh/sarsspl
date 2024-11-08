<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/smartscore/config.php');





function get_name($id,$custom){
    
    global $con;

    if($custom==TRUE){
        
        $name_sql=mysqli_query($con,"SELECT * from quiz_regdetails where id='".$id."'");
        $name_sql_result=mysqli_fetch_assoc($name_sql);
        return  $name_sql_result['name'].' '.$name_sql_result['lname'];    

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
    
        $get_topic=mysqli_query($con,"SELECT name from project_cat where id='".$id."'");
        
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





?>