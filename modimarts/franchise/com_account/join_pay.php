<? session_start();
include('../config.php');
include('../../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$id = $_GET['id'];

function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}


$sql = mysqli_query($con,"select * from new_member where id='".$id."'");
$sql_result = mysqli_fetch_assoc($sql);

$name = $sql_result['name'];
$level = $sql_result['level_id'];
$lv_id = $sql_result['level_id'];
$mobile = $sql_result['mobile'];
$issue_date = $sql_result['full_pay_date'];

$originalDate = $issue_date;
$newDate = date("d-m-Y", strtotime($originalDate));


$_SESSION['visiting_mobile']=$mobile;

function get_image($id){
    
    global $con;
    

    $sql = mysqli_query($con, "select * from new_member_images where member_id = '".$id."' and type='passport'");
    $sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['image'];
}

function get_zone($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_zone where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['zone'];
}

function get_state($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_state where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['state'];
}

function get_division($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_division where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['division'];
}

function get_district($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_district where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['district'];
}

function get_taluka($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_taluka where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['taluka'];
}


function get_pincode($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_pincode where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['pincode'];
}

function get_village($id){
    
    global $con;
    
    $sql = mysqli_query($con,"select * from new_village where id='".$id."'");
    $sql_result= mysqli_fetch_assoc($sql);
    return $sql_result['village'];
}


if($level==1){
    $level = 'Country';
    $level_id = 'India';
}
else if($level==2){
        $level = 'Zone';
        $level_id = $sql_result['zone'];
        $level_id = get_zone($level_id);
        
}
else if($level==3){
        $level = 'State';
        $level_id = $sql_result['state'];
        $level_id = get_state($level_id);
}
else if($level==4){
        $level = 'Division';
        $level_id = $sql_result['division'];
        $level_id = get_division($level_id);
}
else if($level==5){
        $level = 'District';
        $level_id = $sql_result['district'];
        $level_id = get_district($level_id);
}
else if($level==6){
        $level = 'Taluka';
        $level_id = $sql_result['taluka'];
        $level_id = get_taluka($level_id);
}
else if($level==7){
        $level = 'Pincode';
        $level_id = $sql_result['pincode'];
        $level_id = get_pincode($level_id);
}
else if($level==8){
        $level = 'Village';
        $level_id = $sql_result['village'];
        $level_id = get_village($level_id);
}


function get_amount($id){
    global $con;
    
    $sql = mysqli_query($con,"select sum(amount) as amount from manage_join_com where member_id='".$id."' order by id desc");
    if($sql_result = mysqli_fetch_assoc($sql)){
        return round($sql_result['amount'],2);
    }
    else{
        return 0;
    }
    
    
}





    $com_sql = mysqli_query($con,"select sum(amount) as amount from joining_com_details where member_id = '".$id."'");
    $com_sql_result = mysqli_fetch_assoc($com_sql);
    
    $amount = $com_sql_result['amount'];

?>    
    
    
<?
                        if(get_amount($id)>0){
                               
                               $available_amount = round($amount,2) - get_amount($id);  
                            }else{
                                $available_amount = round($amount,2);                                
                            } ?>

                        
                        
                        

<!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    section.content{
        margin:0;
    }
    .form-group .form-control {
    width: 100%;
    border: 1px solid;
    padding-left: 10px;
    box-shadow: none;
    }
</style>
    
    
    <section class="content">
        <div class="container-fluid">
            <? if($id == 'SAR'){ ?>
    
    <h4>Name : SARMicrosystems Pvt Ltd.  </h4> 

    <h4><b>Software Team</b></h4>



 <? }
else{ ?>
    <h4>Name : <? echo member('name',$id); ?> </h4> 
    <h4>Mobile : <? echo member('mobile',$id); ?></h4>
    <h4><b>Franchisee of:</b> <? echo $level; ?> - <? echo $level_id?></h4>

<? } ?>

    <h4><b>Available Amount : </b><? echo $available_amount ; ?></h4>
    <a class="btn btn-warning" onclick="$('#loading').show(); $('#content').load( 'join_pay.php?id=<? echo $id?>');">Refresh</a>




<script>
    function submitfun(){
        
   
    var member_id = '<? echo $id; ?>'; 
     var amount= document.getElementById("amount").value;
     var remark= document.getElementById("remark").value;
     var payment_date= document.getElementById("payment_date").value;
     
     
           $.ajax({
                   type: 'POST',    
                   url:'process_joinpay.php',
                   data:'amount='+amount+'&remark='+remark+'&payment_date='+payment_date+'&member_id='+member_id,
                   async: false,
                   success: function(msg){
                       
 if(msg> 0){
        
        swal(" Thank You !", "Successfully setteled !", "success");
        
        setTimeout(function(){
                    $('#content').load( 'join_distribution.php');
        }, 3000);


     

   
 }else{
             swal(" Error !", "Error in setteled Amount  !", "error");


 }
   
   
} })
            }


</script>


            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    
                                    
                                <form action="process_joinpay.php" method="POST">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="Amount">Amount</label>
                                    <input type="text" name="amount"  id="amount" class="form-control" placeholder="Enter Amount" required>
                                  </div>          
                                        </div>
                                        <div class="col-md-6">
                                                                              <div class="form-group">
                                    <label for="Date">Date</label>
                                    <input type="date" name="payment_date" id="payment_date" class="form-control" required>
                                  </div>
                                        </div>
                                    </div>
                                    

                                  <div class="form-group">
                                    <label for="Remark">Remark</label>
                                    <input type="text" name="remark" id="remark" class="form-control" placeholder="Enter Remarks" required>
                                  </div>
                                

                                
                                <button type="button" class="btn btn-primary" id="submitbtn" name="submitbtn" onclick="submitfun()">Submit</button>
                                  <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                                </form>

                                </div>
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Amount( In Rupees )</th>
                                            <th>Remark</th>
                                            <th>Payment Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                         <?
                                         $sql = mysqli_query($con,"select * from manage_join_com where member_id ='".$id."' and status=1 order by id desc");  

$i=1;
while($sql_result = mysqli_fetch_assoc($sql)){
$date = $sql_result['created_at'];
$date = date('d F Y', strtotime($date));

?>
                                        
                    <tr>
                        <td><? echo $i;?></td>
                        <td><? echo $sql_result['amount'];?></td>
                        <td><? echo $sql_result['remark'];?></td>
                        <td><? echo date('d-m-Y',strtotime($sql_result['payment_date']));?></td>
                    </tr>
                                        
                                        <? $i++; } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                            
                                </div>
                                
                            </div>
                                                    

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
                            
                      
                      <script>
                          $('#loading').hide();
                      </script>      
            
    

    