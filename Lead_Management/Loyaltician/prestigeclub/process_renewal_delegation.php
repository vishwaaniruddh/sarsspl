<?php include ('config.php');


$member_id = $_POST['member_id'];
$renewal_del = $_POST['renewal_del'];
$date = date("Y-m-d");
$sql = "insert into renewalDelegation(member_id,sales_id,created_at) values('" . $member_id . "','" . $renewal_del . "','" . $date . "')";

// echo $sql;

if (mysqli_query($conn, $sql)) {

    mysqli_query($conn, "update Members set is_delegate='2' where Static_LeadID='" . $member_id . "'"); ?>

    <script>

        alert('Delegate Succesfully ');

        window.location.href = "renewals.php"

    </script>

<?php } else { ?>

    <script>

        alert('delegate Error !');

        window.location.href = "renewals.php"

    </script>


<?php } ?>