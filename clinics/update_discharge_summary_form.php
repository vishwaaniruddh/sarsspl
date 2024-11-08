<?php
include "config.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// var_dump($_POST);
// die;

$bill_no = $_POST['bill_no'];
$indoor_reg_no = $_POST['indoor_reg_no'];
$payment_mode = $_POST['payment_mode'];

$bed_no = $_POST['bed_no'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$city = $_POST['city'];
$age = $_POST['age'];

$contact = $_POST['contact_no'];
$discharge_type = $_POST['discharge_type'];
$admission_date = $_POST['add_date'];
$admission_time = $_POST['add_time'];

$consult_doc = $_POST['consult_doc'];
$dept = $_POST['dept1'];

$consult_doc_1 = $_POST['consult_doc_1'];
$dept2 = $_POST['dept2'];

$consult_doc_2 = $_POST['consult_doc_2'];
$dept3 = $_POST['dept3'];

$discharge_dt = $_POST['datedis'];
$discharge_time = $_POST['timedis'];

$diagnosis = mysqli_real_escape_string($con, $_POST['diagnosis']);
$chief_complain = mysqli_real_escape_string($con, $_POST['chief_complain']);
$h_o = mysqli_real_escape_string($con, $_POST['h_o']);

$investigation = mysqli_real_escape_string($con, $_POST['investigation']);
$course_hospital = mysqli_real_escape_string($con, $_POST['course_hospital']);
$cond_discharge = mysqli_real_escape_string($con, $_POST['cond_discharge']);
$med_adv_discharge = mysqli_real_escape_string($con, $_POST['med_adv_discharge']);
$operation_details = mysqli_real_escape_string($con, $_POST['operation_details']);



//  A. General Examination
$pulse = $_POST['pulse'];
$bp = $_POST['bp'];
$temp = $_POST['temp'];
$rr = $_POST['rr'];
$spo2 = $_POST['spo2'];
$cvs = $_POST['cvs'];
$cns = $_POST['cns'];
$rs = $_POST['rs'];
$p_a = $_POST['p_a'];
$local_examination = $_POST['local_examination'];


$created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');



$sql = "UPDATE newdischarge_summary SET
    `indoor_reg_no` = '" . $indoor_reg_no . "',
    `payment` = '" . $payment_mode . "',
    `bed_no` = '" . $bed_no . "',
    `name` = '" . $name . "',
    `age` = '" . $age . "',
    `gender` = '" . $gender . "',
    `address` = '" . $address . "',
    `city` = '" . $city . "',
    `contact_no` = '" . $contact . "',
    `discharge_type` = '" . $discharge_type . "',
    `add_date` = '" . $admission_date . "',
    `add_time` = '" . $admission_time . "',
    `consult_doc` = '" . $consult_doc . "',
    `consult_doc_1` = '" . $consult_doc_1 . "',
    `consult_doc_2` = '" . $consult_doc_2 . "',
    `datedis` = '" . $discharge_dt . "',
    `timedis` = '" . $discharge_time . "',
    `diagnosis` = '" . $diagnosis . "',
    `chief_complain` = '" . $chief_complain . "',
    `h_o` = '" . $h_o . "',
    `pulse` = '" . $pulse . "',
    `bp` = '" . $bp . "',
    `temp` = '" . $temp . "',
    `rr` = '" . $rr . "',
    `spo2` = '" . $spo2 . "',
    `cvs` = '" . $cvs . "',
    `cns` = '" . $cns . "',
    `rs` = '" . $rs . "',
    `p_a` = '" . $p_a . "',
    `local_examination` = '" . $local_examination . "',
    `investigation` = '" . $investigation . "',
    `course_hospital` = '" . $course_hospital . "',
    `cond_discharge` = '" . $cond_discharge . "',
    `med_adv_discharge` = '" . $med_adv_discharge . "',
    `dept1` = '" . $dept . "',
    `dept2` = '" . $dept2 . "',
    `dept3` = '" . $dept3 . "',
    `operation_details` = '" . $operation_details . "',
   
    `updated_at` = '" . $updated_at . "'
WHERE `ipd_bill_no` = '" . $bill_no . "'";

echo "<br>" . $sql;
// die;
$sql_qry = mysqli_query($con, $sql);

if ($sql_qry) {
    // $last_id = mysqli_insert_id($con);

    echo '<script>alert("Data Inserted")</script>';
    header("location: newprint.php?id=" . $bill_no);
} else { ?>
    <script>
        alert("Something Went Wrong");
        history.back();
    </script>

<?php } ?>