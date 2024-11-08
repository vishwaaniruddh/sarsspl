<?php
set_time_limit(0);
include('config.php');
$limit="25";
$offset=$_POST["offset"];

//$qry="select id,under from main_cat order by name asc limit ".$offset.",".$limit;


  function category_tree($catid){
 //global $conn;
 
 
   $con1 =  mysqli_connect("localhost","sarmicro_1click","Click123*","sarmicro_1click");
     
   



$sql2 = "select * from main_cat where under ='".$catid."' order by name asc";
//echo $sql2;
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php

$idc=$row->id;

$chku=mysqli_query($con1,"select * from main_cat where id ='".$idc."'");
 $chkufr=mysqli_fetch_array($chku);


$chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;


$chkundrexs=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);


?>
<li class="collapse accordion-body in" style="display:none;" class="active" name="<?php echo $chkufr[2];?>"  > <a href='javascript:void(0);' onclick='shw("<?php echo $chkufr[0];?>");'><input type="radio" name="chk[]" id="<?php echo $chkufr[0];?>"><?php echo $row->name."--".$row->id; ?>
<?php
if($chkundrexsrws>0)
{
?>
<button type="button" onclick='shw("<?php echo $chkufr[0];?>");'>+</button>
<?php } ?>

</a>


 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 category_tree($row->id);
 echo '</li>';
 //echo $strr."</br>";
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}       
         


$qry="select id,under,name from main_cat where  under =0 order by name";

$result=mysql_query($qry);  
$nrd=mysql_num_rows($result);
if($nrd>0)
{

     while($row = mysql_fetch_row($result))
    
		{
?>

<div onclick="shw('<?php echo $row[0];?>')"><input type="radio" name="chk[]" id="<?php echo $row[0];?>"><?php echo $row[2]."--".$row[0];?></div>
<?php

category_tree($row[0]);

?>


		    <?php
		}
}
?>


