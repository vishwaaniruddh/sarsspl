<?php
session_start();
include('config.php');
include('adminaccess.php');
include('Commi_Data.php');
$order_id = $_GET['order_id'];
$prodid = $_GET['proid'];
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
$totalComm=0;
?>
<div class="row">
    <div class="col-md-12">

         <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered table-responsive" style="width:100%">
            <thead>
                <tr>
                <th>S.no</th>
                <th>Level</th>
                <th>Date</th>
                <th>Bill No</th>               
                <th>Bill Amt</th>
                <th>Amount</th>              
                <th>Customer Name</th>
                <th>User Type</th>
                <th>Franchise Name</th>
                <th>Country</th>
                <th>Zone</th>
                <th>State</th>
                <th>Div</th>
                <th>Dis</th>
                <th>tal</th>
                <th>Pin</th>
                <th>Village</th>
                </tr>
            </thead>
             <tbody>
                <?php 
                                $sqlview1="SELECT * FROM `commission_details` WHERE `order_id` ='".$order_id."' AND order_id<>0  AND commission_to='SAR'";
$gtview1=mysqli_query($con1,$sqlview1);

$incount=mysqli_num_rows($gtview1);
$inactive=1;

if($incount){

$view_result = mysqli_fetch_assoc($gtview1);


$orddata=json_decode($view_result['promotion']);
 $level=$view_result['level'];

            // $ProName=urldecode($orddata[$prodid]->ProName);
            // $bill_amount=$orddata[$prodid]->Amount*$orddata[$prodid]->Qty;
            // $Commission=$orddata[$prodid]->Commission;
            // $CommissionAmount=$orddata[$prodid]->CommissionAmount;
            // $introcom=number_format($Commission/2,2);
            // $introcomamt=number_format($CommissionAmount/2,2);
            // $amount= getComAmount($order_id,$CommissionAmount,'1');

     $bill_amount=$view_result['bill_amount'];
    $amount=$view_result['amount'];
    $order_id=$view_result['order_id'];
    $commission_to=$view_result['commission_to'];
    $created_at=$view_result['created_at'];
    $txn_id=$view_result['txn_id'];
   
    $is_introducer=$view_result['is_introducer']; 
    $totalComm=$totalComm+$amount;  
    ?>
    <tr>
        <td>1</td>
        <td>Software</td>
        <td><?=date('d-M-Y',strtotime($created_at))?></td>  
    
    <td>
        <?php 
         $franchisedata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT is_franchise FROM `Order_ent` WHERE `id`='".$order_id."'  "));
         ?>
             <?=$txn_id?>
         </td>
         <td align="right"><?=number_format($bill_amount,2)?></td>
        <td align="right"><?=number_format($amount,2)?></td>
        <td align="right"><?php
        $data=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='".$order_id."'"));
         ?>
             <?=$data['name']?>
         </td>
          <td><?php if($franchisedata['is_franchise']==1){ echo "Franchise";} else { echo "Customer";}?></td>
        
    <td><?php $username=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM new_member WHERE id='".$commission_to."'"));
?>
        <?php if($username['name']!=''){ echo $username['name']."  - ";
        $level=$username['level_id'];
        $country=$username['country'];
        $zone=$username['zone'];
        $state=$username['state'];
        $div=$username['division'];
        $dist=$username['district'];
        $tal=$username['taluka'];
        $pin=$username['pincode'];
        $village=$username['village'];

        if($level==1){ echo"Country";}
        elseif ($level==2) { echo"Zone";} 
        elseif ($level==3) { echo"State";} 
        elseif ($level==4) { echo"Division";} 
        elseif ($level==5) { echo"District";} 
        elseif ($level==6) { echo"Taluka";} 
        elseif ($level==7) { echo"Pincode";} 
        elseif ($level==8) { echo"Village";}  } else {
        $level="Software";
         $country=0;
        $zone=0;
        $state=0;
        $div=0;
        $dist=0;
        $tal=0;
        $pin=0;
        $village=0;
         echo "SAR";

     }
 ?></td>

    <td> India </td>   
    <td><?php if($zone!=0){ echo get_zone($zone);}?> </td>   
    <td> <?php if($state!=0){ echo get_state($state);}?> </td>   
    <td><?php if($div!=0){ echo get_division($div);}?> </td>   
    <td><?php if($dist!=0){ echo get_district($dist);}?> </td>   
    <td><?php if($tal!=0){ echo get_taluka($tal);}?> </td>   
    <td><?php if($pin!=0){ echo get_pincode($pin);}?> </td>    
    <td><?php if($s==8){?><?=$count?> <?php } ?></td>    
    </tr>
     <?php
     
    }  




              

                  $getview="SELECT * FROM `commission_details` WHERE `order_id` ='".$order_id."' AND order_id<>0  ORDER BY `commission_details`.`id` DESC";
                  $view=mysqli_query($con1,$getview);


        

                $s=1;
    for ($i=1; $i < 9 ; $i++) { 

          $pincode=GetUserPincode($order_id);
                    $pin=get_pincode_id($pincode);
                    $tal=GettalukaBypincode($pin);
                    $dis=GetdistrictBytaluka($tal);
                    $div=GetdivisionBydistrict($dis);
                    $state=GetStateBydivision($div);
                    $zone=GetzoneByState($state);
                    $country="1";

                    if($s==0)
                    {
                       $memid= "SAR";
                    }

                    if($s==1)
                    {
                       $memid= getMemberId('id','country',$country,$s);
                    }

                    if($s==2)
                    {
                 $memid= getMemberId('id','zone',$zone,$s);
                    }

                    if($s==3)
                    {
              $memid= getMemberId('id','state',$state,$s);
                    }

                    if($s==4)
                    {
              $memid= getMemberId('id','division',$div,$s);
                    }

                    if($s==5)
                    {
              $memid= getMemberId('id','district',$dis,$s);
                    }

                    if($s==6)
                    {
              $memid= getMemberId('id','taluka',$tal,$s);
                    }

                    if($s==7)
                    {
              $memid= getMemberId('id','pincode',$pin,$s);
                    }

        $sqlview="SELECT * FROM `commission_details` WHERE `order_id` ='".$order_id."' AND order_id<>0  AND level='".$s."'  ORDER BY `commission_details`.`id` DESC";
$gtview=mysqli_query($con1,$sqlview);

$count=mysqli_num_rows($gtview);

if($count){

$view_result = mysqli_fetch_assoc($gtview);


$orddata=json_decode($view_result['promotion']);
 $level=$view_result['level'];
 // echo "<pre>";print_r($level);echo"</pre>";

            // $ProName=urldecode($orddata[$prodid]->ProName);
            // $bill_amount=$orddata[$prodid]->Amount*$orddata[$prodid]->Qty;
            // $Commission=$orddata[$prodid]->Commission;
            // $CommissionAmount=$orddata[$prodid]->CommissionAmount;
            // $introcom=number_format($Commission/2,2);
            // $introcomamt=number_format($CommissionAmount/2,2);
            // $amount= getComAmount($order_id,$CommissionAmount,$level);


    $bill_amount=$view_result['bill_amount'];
    $amount=$view_result['amount'];
    $order_id=$view_result['order_id'];
    $commission_to=$view_result['commission_to'];
    $created_at=$view_result['created_at'];
    $txn_id=$view_result['txn_id'];
   
    $is_introducer=$view_result['is_introducer'];
    $totalComm=$totalComm+$amount;  

    if($is_introducer){ $inactive=0;}
    

    // get All details first

        $pincode=GetUserPincode($order_id);
        // var_dump($pincode);
        // echo "<br/>";
        // var_dump($order_id);

        $pin=get_pincode_id($pincode);
        $tal=GettalukaBypincode($pin);
        $dis=GetdistrictBytaluka($tal);
        $div=GetdivisionBydistrict($dis);
        $state=GetStateBydivision($div);
        $zone=GetzoneByState($state);
        $country="1"; 

        //echo "<pre>";print_r($dis);echo "</pre>"; 


    
    ?>
    <tr <?php if($is_introducer){ ?>style="background: yellow;" <?php }?>>
        <td><?=$i+1?></td>
        <td><?=$i?></td>
        <td><?=date('d-M-Y',strtotime($created_at))?></td>  
    
    <td>
        <?php 
         $franchisedata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT is_franchise FROM `Order_ent` WHERE `id`='".$order_id."'  "));
         ?>
             <?=$txn_id?>
         </td>
         <td align="right"><?=number_format($bill_amount,2)?></td>
        <td align="right"><?=number_format($amount,2)?></td>
        <td align="right"><?php
        $data=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='".$order_id."'"));
         ?>
             <?=$data['name']?>
         </td>
          <td><?php if($franchisedata['is_franchise']==1){ echo "Franchise";} else { echo "Customer";}?></td>
        
    <td><?php $username=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM new_member WHERE id='".$commission_to."'")); ?>
        <?php if($username['name']!=''){ if($s==8 && $count>0){
             ?>
            <a class="btn btn-danger btn-sm" href="getvillageCommisionDeatils.php?order_id=<?=$order_id?>">Click for details</a>
            <?php
            $level=$username['level_id'];
            $country=$username['country'];
            $zone=$username['zone'];
            $state=$username['state'];
            $div=$username['division'];
            $dist=$username['district'];
            $tal=$username['taluka'];
            $pin=$username['pincode'];
            $village=$username['village'];
        }
            else {
           
   
         echo $username['name']."  - ";
        $level=$username['level_id'];
        $country=$username['country'];
        $zone=$username['zone'];
        $state=$username['state'];
        $div=$username['division'];
        $dist=$username['district'];
        $tal=$username['taluka'];
        $pin=$username['pincode'];
        $village=$username['village'];

        if($level==1){ echo"Country";}
        elseif ($level==2) { echo"Zone";} 
        elseif ($level==3) { echo"State";} 
        elseif ($level==4) { echo"Division";} 
        elseif ($level==5) { echo"District";} 
        elseif ($level==6) { echo"Taluka";} 
        elseif ($level==7) { echo"Pincode";} 
        elseif ($level==8) { echo"Village";}
        }
         } else {
        $level="Software";
         $country=0;
        $zone=0;
        $state=0;
        $div=0;
        $dist=0;
        $tal=0;
        $pin=0;
        $village=0;
         echo "SAR";

     }
 ?>
<?php if($is_introducer){ ?> (Introducer) <?php }?></td>

    <td> India </td>   
    <td><?php if($zone!=0){ echo get_zone($zone);}?> </td>   
    <td> <?php if($state!=0){ echo get_state($state);}?> </td>   
    <td><?php if($div!=0){ echo get_division($div);}?> </td>   
    <td><?php if($dist!=0){ echo get_district($dist);}?> </td>   
    <td><?php if($tal!=0){ echo get_taluka($tal);}?> </td>   
    <td><?php if($pin!=0){ echo get_pincode($pin);}?> </td>    
    <td><?php if($s==8){?><?=$count?> <?php } ?></td>    
    </tr>
     <?php
     
    }

else
{
    ?>
    <tr>
        <td><?=$i+1?></td>
        <td><?=$i?></td>
        
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td> India </td>   
    <td><?php if($zone!=0 && $s>1){ echo get_zone($zone);}?> </td>   
    <td><?php if($state!=0 && $s>2){ echo get_state($state);}?> </td>   
    <td><?php if($div!=0 && $s>3){ echo get_division($div);}?> </td>   
    <td><?php if($dis!=0 && $s>4){ echo get_district($dis);}?> </td>   
    <td><?php if($tal!=0 && $s>5){ echo get_taluka($tal);}?> </td>   
    <td><?php if($pincode!=0 && $s>6){ echo get_pincode($pin);}?> </td>   
    <td><?php if($s==8){?><?=$count?> <?php } ?></td>    
    </tr>
    <?
}
$s++;
}
// }

