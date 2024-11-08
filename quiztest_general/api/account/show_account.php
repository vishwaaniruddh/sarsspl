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



$userid=$_POST['userid'];

// $username=get_username($userid);
// $userid=88;

$sql=mysqli_query($con,"select * from quiz_regdetails where id='".$userid."'");

$get_result=mysqli_fetch_assoc($sql);

$fname=$get_result['name'];
$lname=$get_result['lname'];
$email=$get_result['emailid'];
$school=$get_result['school'];
$class=$get_result['class'];
$avatar=$get_result['avatar_id'];
$invitecode = $get_result['invite_code'];

if($invitecode == null || $invitecode == ''){
    $maxCodeSqlResult = mysqli_query($con,"SELECT max(`invite_code`) as 'invite_code' FROM `quiz_regdetails`");
    $maxCode = mysqli_fetch_assoc($maxCodeSqlResult);
    
    $maxCode = $maxCode["invite_code"];
    $CodeNum = substr($maxCode, 2);
    $CodeChar = substr($maxCode, 0, 2);
    if($CodeNum > 9996) {
        $CodeChar++;
        $maxCode = $CodeChar. '1024';
    } else {
        $CodeNum++;
        $maxCode = $CodeChar.$CodeNum;
    }
    mysqli_query($con,"Update quiz_regdetails set `invite_code` = '".$maxCode."' where id='".$userid."'");
    $invitecode = $maxCode;
}

// get avatar image url
$avatar_sql=mysqli_query($con,"select * from avatar where id='".$avatar."'");
$avatar_get_result=mysqli_fetch_assoc($avatar_sql);

$avatar=$avatar_get_result['avatar_url'];

// end



$data=['data'=>['fname'=>$fname,'lname'=>$lname,'email'=>$email,'school'=>$school,'class'=>$class,'avatar'=>$avatar,'refCode'=>$invitecode]];

echo json_encode($data);





?>