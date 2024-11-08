<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

    $pageNo = 0;
    if(isset($_GET["pageNo"])){
        $pageNo = $_GET["pageNo"];
        if($pageNo > 0) {
            --$pageNo;
        }
    }
    if(isset($_POST["pageNo"])){
        $pageNo = $_POST["pageNo"];
        if($pageNo > 0) {
            --$pageNo;
        }
    }
    $takeCount = 50;
    $takeFrom = $pageNo * $takeCount;
    $query="select * from quiztest order by `id` ASC LIMIT ".$takeFrom.", ".$takeCount."";
    $sql=mysql_query($query, $con);
    $data=[];
    while($result=mysql_fetch_assoc($sql)) {
        $std=$result['std'];
        $topic=$result['topic'];
        $topic_name=get_topic_name($topic);
        if($result['imgf']){
            $mcq="https://smartscoreanalytics.com/qstn_img/".$std."_".strtoupper($topic_name)."/".$result["imgf"];
            $is_image='1';
        } else{
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

        $ideal_time='30';
        $ans[]=$result['final_ans'];
        $sub[]= $result['sub_topic'];

        $data[]= ['id'=>$result['srno'],'sub'=>$subjectid,'topic'=>$result['topic'],'sub_topic'=>$result['sub_topic'],'is_image'=>$is_image,'mcq'=>$mcq,'options'=>$options,'final_ans'=>$result['final_ans'],'ideal_time'=>$ideal_time];
    }
        
    echo json_encode($data);
?>