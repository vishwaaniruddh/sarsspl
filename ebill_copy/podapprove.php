<?php 

$pid=$_POST['pid'];
//echo $pid;
include('config.php');

if($_POST['pid']!="")
{ 
    $sqlq=mysqli_query($con,"update ebill_package set status='1' where pid='".$_POST['pid']."'");
    
    if($sqlq)
    {
    
    echo "approved";
    }
    else
    {
    echo "error";
    
    }

}
else
{

echo "empty pid number";
}



?>