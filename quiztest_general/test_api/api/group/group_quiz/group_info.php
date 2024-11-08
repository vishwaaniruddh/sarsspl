<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$groupid=$_POST['groupid'];
$userid=$_POST['userid'];

// $groupid=48;
// $userid=127;



$check_sql=mysql_query("SELECT * from group_ready_notification where group_id='".$groupid."'",$con);

if($check_sql_result=mysql_fetch_assoc($check_sql)){
    


$readysql=mysql_query("SELECT sum(is_accepted) as state FROM group_ready_notification where group_id='".$groupid."' and is_accepted=1 ",$con);

if($ready_result=mysql_fetch_assoc($readysql)){
$state=$ready_result['state'];

    if($state>=1){
        $online='1';
        $update=mysql_query("update group_ready_notification set is_ready=1 where group_id='".$groupid."'",$con);
    }
    else{
        $online='0';
        $update=mysql_query("update group_ready_notification set is_ready=0 where group_id='".$groupid."'",$con);
    }
    
}


$sql=mysql_query("SELECT * from groups where id='".$groupid."'",$con);

if($sql_result=mysql_fetch_assoc($sql)){
    
$member0=$sql_result['member0'];
$member1=$sql_result['member1'];
$member2=$sql_result['member2'];
$member3=$sql_result['member3'];
$member4=$sql_result['created_by'];



$initiator=group_start_from($groupid);

$group_name=group_name($groupid);
// echo $initiator;

for($i=0;$i<=4;$i++){
$var = 'member' . $i;

if($$var!=$userid && $$var!=0){
    $id= $$var;
    
    if($id!=$initiator){
        $name=get_name($id,TRUE);
        $is_accepted=is_accepted($id,$groupid);
        $info[]=['id'=>$id,'name'=>$name,'is_accepted'=>$is_accepted];          
    }

 
}



    
}
if($initiator != $userid){
$info[]=['id'=>$initiator,'name'=>get_name($initiator,TRUE),'is_accepted'=>'1'];    
}


$data=['data'=>['group_id'=>$groupid,'group_name'=>$group_name,'info'=>$info,'group_status'=>$online]];
    echo json_encode($data);
    
}




else{
    echo json_encode('0');
}

}

else{
    echo json_encode('0');
}

?>