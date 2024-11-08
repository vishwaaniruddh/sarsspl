<?php
session_start();
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
$admnid=$_GET['admnid'];
if (!isset($_SESSION['username']) && $_SESSION['userid']=='1') {
    ?>

    <script>
        window.location.href='https://modimart.world/franchise4/get_members.php';
    </script>

<?
}
include '../config.php';

$deletequery=mysqli_query($con3,"DELETE FROM `Users` WHERE UserId='".$admnid."'");

if($deletequery)
{
echo "Delete Successfully";

?>
        <script>
            Swal.fire(
          'Success',
          'Delete Successfully',
          'success'
        ).then(function() {
            window.location = "https://www.modimart.world/franchise4/admin/Users.php"
        });
        </script>
        <?php
}
else
{
 echo "Recoreds Not Deleted";
 ?>
<script>
Swal.fire(
  'Failed',
  'Recoreds Not Deleted',
  'error'
).then(function() {
    window.location = "https://www.modimart.world/franchise4/admin/Users.php";
});
</script>
<?php
}

?>
