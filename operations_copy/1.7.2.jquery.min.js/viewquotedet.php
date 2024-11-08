<?php
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, Your Session Has Expired');window.close();</script>";
}
else
{
include("config.php");
$quotid=$_GET['quotid'];
//echo "select * from quotapproval where quotid='".$quotid."' order by appid DESC";
$query=mysqli_query($con,"select * from quotapproval where quotid='".$quotid."' order by appid ASC");
$cnt=0;
$srn=mysqli_query($con,"select designation,serviceauth from login where username='".$_SESSION['user']."'");
			$sr=mysqli_fetch_row($srn);
?>
<table border="1"><tr><th>Sr No</th><th>Quot BY</th><th>Date/time</th><th>Quotation</th><th>Status</th></tr>
<?php
while($row=mysqli_fetch_array($query))
{
$cnt=$cnt+1;
?>
<tr><td valign="top"><?php echo $cnt; ?></td><td valign="top"><?php  echo $row[2]; ?></td><td><?php  echo date('d/m/Y h:i:s a',strtotime($row[3])); ?></td><td valign="top">&nbsp;<?php 
//echo $row[4];
$rem=explode("***###",$row[4]);
//echo $rem[1];
$sr2=mysqli_query($con,"select designation,serviceauth from login where username='".$row[2]."'");
$sr2ro=mysqli_fetch_row($sr2);
if($sr2ro[0]<$sr[0])
{
echo $rem[0];
}
else
{
if(count($rem)==1)
{
echo $rem[0];
}
else
{
//echo $sr2ro[1]." ".$_SESSION['serviceauth']." ".$sr2ro[0]." ".$sr[0];
if($sr2ro[0]>=$sr[0] && $sr2ro[1]>=$_SESSION['serviceauth']){
?>
<table border="1"><tr><th>SR NO</th><th>Component</th><th>Work</th><th>Rate</th><th>Quantity</th></tr>
<?php


for($j=1;$j<count($rem);$j++)
{

$rem2=explode("\n",$rem[$j]);
//echo count($rem2);
?>
<tr><td><?php echo $j; ?></td>
<?php
$tot=0;
for($i=0;$i<(count($rem2));$i++)
{
//echo $rem2[$i];
$rem3=array();

$rem3=explode("-",$rem2[$i]);
//echo $i." ".count($rem2);
if($i==(count($rem2)-1))
{

$tot=$rem3[1];
}
else{
?>
<td><?php echo $rem3[1]; ?></td>
<?php
}
//echo $rem3[1]."****";
}//end  i  ka loop
?>
</tr>

<?php
}//end j ka loop
?><tr>
<th colspan="3">Total Amount: </th><td><?php echo $tot; ?></td></tr>
</table>
<?php
}//end of rem
}
}
?>

</td><td valign="top"><?php if($row[5]==0){ echo "Rejected"; }elseif($row[5]==20){ echo "Edited"; }else{ echo "Approved"; } ?></td></tr>
<?php
}
?></table>
<?php
} ?>