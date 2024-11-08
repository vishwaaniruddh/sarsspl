<?php
include ('config.php');
//echo $materialid;
$value=$_POST['value'];
$tableName=$_POST['tableName'];
$Column=$_POST['Column'];
$id=$_POST['id'];
$name=$_POST['name'];


$result=mysqli_query($conn,"select * from $tableName where $Column='".$value."'");
$row=mysqli_fetch_array($result);

if($result){
    $result1=mysqli_query($conn,"select * from Brand where Brand_id='".$row['Brand']."'");
    $row1=mysqli_fetch_array($result1);
    echo $row1['Brand_name'];
}


?>