<?php 	

require_once 'core.php';

$courierId = $_POST['courierId'];

$sql = "SELECT id,courierName,activityStatus FROM stocklink_courier WHERE id = $courierId ";
// $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_id = $brandId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_assoc();
} // if num_rows

$connect->close();

echo json_encode($row);