if($inactive){

                $sqlview="SELECT * FROM `commission_details` WHERE `order_id` ='".$order_id."' AND order_id<>0  AND is_introducer='1' ORDER BY `commission_details`.`id` DESC";
$gtview=mysqli_query($con1,$sqlview);

$incount=mysqli_num_rows($gtview);

if($incount){

$view_result = mysqli_fetch_assoc($gtview);


$orddata=json_decode($view_result['promotion']);
 $level=$view_result['level'];

            // $ProName=urldecode($orddata[$prodid]->ProName);
            // $bill_amount=$orddata[$prodid]->Amount*$orddata[$prodid]->Qty;
            // $Commission=$orddata[$prodid]->Commission;
            // $CommissionAmount=$orddata[$prodid]->CommissionAmount;
            // $introcom=number_format($Commission/2,2);
            // $introcomamt=number_format($CommissionAmount/2,2, '.', '');
            // $amount= getComAmount($order_id,$CommissionAmount,$level);
            // $amount= $introcomamt;

    $bill_amount=$view_result['bill_amount'];
    $amount=$view_result['amount'];
    $order_id=$view_result['order_id'];
    $commission_to=$view_result['commission_to'];
    $created_at=$view_result['created_at'];
    $txn_id=$view_result['txn_id'];
   
    $is_introducer=$view_result['is_introducer'];   
    $totalComm=$totalComm+$amount;   
    ?>
    <tr style="background: yellow;" >
        <td><?=$i+1?></td>
        <td><?=$i?></td>
        <td><?=date('d-M-Y',strtotime($created_at))?></td>  
    
    <td>
        <?php 
         $franchisedata=mysqli_fetch_assoc(mysqli_query($con1,"SELECT is_franchise FROM `Order_ent` WHERE `id`='".$order_id."'  "));
         ?>
             <?=$txn_id?>
         </td>
         <td align="right"><?=number_format($bill_amount,2)?></td>
        <td align="right"><?=number_format($amount,2)?></td>
        <td align="right"><?php
        $data=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='".$order_id."'"));
         ?>
             <?=$data['name']?>
         </td>
          <td><?php if($franchisedata['is_franchise']==1){ echo "Franchise";} else { echo "Customer";}?></td>
        
    <td><?php $username=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM new_member WHERE id='".$commission_to."'")); ?>
        <?php if($username['name']!=''){ echo $username['name']."  - ";
        $level=$username['level_id'];
        $country=$username['country'];
        $zone=$username['zone'];
        $state=$username['state'];
        $div=$username['division'];
        $dist=$username['district'];
        $tal=$username['taluka'];
        $pin=$username['pincode'];
        $village=$username['village'];

        if($level==1){ echo"Country";}
        elseif ($level==2) { echo"Zone";} 
        elseif ($level==3) { echo"State";} 
        elseif ($level==4) { echo"Division";} 
        elseif ($level==5) { echo"District";} 
        elseif ($level==6) { echo"Taluka";} 
        elseif ($level==7) { echo"Pincode";} 
        elseif ($level==8) { echo"Village";}  } else {
        $level="Software";
         $country=0;
        $zone=0;
        $state=0;
        $div=0;
        $dist=0;
        $tal=0;
        $pin=0;
        $village=0;
         echo "SAR";

     }
 ?> (Introducer)</td>

    <td> India </td>   
    <td><?php if($zone!=0){ echo get_zone($zone);}?> </td>   
    <td> <?php if($state!=0){ echo get_state($state);}?> </td>   
    <td><?php if($div!=0){ echo get_division($div);}?> </td>   
    <td><?php if($dist!=0){ echo get_district($dist);}?> </td>   
    <td><?php if($tal!=0){ echo get_taluka($tal);}?> </td>   
    <td><?php if($pin!=0){ echo get_pincode($pin);}?> </td>    
    <td></td>    
    </tr>
     <?php
     
    }
}
     ?>
     <tfoot>
         <tr>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td align="right"><?=number_format($bill_amount,2)?></td>
             <td align="right"><?=number_format($totalComm,2)?></td>
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
         </tr>
     </tfoot>
        
                
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