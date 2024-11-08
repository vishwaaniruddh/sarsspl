<?php
$assets=$_POST['assets'];

$qry=mysqli_query($con,"insert into assets(assets_name) values('$assets)");
if($qry){
header('location:NewAssets.php');
}else{

echo "error updating data".mysqli_error();
}
?>