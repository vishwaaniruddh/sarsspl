<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');



$userid=$_POST["userid"];
$testid=$_POST["testid"];
$groupid=$_POST["groupid"];
$time=$_POST["time"];
$question_id=$_POST["qid"];
$index=$_POST["qindex"];
$submit=$_POST["issubmit"]; // , IsTimeEnd?"0":"1")


// $userid=115;
// $testid=3432;
// $groupid=48;
// $time=15;
// $question_id=14538;
// $submit=1;


// $response=1;
// check if its group1 or group2

$check_sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);
    
$check_sql_result=mysql_fetch_assoc($check_sql);

$group1=$check_sql_result['p1'];
$group2=$check_sql_result['p2'];


        $group1 = preg_replace('/[^0-9]/', '', $group1);
        $group2 = preg_replace('/[^0-9]/', '', $group2);




// get questions key
$qid=$check_sql_result['questions_ids'];

$p1_qid_arr = explode (",", $qid);
$q_key = array_search ($question_id, $p1_qid_arr);

//get answers key
$aid=$get_result['answers'];
$aid_arr = explode (",", $aid);  
$a_key = array_search ($response, $aid_arr);

if($submit == 1) {
 
if($groupid==$group1){
             
        

       
$sql=mysql_query("select * from group_response where testid='".$testid."' and groupid='".$groupid."' and question_id='".$question_id."'");


while($sql_result=mysql_fetch_assoc($sql)){
    
    $ans[]=$sql_result['responses'];
    $timea[]=$sql_result['responses'].$sql_result['timetaken'];

    
}


$a_count=array_count_values_of('a',$ans);
$b_count=array_count_values_of('b',$ans);
$c_count=array_count_values_of('c',$ans);
$d_count=array_count_values_of('d',$ans);


// get the max_count
    $arr = array( 'a' => $a_count, 'b' => $b_count, 'c' => $c_count,'d' => $d_count );
    $keys = array_keys($arr, max($arr));



if(count($keys)==0){
    $response= $keys[0];
}
else{
    $response= $keys[1];
    
    foreach($timea as $key=>$val){
    
        $numbers[] = preg_replace('/[^0-9]/', '', $val);
        $letters[] = preg_replace('/[^a-zA-Z]/', '', $val);    

    }

    $num_keys = array_keys($numbers, max($numbers));
    
    
    $custom_key=$num_keys[0];
    
    $response=$letters[$custom_key];    
        
    }
    
    
    if($submit=="0" || $submit==0){
        $response='z';
    }





$correct=get_correct_ans($question_id);

       $select_sql=mysql_query("SELECT * from group_result where groupid='".$groupid."' and question_id='".$question_id."' and testid='".$testid."'",$con);
       
       
       
$select_sql_result=mysql_fetch_assoc($select_sql);




if($response==$correct){
    $points=1;
}
else{
    
    $points=0;
}

$final_ans=$select_sql_result['final_ans'];

if(empty($final_ans)){
    

       $insert_sql="INSERT INTO group_result(groupid,testid,question_id,final_ans,timetaken,point) values('".$group1."' ,'".$testid."' ,'".$question_id."' ,'".$response."','".$time."','".$points."')";
       
   
    
    
        


    
    if(mysql_query($insert_sql,$con)){
     
       $count_sql=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$groupid."' and testid='".$testid."'",$con);
       
       $count_sql_result=mysql_fetch_assoc($count_sql);
        
        echo $count_sql_result['oppcount'];
     
     
    }
    else{
        echo 0;
    }
    
   
}
else{
     echo -1;
    
}

    
}



else{
  
  
  $sql=mysql_query("select * from group_response where testid='".$testid."' and groupid='".$groupid."' and question_id='".$question_id."'");



while($sql_result=mysql_fetch_assoc($sql)){
    
    $ans[]=$sql_result['responses'];
    $timea[]=$sql_result['responses'].$sql_result['timetaken'];

    
}


$a_count=array_count_values_of('a',$ans);
$b_count=array_count_values_of('b',$ans);
$c_count=array_count_values_of('c',$ans);
$d_count=array_count_values_of('d',$ans);


// get the max_count
    $arr = array( 'a' => $a_count, 'b' => $b_count, 'c' => $c_count,'d' => $d_count );
    $keys = array_keys($arr, max($arr));

if(count($keys)==0){
    $response= $keys[0];
}
else{
    $response= $keys[1];
    
    foreach($timea as $key=>$val){
    
        $numbers[] = preg_replace('/[^0-9]/', '', $val);
        $letters[] = preg_replace('/[^a-zA-Z]/', '', $val);    

    }

    $num_keys = array_keys($numbers, max($numbers));
    
    
    $custom_key=$num_keys[0];
    $response=$letters[$custom_key];    
        
    }
    
    
        
    if($submit=="0" || $submit==0){
    $response='z';
}


  $correct=get_correct_ans($question_id);

$select_sql=mysql_query("SELECT * from group_result where groupid='".$group2."' and question_id='".$question_id."' and testid='".$testid."'",$con);


$select_sql_result=mysql_fetch_assoc($select_sql);

$final_ans=$select_sql_result['final_ans'];


if($response==$correct){
    $points=1;
}
else{
    
    $points=0;
}



if(empty($final_ans)){
    
    
        $insert_sql="INSERT INTO group_result(groupid,testid,question_id,final_ans,timetaken,point) values('".$group2."' ,'".$testid."' ,'".$question_id."' ,'".$response."','".$time."','".$points."')";
     

    if(mysql_query($insert_sql,$con)){
           $count_sql=mysql_query("SELECT sum(point) as oppcount from group_result where groupid='".$groupid."' and testid='".$testid."'",$con);
       
       $count_sql_result=mysql_fetch_assoc($count_sql);
        
        echo $count_sql_result['oppcount'];
     
    }
    else{
        echo 0;
    }    

}

else{
    
    echo -1;
}
  
}
}
?>