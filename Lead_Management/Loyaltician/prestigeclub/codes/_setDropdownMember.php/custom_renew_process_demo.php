<?php include ('config.php');

$memberid = $_POST['memberid'];
$memberid = $memberid + 1;

$Static_LeadID = $_POST['Static_LeadID'];

$id = $Static_LeadID;

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




$booklet_sql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Static_LeadID . "'");
$booklet_sql_result = mysqli_fetch_assoc($booklet_sql);

$old_booklet = $booklet_sql_result['booklet_Series'];
$ExpiryDate = $booklet_sql_result['ExpiryDate'];


$MembershipDts_PaymentDate = date("Y-m-d", strtotime($MembershipDts_PaymentDate));






$date = date('d', strtotime($MembershipDts_PaymentDate));

$extra = $get_ext + 1;

// if($date>25){

//         $end_date =  date('Y-m-d', strtotime($MembershipDts_PaymentDate. '+13 months')); 
//         $next_expiry_date = date("Y-m-t", strtotime($end_date));

//     }
// else{
$end_date = date('Y-m-d', strtotime($ExpiryDate . '+12 months'));
$next_expiry_date = date("Y-m-t", strtotime($end_date));

// }





if (strtotime($MembershipDts_PaymentDate) < strtotime($ExpiryDate)) {
    // insert to future member renewal table

    $sql5 = "SELECT AssignBooklet FROM `voucher_Booklet` where Level_id='" . $member_type . "'";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);


    $newbookletno = $sql5fetch[0] + 1;

    $member_sql = $booklet_sql_result;

    unset($member_sql['mem_id']);
    $columns = implode(",", array_keys($member_sql));
    $escaped_values = array_values($member_sql);
    $values = implode("','", $escaped_values);

    $sql = "INSERT INTO Future_renewed_member($columns) VALUES ('$values')";

    mysqli_query($conn, $sql);

    $update_sql = "update Future_renewed_member set GenerateMember_Id='" . $new_member_id . "',MembershipDetails_Level='" . $member_type . "',MembershipDetails_Fee='" . $MembershipDetails_Fee . "' , MembershipDts_Discount= '" . $MembershipDts_Discount . "' , MembershipDts_NetPayment='" . $MembershipDts_NetPayment . "' , MembershipDts_GST='" . $MembershipDts_GST . "' ,MembershipDts_GrossTotal = '" . $MembershipDts_GrossTotal . "', MembershipDts_PaymentDate = '" . $MembershipDts_PaymentDate . "' , MembershipDts_PaymentMode = '" . $MembershipDts_PaymentMode . "',MembershipDts_InstrumentNumber = '" . $MembershipDts_InstrumentNumber . "',Member_bankName = '" . $Member_bankName . "',MemshipDts_BatchNumber='" . $MemshipDts_BatchNumber . "',MemshipDts_Remarks='" . $MemshipDts_Remarks . "',GST_Number='" . $GST_Number . "',ExpiryDate='" . $next_expiry_date . "',booklet_Series='" . $newbookletno . "' where Static_LeadID='" . $Static_LeadID . "'";


    $renewal_insert = "insert into RenewalMembersDetails(NewGenerateMember_Id,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_BatchNumber,MemshipDts_Remarks,Member_bankName,entryDate) values('" . $new_member_id . "','" . $_POST['memberid'] . "','" . $Static_LeadID . "','" . $member_type . "','" . $MembershipDetails_Fee . "','" . $MembershipDetails_offerCheck1 . "','" . $MembershipDts_Discount . "','" . $MembershipDts_NetPayment . "','" . $MembershipDts_GST . "','" . $MembershipDts_GrossTotal . "','" . $MembershipDts_PaymentDate . "','" . $MembershipDts_PaymentMode . "','" . $MembershipDts_InstrumentNumber . "','" . $MemshipDts_BatchNumber . "','" . $MemshipDts_Remarks . "','" . $Member_bankName . "','" . $ymd . "')
