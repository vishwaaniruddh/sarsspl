<?php
session_start();
include('head.php');

 if($_SESSION['gid']==''){
   $_SESSION['gid'] = $_SESSION['geust_id'];
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
          <h1>Your Shopping Cart</h1>
          <a href="/" title="Back to the frontpage">Home</a>

          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
          <span>Your Shopping Cart</span>
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
                      <div
                        class="grid__item wide--two-quarters post-large--two-quarters large--two-quarters"
                      >
                        <div class="cart__row cart__header-labels">
                          <div class="grid--full">
                            <div class="grid__item">
                              <div class="grid">
                                <div class="grid__item">
                                  <h5 class="cart_title">Products</h5>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php
                        $userid = $_SESSION['gid'];
                        if($_SESSION['gid']==''){ $userid = $_SESSION['geust_id'];}
                        $_checkarr = array();
                        $_checkqty = array();
                        $qryc=mysqli_query($con1,"select * from cart where user_id='".$userid."' and status=0");
                        $totalamout=0;
                        $shopamout=0;
                        $count=mysqli_num_rows($qryc);
                        if($count){
                        while($item=mysqli_fetch_assoc($qryc))
                          {
                            $totalamout=$totalamout+$item['total_amt'];
                            $shopamout=$shopamout+$item['other_chrg_amt'];
                            array_push($_checkarr,$item['prodid']);
                            $_pid = $item['prodid'];
                            $_checkqty[$_pid] = $item['qty'];
                       ?>

                        <div class="cart__row">
                          <div
                            class="grid--full cart__row--table-large text-center"
                          >
                            <div
                              class="grid cart_items grid__item wide--two-tenths post-large--two-tenths large--two-tenths medium--two-tenths"
                            >
                              <a
                                href="/<?=strurl($item['product_name'])?>/P/<?=strcode($item['pid'])?>/<?=strcode($item['cat_id'])?>/<?=strcode($item['prodid'])?>"
                                class="cart__image"
                              >
                                <img
                                  src="<?=$item['image']?>"
                                  alt="<?=$item['product_name']?>"
                                />
                              </a>
                            </div>

                            <div
                              class="grid grid__item wide--eight-tenths post-large--eight-tenths large--eight-tenths medium--eight-tenths product-info text-left"
                            >
                              <div class="grid__item cart-title">
                                <a
                                  href="/<?=strurl($item['product_name'])?>/P/<?=strcode($item['pid'])?>/<?=strcode($item['cat_id'])?>/<?=strcode($item['prodid'])?>"
                                  class="product-name h5"
                                >
                                <?=$item['product_name']?>
                                </a>


                              </div>

                              <div class="grid__item">
                                <span class="price">Rs. <?=$item['p_price']?></span>
                              </div>

                              <div class="grid__item">
                                <div class="qty-box-set">
                                  
                                  <input
                                    type="number"
                                    class="quantity-selector cart-number"
                                    name="updates[]"
                                    id="updates_37822776574142"
                                    value="<?=$item['qty']?>"
                                    min="1"
                                    readonly
                                  />

                                </div>
                              </div>

                              <div class="grid__item">
                                <span class="cart_total">Total :</span>
                                <span> Rs. <?=$item['total_amt']?> </span>
                              </div>
                              <div class="grid__item">
                                <a
                                href="javascript:void(0)" onclick="remove_cart('<?=$item['id']?>')" title="Remove"
                                  class="cart__remove"
                                >
                                  <span><i class="fas fa-times"></i></span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                          }
                        ?>


                  <?php
                  $userid = $_SESSION['gid'];
                  if($_SESSION['gid']==''){ $userid = $_SESSION['geust_id'];}


                  $subtotal = total_cart_amount($userid);
                  $shipping_charges = get_shipping_charges($userid);
                  $total = $subtotal + $shipping_charges ;
                  $gst= igst($userid);
                  $_SESSION['total_amount'] = $total;
                  $_SESSION['shipping_charges']=$shipping_charges;
                 // echo '<pre>';print_r($_checkqty);echo '</pre>';die;
                 // echo $item['prodid'];echo $subtotal;die;
                  // if (in_array("1427", $_checkarr)){ 
                  //     if($_checkqty[1427]<=5){
                  //         $shipping_charges = '50.00';
                  //         $total = $subtotal + $shipping_charges ;
                  //         $_SESSION['total_amount'] = $total;
                  //         $_SESSION['shipping_charges']=$shipping_charges;
                  //     }
                  // }

                  ?>
                        <div class="grid shipping-section">
                        <div class="order_summary">
                            <h5 class="cart_title">Order Summary</h5>
                            <div class="grid__item">
                              <p class="cart_total_price">
                                <span class="cart__subtotal-title"
                                  >Product Price :</span
                                >
                                <span class="cart__subtotal" style="margin-right: 39%;font-weight: bold;">Rs. <?=$subtotal?></span>
                              </p>
                              <p class="cart_total_price">
                                <span class="cart__subtotal-title"
                                  >Shipping Charges:</span
                                >
                                <span class="cart__subtotal" style="margin-right: 40%;font-weight: bold;">Rs. <?=$shipping_charges?></span>
                              </p>
                            </div>
                          </div>
                          </div>
                        <?php }
                        else{
                          ?>
                          <h4>No Product Added</h4>
                           <div class="btn_actions">
                          <a class="btn" href="index.php"
                            >Continue shopping</a
                          >

                        </div>
                          <?
                        } ?>
                      </div>

                      <div class="grid__item wide--one-half  post-large--one-half  large--one-half " >
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

                            <form method="post" name="customerData" id="cardform" action="ccavRequestHandler.php"  >

                            <input type="hidden" name="merchant_param1" value="<? echo $_SESSION['gid'];?>" readonly >

                            <input type="hidden" name="merchant_param2" value="<? echo $_SESSION['fname'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param3" value="<? echo $_SESSION['lname'];?>" readonly hidden>

                            <input type="hidden" name="mobile" value="<? echo $_SESSION['mobile'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param4" value="<?=$shipping_charges?>" readonly hidden>

                            <input type="hidden" name="primary_address" value="<? echo $_SESSION['primary_address'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param5" value="<? echo $_SESSION['total_amount'];?>" readonly hidden>
                            <input type="hidden" name="tid" id="tid" readonly hidden>

                            <input type="hidden" name="merchant_id" value="283837" hidden>

                            <input type="hidden" name="order_id" value="<? echo $txnid ; ?>" hidden>

                            <input type="hidden" name="amount" value="<?php echo $total; ?>" readonly hidden>

                            <input type="hidden" name="currency" value="INR" hidden>

                            <input type="hidden" name="redirect_url" value="/ccavResponseHandler.php" readonly hidden>

                            <input type="hidden" name="cancel_url" value="/ccavResponseHandler.php" readonly hidden>

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
                                  value="<? echo $_SESSION['fname']. ' '. $_SESSION['lname'] ;?>"
                                  required
                                />
                              </div>
                              <div class="form-group">
                                <label >
                                Email
                                </label>
                                <input
                                  type="email"
                                  class="styled-input"
                                  placeholder="Enter Your Email"
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
                                  minlength="10"
                                  mixlength="12"
                                  placeholder="Enter Your Phone number"
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
                                    placeholder="Enter Your Full Address"
                                    class="input-full"
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
                                  placeholder="Enter Your City"
                                  name="billing_city"
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
                                  minlength="6"
                                  mixlength="8"
                                  class="styled-input"
                                  name="billing_zip"
                                  placeholder="Enter Your Pincode"
                                  id="delivery_pincode"
                                  value="<?php echo $pincode; ?>"
                                  required
                                />
                                <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">
                              </div>
                              <div class="form-group" >                               
                               <p id="checkdeliveryresult"></p>
                              </div>


                              <div id="get-rates-container">
                              <input type="submit" class="btn btn-primary btn-lg btn-block" onclick=" checkdelivery()" value="Continue to checkout">
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
                              <input type="hidden" id="status" value="0">
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

                     if(billing_name !='' && billing_email !='' && billing_state !='' && billing_tel !='' && billing_address !='' && billing_city!=''){
                     

                     var status=0;



                     if (deliverypincode.length==6) {

         
                     var settings = {
                                      "url": "https://apiv2.shiprocket.in/v1/external/courier/serviceability?pickup_postcode=400067&weight=10&cod=1&delivery_country=IN&delivery_postcode="+deliverypincode,
                                      "method": "GET",
                                      "timeout": 0,
                                      "headers": {
                                        "Content-Type": "application/json",
                                        "Authorization": "Bearer "+jwt_token
                                      },
                                    };
                                    
                                    $.ajax(settings).done(function (response) { debugger;
                                      console.log(response);
                                      var html = "";
                                      if(response.status==200){
                                          html = "<p style='color:green;margin-left:1%;'>Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                              $("#status").val('1');
                                           $("#cardform").submit();
                                           var status=1;
                                          
                                          
                                          
                                      }else{
                                          html = "<p style='color:red;margin-left:1%;'>Delivery Not Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                           event.preventDefault();
                                           var status =0;
                                          
                                      }
                                     
                                    });
                                 
                                if (status==0) {
                                 event.preventDefault();
                               }
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
                                    html = "<p style='color:red;margin-left:1%;'>Please Fill All The Details</p>";
                                     $("#checkdeliveryresult").html(html);
                                     event.preventDefault();


                                  }


                 }
      </script>
      <?php include('footer.php');?>