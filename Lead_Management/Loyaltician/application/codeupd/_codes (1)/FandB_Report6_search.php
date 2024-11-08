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
<table id="example" class="table" style="width:100%">
    <thead>
        <tr>
            <th>SN</th>
            <th>Pincode</th>
            <th>Visits</th>
            <th>Amount Spent</th>
        </tr>
    </thead>
    <tbody id="setTable">
        <?php
        /* $Pincod =mysqli_query($conn,"Select distinct Primary_Pincode from Members where 1=1 ");
         while($Fetch_Pincod=mysqli_fetch_array($Pincod)){
         
         
         }*/

        $i = 1;
        $q1 = mysqli_query($conn, "SELECT Primary_nameOnTheCard,MembershipDetails_Level,GenerateMember_Id,entryDate,booklet_Series FROM `Members` where  canceledMember=0  ");
        while ($f1 = mysqli_fetch_array($q1)) {


            $q2 = mysqli_query($conn, "SELECT sum(No_of_paxClose),sum(NettAmount) FROM `POS_table` where  CertificateNumber='" . $f1['GenerateMember_Id'] . "'  ");
            $f2 = mysqli_fetch_array($q2);

            //"SELECT *  FROM `Members` where  BillDate BETWEEN '".$FromDt."' AND '".$Todt."'";
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $f1['Primary_nameOnTheCard']; ?></td>
                <td><?php echo $f1['MembershipDetails_Level']; ?></td>
                <td><?php echo $f1['GenerateMember_Id']; ?></td>
            </tr>

            <?php $i++;
        } ?>

    </tbody>

</table>