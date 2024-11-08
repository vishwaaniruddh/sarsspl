<?php
session_start();
include('head.php');
include('CartFunction.php');

// Show Error
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

if (isset($_POST['guestLogin'])) {
   $userid = $_SESSION['gid'];

  if($_SESSION['gid']==''){
   $_SESSION['gid'] = $_SESSION['geust_id'];
 }
 // echo $_SESSION['gid'];
?>
<script type="text/javascript">
  // location.reload();
  window.location.href="My_cart.php";
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

function getccode($cid, $pid)
{
    global $con1;

    $qrya = "select * from main_cat where id='" . $cid . "'";

    $resulta = mysqli_query($con1, $qrya);
    $rowa    = mysqli_fetch_row($resulta);
    $aa = $rowa[2];

    if ($cid == 80) {
        $Maincate = 5;

    } else {
        if ($aa != 0) {
            $qrya1    = "select * from main_cat where id='" . $aa . "'";
            $resulta1 = mysqli_query($con1, $qrya1);
            $rowa1    = mysqli_fetch_row($resulta1);
            $Maincate = $rowa1[4];
        }
        else
        {
        $Maincate=0;    
        }

        if ($Maincate == 1) {
            $qrylatf = "SELECT `ccode` FROM `fashion` WHERE code='" . $pid . "'";
        } else if ($Maincate == 190) {
            $qrylatf = "SELECT `ccode` FROM `electronics` WHERE code='" . $pid . "'";
        } else if ($Maincate == 218) {
            $qrylatf = "SELECT `ccode` FROM `grocery` WHERE code='" . $pid . "'";
        } else if ($Maincate == 760) {
            $qrylatf = "SELECT `ccode` FROM `kits` WHERE code='" . $pid . "'";
        } else if ($Maincate == 767) {
            $qrylatf = "SELECT  `ccode` FROM `promotion_product` WHERE code='" . $pid . "'";
        } else {
            $qrylatf = "SELECT  `ccode` FROM `products` WHERE code='" . $pid . "'";
        }
    }
    $qrylatfrws = mysqli_query($con1, $qrylatf);

    $latstprnrws = mysqli_fetch_array($qrylatfrws);
    return $latstprnrws['ccode'];

}

function getproweight($proid)
{
  global $con1;

  $myquery=mysqli_query($con1,"SELECT weight FROM `product_model` where id='".$proid."'");
  $data=mysqli_fetch_assoc($myquery);
  return $data['weight'];

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
                        
                        if(isset($_SESSION['ref_id']))
                        {
                        $ref_id=$_SESSION['ref_id'];
                        }
                        else
                        {
                          if(isset($_SESSION['refcode'])){
                          $reff=mysqli_query($con,"SELECT * FROM `franchise_referral` WHERE ref_code ='".$_SESSION['refcode']."'");
                        $refdata=mysqli_fetch_assoc($reff);
                        $ref_id=$refdata['franchise_id'];
                        $setfranchise=mysqli_query($con1,"UPDATE `Registration` SET `ref_id`='".$ref_id."' WHERE  id='".$userid."'");
                        $_SESSION['ref_id']=$ref_id;
                          }
                           else
                          {
                            $ref_id='';
                          }
                        }
                        

                        
                       if($_SESSION['gid']==''){ if($_SESSION['mem_id']==''){ $userid = $_SESSION['geust_id'];}else {  $userid = $_SESSION['mem_id']; }}
                        $_checkarr = array();
                        $_checkqty = array();
                        $qryc=mysqli_query($con1,"select * from cart where user_id='".$userid."' and status=0");
                        $totalamout=0;
                        $shopamout=0;
                        $totalweight=0;
                        $merchant=array();
                        $count=mysqli_num_rows($qryc);
                        if($count){
                        while($item=mysqli_fetch_assoc($qryc))
                          {
                            $totalamout=$totalamout+$item['total_amt'];
                            $shopamout=$shopamout+$item['other_chrg_amt'];
                            array_push($_checkarr,$item['prodid']);
                            $_pid = $item['prodid'];
                            $_checkqty[$_pid] = $item['qty'];

                            $prodata=getproductprice($item['cat_id'],$item['pid']);
                            $maxqty=$prodata['maxqty'];
                            $maxqty = ($maxqty==0) ? 100 : $maxqty  ;
                            $minqty=$prodata['minqty'];
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
                                    type="button"
                                    value="-"
                                    <?php 
                                    if ($item['qty']>$minqty) {
                                      
                                     ?>
                                    onclick="cart_minus('<?=$item['pid']?>','<?=$item['cat_id']?>','<?=$userid?>')"

                                  <?php }else{ ?>
                                    disabled
                                  <?php } ?>
                                    class="qtyminus1"
                                  />
                                  <input
                                    type="number"
                                    class="quantity-selector cart-number"
                                    name="updates[]"
                                    value="<?=$item['qty']?>"
                                    min="<?=$minqty?>"
                                    id="quantity_<?=$item['pid']?>"
                                    
                                  />
                                  <?php
                                  $cccode= getmerchantcode($item['cat_id'],$item['pid']);
                                  array_push($merchant,$cccode);
                                  $getproweight=getproweight($item['prodid']);
                                  // var_dump($getproweight);
                                  $proweight=$getproweight*$item['qty'];
                                  $totalweight=$totalweight+$proweight;
                                  
                                  ?>
                                  <input type="hidden" id="c_qty_<?=$item['pid']?>" value="<?=$item['qty']?>" >
                                 
                                  <input
                                    type="button"
                                    value="+"
                                    class="qtyplus1"
                                    
                                     <?php 
                                    if ($item['qty']<$maxqty) {
                                      
                                     ?>
                                   onclick="cart_plus('<?=$item['pid']?>','<?=$item['cat_id']?>','<?=$userid?>')"

                                  <?php }else{ ?>
                                    disabled
                                  <?php } ?>
                                  />
                                  <a onclick="add_to_card('<?=$item['cat_id']?>','<?=$item['pid']?>','<?=$item['p_price']?>','<?=$item['image']?>','<?=$item['product_name']?>','<?=$item['prodid']?>','shipping_in_area','<?=$item['shipping_in_area']?>','<?=$minqty?>')" class="btn">Update</a>
                                 
                                </div>

                              </div>

                              <div class="grid__item">
                                <span class="cart_total">Total :</span>
                                <span> Rs. <?=$item['total_amt']?> </span>
                              </div>
                              <div class="grid__item">
                                <span class="cart_total">Weight :</span>
                                <span> <?=$totalweight?> </span>
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
                          // var_dump($merchant);
                          // var_dump($totalweight);
                        ?>


                  <?php
                  $userid = $_SESSION['gid'];
                  if($_SESSION['gid']==''){ if($_SESSION['mem_id']==''){ $userid = $_SESSION['geust_id'];}else {  $userid = $_SESSION['mem_id']; }}


                  $subtotal = total_cart_amount($userid);
                  // $shipping_charges = get_shipping_charges($userid);
                  if ($_SESSION['mem_id']!='') {
                    $user_type="2";
                    $fmemid=$_SESSION['mem_id'];
                    $member=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM new_member WHERE id='".$fmemid."'"));
                    $village=$member['level_id'];

                    if($village<7)
                    {
                       $franchise_id=2;
                    }
                    else
                    {
                       $franchise_id=1;
                    }

                  }
                  else
                  {
                    $user_type='1';
                    $franchise_id='0';

                     $charge=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `courier_charge` WHERE id='1'"));
                  $amtchrge=$charge['total_amt'];
                   $shipcharge=$charge['charge'];

                  }


                    if (in_array('588', $merchant)) {

                      $charge=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `courier_charge` WHERE id='7'"));
                   $amtchrge=$charge['total_amt'];
                   $pweight=$charge['weight'];
                   $shipcharge=$charge['charge'];

                   if($totalweight<=$pweight)
                   {
                     $shipcharge=$charge['charge'];
                   }

                   else
                   {
                    $getnewnum=$totalweight/$pweight;
                     $numdata=number_format($getnewnum,2);
                    $str_arr = explode('.',$numdata);
                    if ($str_arr[1]=='00') {
                    $newvalue= floor($numdata);
                    }
                    else
                    {
                      $newvalue= floor($numdata)+1;
                    }
                    $shipcharge=$shipcharge*$newvalue;
                   

                   }

                  

                      // echo "The 'prize_id' element is in the array";
                      }
                  

                  // $charge=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `courier_charge` WHERE user_type='".$user_type."' AND franchise_type='".$franchise_id."'"));
                  // $amtchrge=$charge['total_amt'];

                  //  $charge=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `courier_charge` WHERE user_type='".$user_type."' AND first_price <=$subtotal AND total_amt>=$subtotal"));
                  //  // var_dump($charge);

                  // $shipcharge=$charge['charge'];
                  // if($shipcharge!=''){ $shipping_charges=$shipcharge; }

                  // if($franchise_id==1){ 
                  //   if($subtotal>'2500'){
                  //    $shipping_charges=0;
                  //   }}
                  if($subtotal<$amtchrge){ $shipping_charges=$shipcharge; }else{ $shipping_charges=0;}


                  if($shipping_charges==''){ $shipping_charges=0; }



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
                                  



                       if(isset($_SESSION['mem_id']) || isset($_SESSION['gid'])){ 
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
                      $Name = $sql_result['name'];

                    }
                         ?>
                          <div id="shipping-calculator" style="margin-top: 0;">
                            <h5 class="cart_title">Billing address</h5>
                            <div id="shipping-calculator-form-wrapper"  class="clearfix" >

                            <form method="post" name="customerData" id="cardform" action="ccavRequestHandler1.php" onsubmit="checkdelivery()"  >

                            <input type="hidden" name="merchant_param1" value="<? echo $userid;?>" readonly >

                            <input type="hidden" name="merchant_param2" value="<? echo $Name;?>" readonly hidden>

                            <input type="hidden" name="merchant_param3" value="<?=$ref_id?>" >

                            <input type="hidden" name="mobile" value="<? echo $_SESSION['mobile'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param4" value="<?=$shipping_charges?>" readonly hidden>

                            <input type="hidden" name="primary_address" value="<? echo $_SESSION['primary_address'];?>" readonly hidden>

                            <input type="hidden" name="merchant_param5" value="<? echo $_SESSION['total_amount'];?>" readonly hidden>
                            <input type="hidden" name="tid" id="tid" readonly hidden>

                            <input type="hidden" name="merchant_id" value="283837" hidden>

                            <input type="hidden" name="order_id" value="<? echo $txnid ; ?>" hidden>

                            <input type="hidden" name="amount" value="<?php echo $total; ?>" readonly hidden>

                            <input type="hidden" name="currency" value="INR" hidden>

                            <input type="hidden" name="redirect_url" value="/ccavResponseHandler1.php" readonly hidden>

                            <input type="hidden" name="cancel_url" value="/ccavResponseHandler1.php" readonly hidden>

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
                                  value="<?=$Name?>"
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
                                  onkeypress="return phoneno(event);"
                                  class="styled-input"
                                  name="billing_tel"
                                  maxlength="10"
                                  id="billing_tel"
                                  value="<?php echo $_SESSION['mobile'];?>" 
                                  pattern="[1-9]{1}[0-9]{9}"  required
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
                                    onKeyPress="return Validate_address(event);"
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
                              </div>
                              <div class="form-group" >                               
                               <p id="checkdeliveryresult"></p>
                              </div>


                              <div id="get-rates-container">
                              <input type="submit" class="btn btn-primary btn-lg btn-block"  value="Continue to checkout">
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
        function Checkpincode()
        {

          var deliverypincode = $('#delivery_pincode').val();

          if (deliverypincode.length==6)
          {
            var deliverypincode = $('#delivery_pincode').val();
                     var jwt_token = $("#jwt_token").val();

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
                                          html = "<p style='color:green;margin-left:1%;'>Delivery Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                              $("#status").val('1');
                                          
                                          
                                          
                                          
                                      }else{
                                          html = "<p style='color:red;margin-left:1%;'>Delivery Not Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                          $("#status").val(1);                                          
                                      }
                                     
                                    });




          }
          else
          {
            html = "<p style='color:red;margin-left:1%;'>Not a valid Pincode</p>";
                                     $("#checkdeliveryresult").html(html);
            $("#status").val(0);
          }

        }

      </script>
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
                                          html = "<p style='color:green;margin-left:1%;'>Delivery Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                              $("#status").val('1');
                                           $("#cardform").submit();
                                          
                                          
                                          
                                          
                                      }else{
                                          // html = "<p style='color:red;margin-left:1%;'>Delivery Not Available</p>";
                                           $("#checkdeliveryresult").html(html);
                                           // event.preventDefault();

                                           $("#status").val('1');
                                           $("#cardform").submit();
                                           
                                          
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

                                 if(billing_name !='' && billing_email !='' && billing_state !='' && billing_address !='' && billing_city!=''){
                                  if (billing_tel.length==10) {

                                 if (deliverypincode.length==6) {
                                    // event.preventDefault();
                                            $("#cardform").submit();
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
               }
      </script>

      <script type="text/javascript">
  jQuery(document).ready(function () {
      jQuery("#billing_tel").keypress(function (e) {
         var length = jQuery(this).val().length;
       if(length > 9) {
            return false;
       } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
       } else if((length == 0) && (e.which == 48)) {
            return false;
       }
      });
    });
</script>

  <script>
        var notyf = new Notyf();
        function add_to_card(cid,prodid,price,image,pname,pid,shipping,shipping_charges,minqty)
        {
        try
        { debugger;
             var specifiid= null;
           var up_quntity = $("#quantity_"+prodid).val();
           var c_qty = $("#c_qty_"+prodid).val();
           var quntity= up_quntity-c_qty;


          console.log(prodid);
          console.log(price);
          console.log(quntity);
          if(up_quntity!=c_qty){

          if(parseInt(up_quntity)>=parseInt(minqty)){
        if(price!=''){

        $.ajax({
        type: 'POST',
        url:'/addcart2.php',
        data:'prodid='+prodid+'&cid='+cid+'&price='+price+'&image='+image+'&pname='+pname+'&pid='+pid+'&shipping='+shipping+'&shipping_charges='+shipping_charges+'&quantity='+quntity+'&specifiid='+specifiid,
        success: function(msg){
        console.log(msg);


        if(msg==2)
        {

            notyf.error('sorry your session has been expired');
        }
        else if(msg==1)
        {
            notyf.success('Product added to cart successfully !');
            location.reload();


        }
        else
        {
            notyf.error('Error  Please  try again after some time');

        }


            }
        });
        }
        else
        {
             notyf.error('Error  Please  try again after some time');
        }
         }
          else
          {
             notyf.error('Minimum Order Is '+minqty);
          }
        }

        }catch(exc)
        {
            alert(exc);
        }
        }
      </script>
      <?php include('footer.php');?>