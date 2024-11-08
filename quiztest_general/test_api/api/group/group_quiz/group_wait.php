<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $testid=$_POST['testid'];
$groupid=$_POST['groupid'];

$sql=mysql_query("SELECT * from group_quiz_notification where groupid='".$groupid."'",$con);


if($sql_result=mysql_fetch_assoc($sql)){
          
    $testid=$sql_result['testid'];
    $sub=$sql_result['subject'];
    $topic=$sql_result['topic'];
    
    
    $subject=get_topic_name($sub);
    $topic_name=get_topic_name($topic);
    
    
    

    $test_sql=mysql_query("select * from group_quiz_notification where testid='".$testid."'",$con);

    $test_sql_result=mysql_fetch_assoc($test_sql);
    
    if($test_sql_result){
        
        $check=mysql_query("SELECT * from  group_quiz_notification where  groupid<>'".$groupid."' and testid='".$testid."'",$con);
        $check_result=mysql_fetch_assoc($check);
        
        if($check_result){
            $oppstatus='1';
        }
        else{
            $oppstatus='0';
        }
 $data=['testid'=>$testid,'oppstatus'=>$oppstatus,'topic'=>$topic,'subject'=>$sub,'sub_name'=>$subject,'topic_name'=>$topic_name];
    }
    
   echo json_encode($data);
        
    }
    else{
        $data=['testid'=>$testid,'oppstatus'=>'0','topic'=>$topic,'subject'=>$sub,'sub_name'=>$subject,'topic_name'=>$topic_name];
        echo json_encode($data);
    }




?>

