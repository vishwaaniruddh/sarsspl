<?php
session_start();
include('head.php');
?>

<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <h1>Wish List</h1>
          <a href="index.php" title="Back to the frontpage">Home</a>

          <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
          <span>Wish List</span>
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
                        class="grid__item wide--two-thirds post-large--two-thirds large--two-thirds"
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
                        <? 
                         $userid = $_SESSION['gid'];
    
                        $sql = mysqli_query($con1,"select * from wishlist where user_id = '".$userid."'");
                        $count=mysqli_num_rows($sql);
                        if($count){
                        while($sql_result = mysqli_fetch_assoc($sql)){ 
                        
                        $pid = $sql_result['prodid'];
                        $prodid = $sql_result['pid'];
                        $catid = $sql_result['cat_id'];
                        $image = $sql_result['image'];
                        $price = $sql_result['p_price'];
                        $product_name = $sql_result['product_name'];
                        ?>


                        <div class="cart__row">
                          <div
                            class="grid--full cart__row--table-large text-center"
                          >
                            <div
                              class="grid cart_items grid__item wide--two-tenths post-large--two-tenths large--two-tenths medium--two-tenths"
                            >
                              <a
                                href="product_detail.php?pid=<? echo $prodid; ?>&amp;catid=<? echo $catid;?>&amp;prod_id=<? echo $pid; ?>"
                                class="cart__image"
                              >
                                <img
                                  src="<?=$image?>"
                                  alt="<?=$product_name?>"
                                />
                              </a>
                            </div>

                            <div
                              class="grid grid__item wide--eight-tenths post-large--eight-tenths large--eight-tenths medium--eight-tenths product-info text-left"
                            >
                              <div class="grid__item cart-title">
                                <a
                                  href="/products/unsalted-peanut-cookies?variant=37822776574142"
                                  class="product-name h5"
                                >
                                <?=$product_name?>
                                </a>

                                <!-- <br />
                                <small>100 gm / Nuts</small> -->
                              </div>


                              <div class="grid__item">
                                <div class="qty-box-set">
                                <input
                                type="submit"
                                name="aatocart"
                                onclick="addtocart('<? echo $prodid;?>','<? echo $catid;?>','<? echo $price; ?>','<? echo $image; ?>','<? echo $product_name; ?>','<? echo $pid; ?>')"
                                class="btn update-cart"
                                value="Add To Cart"
                              />
                                <input
                                type="submit"
                                name="remove wishlist"
                                onclick="addwishlist('<? echo $prodid;?>','<? echo $catid;?>','<? echo $price; ?>','<? echo $image; ?>','<? echo $product_name; ?>','<? echo $pid; ?>')"
                                class="btn update-cart"
                                value="Remove"
                              />
                               
                                </div>
                              </div>

                             
                             
                            </div>
                          </div>
                        </div> 

                                 <?php }
                                     }
                                 else{ ?>
                                 <h3>No Product</h3>
                        

                        <?php } ?>
                      </div>

                     
                  
                  </div>

                  <script>
                    $(".qtyplus1").on("click", function (e) {
                      e.preventDefault();
                      var currentVal = parseInt(
                        $(this).parent().find('input[name="updates[]"]').val()
                      );
                      if (!isNaN(currentVal)) {
                        $(this)
                          .parent()
                          .find('input[name="updates[]"]')
                          .val(currentVal + 1);
                      } else {
                        $(this).parent().find('input[name="updates[]"]').val(1);
                      }
                    });

                    $(".qtyminus1").on("click", function (e) {
                      e.preventDefault();
                      var currentVal = parseInt(
                        $(this).parent().find('input[name="updates[]"]').val()
                      );
                      if (!isNaN(currentVal) && currentVal > 1) {
                        $(this)
                          .parent()
                          .find('input[name="updates[]"]')
                          .val(currentVal - 1);
                      } else {
                        $(this).parent().find('input[name="updates[]"]').val(1);
                      }
                    });
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="dt-sc-hr-invisible-large"></div>
      </main>
      <?php include('footer.php');?>