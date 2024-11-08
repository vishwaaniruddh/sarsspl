<?php session_start();
ini_set('memory_limit', '-1');
include ('config.php');

$FromDat = $_POST['FromDt'];
$Todat = $_POST['ToDt'];
$FromDt = date('Y-m-d', strtotime($FromDat));
$Todt = date('Y-m-d', strtotime($Todat));
$FromDt1 = date('d-m-Y', strtotime($FromDat));
$Todt1 = date('d-m-Y', strtotime($Todat));

$array = array();
?>
<style>
    th {
        font-size: 12px !important;
        padding-left: 2px !important;

    }
</style>

<table id="example" class="table table-bordered " style="width:99%">
    <thead>

        <tr>
            <th>Lead Source</th>
            <?php $userQ = mysqli_query($conn, "select UserName from Users where roll_id='15' and Active='1' order by UserName");
            while ($userF = mysqli_fetch_array($userQ)) { ?>
                <th><?php echo $userF['UserName'] ?></th>
            <?php } ?>
            <th></th>
        </tr>
    </thead>
    <tbody id="setTable">
        <?php

        $a = "";
        $sourceQ = mysqli_query($conn, "select Name,SourceId from Lead_Sources where  Active='YES'");
        while ($sourceF = mysqli_fetch_array($sourceQ)) {
            $data = array();
            ?>
            <tr>
                <td><?php echo $sourceF['Name']; ?></td>

                <?php $userQ = mysqli_query($conn, "select UserName,UserId,reg_id from Users where roll_id='15' and Active='1' order by UserName");
                while ($userF = mysqli_fetch_array($userQ)) {
                    $countQ = mysqli_query($conn, "select count(Lead_id) as c  from Leads_table where Lead_id IN (SELECT LeadId FROM `LeadDelegation` where SalesmanId='" . $userF['reg_id'] . "' ) and Status='5' and LeadSource='" . $sourceF['SourceId'] . "' and Lead_id IN (select Static_LeadID from Members where date(entryDate) BETWEEN '" . $FromDt . "' and '" . $Todt . "')");
                    $countF = mysqli_fetch_array($countQ);
                    $countQ2 = mysqli_query($conn, "select count(Lead_id) as c  from Leads_table where Lead_id IN (SELECT LeadId FROM `LeadDelegation` where SalesmanId='" . $userF['reg_id'] . "' ) and Status='5' and Lead_id IN (select Static_LeadID from Members where date(entryDate) BETWEEN '" . $FromDt . "' and '" . $Todt . "')");
                    $countF2 = mysqli_fetch_array($countQ2);
                    ?>
                    <td><?php echo $countF['c']; ?></td>

                    <?php $data[] = $countF2['c'];
                } ?>

            </tr>
        <?php } ?>


        <tr style="background-color:black;color:white">
            <th><b>Total</b></th>
            <?php
            $tt = "";
            for ($i = 0; $i <= count($data) - 1; $i++) { ?>
                <th><?php echo $data[$i];
                $tt += $data[$i]; ?></th>

            <?php }
            ?>
            <th>Total:-<?php echo $tt; ?></th>



        </tr>
    </tbody>






</table>