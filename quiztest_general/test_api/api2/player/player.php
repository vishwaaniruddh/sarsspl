<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



// test response
// $player1=85;
// $standard=8;
// $topic=205;
// $subid=8;
// end test



// enable live responses 
$player1=$_POST['player1'];
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];
// $subid=$_POST['subid'];
$subjectid=$_POST['subid'];
// end live response

$insert_sql_result="INSERT INTO quiz_result(p1,subject) VALUES('".$player1."','".$subjectid."')";

if (mysql_query($insert_sql_result,$con) === TRUE) {

    $testid = mysql_insert_id();

}


$sql=mysql_query("SELECT * from quiz_friends WHERE user_id='".$player1."'",$con);

while ($sql_result=mysql_fetch_assoc($sql)) {
    
    // echo $sql_result['friend_id'];
    // return;
    // if($sql_result['player1']=$player1){
    //     $delete=mysql_query("DELETE from friend_initiate WHERE player1='".$player1."' and testid='".($testid-1)."'",$con);
    // }
    

    
    $check_sql=mysql_query("SELECT * from friend_initiate WHERE player1='".$player1."' and testid='".$testid."' and friend_id='".$sql_result['id']."'",$con);
    
    if(!$check_sql_result=mysql_fetch_assoc($check_sql)){
        
        if($player1==$sql_result['id']){
            continue;
            }
    $insert_sql=mysql_query("INSERT INTO friend_initiate(player1,testid,friend_id,is_accepted,standard,topic,subject) VALUES('".$player1."','".$testid."','".$sql_result['friend_id']."',0,'".$standard."','".$topic."','".$subjectid."')",$con);            
        

        }


$data=['testid'=>$testid];
// $data[]=['data'=>['id'=>$sql_result['id'],'name'=>$sql_result['name']]];
    
}
        
        
echo json_encode($data);



?>