<?php
session_start();
include('config.php');
include('adminaccess.php');
include('Commi_Data.php');
$order_id = $_GET['order_id'];
$id = $_GET['id'];
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

<!--  jquery core -->   
<!-- <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> -->

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
            script.src = "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js";
            document.getElementsByTagName('head')[0].appendChild(script);
        }
        </script>


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
    <?php 
$view="SELECT * FROM `commission_details` WHERE order_id='".$order_id."' limit 0,1";
$view=mysqli_query($con1,$view);
?>
<div class="row">
    <div class="col-md-12">

         <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S.no</th>
                <th>Bill NO</th>
                 <th>Product Name</th>  
                <th>Bill Amt</th>
                <th>7 Level management comm (%)</th>  
                <th>7 Level Management Comm (Amt)</th> 
                <th>Introducer Comm for Dir Customer (%)</th>
                <th>Introducer Comm for Dir Customer (Amt)</th>
                <th>Comm Details</th>
                </tr>
            </thead>
             <tbody>
                <?php
                $view_result=mysqli_fetch_assoc($view);
        $orddata=json_decode($view_result['promotion']);
       // $orderdetails=explode(',', $orddata);
       // var_dump($orddata);
   $franchisedata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT is_franchise FROM `Order_ent` WHERE `id`='".$order_id."'"));


        $totalComm=0;
        $totalBill=0;
        $totalref=0;
        for ($s=0; $s <count($orddata) ; $s++) { 

            $order_id=$view_result['order_id'];
            $ordlvl=$view_result['level'];

            $ProName=urldecode($orddata[$s]->ProName);
            $billamt=$orddata[$s]->Amount*$orddata[$s]->Qty;
            $Commission=$orddata[$s]->Commission;
            $CommissionAmount=$orddata[$s]->CommissionAmount;
            $RefCommission=$orddata[$s]->RefCommission;
            $RefAmount=$orddata[$s]->RefAmount;

           if($franchisedata['is_franchise']==1){
            $introcom=0;
            $introcomamt=0.00;
        } else {
            $introcom=number_format($RefCommission,2);
            $introcomamt=number_format($RefAmount,2);
        }
            // $introcom=number_format($Commission/2,2);
            // $introcomamt=number_format($CommissionAmount/2,2);
            // $commiAMT= getComAmount($order_id,$CommissionAmount,$ordlvl);
            $totalComm=$totalComm+$CommissionAmount;
            $totalBill=$totalBill+$billamt;
            $totalref=$totalref+$introcomamt;
           
         ?>
         <tr>
             <td align="right"><?=$s+1?></td>
             <td align="right"><?=$order_id?></td>
             <td ><?=$ProName?></td>
             <td align="right"><?=number_format($billamt,2)?></td>
             <td align="right"> <?=number_format($Commission,1)?> %</td>
             <td align="right"><?=number_format($CommissionAmount,2)?></td>
             
             <td align="right"><?=$introcom?></td>
             <td align="right"><?=$introcomamt?></td>
            <td></td>
         </tr>
    
   
     <?php
    
    }

     ?>
 </tbody>
 <tfoot>
     <tr>
         <td></td>
         <td></td>
         <td></td>
         <td align="right"><?=number_format($totalBill,2)?></td>
         <td></td>
         <td align="right"><?=number_format($totalComm,2)?></td>
         <td></td>
         <td align="right"><?=number_format($totalref,2)?></td>
         <td><a class="btn btn-danger" href="/adminpanel/GetCommisionDetails.php?order_id=<?=$order_id?>">Details</a></td>
     </tr>
        
                
           </tfoot>
        </table>
    </div>
</div>

    </div>
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

<!-- end footer -->



</html>