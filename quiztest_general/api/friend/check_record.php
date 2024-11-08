<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$email = $_POST['email'];
$userid = $_POST['userid'];

// $userid = 186;
$myclass=get_student_class($userid);

// $email = 'aniruddhvishwa@gmail.com';


$sql = mysqli_query($con,"select * from quiz_regdetails where emailid='".$email."'");


if($sql_result = mysqli_fetch_assoc($sql)){
    
    $oppid = $sql_result['id']; 
    
    $oppclass = get_student_class($oppid);
    
    /*$check_sql = mysqli_query($con,"select * from quiz_friends where user_id='".$userid."' and friend_id='".$oppid."'");

    if($check_sql_result = mysqli_fetch_assoc($check_sql)){
        
        echo '3'; //already friends
        
    }
    else{
            
            if($myclass==$oppclass && !empty($oppclass) && $oppclass!=0){*/
        
                $name = $sql_result['name'].' '.$sql_result['lname'];
                $class = $sql_result['class'];
                $school = $sql_result['school'];
                $avatar = $sql_result['avatar'];
                
                $data = ['name'=>$name,'class'=>$class,'school'=>$school,'avatar'=>$avatar];
                
                echo json_encode($data);
            /*}
            else{
                echo '0'; //other class   
            }        
    }*/

    

}
else{
 
    echo '2'; // user not found
    
}
?>