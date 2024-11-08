<?php include('config.php');

$mob=$_REQUEST['mob'];
$qr=mysqli_query($conn,"SELECT * FROM Leads_table where MobileNumber ='".$mob."'");
$nrws=mysqli_num_rows($qr);
if($nrws >0){
   echo 1; 
}else{
    echo 0;
}


?>