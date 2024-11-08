<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



// $player1=$_POST['userid'];
// $standard=8;
// echo 'userid='.$userid;
// return;



$player2=$_POST['player2'];
// $player2=166;

$delete_sql=mysql_query("select * from like_minded WHERE player2='".$player2."'",$con);
$delete_sql_result=mysql_fetch_assoc($delete_sql);
$player1_to_delete=$delete_sql_result['player1'];

$delete_interval=mysql_query("DELETE FROM like_minded WHERE created_at < (NOW() - INTERVAL 30 SECOND)  and player1='".$player1_to_delete."'",$con);

 $delete_quiz_result=mysql_query("DELETE FROM quiz_result WHERE created_at < (NOW() - INTERVAL 50 SECOND)  and p2=''",$con);

// group notification self delete



// end 

$sql=mysql_query("select * from like_minded WHERE player2='".$player2."'  and is_accepted=0",$con);


while($sql_result=mysql_fetch_assoc($sql)){
    

    


$player1=$sql_result['player1'];
$topic=$sql_result['topic'];
$subject=$sql_result['subject'];
$testid=$sql_result['testid'];

// $player1=$sql_result['player2'];

// get player1 name    
$name_sql=mysql_query("select * from quiz_regdetails WHERE id='".$player1."'",$con);



$player1_name=get_name($player1,TRUE);
// $player1_name=$name_sql_result['name'].' '.$name_sql_result['lname'];



//end

// get subject Name with Topic ID
    $get_sub_query=mysql_query("SELECT * from quiztest where topic='".$topic."'",$con);
    $get_sub_query_result=mysql_fetch_assoc($get_sub_query);
    
    $subid=$get_sub_query_result['subject'];

    $subject=get_topic_name($subid);
    
    
    //get topic Name
    
    $topic=get_topic_name($topic);

    
   
$data[]=['id'=>$id,'player1'=>$player1,'player1_name'=>$player1_name,'testid'=>$testid,'topic'=>$topic,'subject'=>$subject,'notification'=>'Like Minded'];        

}
 
 if($testid){
echo json_encode($data);     
 }
 else{
     echo json_encode('0');
 }
 
  


$online_sql=mysql_query("SELECT userid from online where userid='".$player2."'",$con);

$online_sql_result=mysql_fetch_assoc($online_sql);
    $player=$online_sql_result['userid'];
    
    if($player==$player2){
            $update_sql=mysql_query("UPDATE online set status=1 where userid='".$player."'",$con);
    }
    
    else if($player2!=0){
                $insert_sql=mysql_query("INSERT INTO online(userid,status) VALUES('".$player2."',1)");
    }
    

    
    $set_offline=mysql_query("UPDATE online set status=0 WHERE created_at < (NOW() - INTERVAL 15 SECOND)",$con);

    

 
// echo json_encode($data);




// Online status


?>