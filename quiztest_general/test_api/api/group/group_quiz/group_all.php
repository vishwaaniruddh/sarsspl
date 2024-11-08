<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');




// live response
$group_name=$_POST['group_name'];
$groupid=$_POST['groupid'];

// test Response
// $group_name='dus';
// $groupid=49;


$main_sql=mysql_query("select concat(member0,',',member1,',',member2,',',member3,',',created_by) as members from groups where id='".$groupid."'",$con);

$main_sql_result=mysql_fetch_assoc($main_sql);

$all_members = $main_sql_result['members'];
$all_members_arr=explode(',',$all_members);

// make proper comma seprated string

$all_members = "'" . implode ( "', '", $all_members_arr ) . "'";

$check_sql= mysql_query("SELECT * from groups where member0 NOT IN($all_members) and member1 NOT IN($all_members) and member2 NOT IN($all_members) and member3 NOT IN($all_members) and created_by NOT IN($all_members) and group_name LIKE '%".$group_name."%'",$con);

    
    
    while($check_sql_result=mysql_fetch_assoc($check_sql)){
        
        $id=$check_sql_result['id'];
        $get_group_name=$check_sql_result['group_name'];
        $data[]=['data'=>['id'=>$id,'group_name'=>$get_group_name]];    
    }

    echo json_encode($data);
?>