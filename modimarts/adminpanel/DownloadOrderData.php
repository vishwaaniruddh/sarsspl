<?php
session_start();
include 'config.php';
include 'adminaccess.php';
include('../apidata.php');

function simplegstexcluded($amount,$percent){
   $gst_amount = ($amount*$percent)/100;
   $total = number_format($amount+$gst_amount, 2, '.', '');
   $percentcgst = number_format($gst_amount/2, 3, '.', '');
   $percentsgst = number_format($gst_amount/2, 3, '.', '');
   return $total;
}

function getnetamount($amount,$percent){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
  
   
   $withoutgst = number_format($amount - $gst_amount,2, '.', '');
   return $withoutgst;
}

function getCGST($amount,$percent){
   $gst_amount = $amount-($amount*(100/(100+$percent)));
   $percentcgst = number_format($gst_amount/2, 2, '.', '');
   $percentsgst =  number_format($gst_amount/2, 2, '.', '');
   return $percentcgst;
}

function getGSTType($proddID)
{
    include 'config.php';
    global $con1;

      $prod = mysqli_query($con1,"SELECT gst_with FROM product_model where id='".$proddID."'");
      $product_name = mysqli_fetch_assoc($prod);
      return $product_name['gst_with'];
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
 <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"> -->
 <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script>
      $('.datepicker').datepicker();
  </script>

  <script type="text/javascript">
if (typeof jQuery == 'undefined') {
    var script = document.createElement('script');
    script.type = "text/javascript";
    script.src = "https://code.jquery.com/jquery-3.5.1.js";
    document.getElementsByTagName('head')[0].appendChild(script);
}
</script>


<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        $('input').checkBox();
        $('#toggle-all').click(function() {
            $('#toggle-all').toggleClass('toggle-checked');
            $('#mainform input[type=checkbox]').checkBox('toggle');
            return false;
        });
    });
</script>

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>

<![endif]>

<!--  styled select box script version 2 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
    $('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 -->
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script -->
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
      $("input.file_1").filestyle({
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
        });
    });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('a.info-tooltip ').tooltip({
        track: true,
        delay: 0,
        fixPNG: true,
        showURL: false,
        showBody: " - ",
        top: -35,
        left: 5
    });
});
function delfun(id,remid)
{
    try
    {
        var reas="";
        var remcheck=0;
        <?php if ($_SESSION['designation'] != "0") {
    ?>
        reas=document.getElementById(remid).value;
        if(reas.trim()=="")
        {
            remcheck=1;
        }
        <?php }?>

        if(remcheck==0)
        {

        var confirmv=confirm("Are you sure to delete");
        if(confirmv)
        {
            $.ajax({
                type: "POST",
                url: "deleteCustomer.php",
                data:'cmp='+ id + '&reas='+ reas,

                success: function(msg){
                    //alert(msg);
                    if(msg==1)
                    {
                        alert("Delete successfull");
                    }else
                    {
                        alert("Error");
                    }
                    window.location.reload();
                }
             });
            }
        }   else
        {
            alert("Enter Reason for deletion");
            document.getElementById(remid).focus();
        }
    }catch(exc)
    {
        alert(exc);
    }
}
</script>
<!--  date picker script -->
<!-- <link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script> -->
<script type="text/javascript" charset="utf-8">
    function shfunc(divid,stats)
    {
        try
        {
            // alert(divid);
            if(stats=="1")
            {
                document.getElementById(divid).style.display="block";
            }else
            {
                document.getElementById(divid).style.display="none";
            }
        }catch(exc)
        {
            alert(exc);
        }
    }
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
<style>
     #content-outer
  {
    background: white;
  }
</style>
</head>
<body>

<!-- End: page-top-outer -->

<div class="clear">&nbsp;</div>

