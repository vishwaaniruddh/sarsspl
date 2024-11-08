<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$testid=$_REQUEST['testid'];

$testid = 43;

if($testid > 0){
    
    $sql = mysqli_query($con,"select * from competetion_quiz where id='".$testid."'");
    
    $sql_reuslt= mysqli_fetch_assoc($sql);
    
    $topic = $sql_reuslt['topic'];
    $desiredLength=$sql_reuslt['total_qn'];
    $p1= $sql_reuslt['p1'];
    $p2= $sql_reuslt['p2'];
    $json=json_encode($topic);



$block_sql = mysqli_query($con,"select * from competetion_payment where userid = '".$p1."' order by id desc");
$block_sql_result = mysqli_fetch_assoc($block_sql);

echo $payment_date = $block_sql_result['created_at']; 





    $topic_in=str_replace( array('[',']','"') , ''  , $json);
            // end testing
    $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where id='".$topic."'");
            
        $row=mysqli_fetch_assoc($sqlm);
        $topic_name=$row['name'];
        
        $topic_in=str_replace( array('[',']','"') , ''  , $topic);
        $select_subtopic_sql=mysqli_query($con,"SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'");
        while ($select_subtopic_sql_result=mysqli_fetch_assoc($select_subtopic_sql)) {
            $main_subtopicArray[] =  $select_subtopic_sql_result['sub_topic'];  
        }
        
        $newArray = array();
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
        $get_sql=mysqli_query($con,$query);
        
        $result=mysqli_fetch_assoc($get_sql);
        
        if($result['imgf']){
          $mcq="https://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$result["imgf"];  
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
                    
                    
        $ideal_time='30';  // set time 30 seconds by default
        $sr[]= $result['srno'];
        $ans[]=$result['final_ans'];
        $sub[]= $result['sub_topic'];
        array_push($questions_ids,$sr);
        array_push($subtopic_id,$sub);
        if($total_topic_count == count($subtopic_id)){
            $subtopic_id=array();
            $sub_topic_appeard=array();
        }
                
    $check_sql = mysqli_query($con,"select * from competetion_quiz_result where testid='".$testid."' and question_id='".$result['srno']."'");
    $check_sql_result = mysqli_fetch_assoc($check_sql);
    
    if($check_sql_result){
        
    }else{
        // mysqli_query($con,"insert into competetion_quiz_result(testid,question_id,subtopic_id,answer,player_id) values('".$testid."','".$result['srno']."','".$result['sub_topic']."','".$result['final_ans']."','".$p1."')");
        
       /* mysqli_query($con,"insert into competetion_quiz_result(testid,question_id,subtopic_id,answer,player_id) values('".$testid."','".$result['srno']."','".$result['sub_topic']."','".$result['final_ans']."','".$p2."')") ;*/
    }
        
        
        
        $data[]= ['data'=>['test_id'=>$testid,'player1'=>$p1,'player2'=>$p2,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
        }
    // echo json_encode($data);
    }
    else{
        echo 0;
    }
    
    
    

?>