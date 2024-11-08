<?php 

date_default_timezone_set('Asia/Kolkata');
$con2= mysql_connect("198.38.84.103","smartsco_test","test@123");
mysql_select_db("smartsco_smartscore",$con2); 






include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');








$question_id=$_POST['qid'];

// $question_id=3108;


// $question_id=$_GET['qid'];



$sql=mysql_query("select * from quiztest where srno='".$question_id."'",$con2);

$result=mysql_fetch_assoc($sql);


$std=$result['std'];
$topic=$result['topic'];
$topic_name=get_topic_name($topic);


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
        //$mcq="ggg";
        $data[]= ['data'=>['id'=>$result['srno'],'is_image'=>$is_image,'mcq'=>$mcq,'options'=>$options,'final_ans'=>$result['final_ans']]];

        
        // print_r($data);
        echo json_encode($data);


?>
