<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

    

$created_by=$_POST['userid'];
$group_members=$_POST['group_members'];
$group_members=json_decode($group_members);
$requested_to=str_replace( array('[',']','"') , ''  , $group_members);
    
    
$groupid=$_POST['groupid'];

$count= count($requested_to);



if($groupid){
    
    for($i=0;$i<$count;$i++){
    $update_sql=mysql_query("INSERT INTO group_initiate(group_id,created_by,requested_to) values('".$groupid."','".$created_by."','".$requested_to[$i]."')",$con);    
}

if($groupid){
echo json_encode('success');    
}
else{
    echo json_encode('error');
}

    
    
}
else{
    
    $group_name=$_POST['group_name'];
    
    $sql=mysql_query("INSERT INTO groups(group_name,created_by) values('".$group_name."','".$created_by."')",$con);
    
    
    if($sql){
        $groupid = mysql_insert_id();
        }
    else{
        die('Invalid query: ' . mysql_error());
    }

for($i=0;$i<$count;$i++){
    $update_sql=mysql_query("INSERT INTO group_initiate(group_id,created_by,requested_to) values('".$groupid."','".$created_by."','".$requested_to[$i]."')",$con);    
}

if($groupid){
echo json_encode('success');    
}
else{
    echo json_encode('error');
}

}









?>
