<?php
date_default_timezone_set('Asia/Kolkata');

$datetime = date('Y-m-d h:i:s');

$host = "localhost"; // Database host
$user = "u444388293_ticketAdmin";      // Database username
$pass = "AVav@@2020";          // Database password
$db_name = "u444388293_tickets"; // Database name

$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



function getuserInfo($userid, $parameter){
    global $conn ; 

    $sql = mysqli_query($conn,"select $parameter from users where user_id = '".$userid."'");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return $sql_result[$parameter];
    }else{
        return ;
    }

}

function getClientInfo($client_id, $parameter){
    global $conn ; 

    $sql = mysqli_query($conn,"select $parameter from clients where client_id = '".$client_id."'");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return $sql_result[$parameter];
    }else{
        return ;
    }

}


?>
