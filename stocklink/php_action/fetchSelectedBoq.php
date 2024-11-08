<?php 	

require_once 'core.php';

$boqId = $_POST['boqId'];

$sql = "SELECT id,productName,productAttrName,isSerialNumberRequired,status FROM stocklink_boq WHERE id = $boqId ";
// $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_id = $brandId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_assoc();
} // if num_rows

$connect->close();

echo json_encode($row);