<?php session_start();

include('../config.php');

if(!isset($_SESSION["username"])) {
	header("Location:login_form.php");
}
else{ ?>
<script>
    window.location.href = 'http://www.modimart.world/admin/members.php';
</script>

<? }
?>
