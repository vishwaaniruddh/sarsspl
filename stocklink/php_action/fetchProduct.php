<?php
require_once 'core.php';



$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
 		 product.quantity, product.rate, product.active, product.status, 
 		brands.brand_name, product.totalAmount FROM stocklink_product product 
		INNER JOIN stocklink_brands brands ON product.brand_id = brands.brand_id 
		WHERE product.status = 1 ";


if (isset($_REQUEST['searchType']) && $_REQUEST['searchType'] == 'low') {
	$sql .= " AND product.quantity <= 3";
} else {
	$sql .= " AND product.quantity>0 ";
}


// echo $sql ; 
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

	// $row = $result->fetch_array();
	$active = "";

	while ($row = $result->fetch_assoc()) {
		$productId = $row['product_id'];
		$brand_name = $row['brand_name'];

		// active 
		if ($row['status'] == 1) {
			// activate member
			$active = "<label class='label label-success'>Available</label>";
		} else {
			// deactivate member
			$active = "<label class='label label-danger'>Not Available</label>";
		} // /else

		$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct(' . $productId . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct(' . $productId . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

		// $brandId = $row[3];
		// $brandSql = "SELECT * FROM brands WHERE brand_id = $brandId";
		// $brandData = $connect->query($sql);
		// $brand = "";
		// while($row = $brandData->fetch_assoc()) {
		// 	$brand = $row['brand_name'];
		// }
		$brand_name = $row['brand_name'];

		$brand = $row['brand_id'];
		$totalAmount = $row['totalAmount'];

		$imageUrl = substr($row['product_image'], 3);
		$productImage = "<img class='img-round' src='" . $imageUrl . "' style='height:30px; width:50px;'  />";

		$output['data'][] = array(
			// image
			$productImage,
			// product name
			$row['product_name'],
			// brand
			$brand_name,
			// rate
			$row['rate'],
			// quantity 
			$row['quantity'],
			$totalAmount,

			// active
			$active,
			// button
			$button
		);
	} // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
