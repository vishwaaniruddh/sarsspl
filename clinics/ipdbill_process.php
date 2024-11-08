<?php

include("config.php");

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// die;
$particulars = $_POST['particulars'];
// var_dump($particulars);
// echo "<pre>";
// print_r($particulars);
// echo "</pre>";

// die;
$billid = $_POST['bill_id'];
$address = $_POST['address'];
$payment = $_POST['payment'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$indoor_reg_no = $_POST['indoor_reg_no'];
$contact = $_POST['contact_no'];
$admission_date = $_POST['add_date'];
$admission_time = $_POST['add_time'];
$consult_doc = $_POST['consult_doc'];
$consult_doc2 = $_POST['consult_doc2'];
$discharge_dt = $_POST['datedis'];
$discharge_time = $_POST['timedis'];
// $dutydoc = $_POST['dutydoc'];
$quantity = $_POST['quantity'];
$rate = $_POST['rate'];
$amount = $_POST['amount'];
$discount = $_POST['discount'];
$totalamt = $_POST['totalAmount'];
$paid_amt = $_POST['finalAmount'];
$advamount = $_POST['AdvAmount'];
$observation = $_POST['observation'];

$created_at = date('Y-m-d H:i:s');


// die;
// echo "insert into ipdbill(name,age,gender,mobile_no,address,consult_doc,payment_mode,indoor_reg_no,addmission_date,admission_time,discharge_date,discharge_time,duty_doc,t_amt,discount,paid_amt,created_at) values 
// ('" . $name . "','" . $age . "','" . $gender . "','" . $contact . "','" . $address . "','" . $consult_doc . "','" . $payment . "','" . $indoor_reg_no . "','" . $admission_date . "','" . $admission_time . "','" . $discharge_dt . "','" . $discharge_time . "','" . $dutydoc . "','" . $totalamt . "','" . $discount . "','" . $paid_amt . "','" . $created_at . "')  ";

$sql = mysqli_query($con, "insert into ipdbill(name,age,gender,mobile_no,address,consult_doc,consult_doc2,payment_mode,indoor_reg_no,addmission_date,admission_time,discharge_date,discharge_time,t_amt,discount,paid_amt,created_at,observation,advanceAmount) values 
('" . $name . "','" . $age . "','" . $gender . "','" . $contact . "','" . $address . "','" . $consult_doc . "','".$consult_doc2."','" . $payment . "','" . $indoor_reg_no . "','" . $admission_date . "','" . $admission_time . "','" . $discharge_dt . "','" . $discharge_time . "','" . $totalamt . "','" . $discount . "','" . $paid_amt . "','" . $created_at . "','" . $observation . "','" . $advamount . "' )  ");

if ($sql) {
    $last_id = mysqli_insert_id($con);

    // echo $last_id;
    for ($i = 0; $i < count($particulars); $i++) {
        $_particulars = $particulars[$i];
        $_quantity = $quantity[$i];
        $_rate = $rate[$i];
        $_amount = $amount[$i];
        // echo "insert into ipdbill_details (bill_id,particulars,quantity,rate,amount,created_at) values ('" . $last_id . "','" . $_particulars . "','" . $_quantity . "','" . $_rate . "','" . $_amount . "','" . $created_at . "') " . "<br>";


        $ipd_detail_sql = mysqli_query($con, "insert into ipdbill_details (bill_id,particulars,quantity,rate,amount,created_at) values ('" . $last_id . "','" . $_particulars . "','" . $_quantity . "','" . $_rate . "','" . $_amount . "','" . $created_at . "') ");
    }
    echo '<script>alert("Data Inserted")</script>';
    header("location: print_invoice.php?id=" . $last_id);
    exit();
} else { ?>
    <script>
        debugger;
        alert("Something Wrong");
        history.back();
    </script>

<?php } ?>