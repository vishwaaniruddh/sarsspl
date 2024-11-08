<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$p1_id = $_POST["p1_id"];
$p2_id = $_POST["p2_id"];
$IsExists = mysqli_query($con,"select * from friend_request where p1_id='".$p1_id."' and p2_id='".$p2_id."'");// here player 1 and player 2 are reverse because player 2 is accepting request
$IsExists2 = mysqli_query($con,"select * from friend_request where p1_id='".$p2_id."' and p2_id='".$p1_id."'");

if($check_sql_result = mysqli_fetch_assoc($IsExists)){
    echo json_encode('3'); 
} else if($check_sql_result = mysqli_fetch_assoc($IsExists2)){
    echo json_encode('4'); 
} else{

    //echo "p1_id: ". $p1_id . " and p2_id" . $p2_id;
    $check_sql = mysqli_query($con,"select * from quiz_friends where user_id='".$p1_id."' and friend_id='".$p2_id."'");

    if($check_sql_result = mysqli_fetch_assoc($check_sql)){
        echo json_encode('2'); 
    } else {
        $sqlfrnd1="INSERT into friend_request (p1_id,p2_id, crdt) VALUES('".$p1_id."','".$p2_id."', now())";
        mysqli_query($con,$sqlfrnd1);
        echo json_encode('1');
    }

}

?>