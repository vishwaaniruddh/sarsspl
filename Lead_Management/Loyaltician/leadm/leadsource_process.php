<?php
include 'config.php';
$Name=$_POST['Name'];
$Description=$_POST['Description'];
$Active=$_POST['Active'];
$sql="insert into Lead_Sources(Name,Description,Active) values('".$Name."','".$Description."','".$Active."')";
$runsql=mysqli_query($conn,$sql);
$last=mysqli_insert_id($conn);
//echo $sql;
if($last){
    echo '1';
}else{
    echo '0';
}

?>