";



    $history_insert = "insert into MemberHistory(memberId,entrydate) values('" . $Static_LeadID . "','" . $ymd . "')";



    if (mysqli_query($conn, $update_sql)) {

        mysqli_query($conn, $renewal_insert);
        mysqli_query($conn, $history_insert);



        mysqli_query($conn, "insert into Extension_history(member_id,new_booklet_series,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('" . $Static_LeadID . "','" . $newbookletno . "','" . $old_booklet . "','" . $next_expiry_date . "','" . $expiry_date . "','12','" . $ymd . "','RV')");


        mysqli_query($conn, "insert into voucher_Details (MembershipNumber,VoucherBookletNumber)values('" . $new_member_id . "','" . $newbookletno . "')");

        mysqli_query($conn, "update voucher_Booklet set AssignBooklet='" . $newbookletno . "' where Level_id='" . $member_type . "'");

        $q = "SELECT count(level_id) as V_no from voucher_Type where level_id='" . $member_type . "'";
        $sql = mysqli_query($conn, $q);
        $_row = mysqli_fetch_array($sql);

        for ($i = 1; $i <= $_row['V_no']; $i++) {

            $countR = $i;
            $readyToUse = sprintf("%03s", $countR);
            $NoOfVoucher = $newbookletno . $readyToUse;



            mysqli_query($conn, "insert into BarcodeScan(Voucher_id,start_date,Available) values('" . $NoOfVoucher . "','" . $MembershipDts_PaymentDate . "','0')");

            //   echo '<br>';

        }



        $ext_id = $_POST['extension'];
        $get_ext_sql = mysqli_query($conn, "select * from extension where id='" . $ext_id . "'");

        $get_ext_sql_result = mysqli_fetch_assoc($get_ext_sql);

        $get_ext = $get_ext_sql_result['extension'];


        $payment_date = $_POST['from_date'];
        if (isset($_POST['vouchers']))
            $vchrs = $_POST['vouchers'];

        $date = date("d", strtotime($payment_date));

        $expiry_date_1 = date('Y-m-d', strtotime($payment_date . '+' . $ext_id . ' months'));
        $update_sql_1 = "update Members set ExpiryDate='" . $expiry_date_1 . "' where Static_LeadID='" . $id . "'";



        mysqli_query($conn, $update_sql_1);

        if (isset($vchrs)) {
            foreach ($vchrs as &$value) {
                //$value = $value * 2;
                $vchsql = "update BarcodeScan set start_date='" . $payment_date . "',is_extended=1 where Voucher_id='" . $value . "'";
                mysqli_query($conn, $vchsql);
            }
            unset($value);
        }


        if ($member_type == 1) {
            include ('renew_mailtestFirst.php');
        } else if ($member_type == 2) {
            include ('renew_mailtestGold.php');
        } else if ($member_type == 3) {
            include ('renew_mailtest.php');
        }

        if (isset($vchrs)) {
            include ('revalidate_mail.php');
        }
        ?>

        <script>

            alert('Renewed Successfully');

            window.location.href = "renewals.php"
        </script>

    <?php } else { ?>
        <script>
            alert('Renewed Error');

            window.location.href = "renewals.php"
        </script>
    <?php }



    ?>


