<?php include ('config.php');

$usedDate = date('Y-m-d');
//$usedDate='2019-10-09';
$data = array();

$run = mysqli_query($conn, "SELECT Voucher_id,usedDate FROM BarcodeScan where usedDate<>'0000-00-00 00:00:00' Order by usedDate desc");// WHERE date(usedDate) ='".$usedDate."'");
while ($fetch_value = mysqli_fetch_array($run)) {
    $Voucher_id = $fetch_value['Voucher_id'];
    $result = substr($Voucher_id, 0, 8);

    $memName = mysqli_query($conn, "select Primary_nameOnTheCard,GenerateMember_Id from Members where GenerateMember_Id=(select MembershipNumber from voucher_Details where VoucherBookletNumber='" . $result . "')");
    $memName_fetch = mysqli_fetch_array($memName);

    $data[] = ['Voucher_id' => $Voucher_id, 'usedDate' => $fetch_value['usedDate'], 'memid' => $memName_fetch['GenerateMember_Id'], 'memName' => $memName_fetch['Primary_nameOnTheCard']];
}
$data1 = array('barcode' => $data);
echo json_encode($data1);
?>