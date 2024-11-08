<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $courierName = $_POST['courierName'];
    $sql = "INSERT INTO stocklink_courier (courierName) 
    VALUES ('$courierName')";

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