<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];
$testid=$_POST['testid'];
$isaccept=$_POST['isaccept'];


// TO ACCEPT
if($isaccept==1){
    
    
    $select_sql=mysqli_query($con,"SELECT * from rematch where testid='".$testid."' ");
    $select_sql_result=mysqli_fetch_assoc($select_sql);
    
    $player1=$select_sql_result['player1'];
    $player2=$select_sql_result['player2'];
    $standard=$select_sql_result['standard'];
    $topic=$select_sql_result['topic'];
    $quiz_type = $select_sql_result['againstid'];
    if($quiz_type == "2"){
      
    mysqli_query($con,"INSERT INTO friend_initiate(player1,testid,friend_id,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$player2."',1,'".$standard."','".$topic."')");  
      
    } 
    
    if($quiz_type == "3") {
        mysqli_query($con,"INSERT INTO like_minded(player1,testid,player2,is_accepted,standard,topic) VALUES('".$player1."','".$testid."','".$player2."',1,'".$standard."','".$topic."')");
    }
      
      
$sql="UPDATE rematch set is_accepted=1 where testid='".$testid."'";


if(mysqli_query($con,$sql)=== TRUE){    
    echo json_encode($testid);
}

else{
    echo json_encode('0');
}
    
}

// TO REJECT


if($isaccept==2){
  $sql="UPDATE rematch set is_accepted=2 where testid='".$testid."'";


if(mysqli_query($con,$sql)=== TRUE){
    echo json_encode('1');
}
else{
    echo json_encode('0');
}

  
}

?>