<?php

include ("access.php");
include ("config.php");


$quotid = $_POST['quotid'];
$particular = $_POST['partic'];
$pr = $_POST['partyp'];
$prc = $_POST['partqty'];
$rate = $_POST['partrate'];
$amt = $_POST['partamt'];
$tcode = $_POST['tcode'];
$uom = $_POST['uom'];
$stxx = $_POST['stxx'];
//print_r($stxx);

$errors = "0";

/*
echo $quotid;
print_r($particular);
echo "<br>";
print_r($pr);
echo "<br>";
print_r($prc);
echo "<br>";
print_r($rate);
echo "<br>";
print_r($amt);

*/


mysqli_autocommit($con, FALSE);

$a = 9;
$b = 0;

for ($i = 0; $i < count($pr); $i++) {

    //$part="";
    $part = $particular[$b];


    if ($pr[$i] != "") {


        $qrins2 = mysqli_query($con, "INSERT INTO `Rnm_quotation_details_tis`(`qid`, `particular`, `description`, `quantity`, `rate`, `Total`,tcode,uom,ServiceTax) values('" . $quotid . "','" . $part . "','" . $pr[$i] . "','" . $prc[$i] . "','" . $rate[$i] . "','" . $amt[$i] . "','" . $tcode[$i] . "','" . $uom[$i] . "','" . $stxx[$i] . "')");

        if (!$qrins2) {
            $errors++;
        }

    }

    if ($i == $a) {

        $b = $b + 1;
        $a = $a + 10;

    }




}


//echo "Select sum(Total) from Rnm_quotation_details where qid='".$quotid."'";
$gtot2 = mysqli_query($con, "Select sum(Total) from Rnm_quotation_details_tis where qid='" . $quotid . "'");
$rowtot = mysqli_fetch_array($gtot2);
//echo "Update rnm_invoice_details SET `ApprovalAmount`='".$rowtot[0]."' where  qid='".$quotid."'";
$upqry1 = mysqli_query($con, "Update rnm_invoice_details_tis SET `ApprovalAmount`='" . $rowtot[0] . "' where  qid='" . $quotid . "'");



if ($errors == 0) {
    mysqli_query($con, "COMMIT");
    echo "Quotation ID -" . $quotid . " " . "Updated";



} else {
    mysqli_query($con, "ROLLBACK");
    echo "Error";

}





?>