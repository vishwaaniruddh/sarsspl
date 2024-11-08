<?php

include ("access.php");
include ("config.php");


$cname = $_POST['chn'];
$chno = $_POST['chno'];
$tid = $_POST['tid'];

$paiddt = str_replace('/', '-', $_POST['td']);

$pd = date('Y-m-d', strtotime($paiddt));


//echo "hello";

mysqli_autocommit($con, FALSE);

$qry = mysqli_query($con, "update quotation1ftransfers set pdate='" . $pd . "',chq_name='" . $cname . "',chqno='" . $chno . "',status='1' where tid='" . $tid . "'");


if ($qry) {
    mysqli_query($con, "COMMIT");
    echo "Transfered";

} else {
    mysqli_query($con, "ROLLBACK");
    echo "Error";

}



?>