<?php
 session_start();
 include("connect.php");
 
  function strurl($string)  
 {  
      $slug = preg_replace('/[^a-z0-9-]+/', '-', trim(strtolower($string)));  
      return $slug;  
 } 

 function strcode($code)
 {
    return $code;
 }

$userid = $_SESSION['gid'];
if($_SESSION['gid']==''){ if($_SESSION['mem_id']==''){ $userid = $_SESSION['geust_id'];}else {  $userid = $_SESSION['mem_id']; }}


 $qryc=mysqli_query($con1,"select* from cart where user_id='".$userid."' and status=0");
 $totalamout=0;
?>

   <div class="has-items">
        <ul class="mini-products-list">
          <?php
        while($item=mysqli_fetch_assoc($qryc))
 {
  $totalamout=$totalamout+$item['total_amt'];
  $out=$item['outside_product'];
   ?>
          <li class="item">
            <a href="<?php if($out){ echo"https://allmart.world/Product-Details/".strcode($item['pid']);}else{?>https://allmart.world/<?=strurl($item['product_name'])?>/P/<?=strcode($item['pid'])?>/<?=strcode($item['cat_id'])?>/<?=strcode($item['prodid'])?><?php } ?>"

              class="product-image"
            >

              <img

                src="<?=$item['image']?>"

                alt="<?=$item['product_name']?>"

              />

            </a>



            <div class="product-details">

              <a href="javascript:void(0)" onclick="remove_from_cart('<?=$item['id']?>')" title="Remove" class="btn-remove">

                <svg

                  aria-hidden="true"

                  data-prefix="fal"

                  data-icon="times"

                  role="img"

                  xmlns="https://www.w3.org/2000/svg"

                  viewBox="0 0 320 512"

                  class="svg-inline--fa fa-times fa-w-10 fa-2x"

                >

                  <path

                    fill="currentColor"

                    d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"

                    class=""

                  ></path>

                </svg>

              </a>



              <a

                class="product-name"

                href="<?php if($out){ echo"https://allmart.world/Product-Details/".strcode($item['pid']);}else{?>https://allmart.world/<?=strurl($item['product_name'])?>/P/<?=strcode($item['pid'])?>/<?=strcode($item['cat_id'])?>/<?=strcode($item['prodid'])?><?php } ?>"

              >

              <?=$item['product_name']?>

              </a>



              <!-- <div class="option">

                <small>1 kg / beef</small>

              </div> -->



              <div class="cart-collateral">

                <span class="qtt"> <?=$item['qty']?> X </span>

                <span class="price"> Rs. <?=$item['p_price']?> </span>

              </div>

            </div>

          </li>
          <?php }?>

        </ul>



        <div class="summary">

          <div class="total">

            <span class="label">

              <span> Total: </span>

            </span>

            <span class="price"> Rs. <?=$totalamout?> </span>

          </div>

        </div>



        <div class="actions">

          <a class="btn btn-view-cart" href="https://allmart.world/My_cart.php"> View Cart </a>

        </div>

    </div>
