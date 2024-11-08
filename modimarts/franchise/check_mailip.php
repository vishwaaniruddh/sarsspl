<?php
include 'config.php';
$emailid=$_POST['mail'];
$sql="select email from member where email='".$emailid."'";
$query=mysqli_query($conn,$sql);
$numrow=mysqli_num_rows($query);
if($numrow >0){
    echo '1';
}else{
    echo '0';
}
?>