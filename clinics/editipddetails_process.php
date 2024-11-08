<?php
include "config.php";

var_dump($_POST); 

$ipdbillno = $_POST['bill'];
$observation = $_POST['observation'];
$indoor_reg_no = $_POST['indoor_reg_no'];
$payment = $_POST['payment'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$contact = $_POST['contact_no'];

$add_date = $_POST['add_date'];
$add_time = $_POST['add_time'];
// $add_time = date("H:i:s",strtotime($timeadd));

$datedis = $_POST['datedis'];
$timedis = $_POST['timedis'];
// $timedis = date("H:i:s",strtotime($diss_time));

$consult_doc = $_POST['consult_doc'];

$updated_at = date("Y-m-d H:i:s");

$sql = mysqli_query($con,"select id from ipdbill where id = '".$ipdbillno."' ");
// $result = mysqli_fetch_row($sql);

$id = $ipdbillno;

if(mysqli_num_rows($sql)>0){
    $update = mysqli_query($con,"update ipdbill set name = '".$name."', age = '".$age."',gender = '".$gender."',mobile_no = '".$contact."', address='".$address."',consult_doc = '".$consult_doc."',indoor_reg_no = '".$indoor_reg_no."', addmission_date = '".$add_date."', admission_time = '".$add_time."',discharge_date = '".$datedis."',discharge_time = '".$timedis."',observation = '".$observation."',payment_mode = '".$payment."',updated_at = '".$updated_at."' where id = '".$id."' ");
    if($update){ ?>

<script>
alert("Updated Successfully");
window.location.href = "viewipddetails.php";
// header("location: print_invoice.php?id=".$id);
</script>;
<?php } else { ?>
<script>
alert("Something Wrong!!");
history.back();
</script>;
<?php }
}

?>