<?php include ('config.php');

$id = $_POST['id'];
// echo $id;
$_promotional_voucher = mysqli_query($contest, "select issued_voucher_code from voucher_issued_additional where voucher_code = '52' ");
$voucher_detail = mysqli_fetch_assoc($_promotional_voucher);
$issued_voucher_code = $voucher_detail['issued_voucher_code'];
// echo $issued_voucher_code;

// die;


if ($id > 0) {
    // echo "test.$id";
    $userdata = "select Static_LeadID,PromotionalCheck1,promotional_voucher_code from Members where Static_LeadID ='" . $id . "'";
    $user_sql = mysqli_query($contest, $userdata);
    $user_data = mysqli_fetch_assoc($user_sql);
    $PromotionalCheck1 = $user_data['PromotionalCheck1'];
    $promotional_voucher_code = $user_data['promotional_voucher_code'];

    if ($PromotionalCheck1 == 0) {
        $status = 1;
    }
    if ($promotional_voucher_code == '') {
        $issued_voucher_code = $issued_voucher_code + 1;
    }
    $sql = "update Members set PromotionalCheck1 = '1', promotional_voucher_code = '" . $issued_voucher_code . "' where Static_LeadID ='" . $id . "'";
    // echo $sql;
    if (mysqli_query($contest, $sql)) {
        mysqli_query($contest, "update voucher_issued_additional set issued_voucher_code = '" . $issued_voucher_code . "' where voucher_code = '52' ");
        echo 1;
    } else {
        echo 0;
    }
} else {
    echo 0;
}

?>