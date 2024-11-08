<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$testid=$_POST['testid'];
// $testid=$_POST['testid'];
$desiredLength=10;
$player2=$_POST['userid'];
$subjectid=$_POST['sub'];

$checksql=mysql_query("select * from like_minded where testid='".$testid."' and is_accepted=1",$con);

$get_result=mysql_fetch_assoc($checksql);

if($get_result==true){
    
$sql=mysql_query("SELECT * from quiz_result where id='".$testid."'",$con);  

while ($sql_result=mysql_fetch_assoc($sql)) {
    $main_subtopicArray =  $sql_result['questions_ids'];  

}
$sub_id = explode (",", $main_subtopicArray);  


for($i=0;$i<$desiredLength;$i++){

$sql=mysql_query("select * from quiztest where srno='".$sub_id[$i]."'",$con);
$result=mysql_fetch_assoc($sql);


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
                        
                        
$data[]= ['data'=>['test_id'=>$testid,'player1'=>$player1,'player2'=>$player2,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];

    
}

echo json_encode($data);

}
else{
    echo 0;
}
?>