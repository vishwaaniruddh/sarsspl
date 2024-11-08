<?php
include ('config.php');
//echo $materialid;
//$column=$_POST['col'];
$column_value=$_POST['column_value']; 
$table=$_POST['table'];

$data=array();
 $sql="select * from ".$table." where id=".$column_value;
//echo $sql;
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result))
{
 $data[]=['id'=>$row['id'],'value'=>$row[$table]];
}
echo json_encode($data);
?>