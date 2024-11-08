<?php 
include("access.php");
include("config.php");

//echo "hello";
$qid=$_POST['qid'];



$errors="0";


mysqli_query($con,"BEGIN");	

$upqr=mysqli_query($con,"update quotation1_tis set p_stat='0' where id='".$qid."'");
if(!$upqr)
{
$errors++;
}



if($errors==0)
{
mysqli_query($con,"COMMIT");
echo "Removed";

}
else
{
mysqli_query($con,"ROLLBACK");
//echo mysqli_error();
echo "Error";

}		
			

?>

