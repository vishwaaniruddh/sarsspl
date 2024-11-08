<?php 
include('config.php');
//error_reporting(0);

$village_query="SELECT * FROM village"; 
$village_con=mysqli_query($conn,$village_query);
$v=array();
  while($fetchs=mysqli_fetch_array($village_con)){
 
     $v[]=$fetchs[1];
    
     print_r($v);
  }
  
  
echo "Ram";

?>
