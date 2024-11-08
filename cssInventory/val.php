<?php
include 'config.php';
$data=array();
$value=$_POST['sr'];
$vendorname=$_POST['vendorname'];
$material=$_POST['material'];
$modelno=$_POST['modelno'];


$ChargingVoltage=  explode(',', $value);

foreach ($ChargingVoltage as $key => $valuess) {
//echo "splittedstring[".$key."] = ".$valuess."<br>";
}
$count=count($ChargingVoltage);
//echo $count;
//$data[]=$ChargingVoltage;
$data[]=$valuess;

/*$sql="select srno from enventory_Stock";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
*/
  
   $sql2="select srno,InventoryIN from enventory_Stock where srno IN ('".$data[0]."')  "; 
 // echo $sql2;
 $result2=mysqli_query($conn,$sql2);
      
 /* while($retFetch=mysqli_fetch_aaray($result2)){
      $result3=mysqli_query($conn,"select * from Inventory_IN where '".$retFetch[1]."' ");
      $numrow=mysqli_num_rows($result3);
  }*/
  
   $numrow=mysqli_num_rows($result2);
//}
if($numrow >0){
    echo "1";
}else{
    echo "0";
    
}

?>