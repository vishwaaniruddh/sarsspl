<?php
include("access.php");
ini_set( "display_errors", 0);
?>
<link href="menu.css" rel="stylesheet" type="text/css" /><center>
<?php
include("menubar.php");
?>
</center>
<?php
include("config.php");
if(isset($_POST['cmd']))
{
$stat=0;
function checkdateformat($dt)
{
$date='';
$haystack = $dt;
$needle = '/';
$needle2 = '-';
$needle3='.';
//check if date is d/m/y format
if (strpos($haystack,$needle) !== false) {
    $date=str_replace("/","-",$heystack);
	$date=date('Y-m-d',strtotime($date));
}
elseif (strpos($haystack,$needle2) !== false) {
    $date=date('Y-m-d',strtotime($dt));
	
}
elseif (strpos($haystack,$needle) !== false) {
    $date=str_replace(".","-",$heystack);
	$date=date('Y-m-d',strtotime($date));
}
else
$date=date('Y-m-d',strtotime($dt));

return $date;
}
for($i=0;$i<count($_POST['err']);$i++)
{
$frmdt=checkdateformat($_POST['fdt'][$i]);
$todt=checkdateformat($_POST['tdt'][$i]);
$billdt=checkdateformat($_POST['bdt'][$i]);
$duedt=checkdateformat($_POST['ddt'][$i]);
$pdt=checkdateformat($_POST['pdt'][$i]);

 $err=str_replace("'","\'",$_POST['err'][$i]);
$sql="INSERT INTO `uploadedebillerr` (`id`, `atmid`, `consumerno`, `frmdt`, `todt`, `billdt`, `duedt`, `paiddt`, `openreading`, `closereading`, `units`, `paidamt`, `extracharge`, `totalamt`, `error`,`cid`) VALUES (NULL, '".$_POST['atm'][$i]."', '".$_POST['consumer'][$i]."', '".$frmdt."', '".$todt."', '".$billdt."','".$duedt."', '".$paiddt."', '".$_POST['openr'][$i]."', '".$_POST['closer'][$i]."', '".$_POST['unit'][$i]."', '".$_POST['paidamt'][$i]."', '".$_POST['xtra'][$i]."', '".$_POST['tamt'][$i]."', '".$err."','".$_POST['cid'][$i]."')";
//echo $sql."<br>";
$query=mysqli_query($con,$sql);
if(!$query)
{
$stat='1';
echo "Failed ".mysqli_error();
}
}
//echo "done".$stat;
if($stat==0)
{
?>
<script type="text/javascript">
alert("Successfully Inserted");
window.location='importebill.php';
</script>
<?php
}
else
echo "Failed to insert all the rows";
}
?>