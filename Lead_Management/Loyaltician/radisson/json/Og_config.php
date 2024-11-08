<?php 
date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="u444388293_radissons";
$pass="SARsar@@2021";
$dbname="u444388293_radissons";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
// echo "Connected succesfull";
   
}


$host1="localhost";
$user1="u444388293_radissons";
$pass1="SARsar@@2021";
$dbname1="u444388293_radissons";
$con2 = new mysqli($host1, $user1, $pass1, $dbname1);
// Check connection
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
} else {
// echo "Connected succesfull";
   
}

// function sendexternalmail($subject,$message,$leadsmail,$host,$hostusername,$hostpassword,$port,$from,$fromname,$to,$cc,$bcc){
//     $nodes = 'https://arpeeindustries.com/mail.php';
//     $data = array(
//         'subject' => $subject,
//         'message' => $message,
//         'leadsmail' => $leadsmail,
//         'host' => $host,
//         'hostusername' => $hostusername,
//         'hostpassword' => $hostpassword,
//         'port'=> $port ,
//         'from'=>$from,
//         'fromname'=>$fromname,
//         'to'=>$to,
//         'cc'=>$cc,
//         'bcc'=>$bcc,
//         );
    
//     $options = array(
//         'http' => array(
//             'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//             'method'  => 'POST',
//             'content' => http_build_query($data)
//         )
//     );
    
//     $context  = stream_context_create($options);
//     $result = file_get_contents($nodes, false, $context);
//     if($result == 1){
//         return 1;
//     }else{
//         return 0 ;
//          }
// }
?>