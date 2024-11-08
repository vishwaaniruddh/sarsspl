<?php 
session_start();
// include 'config.php';

date_default_timezone_set('Asia/Kolkata');
$host="localhost";
$user="shyambab_Temp";
$pass="sar@123";
$dbname="shyambab_Temple";
$conn = new mysqli($host, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
//echo "Connected succesfull";
   
}


$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$mobile = $_POST['mobile'];
$pan = $_POST['pan'];
$aadhar = $_POST['aadhar'];
//$family = $_POST['family'];
$image = $_POST['image'];

//echo json_encode($_POST['name']);
$addr = $_POST['addr'];
$tempaddr = $_POST['tempaddr'];
$date = $_POST['date'];
$place = $_POST['place'];

$mode = "offline";

//var_dump($_POST);
//var_dump($agentSign);
//echo json_encode( $_POST).'<br>';
// echo '========', $family;
//echo print_r($family);
// $count = count($dob);
$count = count($name);
// $i = 0;
$i = 1;
$member=array();
$member2="";
$j= array();

// while($i<=$count-1){
//     $member = array('name'=>$name[$i],'dob'=>$dob[$i],'gender'=>$gender[$i],'mobile'=>$mobile[$i],'pan'=>$pan[$i],'aadhar'=>$aadhar[$i]);
//     $i++;
//     array_push($j,$member);
// }


$insert_sql ="insert into member(name,mobile,pan,aadhar,address,DOB,file,tempaddr,date,place,mode) VALUES('".$name[0]."','".$mobile[0]."','".$pan[0]."','".$aadhar[0]."','".$addr."','".$dob[0]."','".$image[0]."','".$tempaddr."','".$date."','".$place."','".$mode."')";

$query1=mysqli_query($conn,$insert_sql);
    $member_id = mysqli_insert_id($conn);

while($i<=$count-1){
    $member = array('name'=>$name[$i],'dob'=>$dob[$i],'gender'=>$gender[$i],'mobile'=>$mobile[$i],'pan'=>$pan[$i],'aadhar'=>$aadhar[$i]);
    $i++;
    // var_dump($member);
    // echo '<br>';
    array_push($j,$member);
    
}


      $data = $j;
    
      foreach($data as $row) {

          $insert_sql1 ="insert into m_family_details(member_id,name,dob,gender,mobile,pan,aadhar,images) VALUES('".$member_id."','".$row['name']."','".$row['dob']."','".$row['gender']."','".$row['mobile']."','".$row['pan']."','".$row['aadhar']."','".$row['image']."')";
        $query1=mysqli_query($conn,$insert_sql1);
        // echo $insert_sql1;
      }
    // echo json_encode($j);
    // $obj =  json_decode($j, true);
    echo "Data inserted ";

?>