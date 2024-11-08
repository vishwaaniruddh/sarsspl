<?php
include ('config.php');



$contents = '';
$contents .= "Sr. No. \t Title \t FirstName \t LastName \t MobileCode \t MobileNumber \t EmailId \t Country \t State \t City \t PinCode \t pincodeOfArea \t Nationality \t Company \t Designation \t LeadSource \t Status \t DelegationStatus \t Creation \t Assigned \t CloseReason \t Close \t leadEntryef \t Hotel_Name \t";
// echo $contents;
$cnt = 1;

$Ab_Filtter = $_POST['Ab_Filtterid'];
$qry = $_POST['qr'];


//echo $qry;

if ($Ab_Filtter == "All") {

  $userQuery1 = mysqli_query($conn, "select * from HotelUsers");
  while ($fecthuser = mysqli_fetch_array($userQuery1)) {

    $sql = "select * from Leads_table where leadEntryef='" . $fecthuser['id'] . "' ";
    $sql .= "$qry";

    $q = mysqli_query($conn, $sql);
    while ($_row = mysqli_fetch_array($q)) {

      $LeadSourceQuery1 = mysqli_query($conn, "select Name from Lead_Sources where SourceId='" . $_row['LeadSource'] . "' ");
      $fecthLeadSource = mysqli_fetch_array($LeadSourceQuery1);

      $sql5 = "SELECT state FROM `state` where state_id='" . $_row['State'] . "' ";
      $runsql5 = mysqli_query($conn, $sql5);
      $sql5fetch = mysqli_fetch_array($runsql5);

      $contents .= "\n" . $cnt . "\t";
      $contents .= $_row['Title'] . "\t";
      $contents .= $_row['FirstName'] . "\t";
      $contents .= $_row['LastName'] . "\t";
      $contents .= $_row['MobileCode'] . "\t";
      $contents .= $_row['MobileNumber'] . "\t";
      $contents .= $_row['EmailId'] . "\t";
      $contents .= $_row['Country'] . "\t";
      $contents .= $sql5fetch['state'] . "\t";
      $contents .= $_row['City'] . "\t";
      $contents .= $_row['PinCode'] . "\t";
      $contents .= $_row['pincodeOfArea'] . "\t";
      $contents .= $_row['Nationality'] . "\t";
      $contents .= $_row['Company'] . "\t";
      $contents .= $_row['Designation'] . "\t";
      $contents .= $fecthLeadSource['Name'] . "\t";
      $contents .= $_row['Status'] . "\t";
      $contents .= $_row['DelegationStatus'] . "\t";
      $contents .= $_row['Creation'] . "\t";
      $contents .= $_row['Assigned'] . "\t";
      $contents .= $_row['CloseReason'] . "\t";
      $contents .= $_row['Close'] . "\t";
      $contents .= $fecthuser['empname'] . "\t";
      $contents .= $_row['Hotel_Name'] . "\t";

      $cnt++;
    }

  }
} else {
  $userQuery1 = mysqli_query($conn, "select * from HotelUsers where id='" . $Ab_Filtter . "'");
  $fecthuser = mysqli_fetch_array($userQuery1);

  $q = mysqli_query($conn, $qry);
  while ($_row = mysqli_fetch_array($q)) {

    $LeadSourceQuery1 = mysqli_query($conn, "select Name from Lead_Sources where SourceId='" . $_row['LeadSource'] . "' ");
    $fecthLeadSource = mysqli_fetch_array($LeadSourceQuery1);

    $sql5 = "SELECT state FROM `state` where state_id='" . $_row['State'] . "' ";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);


    $contents .= "\n" . $cnt . "\t";
    $contents .= $_row['Title'] . "\t";
    $contents .= $_row['FirstName'] . "\t";
    $contents .= $_row['LastName'] . "\t";
    $contents .= $_row['MobileCode'] . "\t";
    $contents .= $_row['MobileNumber'] . "\t";
    $contents .= $_row['EmailId'] . "\t";
    $contents .= $_row['Country'] . "\t";
    $contents .= $sql5fetch['state'] . "\t";
    $contents .= $_row['City'] . "\t";
    $contents .= $_row['PinCode'] . "\t";
    $contents .= $_row['pincodeOfArea'] . "\t";
    $contents .= $_row['Nationality'] . "\t";
    $contents .= $_row['Company'] . "\t";
    $contents .= $_row['Designation'] . "\t";
    $contents .= $fecthLeadSource['Name'] . "\t";
    $contents .= $_row['Status'] . "\t";
    $contents .= $_row['DelegationStatus'] . "\t";
    $contents .= $_row['Creation'] . "\t";
    $contents .= $_row['Assigned'] . "\t";
    $contents .= $_row['CloseReason'] . "\t";
    $contents .= $_row['Close'] . "\t";
    $contents .= $fecthuser['empname'] . "\t";
    $contents .= $_row['Hotel_Name'] . "\t";


    $cnt++;
  }
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