<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// $player2=$_POST['player2'];
$player2=$_POST['userid'];
$groupid=$_POST['groupid'];

// $player1=85;
// $player2=21;
// $groupid=8;

$check_count_sql=mysqli_query($con,"SELECT sum(is_accepted) as sum from group_initiate where group_id='".$groupid."'");

$check_count_sql_result=mysqli_fetch_assoc($check_count_sql);


$total_members=$check_count_sql_result['sum'];

if($total_members<4){
$sql="UPDATE group_initiate set is_accepted=1 WHERE group_id='".$groupid."' and requested_to='".$player2."'";
   
   if(mysqli_query($con,$sql)){
       echo 'success';
   }
   else{
       echo mysqli_error();
   }    
}
else{
    echo 'Maximum Members limit reached';
}

   
   

    
?>