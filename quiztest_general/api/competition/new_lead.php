<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid = $_REQUEST['userid'];

$get_sql = mysqli_query($con,"select * from competetion_registration where userid = '".$userid."' order by id desc");
$get_sql_result = mysqli_fetch_assoc($get_sql);

$subject = $get_sql_result['subject'] ;
$plan = $get_sql_result['subscription'];
$standard = get_student_class($userid);

$sql = mysqli_query($con,"select sum(p1_correct_count)as total , competetion_quiz.p1,competetion_quiz.standard , competetion_registration.userid , competetion_registration.subscription , competetion_registration.subject from competetion_quiz , competetion_registration where competetion_registration.userid = competetion_quiz.p1 and standard ='".$standard."' group by p1 order by total desc");

$i=1; //to only take first 10 data

while($sql_result = mysqli_fetch_assoc($sql)){
    
    if($sql_result['subscription'] == $plan && $i < 11 ){ 
        $p1 = $sql_result['p1'];
        $name = get_name($p1,TRUE);
        $total = $sql_result['total'];
        $data[] = ['player'=>$p1, 'name' => $name , 'total'=>$total];
        $i++;
    }

}
    if($data){   
        echo json_encode($data);
    }
    else{
        echo 0;
    }   

?>