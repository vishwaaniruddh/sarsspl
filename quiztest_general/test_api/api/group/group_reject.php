<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $player2=$_POST['player2'];
$player2=$_POST['userid'];
$groupid=$_POST['groupid'];

// $player1=85;
// $player2=13;
// $testid=816;


$sql="UPDATE group_initiate set is_accepted=2 WHERE group_id='".$groupid."' and requested_to='".$userid."'";
   
   if(mysql_query($sql,$con)){
       echo json_encode('1');
   }
   else{
       echo json_encode('0');
   }
   
   

    
?>