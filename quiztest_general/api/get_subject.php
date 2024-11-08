<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');


    $std=$_POST['std'];
    $std= 0;  
                                    
    $sql=mysqli_query($con,"select id,name from project_catT where UNDER='".$std."'");
    
    while($result=mysqli_fetch_array($sql))
    {
        $data[]=['id'=>$result[0],'sub'=>$result[1]];
    } 
    echo json_encode($data);
    
                                    
         
?>