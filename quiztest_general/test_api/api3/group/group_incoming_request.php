<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $player2=$_POST['player2'];
$player2=$_POST['userid'];
// $groupid=$_POST['groupid'];

// $player1=85;
$player2=21;
$groupid=8;

$check_count_sql=mysql_query("SELECT sum(is_accepted) as sum from group_initiate where group_id='".$groupid."'",$con);

$check_count_sql_result=mysql_fetch_assoc($check_count_sql);


$total_members=$check_count_sql_result['sum'];

if($total_members<4){
$sql="UPDATE group_initiate set is_accepted=1 WHERE group_id='".$groupid."' and requested_to='".$player2."'";
   
   if(mysql_query($sql,$con)){
       echo 'success';
   }
   else{
       echo mysql_error();
   }    
}
else{
    echo 'Maximum Members limit reached';
}

   
   

    
?>