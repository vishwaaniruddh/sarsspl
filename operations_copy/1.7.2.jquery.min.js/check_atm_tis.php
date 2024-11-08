<?php
include('config.php');

$atm=$_POST['atm'];
//echo $atm;

$qryc=mysqli_query($con,"select atm from quotation1_tis where atm='".$atm."'");
$nr=mysqli_num_rows($qryc);
if($nr>0)
{
echo "1";

}else
{
echo "0";
}



?>