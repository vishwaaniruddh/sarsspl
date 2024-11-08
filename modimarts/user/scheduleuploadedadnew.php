<?php
$dur=$_POST['duratn'];
$dt1=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt1'])));
$dt2=date("Y-m-d",strtotime(str_replace("/","-",$_POST['dt2'])));

$days = (strtotime($dt2) - strtotime($dt1)) / (60 * 60 * 24);
//echo "kk".$days;
$days=$days+1;

$dt=$dt1." 00:00:00";
$dtr=$dt2." 24:00:00";

$total=100*$dur*10;

$totmt=$total*$days;


echo "Total amount is ".$totmt;

?>
<input type="amt" id="amt" name="amt" value="<?php echo $totmt;?>">
