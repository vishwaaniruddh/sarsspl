<?php 
include("access.php");
include("config.php");

//echo "hello";
$qid=$_POST['qid'];



$errors="0";


//mysqli_query($con,"BEGIN");	
mysqli_autocommit($con,FALSE);

$upqr=mysqli_query($con,"update quotation1 set p_stat='0' where id='".$qid."'");
if(!$upqr)
{
$errors++;
}



if($errors==0)
{
    mysqli_commit($con);
//mysqli_query($con,"COMMIT");
echo "Removed";

}
else
{
    mysqli_rollback($con);
//mysqli_query($con,"ROLLBACK");
//echo mysqli_error();
echo "Error";

}		
			

?>

