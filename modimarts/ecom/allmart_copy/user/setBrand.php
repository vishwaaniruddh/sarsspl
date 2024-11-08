<?php 
session_start();
include('config.php');

//var_dump($_POST);
$id=$_POST['proct'];
if($_POST['product']==1){
    $qrya="select * from product_model where brand_id='".$id."'";
    //echo "select * from product_model where brand_id='".$id."'";
    $resulta=mysqli_query($con1,$qrya);
 
    $data =array(); 
    while ($rowa = mysqli_fetch_assoc($resulta)){
       //var_dump($rowa);
       $data[] = array("id"=>$rowa['id'], "product"=>$rowa['product_model'], "brand"=>$rowa['brand_id'], "status"=>$rowa['status']);
  }
} else {
$qrya="select * from brand where category_id='".$id."'";
//echo "select * from brand where id='".$id."'";
$resulta=mysqli_query($con1,$qrya);
 //$rowa = mysqli_fetch_assoc($resulta);
 //$nrws=mysqli_num_rows($resulta);
// var_dump($rowa);
//$aa=$rowa[2];
  $data =array(); 
  //echo $nrws;exit;

    while ($rowa = mysqli_fetch_assoc($resulta)){
       //var_dump($rowa);
       $data[] = array("id"=>$rowa['id'], "brand"=>$rowa['brand'], "category"=>$rowa['category_id'], "status"=>$rowa['status']);
    }
}
echo json_encode($data);
?>