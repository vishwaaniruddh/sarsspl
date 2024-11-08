<?php

session_start();
include '../head.php';
if (!isset($_SESSION['gid'])) {
    ?>
  <script>
    alert('Login Please');
    window.location.href="login.php";
  </script>
  <?php
} else {

    $user_id  = $_SESSION['gid'];
    $order_id = $_GET['orderid'];
    $sql11    = mysqli_query($con1, "select * from Order_ent where user_id='" . $user_id . "' AND id='" . $order_id . "'");

    $orddata = mysqli_fetch_assoc($sql11);

    $userdata = mysqli_query($con1, "SELECT * FROM `new_order` WHERE oid='$order_id'");

    $usedata = mysqli_fetch_assoc($userdata);

    $shipping_charges = $orddata['shipping_charges'];
}
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" />
<style>
  .nav-side-menu {
  overflow: auto;
  font-family: Poppins;

  font-weight: 200;
  background-color: white;
  /*position: absolute;*/
  /*top: 0px;*/
  width: 300px;
  /*height: 100%;*/
  color: black;
}
.nav-side-menu .brand {
  background-color:white;
  line-height: 50px;
  display: block;
  text-align: center;
  color: black;
  font-weight: bold;

}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
      list-style: none;
    padding: 6px;
    margin: 6px;
    line-height: 35px;
    cursor: pointer;
    font-weight: bold;
    margin-left: 0;
    padding-left: 0;
    padding-right: 0;
    margin-right: 0;
  /*
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}
.nav-side-menu ul .active,
.nav-side-menu li .active {
  border-left: 3px solid #d19b3d;
  background-color: #4f5b69;
}
.nav-side-menu ul .sub-menu li.active,
.nav-side-menu li .sub-menu li.active {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li.active a,
.nav-side-menu li .sub-menu li.active a {
  color: #d19b3d;
}
.nav-side-menu ul .sub-menu li,
.nav-side-menu li .sub-menu li {
  background-color: white;
  border: none;
  line-height: 28px;
  border-bottom: 1px solid #23282e;
  margin-left: 0px;
}
.nav-side-menu ul .sub-menu li:hover,
.nav-side-menu li .sub-menu li:hover {
  background-color: gray;
}
.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding-left: 0px;
  border-left: 3px solid #2e353d;
  border-bottom: 1px solid #23282e;
}
.nav-side-menu li a {
  text-decoration: none;
  color: black;
}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}
.nav-side-menu li:hover {
  border-left: 3px solid #d19b3d;
  background-color: whitw;
  -webkit-transition: all 1s ease;
  -moz-transition: all 1s ease;
  -o-transition: all 1s ease;
  -ms-transition: all 1s ease;
  transition: all 1s ease;
}
@media (max-width: 767px) {
  .nav-side-menu {
    position: absolute;
    width: 100%;
    margin-bottom: 10px;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    /*position: absolute;*/
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;

    padding-left: 20px;
    line-height: 50px !important;
  }
}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  color: #313131;
    letter-spacing: 0em;
    font-family: Poppins;
    font-weight: normal;
    font-size: 14px;
    line-height: 1.8;
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: 100%;
}

</style>
      <main class="main-content">
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="z-index: 2">
            <div class="nav-side-menu">
          <div class="brand">My Account</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li >
                  <a href="https://allmart.world/MyAccount/index.php">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>
                 <li >
                  <a href="https://allmart.world/MyAccount/UpdateAccount.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Profile
                  </a>
                </li>
                 <li>
                  <a href="https://allmart.world/MyAccount/UpdatePassword.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Password
                  </a>
                </li>
                 <li class="active">
                   <a href="https://allmart.world/MyAccount/MyOrder.php">
                  <i class="fa fa-dashboard fa-lg"></i>My Order
                  </a>
                </li>
                 <li>
                  <a href="../My_cart.php">
                  <i class="fa fa-dashboard fa-lg"></i>Go To Cart
                  </a>
                </li>
                <li>
                  <a href="https://allmart.world/MyAccount/EditAddress.php">
                  <i class="fa fa-dashboard fa-lg"></i>Update Shipping Details
                  </a>
                </li><li>
                  <a href="../logout.php">
                  <i class="fa fa-dashboard fa-lg"></i>Logout
                  </a>
                </li>


            </ul>
       </div>
      </div>
    </div>
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="margin-top: 100px;position: unset">
        <div class="container">
            <div class="container">
               <?
            $qrytoken = "select token from add_ship_rocket_token where id='1'";
            $result_token = mysqli_query($con1, $qrytoken);
            $rowtoken    = mysqli_fetch_row($result_token);
       ?>
       <input type="hidden" id="jwt_token" value="<?php echo $rowtoken[0]; ?>">

              <?php
