<?php
include('../config.php'); 

if (isset($_POST['component_id'])) {
    $component_id = $_POST['component_id'];
    $query = "SELECT id, name FROM mis_subcomponent WHERE component_id = '$component_id' AND status = 1";
    $result = mysqli_query($con, $query);

    $subcomponents = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $subcomponents[] = $row;
    }
    echo json_encode($subcomponents);
}
?>
