<?php
if (!isset($_SESSION)) session_start();
include("config.php");


$qr=mysqli_query($con,"update quiz_requests set status='".$_POST["status"]."' where id='".$_POST["id"]."'");

if($qr)
{
 echo 1;   
    
}else
{
    echo 0;
}

mysqli_close($con);

?>