$sql = mysqli_query($con1, "select * from Order_ent where id='" . $order_id . "' AND user_id='" . $user_id . "' ");
if ($sql_result = mysqli_fetch_assoc($sql)) {
    $order_id       = $sql_result['id'];
    $date           = $sql_result['date'];
    $total_amount   = $sql_result['amount'];
    $status         = $sql_result['status'];
    $transaction_id = $sql_result['transaction_id'];

    $orderaddress = mysqli_query($con1, "SELECT * FROM `new_order` WHERE oid='" . $order_id . "'");
    $ordata       = mysqli_fetch_assoc($orderaddress);
    $name         = $ordata['name'];
    $email        = $ordata['email'];
    $phone        = $ordata['phone'];
    $address      = $ordata['address'];
    $city         = $ordata['city'];
    $state        = $ordata['state'];
    $zip          = $ordata['zip'];
    $country      = $ordata['country'];
    $fulladdress  = $address . ", " . $city . ", " . $zip . ", " . $state . ", " . $country;


}
?>
         <div class="row form-group" style="background: #e2e2e2;border-radius: 4px;margin: 1px;padding: 2%;">
          <div class="col-md-6 form-group">
          <h4><strong>Delivery Address</strong></h4>
          <p><b><?=$name?></b></p>
          <p><?=$fulladdress?></p>
          <p><b>Phone number: </b><span><?=$phone?></span></p>
          <p><b>Email: </b><span><?=$email?></span></p>

        </div>
        <div class="col-md-6 form-group">
          <h4><strong>Order Details</strong></h4>
           <p>Order number: <strong><?echo $order_id; ?></strong></p>
           <p>Transction ID: <strong><?=$transaction_id?></strong></p>
           <p>Date:  <strong><?echo date('D,d-m-Y', strtotime($date)); ?> </strong></p>
        </div>
      </div>
      <br/>
      <div class="row form-group" style="background: #e2e2e2;border-radius: 4px;margin: 1px;padding: 2%;">
        <div class="col-md-12 form-group">
          <h4 class="form-group"><b>Order details</b>
          <a class="btn btn-link" onclick="Download_invoice(<?=$order_id?>)" style="float:right;">Download Invoice/Bill</a></h4>
          <table class="table-responsive">
            <thead>
              <tr>
                <th >Product</th>
                <th >Individual Price</th>
                <th >Total</th>                  
                <th >Status</th>                  
            </tr>
            <tbody>
               <?
