<?php
include('config.php');
session_start();
if(isset($_SESSION['gid'])){
    $gid=$_SESSION['gid'];
} else {
    $gid=0;
}

$mobile=$_POST['mobile'];
$date=Date('Y-m-d H:i:s');

/*Ruchi : Insert user contact */

if(isset($_POST['action']) && $_POST['action']=='usercontact'){
    $insrtqry=mysqli_query($con1,"INSERT INTO `UserContacts`( `Name`, `Number`, `date`) VALUES ('$gid','$mobile','$date')");
    //get user details
    $userdata=mysqli_query($con1,"SELECT * FROM Registration where id='".$_POST['ccode']."'"); 
    $getdata=mysqli_fetch_array($userdata);
    
    $data[] = array(
            'name'=>$getdata['Firstname'],
            'mobile'=>$mobile
        );
        echo json_encode($data);
}
 
?>