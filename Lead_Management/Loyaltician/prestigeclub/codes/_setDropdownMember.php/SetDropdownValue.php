<?php
include ('config.php');
//echo $materialid;
$value=$_POST['value'];
$tableName=$_POST['tableName'];
$Column=$_POST['Column'];
$id=$_POST['id'];
$name=$_POST['name'];

$data=array();
$sql="select * from $tableName where $Column='".$value."'";
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
$data[]=['ids'=>$row[$id],'name'=>$row[$name]];
}
echo json_encode($data);
?>