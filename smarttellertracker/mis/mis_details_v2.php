<?php include('../header.php');


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
?>

<script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>


<style>

    .border-checkbox-section .border-checkbox-group .border-checkbox-label {
        width: 50%;
    }

    .table tbody tr th {
        white-space: nowrap;
    }

    .table tbody tr td {
        white-space: nowrap;
    }
</style>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="card">
                        <div class="card-block">
                            <h5>SITE INFORMATION</h5>
                            <hr>
                            <?php

                            $ticket = $_REQUEST['ticket'];
                            $sql = mysqli_query($con, "select * from mis  where reference_code= '" . $ticket . "'");
                            $sql_result = mysqli_fetch_assoc($sql);
                            $mis_id = $id = $sql_result['id'];
                            $atmid = $sql_result['atmid'];

                            $branch = $sql_result['branch'];
                            $location = $sql_result['location'];
                            $bank = $sql_result['bank'];
                            $city = $sql_result['city'];
                            $state = $sql_result['state'];
                            $status = $sql_result['status'];
                            $zone = $sql_result['zone'];




                            $sitesSql = mysqli_query($con, "select * from sites where atmid='" . $atmid . "' order by id desc");
                            $sitesSqlResult = mysqli_fetch_assoc($sitesSql);
                            $siteid = $sitesSqlResult['id'];

                            $date = date('Y-m-d');



                            $detail_history = mysqli_query($con, "select * from mis_history  where mis_id = '" . $id . "' ");
                            $fetch_detail_history = mysqli_fetch_assoc($detail_history);

                            // echo "select * from mis where id = '" . $mis_id . "'";
                            $sql1 = mysqli_query($con, "select * from mis_details where mis_id = '" . $mis_id . "'");
                            $sql1_result = mysqli_fetch_assoc($sql1);
                            $ticketid = $sql1_result['ticket_id'];
                            
                            $assigned_engineer = $sql1_result['engineer'];






                            mysqli_query($con, "update mis set isRead='read' where id='" . $mis_id . "'");
                            ?>
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Ticket ID </th>
                                                                    <td>
                                                                        <?php echo $ticketid; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">ATM ID</th>
                                                                    <td>
                                                                        <span>
                                                                            <?php echo $atmid; ?>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Bank</th>
                                                                    <td>
                                                                        <?php echo $bank; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Location</th>
                                                                    <td>

                                                                        <?php
                                                                        $location = breakStringIntoLines($location);
                                                                        echo $location; ?>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Call Receive From</th>
                                                                    <td>
                                                                        <?php echo getUsername($sql_result['callby']); ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                <tr>
                                                                    <th scope="row">City</th>
                                                                    <td>
                                                                        <?php echo $city; ?>
                                                                    </td>
                                                                </tr>

                                                                <th scope="row">State</th>
                                                                <td>
                                                                    <?php echo $state; ?>
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Zone</th>
                                                                    <td>
                                                                        <?php echo $zone; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Status</th>
                                                                    <td>
                                                                        <?php echo $status; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of general info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>

                                <!-- end of row -->
                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-block">

                            <h5>CALL INFORMATION</h5>
                            <hr>
                            <?php
                            $sql = mysqli_query($con, "select * from mis_details  where id= '" . $id . "'");
                            $sql_result = mysqli_fetch_assoc($sql);

                            $assigned_engineer = $sql_result['engineer'];
                            $teamType = $sql_result['teamType'];
                            $engineer_number = $sql_result['engineer_number'];

                            $mis_id = $sql_result['mis_id'];

                            $mis_status = $sql_result['status'];
                            $status_view = 0;
                            if ($mis_status == 'material_in_process') {
                                $status_view = 1;
                            }

                            $sql1 = mysqli_query($con, "select * from mis where id = '" . $mis_id . "'");
                            $sql1_result = mysqli_fetch_assoc($sql1);

                            $date = date('Y-m-d H:i:s');
                            $date1 = date('Y-m-d');
                            $date1 = date_create($date1);
                            $date2 = date_create($sql_result['created_at']);
                            $diff = date_diff($date1, $date2);



                            $his_sql = mysqli_query($con, "select * from mis_history  where mis_id ='" . $id . "' order by id desc");
                            if ($his_sql_result = mysqli_fetch_assoc($his_sql)) {

                                $date1_real = $his_sql_result['created_at'];
                                $date1 = date_create($date1_real);
                            } else {
                                $date1_real = date('Y-m-d H:i:s');
                                $date1 = date_create($date1_real);
                            }


                            $date2 = date_create($sql1_result['created_at']);

                            $diff = date_diff($date1, $date2);




                            ?>
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Ticket ID </th>
                                                                    <td>
                                                                        <?php echo $ticketid; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Current Status</th>
                                                                    <td>
                                                                        <?php echo $sql_result['status']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Component</th>
                                                                    <td>
                                                                        <?php echo $sql_result['component']; ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Sub Component</th>
                                                                    <td>
                                                                        <?php echo $sql_result['subcomponent']; ?>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <th scope="row">Assigned Technician</th>
                                                                    <td>
                                                                        <?php echo $assigned_engineer .'-'.$engineer_number.'  ('.$teamType.')' ;  ?>
                                                                    </td>
                                                                </tr>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Created On</th>
                                                                    <td>
                                                                        <span>
                                                                            <?php echo $sql_result['created_at']; ?>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                <th scope="row">Created By</th>
                                                                <td>
                                                                    <?php echo getUsername($sql1_result['created_by']); ?>
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Down Time </th>
                                                                    <td>
                                                                        <?php
                                                                        $formattedDiff = $diff->format("%a days, %h hours, %i minutes, %s seconds");
                                                                        echo $formattedDiff;
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Remark</th>
                                                                    <td>
                                                                        <?php echo $sql1_result['remarks']; ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of general info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>
                                <!-- end of row -->
                            </div>


                        </div>
                    </div>


