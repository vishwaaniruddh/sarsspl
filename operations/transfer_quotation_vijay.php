<?php
include("config.php");
include("access.php");



$qid=$_POST['qid'];

$error=0;


$dt=date('Y-m-d H:i:s');

$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);
			
	


mysqli_query($con,"BEGIN");
		
			
$qry=mysqli_query($con,"insert into local_transfer_details( `qid`, `reqby`, `entrydt`) values('".$qid."','".$srno[0]."','".$dt."')");
if(!$qry)
{
$error++;
}
$qry1=mysqli_query($con,"update quotation1 set status='app',p_stat='1',local_status='1' where id='".$qid."' ");
if(!$qry1)
{
$error++;
}


if($error==0)
{
mysqli_query($con,"COMMIT");
echo "Transferred";
}
else
{
mysqli_query($con,"ROLLBACK");
//echo "insert into loacal_transfer_details( `qid`, `reqby`, `entrydt`) values('".$qid."','".$srno[0]."','".$dt."'";

echo "Error";

}


?>