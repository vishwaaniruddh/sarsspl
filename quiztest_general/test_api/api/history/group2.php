<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];

$subjectid=$_POST['subid'];

// $userid=166;
// $subjectid=3;


$get_group=mysql_query("select * from groups where member0='".$userid."' OR member1='".$userid."' OR member2='".$userid."' OR member3='".$userid."' OR created_by='".$userid."'",$con);

while($get_group_result=mysql_fetch_assoc($get_group)){
    
    $groupid[]=$get_group_result['id'];
    $groupname[]=$get_group_result['group_name'];

}


// from quiz_result table get group info


    if($groupid || !empty($groupid)){
   
foreach($groupid as $key => $value){
    
    if($subjectid>0){

    $quiz_sql=mysql_query("select * from quiz_result where p1='Gr".$value."' and subject='".$subjectid."'",$con);
    
    }
    else{
        
            $quiz_sql=mysql_query("select * from quiz_result where p1='Gr".$value."'",$con);
    }
   

       
  
       
    while($quiz_sql_result=mysql_fetch_assoc($quiz_sql)){
        
        $id=$quiz_sql_result['id'];
        
        $p1=$quiz_sql_result['p1'];
        $p1 = preg_replace('/[^0-9]/', '', $p1);
        
        $p2=$quiz_sql_result['p2'];
        $p2 = preg_replace('/[^0-9]/', '', $p2);
                
                
        $p1_count=$quiz_sql_result['p1_correct_count'];
        
        $p1_name=group_name($p1);
        $p2_name=group_name($p2);
        
        $p2_count=$quiz_sql_result['p2_correct_count'];
        $result=$quiz_sql_result['player_won'];

        $subject=$quiz_sql_result['subject'];        
        $sub=get_topic_name($subject);
        
        $topic=$quiz_sql_result['topic_ids'];
        $topic=get_topic_name($topic);
        
        $created_at=$quiz_sql_result['created_at'];
        
        $result = preg_replace('/[^0-9]/', '', $result);
        
        $data[]=['testid'=>$id,'subject'=>$sub,'topic'=>$topic,'mygroup'=>$p1,'oppgroup'=>$p2,'myGroupName'=>$p1_name,'oppGroupName'=>$p2_name,'p1_correct_count'=>$p1_count,'p2_correct_count'=>$p2_count,'player_won'=>$result,'date'=>$created_at];
        
    }    
    
   }
   



foreach($groupid as $key => $value){
    
    if($subjectid>0){
         $quiz_sql=mysql_query("select * from quiz_result where p2='Gr.".$value."' and subject='".$subjectid."'",$con);
    }
    else{
        $quiz_sql=mysql_query("select * from quiz_result where p2='Gr.".$value."'",$con);        
    }
   
   
 

    while($quiz_sql_result=mysql_fetch_assoc($quiz_sql)){
        
         $id=$quiz_sql_result['id'];
        
        $p1=$quiz_sql_result['p1'];
        $p1 = preg_replace('/[^0-9]/', '', $p1);
        
        $p2=$quiz_sql_result['p2'];
        $p2 = preg_replace('/[^0-9]/', '', $p2);

         $p1_name=group_name($p1);
        $p2_name=group_name($p2);
        
        
        
        $p2_count=$quiz_sql_result['p2_correct_count'];
        $p1_count=$quiz_sql_result['p1_correct_count'];
        $result=$quiz_sql_result['player_won'];
        
          $subject=$quiz_sql_result['subject'];        
        $sub=get_topic_name($subject);
        
        $topic=$quiz_sql_result['topic_ids'];
        $topic=get_topic_name($topic);
        
        $created_at=$quiz_sql_result['created_at'];
        
        
        $result = preg_replace('/[^0-9]/', '', $result);
        
    
           $data[]=['testid'=>$id,'subject'=>$sub,'topic'=>$topic,'mygroup'=>$p2,'oppgroup'=>$p1,'myGroupName'=>$p2_name,'oppGroupName'=>$p1_name,'p2_correct_count'=>$p2_count,'p1_correct_count'=>$p1_count,'winner'=>$result,'date'=>$created_at];
           
           
        
    }
}

        $newdata=$data;

        $arr = array();

        if($newdata || !empty($newdata)){
            
            foreach ($newdata as $key => $row){
                $arr[$key] = $row['testid'];
            }
        
        array_multisort($arr, SORT_DESC, $newdata);
        
        $output = array_slice($newdata, 0, 9);
        echo json_encode($output);
            
        }
        else{
            echo json_encode('2');
        }
 
 
 
}

else{
    echo json_encode('0');
}

?>
