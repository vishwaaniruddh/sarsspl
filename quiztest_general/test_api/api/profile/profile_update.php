<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$school=$_POST['school'];
$class=$_POST['class1'];


$update_sql="update quiz_regdetails set name='".$fname."', lname='".$lname."', school='".$school."',class='".$class."' where id='".$userid."'";

if(mysql_query($update_sql,$con)){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}


?>