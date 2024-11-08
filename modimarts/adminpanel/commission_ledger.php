<?php
session_start();
include('config.php');
include('adminaccess.php');
include('Commi_Data.php');

// ini_set('display_errors', 1);

// ini_set('display_startup_errors', 1);

// error_reporting(E_ALL);
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

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>


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
    <form action="#" method="post">
    <div class="row form-group">
    <div class="col-md-3">
        <label>Status</label>
        <select name="commission_to" class="form-control" id="Status" >
            <option value="">ALL</option>
            <?php 
            $view=mysqli_query($con1,"SELECT * FROM `commission_transaction` group by commission_to");
             foreach ($view as $key => $value) {

                $sql= mysqli_query($con,"SELECT name FROM `new_member` WHERE id='".$value['commission_to']."'");
                               $memdata=mysqli_fetch_assoc($sql);
               if($memdata['name']!=''){
               $userName= $memdata['name'];
               }
               else
               {
                 $userName= "SAR";
               }
                 ?>
                 <option <?php if(isset($_POST['commission_to'])){ if($_POST['commission_to']==$value['commission_to']){ echo "selected";}} ?> value="<?=$value['commission_to']?>"><?=$userName?></option>
                 <?php
             }
             ?>
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-danger" style="margin-top: 26px;" >Search</button>
    </div>
</div>
</form>
    <?php 
    if($_POST['commission_to']!=''){
$view1="SELECT * FROM `commission_transaction` WHERE commission_to='".$_POST['commission_to']."' AND txn_type<>'1' ";
$view=mysqli_query($con1,$view1);
    }
    else
    {
$view1="SELECT * FROM `commission_transaction` ORDER BY `commission_transaction`.`id` ASC";
$view=mysqli_query($con1,$view1);
}

?>
<div class="row">
  
    <div class="col-md-12">

         <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S.no</th>
                <th>Date</th>
                <th>From</th>
                <th>Credit</th>
                <th>Debit</th>                              
                <th>Balance</th>                              
                <th>Name</th> 
                <th>Commission Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalAmount=0;
               
                
                    foreach ($view as $key => $view_result) {
                   
                          
                          
                     
                     

    $id=$view_result['id'];
    $amount=$view_result['amount'];
    $order_id=$view_result['order_id'];
    $commission_to=$view_result['commission_to'];
    $payment_id=$view_result['payment_id'];
    $created_at=$view_result['created_at'];
    $txn_type=$view_result['txn_type'];
    $bill_amount=$view_result['bill_amount'];
    $after_amt=$view_result['after_amt'];
    $totalAmount=$totalAmount+$amount;
    

    if ($order_id!='')
     {
       $txn_id=$order_id;
    }
    else
    {
      $txn_id=$payment_id;  
    }
    $credit=0;
    $debit=0;

    if ($txn_type==0) {
        $txntype="<span class='text-warning'>Pending</span>";
        $credit=$amount;
       
    }
    if ($txn_type==1) {
        $txntype="<span class='text-info'>Processing</span>";
    }
    if ($txn_type==2) {
        $txntype="<span class='text-success'>Completed</span>";
        $debit=$amount;
        
    }

    if($order_id!='')
    {
    $data=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='".$order_id."'"));
    $usertype="Commi From - ". $data['name'];
    }
    else
    {
         $usertype="Paid";
    }
    ?>
    <tr>
        <td><?=$key+1?></td>
        <td><?=date('d-M-Y', strtotime($created_at))?></td> 
        <td><?=$usertype?></td>   
    <td><b class="text-success"><?=number_format($credit,2)?></b>
         </td>
         <td><b class="text-danger"><?=number_format($debit,2)?></b></td>
            <td><?=$after_amt?></td>
        <td><?php
        $sql= mysqli_query($con,"SELECT name FROM `new_member` WHERE id='".$commission_to."'");
                               $memdata=mysqli_fetch_assoc($sql);
               if($memdata['name']!=''){                
         ?>

             <?=$memdata['name']?>
         <?php }else{
            echo "SAR";
         } ?>
         </td>  
    <td><a class="btn btn-danger" href="">Details</a></td>
    </tr>
<?php
$r++; 


}
 ?>
<!--  <tr>
     <td></td>
     <td></td>
     <td></td>
     <td><?=$totalAmount?></td>
     <td></td>
     <td></td>
     <td></td>
 </tr> -->
        
                
            </tbody>
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