<?php 

if($mis_status=='close'){
    
}else{ ?>
                  <div class="card">
                        <div class="card-block">
                            <h5>Change Status</h5>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <??>
                                    <select class="form-control" name="status" id="status">

                                        <?php if ($mis_status == 'open' || $mis_status == 'Open') { ?>
                                            <option value="">Select</option>
                                            <option value="schedule">Schedule / Reschedule</option>
                                            <option value="material_requirement">Material Requirement</option>
                                            <option value="close">Close</option>
                                        <?php }

                                        if ($mis_status == 'material_requirement') { ?>
                                            <option value="">Select</option>
                                            <option value="schedule">Schedule / Reschedule</option>
                                            <option value="material_dispatch">Material Dispatch</option>
                                            <option value="material_in_process">Material in Process</option>
                                            <option value="replace_with_available">Replace With Available Material</option>
                                            <option value="close">Close</option>
                                        <?php }

                                        if ($mis_status == 'replace_with_available') { ?>
                                            <option value="">Select</option>
                                            <option value="close">Close</option>
                                        <?php }

                                        if ($mis_status == 'reassign') { ?>
                                            <option value="">Select</option>
                                            <option value="close">Close</option>
                                        <?php }

                                        if ($mis_status == 'schedule') { ?>
                                            <option value="">Select</option>
                                            <option value="schedule">Schedule / Reschedule</option>
                                            <option value="material_requirement">Material Requirement</option>
                                            <option value="close">Close</option>
                                        <?php } 
                                        
                                        
                                        if ($mis_status == 'material_dispatch') { ?>
                                            <option value="">Select</option>
                                            <option value="schedule">Schedule / Reschedule</option>
                                            <option value="material_delivered">Material Delivered</option>
                                            <option value="close">Close</option>
                                        <?php } 
                                        if($mis_status == 'material_delivered') {?>
                                            <option value="">Select</option>
                                            <option value="schedule">Schedule / Reschedule</option>
                                            <option value="material_requirement">Material Requirement</option>
                                            <option value="close">Close</option>
                                        <?php } 

                                        
                                        
                                        
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <hr>




                            <?php

                            if (isset($_POST['status'])) {

                                $status = $_POST['status'];
                                
                                if ($status == 'close') {
                                    $remark2 = $_POST['remark2'];
                                    $year = date('Y');
                                    $month = date('m');
                                    $target_dir = 'mis_images/close_uploads/' . $year . '/' . $month . '/' . $atmid;
                                    $link = "";

                                    if (!file_exists($target_dir)) {
                                        mkdir($target_dir, 0777, true); // Set appropriate permissions (modify as needed)
                                    }

                                    $image = $_FILES['image']['name'];
                                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . '/' . $image)) {
                                        $link = $target_dir . '/' . $image;
                                    }

                                    $engineer = $_POST['engineer'];
                                    $remark = $_POST['remark'];
                                    $oldMaterialDetails = $_POST['oldMaterialDetails'];
                                    $statement = "insert into mis_history (mis_id,type,attachment,remark,status,created_at,created_by,remark2) 
                                                values('" . $id . "','" . $status . "','" . $link . "','" . $remark . "','1','" . $date . "','" . $userid . "','" . $remark2 . "')";

                                    mysqli_query($con, "update mis_details set close_date = '" . $date . "' where mis_id = '" . $id . "'");
                                    mysqli_query($con, "update mis set status = '" . $status . "' where id = '" . $mis_id . "'");
                                } else if ($status == 'material_requirement') {
                                    $remark = $_POST['remark'];
                                    $requiredMaterials = $_REQUEST['requiredMaterial'];
                                    $requiredMaterial = implode(', ', $requiredMaterials);

                                    $material_condition = array_filter($_REQUEST['material_condition']);
                                    $material_qty = array_filter($_REQUEST['material_quantity']);

                                    $material_condition = array_values($material_condition);
                                    $material_qty = array_values($material_qty);



                                    $material_conditionStr = implode(',', $material_condition);
                                    $material_conditionStr = rtrim($material_conditionStr, ',');

                                    $totalMaterialCount = count($material_condition);
                                    $year = date('Y');
                                    $month = date('m');
                                    $targetDir = 'materialRequirement/' . $year . '/' . $month . '/' . $atmid;
                                    $link = "";

                                    if (!file_exists($targetDir)) {
                                        mkdir($targetDir, 0777, true); // Set appropriate permissions (modify as needed)
                                    }

                                    $checkMaterialSend = mysqli_query($con, "select * from material_send where atmid='" . $atmid . "' order by id desc");
                                    $checkMaterialSendResult = mysqli_fetch_assoc($checkMaterialSend);
                                    $sendid = $checkMaterialSendResult['id'];


                                    $faultyMaterialRequestSql = "insert into generatefaultymaterialrequest(siteid,atmid,requestBy,description,created_at,created_by,status,ticketId,mis_id,engineer)
                                    values('" . $siteid . "','" . $atmid . "','" . $userid . "','" . $remark . "','" . $datetime . "','" . $userid . "',1,'" . $ticketid . "','" . $mis_id . "','" . $userid . "');
                                    ";

                                    if (mysqli_query($con, $faultyMaterialRequestSql)) {
                                        $faultyRequestID = $con->insert_id;

                                        for ($i = 0; $i < count($requiredMaterials); $i++) {
                                            $imageFileName = uniqid() . "_" . $_FILES['material_requirement_images']['name'][$i];
                                            $imagePath = $targetDir . '/' . $imageFileName;

                                            move_uploaded_file($_FILES['material_requirement_images']['tmp_name'][$i], $imagePath);



                                            $sendDetailsSql = mysqli_query($con, "Select * from material_send_details where materialSendId='" . $sendid . "' and attribute='" . $requiredMaterials[$i] . "'");
                                            if ($sendDetailsSqlResult = mysqli_fetch_assoc($sendDetailsSql)) {
                                                $serialNumber = $sendDetailsSqlResult['serialNumber'];
                                                $MaterialID = getInventoryIDBySerialNumber($serialNumber);

                                                $faultyDetailsSql = "insert into generatefaultymaterialrequestdetails(requestId, MaterialID, MaterialName, MaterialSerialNumber, materialImage, created_at, created_by, status , materialRequestType,mis_id,materialCondition,material_qty)
                                            values('" . $faultyRequestID . "','" . $MaterialID . "','" . $requiredMaterials[$i] . "','" . $serialNumber . "','" . $imagePath . "','" . $datetime . "','" . $userid . "',1,'clarify','" . $mis_id . "','" . $material_condition[$i] . "','" . $material_qty[$i] . "')";
                                                if (mysqli_query($con, $faultyDetailsSql)) {
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                                }
                                            } else {
                                                $faultyDetailsSql = "insert into generatefaultymaterialrequestdetails(requestId, MaterialID, MaterialName, MaterialSerialNumber, materialImage, created_at, created_by, status , materialRequestType,mis_id,materialCondition,material_qty)
                                            values('" . $faultyRequestID . "','','" . $requiredMaterials[$i] . "','','" . $imagePath . "','" . $datetime . "','" . $userid . "',1,'clarify','" . $mis_id . "','" . $material_condition[$i] . "','" . $material_qty[$i] . "')";
                                                if (mysqli_query($con, $faultyDetailsSql)) {
                                                } else {
                                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                                }
                                            }
                                        }
                                    }




                                    mysqli_query($con, "update mis set status='material_requirement' WHERE id = $id");

                                    $statement = "insert into mis_history (mis_id,type,material,material_condition,remark,status,created_at,created_by,dependency) 
                                                values('" . $id . "','" . $status . "','" . $requiredMaterial . "','" . $material_conditionStr . "','" . $remark . "','1','" . $date . "','" . $userid . "','Advantage')";
                                } else if ($status == 'reassign') {

                                    $remark = $_REQUEST['remark'];
                                    mysqli_query($con, "update mis set status='reassign' WHERE id = $id");



                                    $ProblemOccurs = $_REQUEST['noProblemOccurs'];
                                    $ProblemOccursStr = implode(',', $ProblemOccurs);
                                    $year = date('Y');
                                    $month = date('m');
                                    $target_dir = 'reassign_uploads/' . $year . '/' . $month . '/' . $atmid;
                                    $link = "";

                                    if (!file_exists($target_dir)) {
                                        mkdir($target_dir, 0777, true); // Set appropriate permissions (modify as needed)
                                    }


                                    $image = $_FILES['image']['name'];
                                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . '/' . $image)) {
                                        $link = $target_dir . '/' . $image;
                                    }

                                    $statement = "insert into mis_history (mis_id,type,attachment,remark,status,created_at,created_by,dependency,ProblemOccurs) 
                                                values('" . $id . "','" . $status . "','" . $link . "','" . $remark . "','1','" . $date . "','" . $userid . "','Bank','" . $ProblemOccursStr . "')";
                                } else if ($status == 'replace_with_available') {

                                    $materialToReplace = $_REQUEST['materialToReplace'];
                                    foreach ($materialToReplace as $materialToReplaceKey => $materialToReplaceValue) {

                                        echo '$materialToReplaceValue = ' . $materialToReplaceValue;
                                        echo '<br>';
                                        // $serialNumberValidator = mysqli_query($con,"select * from inventory where ");    

                                    }
                                } else if($status=='schedule'){
                                    $engineer = $_POST['engineer'];
                                    $remark = $_POST['remark'];
                                    $schedule_date = $_POST['schedule_date']; 
                                    $statement = "insert into mis_history (mis_id,type,engineer,remark,schedule_date,status,created_at,created_by,atmid) 
                                    values('".$id."','".$status."','".$engineer."','".$remark."','".$schedule_date."','1','".$date."','".$userid."','".$atmid."')" ;
                                    mysqli_query($con,"update mis_details  set engineer = '".$engineer."' where id = '".$id."'");
                                } else if($_POST['status']=='material_delivered'){
                                       $delivery_date = $_POST['delivery_date'];
                                       $statement = "insert into mis_history (mis_id,type,status,created_at,created_by,delivery_date) 
                                       values('".$id."','".$status."','1','".$date."','".$userid."','".$delivery_date."')" ;
                                }

                                if (mysqli_query($con, $statement)) {
                                    if ($status == 'reopen') {
                                        $status = 'open';
                                    } else {
                                        $status = $_POST['status'];
                                    }

                                    mysqli_query($con, "update mis_details  set status = '" . $status . "' where id = '" . $id . "'");











                            ?>

                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Call Updated Successfully !',
                                            confirmButtonText: 'OK'
                                        }).then(function() {
                                            window.location.href = "./mis_details_v2.php?ticket=<?php echo $ticket; ?>";
                                        });
                                    </script>
                                <?php } else {
                                    echo mysqli_error($con);
                                ?>
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops !", "Call Updated Error !',
                                            confirmButtonText: 'OK'
                                        }).then(function() {
                                            window.location.href = "./mis_details_v2.php?ticket=<?php echo $ticket; ?>";
                                        });
                                    </script>

                            <?php }
                            }

                            ?>

                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>?ticket=<?php echo $ticket; ?>" method="POST"
                                enctype="multipart/form-data">
                                <div class="row extra_highlight" id="status_col"></div>
                            </form>


                        </div>
                    </div>

