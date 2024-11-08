<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $productName = $_POST['productName'];
    $productAttrName = strtolower(str_replace(" ", '_', $productName));
    $isSerialNumberRequired = $_POST['isSerialNumberRequired'];


    $sql = "INSERT INTO stocklink_boq (productName,productAttrName,isSerialNumberRequired,status) 
    VALUES ('$productName', '$productAttrName','$isSerialNumberRequired', 1)";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Added";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the members";
    }


    $connect->close();

    echo json_encode($valid);
} // /if $_POST