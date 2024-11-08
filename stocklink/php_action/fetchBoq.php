<?php

require_once 'core.php';

$sql = "SELECT id,productName,productAttrName,isSerialNumberRequired,status FROM stocklink_boq";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    // $row = $result->fetch_array();
    $activeBrands = "";

    while ($row = $result->fetch_array()) {
        $id = $row[0];
        $isSerialNumberRequired = $row['isSerialNumberRequired'];
        // active 
        if ($row['status'] == 'Active') {
            // activate member
            $activeBrands = "<label class='label label-success'>Active</label>";
        } else {
            // deactivate member
            $activeBrands = "<label class='label label-danger'>Deleted</label>";
        }

        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editboqModel" onclick="editboq(' . $id . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBoq(' . $id . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

        $output['data'][] = array(
            $row[1],
            $isSerialNumberRequired,
            $activeBrands,
            $button
        );
    } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
