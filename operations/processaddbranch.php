<?php
include("config.php");


 $city=$_POST['brcity'];
 $state=$_POST['state'];
 $badd=str_replace("'","\'",$_POST['bradd']);
 $bpin=$_POST['brpin'];
 $logid=$_POST['logid'];
 $id=$_POST['id'];
$id2=0;
$cnt=0;
$brid=0;
$qry='';
$sttt=0;
$brqry=mysqli_query($con,"select * from cssbranch where location='".$_POST['location']."'");
if(mysqli_num_rows($brqry)==0)
{
$qry=mysqli_query($con,"INSERT INTO  `cssbranch` (`id`, `location`, `badd`, `city`, `pin`,`region`) VALUES (NULL, '".$_POST['location']."', '".$badd."', '".$city."', '".$bpin."','".$state."')");
$brid=mysqli_insert_id();
if($qry)
$sttt=1;
else
mysqli_error();
}
else
{
$brro=mysqli_fetch_row($brqry);

$brid=$brro[0];
//echo "update cssbranch set badd='".$badd."',city='".$city."',pin='".$bpin."', region='".$state."' where id='".$brid."'";
$qry=mysqli_query($con,"update cssbranch set badd='".$badd."',city='".$city."',pin='".$bpin."', region='".$state."' where id='".$brid[0]."'");
if($qry)
$sttt=1;
else
mysqli_error();
}
if($sttt=='1')
{
//echo "Update login set branch=branch',".$state."' where srno='".$logid."'";
//echo "select branch from login where srno='".$logid."'";
$sr=mysqli_query($con,"select branch from login where srno='".$logid."'");
$srro=mysqli_fetch_row($sr);
$newbr=$srro[0].",".$brid;
//echo "Update login set branch='".$newbr."' where srno='".$logid."'";
$qry2=mysqli_query($con,"Update login set branch='".$newbr."' where srno='".$logid."'");
if(!$qry2)
echo "Some Error Occurred. Please go back and fill the form again";
else
{
//echo "update branch_head set branchid=branch.',".$brid."' where head_id='".$id."'";
//echo "update branch_head set branchid='".$newbr."' where head_id='".$id."'";
$qry3=mysqli_query($con,"update branch_head set branchid='".$newbr."' where head_id='".$id."'");
if(!$qry3)
echo "<br> qer3=".mysqli_error();
else
{
?>
<script type="text/javascript">
if (confirm("Do you want to assign more branch to this person"))
	{
		document.location="addbranch.php?id=<?php echo $id; ?>&hid=<?php echo $logid;  ?>";
	}
	else
	document.location="view_cityhead.php";
</script>
<?php
}}
}
else
echo "Some Error Occurred. Please go back and fill the form again";

?>