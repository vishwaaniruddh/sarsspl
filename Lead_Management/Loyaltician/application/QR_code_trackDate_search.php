<?php session_start();
ini_set('memory_limit', '-1');
include ('config.php');

$fromDt = $_POST['fromDt'];
$ToDt = $_POST['ToDt'];

$From = date('Y-m-d', strtotime($fromDt));
$To = date('Y-m-d', strtotime($ToDt));
?>

<table id="example" class="table" style="width:100%">
    <thead>

        <tr>
            <th>SN</th>
            <th>Member Name</th>
            <th>Member ID</th>
            <th>Member Level</th>
            <th>ExpiryDate</th>
            <th>Voucher Description</th>
            <th>Scan Hotel User Name</th>

            <th>Voucher Id</th>
            <th>Status</th>
            <th>ScanDate</th>

        </tr>
    </thead>
    <tbody id="setTable">





        <?php

        $q = "SELECT Voucher_id,Available,usedDate FROM `BarcodeScan` where date(usedDate) between  '" . $From . "' and '" . $To . "' ";

        $q1 = mysqli_query($conn, $q);
        $sn = 1;
        while ($f1 = mysqli_fetch_array($q1)) {

            if ($f1['Available'] == "0") {
                $status = "Available";
            } else {
                $status = "Used";
            }

            if ($f1['usedDate'] == "0000-00-00 00:00:00") {
                $Used = "00-00-0000";
            } else {
                $Used = date('d-m-Y H:i:s', strtotime($f1['usedDate']));
            }


            $Voucher_id = $f1['Voucher_id'];
            $BookletSeries = substr($Voucher_id, 0, 8);

            $last3_voucher = substr($Voucher_id, -3);

            $MemberIdQ = mysqli_query($conn, "SELECT MembershipNumber FROM `voucher_Details` where VoucherBookletNumber='" . $BookletSeries . "'");
            $fetchMemid = mysqli_fetch_array($MemberIdQ);

            $MemberNameQ = mysqli_query($conn, "SELECT Primary_nameOnTheCard,MembershipDetails_Level as lev,booklet_Series,ExpiryDate FROM `Members` where GenerateMember_Id='" . $fetchMemid['MembershipNumber'] . "'");
            $fetchMemName = mysqli_fetch_array($MemberNameQ);

            $MemberLevelQ = mysqli_query($conn, "SELECT level_name FROM `Level` where Leval_id='" . $fetchMemName['lev'] . "'");
            $fetchLevel = mysqli_fetch_array($MemberLevelQ);

            $voucher_TypeQ = mysqli_query($conn, "SELECT serviceName FROM `voucher_Type` where level_id='" . $fetchMemName['lev'] . "' and serialNumber like '%" . $last3_voucher . "' ");
            $fetchVoucher_Type = mysqli_fetch_array($voucher_TypeQ);

            $exp = date('M-Y', strtotime($fetchMemName['ExpiryDate']));
            ?>

            <tr>
                <td><b><?php echo $sn; ?></b></td>
                <td><?php echo $fetchMemName['Primary_nameOnTheCard']; ?></td>
                <td><?php echo $fetchMemid['MembershipNumber']; ?></td>
                <td><?php echo $fetchLevel['level_name']; ?></td>
                <td><?php echo $exp; ?></td>
                <td><?php echo $fetchVoucher_Type['serviceName']; ?></td>
                <td><?php echo ''; ?></td>
                <td><?php echo $Voucher_id; ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $Used; ?></td>

            </tr>

            <?php $sn++;
        } ?>

    </tbody>


</table>