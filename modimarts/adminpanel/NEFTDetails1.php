<?php
session_start();
include('config.php');
include('adminaccess.php');
include('Commi_Data.php');
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

    if(isset($_GET['date1'])&& isset($_GET['date2'])){
        $date1=date('Y-m-d',strtotime($_GET['date1']));
        $date2=date('Y-m-d',strtotime($_GET['date2']));
        $view="SELECT * FROM `commission_details` where created_at BETWEEN '".$date1."' AND '".$date2."' AND com_givien='0' Group BY `commission_to`";
$view=mysqli_query($con1,$view);
    }else{
$view="SELECT * FROM `commission_details` WHERE com_givien='0' Group BY `commission_to` ORDER BY `commission_details`.`amount` DESC";
$view=mysqli_query($con1,$view);
}

?>
<div class="row form-group">
    <form action="#" method="get">
    <div class="col-md-4">
        <label>Start Date</label>
      <input type="date" name="date1" value="<?php if(isset($_GET['date1'])){ echo $_GET['date1'];}?>" class="form-control">  
    </div>
    <div class="col-md-4">
        <label>End Date</label>
        <input type="date" name="date2" value="<?php if(isset($_GET['date2'])){ echo $_GET['date2'];}?>"  class="form-control">
    </div>
    <div class="col-md-4">
        <button class="btn btn-danger">Search</button>
    </div>
</div>
</form>
<div class="row">

    <div class="col-md-12">

         <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S. No</th>
                <th>Remit Amount</th> 
                <th>Beneficiary Name</th> 
                <th>Commission will  be transfered in your account due to Commission amount is more than Rs. 100/-</th> 
                <th>Have Bank Account Detail</th> 
                <th>Beneficiary Account No.</th> 
                <th>Beneficiary IFSC Code</th>
                <th>Pan Card</th>                  
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($view as $key => $view_result) {
                                $commission_to=$view_result['commission_to'];
                               $sql= mysqli_query($con,"SELECT * FROM `new_member` WHERE id='".$commission_to."'");
                               $memdata=mysqli_fetch_assoc($sql);

                               $totalAmount=mysqli_fetch_assoc(mysqli_query($con1,"SELECT SUM(amount) as TotalCom FROM `commission_details` WHERE commission_to='".$commission_to."' AND com_givien='0'"));
                               $totalamt=number_format($totalAmount['TotalCom'],2, '.', '');
                                ?>
                        <tr>
                            <td><?=$key+1?></td>    
                            <td><?=number_format($totalAmount['TotalCom'],2)?></td>    
                            <td><?php if($memdata['name']!=''){ ?><?=$memdata['name']?> <?php }else{ ?> SAR<?php } ?></td>
                            <td><?php if($totalamt>100){ ?>Yes<?php }else{ ?> No<?php } ?></td>
                            <td><?php if($memdata['account_num']!=''){ ?>Yes <?php }else{ ?> Required<?php } ?></td>
                            <td> <?php if($commission_to=="SAR"){ echo "0680102000010627";}else{?><?=$memdata['account_num']?> <?php } ?></td>    
                            <td> <?php if($commission_to=="SAR"){ echo "IBKL0000680";}else{?><?=$memdata['ifsc']?> <?php } ?></td>    
                            <td> <?php if($commission_to=="SAR"){ echo "BCJPS5138R";}else{?><?=$memdata['pan']?> <?php } ?></td>    
                               
                              
                            
                        </tr>
                    <?php
                    }
                    ?>
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