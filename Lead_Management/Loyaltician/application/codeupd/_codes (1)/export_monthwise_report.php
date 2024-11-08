<?php
include ('config.php');
$sqlme = $_POST['qr'];
$sqlme = $sqlme;//.' limit 400';

$table = mysqli_query($conn, $sqlme);
//echo mysql_num_rows($table);

$contents = '';
$contents .= "Sr. No. \t MEMBER_ID \t FIRSTNAME \t LASTNAME \t Level \t ExpiryDate \t MOBILENUMBER \t DATEOFBIRTH \t ANNIVERSARY \t";
// echo $contents;
$cnt = 0;

while ($_row = mysqli_fetch_array($table)) {
  $cnt++;


  $levelOrchid = mysqli_query($conn, "SELECT level_name FROM `Level` where Leval_id='" . $_row[3] . "' ");
  $levelOrchidFetch = mysqli_fetch_array($levelOrchid);
  $lev = $levelOrchidFetch['level_name'];

  $expiryDt = date('M, Y', strtotime($_row['ExpiryDate']));

  $birth = $_row[6];
  $birthDt = date("d-M", strtotime($birth));

  $Anniver = $_row[7];
  $AnniverDt = date("d-M", strtotime($Anniver));

  $contents .= "\n" . $cnt . "\t";
  $contents .= $_row[0] . "\t";
  $contents .= $_row[1] . "\t";
  $contents .= $_row[2] . "\t";
  $contents .= $lev . "\t";
  $contents .= $expiryDt . "\t";
  $contents .= $_row[5] . "\t";
  $contents .= $birthDt . "\t";
  $contents .= $AnniverDt . "\t";


}

$contents = strip_tags($contents);

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
header("Content-Disposition: attachment; filename=mis.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;

?>