<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');


// testID
// $id=96;

$id=$_POST['testid'];
// $p1=32;
$p1=$_POST['userid'];

$p2="AI";
$standard=$_POST['std'];
$subject=$_POST['sub'];
$subtopic_ids=$_POST['subtopic_id'];
$topic_ids=$_POST['topic'];
$total_questions=5;

$p2_correct=$total_questions;
$p2_time_taken=$p2_correct*20;


$topic=$_POST['topic'];
$userid=$_POST['userid'];
$testid=$_POST['testid'];
$data=$_POST['response'];


$data=json_decode($data,true);

// Get the correct Answer abd same answer is for AI id 100% correct
    
$check_sql="SELECT * from quiz_result where id='".$id."'";
// $check_sql="SELECT * from quiz_result where id=245";
$result = mysql_query($check_sql,$con);
$fetch_result=mysql_fetch_assoc($result);


  if($fetch_result['p1_responses']==null || empty($fetch_result['p1_responses'])){
      
foreach($data as $mainkey=>$mainvalue){

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


$answer=json_encode($answer);
$given_ans=json_encode($given_ans);
$topic=json_encode($topic);
$sub_topic_ids=json_encode($sub_topic_ids);
$time_taken=json_encode($time_taken);


$final_ans=str_replace( array('[',']','"') , ''  , $answer);
$final_given_ans=str_replace( array('[',']','"') , ''  , $given_ans);
$topic=str_replace( array('[',']','"') , ''  , $topic);
$sub_topic_ids=str_replace( array('[',']','"') , ''  , $sub_topic_ids);
$final_time_taken=$sum;


// end  Get the correct Answer abd same answer is for AI id 100% correct



    
    //For Check Answers
        // 1) Getcorrect_answers
        
          $final_answer=$fetch_result['answers'];
          $final_answer= explode (",", $final_answer);
          
        //   print_r($final_answer);
        //   echo $final_answer[0];
        // 2) Get player1 response
        
            $final_p1_ans=$fetch_result['p1_responses'];
            $final_p1_ans= explode (",", $final_p1_ans);  
            
    
      // 3) Get player2 response
            $p2_responses=array();
            
            $final_p2_ans=$fetch_result['answers'];
            $final_p2_ans= explode (",", $final_p2_ans);  
            
               $count_p2=0;
            for($i=0;$i<$total_questions;$i++){
            
                $generate_random = array_rand($final_p2_ans);
                $get_random = $final_p2_ans[$generate_random];
                $p2_responses[]=$get_random;
                
                if($get_random==$final_ans[$i]){
                     $count_p2= $count_p2+10;
                }
            }
            
            $count_p2;
            $p2_responses=json_encode($p2_responses);

            $p2_responses=str_replace( array('[',']','"') , ''  , $p2_responses);

    
    // Count total answer count player1
        $count_p1=0;
        for($i=0;$i<=$total_questions;$i++){
            
                if($final_answer[$i]==$final_p1_ans[$i]) {
                    $count_p1++;
                }
        }
        
        $count_p1=$count_p1-1;
        
    // Count total answer count player2
     
        // for($i=0;$i<$total_questions;$i++){
            
        //         if($final_answer[$i]==$p2_responses[$i]) {
        //             $count_p2++;
        //         }
        // }
        
        // $count_p2=$count_p2;
        
        
        if($fetch_result['p1_responses']==null || empty($fetch_result['p1_responses'])){
        
    $final_p1_ans=json_encode($final_p1_ans);
    $final_p1_ans=str_replace( array('[',']','"') , ''  , $final_p1_ans);
    
    $update_sql="UPDATE  quiz_result set p2='".$p2."' ,standard='".$standard."',subject='".$subject."',topic_ids='".$topic."', total_questions='".$total_questions."',answers='".$final_ans."', p1_responses='".$final_p1_ans."', p2_responses='".$p2_responses."' ,p1_correct='".$count_p1."',p2_correct='".$p2_correct."', p1_time_taken='".$final_time_taken."', p2_time_taken='".$p2_time_taken."'  WHERE id='".$id."'";
    echo $update_sql;
    
    

    if (mysql_query($update_sql,$con )) {
            echo "Updated successfully";
        } else {
            echo "Error: " . $update_sql . "<br>" . mysql_error($con);
        }

}
 
    if($fetch_result['p1_correct'] > $fetch_result['p2_correct']){
        
        $update_player_won="UPDATE quiz_result set player_won='".$p1."' WHERE id='".$id."'";
        mysql_query($update_player_won,$con);
     }

    if($fetch_result['p1_correct'] < $fetch_result['p2_correct']){
            
        $update_player_won="UPDATE quiz_result set player_won='".$p2."' WHERE id='".$id."'";
        mysql_query($update_player_won,$con );
                            

    }
    
    if($fetch_result['p1_correct'] == $fetch_result['p2_correct']){
        
        if($fetch_result['p1_time_taken'] > $fetch_result['p2_time_taken']){
               $update_player_won="UPDATE quiz_result set player_won='".$p1."' WHERE id='".$id."'";
        mysql_query($update_player_won,$con);
        }

        if($fetch_result['p1_time_taken'] < $fetch_result['p2_time_taken']){
            $update_player_won="UPDATE quiz_result set player_won='".$p2."' WHERE id='".$id."'";
            mysql_query($update_player_won,$con );
        }
        
    }   
       
       $player1_per=($fetch_result['p1_correct']/$total_questions)*100;
       $player2_per=($fetch_result['p2_correct']/$total_questions)*100;
       
       $quize_result=['winner'=>$fetch_result['player_won'],'player1'=>$player1_per,'player2'=>$player2_per];
       
       echo json_encode($quize_result);
       

?>