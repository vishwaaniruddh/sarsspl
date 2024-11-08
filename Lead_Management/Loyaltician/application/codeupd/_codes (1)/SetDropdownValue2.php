<?php
include ('config.php');
//echo $materialid;
$value1 = $_POST['value1'];
$value2 = $_POST['value2'];
$tableName = $_POST['tableName'];
$Column1 = $_POST['Column1'];
$Column2 = $_POST['Column2'];
$id = $_POST['id'];
$name = $_POST['name'];

$data = array();
$sql = "select * from $tableName where $Column1='" . $value1 . "' and $Column2='" . $value2 . "'";
//echo $sql;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $data[] = ['ids' => $row[$id], 'name' => $row[$name]];
}
echo json_encode($data);
?>