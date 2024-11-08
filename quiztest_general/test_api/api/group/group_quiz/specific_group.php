<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$name=$_POST['group_name'];
$groupid=$_POST['groupid'];


if($name){
$sql=mysql_query("select * from groups where group_name like '%".$name."%'",$con);

while($sql_result=mysql_fetch_assoc($sql)){
    
    $id=$sql_result['id'];
    $group_name = $sql_result['group_name'];
        
        if($groupid!=$id){
            
            $data[]=['oppgroup_id'=>$id,'oppgroup_name'=>$group_name];        

        }
        
}


echo json_encode($data);    
}


?>