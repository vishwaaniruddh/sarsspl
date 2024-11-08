<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// for test responses

// $group1=48;
// $standard=8;
// $topic=46;
// $subid=$_POST['subid'];
// $desiredLength=10;




// for live responses
// $group1=$_POST['group1'];
// $standard=$_POST['stdid'];
// $topic=$_POST['topicid'];
// $subid=$_POST['subid'];

$testid=$_POST['testid'];
// $testid = 2854;


$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");

$sql_result=mysqli_fetch_assoc($sql);

$player1=$sql_result['p1'];


$question=$sql_result['questions_ids'];

$question_arr=explode(',',$question);

foreach($question_arr as $key => $value){
    
    $mcq='';
    $sql1=mysqli_query($con,"SELECT * from quiztest where srno='".$value."'");
    $sql1_result=mysqli_fetch_assoc($sql1);
    
    $mcq=$sql1_result['mcq'];
    
    if($sql1_result['imgf']){
      $mcq="https://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$result["imgf"];

      
      $is_image='1';
}
else{
    $mcq=$sql1_result['mcq'];
          $is_image='0';
}


 $options=array("a"=>$sql1_result["a"],"b"=>$sql1_result["b"],"c"=>$sql1_result["c"],"d"=>$sql1_result["d"]);
     
            
                if($options["a"]==$sql1_result['final_ans']){
                    $final_ans="a";
                }
                elseif($options["b"]==$sql1_result['final_ans']){
                    $final_ans="b";
                }
                elseif($options["c"]==$sql1_result['final_ans']){
                    $final_ans="c";
                }
                elseif($options["d"]==$sql1_result['final_ans']){
                    $final_ans="d";
                }
                
                
                        $ideal_time='60';
                        
                        
$data[]= ['data'=>['test_id'=>$testid,'player1'=>$player1,'question_id'=>$value,'mcq'=>$mcq,'is_image'=>$is_image,'final_ans'=>$sql1_result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
 
}


echo json_encode($data);



?>