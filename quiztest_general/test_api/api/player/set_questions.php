<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$topic=$_POST['topicid'];
$desiredLength=10;
$json=json_encode($topic);
$player1=$_POST['player1'];

$testid=$_POST['testid'];



// for testing
// $topic=205;
// $desiredLength=10;
// $json=json_encode($topic);
// $player1=88;

// $testid=865;
// $topic_in=str_replace( array('[',']','"') , ''  , $json);
// end testing


 $sqlm=mysql_query("SELECT id,name FROM `project_catT` where id='".$topic."'",$con);
 

$row=mysql_fetch_assoc($sqlm);
$topic_name=$row['name'];




$topic_in=str_replace( array('[',']','"') , ''  , $topic);

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




$questions_ids=array();
$subtopic_id=array();

$sr=array();






for($i=0;$i<$desiredLength;$i++){
    
           $check_questions=$sr;

$check_questions=json_encode($sr);
$check_questions=str_replace( array('[',']','"') , ''  , $check_questions);

$arr=explode(',',$check_questions);


$result_ar = "'" . implode ( "', '", $arr ) . "'";

        $query="select * from quiztest WHERE sub_topic='".$main_subtopicArray[$i]."' and srno not in(".$result_ar.")  order by rand() ASC LIMIT 1";
        
    $get_sql=mysql_query($query,$con);
    
    
    
  $result=mysql_fetch_assoc($get_sql);
    
    
    
    
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
            
                  
            $sr[]= $result['srno'];
            
            $ans[]=$result['final_ans'];
            
            $sub[]= $result['sub_topic'];
            
            array_push($questions_ids,$sr);
            
            array_push($subtopic_id,$sub);

            if($total_topic_count == count($subtopic_id)){
                $subtopic_id=array();
                $sub_topic_appeard=array();


            }
            
                  
     $data[]= ['data'=>['test_id'=>$testid,'player1'=>$player1,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
  
}


$sr=json_encode($sr);      
$sr=str_replace( array('[',']','"') , ''  , $sr);

$ans=json_encode($ans);
$ans=str_replace( array('[',']','"') , ''  , $ans);

$sub=json_encode($sub);      
$sub=str_replace( array('[',']','"') , ''  , $sub);

  $update_sql="update quiz_result set p1='".$player1."',questions_ids='".$sr."',topic_ids='".$topic."',subtopic_ids='".$sub."',total_questions='".$desiredLength."',answers='".$ans."' where id='".$testid."'";
//  echo $update_sql;
  
    mysql_query($update_sql,$con );      
    
    
    // echo "INSERT INTO quiz_result(p1,test_id,questions_ids,topic_ids,subtopic_ids,total_questions,answers) VALUES('".$player1."',$testid,'".$sr."','".$topic."','".$sub."','".$desiredLength."','".$ans."')";
    


// echo json_encode($data);


?>