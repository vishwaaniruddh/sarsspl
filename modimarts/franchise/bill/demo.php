<? include('../config.php');

$sql = mysqli_query($con,"select * from new_member where location <>'' and location IS NOT NULL and (gst <>'' or adhar_card <> '' or pan <>'')");

while($sql_result = mysqli_fetch_assoc($sql)){
    
    $id = $sql_result['id'];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://allmart.world/bill/pdf/bill.php?id=".$id);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $ret = curl_exec ($ch);
  curl_close ($ch);
  
  
}

?>