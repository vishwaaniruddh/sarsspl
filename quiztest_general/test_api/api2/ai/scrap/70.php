<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');



$topic=205;
$total=5;
$testid=246;
$desiredLength=10;
$json=json_encode($topic);




// for test id

$last_id=mysql_query("SELECT test_id FROM quiz_result ORDER BY id DESC LIMIT 1",$con);

$get_result=mysql_fetch_assoc($last_id);

if($get_result['test_id']==null || empty($get_result['test_id'])){
$test_id=1;    
}

else{
$test_id=$get_result['test_id']+1;    
}



// end last id search

$topic_in=str_replace( array('[',']','"') , ''  , $json);


$select_subtopic_sql=mysql_query("SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'",$con);  

while ($select_subtopic_sql_result=mysql_fetch_assoc($select_subtopic_sql)) {
    $main_subtopicArray[] =  $select_subtopic_sql_result['sub_topic'];  
}



$newArray = array();
// create a new array with AT LEAST the desired number of elements by joining the array at the end of the new array
while(count($newArray) <= $desiredLength){
    $newArray = array_merge($newArray, $main_subtopicArray);
}

$main_subtopicArray = array_slice($newArray,1, $desiredLength);

for($i=0;$i<$desiredLength;$i++){
    
  $get_sql=mysql_query("select * from quiztest WHERE topic='".$topic."' and sub_topic='".$main_subtopicArray[$i]."' order by rand() ASC LIMIT 1",$con);
    
  $result=mysql_fetch_assoc($get_sql);
    
     $options=array("a"=>$result["a"],"b"=>$result["b"],"c"=>$result["c"],"d"=>$result["d"]);
     
            
                if($options["a"]==$result['final_ans']){
                    $final_ans="a";
                }
                elseif($options["b"]==$result['final_ans']){
                    $final_ans="b";
                }
                elseif($options["c"]==$result['final_ans']){
                    $final_ans="c";
                }
                elseif($options["d"]==$result['final_ans']){
                    $final_ans="d";
                }
                
                
                $ideal_time=$result['ideal_time'];
                  
                  if($ideal_time=='T1'){
                     $ideal_time=30; 
                  }
                  elseif($ideal_time=='T2'){
                     $ideal_time=20;       
                  }
                    elseif($ideal_time=='T3'){
                     $ideal_time=45;       
                  }
                    elseif($ideal_time=='T4'){
                     $ideal_time=60;       
                  }
                  
                  
   
  
  $insert_sql="INSERT INTO quiz_result(p1,p2,count,test_id,questions_ids,topic_ids,subtopic_ids,total_questions,answers,time) VALUES(21,'AI','".$i."',$test_id,'".$result['srno']."','".$topic."','".$main_subtopicArray[$i]."','".$desiredLength."','".$result['final_ans']."','".$ideal_time."')";
  
    mysql_query($insert_sql,$con );
  
  $data[]= ['data'=>['test_id'=>$test_id,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
}

echo json_encode($data);

?>


