<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

   
    
    $group_name=$_POST['group_name'];
    $created_by=$_POST['userid'];
    
     // $group_name='saaaaar';
    // $created_by=85;
    
    // $requested_to=array(21,45,78,89,56);


$re_sql=mysqli_query($con,"SELECT * from quiz_friends where user_id='".$created_by."'");

    while($fetch_result=mysqli_fetch_assoc($re_sql)){
    
    $requested_to[]=$fetch_result['friend_id'];

    
}

    $count= count($requested_to);


$sql=mysqli_query($con,"INSERT INTO groups(group_name,created_by) values('".$group_name."','".$created_by."')");


if($sql){
    $groupid = mysqli_insert_id();
    }
else{
    die('Invalid query: ' . mysqli_error());
}

for($i=0;$i<$count;$i++){
    $update_sql=mysqli_query($con,"INSERT INTO group_initiate(group_id,created_by,requested_to) values('".$groupid."','".$created_by."','".$requested_to[$i]."')");    
}

if($groupid){
echo json_encode('success');    
}
else{
    echo json_encode('error');
}





?>
