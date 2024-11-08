<?php session_start();
include ('config.php');



function get_members_data($id, $parameter)
{

    global $conn;

    $sql = mysqli_query($conn, "select $parameter from Members where Static_LeadID='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result[$parameter];

}



function get_voucher_name($level_id, $voucher_id)
{
    global $conn;

    $sql = mysqli_query($conn, "SELECT V_type_id,level_id,RIGHT(serialNumber,2) as voucher_id,serviceName FROM voucher_Type where level_id='" . $level_id . "' and RIGHT(serialNumber,2)='" . $voucher_id . "'");

    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['serviceName'];

}







?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include ("header.php") ?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous"></script>
    <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
    $( function() {
    $( "#datepicker2" ).datepicker();
  } );
  
          function check_all(source) {
    var checkboxes = document.querySelectorAll('.mem_vouchers');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}


// function show_alert() {
//   if(confirm("Do you really want to do this?")) {
    
//   this.form.submit();
      
//   }else{
//     return false;    
//   }

// }




  </script>
  
  
</head>
<body class="sidebar-pinned">


<?php include ("vertical_menu.php");

$Mainid = $_GET['id'];
if ($Mainid != "") {


    $QuryGetMem = mysqli_query($conn, "select * from Members where Static_LeadID='" . $Mainid . "'");
    $fetchMem = mysqli_fetch_array($QuryGetMem);

}
?>
<main class="admin-main">
  <?php include ('navbar.php');
  $id = $_GET['id'];
  ?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span>        Membership Renewals
                                
                                <a class="btn btn-danger" href="member_view.php?id=<?php echo $id; ?>">View Member Info</a>
                                
                                

                        </h4>
                    </div>
                </div>
            </div>
        </div>


        <div class="container  pull-up">
                    
            <form onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}" id="renew_form" action="process_only_revalidation.php" method="post">
                
                
                <input type="hidden" name="memberid" value="<?php echo get_members_data($_GET['id'], 'GenerateMember_Id'); ?>">
                
                <input type="hidden" name="Static_LeadID" value="<?php echo $_GET['id']; ?>">
                
            <div class="row">
                
                
                    
                
                <div class="col-12">
                    <div class="card">
                        
                        
                        <div class="card-body">
                            
                        
                        
               <h2>Renewal Details </h2>   

                        <?php
                        $QryStatic_LeadID = mysqli_query($conn, "SELECT * FROM `Members` where Static_LeadID='" . $_GET['id'] . "' ");
                        $fetchStatic_LeadID = mysqli_fetch_array($QryStatic_LeadID);



                        ?>
                                 
                                 
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="renewalPromotionalCheck1" name="renewalPromotionalCheck1" checked>
                                    <label class="custom-control-label" for="renewalPromotionalCheck1">Issue Renewal Promotional Certificate</label> 
                                </div>
                                
                                
                           
                           
                           
                           <div id="vouchers">
                               
                               <br>
                               <br>
                                <h2>Voucher Revalidation</h2>
                                
                                
                                <div class="form-group">
                                    <label>Select date from which to revalidate</label>
                                    <input type="text" name="from_date" id="datepicker2" class="form-control" value="<?php echo date("Y/m/d") ?>">
                                </div>

                                    
                                            
<div class="form-group">
        <select class="form-control" name="extension" required>
                    <option value=""> Select </option>
                    <?php
                    $sql = mysqli_query($conn, "select * from extension where status='1'");
                    $i = 1;
                    while ($sql_result = mysqli_fetch_assoc($sql)) { ?>
                                <option value="<?php echo $sql_result['id']; ?>">
                                    <?php echo $sql_result['extension'] . ' Months'; ?>
                                </option>
                                <?php $i++;
                    } ?>
                        </select>
</div>            
    
    
    
                                    
                                <input type="checkbox" onclick="check_all(this);" /> Select All <br/>
                                <br>
                                <br>
                                


<?
$member_sql = mysqli_query($conn, "select * from Members where Static_LeadID='" . $id . "'");
$member_sql_result = mysqli_fetch_assoc($member_sql);


