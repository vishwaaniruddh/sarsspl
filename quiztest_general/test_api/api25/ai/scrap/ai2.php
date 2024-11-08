<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);

$topic='205';
// $topic=$_POST['topicid'];
$json=json_encode($topic);
$topic_in=str_replace( array('[',']','"') , ''  , $json);

$select_subtopic_sql=mysql_query("SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'",$con);  // and sub_topic in(220)                

while ($select_subtopic_sql_result=mysql_fetch_assoc($select_subtopic_sql)) {
    $storeArray[] =  $select_subtopic_sql_result['sub_topic'];  
}
             
$total_topic_count = count($storeArray);

$sub_topic=json_encode($storeArray);

$sub_topic=str_replace( array('[',']','"') , ''  , $sub_topic);
// var_dump($sub_topic);
// return;
$loop_count=5;
$questions_ids=array();
$subtopic_id=array();

    $sr=array();

// $id=$_POST['testid'];
// $p1=32;
$p1=$_POST['userid'];
$p2="AI";

$topic=$_POST['topic'];
$userid=$_POST['userid'];
$testid=$_POST['testid'];
$dataa=$_POST['response'];


$dataa=json_decode($dataa,true);

// Get the correct Answer abd same answer is for AI id 100% correct
    
$check_sql="SELECT * from quiz_result where id='".$id."'";
// $check_sql="SELECT * from quiz_result where id=245";
$result = mysql_query($check_sql,$con);
$fetch_result=mysql_fetch_assoc($result);


  if($fetch_result['p1_responses']==null || empty($fetch_result['p1_responses'])){
      
foreach($dataa as $mainkey=>$mainvalue){

$answer[]= $mainvalue['final_ans'];
$given_ans[]=$mainvalue['ans'];
$sub_topic_ids[]=$mainvalue['sub_topic'];
$time_taken[]=$mainvalue['time'];
$qid=$_POST['qid'];
}


$sum = 0;
foreach($time_taken as $key=>$value)
{
   $sum+= $value;
}
}

$answer=$_POST['response'];
$final_ans=str_replace( array('[',']','"') , ''  , $answer);

$answer=json_encode($answer);
$answer=["a","b","c","d","a"];

$given_ans=json_encode($given_ans);
$topic=json_encode($topic);
$sub_topic_ids=json_encode($sub_topic_ids);
$time_taken=json_encode($time_taken);
        
  
for($loop=0;$loop<=$loop_count;$loop++){
    

        $topic_id = $topic[$loop];
        $quesion_appeard=json_encode($questions_ids);
        $quesion_appeard=str_replace( array('[',']') , ''  , $quesion_appeard);
        $quesion_appeard = implode(',',array_unique(explode(',', $quesion_appeard)));


        $subtopic_array=$subtopic_id;

        $sub_topic_appeard=json_encode($subtopic_id);
        $sub_topic_appeard=str_replace( array('[',']') , ''  , $sub_topic_appeard);
        $sub_topic_appeard = implode(',',array_unique(explode(',', $sub_topic_appeard)));

        
        if($loop==0){
            
                    $sql=mysql_query("select * from quiztest WHERE topic='".$topic_in."' and sub_topic in($sub_topic) order by rand() ASC LIMIT 1",$con);                
                    $result=mysql_fetch_assoc($sql);
        }
        else{


            if($total_topic_count > count($subtopic_id)){
             
             $sql=mysql_query("select * from quiztest WHERE topic in($topic_in) and sub_topic not in($sub_topic_appeard) order by rand() ASC LIMIT 1",$con);                
                    $result=mysql_fetch_assoc($sql);     
            }

             }

    if($total_topic_count <= count($sub)){

                    $sql=mysql_query("select * from quiztest WHERE topic='".$topic_in."' and sub_topic in($sub_topic) order by rand() ASC LIMIT 1",$con);                
                    $result=mysql_fetch_assoc($sql);
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
            
                  
            $sr[]= $result['srno'];
            
            $ans[]=$result['final_ans'];
            
            $sub[]= $result['sub_topic'];
            
            array_push($questions_ids,$sr);
            
            array_push($subtopic_id,$sub);

            if($total_topic_count == count($subtopic_id)){
                $subtopic_id=array();
                $sub_topic_appeard=array();


            }
            
            
       
                
                
                
            
        $data[]= ['data'=>['id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'mcq' => $result['mcq'],'options'=>$options,'final_ans'=>$result['final_ans'],'ideal_time'=>$ideal_time]];


}
        

     
             // 3) Get player2 response
            $totalq=count($answer);
            
            // get 70%
            $p2_responses=array();
            $correct=(70*count($answer))/100;
            $total=count($answer);

            $loop_count=round($correct);
            $remaining_count=$total-$loop_count;
            
            // get 70% correct
            $p2_responses[$loop]=$final_ans[$loop];
            
            if($i>=$loop_count){
                if($p2_responses[$loop]==$final_ans[$loop]){
                    $p2_responses[$loop]=1;
                }
                    
            }

var_dump($p2_responses);
$data['ai_ans']=$p2_responses;

$q_id=json_encode($sr);      
$q_id=str_replace( array('[',']','"') , ''  , $q_id);

$ans_id=json_encode($ans);
$ans_id=str_replace( array('[',']','"') , ''  , $ans_id);

$userid=$_POST['userid'];

        $insert_sql="INSERT INTO quiz_result(p1,questions_ids,topic_ids,total_questions,answers) VALUES('".$userid."','".$q_id."','".$get_topic."','".$loop."','".$ans_id."')";
        // echo $insert_sql;
        
        mysql_query($insert_sql,$con );
        
        
         $sql_sql=mysql_query("select last_insert_id() as testid",$con);                
                    $result_sql=mysql_fetch_assoc($sql_sql);
            
            
            
             $data[]=$result_sql;
             
             echo json_encode($data);
                        
                    


?>