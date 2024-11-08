<?php
session_start();
include('config.php');
include('adminaccess.php');
include('../apidata.php');

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
        <?php if($_SESSION['designation']!="0")
        {
            ?>
        reas=document.getElementById(remid).value;
        if(reas.trim()=="")
        {
            remcheck=1;
        }
        <?php } ?>
        
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
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
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
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Orders</h1>
    </div>
    <!-- end page-heading -->
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>S.No</th>
                    <!-- <th>Txn ID</th> -->
                    <th>Order No</th>
                    <th>Order Date/Time</th>
                    <th>Order Amount</th>
                    <th>Order Status</th>
                    <th>Customer Name</th>
                    <th>Mobile No.</th>
                    <th>Payment Method</th>                 
                    <th>Product details</th>                 
                    <th>Print</th>                 
                    <th>Order Details</th>                  
                </tr>
                </thead>
                <tbody >
                <?php 
                $i=0;
                  $select_sql=mysqli_query($con1,"SELECT * FROM `Order_ent` ORDER BY `Order_ent`.`id` DESC");
                while($order=mysqli_fetch_assoc($select_sql)){
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


                $sql_address = mysqli_query($con1,"select * from new_order where oid='".$order['id']."'");

                    $sql_address_result = mysqli_fetch_assoc($sql_address);

                    $username = $sql_address_result['name'];
                    $address = $sql_address_result['address'];
                    $city = $sql_address_result['city'];
                    $pincode = $sql_address_result['zip'];
                    $state = $sql_address_result['state'];
                    $country = $sql_address_result['country'];
                    $email = $sql_address_result['email'];
                    $phone = $sql_address_result['phone'];
                    $primary_address= $address.''.$city.' '.$state.' '.$pincode.' '.$country ;
                ?>
                    
                    <tr>
                        <td><?=$i+1?></td>
                        <td>txn-<?=$order['id']?></td>
                        <!-- <td>txn-<?=$order['transaction_id']?></td> -->

                        <td><?=date('D,d-m-Y',strtotime($order['date']))?><br/><?=date('h:i:s a',strtotime($order['date']))?></td>
                        <td> <b>Rs. <?=$order['amount']?></b></td>
                        <td>

                            <a data-toggle="modal"  data-id="<?=$order['id']?>" class="open-DetailDialog btn btn-danger" href="#myModalDetail">
                                               View Details
                                           </a>
                              <?php
                              if($order['other_res']==''){

                               $shiorddetail=mysqli_query($con1,"SELECT * FROM `order_shipping` WHERE oid='" . $order['id']. "'");
 
    $statusty=1;     
   while (($data = mysqli_fetch_assoc($shiorddetail)))
        { 
            $gettrackdetails=$data['gettrackdetails'];
            if($gettrackdetails!=''){
             $datajson=json_decode($gettrackdetails);
            
            $rlstatus=$datajson->tracking_data->shipment_track[0]->current_status;  
         
          echo '<span class="text-success" >'.$rlstatus.'</span>';
          $statusty=0;
      }
                  
        }

                              

                              if ($statusty) {
                                   
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
                                }  
                                }
                                else
                                {
                                    $order_Res=$order['other_res'];
                                    $Ordres=json_decode($order_Res);
                                    $ressts=$Ordres->Status;
                                    // var_dump($Ordres);
                                    if($ressts=="success"){
                                       $orderid=$Ordres->Order_no;
                                      $prostst= Prostatus($orderid);
                                      // var_dump($prostst);
                                      $Dis_Status=$prostst[0]->Dispatch_status;
                                    
                                       echo "<span class=' text-warning' >".$Dis_Status."</span>";

                                    }
                                    else
                                    {
                                         echo "<span class=' text-danger' >Order Failed</span>";
                                    }

                                }                            

                                  ?>
                                 </a>
                                
                            </td>
                        <td><?=$username?></td>
                        <td><?=$phone?></td>
                        <td>
                            <?php if ($paymentmethod!='') {
                                echo $paymentmethod." - ".$paymenttype;
                            }else{ 
                               echo $order['pmode'];
                           }
                           ?>
                                   
                               </td>
                        <td>
                            <?php
                            if($order['cartids_inorder']!=''){
                                                          $show_email_sql = mysqli_query($con1,"select product_name,qty from order_details  where oid='".$order['id']."' ");
                              $products = array();
                            while($ordpro=mysqli_fetch_assoc($show_email_sql)){ 
                                $tproo = array("pro"=>$ordpro['product_name'],
                                "qty" =>$ordpro['qty']       
                                 );
                                array_push($products, $tproo);

                            }
// $products=json_encode($products);

?>
    <textarea name="" class="form-control" id="" cols="30" rows="2"> <?php 
        foreach ($products as $key => $product) {echo $product['pro']." (".$product['qty'].")";echo '&#13;&#10;';
        }
    ?>
    </textarea>    
    <?php }
    else
    {
    echo'<textarea name="" class="form-control" id="" cols="30" rows="2">'.$order['Notes'].'</textarea>';    
    }
    ?>
                        </td>
                        <td><a target="_blank" href="/adminpanel/printadd.php?oid=<?=$order['id']?>" class="btn btn-danger" onclick="printDiv('ox_<?=$order['id']?>')">Print Address</a>
                            <div style="display: none;">
                            <div id="addressbox_<?=$order['id']?>" style="width: 100%">
                                <div style="width: 50%;margin-top:4%;margin-left: 4%;">
                                     <h3 style="margin: 0;padding: 0;">To</h3>
                                <p style="margin: 0;padding: 0;"><?=$username?></p>
                                <p style="margin: 0;padding: 0;"><?=$primary_address?></p>
                                <p style="margin: 0;padding: 0;"><?=$city?> : <?=$pincode?></p>
                                <p style="margin: 0;padding: 0;">Contact :<?=$phone?></p>
                                <br/>
                                <h3 style="margin: 0;padding: 0;">From :-</h3>
                                  <p style="margin: 0;padding: 0;">Allmart Ecommerce LLP</p>
                                <p style="margin: 0;padding: 0;">Allmart Building No. 2</p>
                                <p style="margin: 0;padding: 0;">MHB Colony No. 1, Next to Pancholia School</p>
                                <p style="margin: 0;padding: 0;">Mahavir Nagar, Kandivali West</p>
                                <p style="margin: 0;padding: 0;">Mumbai - 400067, Maharashtra</p>
                                <p style="margin: 0;padding: 0;">Contact: 9892384666</p>
                                    
                                </div>
                            </div>
                            </div>
                        </td>
                        <td><a href="order_details.php?orderid=<?=$order['id']?>" class="btn btn-primary">Details</a> <?php if($order['user_id']=='1' && $order['status']<=1 ){?><br/><a href="EditOrderDetails.php?orderid=<?=$order['id']?>" class="btn btn-danger">Edit</a> <?php } if(1){ ?><br/><a href="DeleteOrder.php?orderid=<?=$order['id']?>" class="btn btn-danger" onclick="return DeleteOrder()">Delete</a> <?php } ?></td>
                        
                    </tr>

                    <?php
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- large modal -->
<div class="modal fade" id="myModalDetail" style="z-index: 99999;" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="card">
            <div class="card-block" id="result_status" style=" overflow: auto;">
              Please Wait Status Will Show Shortly,
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!--<button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                        extend: 'excelHtml5',
                        title: 'Orders Excel',
                        text:'Export to excel'
                        //Columns to export
                        //exportOptions: {
                       //     columns: [0, 1, 2, 3,4,5,6]
                       // }
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

<script>
       $(document).on("click", ".open-DetailDialog", function () {
     var orderid = $(this).data('id');
     
     // alert(orderid);
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "OrderStatusModal.php",  
        data: {orderid:orderid},
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $(".modal-body #result_status").html(response); 
            //alert(response);
        }
     });
    
});
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