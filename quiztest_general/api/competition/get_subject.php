<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


    $std=$_REQUEST['std'];

    
    if($std>0){
        
        $sql = mysqli_query($con,"select * from subjects where std = '".$std."' and status=1");

        while($sql_result = mysqli_fetch_assoc($sql)){
            
            $id = $sql_result['id'];
            $subject = $sql_result['subject'];
            
            $data[] = ['id'=>$id , 'subject'=>$subject];
        }
    
        if($data){
            echo json_encode($data);            
        }
        else{
            echo 0;
        }

        
    }
    else{
            echo 0;
    }
                                    
         
?>