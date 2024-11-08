<?php
include("config.php");
$what=$_GET['what'];
$val=$_GET['val'];
$type=$_GET['calltype'];
$cust=$_GET['cust'];
$atmid='';
$qry2='';
//echo $what;

/*$qry2=mysqli_query($con,$qr);
while($row2=mysqli_fetch_array($qry2))
{
	?>
<a href="service.php?id=<?php echo $row2[2];  ?>&type=site"><?php	echo $row2[0];  ?></a></br>
<?php	echo $row2[1];  ?><br><br>
    <?php
}*/
$atmid="Select bank,atmsite_address,id,atm_id1 from ".$cust."_sites where 1 ";
$qry2="Select bank,atmsite_address,id,atm_id1 from rnmsites where 1";
if($what=='atmid')
{
$atmid.=" and atm_id1 LIKE '%".$val."%'";
$qry2.=" and atm_id1 LIKE '%".$val."%' and cust_id='".$cust."'";
}
elseif($what=='add')
{
$atmid.=" and atmsite_address LIKE '%".$val."%'";
$qry2.=" and atmsite_address LIKE '%".$val."%' and cust_id='".$cust."'";
}
//echo $atmid;
//echo $qry2;	

$qry=mysqli_query($con,$atmid);
if(mysqli_num_rows($qry)==0)
echo "No result found in main site<br>";
while($row=mysqli_fetch_array($qry))
{
	?>
<a href="service.php?id=<?php echo $row[2];  ?>&type=site&cid=<?php echo $cust; ?>"><?php echo $row[0]."-".$row[3]."(".$cust." Site)";  ?></a></br>
<?php	echo $row[1];  ?><br><br>
    <?php
}
//echo $qry2;
$qr=mysqli_query($con,$qry2);
while($row2=mysqli_fetch_array($qr))
{
	?>
<a href="service.php?id=<?php echo $row2[2];  ?>&type=rnm&cid=<?php echo $cust; ?>"><?php echo $row2[0]."-".$row2[3]."(RNM Site)";  ?></a></br>
<?php	echo $row2[1];  ?><br><br>
    <?php
}
?>