<?php
set_time_limit(0);
include('config.php');
$catid="1";

$offset=$_POST["offset"];
$allidsarr=array();

function category_tree($catid){
global $con1;
global $allidsarr;
$sql2 = "select * from main_cat where under ='".$catid."' order by name asc";

$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<?php

$idc=$row->id;

$chku=mysqli_query($con1,"select * from main_cat where id ='".$idc."'");
 $chkufr=mysqli_fetch_array($chku);


$chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;


$chkundrexs=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);

//echo $idc;
$allidsarr[]=$idc;
?>

 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 category_tree($row->id);
// echo '</li>';
 //echo $strr."</br>";
 //echo $catids2;
 
$i++;
 
endwhile;

}       
         

category_tree($catid);

//print_r($allidsarr);
$dat=["alcstids"=>$allidsarr];
//echo json_encode($dat);
?>