// var_dump($member_sql_result);
$booklet_series = $member_sql_result['booklet_Series'];
$name = $member_sql_result['Primary_nameOnTheCard'];
$expiry = $member_sql_result['ExpiryDate'];
$date = strtotime($expiry);
$expdate = date('M Y', $date);



if ($booklet_series > 0) {
    $voucher_sql = mysqli_query($conn, "select * from BarcodeScan where Voucher_id like '%" . $booklet_series . "%' and is_extended=0 and Available=0");
    while ($voucher_sql_result = mysqli_fetch_assoc($voucher_sql)) {

        $id = $voucher_sql_result['id'];
        $voucher = $voucher_sql_result['Voucher_id'];
        $array = array_map('intval', str_split($voucher));

        $level_id = $array[1];
        $voucher_name_id = substr($voucher, -2);
        $status = $voucher_sql_result['Available'];

        if ($status == 1) {
            // echo '<del>';
            // echo get_voucher_name($level_id,$voucher_name_id); 
            // echo '</del>';        
        } else { ?>
                      <input class="mem_vouchers" type="checkbox" name="vouchers[]" value="<?php echo $voucher; ?>"
                      >
            <?php echo $voucher . ' - ' . get_voucher_name($level_id, $voucher_name_id);
            echo '<br>';
        }


    }
}



?>



                               
                           </div>     


                                 <br>
                                 <br><br>
                                 
                                 <input type="submit" name="submit" id="submit" class="btn btn-success" value="Renew">
                                 
                                 
                                 </div>
                                 


                    </div>
                </div>
                
           
                
                
            </div>
                 </form>
        </div>
    </section>

</main>


<script>
    
    
    $("document").ready(function(){
        

    
$("#renewalPromotionalCheck1").on('change',function(){

if ($("#renewalPromotionalCheck1").prop('checked')) {
    $('#vouchers').show();
    
}
else{
    $('#vouchers').hide();

}    
});


        


    
        $("#member_type").on('change',function(){
           
            var membership_type = $("#member_type").val();
            
            $.ajax({
                type: "POST",
                url: 'get_membership_fees.php',
                data: 'membership_type='+membership_type,
                
                success:function(msg) {
                    
                $("#MembershipDetails_Fee").val(msg);
                
                 var memberfees = $("#MembershipDetails_Fee").val();
            var per_discount = $("#MembershipDts_Discount").val();
            
            var dis = (memberfees*per_discount)/100;
            var new_net_pay = memberfees - dis;
            
            $("#MembershipDts_NetPayment").val(new_net_pay);
            
            var gst = new_net_pay * 0.18 ; 
            
            $("#MembershipDts_GST").val(gst);
            
            var gross_total = new_net_pay + gst;
            
            $("#MembershipDts_GrossTotal").val(gross_total);
                    
                }
             });
            
            
           
        
        });
        
        
        
        $("#MembershipDts_Discount").on('change',function(){
            
            var memberfees = $("#MembershipDetails_Fee").val();
            var per_discount = $("#MembershipDts_Discount").val();
            
            var dis = (memberfees*per_discount)/100;
            var new_net_pay = memberfees - dis;
            
            $("#MembershipDts_NetPayment").val(new_net_pay);
            
            var gst = new_net_pay * 0.18 ; 
            
            $("#MembershipDts_GST").val(gst);
            
            var gross_total = new_net_pay + gst;
            
            $("#MembershipDts_GrossTotal").val(gross_total);
        

        });
        
            var memberfees = $("#MembershipDetails_Fee").val();
            var per_discount = $("#MembershipDts_Discount").val();
            
            var dis = (memberfees*per_discount)/100;
            var new_net_pay = memberfees - dis;
            
            $("#MembershipDts_NetPayment").val(new_net_pay);
            
            var gst = new_net_pay * 0.18 ; 
            
            $("#MembershipDts_GST").val(gst);
            
            var gross_total = new_net_pay + gst;
            
            $("#MembershipDts_GrossTotal").val(gross_total);
        
       
       
       $('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});


        
    });
</script>



<?php include ('belowScript.php'); ?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>