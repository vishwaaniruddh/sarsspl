<?php session_start();

include('../config.php');

if(isset($_SESSION["username"]) && isset($_SESSION['rollid'])) { 
    if(isset($_SESSION["username"]) &&  $_SESSION['UserType']=="DTP")
    {
    ?>
<script>
    window.location.href = 'https://modimarts.com/franchise7/promotions_cms/index1.php';
</script>
    

<?
}else
{
    ?>
<script>
    window.location.href = 'members.php';
</script>
<?

 }
}
else{ ?>
<script>
    window.location.href = 'login_form.php';
</script>

<? }
?>
