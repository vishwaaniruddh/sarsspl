<?php 
include '../apidata.php';
$search=urlencode($_POST['proname']);
$product_id=urlencode($_POST['product_id']);
// $records=Prosearch(trim($search));
// $product_id=$records[0]->Product_id;

// var_dump($records);
$res_responce=GetProductdata('getProductInfo',$product_id);
$Prodata=$res_responce->Records;
$Sku_id=$Prodata[0]->Sku_id;

$size_responce=getProductSizes('getProductSizes',$product_id,$Sku_id);
$col_responce=getProductColors('getProductColors',$product_id,$Sku_id);
$size_res=$size_responce->Records;
$color_res=$col_responce->Records;

$color=$color_res[0]->Color_id;
$size=$size_res[0]->Size_id;
$apidatas = array(
	'apidata' => $Prodata,
	'color' => $color,
	'size' => $size,
	 );
echo json_encode($apidatas);
 ?>