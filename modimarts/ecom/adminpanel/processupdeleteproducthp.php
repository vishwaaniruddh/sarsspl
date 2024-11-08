<?php
include("config.php");
$qr="";
 

    $qr="delete from product_sideslide  where id='".$_POST['updid']."'";
  

$exwcq=mysql_query($qr);
if($exwcq)
{
    echo 1;
}
else
{
    echo 2;
}

?>