<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// test response
// $player2=85;

// enable for live response
$player2=$_POST['userid'];





$sql=mysqli_query($con,"select * from  group_initiate WHERE requested_to='".$player2."'  and is_accepted=0");

while($sql_result=mysqli_fetch_assoc($sql)){
    
$groupid=$sql_result['group_id'];


$check_sql=mysqli_query($con,"SELECT * from groups where id='".$groupid."'");

$check_sql_result=mysqli_fetch_assoc($check_sql);

if($check_sql_result){
  
  $created_by=$sql_result['created_by'];
$name=get_name($created_by,TRUE);


$group_sql=mysqli_query($con,"SELECT * from groups where id='".$groupid."'");

$group_sql_result=mysqli_fetch_assoc($group_sql);

$group_name=$group_sql_result['group_name'];

   
$data[]=['data'=>['groupid'=>$groupid,'group_name'=>$group_name,'player1_name'=>$name]];        


  
}





}
 
echo json_encode($data);




?>