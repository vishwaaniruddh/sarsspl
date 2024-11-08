<?php

session_start();
 include('head.php');
 if(!isset($_SESSION['gid']))
 {
  ?>
  <script>
    alert('Login Please');
    window.location.href="login.php";
  </script>
  <?php
 }
 else
 {
  $user_id=$_SESSION['gid'];
  $order_id=$_GET['orderid'];
   $sql11        = mysqli_query($con1, "select * from Order_ent where user_id='" . $user_id . "' AND id='".$order_id."'");
                          
                         $orddata = mysqli_fetch_assoc($sql11);

                         $userdata=mysqli_query($con1,"SELECT * FROM `new_order` WHERE oid='$order_id'");

                         $usedata=mysqli_fetch_assoc($userdata);

                         $shipping_charges= $orddata['shipping_charges'];

 }
?>



<nav class="breadcrumb" aria-label="breadcrumbs">

        <div class="container-bg">

          <h1>Orders</h1>

          <a href="index.php" title="Back to the frontpage">Home</a>



          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

          <span>Order</span>

        </div>

      </nav>



      <main class="main-content">

        <div class="dt-sc-hr-invisible-small"></div>



        <div class="wrapper">

          <div class="grid-uniform">

            <div class="grid__item">

              <div class="container-bg">

                <div class="grid__item">

                  <div class="user-account">

                    <div class="grid__item text-center">
                      <div id="CustomerLoginForm">
                       <div class="product-model">
     <div class="container">
         <div class="row ">
          <div class="col-md-12 pay-info">
          <h3>Thank You, <?=$usedata['name'] ?>. Your order is placed successfully .</h3>
          <h4>Your Transaction ID for this transaction is <span class='txn_id'><?=$orddata['transaction_id']?></span></h4>
            <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                      <article id="post-8" class="post-8 page type-page status-publish hentry">
                        <div class="entry-content">
                        <div class="woocommerce">
                         <div class="woocommerce-order">
                      <?php
                       $sql=mysqli_query($con1,"select * from Order_ent where id='".$order_id."'");
                      $sql_result=mysqli_fetch_assoc($sql);
                      $order_id=$sql_result['id'];
                      $date = $sql_result['date'];
                      $total_amount = $sql_result['amount'];
                      ?>
                <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                <li class="woocommerce-order-overview__order order">
                    Order number: <strong><? echo $order_id; ?></strong>
                </li>
                <li class="woocommerce-order-overview__date date">
                    Date:  <strong><? echo date('D,d-m-Y',strtotime($date)); ?> </strong>
                </li>
                <li class="woocommerce-order-overview__email email">
                    Email: <strong><? echo $usedata['email'];?></strong>
                    </li>
                <li class="woocommerce-order-overview__total total">
                    Total: <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount ; ?></span></strong>
                </li>
                <li class="woocommerce-order-overview__total total">
                    Shopping Address: <strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><? echo $usedata['address'] ; ?><br/><?=$usedata['city']?>,<?=$usedata['state']?>,<br/><?=$usedata['zip']?>,<?=$usedata['country']?></span></strong>
                </li>
            </ul>
        <section class="woocommerce-order-details">
    <h2 class="woocommerce-order-details__title">Order details</h2>
    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">
        <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name">Product</th>
                <th class="woocommerce-table__product-name product-name">Individual Price</th>
                <th class="woocommerce-table__product-table product-total">Total</th>
            </tr>
        </thead>
        <tbody>
        <?
        $show_order_sql=mysqli_query($con1,"select * from order_details where oid='".$order_id."'");
        while($show_order_sql_result=mysqli_fetch_assoc($show_order_sql)){
        $pro_image = $show_order_sql_result['image'];
        $pro_name = $show_order_sql_result['product_name'];
        $pro_qty = $show_order_sql_result['qty'];
        $single_price = $show_order_sql_result['rate'];
        $total_amt = $single_price*$pro_qty;
        ?>
      <tr class="woocommerce-table__line-item order_item">
    <td class="woocommerce-table__product-name product-name">
        <img src="<? echo $pro_image;?>">
        <? echo $pro_name;?> <strong class="product-quantity">×&nbsp;<? echo $pro_qty; ?></strong>   </td>
    <td class="woocommerce-table__product-total product-total">
        <? echo $single_price;?>
    </td>
    <td class="woocommerce-table__product-total product-total">
        <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amt; ?></span> </td>
</tr>
<? } ?>
        </tbody>
        <tfoot>
                   <tr>
                        <th scope="row">Shipping:</th>
                        <td colspan='8'><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo  $shipping_charges; ?></span></td>

                    </tr>
                    <tr>
                        <th scope="row">Total:</th>
                        <td colspan='8'><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><? echo $total_amount; ?></span> <small><a href="//invoice/bills/Invoice-<?=$order_id?>.pdf" download="invoice"> Download Invoice</a></small>   </td>
                    </tr>
                    <tr>
                        <th scope="row">Order Status:</th>
                        <td colspan='8'><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">
                          <?php
                                  if ($sql_result['status']==0) {
                                   echo "<span class='btn btn-warning' style='color:white;'>Waiting For Approval</span>";
                                  }
                                  if ($sql_result['status']==1) {
                                   echo "<span class='btn btn-info' style='color:white;'>Waiting For Dispatch</span>";
                                  }
                                  if ($sql_result['status']==2) {
                                     echo "<span class='btn btn-primary' style='color:white;'>Dispatch</span>";
                                  }
                                  if ($sql_result['status']==3) {
                                     echo "<span class='btn btn-success' style='color:white;'>Delivered</span>";
                                  }
                                  if ($sql_result['status']==4) {
                                    echo "<span class='btn btn-danger' style='color:white;'>Rejected</span>";
                                    
                                  }
                                  ?>
                        </span>
                         </td>
                    </tr>
        </tfoot>
    </table>
    </section>
