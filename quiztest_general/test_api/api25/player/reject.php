<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $player2=$_POST['player2'];
$friend_id=$_POST['userid'];
$testid=$_POST['testid'];

// $player1=85;
// $player2=13;
// $testid=816;


$sql="UPDATE friend_initiate set is_accepted=2 WHERE testid='".$testid."' and friend_id='".$friend_id."'";
   
   if(mysql_query($sql,$con)){
       echo 1;
   }
   else{
       echo 0;
   }
   
   

    
?>