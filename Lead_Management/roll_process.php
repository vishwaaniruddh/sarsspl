<?php
include'config.php';

$roll=$_POST['Roll'];
$drop=$_POST['drop'];

$sql="insert into roll(`roll`,`permission`) values('".$roll."','".$drop."')";
$runsql=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);

if($last){
    echo '1';
}else{
    echo '0';
}
?>