<?php  }

?>
      



                    <div class="card">
                        <div class="card-block" style="overflow:scroll;">
                            <h5>CALL DISPATCH INFORMATION</h5>

                            <hr>
                            <table id="example"
                                class="table table-bordered  dataTable js-exportable no-footer"
                                style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Sn No</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                        <th>Require Material</th>
                                        <th>Date</th>
                                        <th>Schedule Date</th>
                                        <th>Engineer</th>
                                        <th>POD</th>
                                        <th>Action By</th>
                                        <th>Attchement</th>
                                        <th>Attchement 2</th>
                                        <th>Material Delivered Date</th>
                                        <th>Address (Material Requirement)</th>
                                        <th>Serial Number</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    // echo "select * from mis_history  where mis_id ='".$id."'"; 

                                    $his_sql = mysqli_query($con, "select * from mis_history  where mis_id ='" . $id . "' order by id desc");
                                    $i = 1;

                                    while ($his_sql_result = mysqli_fetch_assoc($his_sql)) {
                                        $is_material_dept = $his_sql_result['is_material_dept'];

if($his_sql_result['type']=='material_requirement'){

                                        $matdetails =  '<table>

<tr>
<th>Sr</th>
<th>Material</th>
<th>Condition</th>
<th>Quantity</th>
</tr>';
                                        $matdetailCounter = 1;
                                        $materialdetailssql = mysqli_query($con, "select * from generatefaultymaterialrequestdetails where mis_id='" . $id . "' and created_at='" . $his_sql_result['created_at'] . "'");
                                        while ($materialdetailssqlResult = mysqli_fetch_assoc($materialdetailssql)) {

                                            $MaterialName = $materialdetailssqlResult['MaterialName'];
                                            $materialCondition = $materialdetailssqlResult['materialCondition'];
                                            $material_qty = $materialdetailssqlResult['material_qty'];
                                            $matdetails .= '
<tr>
<td>' . $matdetailCounter . '</td>
<td style="white-space:nowrap;">' . $MaterialName . '</td>
<td style="white-space:nowrap;">' . $materialCondition . '</td>
<td>' . $material_qty . '</td>
</tr>';
                                            $matdetailCounter++;
                                        }
                                        $matdetails .= '</table>';

    
}else{
    $matdetails = '';
}


                                    ?>
                                        <tr <?php if ($is_material_dept == 1) { ?> style="background-color: #404e67;color:white;"
                                            <?php } ?>>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo ucwords($his_sql_result['type']); ?>
                                            </td>
                                            <td>

                                                <?php
                                                    echo ucwords($his_sql_result['remark']);
                                                
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $matdetails; ?>
                                            </td>

                                            <td>
                                                <?php echo $his_sql_result['created_at']; ?>
                                            </td>
                                            <td>
                                                <?php if ($his_sql_result['schedule_date'] != '0000-00-00') {
                                                    echo $his_sql_result['schedule_date'];
                                                } ?>
                                            </td>

                                            <td>
                                                <?php echo getUsername($assigned_engineer); ?>
                                            </td>
                                            <td>
                                                <?php echo $his_sql_result['pod']; ?>
                                            </td>

                                            <td>
                                                <?php echo getUsername($his_sql_result['created_by'], true); ?>
                                            </td>
                                            <td>
                                                <?php if ($his_sql_result['attachment']) { ?><a
                                                        href="<?php echo 'mis/' . $his_sql_result['attachment']; ?>">View
                                                        Attchment</a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($his_sql_result['attachment2']) { ?><a
                                                        href="<?php echo 'mis/' . $his_sql_result['attachment2']; ?>">View
                                                        Attchment</a>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <?php if ($his_sql_result['delivery_date'] != '0000-00-00') {
                                                    echo $his_sql_result['delivery_date'];
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $his_sql_result['delivery_address']; ?>
                                            </td>
                                            <td>
                                                <?php echo $his_sql_result['serial_number']; ?>
                                            </td>

                                        </tr>
                                    <?php $i++;
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>





<script>
    //     $(document).on('change', '#status', function() {

    // alert('hsai');
    //     });
    function handleCheckboxChange(checkbox, matLoopCount) {
        // Get the corresponding select and input elements based on the matLoopCount
        var selectElement = document.getElementById("select_" + matLoopCount);
        var inputElement = document.getElementById("input_" + matLoopCount);
        var input_qty = document.getElementById("input_qty_" + matLoopCount);



        // Check if the select and input elements exist before setting the 'required' attribute
        if (selectElement && inputElement) {
            if (checkbox.checked) {
                selectElement.required = true;
                inputElement.required = true;
                input_qty.required = true;

            } else {
                selectElement.required = false;
                inputElement.required = false;
                input_qty.required = false;

            }
        }
    }


    $(document).ready(function() {

        $(document).on('change', '#status', function() {

            console.log("Checkbox:", this);

            var status = $(this).val();
            $("#status_col").html('');

            if (status == 'close') {
                var html = `<input type="hidden" name="status" value="close">
                <div class="col-sm-12"><label>Snap</label><br /><input type="file" name="image" required></div>
                <div class="col-sm-12"><br><label>Remark</label><input type="text" name="remark" class="form-control"></div>
                <div class="col-sm-12"><br><label>Resolution</label>
                <select name="remark2" class="form-control" required>
                <option value="Spares Replaced">Spares Replaced</option>
                <option value="Antena relocated">Antenna relocated</option>
                    <option value="Loose connection fixed">Loose connection fixed</option>
                    <option value="Power turned on">Power turned on</option>
                    <option value="Router rebooted">Router rebooted</option>
                    <option value="LAN cable replaced or label fixed (if damaged).">LAN cable replaced or label fixed (if damaged).</option>
                    <option value="Electrical wiring done">Electrical wiring done</option>
                    <option value="SIM replaced">SIM replaced</option>
                    <option value="SIM re-inserted">SIM re-inserted</option>
                    <option value="No issue found">No issue found</option>
                    <option value="VPN Restore">VPN Restore</option>
                    
                    <?php
                    $boqSql = mysqli_query($con, "select * from stocklink_boq where status='Active'");
                    while ($boqSqlResult = mysqli_fetch_assoc($boqSql)) {
                        $boqValue = $boqSqlResult['productName'];
                    ?>
                        <option value="<?php echo  $boqValue; ?> Replaced"><?php echo  $boqValue; ?> Replaced</option>
                    <?php


                    }
                    ?>



                        </select>
                        </div>


                    <div class="col-sm-12 oldMaterialDetails" style="display:none;">
                    <br />
                        <label>Old Material Details</label>
                        <select name="oldMaterialDetails" id="oldMaterialDetails" class="form-control">
                        <option>-- Select --</option>
                        <option value="Old Material with Engineer">Old Material with Engineer</option>
                        <option value="Old Material Missing">Old Material Missing</option>
                        <option value="Old Material Scrap">Old Material Scrap</option>
                        <option value="Old Material in Service Center">Old Material in Service Center</option>
                        <option value="Old Material in Branch Office">Old Material in Branch Office</option>
                        <option value="Old Material in Dispached to Mumbai">Old Material in Dispached to Mumbai</option>
                        </select>  
                        </div>

                    <div class="col-sm-12"><br><br><input class="btn btn-primary" value="Close" type="submit" name="submit"></div>`;
            } 
            else if(status == 'schedule'){
            var html = `<input type="hidden" name="status" value="schedule">
            
            <div class="col-sm-4">
            <label>Engineer</label>
            <select name="engineer" id="engineer" class="form-control" required>
                                <option value="">--Select--</option>
                                <?php
                                // fetch active engineers
                                $engsql = mysqli_query($con, "select * from user where level=3 and user_status=1 order by name asc");
                                while ($engsql_result = mysqli_fetch_assoc($engsql)) {
                                ?>
                                    <option value="<?php echo $engsql_result['userid']; ?>" <?php if($assigned_engineer==$engsql_result['userid']){ echo 'selected'; } ?>><?php echo $engsql_result['name']; ?></option>
                                <?php } ?>
                            </select>
            </div>
            
            <div class="col-sm-4"><label>Schedule Remark</label><input type="text" name="remark" class="form-control"></div><div class="col-sm-4"><label>Schedule Date</label><input type="date" name="schedule_date" class="form-control"></div><div class="col-sm-4"><br><input class="btn btn-success" type="submit" name="submit"></div>`;
        }
            else if (status == 'material_requirement') {
                var html = `
                <input type="hidden" name="status" value="material_requirement">
                <div class="col-sm-12">
                    <label>Please Select Material </label>
                    <br />
                    <div class="border-checkbox-section" style="margin: auto 40px;">
                    <?php
                    $matLoopCount = 1;
                    $mat_sql = mysqli_query($con, "select * from stocklink_boq where status='Active'");
                    while ($mat_sqlResult = mysqli_fetch_assoc($mat_sql)) {
                        $value = $mat_sqlResult['productName']; ?>
                                                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                                                <input class="border-checkbox" name="requiredMaterial[]" type="checkbox" id="checkbox<?php echo  $matLoopCount; ?>" value="<?php echo  trim($value); ?>">

                                                                                <label class="border-checkbox-label" for="checkbox<?php echo  $matLoopCount; ?>"><?php echo  trim($value); ?></label>

                                                                                <input id="input_qty_<?php echo  $matLoopCount; ?>" type="text" name="material_quantity[]" style="width: 50px;" placeholder="QTY" />
                                                                                <select id="select_<?php echo  $matLoopCount; ?>" name="material_condition[]">
                                                                                    <option value="">Select</option>
                                                                                    <option value="Missing">Missing</option>
                                                                                    <option value="Faulty">Faulty</option>
                                                                                    <option value="Not Installed">Not Installed</option>
                                                                                    <option value="Power Fluctuation">Power Fluctuation</option>
                                                                                </select>

                                                                                <input id="input_<?php echo  $matLoopCount; ?>" type="file" name="material_requirement_images[]" />
                                                                            </div>
                        
                                                                            <?php $matLoopCount++;
                                                                        } ?>
                    </div>

                    <div class="col-sm-12">
                        <label>Remarks</label>
                        <input type="text" name="remark" class="form-control" required />
                    </div>
                    <div class="col-sm-12">
                        <br />
                        <input type="submit" name="submit" class="btn btn-primary" />
                    </div>
                    
                </div>
            `;
            } else if (status == 'material_in_process') {
                var html = `<input type="hidden" name="status" value="material_in_process">
                <div class="border-checkbox-section highlight" style="width:75%">
                <div class="border-checkbox-group border-checkbox-group-primary">
                    <input class="border-checkbox" name="noProblemOccurs[]" type="checkbox" id="checkbox1" value="Ups Wroking">
                                                <label class="border-checkbox-label" for="checkbox1">Ups Not Wroking</label>
                                            </div>
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox" name="noProblemOccurs[]" type="checkbox"
                                                    id="checkbox2" value="No Power Outage">
                                                <label class="border-checkbox-label" for="checkbox2">Power Outage</label>
                                            </div>
                                            <div class="border-checkbox-group border-checkbox-group-primary">
                                                <input class="border-checkbox" name="noProblemOccurs[]" type="checkbox"
                                                    id="checkbox3" value="No Problen in Machine Hardware">
                                                <label class="border-checkbox-label" for="checkbox3">Machine Hardware Issue</label>
                                            </div>

                                        </div>


                                <div class="col-sm-12">
                                    <label>Snap</label><br />
                                    <input type="file" name="image" required>
                                </div>
                                <div class="col-sm-12">
                                <br />
                                    <label>Remark</label>
                                    <input type="text" name="remark" class="form-control">
                                </div>

                                <div class="col-sm-12">
                                            <br />
                                            <input type="submit" name="submit" class="btn btn-primary" />
                                        </div>
                                        
                                `;
            } else if(status == 'material_delivered'){
                var html = '<input type="hidden" name="status" value="material_delivered"><div class="col-sm-6"><label>Delivery Date</label><input type="date" name="delivery_date" class="form-control"></div><div class="col-sm-4"><br><input class="btn btn-success" type="submit" name="submit"></div>';
            } else if(status==''){
                
            }
            
            $("#status_col").html(html);
        });

        $(document).on('change', '.border-checkbox', function() {
            // Get the matLoopCount from the checkbox's ID
            var matLoopCount = this.id.replace('checkbox', '');
            handleCheckboxChange(this, matLoopCount);
        });
    });

    function throttle(f, delay) {
        var timer = null;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = window.setTimeout(function() {
                    f.apply(context, args);
                },
                delay || 1000);
        };
    }




    function setaddress() {
        var address_type = $('#address_type').val();
        if (address_type == 'Branch') {
            $('#address').val('Branch');
            $('#address').attr('readonly', true);
            $('#Contactperson_name').hide();
            $('#Contactperson_mob').hide();
            $('#Contactperson_name_text').attr('required', false);
            $('#Contactperson_mob_text').attr('required', false);
            $('#address').show();
        }
        if (address_type == 'Other') {
            $('#address').val('');
            $('#address').attr('readonly', false);
            $('#Contactperson_name').show();
            $('#Contactperson_mob').show();
            $('#Contactperson_name_text').attr('required', true);
            $('#Contactperson_mob_text').attr('required', true);
            //  $('#address').show();
        }
    }




    $(document).on('keyup', '#address', throttle(function() {
        $("#item_name").html('');
        add = $(this).val();
        $.ajax({
            type: "POST",
            url: 'suggested_address.php',
            data: 'address=' + add,
            success: function(msg) {

                $("#item_name").append(msg);


            }
        });
        //   alert(add);
    }));
</script>






<?php include('../footer.php'); ?>