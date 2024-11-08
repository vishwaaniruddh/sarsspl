<?
include('../config.php');


$id = $_GET['id'];
$setid = $_GET['setid'];

$sql = "update new_member set status=2 where id='".$id."'";
if(mysqli_query($con,$sql))
{
    $sql2 = "update new_member set status=1 where id='".$setid."'";
   mysqli_query($con,$sql2)
?>
    <script>
    alert("Disapprove Succesfully !");
    window.location.href = 'pending_approve.php';
    </script>
    
<? } else { ?>

    <script>
    alert("Disapprove Error !");
    window.location.href = 'pending_approve.php';
    </script>
    
    
<? } ?>