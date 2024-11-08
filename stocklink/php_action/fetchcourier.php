<?php

require_once 'core.php';

$sql = "SELECT id,courierName,activityStatus FROM stocklink_courier";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    // $row = $result->fetch_array();
    $activecourier = "";

    while ($row = $result->fetch_array()) {
        $id = $row[0];
        $courierName = $row['courierName'];
        
        $button = '<!-- Single button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a type="button" data-toggle="modal" data-target="#editcourierModel" onclick="editcourier(' . $id . ')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
    ';

    

        // active 
        if ($row['activityStatus'] == 'Active') {
            // activate member
            $activecourier = "<label class='label label-success'>Active</label>";
            
            $button .='<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removecourier(' . $id . ')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>';
        } else {
            // deactivate member
            $activecourier = "<label class='label label-danger'>Deleted</label>";
            $button .='<li><a type="button" onclick="restoreCourier(' . $id . ')"> <i class="glyphicon glyphicon-trash"></i>Restore</a></li>';

        }



    $button .= '	  </ul>
	</div>';

        $output['data'][] = array(
            $courierName,
            $activecourier,
            $button
        );
    } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
