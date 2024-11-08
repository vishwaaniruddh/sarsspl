<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

    // $group_name='saaaaar';
    // $created_by=85;
    
    
    $group_name=$_POST['group_name'];
    $created_by=$_POST['userid'];

$group_members=$_POST['group_members'];
$group_members=json_decode($group_members);
$requested_to=str_replace( array('[',']','"') , ''  , $group_members);
    
    
    // $requested_to=array(21,45,78,89,56);

    $count= count($requested_to);


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





?>
