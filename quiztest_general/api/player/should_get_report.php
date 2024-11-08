<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$testid=$_POST['testid'];
$userid=$_POST['userid'];

$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
$sql_result=mysqli_fetch_assoc($sql);


if($userid == $sql_result['p1'] && $sql_result['p1_status'] == 0){
    mysqli_query($con,"update quiz_result set p1_status=1, p1_status_time=now() where id='".$testid."'");
} else if($userid == $sql_result['p2'] && $sql_result['p2_status'] == 0) {
    mysqli_query($con,"update quiz_result set p2_status=1, p2_status_time=now() where id='".$testid."'");
}

$ShowShowReport = '0';
if($userid == $sql_result['p1']){
    if($sql_result['p2_status'] == 0){
        $IsUpdated = mysqli_query($con,"update quiz_result set p2_status=2, p2_status_time=now() WHERE p1_status_time < (NOW() - INTERVAL 30 SECOND)  and id='".$testid."'");
        
    } else {
        $ShowShowReport = '1';
    }
} else if($userid == $sql_result['p2']) {
    if($sql_result['p1_status'] == 0){
        $IsUpdated = mysqli_query($con,"update quiz_result set p1_status=2, p1_status_time=now() WHERE p2_status_time < (NOW() - INTERVAL 30 SECOND)  and id='".$testid."'");
        
    } else {
        $ShowShowReport = '1';
    }
}
echo json_encode($ShowShowReport);
?>