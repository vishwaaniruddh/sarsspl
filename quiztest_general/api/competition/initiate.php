<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$topic=$_REQUEST['topicid'];
$desiredLength=10;
$json=json_encode($topic);
$p1=$_REQUEST['p1'];
$p2='AI';
$date = date('Y-m-d');

$standard = get_student_class($p1);
$subjectid = get_competetion_subid($p1);
$json=json_encode($topic);



$user_sql = mysqli_query($con,"select * from competetion_registration where userid = '".$p1."' order by id desc");
$user_sql_result = mysqli_fetch_assoc($user_sql);

$plan = $user_sql_result['subscription'];
$created_at = $user_sql_result['created_at'];


// $topic=206;
// $p1=26;
// $p2=11;

$json=json_encode($topic);


if(isset($topic) && isset($p1) && isset($p2) && $standard > 0){
    
    $sql = "insert into competetion_quiz(p1,p2,topic,total_qn,standard,subject,created_at) values('".$p1."','".$p2."','".$topic."','".$desiredLength."','".$standard."','".$subjectid."','".$date."')";
    
    if(mysqli_query($con,$sql)){
        $testid = mysqli_insert_id();      
        
        $count_sql = mysqli_query($con,"select * from competetion_count where userid = '".$p1."' and plan = '".$plan."' and created_at = '".$created_at."' order by id desc");


        if($count_sql_result = mysqli_fetch_assoc($count_sql)){
                
                $count = $count_sql_result['quize_count'];
                $new_count = $count +1 ;
                mysqli_query($con,"update competetion_count set quize_count = '".$new_count."' where userid = '".$p1."' and plan = '".$plan."' and created_at = '".$created_at."'");
            }
            else{
                $statement = "insert into competetion_count(userid,plan,quize_count,status,created_at) values('".$p1."','".$plan."','1','1','".$date."')";
                 mysqli_query($con,$statement);
            }

        
    }
    else{
        $testid = 0 ;
        
        }
        
        echo json_encode($testid);
}
else{
    echo 0;
}
