<?php
include 'config.php';
$data=array();
$value=$_POST['sr'];
//echo $value;


 $sql1="select srno from InventoryOUT_Stock where srno='".$value."' "; 
  $result1=mysqli_query($conn,$sql1);
  $row1=mysqli_num_rows($result1);
if($row1<1){
    
    $sql2="select InventoryIN from enventory_Stock where srno='".$value."' "; 
 
  $result2=mysqli_query($conn,$sql2);
  $row=mysqli_fetch_array($result2);

 $sql3="SELECT * FROM Inventory_IN I INNER JOIN enventory_Stock e ON I.id = e.InventoryIN where e.InventoryIN='".$row[0]."' and e.srno='".$value."' "; 

  $result3=mysqli_query($conn,$sql3);
  
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


 
  
  
  
  
/*$ChargingVoltage=  explode(',', $value);

foreach ($ChargingVoltage as $key => $valuess) {
//echo "splittedstring[".$key."] = ".$valuess."<br>";
}
$count=count($ChargingVoltage);
//echo $count;
//$data[]=$ChargingVoltage;
$data[]=$valuess;

$sql="select srno from enventory_Stock";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    
   // $sql2="select srno from enventory_Stock where srno='".$data[0]."'";
   $sql2="select * from enventory_Stock where srno IN ('".$value."')"; 
  echo $sql2;
   $result2=mysqli_query($conn,$sql2);
   $numrow=mysqli_num_rows($result2);
}
if($numrow >0){
    echo "1";
}
*/
?>