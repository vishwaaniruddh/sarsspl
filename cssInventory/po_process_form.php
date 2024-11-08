<?php
include 'config.php';

?>


<?php

$Description1=$_POST['Description'];
$Qty1=$_POST['Qty'];
$PerRate1=$_POST['PerRate'];
$GST1=$_POST['GST'];
$total1=$_POST['total'];
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');


$Description2=  explode(',', $Description1);
$Qty2=  explode(',', $Qty1);
$PerRate2=  explode(',', $PerRate1);
$GST2=  explode(',', $GST1);
$total2=  explode(',', $total1);


$query="insert into po_in(Description)values('".$Description1."')";
$rst=mysqli_query($conn,$query);
//echo $sql;
$last=mysqli_insert_id($conn);
//echo $last;

if($last){
for($i=0;$i<count($Description2);$i++)
                        { 
                        if($Description2[$i]!="" && $Qty2[$i]!="" && $PerRate2[$i]!="" && $GST2[$i]!="")
                        {
                     $qry1="INSERT INTO `po`(Description,Qty,Perrate,Gst,Total,entrydate,po_in_id) VALUES('".$Description2[$i]."','".$Qty2[$i]."','".$PerRate2[$i]."','".$GST2[$i]."','".$total2[$i]."','".$date."','".$last."')";
                     $result=mysqli_query($conn,$qry1);
     
    
}
}
}
if($result)
{
echo $last;
}
else
{
echo "0";
}
?>





