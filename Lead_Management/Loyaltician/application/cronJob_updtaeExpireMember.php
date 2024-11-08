<?php session_start();
include 'config.php';

$Dat = date('Y-m-d');
mysqli_query($conn, "insert into MemberHistory (memberId,entrydate)values('420','$Dat')");

?>