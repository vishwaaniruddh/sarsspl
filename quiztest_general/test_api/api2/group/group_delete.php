<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $groupid=39;
// $userid=$_POST['userid'];


$groupid=$_POST['groupid'];
$userid=$_POST['userid'];


$sql=mysql_query("SELECT * from groups where id='".$groupid."'",$con);

$sql_result=mysql_fetch_assoc($sql);

if($sql_result['created_by']==$userid){
    
    $delete_sql="delete from groups where id='".$groupid."'";
    
    if(mysql_query($delete_sql,$con))  {
        
        echo json_encode('deleted');
        
    }
    else{
        
        echo json_encode('error');
    }
    
}




?>