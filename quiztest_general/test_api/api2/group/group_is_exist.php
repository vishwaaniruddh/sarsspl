<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$group_name=$_POST['group_name'];
// $group_name='Bhishma';


$sql=mysql_query("SELECT group_name from groups WHERE `group_name` like '".$group_name."'",$con);

$sql_result=mysql_fetch_assoc($sql);

    if($sql_result){

         echo json_encode('exists');    

    }

    else{
     
        echo json_encode('success');
            // return ;
    }

   




?>
