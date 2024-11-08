<?php 
include ('config.php');
$Name=$_POST['Name'];
$Address=$_POST['Address'];
$Contact1=$_POST['Contact1'];
$Contact2=$_POST['Contact2'];
$ContactPerson=$_POST['ContactPerson'];
$Gmail=$_POST['Email'];

$sql="insert into Location(Name,Address,Contact,Contact2,ContactPerson,Email) values('".$Name."','".$Address."','".$Contact1."','".$Contact2."','".$ContactPerson."','".$Gmail."')";
$runsql=mysqli_query($conn,$sql);

//echo $sql;
if($runsql){
   echo '1';
}else{
    echo '0';
}
?>