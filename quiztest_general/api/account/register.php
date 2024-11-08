<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }

//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');


$name=$_POST['name'];
$lname=$_POST['lname'];
$email=$_POST['email'];
/*$schname=$_POST['schname'];
$class=$_POST['class1'];*/
$schname = "";
$class="9";
$mobile=$_POST['mobile'];

$password=$_POST['password'];

//$id=$_GET['rg'];

$ShouldAddAsFriend = false;
if(isset($name) && isset($lname) && isset($email) && isset($schname) && isset($class) && isset($mobile)){

$maxCodeSqlResult = mysqli_query($con,"SELECT max(`invite_code`) as 'invite_code' FROM `quiz_regdetails`");
$maxCode = mysqli_fetch_assoc($maxCodeSqlResult);

//echo "maxCode: ".$maxCode["invite_code"];
$maxCode = $maxCode["invite_code"];
if($maxCode == null){
    $maxCode = "AA1024";
} else {
    $CodeNum = substr($maxCode, 2);
    $CodeChar = substr($maxCode, 0, 2);
    if($CodeNum > 9996) {
        $CodeChar++;
        $maxCode = $CodeChar. '1024';
    } else {
        $CodeNum++;
        $maxCode = $CodeChar.$CodeNum;
    }
}
$referrer_id = null;
if(isset($_POST['refcode'])){
    if(strlen($_POST['refcode']) == 6){
        $refCodeSqlResult = mysqli_query($con,"SELECT `id`, `class` FROM `quiz_regdetails` WHERE `invite_code` = '".$_POST['refcode']."'");
        $userData = mysqli_fetch_assoc($refCodeSqlResult);
        if($userData['id'] > 0) {
            $referrer_id = $userData['id'];
            $referrerclass=$userData['class'];
            if($class==$referrerclass && !empty($referrerclass) && $referrerclass!=0){
                $ShouldAddAsFriend = true;
            }
        }
    }
}
$sql="INSERT INTO quiz_regdetails(name,lname,emailid,school,class,mobile,invite_code,referrer_id) VALUES('".$name."','".$lname."','".$email."','".$schname."','".$class."','".$mobile."','".$maxCode."', '".$referrer_id."')";




if (mysqli_query($con,$sql) === TRUE) {

    $userid = mysqli_insert_id($con);
    if($ShouldAddAsFriend == true) {
        $sqlfrnd1="INSERT into quiz_friends(user_id,friend_id) VALUES('".$userid."','".$referrer_id."')";
    
        $sql_reversefrnd="INSERT into quiz_friends(user_id,friend_id) VALUES('".$referrer_id."','".$userid."')";
    
        mysqli_query($con,$sqlfrnd1);
        mysqli_query($con,$sql_reversefrnd);
        
        $sql_refer = "INSERT into referal_points(userid,refer_friend_id,points) VALUES('".$referrer_id."','".$userid."','25')";
        mysqli_query($con,$sql_refer);
    }
}

$sql_login="INSERT INTO quiz_login(user_id,email,pass) VALUES('".$userid."','".$email."','".$password."')";



if(mysqli_query($con,$sql_login)===TRUE){
  // echo json_encode('1');
   echo '1';
  
   }
else{
  // echo json_encode('0');
   echo '0';
}    

}
else{
   // echo json_encode('0');
    echo '0';
}




?>