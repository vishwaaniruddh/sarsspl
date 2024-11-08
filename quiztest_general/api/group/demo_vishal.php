<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



if($_SERVER['REQUEST_METHOD']=='GET'){
    
    $sql=mysqli_query($con,"select * from demo_vishal order by id DESC");
    
    while($sql_result=mysqli_fetch_assoc($sql)){
        
        $data[]=['data'=>['id'=>$sql_result['id'],'name'=>$sql_result['name']]];
    }
    echo json_encode($data);
}

else{
$name=$_POST['name'];
// $group_name='sar';

$sql=mysqli_query($con,"INSERT INTO demo_vishal(name) values('".$name."')");

if($sql){
    echo 'successfully created';
}
else{
    
    die('Invalid query: ' . mysqli_error());
}

}



?>
