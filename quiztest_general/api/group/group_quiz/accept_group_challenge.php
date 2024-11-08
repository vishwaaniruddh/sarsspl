<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');

$testid=$_POST['testid'];
$groupid=$_POST['groupid'];
$standard=$_POST['std'];
$topic=$_POST['topicid'];
$subject=$_POST['subid'];



// $testid=3426;
// $groupid=48;


$sql="UPDATE group_quiz_notification set is_accepted=1 where testid='".$testid."'";
 


  if(mysqli_query($con,$sql)){
        
        $select=mysqli_query($con,"SELECT concat(member0,',',member1,',',member2,',',member3,',',created_by) as members from groups where id='".$groupid."'");
        
        $select_result=mysqli_fetch_assoc($select);
        
        $member=$select_result['members'];
        
        $ar=explode(',',$member);
        
        foreach($ar as $key => $value){
            
            if($value!=0){
                

                
                
                $insert_sql=mysqli_query($con,"INSERT INTO group_quiz_notification(groupid,testid,player,standard,topic,subject,is_accepted) VALUES('".$groupid."','".$testid."','".$value."','".$standard."','".$topic."','".$subject."',1)");
                
                   $select_q=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
    
    
    
    
                // up date oppID to quiz_result
                $update_sql_result=mysqli_query($con,"UPDATE quiz_result set p2='Gr.".$groupid."' where id='".$testid."'");
                
            }
            
        }
        
        echo json_encode('1');
        
        
        // $delete_sql=mysqli_query($con,"delete from group_response where testid='".$testid."' and groupid='".$groupid."'");    
        
    }
    else{
        echo json_encode('0');
    }
    
   
   
   

        
$initiator_sql=mysqli_query($con,"select groupid from group_quiz_notification where testid='".$testid."' and groupid<>'".$groupid."'");




$initiator_sql_result=mysqli_fetch_assoc($initiator_sql);

$initiator_groupid=$initiator_sql_result['groupid'];




 $select1=mysqli_query($con,"SELECT player from group_quiz_notification where groupid='".$initiator_groupid."'");
        

        while($select_result1=mysqli_fetch_assoc($select1)){
        $member1=$select_result1['player'];
        
        $arr=explode(',',$member1);
        
        foreach($arr as $key => $value){
            
            if($value!=0){
                
                
                $select_q=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
        
        $select_q_result=mysqli_fetch_assoc($select_q);
        
        
        $question=$select_q_result['questions_ids'];
        
        $ques_arr=explode(',',$question);
        
        foreach($ques_arr as $key => $val){
            if($val!=0){

        mysqli_query($con,"INSERT INTO group_response(testid,question_id,groupid,player) VALUES('".$testid."','".$val."','".$initiator_groupid."' ,'".$value."')");
                
            }
        
        }
     }
        }
                    
        }
        
        
        
        
        
        
         $select=mysqli_query($con,"SELECT player from group_quiz_notification where groupid='".$groupid."'");
        

        while($select_result=mysqli_fetch_assoc($select)){
        $member=$select_result['player'];
        
        $ar=explode(',',$member);
        
        foreach($ar as $key => $value){
            
            if($value!=0){
                
                
                $select_q=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");
        
        $select_q_result=mysqli_fetch_assoc($select_q);
        
        
        $question=$select_q_result['questions_ids'];
        
        $ques_arr=explode(',',$question);
        
        foreach($ques_arr as $key => $val){
            if($val!=0){

        mysqli_query($con,"INSERT INTO group_response(testid,question_id,groupid,player) VALUES('".$testid."','".$val."','".$groupid."' ,'".$value."')");
                
            }
        
        }
     }
        }
                    
        }

    

?>