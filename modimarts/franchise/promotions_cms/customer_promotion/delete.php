<?php
session_start();
if (!isset($_SESSION['mem_id']) && !isset($_SESSION['username'])) {
    ?>

    <script>
        window.location.href='https://allmart.world/franchise/get_members.php';
    </script>

<?
}
include '../../config.php';

$id=$_GET['id'] ;
// var_dump($id);
$delete_sql = mysqli_query($con,"DELETE FROM `customer_promotion` WHERE customer_id='".$id."'");

if($delete_sql)
{
    ?>
    <script>
    alert("Delete Successfully");
   window.location.href='https://allmart.world/franchise/promotions_cms/customer_promotion/';
</script>
<?php
}
else
{
      ?>
    <script>
      alert("Not Delete");
   window.location.href='https://allmart.world/franchise/promotions_cms/customer_promotion/';
</script>
<?php
}
?>



