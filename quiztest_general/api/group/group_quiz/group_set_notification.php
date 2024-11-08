<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




// for live responses
$userid=$_POST['userid'];
$group1=$_POST['groupid'];
$group2=$_POST['oppgroupid'];
$standard=$_POST['std'];
$topic=$_POST['topicid'];
$subid=$_POST['subid'];
$desiredLength=10;


// for test responses

// $group1=48;
// // $group2=49;
// $standard=8;
// $topic=46;
// $subid=3;
// $desiredLength=10;
// $userid=88;



// NOTIFICATON
   
   
   if(!$group2){
        
        $insert_sql_result="INSERT INTO quiz_result(p1,standard,subject) VALUES('Gr".$group1."','".$standard."','".$subid."')";

if (mysqli_query($con,$insert_sql_result) === TRUE) {

    $testid = mysqli_insert_id();
    
$sql=mysqli_query($con,"SELECT concat(member0,',',member1,',',member2,',',member3,',',created_by) as member from groups WHERE id='".$group1."'");

$sql_result=mysqli_fetch_assoc($sql);

$member=explode(',',$sql_result['member']);

foreach($member as $key => $value){
    if($value!=0){
        mysqli_query($con,"INSERT INTO group_response(testid,groupid,player) VALUE($testid,$group1,$value)");        
    }

}


$sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where id='".$topic."'");
 

$row=mysqli_fetch_assoc($sqlm);
$topic_name=$row['name'];




$topic_in=str_replace( array('[',']','"') , ''  , $topic);

$select_subtopic_sql=mysqli_query($con,"SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'");  

while ($select_subtopic_sql_result=mysqli_fetch_assoc($select_subtopic_sql)) {
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

$arr=explode(',',$check_questions);

$result_ar = "'" . implode ( "', '", $arr ) . "'";


  $get_sql=mysqli_query($con,"select * from quiztest WHERE sub_topic='".$main_subtopicArray[$i]."' and srno not in(".$result_ar.")  order by rand() ASC LIMIT 1");
    
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
            
                  
     $data[]= ['data'=>['test_id'=>$testid,'group1'=>$player1,'group2'=>$player2,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
  
}


$sr=json_encode($sr);      
$sr=str_replace( array('[',']','"') , ''  , $sr);

$ans=json_encode($ans);
$ans=str_replace( array('[',']','"') , ''  , $ans);

$sub=json_encode($sub);      
$sub=str_replace( array('[',']','"') , ''  , $sub);

  $update_sql="update quiz_result set questions_ids='".$sr."',topic_ids='".$topic."',subtopic_ids='".$sub."',total_questions='".$desiredLength."',answers='".$ans."' where id='".$testid."'";
//  echo $update_sql;
  
    mysqli_query($con,$update_sql );      
    
    $notification_sql1=mysqli_query($con,"SELECT concat(member0,',',member1,',',member2,',',member3,',',created_by) as members from groups where id='".$group1."'");

while($not_result1=mysqli_fetch_assoc($notification_sql1)){
    
    
    $member1=$not_result1['members'];
    $member_arr1=explode(',',$member1);

    foreach($member_arr1 as $key =>$value){
        
        if($value!=0){
        $insert_sql1=mysqli_query($con,"INSERT into group_quiz_notification(groupid,testid,player,standard,topic,subject) VALUES('".$group1."','".$testid."','".$value."','".$standard."','".$topic."','".$subid."')");            
        }


    }
}

 
 $created_by_update=mysqli_query($con,"UPDATE group_quiz_notification set is_accepted=1, where player='".$userid."' and testid='".$testid."' and groupid='".$group1."'");



$data=['testid'=>$testid];

echo json_encode($data);

}
else{
    echo json_encode(0);
}


   }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   else{
       
   
   
$insert_sql_result="INSERT INTO quiz_result(p1,standard,subject) VALUES('Gr".$group1."','".$standard."','".$subid."')";

if (mysqli_query($con,$insert_sql_result) === TRUE) {

    $testid = mysqli_insert_id();
    
$sql=mysqli_query($con,"SELECT concat(member0,',',member1,',',member2,',',member3,',',created_by) as member from groups WHERE id='".$group1."'");

$sql_result=mysqli_fetch_assoc($sql);

$member=explode(',',$sql_result['member']);

foreach($member as $key => $value){
    if($value!=0){
        mysqli_query($con,"INSERT INTO group_response(testid,groupid,player) VALUE($testid,$group1,$value)");        
    }

}







$sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where id='".$topic."'");
 

$row=mysqli_fetch_assoc($sqlm);
$topic_name=$row['name'];




$topic_in=str_replace( array('[',']','"') , ''  , $topic);

$select_subtopic_sql=mysqli_query($con,"SELECT distinct(sub_topic) from quiztest where topic='".$topic_in."'");  

while ($select_subtopic_sql_result=mysqli_fetch_assoc($select_subtopic_sql)) {
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

$arr=explode(',',$check_questions);

$result_ar = "'" . implode ( "', '", $arr ) . "'";


  $get_sql=mysqli_query($con,"select * from quiztest WHERE sub_topic='".$main_subtopicArray[$i]."' and srno not in(".$result_ar.")  order by rand() ASC LIMIT 1");
    
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
            
                  
     $data[]= ['data'=>['test_id'=>$testid,'group1'=>$player1,'group2'=>$player2,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];
  
  
}


$sr=json_encode($sr);      
$sr=str_replace( array('[',']','"') , ''  , $sr);

$ans=json_encode($ans);
$ans=str_replace( array('[',']','"') , ''  , $ans);

$sub=json_encode($sub);      
$sub=str_replace( array('[',']','"') , ''  , $sub);

  $update_sql="update quiz_result set questions_ids='".$sr."',topic_ids='".$topic."',subtopic_ids='".$sub."',total_questions='".$desiredLength."',answers='".$ans."' where id='".$testid."'";
//  echo $update_sql;
  
    mysqli_query($con,$update_sql );      
    
    $notification_sql1=mysqli_query($con,"SELECT concat(member0,',',member1,',',member2,',',member3,',',created_by) as members from groups where id='".$group1."'");

while($not_result1=mysqli_fetch_assoc($notification_sql1)){
    
    
    $member1=$not_result1['members'];
    $member_arr1=explode(',',$member1);

    foreach($member_arr1 as $key =>$value){
        
        if($value!=0){
        $insert_sql1=mysqli_query($con,"INSERT into group_quiz_notification(groupid,testid,player,standard,topic,subject) VALUES('".$group1."','".$testid."','".$value."','".$standard."','".$topic."','".$subid."')");            
        }


    }
}


// for specific group





 
 $created_by_update=mysqli_query($con,"UPDATE group_quiz_notification set is_accepted=1, where player='".$userid."' and testid='".$testid."' and groupid='".$group1."'");
 
 

 
 
 



$data=['testid'=>$testid];

echo json_encode($data);

}
else{
    echo json_encode(0);
}

}

?>