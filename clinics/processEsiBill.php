<?php

include 'config.php';

// var_dump($_POST); die;

// Remove var_dump($_POST) and ensure there's no output before header()
$bill_no = $_POST['bill_no'];
$id = $_POST['ad_id'];
// $pid = $_POST['pid'];
$cond = $_POST['condi'];
$diag = $_POST['diag'];
$refno = $_POST['refno'];
$insurance_no = $_POST['fd'];
$pensioner_name = $_POST['fd_name'];
$contact_no = $_POST['contact'];
$indoor_reg_no = $_POST['indoor_reg_no'];
$_datedis = $_POST['datedis'];
$datedis = date('Y-m-d', strtotime($_datedis));
$timedis = $_POST['timedis'];
$dept = $_POST['dept'];
$consult = $_POST['consult'];
$proc = $_POST['proc'];
$other = $_POST['other'];
$code = $_POST['code'];
$rate = $_POST['rate'];
$amt = $_POST['amt'];
$amtdt = $_POST['amtdt'];
$qty = $_POST['qty'];
$amtc = $_POST['amtc'];
$implan = $_POST['implan'];
$rem1 = $_POST['rem1'];
$other_proc = $_POST['other_proc'];
$other_rate = $_POST['other_rate'];
$other_cdate = $_POST['other_cdate'];
$other_qty = $_POST['other_qty'];
$other_crate = $_POST['other_crate'];
$amtcII = $_POST['amtcII'];
$procs = $_POST['procs'];
$others = $_POST['others'];
$codes = $_POST['codes'];
$rates = $_POST['rates'];
$amts = $_POST['amts'];
$amtsdt = $_POST['amtsdt'];
$qtys = $_POST['qtys'];
$amtcIII = $_POST['amtcIII'];
$medst = $_POST['medst'];
$bills = $_POST['bills'];
$amtst = $_POST['amtst'];
$amtstdt = $_POST['amtstdt'];
$amtcIV = $_POST['amtcIV'];

// Amount admitted
$amtad1 = $_POST['amtad1'];
$amtad2 = $_POST['amtadII'];
$amtad3 = $_POST['amtadIII'];
$amtad4 = $_POST['amtadIV'];

$totalamt = $_POST['totalamt'];
$totalamtad = $_POST['totalamtad'];
$totalrem = $_POST['totalrem'];
$rem = $rem1 . "." . $totalrem;
$d = count($proc);
$d1 = count($other_proc);
$d2 = count($procs);
$d3 = count($medst);

$name = $_POST['name'];
$new_esi_id = $_POST['new_esi_id'];

// $addsql = mysqli_query($con, "UPDATE admission SET dis_date='$datedis', dis_time='$timedis' WHERE ad_id='$id'");

if ($new_esi_id) {
    $dischargesql = mysqli_query($con, "INSERT INTO esibill(new_esi_id, diagnosis, condi, implant, amt1, amt2, amt3, remarks, department, consultant, amt4, patient_name, ref_no, insurance_no, pensioner_name, amtad1, amtad2, amtad3, amtad4, totalamt, totalamtad, indoor_reg_no, bill_no) VALUES('$new_esi_id', '$diag', '$cond', '$implan', '$amtc', '$amtcII', '$amtcIII', '$rem', '$dept', '$consult', '$amtcIV', '$name', '$refno', '$insurance_no', '$pensioner_name', '$amtad1', '$amtad2', '$amtad3', '$amtad4', '$totalamt', '$totalamtad', '$indoor_reg_no', '$bill_no')");
    
    echo "INSERT INTO esibill(new_esi_id, diagnosis, condi, implant, amt1, amt2, amt3, remarks, department, consultant, amt4, patient_name, ref_no, insurance_no, pensioner_name, amtad1, amtad2, amtad3, amtad4, totalamt, totalamtad, indoor_reg_no, bill_no) VALUES('$new_esi_id', '$diag', '$cond', '$implan', '$amtc', '$amtcII', '$amtcIII', '$rem', '$dept', '$consult', '$amtcIV', '$name', '$refno', '$insurance_no', '$pensioner_name', '$amtad1', '$amtad2', '$amtad3', '$amtad4', '$totalamt', '$totalamtad', '$indoor_reg_no', '$bill_no')";
    
    if ($dischargesql) {
        
            echo "INSERT INTO esibill(new_esi_id, diagnosis, condi, implant, amt1, amt2, amt3, remarks, department, consultant, amt4, patient_name, ref_no, insurance_no, pensioner_name, amtad1, amtad2, amtad3, amtad4, totalamt, totalamtad, indoor_reg_no, bill_no) VALUES('$new_esi_id', '$diag', '$cond', '$implan', '$amtc', '$amtcII', '$amtcIII', '$rem', '$dept', '$consult', '$amtcIV', '$name', '$refno', '$insurance_no', '$pensioner_name', '$amtad1', '$amtad2', '$amtad3', '$amtad4', '$totalamt', '$totalamtad', '$indoor_reg_no', '$bill_no')";

        for ($i = 0; $i < $d; $i++) {
            if ($code[$i] != '') {
                mysqli_query($con, "INSERT INTO esibill_details(new_esi_id, code, other, rate, qty, claimed, type, claim_date) VALUES('$new_esi_id', '$proc[$i]', '$other[$i]', '$rate[$i]', '$qty[$i]', '$amt[$i]', '1', '$amtdt[$i]')");
                // echo "INSERT INTO esibill_details(ad_id, code, other, rate, qty, claimed, type, claim_date) VALUES('$new_esi_id', '$proc[$i]', '$other[$i]', '$rate[$i]', '$qty[$i]', '$amt[$i]', '1', '$amtdt[$i]')";
            }
        }

        for ($i = 0; $i < $d1; $i++) {
            if ($other_proc[$i] != 0) {
                mysqli_query($con, "INSERT INTO esibill_details(new_esi_id, code, rate, qty, claimed, type, claim_date) VALUES('$new_esi_id', '$other_proc[$i]', '$other_rate[$i]', '$other_qty[$i]', '$other_crate[$i]', '2', '$other_cdate[$i]')");
            }
        }

        for ($i = 0; $i < $d2; $i++) {
            if ($codes[$i] != '') {
                mysqli_query($con, "INSERT INTO esibill_details(new_esi_id, code, other, rate, qty, claimed, type, claim_date) VALUES('$new_esi_id', '$procs[$i]', '$others[$i]', '$rates[$i]', '$qtys[$i]', '$amts[$i]', '3', '$amtsdt[$i]')");
            }
        }

        for ($i = 0; $i < $d3; $i++) {
            if ($medst[$i] != 0) {
                mysqli_query($con, "INSERT INTO esibill_details(new_esi_id, code, other, rate, qty, claimed, type, claim_date) VALUES('$new_esi_id', '$medst[$i]', '$bills[$i]', '0', '0', '$amtst[$i]', '4', '$amtstdt[$i]')");
            }
        }

        echo '<script>alert("Data Inserted")</script>';
        header("Location: esibillPrint.php?id=$new_esi_id");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo '<script>alert("Something Went Wrong"); history.back();</script>';
    }
} else {
    echo '<script>alert("Something Went Wrong"); history.back();</script>';
}
