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
	  
     $result=mysql_query($qry); 
$array=array();
while($row=mysql_fetch_assoc($result))
{
   $array[]= $row;
    
}
$mjson=json_encode($array);
echo $mjson;
?>