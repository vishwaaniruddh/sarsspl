<?php
include("config.php");
$id=$_POST['id'];

if($id==3)
{
	  $qry="select id,name from main_cat WHERE UNDER=0 and name='Resale'";
}
else
{
    $qry="select id,name from main_cat WHERE UNDER=0 and name!='Resale'";
}
	  
     $result=mysqli_query($con1,$qry); 
$array=array();
while($row=mysqli_fetch_assoc($result))
{
   $array[]= $row;
    
}
$mjson=json_encode($array);
echo $mjson;
?>