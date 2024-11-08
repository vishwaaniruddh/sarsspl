<?php

header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');


$test_id=3;

$sql=mysql_query("SELECT * from quiz_result where test_id='".$test_id."'",$con);

$result=mysql_fetch_assoc($sql);

foreach($result as $key=>$value){
    
    var_dump($value);
}


return;
while ($result=mysql_fetch_assoc($sql)) {
    
    if($result['p1_responses']!=$result['answers']){
         $is_p1_correct='no';

    }
    else {
        $is_p1_correct=='yes';

    }
echo $is_p1_correct;

    
    $update_sql="update quiz_result set is_p1_correct='".$is_p1_correct."' where test_id='".$test_id."'";    
 mysql_query($update_sql,$con);
 
}



?>

