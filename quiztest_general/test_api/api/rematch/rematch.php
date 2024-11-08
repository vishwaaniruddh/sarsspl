<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




// RESPONSE
// $player1=85;
// $player2=87;
// $topic=48;
// $subject=1;
// $std=8;
// $againstid=1;


// LIVE RRSPONSE
$player1=$_POST['userid'];
// $player2=$_POST['oppid'];
$topic=$_POST['topic'];
$subject=$_POST['sub'];
$std=$_POST['std'];
$againstid=$_POST['quiz_type'];
$desiredLength=10;
$previous_testid=$_POST['previous_testid'];



$pre_sql=mysql_query("SELECT p1,p2,id from quiz_result where id='".$previous_testid."'",$con);

$pre_sql_result=mysql_fetch_assoc($pre_sql);

$p1=$pre_sql_result['p1'];


if($p1==$player1){
$p2=$pre_sql_result['p2'];
}
else {
$p2=$pre_sql_result['p1'];
}




$sql="INSERT INTO quiz_result(p1,p2,subject,standard,topic_ids) VALUES('".$player1."','".$p2."','".$subject."','".$std."','".$topic."')";


    if (mysql_query($sql,$con) === TRUE) {
    
        $testid = mysql_insert_id();
    
    }



// rematch Table request insert


$rematch_sql=mysql_query("INSERT INTO rematch(player1,testid,player2,standard,	topic,subject,againstid,is_accepted) values('".$player1."','".$testid."','".$p2."','".$std."'	,'".$topic."','".$subject."','".$againstid."',0)",$con);





  
  
  

// echo "INSERT INTO rematch(player1,	testid,	player2,standard,topic,subject,	againstid,is_accepted) values('".$player1."','".$testid."','".$p2."','".$std."'	,'".$topic."','".$subject."','".$againstid."',0)";


// return;
$data=['data'=>['testid'=>$testid,'player1'=>$player1,'oppid'=>$p2,'topic'=>$topic,'subject'=>$subject,'std'=>$std,'againstid'=>$againstid]];


if($data){
echo json_encode($data);    
}
else{
    echo json_encode('0');
}











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

// $data[]=['share_url'=>"https:www.sarmicrosystems.in/quiztest_general/api/player/player2q.php?testid=$testid"];




$questions_ids=array();
$subtopic_id=array();

$sr=array();






for($i=0;$i<$desiredLength;$i++){
    
    
$check_questions=$sr;
$check_questions=json_encode($sr);
$check_questions=str_replace( array('[',']','"') , ''  , $check_questions);


  $get_sql=mysql_query("select * from quiztest WHERE sub_topic='".$main_subtopicArray[$i]."' and srno not in('". $check_questions."') order by rand() ASC LIMIT 1",$con);
    
    
    // echo "select distinct srno,a,b,c,d,final_ans,ideal_time,mcq,topic,sub_topic,imgf from quiztest WHERE topic='".$topic."' and sub_topic='".$main_subtopicArray[$loop]."' and srno not in('". $check_questions."')  order by rand() ASC LIMIT 1";
    
    
  $result=mysql_fetch_assoc($get_sql);
    


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
            
                  
     $data[]= ['data'=>['test_id'=>$testid,'player1'=>$player1,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
  
}


$sr=json_encode($sr);      
$sr=str_replace( array('[',']','"') , ''  , $sr);

$ans=json_encode($ans);
$ans=str_replace( array('[',']','"') , ''  , $ans);

$sub=json_encode($sub);      
$sub=str_replace( array('[',']','"') , ''  , $sub);

  $update_sql="update quiz_result set questions_ids='".$sr."',topic_ids='".$topic."',subtopic_ids='".$sub."',total_questions='".$desiredLength."',answers='".$ans."' where id='".$testid."'";
//  echo $update_sql;
  
    mysql_query($update_sql,$con );      
    
    


?>