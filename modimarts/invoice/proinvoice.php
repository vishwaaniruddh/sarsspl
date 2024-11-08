<?php
session_start();
include('../connect.php');

$order_id=$_GET['order_id'];
$check = "select * from proforma_Order_ent where id=' $order_id'";

$orderResult=mysqli_query($con1,$check);



$result = mysqli_fetch_assoc($orderResult);

$oid = $result['id'];
if (! empty($result)) {
    require_once __DIR__ . "/PROService.php";
    $pdfService = new PDFService();
    $pdfService->generatePDF($result, $oid);
     echo 1;
}

