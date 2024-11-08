<?php
session_start();
include('config.php');
include('adminaccess.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />


<!--  jquery core -->   
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>



<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>


<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

<style>
  body
  {
    background: white;
  }
  .loader{
  display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('/assets/loader.gif') 
              50% 50% no-repeat rgb(246 246 246 / 52%);
}
</style>

</head>
<body> 

  <?php
            // $item = mysqli_query($con1,"select * from order_details  where track_id='".$_GET['track_id']."' ");
            // $itemdata=mysqli_fetch_assoc($item);
            $order_id=$_GET['track_id'];

            $ordeshipping=mysqli_query($con1,"SELECT * FROM `order_shipping` WHERE order_ids='".$order_id."'");
            $ShippingData=mysqli_fetch_assoc($ordeshipping);


            $item_id=$ShippingData['item_id'];
            $channel_id=$ShippingData['channel_id'];
            $shipment_id=$ShippingData['shipment_id'];
            $order_ids=$ShippingData['order_ids'];
            $awb_code=$ShippingData['awb_code'];
            $generate_awb=$ShippingData['generate_awb'];
            $generate_pickup=$ShippingData['generate_pickup'];
            $generateManifest=$ShippingData['generateManifest'];
            $printManifest=$ShippingData['printManifest'];
            $generateLabel=$ShippingData['generateLabel'];
            $printInvoice=$ShippingData['printInvoice'];
            $gettrackdetails=$ShippingData['gettrackdetails'];
            $CourierList=$ShippingData['courier_list'];


            $qrytoken = "select token from add_ship_rocket_token where id='1'";
            $result_token = mysqli_query($con1, $qrytoken);
            $rowtoken    = mysqli_fetch_row($result_token);
            $datajson=json_decode($gettrackdetails);
       ?>

<!-- End: page-top-outer -->
  
<div class="clear">&nbsp;</div>
 
<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
  <div class="loader"></div>
<!-- start content -->

<div id="content" class="container"> 
       
       <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">
       <input type="hidden" id="order_id" value="<?php echo $orderid; ?>">
       <?php if ($generate_pickup=='') { ?>
       <div class="row">
         <div class="col-md-3">
          <?php
          $deledata=json_decode($CourierList);
          $courierData=$deledata->data->available_courier_companies;
          $recoomeded_id=$deledata->data->recommended_courier_company_id;

    ?>
    <label>Select Courier</label>
    <select class="form-control" name="Courier_id" id="Courier_id" required>
      <option value="">Select Courier</option>
    <?php
    foreach ($courierData as $key => $name) {
      // if ($name->is_rto_address_available==1) {
    ?>
      <option value="<?=$name->courier_company_id?>"><?=$name->courier_name?> (<?=$name->rating?>) ( Rs. <?=$name->rate?>) <?php if ($recoomeded_id==$name->courier_company_id) { echo "Recommended";} ?></option>
    <?php } ?>
  </select>
         </div>
         <div class="col-md-3">
           <button class="btn btn-primary" onclick="ganerateAWB('<?=$shipment_id?>','<?=$order_ids?>')" style="margin-top: 30px;">Proceed Next</button>
         </div>
         <?php 
 //          echo "<pre>";
 // print_r($deledata);
 // echo "</pre>";
  ?>
       </div>
       <?php 
}

if ($generate_awb!='') {
 
$awbdata=json_decode($generate_awb);
$awbstatus=$awbdata->awb_assign_status;

if ($awbstatus==1) {
  if ($generate_pickup!='') {
    
  
$pickdata=json_decode($generate_pickup);
$pickstatus=$pickdata->pickup_status;
// if ($pickstatus==1) {
 ?>

       <?php
       
         
        if ($generateManifest=='') {        
        ?>
       <button class="btn btn-primary" onclick="printManifest(<?=$shipment_id?>,<?=$order_ids?>)">Generate Manifest</button>
      <?php 
        }else{ 
      if($printManifest=='')
        {
        ?>
       <button class="btn btn-primary" onclick="printManifest(<?=$order_ids?>)" >Download Manifest</button>
       <?php 
        }
        else
        {
        $data=json_decode($generateManifest);
        ?>
       <a href="<?=$data->manifest_url?>" class="btn btn-primary" download="Manifest">Download Manifest</a>
   <?php } 
}?>

        <?php if ($generateLabel=='') {
          ?>
          <button class="btn btn-primary" onclick="generateLabel(<?=$shipment_id?>,<?=$order_ids?>)" >Generate Label</button>
          
          <?php
        }else { 
          $data1=json_decode($generateLabel);
       ?>
          <a href="<?=$data1->label_url?>" class="btn btn-primary" download="Label" >Download Label</a>
        <?php } ?>

       <?php if($printInvoice==''){ ?>      
       <button class="btn btn-primary" onclick="printInvoice(<?=$order_ids?>)"  >Generate Invoice</button>
   <?php }else{
    $data3=json_decode($printInvoice);
    ?>
    <a href="<?=$data3->invoice_url?>" class="btn btn-primary" download="Invoice">Download Invoice</a>
   <?php } ?>
<?php 
if ($gettrackdetails=='') {
 ?>
 <?php if ($datajson->tracking_data->shipment_track[0]->current_status!='Canceled' && $datajson->tracking_data->shipment_track[0]->current_status!='Delivered' ){ ?>
   
 
 <button class="btn btn-danger" onclick="CancelOrder(<?=$order_ids?>,<?=$awb_code?>)">Cancel Order</button>
 <?php }?>
   <button class="btn btn-danger"  onclick="gettrackdetails(<?=$awb_code?>)">Track Order</button>
 <?php
}
else
{
 ?>
 <?php if ($datajson->tracking_data->shipment_track[0]->current_status!='Canceled' && $datajson->tracking_data->shipment_track[0]->current_status!='Delivered' ){ ?>
   
 
 <button class="btn btn-danger" onclick="CancelOrder(<?=$order_ids?>,<?=$awb_code?>)">Cancel Order</button>
 <?php }?>
 <a class="btn btn-danger" onclick="gettrackdetails(<?=$awb_code?>)" target="_blank" style="float: right;" href="<?=$datajson->tracking_data->track_url?>">Track Now</a>
 <?php 
 } ?>
 
   </div>
   <div class="container">
   <div class="row ">

    
      <div class="col-md-2">
      <label>Current Status</label>     
      <p id="Status" class="btn btn-link"><?=$datajson->tracking_data->shipment_track[0]->current_status?></p>
     </div>

     <div class="col-md-4">
      <label>Pickup Date</label>
    <?php 
                  $checkLogin = preg_replace('/(}")/i', '}', $generate_pickup);
                  $checkLogin = preg_replace('/("{)/i', '{', $checkLogin);
                  $checkLogin = stripcslashes($checkLogin);
                  $object = json_decode($checkLogin);
                  $data = $object->response->pickup_scheduled_date;
                  

     ?>
     <p><?=date('D,d-m-Y H:i:s',strtotime($data))?></p>
    
     </div>
     <div class="col-md-2">
      <label>Tracking Code</label>
      <p><?=$datajson->tracking_data->shipment_track[0]->awb_code?></p>
      
     </div>
     <div class="com-md-3">
      <label>Courier Name</label>
      <?php 
      $deleivarycom=json_decode($generate_awb);
      // var_dump($deleivarycom);
       ?>
        <p><?=$deleivarycom->response->data->courier_name?></p>
     </div>
  </div>
  </div>
     <br/>
     <br/>

     <br/>
     <br/>
     <div class="container" style="background: #80808054;
    border-radius: 8px;">
      <h3>Order Tracking</h3>
      <br/>
     <table class="table-bordered table-responsive table-hover" width="100%">
      <thead>
        <tr>
          <td>S.No</td>
          <td>Date</td>
          <td>Activity </td>
          <td>Location </td>
        </tr>
      </thead>
      <tbody>
         <?php
         $track=$datajson->tracking_data->shipment_track_activities;
         foreach ($track as $key => $value) {
         
         ?>
          <tr>
            <td><?=$key+1?></td>
            <td>
              <p><?=date('D,d-m-Y H:i:s',strtotime($value->date))?></p>
            </td>
            <td>
              <p><?=$value->activity?></p>
            </td>
            <td >
              <p><?=$value->location?></p>
            </td>
          </tr>
            <?php } ?>
         </tbody>
      </table>
  
     </div>
     
   <?php 
   if(0){ ?>
    <div class="row">
      <div class="col-md-3">
        <button class="btn btn-primary" onclick="generate_pickup('<?=$shipment_id?>','<?=$item_id?>')" style="margin-top: 30px;">Generate Pickup</button>
      </div>
    </div>
   <?php }
   }
   else{ ?>
    <div class="row">
         <div class="col-md-3">
          <?php
          $deledata=json_decode($CourierList);
          $courierData=$deledata->data->available_courier_companies;
          $recoomeded_id=$deledata->data->recommended_courier_company_id;

    ?>
    <label>Select Courier</label>
    <select class="form-control" name="Courier_id" id="Courier_id" required>
      <option value="">Select Courier</option>
    <?php
    foreach ($courierData as $key => $name) {
      // if ($name->is_rto_address_available==1) {
    ?>
      <option value="<?=$name->courier_company_id?>"><?=$name->courier_name?> (<?=$name->rating?>) ( Rs. <?=$name->rate?>) <?php if ($recoomeded_id==$name->courier_company_id) { echo "Recommended";} ?></option>
    <?php } ?>
  </select>
         </div>
         <div class="col-md-3">
           <button class="btn btn-primary" onclick="ganerateAWB('<?=$shipment_id?>','<?=$item_id?>')" style="margin-top: 30px;">Proceed Next</button>
         </div>
         <?php 
 //          echo "<pre>";
 // print_r($deledata);
 // echo "</pre>";
  ?>
       </div>
   <?php }
 }}
 ?>

   </div>
 
<br/>
<br/>
<br/>


      
    
<script src="js/order_courier1.js"></script>
</body>
</html>