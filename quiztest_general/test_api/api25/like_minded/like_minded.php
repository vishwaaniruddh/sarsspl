<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$player1=$_POST['player1'];
// $player1=85;
$standard=$_POST['stdid'];
$topic=$_POST['topicid'];

$subjectid=$_POST['subid'];

$insert_sql_result="INSERT INTO quiz_result(p1,subject) VALUES('".$player1."','".$subjectid."')";
// echo $insert_sql_result;

// return;

if (mysql_query($insert_sql_result,$con) === TRUE) {

    $testid = mysql_insert_id();

}


$sql=mysql_query("SELECT * from quiz_regdetails WHERE class='".$standard."' and status=1",$con);

while ($sql_result=mysql_fetch_assoc($sql)) {
    
    if($sql_result['player1']=$player1){
        $delete=mysql_query("DELETE from like_minded WHERE player1='".$player1."' and testid='".($testid-1)."'",$con);
        // $delete_interval=mysql_query("DELETE FROM like_minded WHERE created_at < (NOW() - INTERVAL 35 SECOND)  and player1='".$player1."'",$con);
    }
    

    
    $check_sql=mysql_query("SELECT * from like_minded WHERE player1='".$player1."' and testid='".$testid."' and player2='".$sql_result['id']."'",$con);
    
    if(!$check_sql_result=mysql_fetch_assoc($check_sql)){
        
        if($player1==$sql_result['id']){
            continue;
            }
        $insert_sql=mysql_query("INSERT INTO like_minded(player1,testid,player2,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$sql_result['id']."',0,'".$standard."','".$topic."')",$con);
        
    }


$data=['testid'=>$testid];
// $data[]=['data'=>['id'=>$sql_result['id'],'name'=>$sql_result['name']]];
    
}

    echo json_encode($data);

?>