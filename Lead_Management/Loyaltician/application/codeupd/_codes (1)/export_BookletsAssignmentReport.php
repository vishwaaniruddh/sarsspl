<?php
include ('config.php');
$sqlme = $_POST['qr'];
$sqlme = $sqlme;//.' limit 400';

$table = mysqli_query($conn, $sqlme);
//echo mysql_num_rows($table);

$contents = "Sr. No. \t DSR Date \t Level \t Booklet Number \t Card Number \t Member Name \t ";

$cnt = 0;

while ($_row = mysqli_fetch_array($table)) {
  $cnt++;
  $entdt = $_row['entryDate'];
  $entdt_show = date('d-m-Y', strtotime($entdt));


  $levelOrchid = mysqli_query($conn, "SELECT level_name FROM `Level` where Leval_id='" . $_row['MembershipDetails_Level'] . "' ");
  $levelOrchidFetch = mysqli_fetch_array($levelOrchid);
  $Lev = $levelOrchidFetch['level_name'];



  $contents .= "\n" . $cnt . "\t";
  $contents .= $entdt_show . "\t";
  $contents .= $Lev . "\t";
  $contents .= $_row['booklet_Series'] . "\t";
  $contents .= $_row['GenerateMember_Id'] . "\t";
  $contents .= $_row['Primary_nameOnTheCard'] . "\t";

}

$contents = strip_tags($contents);

// remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
//  header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
header("Content-Disposition: attachment; filename=BAR.xls");
header("Content-Type: application/vnd.ms-excel");
print $contents;

?>