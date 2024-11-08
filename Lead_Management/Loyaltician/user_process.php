<?php
include 'config.php';
$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$UserType=$_POST['UserType'];
$drop=$_POST['drop'];

$abc="select * from roll where id='".$UserType."'";
$runabc=mysqli_query($conn,$abc);
$fetch=mysqli_fetch_array($runabc);

$abc2="select * from SalesAssociate where SalesmanId='".$UserName."'";
$runabc2=mysqli_query($conn,$abc2);
$fetch2=mysqli_fetch_array($runabc2);

/*$sql="insert into Users(UserName,Password,UserType,permission,roll_id,reg_id) values('".$fetch2['FirstName']." ".$fetch2['LastName']."','".$Password."','".$fetch['roll']."','".$fetch['permission']."','".$fetch['id']."','".$fetch2['SalesmanId']."')";*/

$sql="insert into Users(UserName,Password,UserType,permission,roll_id,reg_id) values('".$fetch2['FirstName']."','".$Password."','".$fetch['roll']."','".$fetch['permission']."','".$fetch['id']."','".$fetch2['SalesmanId']."')";
$runsql=mysqli_query($conn,$sql);

$last=mysqli_insert_id($conn);

if($last){
    echo '1';
}else{
    echo '0';
}

?>