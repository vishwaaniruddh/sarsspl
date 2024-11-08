<?php
include('config.php');



$qr=mysqli_query($con,"update approve_amount_upload set invoice_no='".$_POST["invno"]."' where qid='".$_POST["qid"]."'");
echo mysqli_error();
if(!$qr)
{
    echo "0";
    
}else
{
    
    echo "1";
}
?>