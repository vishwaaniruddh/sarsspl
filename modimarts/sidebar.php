<div class="homepage_sidebar sidebar left-sidebar mobileToggle">

                   <!-- *****************Category*************** -->

                <div id="shopify-section-home-sidebar-category" class="shopify-section">



                  <div data-section-id="home-sidebar-category" data-section-type="home-sidebar-category">

                   
                    <?php 
                    $getleft=mysqli_query($con1,"SELECT * FROM `homepage_ads` WHERE `position`='1' LIMIT 0,3");
                    foreach ($getleft as $key => $left) {
                      
                     ?>
                     <div class="middle-bottom" style="border: 1px solid; border-radius:15px; padding:5px; margin-bottom:10px; color: #D6D6D4">
                          <div class="overlay style_1">
                            <div class="featured-image">
                              <!--<a class="banner_half_img"  href="/<?=$left['url']?>">-->
                                  <a class="banner_half_img"  href="<?=$left['url']?>">
                                <img loading="lazy" src="<?=$left['img_path']?>" alt="<?=$left['name']?>" />
                              </a>
                            </div>
                          </div>
                        </div>




                        <?php
                      }

                          foreach ($categories as $key => $category) {

                           

                        ?>



                         <!--  <li class="cat-item cat-item-39 cat-parent dropdown-menu" data-ani="/catalog-product?category_id=<?=strcode($category->Category_id)?>">



                              <a class="nav-link" href="/catalog-product?category_id=<?=strcode($category->Category_id)?>">



                                <?php echo $category->Category; ?>



                              </a>



                            



                          </li>

                           

 -->



                        <?php } ?>

                        <!-- <li class="cat-item cat-item-39 cat-parent dropdown-menu" data-ani="/list/value-offer/803"> -->



                            

                             <!--  <a class="nav-link" href="/list/value-offer/803">



                                Value Offer

                              </a>



                            

                          </li> -->

                      <!-- </ul>



                    </div> -->



                  </div>



                </div>

                   <!-- **********************Pro Image****************** -->

                

                  <!-- **************************Fetured Product****************** -->

                <div id="shopify-section-home-sidebar-featured-products" class="shopify-section">



                  <div data-section-id="home-sidebar-featured-products" data-section-type="home-sidebar-featured" class="home-sidebar-featured">
                    <div class="widget widget_top_rated_products" style="background: #ffffff; margin-top:10px ">
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