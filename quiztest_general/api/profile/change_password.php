<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$token=$_POST['ppassword'];

$password=$_POST['password'];
$cpassword=$_POST['cpassword'];



$sql=mysqli_query($con,"select * from quiz_login where user_id='".$userid."' and pass='".$token."'");
$sql_result=mysqli_fetch_assoc($sql);

if(!empty($sql_result)){
    
    if($password==$cpassword){
        $update="UPDATE quiz_login set pass='".$password."' where user_id='".$userid."'";
        
        if(mysqli_query($con,$update)){
           // echo json_encode('1');  
            //success
            $data=['code'=>200,'msg'=>'password updated successfully.'];
            echo json_encode($data);
        }
        else{
            //echo json_encode('0'); 
            //not update
            $data=['code'=>201,'msg'=>'password not updated.'];
            echo json_encode($data);
        }
    }
    else{
       // echo json_encode('2');  
       //if password and confirm_password doesn't match
        $data=['code'=>202,'msg'=>'password and confirm password does not match.'];
        echo json_encode($data);
    }
    
}

else{
   // echo json_encode('3'); 
   // when find no record to update
    $data=['code'=>203,'msg'=>'current password is incorrect.'];
    echo json_encode($data);
}




?>