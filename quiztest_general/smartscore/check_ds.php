<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest/smartscore/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$ds=$_POST['ds'];

// $ds='DS24';


$sql=mysqli_query($con,"select * from approve_qstn where detailed_steps='".$ds."'");

while($result=mysqli_fetch_assoc($sql)){
    
$std=$result['std'];
 
 $topic=$result['topic'];
 $topic_name=get_topic_name($topic);
 
 $sub_topic=$result['sub_topic'];
 $sub_topic_name=get_topic_name($sub_topic);

$ds=$result['detailed_steps'];
$hint=$result['hint'];
$correct_ans=$result['correct_answer'];
$final_a=$result['final_ans'];
$std=$result['std'];



         if($result['imgf']){
              $mcq="http://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$result["imgf"];     
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
        
        $data[]= ['data'=>['id'=>$result['srno'],'std'=>$std,'topic'=>$topic_name,'detailed_steps'=>$ds,'final_a'=>$final_a,'sub_topic'=>$sub_topic_name,'correct_ans'=>$correct_ans,'is_image'=>$is_image,'mcq'=>$mcq,'options'=>$options,'final_ans'=>$result['final_ans']]];

}
        
        echo json_encode($data);


?>
