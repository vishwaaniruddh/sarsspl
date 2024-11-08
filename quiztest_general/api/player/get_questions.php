<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');



$testid=$_POST['testid'];
// $testid=4996;
$desiredLength=10;
$userid=$_POST['userid'];
// $userid=183;



$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");  

while ($sql_result=mysqli_fetch_assoc($sql)) {
    $main_subtopicArray =  $sql_result['questions_ids']; 
    
    $p1 = $sql_result['p1'];
    $p2 = $sql_result['p2'];
}


 if($p1==$userid){
        $p1=$userid;
        
        $player2_name=get_name($p2,FALSE);

$data[]=['oppname'=>$player2_name];
        
    }
    else{
        $p2=$userid;
        
        $player2_name=get_name($p1,FALSE);

$data[]=['oppname'=>$player2_name];


    }
    
    
    





$checksql=mysqli_query($con,"select * from friend_initiate where testid='".$testid."' and is_accepted=1");

$get_result=mysqli_fetch_assoc($checksql);

if($get_result==true){
    
$sql=mysqli_query($con,"SELECT * from quiz_result where id='".$testid."'");  

while ($sql_result=mysqli_fetch_assoc($sql)) {
    $main_subtopicArray =  $sql_result['questions_ids']; 
    
    $p1 = $sql_result['p1'];
    $p2 = $sql_result['p2'];
}


   
   





$sub_id = explode (",", $main_subtopicArray);  


for($i=0;$i<$desiredLength;$i++){

$sql=mysqli_query($con,"select * from quiztest where srno='".$sub_id[$i]."'");
$result=mysqli_fetch_assoc($sql);


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
                        
                        
$data[]= ['data'=>['test_id'=>$testid,'player1'=>$player1,'player2'=>$userid,'question_id'=>$result['srno'],'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'mcq' => $result['mcq'],'final_ans'=>$result['final_ans'],'options'=>$options,'ideal_time'=>$ideal_time]];

    
}

echo json_encode($data);

}
else{
    echo 0;
}
?>