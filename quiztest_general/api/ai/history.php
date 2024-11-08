<?php 
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
//header('Access-Control-Allow-Origin: *');
//header('Content-Type: application/json');



$userid=$_POST['userid'];
// $userid=166;
$subjectid=$_POST['subid'];
// $subjectid=3;
if($subjectid>0){
    $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($subjectid)");
    
    $topic_idarray = [];
	while($topicsql_result = mysqli_fetch_assoc($sqlm)){
		$topic_idarray[] = $topicsql_result['id'];
	}
	if(count($topic_idarray)>0){
    	$topic_idarray=json_encode($topic_idarray);
    	$topic_idarray=str_replace( array('[',']','"') , ''  , $topic_idarray);
    	$topicarr=explode(',',$topic_idarray);
    	$topic_idarray = "'" . implode ( "', '", $topicarr )."'";
    	$sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' and p2='AI' and topic_ids IN (".$topic_idarray.") and player_won!='' ORDER by created_at DESC");
	}else{
	    $sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' and p2='AI' ORDER by created_at DESC");    
	}
}
else{
    $sql=mysqli_query($con,"SELECT * from quiz_result where p1='".$userid."' and p2='AI' and player_won!='' ORDER by created_at DESC");    
}

$tot_cnt = 0;
$data = [];
while ($sql_result=mysqli_fetch_assoc($sql)) {
    

    $p2=$sql_result['p2'];
    $topic=$sql_result['topic_ids'];
    // echo $topic; 
    // echo "SELECT id,name FROM `project_catT` where under in($topic)";
    
    if($topic){
        $testid=$sql_result['id'];
        $sqlm=mysqli_query($con,"SELECT id,name FROM `project_catT` where under in($topic)");
        $row=mysqli_fetch_assoc($sqlm);
        //   $topic_name=$row['name'];
        $topic_name=get_topic_name($topic);
        
        $sqla=mysqli_query($con,"SELECT * from quiztest where topic='".$topic."'");
        $sql_resulta=mysqli_fetch_assoc($sqla);
        
        $subjectid=$sql_resulta['subject'];
        
        $get_sub=mysqli_query($con,"SELECT * from project_catT where id='".$subjectid."'");
        $get_sub_result=mysqli_fetch_assoc($get_sub);
        
        $subject=$get_sub_result['name'];
        
        $p1_correct_count=$sql_result['p1_correct_count'];
        $p2_correct_count=$sql_result['p2_correct_count'];
        $player_won=$sql_result['player_won'];
        $date=$sql_result['created_at'];
        
        
        $timestamp1 = $sql_result['created_at'];
        $timestamp = strtotime($sql_result['created_at']);
        $date = date('d-M-Y', $timestamp);
        // $time = date('Gi.s', $timestamp);
        
        $name=get_name($p2,FALSE);
          // if(count($data)<=15){
        
            $data[]=['testid'=>$testid,'p2'=>$p2,'name'=>'Artificial intelligence','p1_correct_count'=>$p1_correct_count,'topic'=>$topic_name,'subject'=>$subject,'p2_correct_count'=>$p2_correct_count,'player_won'=>$player_won,'date'=>$date,'timestamp'=>$timestamp];        
        //   }
        $tot_cnt++;
        
    }

    
}
echo json_encode($data);

?>