<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include 'header.php';?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Orders Details</h1>
    </div>
    <!-- end page-heading -->
    <div class="row form-group">
        <form action="#" method="get" class="form-group">
        <div class="col-md-4">
            <label>Start Date</label>
            <input type="date" name="fromdate"  value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}?>" class="form-control datepicker "  required="true">
        </div>
        <div class="col-md-4">
            <label>End Date</label>
            <input type="date" name="todate" value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" class="form-control datepicker" required="true">
        </div>
        <div class="col-md-4">
            <input type="submit" class="btn btn-primary" style="margin-top: 29px;">
        </div>
        </form>
        </div>
    <div class="row">

        <div class="col-md-12">
            <div class="table-responsive">
            <table id="example" class="table table-striped table-responsive table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order No</th>
                    <th>Invoice No</th>
                    <th>Date of Invoice</th>
                    <th>Time of Invoice</th>
                    <th>Month of Invoice</th>
                    <th>Order Status</th>
                    <th>Customer Name</th>
                    <th>Customer Mob</th>
                    <th>Product Name</th>
                    <th>HSN Code</th>
                    <th>Qty</th>
                    <th>Gross Rate</th>
                    <th>Discount</th>
                    <th>Discount Amt</th>
                    <th>Net Rate</th>
                    <th>Total Net Amount</th>
                    <th>GST Rate</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>IGST</th>
                    <th>GST Amount</th>
                    <!--<th>Discount</th>-->
                    <th>Shipping Charge</th>
                    <th>Round off</th>
                    <th>Total</th>
                    <th>State</th>
                    <th>Payment Mode</th>
                    <th>GST No</th>
                    <th>Pan No</th>
                    <th>Order Address</th>
                </tr>
                </thead>
                <tbody >
                <?php
               $j   = 0;
               if(isset($_GET['fromdate']))
               {
                $fromdate= date('Y-m-d H:i:s',strtotime($_GET['fromdate']));
                $todate  = date('Y-m-d H:i:s', strtotime($_GET['todate'] . ' +1 day'));
                  $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE deleted_at is NULL AND date BETWEEN '".$fromdate."' AND '".$todate."'  ORDER BY `Order_ent`.`id` DESC");
                  
               }
               else
               {
            $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent`WHERE deleted_at is NULL ORDER BY `Order_ent`.`id` DESC");
              }
            // while ($order = mysqli_fetch_assoc($select_sql)) {

            $totalnetamount=0;
            $totalcgst=0;
            $totalsgst=0;
            $totaligst=0;
            $totalgstamount=0;
            $GTotal=0;
            $totaldiscount=0;
              $final_net_amt = 0;
                foreach ($select_sql as $key => $order) {
                   
                $order_id=$order['id'];
                

                 $response=$order['ord_response'];
                    $response=json_decode($response);
                     $notes=$response[39]; 
                    $paytype=$response; 

                    $response=$response[5];
                
                    $response = explode("=",$response);
                    $paymentmethod= $response[1];

                    $Notes = explode("=",$notes);
                    $billnotes= $Notes[1];

                    $paytype=$paytype[6];
                    $paytype = explode("=",$paytype);
                    $paymenttype= $paytype[1];
                    


                $orderdata=mysqli_query($con1,"SELECT * FROM `order_details` WHERE oid='".$order_id."' AND oid<>''");
               $total_qty = 0 ;
               $total     = 0;

               
                // while ($getprodeatils=mysqli_fetch_assoc($orderdata)) 
                // {
                    foreach ($orderdata as $key => $getprodeatils) {
                       
                    $userdata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='".$order_id."'"));

                    $username = $userdata['name'];
                    $address = $userdata['address'];
                    $city = $userdata['city'];
                    $pincode = $userdata['zip'];
                    $state = $userdata['state'];
                    $country = $userdata['country'];
                    $email = $userdata['email'];
                    $phone = $userdata['phone'];
                    $primary_address= $address.''.$city.' '.$state.' '.$pincode.' '.$country ;

                    $pro_amount = $getprodeatils['rate'];
                    $outside_product=$getprodeatils['outside_product'];
    $pro_qty = $getprodeatils['qty'];
    // $pro_type = $pro_sql_result['product_type'];
    $pro_type = 0;
    // $product_id = $pro_sql_result['product_id'];
    $track_Status=$getprodeatils['track_Status'];
    $product_name = $getprodeatils['product_name'];
    $item_id=$getprodeatils['item_id'];
    $orderdata=explode('/', $item_id);
    $proid=$orderdata[0];
    $productid=$orderdata[2];
   $hsn=$getprodeatils['HSN'];

   if($outside_product==1){
   
   $GSTType=0;
  }
  else
  {
    $GSTType=getGSTType($productid);
  }
   
//   echo  $proid;die();
   
   $discount=$getprodeatils['discount'];
    if($getprodeatils['dis_amount']!=0){
    $discountamount=$pro_amount*$discount/100;
    }
    else
    {
    $discountamount=0;  
    }
    
   
                                                        
   if($hsn=='')
   {
   if($proid==711)
    {
      $hsn="38089400";
    } 
    else if($proid==655)
    {
      $hsn="5208";
    }
    else if ($proid==713)
    {
      $hsn="3808";
    }
    else
    {
      $hsn="";
    }
    }
    else
    {
      $hsn=$hsn;
    }
    $ttgst=$getprodeatils['gst'];
    $i_gst =number_format($ttgst/2,2, '.', '');
    $c_gst =number_format($ttgst/2,2, '.', '');

    $total_qty = $total_qty + $pro_qty ;
    $total += $pro_amount * $pro_qty;

$price = number_format($pro_amount,2, '.', '');
// $price = sprintf("%.2f", $price);

  if($ttgst==0)
    {
       $i_gst = 9;
       $c_gst = 9;
       $ttgst = 18;
    }

    $gstrate=$i_gst+$c_gst;

    // $single=getCGST($price,$ttgst);
    // $totalsingle=$single*$pro_qty;

    // $unittax=2*$single;

    // $unitprice= getnetamount($price,$ttgst);
    
      // Check Amount WIth GST Or NOT

                 if ($GSTType=='1') {
                     
                     $price=$price-$discountamount;
                     $gstamt=simplegstexcluded($price,$ttgst);
                     $igst = (($gstamt* $i_gst) / 100 )* $pro_qty;
                     $cgst = (($gstamt* $c_gst) / 100) * $pro_qty;

                     $totalgst=$i_gst+$c_gst;
                     $unitprice=$price;
                     $ttlamt=$unitprice+$totalgst;
                     $ntoamt=$ttlamt*$pro_qty;
                     $getnetamt=$unitprice*$pro_qty;
                     
                     $sing_amount=$pro_amount;
                     
                    //   echo $unitprice;die();
                 }
                 else
                 {

                    // $price=$price-$discountamount;
                     $cgst = ($price / $ttgst);
                     $gstamt=$cgst;
                     $igst = (($gstamt* $i_gst) / 100 )* $pro_qty;
                     $cgst = (($gstamt* $c_gst) / 100) * $pro_qty;
                     $unitprice=getnetamount($price,$ttgst);

                     $totalgst=$i_gst+$c_gst;

                    //   $ntoamt=$price*$pro_qty;
                    //   $ntoamt=$ntoamt-$discountamount;
                      
                      $getnetamt=$unitprice*$pro_qty;
                    //  $getnetamt = ($unitprice*$pro_qty)+$totalgst;
                    
                    $sing_amount=$pro_amount;
                    
                    //  echo $price;die();


                 }
                 
                 
    


    //   $ntoamt =$price*$pro_qty;

    //  $netamt=$ntoamt/(100+$ttgst)*100;
    //  // $netamt=$unitprice*$pro_qty;
    //  $ntoamt =$price*$pro_qty;
    //  $unitprice= $netamt/$pro_qty;

      // CGST GET FROM NET AMOUNT
     $netamt= $getnetamt;
      
    $single=($netamt/100)*$i_gst;
    $totalsingle=$single;
    $unittax=2*$single;
    $totaltax=$totalsingle*2;

    $totalnetamount=$totalnetamount+$netamt;
    if($userdata['state']=='Maharashtra'){ 
    $totalcgst=$totalcgst+$totalsingle;
    $totalsgst=$totalsgst+$totalsingle;
    $totaligst=$totaligst+0;
     }
     else
     {
      $totalcgst=$totalcgst+0;
      $totalsgst=$totalsgst+0;
      $totaligst=$totaligst+$totaltax;
     }
     
     
     
    $totalgstamount=$totalgstamount+$totaltax;

    $total_amount=$getprodeatils['total_amt']-$order['discount'];
    
$round=round($total_amount);
$round1=round($total_amount,2);

$Roundof=$round-$round1;
$total_amount=$round;

    
    $totaldiscount=$totaldiscount+$discountamount;
    
    
    $total_amount=$getnetamt+$totaltax;
    
    
    $amtstr=number_format($total_amount, 2, '.', '');
       $str_arr = explode('.',$amtstr);
                  
      
       // $roundoff=$frs-$secnd;
       
       
        if($str_arr[1]==0)
       {
           $roundoff="0.00";
       }
       else
       if($str_arr[1]<50)
       {
         $total_amount= number_format($str_arr[0],2, '.', '');  
         $roundoff="- 0.".$str_arr[1];
       } 
      
       else
       {
           $grandtotal= number_format($str_arr[0],2, '.', '');  
           $roundoff= 100-$str_arr[1];
           $roundoff= "0.".$roundoff;
           
          $total_amount=$grandtotal+1;
       }

     
$total_gst = $total_gst + $totaltax;


$GTotal=$GTotal+$total_amount;
$orderdate=date('d-m-Y',strtotime($order['date']));
$ordertime=date('h:i:s a',strtotime($order['date']));
$orderMonth=date('M',strtotime($order['date']));
                    ?>
                    <tr>
                        <td><?=$j+1?></td>
                        <td><?=$getprodeatils['oid']?></td>
                        <td>#<?=$getprodeatils['oid']?></td>
                        <td><?=$orderdate?></td>
                        <td><?=$ordertime?></td>
                        <td><?=$orderMonth?></td>
                        <td>
                           <?php
                           if($outside_product!=1)
                           {
                             if($track_Status!='')
                               {
                                  $shiorddetail=mysqli_query($con1,"SELECT * FROM `order_shipping` WHERE oid='" . $order['id']. "' AND oid<>''");
                                    $statusty=1;    
                                    $count=mysqli_num_rows($shiorddetail); 

                                    if($count)
                                    { 
                                      while (($data = mysqli_fetch_assoc($shiorddetail)))
                                        { 
                                            $gettrackdetails=$data['gettrackdetails'];
                                             $datajson=json_decode($gettrackdetails);
                                            $rlstatus=$datajson->tracking_data->shipment_track[0]->current_status;  
                                         
                                            echo '<span class="text-success" >'.$rlstatus.'</span>';
                                            $statusty=0;   
                                            $stcode=1;
                                            $stt = $order['status'];
                                              
                                            if ($rlstatus=="Delivered") {
                                                 $retVal =  3;
                                            } else 
                                            if ($rlstatus=="Canceled") {
                                                 $retVal =  4;
                                            }
                                             else
                                            {
                                                $retVal = $stt;
                                            }


                                          mysqli_query($con1,"UPDATE `order_details` SET `status`='".$retVal."' WHERE `id`='".$getprodeatils['id']."'");
                                        }
                                    }
                                    else
                                    {
                                                                   
                                       if ($order['status'] == 0) {
                                            echo "<span class='text-warning' >Waiting For Approval</span>";
                                        }
                                        if ($order['status'] == 1) {
                                            echo "<span class='text-info' >Waiting For Dispatch</span>";
                                        }
                                        if ($order['status'] == 2) {
                                            echo "<span class='text-primary' >Dispatch</span>";
                                        }
                                        if ($order['status'] == 3) {
                                            echo "<span class='text-success' >Delivered</span>";
                                        }
                                        if ($order['status'] == 4) {
                                            echo "<span class=' text-danger' >Rejected</span>";

                                        }
                                        if ($order['status'] == 5) {
                                            echo "<span class=' text-danger' >Refunded</span>";

                                        }
                                        if ($order['status'] == 6) {
                                            echo "<span class=' text-danger' >Cancelled</span>";

                                        }
                                    }  
                                }
                                else
                                {
                                   if ($order['status'] == 0) {
                                        echo "<span class='text-warning' >Waiting For Approval</span>";
                                    }
                                    if ($order['status'] == 1) {
                                        echo "<span class='text-info' >Waiting For Dispatch</span>";
                                    }
                                    if ($order['status'] == 2) {
                                        echo "<span class='text-primary' >Dispatch</span>";
                                    }
                                    if ($order['status'] == 3) {
                                        echo "<span class='text-success' >Delivered</span>";
                                    }
                                    if ($order['status'] == 4) {
                                        echo "<span class=' text-danger' >Rejected</span>";

                                    }
                                    if ($order['status'] == 5) {
                                        echo "<span class=' text-danger' >Refunded</span>";

                                    }
                                    if ($order['status'] == 6) {
                                        echo "<span class=' text-danger' >Cancelled</span>";

                                    }
                                }
                            }

                            else{

                                // var_dump($getprodeatils['shipping_status']);
                                if($getprodeatils['shipping_status']==0)
                                {
                                        $order_Res=$order['other_res'];
                                        $Ordres=json_decode($order_Res);
                                        $ressts=$Ordres->Status;
                                        // var_dump($Ordres);
                                        if($ressts=="success"){
                                           $apiorderid=$Ordres->Order_no;
                                          $prostst= Prostatus($apiorderid);
                                          // var_dump($prostst);
                                          $Dis_Status=$prostst[0]->Dispatch_status;
                                        
                                           echo "<span class=' text-warning' >".$Dis_Status." ( From Discount Tadka)</span><br/>";
                                         

                                        }
                                        else
                                        {
                                             echo "<span class=' text-danger' >Order Failed (From Discount Tadka)</span>";
                                        }
                                }
                                else
                                { 
                                    if ($getprodeatils['shipping_status'] == 1) {
                                        echo "<span class='text-info' >Waiting For Dispatch</span>";
                                    }
                                    if ($getprodeatils['shipping_status'] == 2) {
                                        echo "<span class='text-primary' >Dispatch</span>";
                                    }
                                    if ($getprodeatils['shipping_status'] == 3) {
                                        echo "<span class='text-success' >Delivered</span>";
                                    }
                                    if ($getprodeatils['shipping_status'] == 4) {
                                        echo "<span class=' text-danger' >Rejected</span>";

                                    }
                                    if ($getprodeatils['shipping_status'] == 5) {
                                        echo "<span class=' text-danger' >Refunded</span>";

                                    }
                                    if ($getprodeatils['shipping_status'] == 6) {
                                        echo "<span class=' text-danger' >Cancelled</span>";

                                    }
                                }
                        }

                                                     ?>  
                                            
                                                    </td>
                                                    <td><?=$userdata['name']?></td>
                                                    <td><?=$phone?></td>
                                                    <td><?=$getprodeatils['product_name']?></td>
                                                    <td><?=$hsn?></td>
                                                    <td><?=$getprodeatils['qty']?></td>
                                                    <td><?php echo number_format($sing_amount, 2); ?></td>
                                                    <td><?php if($discount!=0){ echo $discount."%";} else{ echo "-";} ?></td>
                                                    <td><?php if($discountamount!=0){ echo $discountamount;} else{ echo "-";} ?></td>
                                                    <td><?=number_format($unitprice,2, '.', '')?></td>
                                                    <td><?=number_format($netamt,2, '.', '')?></td>
                                                    <td><?=$gstrate?>%</td>
                                                    <td>
                                                      <?php if($userdata['state']=='Maharashtra'){  ?><?=number_format($totalsingle,2)?> <?php }else{ echo "";} ?></td>
                                                    <td> <?php if($userdata['state']=='Maharashtra'){  ?><?=number_format($totalsingle,2)?> <?php }else{ echo "";} ?></td>
                                                    <td> <?php if($userdata['state']!='Maharashtra'){  ?><?=number_format($totaltax,2)?> <?php }else{ echo "";}  ?></td>
                                                    <td><?=number_format($totaltax,2, '.', '')?></td>

                                                    <td> <?php if($order['shipping_charges']>0){ ?><?=$order['shipping_charges']?> (#<?=$order_id?>) <?php } ?></td>
                                                    <td><?=$roundoff?></td>
                                                    <td><?=number_format($total_amount,2, '.', '')?></td>
                                                    <td><?=$userdata['state']?></td>
                                                    <td>
                                                        <?php if ($paymentmethod!='') {
                                                            echo $paymentmethod." - ".$paymenttype;
                                                        }else{ 
                                                           echo $order['pmode'];
                                                       }
                                                       ?></td>
                                                       <td><?=$order['gst_details']?></td>
                                                       <td><?=$order['pan_details']?></td>
                                                       <td><?=$primary_address?><br/><?=$city?> : <?=$pincode?></td>
                                                </tr>
                                                <?php 
                                                  $j++;                   
                                            }
                                           
                                                           
                                      
                            }
            ?>
                
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    
                    <td><b><?=number_format($totaldiscount,2, '.', '')?></b></td>
                    <td></td>
                    <td><b><?=number_format($totalnetamount,2, '.', '')?></b></td>
                    <td></td>
                    <td><b><?=number_format($totalcgst,2, '.', '')?></b></td>
                    <td><b><?=number_format($totalsgst,2, '.', '')?></b></td>
                    <td><b><?=number_format($totaligst,2, '.', '')?></b></td>
                    <td><b><?=number_format($totalgstamount,2, '.', '')?></b></td>
                    
                    <td></td>
                    <td></td>
                    <td><b><?=number_format($GTotal,2, '.', '')?></b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>




</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->
<div id="footer">
    <div class="clear">&nbsp;</div>
</div>

<script>
 $(document).ready(function() {
    let today = new Date().toISOString().slice(0, 10);
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                        extend: 'excel',
                                 filename:'Orders-Details '+today, 
                                 title:'',
                                                    },'pageLength'
        ]
    } );
} );
</script>

<script>
    function DeleteOrder()
    {
        return confirm("Are Sure Delete This Order");
    }
</script>

<script>
     function printDiv(boxid) {
     var printContents = document.getElementById(boxid).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<!-- end footer -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

</body>
</html>