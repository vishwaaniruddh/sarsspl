<?php
session_start();
include('../ecommerce_config.php');

$user_id=$_GET['user_id'];
$check="SELECT * FROM `franchise_received_products` WHERE id='$user_id'";
$sqlresult=mysqli_query($con_web,$check);



$result = mysqli_fetch_assoc($sqlresult);

$orderItemResult = $result['product_ids'];
if (! empty($result)) {
    require_once __DIR__ . "/PDFService.php";
    $pdfService = new PDFService();
    $pdfService->generatePDF($result, $orderItemResult);
}

