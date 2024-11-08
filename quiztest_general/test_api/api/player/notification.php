<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $player2=88;

// $player1=$_POST['userid'];
$player2=$_POST['player2'];
$standard=$_POST['stdid'];

// echo 'userid='.$userid;
// return;








$sql=mysql_query("select * from friend_initiate WHERE friend_id='".$player2."'  and is_accepted=0",$con);

while($sql_result=mysql_fetch_assoc($sql)){
$player1=$sql_result['player1'];
$topic=$sql_result['topic'];
$subject=$sql_result['subject'];
$testid=$sql_result['testid'];

// $player1=$sql_result['player2'];






// get player1 name
    
$name_sql=mysql_query("select * from quiz_regdetails WHERE id='".$player1."'",$con);

$name_sql_result=mysql_fetch_assoc($name_sql);    

$player1_name=$name_sql_result['name'].' '.$name_sql_result['lname'];
//






// get subject Name with Topic ID
    $get_sub_query=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $get_sub_query_result=mysql_fetch_assoc($get_sub_query);
    
    $subid=$get_sub_query_result['subject'];
    $delete_interval=mysql_query("DELETE FROM friend_initiate WHERE created_at < (NOW() - INTERVAL 30 SECOND)  and player1='".$player2."'",$con);
       
 
    
    $get_subject=mysql_query("SELECT * from project_catT where id='".$subid."'",$con);
    $get_sub_result=mysql_fetch_assoc($get_subject);

    $subject=$get_sub_result['name'];
    
    
    //get topic Name
    
    $get_topic=mysql_query("SELECT * from project_catT where id='".$topic."'",$con);
    $get_topic_result=mysql_fetch_assoc($get_topic);
    
    
    $topic=$get_topic_result['name'];
    

    
   
$data[]=['id'=>$id,'player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'standard'=>$standard,'topic'=>$topic,'subject'=>$subject,'notification'=>'friend'];            
}

  
echo json_encode($data);




?>