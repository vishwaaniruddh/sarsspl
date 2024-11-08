<?php session_start();

include('../config.php');

if(!isset($_SESSION["username"])) {
	header("Location:login_form.php");
}
else{ ?>
<script>
    window.location.href = 'http://www.allmart.world/franchise/admin/members.php';
</script>

<? }
?>
