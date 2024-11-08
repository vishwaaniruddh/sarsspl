<div class="homepage_sidebar sidebar left-sidebar mobileToggle">
                   <!-- *****************Category*************** -->
                <div id="shopify-section-home-sidebar-category" class="shopify-section">

                  <div data-section-id="home-sidebar-category" data-section-type="home-sidebar-category">

                    <div class="widget widget_product_categories" style="background: #ffffff">

                      <ul class="product-categories dt-sc-toggle-frame-set dropdown multi-level-dropdown">

                        <?php

                        $sql23 = mysqli_query($con1, "select * from main_cat where under ='0' and name!='Resale' and status=1 order by name");

                        $grand_total = 0;

                        while ($result23 = mysqli_fetch_array($sql23)) {
                        ?>

                          <li class="cat-item cat-item-39 cat-parent dropdown-menu">

                            <?php if ($result23[0] == 803) { ?>

                              <a class="nav-link" href="https://allmart.world/list/<?=strurl($result23['name'])?>/<?=strcode($result23[0])?>">

                                <?php echo $result23['name']; ?>

                              </a>

                            <?php

                            } else {

                            ?>

                              <a class="nav-link" href="https://allmart.world/list/<?=strurl($result23['name'])?>/<?=strcode($result23[0])?>">

                                <?php

                                echo $result23['name'];

                                ?>

                              </a>

                            <?php } ?>

                          </li>
                           


                        <?php } ?>
                      </ul>

                    </div>

                  </div>

                </div>
                   <!-- **********************Pro Image****************** -->
                <div id="shopify-section-home-sidebar-promoimage" class="shopify-section">

                  <div data-section-id="home-sidebar-promoimage" data-section-type="home-sidebar-promoimage_1" class="home-sidebar-promoimage">

                    <div class="widget widget_promo_img" style="background-color: #d12828">

                      <img src="https://allmart.world/ecom/adminpanel/images/cat/thumb/Grocery_Staples.jpg" alt="Deal Of The Week" title="Deal Of The Week" />



                      <div class="promo-content">

                        <h5 style="color: #ffffff">Fresh grocery product</h5>



                        <p style="color: #ffffff">limited Stock</p>



                        <a href="https://allmart.world/list/<?=strurl('Fresh grocery product')?>/<?=strcode(219)?>" title="Shop Now" class="btn">

                          Shop Now

                        </a>

                      </div>

                    </div>

                  </div>

                </div>
                  <!-- **************************Fetured Product****************** -->
                <div id="shopify-section-home-sidebar-featured-products" class="shopify-section">

                  <div data-section-id="home-sidebar-featured-products" data-section-type="home-sidebar-featured" class="home-sidebar-featured">

                    <div class="widget widget_top_rated_products" style="background: #ffffff">

                      <h4><span>New products</span></h4>



                      <ul class="no-bullets sidebar-featured-products">
                       <?php include('new_products.php'); ?>

                      </ul>

                    </div>

                    <style>
                      .home-sidebar-featured .lof-clock-timer-detail-single li {

                        background: #000000;

                        border: 1px solid #000000;

                        color: #000000;

                      }
                    </style>

                  </div>

                </div>                  

              </div>