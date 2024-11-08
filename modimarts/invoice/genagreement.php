<?php
session_start();
include('../connect.php');

$id=$_GET['id'];
$check = "SELECT * FROM `new_member` WHERE id=' $id'";

$orderResult=mysqli_query($con,$check);



$result = mysqli_fetch_assoc($orderResult);

$id = $result['id'];
if (! empty($result)) {
    require_once __DIR__ . "/agreementApp.php";
    $pdfService = new PDFService();
    $pdfService->generatePDF($result, $id);
}

