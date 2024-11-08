<?php
include('connect.php');

$proopt=mysqli_query($con1,"SELECT * FROM `products_extra_option` WHERE is_best_selling ='1' AND product_status='1'");
            while($row=mysqli_fetch_assoc($proopt)) {

                $catid=$row['cat_id'];
                $pid=$row['pro_id'];
                $prod_id=$row['prod_id'];
                $name=$row['product_name'];
                 $status =getstatus($prod_id);
                $prodata=getproductprice($catid,$pid);
                $price=$prodata['total_amt'];
                if($_SESSION['mem_id']!=''){$price=$prodata['franchise_price'];}
                $minqty=$prodata['minqty'];

                if ($prodata['shipping_in_area']) {
                    $shipping         = 'shipping_in_area';
                    $shipping_charges = $prodata['shipping_in_area'];
                } else if ($prodata['shipping_out_state']) {
                    $shipping         = 'shipping_out_state';
                    $shipping_charges = $prodata['shipping_out_state'];
                } else {
                    $shipping         = '';
                    $shipping_charges = 0;
                }
                $pro_img = ProIMG($pid,$catid,$prod_id);
                if ($status) {
                  

            ?>
<li class="grid__item item-row wide--one-fifth post-large--one-quarter large--one-third medium--one-half small--one-half on-sale" id="product-5969999724734" id="product-5969999724734">

<div class="products product-hover-11">

  <div class="product-container" style="max-height: 213px;">

    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">

      <div class="featured-tag">

        <span class="badge badge--sale">

          <span class="gift-tag badge__text">Sale</span>

        </span>

      </div>



      <div class="ImageOverlayCa"></div>
      <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" class="grid-link">
        <img src="<?=$pro_img?>" class="featured-image" alt="<?=$name?>" style="width:213px;height: 213px;" />
      </a>
    </a>
    <!-- <div class="product_right_tag offer_exist">
      <span class="offer-price">
        <b>94% </b></span>
    </div> -->
    <div class="ImageWrapper">
      <div class="product-button">
        <div class="add-to-wishlist">
          <div class="show">
            <div class="default-wishbutton-egg loading">
              <a title="Add to wishlist" class="add-in-wishlist-js" href="#"><i class="far fa-heart"></i><span class="tooltip-label">Add to wishlist</span></a>
            </div>
            <div class="loading-wishbutton-egg loading" style="
                      display: none;
                      pointer-events: none;
                    ">
              <a class="add_to_wishlist" href="#"><i class="fas fa-spinner"></i></a>
            </div>
            <div class="added-wishbutton-egg loading" style="display: none">
              <a title="View Wishlist" class="added-wishlist add_to_wishlist" href="/pages/wishlist"><i class="fas fa-heart"></i><span class="tooltip-label">View Wishlist</span></a>
            </div>
          </div>
        </div>
        <a href="javascript:void(0)" title="Quick View" id="egg" class="quickview-button quick-view-text product_link" data-view="egg"><i class="fa fa-search"></i></a>
      </div>
    </div>
  </div>



  <div class="product-detail">

    <!-- <p class="product-vendor">

      <span>Duio</span>

    </p> -->



    <a href="/<?=strurl($name)?>/P/<?=strcode($pid)?>/<?=strcode($catid)?>/<?=strcode($prod_id)?>" title="<?=$name?>" style="height: 3em;" class="grid-link__title"><?=substr($name,0,30)?></a>
    <div class="grid-link__meta">
      <div class="product_price">
        <div class="grid-link__org_price" id="ProductPrice">
          Rs. <?=$price?>
        </div>

      </div>



      <!-- <del class="grid-link__sale_price" id="ComparePrice">

        Rs. 199.00

      </del> -->

    </div>




      <a class="add-cart-btn btn"
      <?php
      if($status==1)
                                      { ?>
                                       onclick="addtocart('<?=$catid;?>','<?=$pid?>','<?=$price?>','<?=$pro_img?>','<?=$name;?>','<?=$prod_id;?>','<?=$shipping?>','<?=$shipping_charges?>',<?=$minqty?>)"
                                      <?php 
                                      }
                                      else { ?>
                                        disabled
                                        style="background: #f26522a8;"
                                      <?php } ?>
      
      title="Add to Cart">

        <i class="fas fa-cart-plus"></i>

        Add to Cart

      </a>




    <script type="text/javascript">
      $(document).ready(function() {

        $(".item-swatch").each(

          function() {

            if (

              $(this).children().length ==

              0

            ) {

              $(this).remove();

            } else {

              $(this).show();

            }

          }

        );

        $(".sizes-list").each(

          function() {

            if (

              $(this).children().length ==

              0

            ) {

              $(this).remove();

            } else {

              $(this).show();

            }

          }

        );

      });
    </script>

  </div>

</div>

</li>
<?php
}
            }
?>
