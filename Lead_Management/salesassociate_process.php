<?php 
include ('config.php');

$FirstName=$_POST['FirstName'];
$LastName=$_POST['LastName'];
$Designation=$_POST['Designation'];
$UserLevel=$_POST['UserLevel'];
$Address=$_POST['Address'];
$Country=$_POST['Country'];
$state=$_POST['state'];
$City=$_POST['City'];
$Pincode=$_POST['Pincode'];
$ContactNo=$_POST['ContactNo'];
$Location=$_POST['Location'];
$Company=$_POST['Company'];
$Add=$_POST['Add'];

/*date_default_timezone_set('Asia/Kolkata');
$dates = date('Y-m-d H:i:s');*/


$sql="insert into SalesAssociate(FirstName,LastName,Designation,UserLevel,Address,Country,State,City,Pincode,ContactNo,Location,Company,`Add`) values('".$FirstName."','".$LastName."','".$Designation."','".$UserLevel."','".$Address."','".$Country."','".$state."','".$City."','".$Pincode."','".$ContactNo."','".$Location."','".$Company."','".$Add."')";
$runsql=mysqli_query($conn,$sql);

//echo $sql;
if($runsql){
   echo '1';
}else{
    echo '0';
}
?>