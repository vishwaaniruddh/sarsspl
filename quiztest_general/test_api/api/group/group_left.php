<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $groupid=36;
// $userid=120;

// for live response
$groupid=$_POST['groupid'];
$userid=$_POST['userid'];

$sql=mysql_query("SELECT concat(member0,',',member1,',',member2,',',member3) as member from groups where id='".$groupid."'",$con);

$sql_result=mysql_fetch_assoc($sql);


$member_arr=explode(',',$sql_result['member']);



for($i=0;$i<4;$i++){
    
    if($member_arr[$i]==$userid){
        
        $left_sql="update groups set member$i=0 where id='".$groupid."'";

            if(mysql_query($left_sql,$con)){
                echo json_encode('success');
            }
            else{
                echo json_encode('error');
            }
    }
    
    
}



?>