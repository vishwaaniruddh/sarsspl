<?php session_start();?>
<?php
include 'config.php';

$id=$_POST['id'];
$sql = "update mis_details set status='material_in_process' where id='".$id."'";

if(mysqli_query($css,$sql)){
    $materialsql = "update material_inventory set status=5 where mis_id='".$id."'";
   if(mysqli_query($css,$materialsql))
       echo '1';
}
else{
    echo '2';
}

 
