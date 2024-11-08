<?php
include 'config.php';
$Email=$_POST['email'];

$sql="select Email from company where Email='".$Email."'";
$result=mysqli_query($conn,$sql);
$num_row=mysqli_num_rows($result);

if($num_row >0){
    echo "1";
  
}else{
    echo "0";
}

?>