<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/config.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


// $groupid=36;
// $userid=85;
// $memberid=120;


// for live response
$groupid=$_POST['groupid'];
$userid=$_POST['userid'];
$memberid=$_POST['memberid'];


$sql=mysql_query("SELECT concat(member0,',',member1,',',member2,',',member3) as member,created_by from groups where id='".$groupid."'",$con);

$sql_result=mysql_fetch_assoc($sql);

$admin=$sql_result['created_by'];

$member_arr=explode(',',$sql_result['member']);

if($admin==$userid){

  for($i=0;$i<4;$i++){
    
    if($member_arr[$i]==$memberid){
        
        $left_sql="update groups set member$i=0 where id='".$groupid."'";
        // echo $left_sql;    
            if(mysql_query($left_sql,$con)){
                echo json_encode('success');
            }
            else{
                echo json_encode('error');
            }
    }
    
    
}
  
}




?>