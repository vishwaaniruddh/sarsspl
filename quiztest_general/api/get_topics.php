<?php 
header('Access-Control-Allow-Origin: *');

include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');

// $sub=4;

  $sub=$_POST['sub'];
//echo $sud;

       $out=[];   
       if($sub!=''){
       $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($sub)");
      
        while($row=mysqli_fetch_assoc($sqlm)){
                
                $id=$row['id'];
                $name=$row['name'];
                $out[] = ['id'=>$id,'name'=>$name];

			   } 
      
       }
header('Content-Type: application/json');
echo json_encode($out);
?>