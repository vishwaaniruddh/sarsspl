<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');

    $std=$_POST['std'];
    // $std=9;

        
                                    
    $sql=mysql_query("select distinct(subject) from quiztest where std='".$std."'",$con);
    
    while($result=mysql_fetch_array($sql))
    {
    
    $sub_sql=mysql_query("select name from project_catT where id='".$result[0]."'",$con);
    
    $sub_result=mysql_fetch_array($sub_sql);
    
    
    
    $data[]=['id'=>$result[0],'sub'=>$sub_result[0]];

    
 } 
    echo json_encode($data);
    
                                    
         
?>