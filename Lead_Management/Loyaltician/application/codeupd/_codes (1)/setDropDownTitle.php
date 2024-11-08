<?php
include ('config.php');

$table = $_POST['table'];
$id = $_POST['id'];
$name = $_POST['name'];
$data = array();
$sql = "select * from $table ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $data[] = ['ids' => $row[$id], 'name' => $row[$name]];

}
echo json_encode($data);
?>