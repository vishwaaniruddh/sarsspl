<?php
include ('config.php');
//echo $materialid;
$memid = $_POST['memid'];


$data = array();
$sql = "select MembershipDetails_Level,Spouse_GmailMArrid1 from Members where GenerateMember_Id='" . $memid . "'";

$result = mysqli_query($conn, $sql);
if ($result) {

    while ($row = mysqli_fetch_array($result)) {

        $data[] = ['Level' => $row[0], 'SpouseGmail' => $row[1]];
    }
}
echo json_encode($data);
?>