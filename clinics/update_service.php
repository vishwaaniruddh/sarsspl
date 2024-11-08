<?php
include 'config.php';

$id = $_POST['id'];
$name = $_POST['name'];
$amt = $_POST['amt'];
$updated_at = date("Y-m-d H:i:s");

$sql = mysqli_query($con,"update service_master set serv_name = '".$name."', serv_amt = '".$amt."', updated_at = '".$updated_at."' where id = '".$id."'  ");
if($sql)
{
    echo "
    <script>
        alert('Data Updated Successfully');
        window.location.href = 'view_services.php';
    </script>
    ";
}
else{
    echo "
    <script>
        alert('Sometthing Wrong!!!');
        window.location.href = 'view_services.php';
    </script>
    ";
}




?>