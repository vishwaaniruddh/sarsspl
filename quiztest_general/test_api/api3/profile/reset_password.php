<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$email=$_POST['emailid'];
$token=$_POST['ppassword'];

$password=$_POST['password'];
$cpassword=$_POST['cpassword'];


$getidsql=mysql_query("SELECT id from quiz_regdetails where emailid='".$email."'",$con);
$getidsql_result=mysql_fetch_assoc($getidsql);

$userid=$getidsql_result['id'];



$sql=mysql_query("select * from quiz_login where user_id='".$userid."' and pass='".$token."'",$con);
$sql_result=mysql_fetch_assoc($sql);

if(!empty($sql_result)){
    
    if($password==$cpassword){
        $update="UPDATE quiz_login set pass='".$password."' where user_id='".$userid."'";
        
        if(mysql_query($update,$con)){
            echo json_encode('1');  //success
        }
        else{
            echo json_encode('0'); //not update
        }
    }
    else{
        echo json_encode('2');  //if password and confirm_password doesn't match
    }
    
}

else{
    echo json_encode('3'); // when find no record to update
}




?>