<?php } else {
    //update in the same table


    if ($date > 25) {

        $end_date = date('Y-m-d', strtotime('+13 months'));
        $expiry_date = date("Y-m-t", strtotime($end_date));

    } else {

        $end_date = date('Y-m-d', strtotime('+1 years'));
        $expiry_date = date("Y-m-t", strtotime($end_date));

    }





    $sql5 = "SELECT AssignBooklet FROM `voucher_Booklet` where Level_id='" . $member_type . "'";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);
    $newbookletno = $sql5fetch[0] + 1;




    $update_sql = "update Members set GenerateMember_Id='" . $new_member_id . "',MembershipDetails_Level='" . $member_type . "',MembershipDetails_Fee='" . $MembershipDetails_Fee . "' , MembershipDts_Discount= '" . $MembershipDts_Discount . "' , MembershipDts_NetPayment='" . $MembershipDts_NetPayment . "' , MembershipDts_GST='" . $MembershipDts_GST . "' ,MembershipDts_GrossTotal = '" . $MembershipDts_GrossTotal . "', MembershipDts_PaymentDate = '" . $MembershipDts_PaymentDate . "' , MembershipDts_PaymentMode = '" . $MembershipDts_PaymentMode . "',MembershipDts_InstrumentNumber = '" . $MembershipDts_InstrumentNumber . "',Member_bankName = '" . $Member_bankName . "',MemshipDts_BatchNumber='" . $MemshipDts_BatchNumber . "',MemshipDts_Remarks='" . $MemshipDts_Remarks . "',GST_Number='" . $GST_Number . "',ExpiryDate='" . $expiry_date . "',booklet_Series='" . $newbookletno . "',entryDate='" . $ymd . "' where Static_LeadID='" . $Static_LeadID . "'";




    $renewal_insert = "insert into RenewalMembersDetails(NewGenerateMember_Id,GenerateMember_Id,Static_LeadID,MembershipDetails_Level,MembershipDetails_Fee,MembershipDetails_offerCheck1,MembershipDts_Discount,MembershipDts_NetPayment,MembershipDts_GST,MembershipDts_GrossTotal,MembershipDts_PaymentDate,MembershipDts_PaymentMode,MembershipDts_InstrumentNumber,MemshipDts_BatchNumber,MemshipDts_Remarks,Member_bankName,entryDate) values('" . $new_member_id . "','" . $_POST['memberid'] . "','" . $Static_LeadID . "','" . $member_type . "','" . $MembershipDetails_Fee . "','" . $MembershipDetails_offerCheck1 . "','" . $MembershipDts_Discount . "','" . $MembershipDts_NetPayment . "','" . $MembershipDts_GST . "','" . $MembershipDts_GrossTotal . "','" . $MembershipDts_PaymentDate . "','" . $MembershipDts_PaymentMode . "','" . $MembershipDts_InstrumentNumber . "','" . $MemshipDts_BatchNumber . "','" . $MemshipDts_Remarks . "','" . $Member_bankName . "','" . $ymd . "')
";




    $history_insert = "insert into MemberHistory(memberId,entrydate) values('" . $Static_LeadID . "','" . $ymd . "')";




    if (mysqli_query($conn, $update_sql)) {

        mysqli_query($conn, $renewal_insert);
        mysqli_query($conn, $history_insert);



        mysqli_query($conn, "insert into Extension_history(member_id,new_booklet_series,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('" . $Static_LeadID . "','" . $newbookletno . "','" . $old_booklet . "','" . $next_expiry_date . "','" . $expiry_date . "','12','" . $ymd . "','RV')");


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



        $ext_id = $_POST['extension'];
        $get_ext_sql = mysqli_query($conn, "select * from extension where id='" . $ext_id . "'");

        $get_ext_sql_result = mysqli_fetch_assoc($get_ext_sql);

        $get_ext = $get_ext_sql_result['extension'];



        $payment_date = $_POST['payment_date'];
        if (isset($_POST['vouchers']))
            $vchrs = $_POST['vouchers'];

        $date = date("d", strtotime($payment_date));

        $expiry_date_1 = date('Y-m-d', strtotime($payment_date . '+' . $ext_id . ' months'));
        $update_sql_1 = "update Members set ExpiryDate='" . $expiry_date_1 . "' where Static_LeadID='" . $id . "'";



        mysqli_query($conn, $update_sql_1);

        if (isset($vchrs)) {
            foreach ($vchrs as &$value) {
                //$value = $value * 2;
                $vchsql = "update BarcodeScan set start_date='" . $payment_date . "',is_extended=1 where Voucher_id='" . $value . "'";
                mysqli_query($conn, $vchsql);
            }
            unset($value);
        }

        if ($member_type == 1) {
            include ('renew_mailtestFirst.php');
        } else if ($member_type == 2) {
            include ('renew_mailtestGold.php');
        } else if ($member_type == 3) {
            include ('renew_mailtest.php');
        }

        if (isset($vchrs)) {
            include ('revalidate_mail.php');
        }
        ?>


        ?>

        <script>

            alert('Renewed Successfully');

            window.location.href = "renewals.php"
        </script>

    <?php } else { ?>
        <script>
            alert('Renewed Error');

            window.location.href = "renewals.php"
        </script>
    <?php }
}
?>