$show_order_sql = mysqli_query($con1, "select * from order_details where oid='" . $order_id . "'");
while ($show_order_sql_result = mysqli_fetch_assoc($show_order_sql)) {
    $pro_image    = $show_order_sql_result['image'];
    $pro_name     = $show_order_sql_result['product_name'];
    $pro_qty      = $show_order_sql_result['qty'];
    $single_price = $show_order_sql_result['rate'];
    $total_amt    = $single_price * $pro_qty;
    $item_id      = $show_order_sql_result['id'];
    $shiorddetails=mysqli_fetch_assoc(mysqli_query($con1,"SELECT * FROM `order_shipping` WHERE item_id='" . $item_id . "'"));

    if ($shiorddetails) {

                  $item_id       = $shiorddetails['item_id'];
                  $channel_id=$shiorddetails['channel_id'];
                  $shipment_id=$shiorddetails['shipment_id'];
                  $order_ids=$shiorddetails['order_ids'];
                  $awb_code=$shiorddetails['awb_code'];
                  $generate_awb=$shiorddetails['generate_awb'];
                  $generate_pickup=$shiorddetails['generate_pickup'];
                  $generateManifest=$shiorddetails['generateManifest'];
                  $printManifest=$shiorddetails['printManifest'];
                  $generateLabel=$shiorddetails['generateLabel'];
                  $printInvoice=$shiorddetails['printInvoice'];
                  $gettrackdetails=$shiorddetails['gettrackdetails'];
                   $datajson=json_decode($gettrackdetails);
                  $rlstatus=$datajson->tracking_data->shipment_track[0]->current_status;
                  if($rlstatus!='Delivered' && $rlstatus!='Canceled'){

                  if($awb_code!=''){
                  ?>

                  <script>
                    
                    $( document ).ready(function() {                         
                           gettrackdetailsUser(<?=$awb_code?>);
                      });
                   
                  </script>
                   <!-- <input type="hidden"  onload="gettrackdetails(<?=$awb_code?>)"> -->                 
                  <?php 
                  }   }  
    }




    ?>
              <tr>
                <td>
                    <img src="<?echo $pro_image; ?>" style="width: 100px;"><br/>
                    <?echo $pro_name; ?> <strong>×&nbsp;<?echo $pro_qty; ?></strong>   </td>
                <td >
                    <?echo $single_price; ?>
                </td>
                <td>
                    ₹ <?echo $total_amt; ?> </td>
                    <td>
                      <?php
                      if ($rlstatus=='') {
                        if ($sql_result['status'] == 0) {
                                echo "<span class='btn btn-warning' style='color:white;'>Waiting For Approval</span>";
                            }
                            if ($sql_result['status'] == 1) {
                                echo "<span class='btn btn-info' style='color:white;'>Waiting For Dispatch</span>";
                            }
                            if ($sql_result['status'] == 2) {
                                echo "<span class='btn btn-primary' style='color:white;'>Dispatch</span>";
                            }
                            if ($sql_result['status'] == 3) {
                                echo "<span class='btn btn-success' style='color:white;'>Delivered</span>";
                            }
                            if ($sql_result['status'] == 4) {
                                echo "<span class='btn btn-danger' style='color:white;'>Rejected</span>";

                            }
                            if ($sql_result['status'] == 5) {
                                echo "<span class=' text-danger' >Refunded</span>";

                            }
                       } 
                       else
                       {
                       ?>
                      <span class="btn btn-info"><?=$rlstatus?></span>
                    <?php } ?>
                    </td>
          </tr>
          <?}?>

            </tbody>
             <tfoot>
                   <tr>
                        <th scope="row">Shipping:</th>
                        <td colspan='11'><span><span>₹</span><?echo $shipping_charges; ?></span></td>

                    </tr>
                    <tr>
                        <th scope="row">Total:</th>
                        <td colspan='11'><span>₹</span><?echo $total_amount; ?></span> </td>
                    </tr>
                    <tr>
                        <!-- <th scope="row">Order Status:</th> -->
                        <td colspan='12'><span>
                          <?php
                            // if ($sql_result['status'] == 0) {
                            //     echo "<span class='btn btn-warning' style='color:white;'>Waiting For Approval</span>";
                            // }
                            // if ($sql_result['status'] == 1) {
                            //     echo "<span class='btn btn-info' style='color:white;'>Waiting For Dispatch</span>";
                            // }
                            // if ($sql_result['status'] == 2) {
                            //     echo "<span class='btn btn-primary' style='color:white;'>Dispatch</span>";
                            // }
                            // if ($sql_result['status'] == 3) {
                            //     echo "<span class='btn btn-success' style='color:white;'>Delivered</span>";
                            // }
                            // if ($sql_result['status'] == 4) {
                            //     echo "<span class='btn btn-danger' style='color:white;'>Rejected</span>";

                            // }
                            ?>
                       
                        <a href="https://allmart.world/MyAccount/ShippingDetails.php?orderid=<?=$order_id?>"  class="btn btn-primary" >Track</a> </span>                         </td>
                    </tr>
        </tfoot>
            </thead>
          </table>
        </div>
      </div>
      <br/>

        </div>
</div>
<!---->

               </div>
      </div>
          </div>
        </div>


        <!-- /#page-content-wrapper -->



        <!-- <div class="dt-sc-hr-invisible-large"></div> -->

      </main>
      <script>
        function getalert(val)
        {
          alert(val);

        }
      </script>
      <script>
    function Download_invoice(order_id)
    { debugger;
        $('.loader').show();
        $.ajax({
                type: "GET",
                url: "https://allmart.world/invoice/invoice.php",
                data: 'order_id=' + order_id,
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        var url = 'https://allmart.world/invoice/bills/Invoice-'+order_id+'.pdf';
                        // location.reload();

                        // window.location = url;

                        const a = document.createElement('a');
                          a.href = url;
                          a.download = url.split('/').pop();
                          document.body.appendChild(a);
                          a.click();
                          document.body.removeChild(a);

                           $('.loader').hide();

                    }
                }
            });
    }
</script>
      <script src="https://allmart.world/adminpanel/js/order_courier.js"></script>

<?php include '../footer.php';?>