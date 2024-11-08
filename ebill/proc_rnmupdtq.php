<?php 
include("access.php");
include("config.php");

//echo "hello";
$qid=$_POST['qid'];
$upreqamt=$_POST['upreqamt'];
$uprem=$_POST['uprem'];


//echo "update `quotation1_req` set req_amt='".$upreqamt."',remark='".$uprem."' where id='".$qid."'";
$errors="0";


//	mysqli_query($con,"BEGIN");		
mysqli_autocommit($con,FALSE);			
		
				
$inqry=mysqli_query($con,"update `quotation1_req` set req_amt='".$upreqamt."',remark='".$uprem."' where qid='".$qid."'");
				
			
	if(!$inqry)
{

$errors++;
}
		
		
			
	
if($errors==0)
{
//mysqli_query($con,"COMMIT");
mysqli_commit($con);
echo "Updated";

}
else
{
//mysqli_query($con,"ROLLBACK");
mysqli_rollback($con);
//echo mysqli_error();
echo "Error";

}		
			
			
			
			
			
			
			
			
			
			?>

