<?php include ('config.php');


$membership_type = $_POST['membership_type'];

$sql = mysqli_query($conn, "select * from PrimaryMembershipFee where P_Level_id='" . $membership_type . "'");
$sql_result = mysqli_fetch_assoc($sql);

echo $sql_result['RenewalMembership'];

?>