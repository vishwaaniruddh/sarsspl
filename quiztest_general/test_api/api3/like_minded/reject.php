<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $player2=$_POST['player2'];
$player2=$_POST['userid'];
$testid=$_POST['testid'];

// $player1=85;
// $player2=13;
// $testid=816;


$sql="UPDATE like_minded set is_accepted=2 WHERE testid='".$testid."' and player2='".$player2."'";
   
   if(mysql_query($sql,$con)){
       echo 1;
   }
   else{
       echo 0;
   }
   
   

    
?>