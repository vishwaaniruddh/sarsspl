<?php
include("config.php");
$qr="";

      $qr="update  top_right_slider set stats='3',lastupdt='".date("Y-m-d H:is")."' where id='".$_POST['updid']."'";
  

$exwcq=mysqli_query($con1,$qr);
if($exwcq)
{
    echo 1;
}
else
{
    echo 2;
}

?>