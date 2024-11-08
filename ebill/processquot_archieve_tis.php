<?php 
include("access.php");
include("config.php");

//echo "hello";
$qid=$_POST['qid'];



$errors="0";


mysqli_query($con,"BEGIN");	

$dtt=date("Y-m-d h:i:s");

$upqr=mysqli_query($con,"update quotation1_tis set p_stat='100',Archived_date='$dtt'  where id='".$qid."'");
if(!$upqr)
{
$errors++;
}



if($errors==0)
{
mysqli_query($con,"COMMIT");
echo "Archieved";

}
else
{
mysqli_query($con,"ROLLBACK");
//echo mysqli_error();
echo "Error";

}		
			

?>

