<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$player1=$_POST['player1'];
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];

$subjectid=$_POST['subid'];

$insert_sql_result="INSERT INTO quiz_result(p1,subject) VALUES('".$player1."','".$subjectid."')";


if (mysqli_query($con,$insert_sql_result) === TRUE) {

    $testid = mysqli_insert_id($con);

}


$sql=mysqli_query($con,"SELECT * from quiz_regdetails WHERE class='".$standard."' and status=1");

while ($sql_result=mysqli_fetch_assoc($sql)) {
    
    if($sql_result['player1']=$player1){
        $delete=mysqli_query($con,"DELETE from like_minded WHERE player1='".$player1."' and testid='".($testid-1)."'");
    }
    

    
    $check_sql=mysqli_query($con,"SELECT * from like_minded WHERE player1='".$player1."' and testid='".$testid."' and player2='".$sql_result['id']."'");
    
    if(!$check_sql_result=mysqli_fetch_assoc($check_sql)){
        
        if($player1==$sql_result['id']){
            continue;
            }
        $insert_sql=mysqli_query($con,"INSERT INTO like_minded(player1,testid,player2,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$sql_result['id']."',0,'".$standard."','".$topic."')");
        
    }


$data=['testid'=>$testid];
    
}

    echo json_encode($data);

?>