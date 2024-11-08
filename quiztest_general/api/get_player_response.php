<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

error_reporting(0);

// $id=96;

// $p1=$_POST['id'];

$player=$POST['userid'];
$standard=$_POST['std'];
$subject=$_POST['sub'];
$subtopic_ids=$_POST['subtopic_id'];
$topic_ids=$POST['topic'];
$total_questions='5';

$p2_correct=$total_questions;
$p2_time_taken=$p2_correct*20;

$player_id=$_POST['userid'];


$check_sql="SELECT * from quiz_result where id='".$id."'";
$result = mysqli_query($con,$check_sql);
$fetch_result=mysqli_fetch_assoc($result);

$testid=$fetch_result['id'];


if($player==$fetch_result['p1']){
$p1=$fetch_result['p1'];
}
if($player!=$fetch_result['p1']){
    $p2=$player;
}


$sql="UPDATE quiz_result set p2='".$p2."' WHERE id='".$testid."'";
 if (mysqli_query($con,$sql )) {
            // echo "Updated successfully";
        } else {
            echo "Error: " . $update_sql . "<br>" . mysqli_error($con);
        }




$data1=array(
            testid=>$testid,
            userid=>$player_id,
            sub_topics=>'123,254,365,4520,1256',
            responce=> [
                player_response=>'a,b,c,d,e',
                player_time=>'20,21,1,5,23',
            ]
        );


$data1['userid'];











// echo json_encode($data1);

return ;

$data=array(
    array(
        'id'=>'21',
    
    "topic"=> "205",
    "sub_topic"=>"45",
    "final_ans"=> "c",
    "given_ans"=>'c',
    "ideal_time"=> 20,
    "time_taken"=>15
    ),
    array(
        'id'=>'11',
    "topic"=> "205",
    "sub_topic"=>"54",
    "final_ans"=> "a",
    "given_ans"=>'c',
    "ideal_time"=> 20,
    "time_taken"=>12
    ),
    array(
        'id'=>'11',
    "topic"=> "205",
    "sub_topic"=>"58",
    "final_ans"=> "a",
    "given_ans"=>'c',
    "ideal_time"=> 20,
    "time_taken"=>26
    ),
    array(
        'id'=>'11',
    "topic"=> "205",
    "sub_topic"=>"201",
    "final_ans"=> "b",
    "given_ans"=>'c',
    "ideal_time"=> 20,
    "time_taken"=>18
    ),
    array(
        'id'=>'11',
    "topic"=> "205",
    "sub_topic"=>"568",
    "final_ans"=> "d",
    "given_ans"=>'d',
    "ideal_time"=> 20,
    "time_taken"=>24
    ),
    );

echo json_encode($data);

return ;
// Get the correct Answer abd same answer is for AI id 100% correct
    
foreach($data as $mainkey=>$mainvalue){

$answer[]= $mainvalue['final_ans'];
$given_ans[]=$mainvalue['given_ans'];
$topic=$mainvalue['topic'];
$sub_topic_ids[]=$mainvalue['sub_topic'];
$time_taken[]=$mainvalue['time_taken'];
    
}

$sum = 0;
foreach($time_taken as $key=>$value)
{
   $sum+= $value;
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

$check_sql="SELECT * from quiz_result where id='".$id."'";
$result = mysqli_query($con,$check_sql);
$fetch_result=mysqli_fetch_assoc($result);

    
    //For Check Answers
        // 1) Getcorrect_answers
        
          $final_answer=$fetch_result['answers'];
          $final_answer= explode (",", $final_answer);
          
        //   echo $final_answer[0];
        // 2) Get player1 response
        
            $final_p1_ans=$fetch_result['p1_responses'];
            $final_p1_ans= explode (",", $final_p1_ans);  
    
    // Count total answer count player1
        $count_p1=0;
        for($i=0;$i<=$total_questions;$i++){
            
                if($final_answer[$i]==$final_p1_ans[$i]) {
                    $count_p1++;
                }
        }
    
    
    $update_sql="UPDATE  quiz_result set p2='".$p2."' ,standard='".$standard."',subject='".$subject."',topic_ids='".$topic."', subtopic_ids='".$sub_topic_ids."', total_questions='".$total_questions."',answers='".$final_ans."', p1_responses='".$final_given_ans."', p2_responses='".$final_ans."' ,p1_correct='".$count_p1."',p2_correct='".$p2_correct."', p1_time_taken='".$final_time_taken."', p2_time_taken='".$p2_time_taken."'  WHERE id='".$id."'";
        
        
        if (mysqli_query($con,$update_sql )) {
            // echo "Updated successfully";
        } else {
            echo "Error: " . $update_sql . "<br>" . mysqli_error($con);
        }




    if($fetch_result['p1_correct'] > $fetch_result['p2_correct']){
        
        $update_player_won="UPDATE quiz_result set player_won='".$p1."' WHERE id='".$id."'";
        mysqli_query($con,$update_player_won);
     }

    if($fetch_result['p1_correct'] < $fetch_result['p2_correct']){
            
        $update_player_won="UPDATE quiz_result set player_won='".$p2."' WHERE id='".$id."'";
        mysqli_query($con,$update_player_won );
                            

    }
    
    if($fetch_result['p1_correct'] == $fetch_result['p2_correct']){
        
        if($fetch_result['p1_time_taken'] > $fetch_result['p2_time_taken']){
               $update_player_won="UPDATE quiz_result set player_won='".$p1."' WHERE id='".$id."'";
        mysqli_query($con,$update_player_won);
        }

        if($fetch_result['p1_time_taken'] < $fetch_result['p2_time_taken']){
            $update_player_won="UPDATE quiz_result set player_won='".$p2."' WHERE id='".$id."'";
            mysqli_query($con,$update_player_won );
        }
        
    }   
       
       
       $quize_result=['winner'=>$fetch_result['player_won']];
       
       echo json_encode($quize_result);
       

?>