<?php session_start(); ?>
<?php include("config.php");


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


function get_voucher_name($level_id,$voucher_id){
    global $conn;
    
    $sql = mysqli_query($conn,"SELECT V_type_id,level_id,RIGHT(serialNumber,2) as voucher_id,serviceName FROM voucher_Type where level_id='".$level_id."' and RIGHT(serialNumber,2)='".$voucher_id."'");
    
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['serviceName'];
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<!--<link rel="stylesheet" href="http://www.allmart.world/franchise/css/style.css">-->
    <style>
        .expire,.expired{
            background:#faebd7;
        }
        .about_to_expire{
            background:#FFC107;
            color:white;
        }
        .about_to_expired{
            background:#FFC107;
        }
        
        .about_to_expired,.expired{
            height: 25px;
            width: 25px;
            margin: auto 1%;
            /*border-radius: 20px;*/
            
        }
        .cust_content{
            display:flex;
            /*justify-content:center;*/
        }
        select{
                width: 50% !important;
                margin: auto 1%;
        }
        [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: inherit;
    /*left: -9999px;*/
     opacity: 1; 
}
    </style>
    
    
    <script>
                  function check_all(source) {
    var checkboxes = document.querySelectorAll('.mem_vouchers');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
    </script>
</head>
<body class="sidebar-pinned">


<?php include("vertical_menu.php"); 

?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> 
                                Membership Extension
                                
                                   <?
                                   

                                $id = $_GET['id']; 
                                
                                if(isset($_POST['submit'])){
                                    unset($_POST['submit']);


$member_info = mysqli_query($conn,"select * from Members where Static_LeadID= '".$id."'");
$member_info_result = mysqli_fetch_assoc($member_info);
$mem_pre_expiry = $member_info_result['ExpiryDate'];
$booklet = $member_info_result['booklet_Series'];


                                $ext_id = $_POST['extension'];
                                $get_ext_sql = mysqli_query($conn,"select * from extension where id='".$ext_id."'");
                                
                                $get_ext_sql_result = mysqli_fetch_assoc($get_ext_sql);
                                
                                $get_ext = $get_ext_sql_result['extension'];
                                
                                $payment_date = $_POST['payment_date'];
                                if(isset($_POST['vouchers']))
                                $vchrs=$_POST['vouchers'];


$ymd = date("Y-m-d");

// echo $payment_date;
// $ymd = strtotime($payment_date);
   $date = date("d",strtotime($payment_date));

$extra = $get_ext+1;

// if($date>25){

//     $end_date = date('Y-m-d', strtotime('+'.$extra.' months'));
//     $expiry_date = date("Y-m-t", strtotime($end_date));
// }
// else{
    $end_date = date('Y-m-d', strtotime($payment_date.'+'.$get_ext.' months'));
    $expiry_date = date("Y-m-t", strtotime($end_date));
// }


 $update_sql = "update Members set ExpiryDate='".$expiry_date."' where Static_LeadID='".$id."'";


// return ; 

if(mysqli_query($conn,$update_sql)){ 
    if(isset($vchrs)){
foreach ($vchrs as &$value) {
    $vchsql="update BarcodeScan set start_date='".$payment_date."',is_extended=1 where Voucher_id='".$value."'";
    mysqli_query($conn,$vchsql);
}
unset($value);
}



// mysqli_query($conn,"insert into Extension_history(member_id,new_booklet_series,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('".$id."','".$vchrs[0]."','','".$mem_pre_expiry."','".$expiry_date."','".$get_ext."','".$ymd."','EX')");


    mysqli_query($conn,"insert into Extension_history(member_id,old_booklet_series,expiry_date,extended_date,duration,created_at,extention_type) values('".$id."','".$booklet."','".$mem_pre_expiry."','".$expiry_date."','".$get_ext."','".$ymd."','EX')");
    
    
include('extend_mail.php');

//   return;

?>
   

   <script>
   alert('Expiry Extended Succesfully !');
//   window.location.href="extension.php";
   </script> 
<?php }
else{ ?>
    
    <script>
          alert('Expiry Extended Error !');
        //   window.location.href="extension.php";
   </script>
   
<?php } } ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card">
        <div class="card-body">
            
<form onSubmit="if(!confirm('Is the form filled out correctly?')){return false;}"  action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $id;?>" method="post">



<?
$member_sql = mysqli_query($conn,"select * from Members where Static_LeadID='".$id."'");
$member_sql_result = mysqli_fetch_assoc($member_sql);

$booklet_series = $member_sql_result['booklet_Series'];
$name = $member_sql_result['Primary_nameOnTheCard'];
$expiry = $member_sql_result['ExpiryDate'];
$date = strtotime($expiry); 
$expdate=date('M Y', $date);


        
?>


            
            

        <br>
        <br>
        
        <?
    //    $get_sql = mysqli_query($conn,"select * from Members where Static_LeadID='".$id."'");
        
   //     $get_sql_result = mysqli_fetch_assoc($get_sql);
        
      
        ?>
        
        <h4>Membership Extension for - <u> <span style="color:red;"> <?php echo $booklet_series ; ?></span></u></h4>
        <h4>Renew Membership of  <span style="color:red;"> <?php echo $name; ?></span></h4>
        <h5>Expiry Date  : <span style="color:red;"><?php echo $expdate; ?></span></h5>
        <hr>                 

        <p> <u>From date > Select Months > Extend</u>  </p>

        
        

        



<div class="form-group">
    <label>Select Date</label>
            <input type="text" data-date-format='yyyy-mm-dd' name="payment_date" id="datepicker" value="<?php echo $expiry; ?>" class="form-control" placeholder="Select Date">
</div>


            
        <h6 style="margin: 3% auto;">Please Select The Renewal Months </h6>
            
<div class="form-group">
        <select class="form-control" name="extension" required>
                    <option value=""> Select </option>
                    <?php       
                        $sql = mysqli_query($conn,"select * from extension where status='1'");
                        $i=1;
                        while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                            <option value="<?php echo $sql_result['id'];?>">
                                <?php echo $sql_result['extension'].' Months';?>
                            </option>
                            <?php $i++; } ?>
                        </select>
</div>            
    
                        
                  
                

<hr>
<div id="vouchers">
<h2>Select Vouchers To Extend</h2>


                                <input type="checkbox" onclick="check_all(this);" /> Select All <br/>
                                
<?


$voucher_sql = mysqli_query($conn,"select * from BarcodeScan where Voucher_id like '%".$booklet_series."%' and is_extended=0 and Available=0");



while($voucher_sql_result = mysqli_fetch_assoc($voucher_sql)){
    
    $id = $voucher_sql_result['id'];
     $voucher = $voucher_sql_result['Voucher_id'];
    $array  = array_map('intval', str_split($voucher));
    
    $level_id = $array[1];
    if($level_id==4){
        $level=2;
    }elseif($level_id==2){
        $level=1;
    }
    $voucher_name_id = substr($voucher, -2);
    $status = $voucher_sql_result['Available'];

    if($status==1){
    // echo '<del>';
    // echo get_voucher_name($level_id,$voucher_name_id); 
    // echo '</del>';        
    }
    else { ?>
          <input class="mem_vouchers" type="checkbox" name="vouchers[]" value="<?php echo $voucher;?>"
          >
<?php        echo $voucher .' - '.get_voucher_name($level,$voucher_name_id);
    echo '<br>';
    }


}

?>    
</div>    


<br>
                        <input type="submit" name="submit" value="Extend Membership" class="btn btn-danger" style="margin-left: 2%;">

                        
                        <br>

                        </form>
                        
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>


    <script>
  $( function() {
    $("#datepicker").datepicker({
      dateFormat: 'yy-mm-dd'
});

  } );
  </script>
  
  
  
  
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>