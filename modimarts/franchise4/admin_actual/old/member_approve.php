<?
include('../config.php');

$id = $_GET['id'];

$sql = "update new_member set status=1 where id='".$id."'";



if(mysqli_query($con,$sql)){ ?>

    <script>
    alert("Approved Succesfully !");
    window.history.back();
    </script>
    
<? } else { ?>

    <script>
    alert("Approved Error !");
    window.history.back();
    </script>
    
    
<? } ?>