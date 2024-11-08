<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry your session has Expired, Please login Again');window.close();</script>";
}
else{
include("config.php");
$trackid=$_GET['trackid'];
$custid=$_GET['custid'];
$atmid=$_GET['atmid'];
$stype=$_GET['stype'];
$qry=mysqli_query($con,"select alert_date,problem,close_date,quotdetid from alert where atm_id='".$trackid."'");
if(mysqli_num_rows($qry)>0){
$cnt=0;

if($stype=='sites')
$atm2="select atm_id1,csslocalbranch from ".$custid."_sites where trackerid='".$trackid."'";
elseif($stype=='rnmsites')
$atm2="select atm_id1,csslocalbranch from rnmsites where trackerid='".$trackid."'";
//echo $atm2;
$site=mysqli_query($con,$atm2);
$sitero=mysqli_fetch_row($site);
?>
ATM ID : <?php echo $sitero[0]; ?><br>CSS local Branch: <?php echo $sitero[1]; ?>
<table border="1"><tr><th>Sr No</th><th>Call Date</th><th>Materials</th><th>Fund Transfer Date</th><th>Close Date</th></tr>
<?php
while($row=mysqli_fetch_array($qry))
{
$cnt=$cnt+1;
$quot=mysqli_query($con,"select pdate from rnmfundtransfers where reqid='".$row[3]."'");
$qtdt=mysqli_fetch_row($quot);
?>
<tr><td><?php echo $cnt; ?></td><td><?php echo date("d/m/Y",strtotime($row[0])); ?></td><td><?php echo $row[1]; ?></td>
<td><?php if(mysqli_num_rows($quot)>0){ echo date("d/m/Y",strtotime($qtdt[1])); } ?></td>
<td><?php if($row[2]!='0000-00-00 00:00:00'){ echo date("d/m/Y",strtotime($row[2])); }else{ echo "Open Call"; } ?></td></tr>
<?php
}
?>
<tr><th colspan="4" align="center">OLD History</th></tr>
<?php
$olddata=mysqli_query($con,"select now,problem,fundtransdate,workcompdate,reqdate from rnmolddata where atm_id1='".$atmid."'");
while($old=mysqli_fetch_array($olddata))
{
$cnt=$cnt+1;
?>
<tr><td><?php echo $cnt; ?></td><td><?php echo $old[4]; //echo date("d/m/Y",strtotime($old[4])); ?></td><td><?php echo $old[0].":".$old[1]; ?></td>
<td><?php echo $old[2]; ?></td>
<td><?php echo $old[3]; ?></td></tr>
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

}
?>