<?php session_start(); //Start the session
include ("config.php");
$id=$_POST['id'];


if(isset($_POST['status']) && $_POST['status']=="wait"){
    $status="0";
} else {
    $status="2";
}
//$status=$_POST['status'];
$sql="update member set status='".$status."' where id='".$id."'";
//echo $sql;
$runsql=mysqli_query($conn,$sql);

if($runsql){
    echo '1';
}else{
    echo '2';
}

?>