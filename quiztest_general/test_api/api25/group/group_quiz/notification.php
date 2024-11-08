<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$userid=$_POST['userid'];
$groupid=$_POST['groupid'];


// $userid=127;
// $groupid=48;




$get_sql=mysql_query("SELECT * from group_ready_notification where group_id='".$groupid."'",$con);

if($get_sql_result=mysql_fetch_assoc($get_sql)){
    
    $delete_group_notification=mysql_query("DELETE FROM group_ready_notification WHERE group_id='".$groupid."' ",$con);    


    
}






$sql=mysql_query("SELECT * from groups where id='".$groupid."'");

if($sql_result=mysql_fetch_assoc($sql)){
    



$member0=$sql_result['member0'];
$member1=$sql_result['member1'];
$member2=$sql_result['member2'];
$member3=$sql_result['member3'];
$created_by=$sql_result['created_by'];


if($member0==$userid){
    $initiator=$member0;
}
if($member1==$userid){
    $initiator=$member1;
}
if($member2==$userid){
    $initiator=$member2;
}
if($member3==$userid){
    $initiator=$member3;
}
if($created_by==$userid){
    $initiator=$created_by;
}
else{
    $member4=$created_by;
}

for($i=0;$i<=4;$i++){
$var = 'member' . $i;

if($$var!=$initiator && $$var!=0){
    $insert_sql=mysql_query("INSERT INTO group_ready_notification(group_id,member,is_accepted,created_by) VALUES('".$groupid."','".$$var."',0,'".$initiator."')",$con);
}
    
}
echo json_encode('1');


$select_sql=mysql_query("SELECT * from group_quiz_notification where groupid='".$groupid."'",$con);

$select_sql_result=mysql_fetch_assoc($select_sql);

$testid=$select_sql_result['testid'];
$delete_sql=mysql_query("DELETE from group_quiz_notification where testid='".$testid."'",$con);

}
else{
    echo json_encode('0');
}

?>