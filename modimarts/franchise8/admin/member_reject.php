<?
include('../config.php');


$id = $_GET['id'];

$sql = "update new_member set status=0 where id='".$id."'";


if(mysqli_query($con,$sql)){ ?>

    <script>
    alert("Reject Succesfully !");
    window.history.back();
    </script>
    
<? } else { ?>

    <script>
    alert("Reject Error !");
    window.history.back();
    </script>
    
    
<? } ?>