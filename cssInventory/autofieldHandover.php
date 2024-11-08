<?php
include 'config.php';
$data=array();
$value=$_POST['id'];


 $sql3="SELECT city,state,Address,Location FROM team where Name='".$value."' "; 

  $result3=mysqli_query($conn,$sql3);
  if($result3){
  $array=array();
 while($row3=mysqli_fetch_assoc($result3))
 {
 $array[]=$row3;
 }
  
  $myJSON=json_encode($array);
  echo $myJSON;
}else{
    echo "2";
    
}


  
?>