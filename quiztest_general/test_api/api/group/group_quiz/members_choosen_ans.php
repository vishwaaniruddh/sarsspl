<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// for live data enable 
$groupid=$_POST['groupid'];
$testid=$_POST['testid'];
$userid=$_POST['userid'];
$question_id=$_POST['qid'];
$index=$_POST['qindex'];



// For test data

// $groupid=48;
// $testid=3441;
// $userid=138;
// $question_id=101211;
// $index=$_POST['qindex'];



$get_sql=mysql_query("SELECT * from quiz_result where id='".$testid."'");

$check_sql_result=mysql_fetch_assoc($get_sql);

        $group1=$check_sql_result['p1'];
        $group2=$check_sql_result['p2'];


        $group1 = preg_replace('/[^0-9]/', '', $group1);
        $group2 = preg_replace('/[^0-9]/', '', $group2);




if($groupid!=$group2){
    


    
    $get_sql=mysql_query("SELECT * from group_result where testid='".$testid."' and question_id='".$question_id."' and groupid='".$group1."'",$con);
    
    $get_sql_result=mysql_fetch_assoc($get_sql);
    $p1_responses=$get_sql_result['final_ans'];
    
if(empty($p1_responses) || $p1_responses=='' || $p1_responses==NULL) {
    $data[]=['is_submit'=>'0'];
} else {
    $data[]=['is_submit'=>'1'];
}
    
}

else {
        
    
     $get_sql=mysql_query("SELECT * from group_result where testid='".$testid."' and question_id='".$question_id."' and groupid='".$group2."'",$con);
    
    $get_sql_result=mysql_fetch_assoc($get_sql);
    $p2_responses=$get_sql_result['final_ans'];
    
if(empty($p2_responses) || $p2_responses=='' || $p2_responses==NULL) { 
    $data[]=['is_submit'=>'0'];
} else {
    $data[]=['is_submit'=>'1'];
}

   
}




$sql=mysql_query("SELECT * from group_response where groupid='".$groupid."' and testid='".$testid."' and question_id='".$question_id."'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
    $ans=$sql_result['responses'];
    $id=$sql_result['player'];
    $name=get_name($id,TRUE);
 
 $data[]=['data'=>['id'=>$id,'name'=>$name,'ans'=>$ans]];
 
 
}
echo json_encode($data);   





?>