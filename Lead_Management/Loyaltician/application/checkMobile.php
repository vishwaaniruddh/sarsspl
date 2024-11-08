<?php
include ('config.php');
//ECHO 'TR';
error_reporting(0);

$mob = $_POST['mob'];
//$mcode1=$_POST['mcode1'];
/*if($mcode1==""){
   $mobile=$mob;
}else{
    $mobile=$mcode1.'-'.$mob;
}*/

$Table = $_POST['Table'];
$column = $_POST['column'];
$MainGetID = $_POST['MainGetID'];
//echo $email;
//echo "SELECT * FROM `login` where username='".$email."'";

if ($MainGetID != "") {
    $qr = mysqli_query($conn, "SELECT * FROM $Table where $column='" . $mob . "' and Lead_id!='" . $MainGetID . "' ");

}

$qr = mysqli_query($conn, "SELECT * FROM $Table where $column='" . $mob . "' ");
//echo "SELECT * FROM $Table where $column='".$mob."'";
$nrws = mysqli_num_rows($qr);
if ($nrws > 0) {
    echo "1";
} else {
    echo "0";
}


?>