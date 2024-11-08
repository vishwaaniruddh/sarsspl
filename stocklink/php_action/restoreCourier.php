<?php require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array());
if ($_POST) {

    $id = $_POST['courierId'];

    $sql = "UPDATE stocklink_courier SET activityStatus='Active' WHERE id = '$id'";

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