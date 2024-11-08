<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $groupid=39;
// $userid=$_POST['userid'];


$groupid=$_POST['groupid'];
$userid=$_POST['userid'];


$sql=mysqli_query($con,"SELECT * from groups where id='".$groupid."'");

$sql_result=mysqli_fetch_assoc($sql);

if($sql_result['created_by']==$userid){
    
    $delete_sql="delete from groups where id='".$groupid."'";
    
    if(mysqli_query($con,$delete_sql))  {
        
        echo json_encode('deleted');
        
    }
    else{
        
        echo json_encode('error');
    }
    
}




?>