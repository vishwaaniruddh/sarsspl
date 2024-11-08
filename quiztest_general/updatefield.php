<?php 
include "config.php";



$sql= "SELECT * FROM findcat where final_ans='a' ";
$sqlresult= mysqli_query($con,$sql);

$result=mysqli_fetch_array($sqlresult);
// echo"<pre>";print_r($result);echo "</pre>";

if($result)
{
    $sqlquery="select a from findcat";
    $resultquery = mysqli_query($con,$sqlquery);
    echo $resultquery;
    
}

?>

