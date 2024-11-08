<?php
session_start();
include('head.php');

if($_SESSION['gid']=='')
{

    if($_SESSION['geust_id']==''){
    $qryid=mysqli_query($con1,"INSERT INTO `Registration`(`id`) values ('')");
       
    $usrid=mysqli_insert_id($con1);
    $_SESSION['geust_id']=$usrid;
    }
    else
    {
        $usrid=$_SESSION['geust_id'];
    }

}

if (isset($_POST['guestLogin'])) {
   $userid = $_SESSION['gid'];

  if($_SESSION['gid']==''){
   $_SESSION['gid'] = $_SESSION['geust_id'];
 }
 // echo $_SESSION['gid'];
?>
<script type="text/javascript">
  // location.reload();
  window.location.href="AdditionalPayment.php";
</script>
<?php   
}
/*  Token  */
$qrytoken = "select token from add_ship_rocket_token where id='1'";

$result_token = mysqli_query($con1, $qrytoken);
$rowtoken    = mysqli_fetch_row($result_token);

function get_shipping_address($userid){
global $con1;
$sql=mysqli_query($con1,"select * from address where userid='".$userid."'");
$sql_result=mysqli_fetch_assoc($sql);

  if($sql_result){

      $address = $sql_result['address'];

      $pincode = $sql_result['pincode'];

      $landmark = $sql_result['landmark'];

      $state = $sql_result['state'];

      $city = $sql_result['city'];


      return $address.', '.$landmark.', '.$city.', '.$pincode.', '.$state;

  }
}





function total_cart_amount($userid){

global $con1;
$sql=mysqli_query($con1,"select sum(total_amt) as total from cart where user_id='".$userid."'");
$sql_result=mysqli_fetch_assoc($sql);
$total=$sql_result['total'];
return $total;
}





function get_shipping_charges($userid){

global $con1;
$sql_sum=mysqli_query($con1,"select sum(shipping_out_state) as shipping_out_state,sum(shipping_in_area) as shipping_in_area from cart where user_id='".$userid."'");
$sql_result_sum=mysqli_fetch_assoc($sql_sum);
$total_state=$sql_result_sum['shipping_out_state'];
$total_area=$sql_result_sum['shipping_in_area'];
$shipping_charges = $total_state + $total_area;
return $shipping_charges;
}



function igst($userid){
global $con1;
$sql=mysqli_query($con1,"select * from cart where user_id='".$userid."'");
while($sql_result=mysqli_fetch_assoc($sql)){
    $quantity=$sql_result['qty'];
    $price=$sql_result['p_price'];
    $price=floatval($price);
   $price = sprintf("%.2f", $price);
    if($price<1060){
      $igst[]=($price-floatval($price*100)/106)*$quantity;
        }
        else{
        $igst[]=($price-floatval($price*100)/112)*$quantity;
        }

}

$total=0;

foreach($igst as $key => $val){

$total=$total+$val;

$total=sprintf("%.2f", $total);
}
return sprintf("%.2f", $total);
}


function ccavResponseHandler()

{

$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "https://";

$link =  $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'ccavResponseHandler.php';

return str_replace("new_paymentProcess.php","",$link);

}

?>

