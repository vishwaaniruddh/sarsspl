<?php 
include("access.php");
include("config.php");

$qid=$_POST['qid'];


$qry=mysqli_query($con,"update quotation1 set p_stat='1' where id='".$qid."'");
if(!$qry)
{
echo "Error";

}
else
{
echo "approved";
}


?>