<?php
include('config.php');
$cid=$_GET['cid'];

$sql_statement = mysql_query("SELECT * FROM Resale_img where product_id='".$_GET['adid']."'");

?>


<div id="content-outer">
<!-- start content -->
<div id="content">
<center>
    <table>
        
  <?php  while($fr=mysql_fetch_array($sql_statement))
  {
  
  
  ?>
  <tr>
  <td>
<img style="height:200px; width:200px;object-fit:contain"  src="../<?php echo $fr['img'];?>" >
</td>
</tr>
<?php } ?>

</table>
</center>

</div>
</div>