<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);

// Test response
$topic='313';
$std=8;
$subjectid=3;
$desiredLength=10;
// enable for live response
// $topic=$_POST['topicid'];
// $std=$_POST['stdid'];
// $subjectid=$_POST['sub'];


 $sqlm=mysql_query("SELECT id,name FROM `project_catT` where id='".$topic."'",$con);
 

$row=mysql_fetch_assoc($sqlm);
$topic_name=$row['name'];

$json=json_encode($topic);

$topic_in=str_replace( array('[',']','"') , ''  , $json);


$userid=$_POST['userid'];

    $insert_sql="INSERT INTO quiz_result(standard,p1,p2) VALUES('".$std."','".$userid."','AI')";
        
        // echo $insert_sql;
        
        
        
    mysql_query($insert_sql,$con );

    $sql_sql=mysql_query("select last_insert_id() as testid",$con);                
$result_sql=mysql_fetch_assoc($sql_sql);

$testid=$result_sql['testid'];


$select_subtopic_sql=mysql_query("SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'",$con);  // and sub_topic in(220)                

                    
while ($select_subtopic_sql_result=mysql_fetch_assoc($select_subtopic_sql)) {
    $storeArray[] =  $select_subtopic_sql_result['sub_topic'];  
}
             
$total_topic_count = count($storeArray);
$sub_topic=json_encode($storeArray);
$sub_topic=str_replace( array('[',']','"') , ''  , $sub_topic);
// var_dump($sub_topic);

$questions_ids=array();
$subtopic_id=array();

    $sr=array();
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

// var_dump($main_subtopicArray);
// return;




for($loop=0;$loop<$desiredLength;$loop++){
    
// $custom_sql=mysql_query("SELECT questions_ids from quiz_result where id='".$testid."'",$con);
// $custom_sql_result=mysql_fetch_assoc($custom_sql);


// var_dump($custom_sql_result);
// echo $custom_sql_result['questions_ids'];


    //   $subjectid='';
      
        $topic_id = $topic[$loop];
        $quesion_appeard=json_encode($questions_ids);
        $quesion_appeard=str_replace( array('[',']') , ''  , $quesion_appeard);
        $quesion_appeard = implode(',',array_unique(explode(',', $quesion_appeard)));


        $subtopic_array=$subtopic_id;

        $check_questions=$sr;

$check_questions=json_encode($sr);
$check_questions=str_replace( array('[',']','"') , ''  , $check_questions);

$arr=explode(',',$check_questions);


$result_ar = "'" . implode ( "', '", $arr ) . "'";

    $sub_topic_appeard=json_encode($subtopic_id);
        
    $sub_topic_appeard=str_replace( array('[',']') , ''  , $sub_topic_appeard);
            
    $sub_topic_appeard = implode(',',array_unique(explode(',', $sub_topic_appeard)));
        
        $query="select * from quiztest WHERE sub_topic='".$main_subtopicArray[$loop]."' and srno not in(".$result_ar.")  order by rand() ASC LIMIT 1";
        
    $sql=mysql_query($query,$con);    
    
    $result=mysql_fetch_assoc($sql);




$sr[]= $result['srno'];
array_push($questions_ids,$sr);
            
            


  if($result['imgf']){
      $mcq="http://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$result["imgf"];

      
      $is_image='1';
}
else{
    $mcq=$result['mcq'];
          $is_image='0';
}
   
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
                
                
                $ideal_time='30';
            
                  

            
            $ans[]=$result['final_ans'];
            
            $sub[]= $result['sub_topic'];
            
            
            array_push($subtopic_id,$sub);


            if($total_topic_count == count($subtopic_id)){
                $subtopic_id=array();
                $sub_topic_appeard=array();


            }

        $data[]= ['data'=>['id'=>$result['srno'],'sub'=>$subjectid,'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq'=>$mcq,'options'=>$options,'final_ans'=>$result['final_ans'],'ideal_time'=>$ideal_time]];
  }




$q_id=json_encode($sr);      
$q_id=str_replace( array('[',']','"') , ''  , $q_id);

$ans_id=json_encode($ans);
$ans_id=str_replace( array('[',']','"') , ''  , $ans_id);


       


        // $insert_sql="INSERT INTO quiz_result(standard,p1,p2,questions_ids,subject,topic_ids,total_questions,answers) VALUES('".$std."','".$userid."','AI','".$q_id."','".$subjectid."','".$get_topic."','".$loop."','".$ans_id."')";
        
        

        $insert_sql="UPDATE quiz_result set questions_ids='".$q_id."',subject='".$subjectid."',topic_ids='".$get_topic."',total_questions='".$loop."',answers='".$ans_id."' where id='".$testid."'";
        
        // echo $insert_sql;
        
        
        
        mysql_query($insert_sql,$con );
        
        $data[]=$result_sql;
            
         echo json_encode($data);
                        
                    


?>