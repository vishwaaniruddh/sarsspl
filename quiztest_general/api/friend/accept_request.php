<?php include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$p2_id = $_POST["p2_id"];
$p1_id = $_POST["p1_id"];
$isAccept = $_POST["IsAccept"];

$check_sql = mysqli_query($con,"select * from friend_request where p2_id='".$p1_id."' and p1_id='".$p2_id."'");// here player 1 and player 2 are reverse because player 2 is accepting request

    if($check_sql_result = mysqli_fetch_assoc($check_sql)){
        $rowid = $check_sql_result['id'];
        if($isAccept == '1'){
            //$p1_id = $check_sql_result['p1_id'];
            $sqlfrnd1="INSERT into quiz_friends(user_id,friend_id) VALUES('".$p1_id."','".$p2_id."')";
            $sql_reversefrnd="INSERT into quiz_friends(user_id,friend_id) VALUES('".$p2_id."','".$p1_id."')";
            mysqli_query($con,$sqlfrnd1);
            mysqli_query($con,$sql_reversefrnd);
            $sql_delete="DELETE FROM `friend_request` WHERE id=".$rowid;
            mysqli_query($con,$sql_delete);
            echo json_encode("1");
        } else if($isAccept == '2') {
            $sql_delete="DELETE FROM `friend_request` WHERE id=".$rowid;
            mysqli_query($con,$sql_delete);
            echo json_encode("3");
        }
    } else {
        echo json_encode("2");
    }
    
?>