</div>
</div>
</div>
<!-- .entry-content -->
        </article><!-- #post-## -->
        </main><!-- #main -->
    </div>
            <div >
             </div>
          </div>
        </div>
</div>
<!---->

<style>
    .txn_id{
        color:green;
    }
    .pay-info{
        text-align:center;
            padding: 10%;
    background: #e3e5e6;
    }
    .shoping{
        display:none;
    }
    @media (min-width: 768px){
        .content-area, .widget-area {
            margin-bottom: 2.617924em;
        }
        .content-area {
    width: 100%;
    float: left;
    margin-right: 4.347826087%;
}
.woocommerce-cart .hentry, .woocommerce-checkout .hentry {
    border-bottom: 0;
    padding-bottom: 0;
}
    }
.hentry {
    margin: 0 0 4.235801032em;
}

ul.order_details {
    list-style: none;
    position: relative;
    margin: 3.706325903em 0;
}

.order_details {
    background-color: #000000;
}

ul.order_details li:first-child {
    padding-top: 1.618em;
}

ul.order_details li {
    padding: 1em 1.618em;
    font-size: 0.8em;
    text-transform: uppercase;
}

ul.order_details li strong {
    display: block;
    font-size: 1.41575em;
    text-transform: none;
}

b, strong {

    font-weight: 600;

}
.site-main {

    margin-bottom: 2.617924em;

}

.order_details {

    background-color: white;

}

table {

    border-spacing: 0;

    width: 100%;

    border-collapse: separate;

}

table {

    margin: 0 0 1.41575em;

    width: 100%;

}

table {

    border-collapse: collapse;

    border-spacing: 0;

}

table thead th {

    padding: 1.41575em;

    vertical-align: middle;

}

table:not( .has-background ) tbody td {

    background-color: #000000;

}

table th, table tbody td, #payment .payment_methods li, #comments .comment-list .comment-content .comment-text, #payment .payment_methods > li .payment_box, #payment .place-order {

    background: #f8f8f8!important;

}
table td, table th {

    padding: 1em 1.41575em;

    text-align: left;

    vertical-align: top;

    width:50%;

}

table td img{

    width:20%;

}

.hentry .entry-content a:not(.button) {

    text-decoration: underline;

}

a {

    color: #227504;

}

b, strong {

    font-weight: 600;

}

</style>

</div>
                       

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

<?php include('footer.php');?>