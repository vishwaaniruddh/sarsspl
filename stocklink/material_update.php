<?php require_once 'includes/header.php'; ?>


<div class="row">
    <div class="col-md-12">

        <?php

        echo '<pre>';
        var_dump($_REQUEST);
        echo '</pre>';

        $requestId = $_REQUEST['requestId'];
        $Contactperson_id = $_REQUEST['Contactperson_id'];
        $contactPersonName = $_REQUEST['Contactperson_name'];
        $contactPersonNumber = $_REQUEST['Contactperson_mob'];
        $atmid = $_REQUEST['atmid'];
        $address = $_REQUEST['address'];
        $pod = $_REQUEST['pod'];

        $courier = $_REQUEST['courier_name'];
        $remark = $_REQUEST['remark'];
        $pod = $_REQUEST['pod'];
        $pod = $_REQUEST['pod'];
        $dispatch_date = $_REQUEST['dispatch_date'];

        $misId = $_REQUEST['misId'];


        // Construct the SQL query
        $sql = "INSERT INTO material_send (requestId, atmid, contactPersonId, contactPersonName, contactPersonNumber, address, pod, courier, remark, created_at, created_by) 
VALUES ('$requestId', '$atmid', '$Contactperson_id', '$contactPersonName', '$contactPersonNumber', '$address', '$pod', '$courier', '$remark', '" . $datetime . "', '$userid')";

        // Execute the query
        if ($con->query($sql) === TRUE) {
            $materialSendId = $con->insert_id;


            $engInv = "INSERT INTO engmaterialreceived (materialSendId, atmid, contactPersonId, contactPersonName, contactPersonNumber, address, pod, courier, remark, created_at, created_by) 
            VALUES ('$materialSendId', '$atmid', '$Contactperson_id', '$contactPersonName', '$contactPersonNumber', '$address', '$pod', '$courier', '$remark', '" . $datetime . "', '$userid')";
            mysqli_query($con, $engInv);
            $engInvId = $con->insert_id;


            $serialNumber = $_REQUEST['serialNumber'];
            $productName = $_REQUEST['attribute'];
            // $material_qty = $_REQUEST['material_qty'];
            $i = 0;
            foreach ($productName as $productNameKey => $productNameVal) {
                $thisSerialNumber = '';


                if ($serialNumber[$i]) {
                    $thisSerialNumber = $serialNumber[$i];
                }

                if ($serialNumber[$i]) {
                    $invsql = mysqli_query($con, "select * from stocklink_inventory where serialNumber='" . $serialNumber[$i] . "' and availabilityStatus='available' and activityStatus='Active'");
                    $invsql_result = mysqli_fetch_assoc($invsql);
                    $invId = $invsql_result['id'];
                } else {

                    $invsql = mysqli_query($con, "select * from stocklink_inventory where product_name='" . $productNameVal . "' and availabilityStatus='available' and activityStatus='Active'");
                    $invsql_result = mysqli_fetch_assoc($invsql);
                    $invId = $invsql_result['id'];
                }


                $insert_send_details = "INSERT INTO material_send_details(materialSendId,attribute,serialNumber,invID,created_at)
                VALUES('" . $materialSendId . "','" . $productNameVal . "','" . $thisSerialNumber . "','" . $invId . "','" . $datetime . "')
                ";



                if (mysqli_query($con, $insert_send_details)) {

                    $engInv_details_sql = "INSERT INTO engmaterialreceiveddetails(engMaterialRecivedId,attribute,serialNumber,invID,created_at,materialStatus)
                    VALUES('" . $engInvId . "','" . $productNameVal . "','" . $thisSerialNumber . "','" . $invId . "','" . $datetime . "','In-Transit')
                    ";

                    mysqli_query($con, $engInv_details_sql);
                    
                    
                    echo "update stocklink_inventory set availabilityStatus='not-available' where id='" . $invId . "'" ; 
                    mysqli_query($con, "update stocklink_inventory set availabilitystatus='not-available' where id='" . $invId . "'");

                }
                $i++;
            }

            $productName_str = implode(',', $productName);



            mysqli_query($con, "update generatefaultymaterialrequest set materialStatus='Dispatch' where id='" . $requestId . "'");
            
            mysqli_query($con, "update generatefaultymaterialrequestdetails set materialStatus='Dispatch' where requestId='" . $requestId . "' and materialStatus='Pending'");



            mysqli_query($con, "update mis set status='material_dispatch' where id='" . $misId . "'");
            mysqli_query($con, "update mis_details set status='material_dispatch' where mis_id='" . $misId . "'");
            mysqli_query($con, "INSERT INTO mis_history(mis_id,type,engineer,remark,material,courier_agency,pod,dispatch_date,status,created_at,created_by,delivery_address,
            contact_person_address,contact_person_name,contact_person_mob,atmid) 
            VALUES('" . $misId . "','material_dispatch','" . $Contactperson_id . "','" . $remark . "','" . $productName_str . "','" . $courier . "','" . $pod . "','" . $dispatch_date . "',
            1,'" . $datetime . "','" . $userid . "','" . $address . "','" . $address . "','" . $contactPersonName . "','" . $contactPersonNumber . "','" . $atmid . "')
            ");
            
            
            
            ?>
            
            <script>
                alert('Material Dispatched Successfully !');
                 setTimeout(function () {
                     window.location = "./materialRequest.php?type=Pending";
                 }, 2500);
            </script>
            <?php
            
            
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }




        // In loop store individual material details 
        // get product name , product serial number 

        // update generatefaultymaterialrequest to materialStatus to Dispatch    
        // update stocklink_inventory availabilityStatus=not-available where serialnumber='serialnumber'



        ?>


    </div>
</div>

<?php require_once 'includes/footer.php'; ?>