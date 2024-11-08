<?php
$url        =  $_POST['url'];
$parameters =  $_POST['parameters'];
$variables  =  $_POST['variables'];

if(isset($_POST['url'])){

  $callurl=$url."&api_key=VarifyTADKA7563&company_id=400%20&action=addToCart&token=8cc6be81ea4f574acf24aa1aaae2252d&product_id=".$_POST['product_id']."&member_id=".$_POST['member_id']."&size_id=".$_POST['size_id']."&color_id=".$_POST['color_id'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $callurl,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '', 
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
}
else
{
  echo "Not Set";
}
?>