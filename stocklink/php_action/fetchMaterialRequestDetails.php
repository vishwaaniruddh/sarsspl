<?php

require_once 'core.php';

$requestId = $_REQUEST['searchType'];

$sql = "SELECT id, MaterialName, materialImage, created_by, created_at, materialCondition, material_qty, status, materialStatus 
        FROM generatefaultymaterialrequestdetails 
        WHERE requestId='" . $requestId . "' AND status=1 
        ORDER BY id DESC";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {

    while ($row = $result->fetch_array()) {
        $id = $row['id'];
        $MaterialName = $row['MaterialName'];
        $materialCondition = $row['materialCondition'];
        $material_qty = $row['material_qty'];
        $materialStatus = $row['materialStatus'];
        $created_at = $row['created_at'];

        // Determine the status label
        switch ($materialStatus) {
            case 'Pending':
                $statusLabel = "<label style='background-color: #f0ad4e; color: white; padding: 2px 5px; border-radius: 3px;'>Pending</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a>';
                $availStatus = '<a type="button" data-toggle="modal" data-target="#notAvailModal" onclick="notAvailThisMaterial(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Not Available</a>';
                break;
            case 'Dispatch':
                $statusLabel = "<label style='background-color: #5bc0de; color: white; padding: 2px 5px; border-radius: 3px;'>Dispatch</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a>';
                $availStatus = '<a type="button" data-toggle="modal" data-target="#notAvailModal" onclick="notAvailThisMaterial(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Not Available</a>';
                break;
            case 'Delivered':
                $statusLabel = "<label style='background-color: #5cb85c; color: white; padding: 2px 5px; border-radius: 3px;'>Delivered</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a>';
                $availStatus = '<a type="button" data-toggle="modal" data-target="#notAvailModal" onclick="notAvailThisMaterial(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Not Available</a>';
                break;
            case 'In-Transit':
                $statusLabel = "<label style='background-color: #0275d8; color: white; padding: 2px 5px; border-radius: 3px;'>In-Transit</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a>';
                $availStatus = '<a type="button" data-toggle="modal" data-target="#notAvailModal" onclick="notAvailThisMaterial(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Not Available</a>';
                break;
            case 'Deleted':
                $statusLabel = "<label style='background-color: #d9534f; color: white; padding: 2px 5px; border-radius: 3px;'>Deleted</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#restoreMemberModal" onclick="restoreThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-refresh"></i> Restore</a>';
                break;
            case 'Not-available':
                $statusLabel = "<label style='background-color: #f0ad4e; color: white; padding: 2px 5px; border-radius: 3px;'>Pending</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#restoreMemberModal" onclick="restoreThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-refresh"></i> Restore</a>';
                $availStatus = '<a type="button" data-toggle="modal" data-target="#notAvailModal" onclick="notAvailThisMaterial(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Not Available</a>';
                break;

            default:
                $statusLabel = "<label style='background-color: #cccccc; color: black; padding: 2px 5px; border-radius: 3px;'>Unknown</label>";
                $action = '<a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeThisMaterialRequest(' . $id . ')"><i class="glyphicon glyphicon-trash"></i> Remove</a>';
                break;
        }

        // Generate the action button group
        $button = '
        <div class="btn-group">
            <button type="button" class="mybtn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a class="graybtn" href="./sendIndividualMaterial.php?id=' . $id . '"> Send Individual Material</a></li>
                <li>' . $action . '</li>
            </ul>
        </div>
        ';

        $output['data'][] = array(
            $id,
            $MaterialName,
            $material_qty,
            $materialCondition,
            $created_at,
            $statusLabel, // Material status as a colored label
            $button
        );
    } // /while 

} // if num_rows

$connect->close();

echo json_encode($output);
