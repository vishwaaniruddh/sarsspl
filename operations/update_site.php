<?php

include("config.php");

//$cust=$_POST['cust'];

$id=$_POST['id'];

//$bank=$_POST['bank'];

$state=$_POST['state'];

$city=$_POST['city'];

$pin=$_POST['pin'];

$startdt=$_POST['startdt'];

//$atm=$_POST['atm'];

//$sdate=$_POST['sdate'];
mysqli_query($con,
$add=$_POST['add'];

$type=$_POST['type'];

$atmidmysqli_query($con,id'];
mysqli_query($con,
$dt=str_replace("/","-",$startdt);
mysqli_query($con,
	$start=date('Y-m-d', strtotime($dt));

	//echo "".$start."<br>";

if($type=='amc')

$sql="Update Amc set state='".$state."', area='".$city."',pincode='".$pin."',address='".$add."',atmid='".$atmid."' where amcid='".$id."'";

elseif($type=='new')
mysqli_query($con,
$sql="Update atm set state='".$state."', area='".$city."',pincode='".$pin."',address='".$add."',atm_id='".$atmid."',podate='".$start."' where track_id='".$id."'";

$update=mysqli_query($con,$sql);

if($type='amc')

{

$cnt=0;

//echo "update amcpurchaseorder set startdt='".$start."',expdt='".date('Y-m-d', strtotime("+12 months $start"))."' where amcsiteid='".$id."'";

$puro=mysqli_query($con,"update amcpurchaseorder set startdt='".$start."',expdt='".date('Y-m-d', strtotime("+12 months $start"))."' where amcsiteid='".$id."'");

$qry=mysqli_query($con,"select servicetype from Amc where amcid='".$id."'");

$row=mysqli_fetch_row($qry);

$qry2=mysqli_query($con,"select date,id from servicemonth where siteid='".$id."'");

while($row2=mysqli_fetch_array($qry2))

{

$cnt=$cnt+1;

$i=$row[0]*$cnt;

//echo "=i<br>".$start;

 $today = strtotime($start);

 $twoMonthsLater = strtotime("+".$i." months", $today);

$dt=date('d-m-Y', $twoMonthsLater)."<br>";

//echo "update servicemonth set date='".$dt."' where id='".$row2[1]."'";

$up=mysqli_query($con,"update servicemonth set date='".$dt."' where id='".$row2[1]."'");

}

}



if($update)

{

	?>

<script type="text/javascript">

alert("Site has been Edited successfully");

window.onunload = refreshParent;

        function refreshParent() {

            window.opener.location.reload();

        }

		window.close();

</script>

<?php	

}

else

echo "Error Updating City Head";

?>