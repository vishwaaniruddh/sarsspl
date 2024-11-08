<?php session_start();
ini_set('memory_limit', '-1');
include ('config.php');

$graph = $_POST['graph'];
$FromDat = $_POST['FromDt'];
$Todat = $_POST['Todt'];
$MemberId = $_POST['MemberId'];

$FromDt = date('Y-m-d', strtotime($FromDat));
$Todt = date('Y-m-d', strtotime($Todat));


$data = array();
//=================== get month name and month in number ====
$convert_date_From = strtotime($FromDt);
$From_MonthName = date('F', $convert_date_From);
$From_Month = date('m', $convert_date_From);

$convert_date_To = strtotime($Todat);
$From_ToName = date('F', $convert_date_To);
$From_To = date('m', $convert_date_To);
//===========================================================
if ($graph == 'graph1') {


    $j = 0;
    for ($i = $From_Month; $i <= $From_To; $i++) {

        $q = "	SELECT No_of_paxClose FROM `POS_table` where BillDate BETWEEN '" . $FromDt . "' AND '" . $Todt . "' and CertificateNumber='" . $MemberId . "'  and type=1 and MONTH(BillDate)='" . $i . "'   ";
        $q1 = mysqli_query($conn, $q);
        $f1 = mysqli_fetch_array($q1);

        if ($f1['No_of_paxClose'] != "") {

            $Cover = $f1['No_of_paxClose'];
        } else {

            $Cover = "0";
        }


        $date = strtotime($FromDt);
        $newDate = date("Y-m-d", strtotime("+$j month", $date));
        ++$j;

        $date1 = strtotime($newDate);
        $From_MonthNamenew = date('F', $date1);




        $data[] = ['MonthName' => $From_MonthNamenew, 'Cover' => $Cover];

    }

}

echo json_encode($data);

?>