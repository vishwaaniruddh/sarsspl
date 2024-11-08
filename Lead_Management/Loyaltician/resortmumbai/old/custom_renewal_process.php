<?php include ('config.php');

$memberid = $_POST['memberid'];
$memberid = $memberid + 1;

$Static_LeadID = $_POST['Static_LeadID'];

$member_type = $_POST['member_type'];
$MembershipDetails_Fee = $_POST['MembershipDetails_Fee'];
$MembershipDts_Discount = $_POST['MembershipDts_Discount'];
$MembershipDts_NetPayment = $_POST['MembershipDts_NetPayment'];
$MembershipDts_GST = $_POST['MembershipDts_GST'];
$MembershipDts_GrossTotal = $_POST['MembershipDts_GrossTotal'];
$MembershipDts_PaymentDate = $_POST['payment_date'];
$MembershipDts_PaymentMode = $_POST['MembershipDts_PaymentMode'];
$MembershipDts_InstrumentNumber = $_POST['MembershipDts_InstrumentNumber'];
$Member_bankName = $_POST['MemshipDts_BankName'];
$MemshipDts_BatchNumber = $_POST['MemshipDts_BatchNumber'];
$MemshipDts_Remarks = $_POST['MemshipDts_Remarks'];
$GST_Number = $_POST['MemshipDts_GST_number'];


$array = array_map('intval', str_split($memberid));
$array[1] = $member_type;
$array = json_encode($array);

$new_member_id = preg_replace('/[^A-Za-z0-9\-]/', '', $array);



$ymd = date("Y-m-d");

$date = date("d");


if ($date > 25) {

    $end_date = date('Y-m-d', strtotime('+13 months'));
    $expiry_date = date("Y-m-t", strtotime($end_date));

} else {

    $end_date = date('Y-m-d', strtotime('+1 years'));
    $expiry_date = date("Y-m-t", strtotime($end_date));

}







$update_sql = "update Members set GenerateMember_Id='" . $new_member_id . "',MembershipDetails_Level='" . $member_type . "',MembershipDetails_Fee='" . $MembershipDetails_Fee . "' , MembershipDts_Discount= '" . $MembershipDts_Discount . "' , MembershipDts_NetPayment='" . $MembershipDts_NetPayment . "' , MembershipDts_GST='" . $MembershipDts_GST . "' ,MembershipDts_GrossTotal = '" . $MembershipDts_GrossTotal . "', MembershipDts_PaymentDate = '" . $MembershipDts_PaymentDate . "' , MembershipDts_PaymentMode = '" . $MembershipDts_PaymentMode . "',MembershipDts_InstrumentNumber = '" . $MembershipDts_InstrumentNumber . "',Member_bankName = '" . $Member_bankName . "',MemshipDts_BatchNumber='" . $MemshipDts_BatchNumber . "',MemshipDts_Remarks='" . $MemshipDts_Remarks . "',GST_Number='" . $GST_Number . "',ExpiryDate='" . $expiry_date . "' where Static_LeadID='" . $Static_LeadID . "'";



$renewal_insert = "insert into RenewalMembersDetails(NewGenerateMember_Id,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_BatchNumber,MemshipDts_Remarks,Member_bankName,entryDate) values('" . $new_member_id . "','" . $_POST['memberid'] . "','" . $Static_LeadID . "','" . $member_type . "','" . $MembershipDetails_Fee . "','" . $MembershipDetails_offerCheck1 . "','" . $MembershipDts_Discount . "','" . $MembershipDts_NetPayment . "','" . $MembershipDts_GST . "','" . $MembershipDts_GrossTotal . "','" . $MembershipDts_PaymentDate . "','" . $MembershipDts_PaymentMode . "','" . $MembershipDts_InstrumentNumber . "','" . $MemshipDts_BatchNumber . "','" . $MemshipDts_Remarks . "','" . $Member_bankName . "','" . $ymd . "')
";




$history_insert = "insert into MemberHistory(memberId,entrydate) values('" . $Static_LeadID . "','" . $ymd . "')";



if (mysqli_query($conn, $update_sql)) {

    mysqli_query($conn, $renewal_insert);
    mysqli_query($conn, $history_insert);

    $sql5 = "	SELECT AssignBooklet FROM `voucher_Booklet` where Level_id='" . $member_type . "'";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);
    $newbookletno = $sql5fetch[0] + 1;
    mysqli_query($conn, "insert into voucher_Details (MembershipNumber,VoucherBookletNumber)values('" . $new_member_id . "','" . $newbookletno . "')");
    mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $newbookletno . "' where Level_id='" . $member_type . "'");

    $q = "SELECT count(level_id) as V_no from voucher_Type where level_id='" . $member_type . "'";
    $sql = mysqli_query($conn, $q);
    $_row = mysqli_fetch_array($sql);

    for ($i = 1; $i <= $_row['V_no']; $i++) {

        $countR = $i;
        $readyToUse = sprintf("%03s", $countR);
        $NoOfVoucher = $newbookletno . $readyToUse;
        //echo $NoOfVoucher."<br>";

        mysqli_query($conn, "insert into BarcodeScan(Voucher_id,Available) values('" . $NoOfVoucher . "','0')");
    }

    ?>

    <script>

        alert('Renewed Successfully');

        window.location.href = "custom_renew.php?id=<?php echo $Static_LeadID; ?>"
    </script>

<?php } else { ?>
    <script>
        alert('Renewed Error');

        window.location.href = "custom_renew.php?id=<?php echo $Static_LeadID; ?>"
    </script>
<?php } ?>