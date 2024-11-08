<?php session_start();
date_default_timezone_set("Asia/Calcutta");  
$localhost = "localhost";
$username = "u444388293_csDBPanel";
$password = "AVav@@2024";
$dbname = "u444388293_capitalsoftDB";
$store_url = "https://stocklink.sarsspl.com/";
// db connection
$con = $connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

$datetime = date('Y-m-d h:i:s');

if(isset($_SESSION['userId'])){
  $userid = $_SESSION['userId'];
}


if (!function_exists('getUsername')) {

  function getUsername($id, $vendor = FALSE)
  {
      global $con;

      
      $sql = mysqli_query($con, "select * from user where userid ='" . $id . "'");
      $sql_result = mysqli_fetch_assoc($sql);
      return ucwords($sql_result['name']);
  }
}

?>