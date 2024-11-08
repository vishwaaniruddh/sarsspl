<?php
include 'config.php';
$mail=$_POST['email'];
//echo $mail;
$sql="select email from vendor where email='".$mail."'";
$result=mysqli_query($conn,$sql);
$num_row=mysqli_num_rows($result);

if($num_row >0){
    echo "1";
    
}else{
    echo "0";
}

?>