<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];

$fname=$_POST['fname'];
$lname=$_POST['lname'];



$update_sql="update quiz_regdetails set name='".$fname."', lname='".$lname."' where id='".$userid."'";

if(mysqli_query($con,$update_sql)){
   // echo json_encode('1');
     $data=['code'=>200,'fname'=>$fname,'lname'=>$lname,'msg'=>'Profile Updated successfully.'];
    
    echo json_encode($data);
}
else{
     $data=['code'=>201];
    echo json_encode($data);
}


?>