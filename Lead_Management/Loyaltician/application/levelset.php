<?php
include ('config.php');
//echo $materialid;
$Program = $_POST['Program'];
$data = array();
$sql = "select * from Level where Program_ID='" . $Program . "'";
//echo $sql;
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
    $data[] = ['levelname' => $row['level_name'], 'ids' => $row['Leval_id']];
}
echo json_encode($data);
?>