<?php
include("config.php");
$trackid=$_GET['trackid'];
$custid=$_GET['custid'];
$atmid=$_GET['atmid'];
$stype=$_GET['stype'];
//echo "select alert_date,problem,close_date from alert where atm_id='".$trackid."'";
$qry=mysqli_query($con,"select alert_date,problem,close_date from alert where atm_id='".$trackid."'");
if(mysqli_num_rows($qry)>0){
?>
<a href="javascript:void(0);" onclick="newwin('oldrnmhist.php?trackid=<?php echo $trackid; ?>&custid=<?php echo $custid; ?>&atmid=<?php echo $atmid; ?>&stype=<?php echo $stype; ?>','RNM History','800','800');">View Full History</a>
<table><tr><th>Call Date</th><th>Materials</th><th>Close Date</th></tr>
<?php
while($row=mysqli_fetch_array($qry))
{
?>
<tr><td><?php echo date("d/m/Y",strtotime($row[0])); ?></td><td><?php echo $row[1]; ?></td><td><?php if($row[2]!='0000-00-00 00:00:00'){ echo date("d/m/Y",strtotime($row[2])); }else{ echo "Open Call"; } ?></td></tr>
<?php
}
?>
</table>
<?php
}
else
{
echo "No History to Display";
}
?>