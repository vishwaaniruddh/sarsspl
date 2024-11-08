<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {



    $boqName = $_POST['editboqName'];
    $brandStatus = $_POST['editboqStatus'];
    $isSerialNumber = $_POST['editboqSerialStatus'];
    $id = $_POST['boqId'];
    $editboqStatus = $_POST['editboqStatus'];

    $productAttrName = strtolower(str_replace(" ", '_', $boqName));


    $sql = "UPDATE stocklink_boq SET productName = '$boqName', productAttrName='$productAttrName', isSerialNumberRequired = '$isSerialNumber', 
    status= '$editboqStatus' WHERE id = '$id'";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Successfully Updated";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error while adding the members";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST