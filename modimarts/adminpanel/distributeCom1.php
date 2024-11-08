<?php
session_start();
include 'config.php';
include 'adminaccess.php';
include '../Commi_Data.php';



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


    
    <div class="row">

        <div class="col-md-12">
            <div class="table-responsive">
                  <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S.no</th>
                <th>ord no</th>
                <th>Product</th>
                <th>Price</th>
                <th>QTY</th>
                <th>Amt</th>
                <th>Commission (%)</th>
                <th>Commission</th>                
                </tr>
            </thead>
            <tbody>
            
                <?php

               $j   = 0;
              
           
            // $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE id IN (447,559,564,570,589,599,611,613,618,633,639,641,642,644,649,655,657,667,681,617,663,543,456,691,693,456,699,700,701,598,705,706,707,708,709,528)"); 
          $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE id IN (712,714,715,716,717,718,719,720)");

        // $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE id='705'");
            // $select_sql = mysqli_query($con1, "SELECT * FROM `Order_ent` WHERE is_franchise='1'  ORDER BY `Order_ent`.`id` ASC ");
             
                $ttlamt=0;
               $ttlcom=0;


           
                foreach ($select_sql as $key => $order) {

              $totalCommision=0;
              $totalReffCommision=0;
              $totalbillamount=0;
            // $order=mysqli_fetch_assoc($select_sql);

                   
                $order_id=$order['id'];
                $date=date('Y-m-d',strtotime($order['date']));

                $orderdata=mysqli_query($con1,"SELECT * FROM `order_details` WHERE oid='".$order_id."' AND oid<>''");

              $orderData=array();
             

            $pincode=GetUserPincode($order_id);
            $franchisedata=GetfraByPin($pincode);
            $fdecode=json_decode($franchisedata);
            $f_id=$fdecode->id;
          
            // $date=date('d-m-Y');
            $reffid="0";
             $is_franchise=$order['is_franchise'];
             $ttlCommision=0;

                    foreach ($orderdata as $key => $getprodeatils) {
                        // if($getprodeatils['outside_product']!=1){
                       
  
                   

                    $pro_amount = $getprodeatils['rate'];
                    $product_name = $getprodeatils['product_name'];
                    $pro_qty = $getprodeatils['qty'];
                    $price = number_format($pro_amount,2, '.', '');

                    $billamount=$price*$pro_qty;

           if($getprodeatils['outside_product']!=1){

            $_product_id   = explode('/', $getprodeatils['item_id']);
            $promotion     = $_product_id[0];

            $sql1   = mysqli_query($con1, "select allmart_commission from products where code='" . $_product_id[0] . "' and category='" . $_product_id[1] . "' and name='" . $_product_id[2] . "' order by code desc");
            $sql_result1        = mysqli_fetch_assoc($sql1);

              // echo $sql_result1['allmart_commission'];

            
            if (!empty($sql_result1)) {
                $allmart_commissionp = $sql_result1['allmart_commission'];
                $allmart_commission = (($pro_amount/100)*$allmart_commissionp);
            }
            else
            {
                $allmart_commission = 0;

            }
        }
        else
        {
            $allmart_commissionp=10;
           $allmart_commission = (($pro_amount/100)*$allmart_commissionp); 
        }

            $reff_amount=(($pro_amount/100)*10);
            $reff_amount=$reff_amount * $pro_qty;


            $allmart_commission = $allmart_commission * $pro_qty;
            $commision=$allmart_commission;
            $commision=number_format($commision,2, '.', '');
            $reff_amount=number_format($reff_amount,2, '.', '');
 
            $orderdata = array(
                'ProName' =>urlencode($product_name) ,
                'Amount' =>$price ,
                'Qty' =>$pro_qty,
                'Commission' =>$allmart_commissionp,
                'RefCommission' =>'10',
                'CommissionAmount' =>$commision,
                'RefAmount' =>$reff_amount,
                 );
            array_push($orderData, $orderdata);

            $totalbillamount=$totalbillamount+$billamount;


$ttlCommision=$ttlCommision+$commision;
$totalReffCommision=$totalReffCommision+$reff_amount;

//             $reff_amount="10";
// echo "ORD-".$order_id."-".$product_name." price-".$price." QTY-".$pro_qty." Bill AMOUNT-".$billamount." Commi- ".$sql_result1['allmart_commission']." Comm Amount-".$commision;
// echo "<br/>";
            // echo '<pre>';print_r($commision);echo '</pre>';
?>
<tr>
    <td>1</td>
    <td><?=$order_id?></td>
    <td><?=$product_name?></td>
    <td><?=$price?></td>
    <td><?=$pro_qty?></td>
    <td><?=$billamount?></td>
    <td><?=$sql_result1['allmart_commission']?></td>
    <td><?=$commision?></td>
   
</tr>
<?php
           }                        
                // }

                // echo '<pre>';print_r($totalbillamount);echo '</pre>';
                // echo '<pre>';print_r($ttlCommision);echo '</pre>';

                 $encoded_orderData=json_encode($orderData);
                 $totalCommision=number_format($ttlCommision,2, '.', '');
                 $totalReffCommision=number_format($totalReffCommision,2, '.', '');
                 $totalbillamount=number_format($totalbillamount,2, '.', '');

            $MyFunction= DistributeCommission($order_id, $totalCommision, $f_id, $date, $encoded_orderData,$reffid,$order_id,$is_franchise,$totalReffCommision,$totalbillamount);

               // $ttlamt=$ttlamt+$totalbillamount;
               // $ttlcom=$ttlcom+$ttlCommision;
            // var_dump($MyFunction);
                               
           
            }

            // echo $ttlamt;
            // echo "<br/>";
            // echo $ttlcom;

            ?>
               
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