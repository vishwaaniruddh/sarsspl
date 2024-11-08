<?php include('config.php');




$vchrs=$_POST['vouchers'];
$ymd = date("Y-m-d");
$Static_LeadID=$_POST['Static_LeadID'];
$id = $Static_LeadID;

$ext_id = $_POST['extension'];
$get_ext_sql = mysqli_query($conn,"select * from extension where id='".$ext_id."'");
$get_ext_sql_result = mysqli_fetch_assoc($get_ext_sql);
$get_ext = $get_ext_sql_result['extension'];



$payment_date = $_POST['from_date'];
 $payment_date = date("Y-m-d", strtotime($payment_date) );


// require 'phpmail/src/PHPMailer.php';
// require 'phpmail/src/SMTP.php';
// $mail2 = new PHPMailer\PHPMailer\PHPMailer();

// $rev_mail2 = new PHPMailer\PHPMailer\PHPMailer();


$member_info = mysqli_query($conn,"select * from Members where Static_LeadID= '".$id."'");
$member_info_result = mysqli_fetch_assoc($member_info);


$mem_pre_expiry = $member_info_result['ExpiryDate'];
$old_booklet = $member_info_result['booklet_Series'];

if(isset($_POST['vouchers'])){
    
$date = date("d",strtotime($payment_date));
$expiry_date_1 = date('Y-m-d', strtotime($payment_date.'+'.$ext_id.' months'));

// echo "insert into Extension_history(member_id,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('".$Static_LeadID."','".$old_booklet."','".$mem_pre_expiry."','".$expiry_date_1."','".$get_ext."','".$ymd."','RVWR')";

// echo '<br>';
    mysqli_query($conn,"insert into Extension_history(member_id,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('".$Static_LeadID."','".$old_booklet."','".$mem_pre_expiry."','".$expiry_date_1."','".$get_ext."','".$ymd."','RVWR')");
    
    foreach ($vchrs as &$value) {
             $vchsql="update BarcodeScan set start_date='".$payment_date."',is_extended=1 where Voucher_id='".$value."'";
            // echo '<br>';
            mysqli_query($conn,$vchsql);
}

unset($value);

      include('only_revalidate_mail.php');

?>
    
    
    <script>
        alert('Revalidate Successfully');
        window.location.href="only_revalidation.php"
    </script>
    
<?php }
else{ ?>
    <script>
        alert('Revalidate Error');
        window.location.href="only_revalidation.php"
    </script>
<?php } ?>