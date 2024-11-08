<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


$userid=$_POST['userid'];


// like minded
$like_minded="update like_minded set is_accepted=2 where player2='".$userid."'";

// friends
$friend="update friend_initiate set is_accepted=2 where friend_id='".$userid."'";

// groups initiate
$group_initiate="update group_initiate set is_accepted=2 where requested_to='".$userid."'";

// group_quiz_notification
$group_quiz_notification="update group_quiz_notification set is_accepted=2 where player='".$userid."'";

// ai_notification
$ai_notification="update ai_notification set is_accepted=2 where userid='".$userid."'";


// group_ready_notification
$group_ready_notification="update group_ready_notification set is_accepted=2 where member='".$userid."'";




mysql_query($like_minded,$con);
mysql_query($friend,$con);
mysql_query($group_initiate,$con);
mysql_query($group_quiz_notification,$con);
mysql_query($ai_notification,$con);
mysql_query($group_ready_notification,$con);


?>