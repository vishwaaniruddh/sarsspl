<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$me=$_GET['me'];
$opp=$_GET['opp'];


$myclass=get_student_class($me);
$oppclass=get_student_class($opp);


if($myclass==$oppclass && !empty($oppclass) && $oppclass!=0){
    $check_sql=mysql_query("select * from quiz_friends where user_id='".$me."' and friend_id='".$opp."'");
$check_sql_result=mysql_fetch_assoc($check_sql);

if(!$check_sql_result){

    $sql="INSERT into quiz_friends(user_id,friend_id) VALUES('".$me."','".$opp."')";
    
    $sql_reverse="INSERT into quiz_friends(user_id,friend_id) VALUES('".$opp."','".$me."')";

    if(mysql_query($sql,$con) && mysql_query($sql_reverse,$con)){
        echo json_encode('succcesfully becomes friends');
    }
    else{
        echo json_encode('0');
    }    
}
else{
    echo 'You are already friends ! :) ';
}


}

else{
    echo 'cannot be friends with other class';
}



?>