<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$email=$_POST['emailid'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$otp=$_POST['ppassword']; //otp



if($password == $cpassword){
    
    $sql = mysqli_query($con,"select * from forget_password where email='".$email."'");
    
    if($sql_result = mysqli_fetch_assoc($sql)){
        
        $table_otp = $sql_result['password'];
        
        if($table_otp == $otp){
            
            $update_sql = "update quiz_login set pass='".$password."' where email='".$email."'";
            
            if(mysqli_query($con,$update_sql)){
                echo '1';
            }
            else{
                echo '0';
            }
            
            
        }
        else{
            
            echo '0'; //otp mismatch
            
        }
        
        
    }
    else{
        echo '0'; // no otp found
    }
    
    
}

else{

    echo '0';   //password and confirm passsword doestnt match
}

?>