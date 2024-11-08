<?php
include 'config.php';
$data=array();
 $result=mysqli_query($conn,"select mobile from member ");
 while($row = mysqli_fetch_array($result)) { 
    $data[]=['mobile'=>$row[0]];
 }
 echo json_encode($data) ;
?>