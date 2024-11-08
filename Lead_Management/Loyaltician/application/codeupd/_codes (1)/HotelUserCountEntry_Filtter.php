<?php
include ('config.php');

$Ab_Filtter = $_POST['Ab_Filtter'];
$FromDat = $_POST['FromDt'];
$Todat = $_POST['Todt'];
$FromDt = date('Y-m-d', strtotime($FromDat));
$Todt = date('Y-m-d', strtotime($Todat));
$FromDt1 = date('d-m-Y', strtotime($FromDat));
$Todt1 = date('d-m-Y', strtotime($Todat));
$data = array();



if ($Ab_Filtter == "All") {
  $exportQuery = " and Creation BETWEEN '" . $FromDt . "' AND '" . $Todt . "'";

  $userQuery1 = mysqli_query($conn, "select * from HotelUsers");
  while ($fecthuser = mysqli_fetch_array($userQuery1)) {
    $qq = "select * from Leads_table where leadEntryef='" . $fecthuser['id'] . "' and Creation BETWEEN '" . $FromDt . "' AND '" . $Todt . "'  ";
    $q = mysqli_query($conn, $qq);
    while ($f = mysqli_fetch_array($q)) {

      $LeadSourceQuery1 = mysqli_query($conn, "select Name from Lead_Sources where SourceId='" . $f['LeadSource'] . "' ");
      $fecthLeadSource = mysqli_fetch_array($LeadSourceQuery1);

      $sql5 = "SELECT state FROM `state` where state_id='" . $f['State'] . "' ";
      $runsql5 = mysqli_query($conn, $sql5);
      $sql5fetch = mysqli_fetch_array($runsql5);

      $data[] = [
        'Title' => $f['Title'],
        'FirstName' => $f['FirstName'],
        'LastName' => $f['LastName'],
        'MobileCode' => $f['MobileCode'],
        'MobileNumber' => $f['MobileNumber'],
        'EmailId' => $f['EmailId'],
        'Country' => $f['Country'],
        'State' => $sql5fetch['state'],
        'City' => $f['City'],
        'PinCode' => $f['PinCode'],
        'pincodeOfArea' => $f['pincodeOfArea'],
        'Nationality' => $f['Nationality'],
        'Company' => $f['Company'],
        'Designation' => $f['Designation'],
        'LeadSource' => $fecthLeadSource['Name'],
        'Status' => $f['Status'],
        'DelegationStatus' => $f['DelegationStatus'],
        'Creation' => $f['Creation'],
        'Assigned' => $f['Assigned'],
        'CloseReason' => $f['CloseReason'],
        'Close' => $f['Close'],
        'leadEntryef' => $f['leadEntryef'],
        'Hotel_Name' => $f['Hotel_Name'],
        'Qry' => $exportQuery,
        'Ab_Filtter' => $Ab_Filtter,
        'cnt' => $c,

        'empname' => $fecthuser['empname']
      ];


    }

  }
} else {
  $userQuery1 = mysqli_query($conn, "select * from HotelUsers where id='" . $Ab_Filtter . "'");
  $fecthuser = mysqli_fetch_array($userQuery1);


  $qq3 = "select count(*)  as cnt from Leads_table where leadEntryef='" . $Ab_Filtter . "' and Creation BETWEEN '" . $FromDt . "' AND '" . $Todt . "'  ";
  $q3 = mysqli_query($conn, $qq3);
  $f3 = mysqli_fetch_array($q3);


  $qq = "select * from Leads_table where leadEntryef='" . $Ab_Filtter . "' and Creation BETWEEN '" . $FromDt . "' AND '" . $Todt . "'  ";
  $q = mysqli_query($conn, $qq);
  while ($f = mysqli_fetch_array($q)) {

    $LeadSourceQuery1 = mysqli_query($conn, "select Name from Lead_Sources where SourceId='" . $f['LeadSource'] . "' ");
    $fecthLeadSource = mysqli_fetch_array($LeadSourceQuery1);

    $sql5 = "SELECT state FROM `state` where state_id='" . $f['State'] . "' ";
    $runsql5 = mysqli_query($conn, $sql5);
    $sql5fetch = mysqli_fetch_array($runsql5);


    $data[] = [
      'Title' => $f['Title'],
      'FirstName' => $f['FirstName'],
      'LastName' => $f['LastName'],
      'MobileCode' => $f['MobileCode'],
      'MobileNumber' => $f['MobileNumber'],
      'EmailId' => $f['EmailId'],
      'Country' => $f['Country'],
      'State' => $sql5fetch['state'],
      'City' => $f['City'],
      'PinCode' => $f['PinCode'],
      'pincodeOfArea' => $f['pincodeOfArea'],
      'Nationality' => $f['Nationality'],
      'Company' => $f['Company'],
      'Designation' => $f['Designation'],
      'LeadSource' => $fecthLeadSource['Name'],
      'Status' => $f['Status'],
      'DelegationStatus' => $f['DelegationStatus'],
      'Creation' => $f['Creation'],
      'Assigned' => $f['Assigned'],
      'CloseReason' => $f['CloseReason'],
      'Close' => $f['Close'],
      'leadEntryef' => $f['leadEntryef'],
      'Hotel_Name' => $f['Hotel_Name'],
      'Qry' => $qq,
      'Ab_Filtter' => $Ab_Filtter,
      'cnt' => $f3['cnt'],

      'empname' => $fecthuser['empname']
    ];


  }
}

echo json_encode($data);




?>