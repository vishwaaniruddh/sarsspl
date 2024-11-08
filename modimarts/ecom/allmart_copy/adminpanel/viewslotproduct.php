<?php
include('config.php');

$slot=$_GET['slot'];
$bookingid=$_GET['adid'];
//$merchantid=$_GET['userid'];
echo "hii"._GET['adid'];

$sql_statement = mysql_query("SELECT * FROM ads_upload where id='".$_GET['adid']."'");
$fr=mysql_fetch_array($sql_statement);

$pth=$fr['videopath'];
?>


<div id="content-outer">
<!-- start content -->
<div id="content">
<center>
    <table>
        <tr>
            <th>srno</th>
            <th>Product images</th>
            
        </tr>
  <?php 
  $i=1;
  while($fr=mysql_fetch_array($sql_statement))
  {
  
  $sql_stat = mysql_query("SELECT code,photo FROM products where code='".$fr['pid']."'");
  $row=mysql_fetch_array($sql_stat)
  ?>
  <tr>
      <td><?php echo $i++;?></td>
      <td>
    <img style="height:100px; width:100px;object-fit:contain" src="../<?php echo $row['photo'];?>" >
    </td>
</tr>
<?php } ?>

</table>
</center>

</div>
</div>