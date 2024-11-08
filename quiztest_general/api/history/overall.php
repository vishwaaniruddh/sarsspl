<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$userid=$_POST['userid'];

$subjectid=$_POST['subid'];


// $userid=205;
// $subjectid=1;




for($i=1;$i<3;$i++){
    
    
    if($subjectid > 0){
        $sql = mysqli_query($con,"select * from quiz_result where p$i='".$userid."' and subject='".$subjectid."' order by id desc limit 20");
        
    }
    else{
        $sql = mysqli_query($con,"select * from quiz_result where p$i='".$userid."' order by id desc limit 20");        
    }
    
    

        
    while($sql_result = mysqli_fetch_assoc($sql)){
        
        $testid = $sql_result['id'];
        $topic = $sql_result['topic_ids'];
        $subject =  $sql_result['subject'];
        
        if ( $i== 1){
            
            $opp = $sql_result['p2'];
            $opp_player = 'p2';


        }
        else{
            $opp = $sql_result['p1'];
            $opp_player = 'p1';

        }
        
         if (strpos($opp, 'AI') === 0) {
            
            $opp_name=explode("AI",$opp);
            
            $ai_name=ai_player_name($opp_name[1]);
            
            
            $name=$ai_name;
        }else{
          
          $name = get_name($opp,FALSE);  
        }
       
        
        $topic = get_topic_name($topic);
        $subject = get_topic_name($subject);
        $correct_count = $sql_result['p'.$i.'_correct_count'];
        $opp_count = $sql_result[$opp_player.'_correct_count'];
        $player_won = $sql_result['player_won'];
        $player_responses = $sql_result['p1_responses'];
        $opp_responses = $sql_result['p2_responses'];
        
        
        if($player_won == $userid){
            $player_won ='player1'; 
        }
        else{
            $player_won ='player2';
        }
        
        
        $date=$sql_result['created_at'];
        $timestamp1 = $sql_result['created_at'];
        $timestamp = strtotime($sql_result['created_at']);
        $date = date('d-M-Y', $timestamp);
        
       

            $data[]=['testid'=>$testid,'p2'=>$opp,'name'=>$name,'p1_correct_count'=>$correct_count,'topic'=>$topic,'subject'=>$subject,'p2_correct_count'=>$opp_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp1,'opp_responses'=>$opp_responses,'player_responses'=>$player_responses];        
            
    }

}
 
$array  = $data;



function sortByOrder($a, $b) {
    return $b['testid'] - $a['testid'];
}
if(count($data)!= 0){

usort($data, 'sortByOrder');

$data = array_slice($data, 0, 10);
}

if($data){
echo json_encode($data);    
}
else{
    echo json_encode('0');
}
?>