<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <h1>Payment</h1>
          <a href="/" title="Back to the frontpage">Home</a>

          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
          <span>Payment</span>
        </div>
      </nav>

      <main class="main-content">
        <div class="dt-sc-hr-invisible-small"></div>

        <div class="wrapper">
          <div class="grid-uniform">
            <div class="grid__item">
              <div class="container-bg">
                <div class="grid__item">
                  <div class="cart_table">
                      

                      <div class="grid__item wide--one-whole " >
                        <div class="grid shipping-section">
                        <?php
                           $year = date('Y');

                           $month = date('m');

                           $date = date('d');

                                   $txnid =   'txn-'.$year.$month.$date.rand(10,10000);
                                   // $txnid =   'TESTPro-'.$year.$month.$date.rand(10,10000);
                                  



                       if(isset($_SESSION['gid'])){ 
                         $primary_address=get_shipping_address($_SESSION['gid']);
                         

                         $sql=mysqli_query($con1,"select * from address where userid='".$_SESSION['gid']."'");
                ;

                  if($sql_result=mysqli_fetch_assoc($sql)){

                      $address = $sql_result['address'];

                      $pincode = $sql_result['pincode'];

                      $landmark = $sql_result['landmark'];

                      $state = $sql_result['state'];

                      $city = $sql_result['city'];
                      $emailid = $sql_result['email'];
                    }
                         ?>
                          <div id="shipping-calculator" style="margin-top: 0;">
                            <h5 class="cart_title">Billing address</h5>
                            <div id="shipping-calculator-form-wrapper"  class="clearfix" >

                            <form method="post" name="customerData" id="cardform" action="AdditionalCharges.php"   >
                            	 <label >
                                Amount
                                </label>

                            <input type="hidden" name="merchant_param1" value="<? echo $_SESSION['gid'];?>" readonly >

                            <input type="hidden" name="merchant_param2" value="<? echo $_SESSION['fname'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param3" value="<? echo $_SESSION['lname'];?>" readonly hidden>                         
                            

                            <!-- <input type="hidden" name="merchant_param5" value="AdditionalCharges" readonly hidden> -->
                            <input type="hidden" name="tid" id="tid" readonly hidden>

                            <input type="hidden" name="merchant_id" value="283837" hidden>

                            <input type="hidden" name="order_id" value="<? echo $txnid ; ?>" hidden>

                            <input type="number" name="amount" value="0" min="10"  required>

                            <input type="hidden" name="currency" value="INR" hidden>

                            <input type="hidden" name="redirect_url" value="/ccpaymentresponse.php" readonly hidden>

                            <input type="hidden" name="cancel_url" value="/ccpaymentresponse.php" readonly hidden>

                            <input type="hidden" name="language" value="EN" readonly hidden>

                              <div class="form-group" >
                                <label for="address_zip">
                                 Name
                                </label>
                                <input
                                  type="text"
                                  class="styled-input"
                                  placeholder="Enter Your Name"
                                  name="billing_name"
                                  id="billing_name"
                                  onKeyPress="return ValidateAlpha(event);"
                                  value="<? echo $_SESSION['fname']. ''. $_SESSION['lname'] ;?>"
                                  required
                                />
                              </div>
                              <div class="form-group">
                                <label >
                                Email
                                </label>
                                <input
                                  type="email"
                                  style="width: 100%;"
                                  class="styled-input"
                                  name="billing_email"
                                  id="billing_email"
                                  value="<?php echo $emailid;?>" placeholder="yourmail@gmail.com"
                                  required
                                />
                              </div>
                              <div class="form-group">
                                <label >
                                Phone
                                </label>
                                <input
                                  type="number"
                                  pattern=".{10,12}"
                                  onkeypress="return isNumberKey(event);"
                                  class="styled-input"
                                  name="billing_tel"
                                  id="billing_tel"
                                  value="<?php echo $_SESSION['mobile'];?>" required
                                />
                              </div>
                              <div class="form-group">
                                  <label for="CartSpecialInstructions"
                                    >Address</label
                                  >
                                  <textarea
                                    name="billing_address"
                                    id="billing_address"
                                    class="input-full"
                                    onKeyPress="return ValidateAlpha(event);"
                                    required
                                  ><?php echo $primary_address;?></textarea>
                              </div>

                              <div class="form-group" >
                                <label for="address_zip">
                                 City
                                </label>
                                <input
                                  type="text"
                                  class="styled-input"
                                  name="billing_city"
                                  onKeyPress="return ValidateAlpha(event);"
                                  id="billing_city"
                                  value="<?php echo $city; ?>"
                                  required
                                />
                              </div>
                              <div class="form-group" >
                                <label for="address_zip">
                                 State
                                </label>
                                <select name="billing_state" id="billing_state" class="form-control" required>

                                    <option value="">Select State</option>

                                    <?php $state_sql = mysqli_query($con1,"SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");

                                    while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>



                                      <option value="<? echo $state_sql_result['state_name'];?>" <? if($state_sql_result['state_name'] == $state){ echo 'selected'; }?>>

                                            <?=$state_sql_result['state_name'];?>

                                        </option>



                                    <? } ?>

                                    </select>
                              </div>
                              <div class="form-group" >
                                <label for="address_zip">
                                 Country
                                </label>
                                <input
                                  type="text"
                                  class="styled-input"
                                  name="billing_country"
                                  id="billing_country"
                                  value="India" required readonly
                                />
                              </div>
                              <div class="form-group" >
                                <label for="address_zip">
                                 Pincode
                                </label>
                                <input
                                  type="number"                                
                                  class="styled-input"
                                  name="billing_zip"
                                  minlength="6"
                                  mixlength="6"
                                  id="delivery_pincode"
                                  onkeypress="return isNumberKey(event)"
                                  onkeyup="Checkpincode()"
                                  value="<?php echo $pincode; ?>"
                                  required
                                />
                                <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">
                                <input type="hidden" id="status" value="0">
                                   <label>Payment Made for</label>
                                <textarea
                                    name="billing_notes"
                                    class="input-full"
                                    onKeyPress="return ValidateAlpha(event);"                                    
                                  ></textarea>
                              </div>
                              <div class="form-group" >                               
                               <p id="checkdeliveryresult"></p>
                              </div>


                              <div id="get-rates-container">
                              <input type="submit" class="btn btn-primary btn-lg btn-block"  value="Continue to Payment">
                              </div>
                            </div>
                            </form>

                          </div>
                          <?php } else {?>
                            <div id="get-rates-container">
                            <a href="login.php" class="btn btn-primary btn-lg btn-block">
                              Login To Continue
                              </a>
                              </div> 
                              <br/>
                              <div id="get-rates-container">
                                <form action="#" method="post">
                               <button type="submit" class="btn btn-primary btn-lg btn-block">
                             Continue As guest
                              </button>
                              <input type="hidden" name="guestLogin" value="1">
                              
                              </form>
                              </div>
                          <?php }?>

                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dt-sc-hr-invisible-large"></div>
      </main>
    
      <script>


        function checkdelivery(){
                     var deliverypincode = $('#delivery_pincode').val();
                     var jwt_token = $("#jwt_token").val();

                     var billing_name=$("#billing_name").val();
                     var billing_email=$("#billing_email").val();
                     var billing_state=$("#billing_state").val();
                     var billing_tel=$("#billing_tel").val();
                     var billing_address=$("#billing_address").val();
                     var billing_city=$("#billing_city").val();
                     var pinstatus=$("#status").val();
                     if(pinstatus=='0')
                     {

                     if(billing_name !='' && billing_email !='' && billing_state !='' && billing_address !='' && billing_city!=''){
                     	if (billing_tel.length==10) {

                     if (deliverypincode.length==6) {
                              
                                }
                                  else
                                  {
                                    html = "<p style='color:red;margin-left:1%;'>Not a valid Pincode</p>";
                                     $("#checkdeliveryresult").html(html);
                                     event.preventDefault();

                                  }
                              }
                                  else
                                  {
                                    html = "<p style='color:red;margin-left:1%;'>Mobile Number Must be 10 digit</p>";
                                     $("#checkdeliveryresult").html(html);
                                     event.preventDefault();

                                  }
                                  }
                                  else
                                  {
                                    html = "<p style='color:red;margin-left:1%;'>Please Fill All The Details</p>";
                                     $("#checkdeliveryresult").html(html);
                                     event.preventDefault();


                                  }
                              }
                              else
                              {
                              	$("#cardform").submit();
                              }


                 }
      </script>
      <?php include('footer.php');?>