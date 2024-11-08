<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];
$testid=$_POST['testid'];
$isaccept=$_POST['isaccept'];


// TO ACCEPT
if($isaccept==1){
    
    
    $select_sql=mysql_query("SELECT * from rematch where testid='".$testid."' ",$con);
    $select_sql_result=mysql_fetch_assoc($select_sql);
    
    $player1=$select_sql_result['player1'];
    $player2=$select_sql_result['player2'];
    $standard=$select_sql_result['standard'];
    $topic=$select_sql_result['topic'];
    $quiz_type = $select_sql_result['againstid'];
    if($quiz_type == "2"){
      
    mysql_query("INSERT INTO friend_initiate(player1,testid,friend_id,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$player2."',1,'".$standard."','".$topic."')",$con);  
      
    } 
    
    if($quiz_type == "3") {
        mysql_query("INSERT INTO like_minded(player1,testid,player2,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$player2."',1,'".$standard."','".$topic."')",$con);
    }
      
      
$sql="UPDATE rematch set is_accepted=1 where testid='".$testid."'";


if(mysql_query($sql,$con)=== TRUE){    
    echo json_encode($testid);
}

else{
    echo json_encode('0');
}
    
}

// TO REJECT


if($isaccept==2){
  $sql="UPDATE rematch set is_accepted=2 where testid='".$testid."'";


if(mysql_query($sql,$con)=== TRUE){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}

  
}

?>