<?php 	

require_once 'core.php';

$sql = "SELECT product_id, product_name FROM stocklink_product WHERE status = 1 AND active = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);