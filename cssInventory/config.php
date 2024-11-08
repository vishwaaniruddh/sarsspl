<?php 
$host="localhost";
//$user="sarmicro_root";
$user = "u444388293_cssInventory";
//$pass="s@r1234";
$pass = "cssInventory@2024#";
$dbname= "u444388293_cssInventory";
//$dbname="sarmicro_esurv";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
 //   echo "Connected succesfull";
}
?>


<?php 
$host="localhost";
$user="u444388293_cncindia";
$pass="CNCIndia2024#";
$dbname="u444388293_cncindia";
$css = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($css->connect_error) {
    // die("Connection failed: " . $con->connect_error);
} else {
// echo "Connected succesfull";
   
}

date_default_timezone_set('Asia/Kolkata');
$userid = $_SESSION['id'];
$datetime = date("Y-m-d H:i:s");

if(function_exists('get_username')){

    
}else{
function get_username($userid){
    global $conn;
    $sql = mysqli_query($conn,"select * from login where id='".$userid."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['name'];
}    
}

$username = get_username($userid);
?>
