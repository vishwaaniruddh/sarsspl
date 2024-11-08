<div class="col-sidebar" data-sidebar>
                    <div class="close-sidebar">
                      <svg
                        aria-hidden="true"
                        data-prefix="fal"
                        data-icon="times"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                        class="svg-inline--fa fa-times fa-w-10 fa-2x"
                      >
                        <path
                          fill="currentColor"
                          d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"
                          class=""
                        ></path>
                      </svg>
                    </div>
                    <div
                      class="grid__item wide--one-fifth post-large--one-quarter left-sidebar sidebar mobileToggle"
                    >
                      <div class="product_sidebar">
                        <div
                          id="shopify-section-sidebar-category"
                          class="shopify-section"
                        >
                          <div class="widget widget_product_categories">
                            <h4>Category</h4>

                            <ul class="product-categories dt-sc-toggle-frame-set dropdown multi-level-dropdown">
                         <?php
                         $sql_category = mysqli_query($con1,"select * from main_cat where under ='".$catid."' and status=1");
                           $i = 1; 
                           while($row = mysqli_fetch_assoc($sql_category)) { 
                           
                               $cid = $row['id'];
                               $jewellery = false;
                               $garment = false;
                               
                               $count_sri_products = 0;
                               $allmart_count = 0;
                               $maincatid = '';
                               
                               
                               if($cid==80) {
                                               $garment = true;
                                               $maincatid = ' in(22,27,28,29,8,10,5)';
                                               
                                           } else if($cid == 82) {
                                               $garment = true;
                                               $maincatid = ' in(8)';
                                               
                                           } else if($cid == 83) {
                                               $garment = true;
                                               $maincatid = ' in(22,27,28)';
                                               
                                           } else if($cid == 84) {
                                               $garment = true;
                                               $maincatid = ' in(10)';
                                               
                                           } else if($cid == 85) {
                                               $garment = true;
                                               $maincatid = ' in(5)';
                                               
                                           } else if($cid == 117) {
                                               // jewellery
                                               $jewellery = true;
                                               $maincatid = ' in(1,11,12,14,15,17,18,19,20,21,22,23,24,25,26,27)';
                                           } else {
                                               $garment = false;
                                               $maincatid = 'in()';
                                           }
                                           
                           
                               if($Maincate==1)
                                           {
                                                if($jewellery) {
                                                   $sql="SELECT count(product_id) as total FROM product WHERE categories_id $maincatid";
                                               } else if($garment){
                                                   $sql="SELECT count(gproduct_id) as total FROM garment_product WHERE product_for $maincatid";
                                               }
                                               
                                               $sql_sri_products = mysqli_query($con1,$sql);
                                               $sql_result_sri = mysqli_fetch_assoc($sql_sri_products);
                                               $count_sri_products = $sql_result_sri['total'];
                                               // $count_sri_products = mysqli_num_rows($sql_sri_products);
           
                                               $qrytotalproduct = mysqli_query($con1,"select * from fashion where category ='".$cid."' and status=1 ");
                                           }
                                           else if($Maincate==190)
                                           {
                                               $qrytotalproduct = mysqli_query($con1,"select * from electronics where category ='".$cid."'  and status=1 ");
                                           }
                                           else if($Maincate==218)
                                           {   
                                               $qrytotalproduct = mysqli_query($con1,"select * from grocery where category ='".$cid."'  and status=1 ");
                                           }
                                           else if($Maincate==760)
                                           {
                                               $qrytotalproduct = mysqli_query($con1,"select * from kits where category ='".$cid."'  and status=1 ");
                                           }
                                           else 
                                           {
                                               $qrytotalproduct = mysqli_query($con1,"select * from products where category ='".$cid."' and status=1 "); 
                                           }
                                           
                                           // echo $garment;
                                           
       
                                           
                                           $allmart_count = mysqli_num_rows($qrytotalproduct);
                                           $total = $allmart_count + $count_sri_products;
                                           
                                           $total_records = $total_records+$total;
                           
                           ?>
                             <li class="nav-item">
                                 <a href="new_product.php?catid=<?php echo $row['id']; ?>"><?php echo $row['name'];?></a>
                            </li>
                         <?php $i++; } ?>
                      </ul>

                            </ul>
                          </div>
                        </div>
                        <!-- <div id="shopify-section-product-sidebar-deals" class="shopify-section" >
                          <div data-section-id="product-sidebar-deals" data-section-type="product-sidebar-deals" class="product-sidebar-deals">
                            <div class="widget widget_hot_deals">
                              <h4><span>Hot Deals</span></h4>
                              <div class="carousel-block">
                                <ul class="no-bullets sidebar-deal-products owl-carousel owl-theme" >
                                  <li class="products">
                                    <div class="products-container">
                                      <a class="thumb grid__item" href="/products/potato" >
                                        <img alt="featured product" src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-7_350X.jpg?v=1609746865" />
                                      </a>
                                    </div>

                                    <div class="product-detail">
                                      <div class="product_left">
                                        <a
                                          class="grid-link__title"
                                          href="/products/potato"
                                        >
                                          Potato
                                        </a>
                                      </div>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 55.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/watermelon"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-14_350X.jpg?v=1609746480"
                                        />

                                        <label class="deal-lable"
                                          >Hurry, Only few item(s) left!</label
                                        >

                                        <div
                                          class="deal-clock lof-clock-timer-detail-single lof-clock-5969999954110-detail"
                                        ></div>
                                        <script>
                                          //<![CDATA[
                                          jQuery(document).ready(function ($) {
                                            $(
                                              ".lof-clock-5969999954110-detail"
                                            ).lofCountDown({
                                              TargetDate: "10/24/2021 00:00:00",
                                              DisplayFormat:
                                                "<ul class='list-inline'><li class='day'>%%D%%<span>Days</span></li><li class='hours'>%%H%%<span>Hours</span></li><li class='mins'>%%M%%<span>Min</span></li><li class='seconds'>%%S%%<span>Sec</span></li></ul>",
                                              FinishMessage: "Expired",
                                            });
                                          });
                                          //]]>
                                        </script>
                                        <style></style>
                                      </a>
                                    </div>

                                    <div class="product-detail">
                                      <div class="product_left">
                                        <a
                                          class="grid-link__title"
                                          href="/products/watermelon"
                                        >
                                          Watermelon
                                        </a>
                                      </div>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 100.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/egg"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-13_350X.jpg?v=1609746757"
                                        />
                                      </a>
                                    </div>

                                    <div class="product-detail">
                                      <div class="product_left">
                                        <a
                                          class="grid-link__title"
                                          href="/products/egg"
                                        >
                                          Egg
                                        </a>
                                      </div>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 10.00
                                          </div>

                                          <del>Rs. 199.00</del>
                                        </div>

                                        <span class="sale">Sale</span>
                                      </div>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/grilled-meat"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-5_350X.jpg?v=1609746347"
                                        />
                                      </a>
                                    </div>

                                    <div class="product-detail">
                                      <div class="product_left">
                                        <a
                                          class="grid-link__title"
                                          href="/products/grilled-meat"
                                        >
                                          Grilled Meat
                                        </a>
                                      </div>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 280.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </li>
                                </ul>
                                <div
                                  class="sidabar_nav product-sidebar-deals-nav"
                                ></div>
                              </div>
                            </div>
                            <style>
                              .sidebar-deal-products
                                .lof-clock-timer-detail-single
                                li {
                                background: #ffffff;
                                color: #181818;
                              }
                            </style>
                          </div>

                          <script type="text/javascript">
                            $(document).ready(function () {
                              var productSidedeals = $(
                                ".sidebar-deal-products"
                              );
                              productSidedeals.owlCarousel({
                                loop: false,
                                margin: 10,
                                nav: true,
                                navContainer: ".product-sidebar-deals-nav",
                                navText: [
                                  ' <a class="prev btn active"><i class="fa fa-angle-left"></i></a>',
                                  ' <a class="next btn active"><i class="fa fa-angle-right"></i></a>',
                                ],
                                dots: false,
                                responsive: {
                                  0: {
                                    items: 1,
                                  },
                                  600: {
                                    items: 1,
                                  },
                                  1000: {
                                    items: 1,
                                  },
                                },
                              });
                            });
                          </script>
                        </div> -->
                        <!-- <div id="shopify-section-product-sidebar-bestsellers" class="shopify-section">
                          <div data-section-id="product-sidebar-bestsellers" data-section-type="product-sidebar-bestsellers" class="product-sidebar-bestsellers" >
                            <div class="widget widget_top_rated_products">
                              <h4><span>Best Sellers</span></h4>
                              <div class="carousel-block">
                                <ul class="no-bullets top-products">
                                  <li class="products">
                                    <span class="top_product_count">01</span>
                                    <div class="product-detail top-products-detail">
                                      <a class="grid-link__title" href="/products/potato">
                                        Potato
                                      </a>
                                      <span  class="shopify-product-reviews-badge" data-id="5970000773310" ></span>
                                      <div class="top-product-prices grid-link__meta">
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 55.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="products-container">
                                      <a class="thumb grid__item" href="/products/potato" >
                                        <img alt="featured product" src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-7_small.jpg?v=1609746865" />
                                      </a>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <span class="top_product_count">02</span>
                                    <div
                                      class="product-detail top-products-detail"
                                    >
                                      <a
                                        class="grid-link__title"
                                        href="/products/watermelon"
                                      >
                                        Watermelon
                                      </a>
                                      <span
                                        class="shopify-product-reviews-badge"
                                        data-id="5969999954110"
                                      ></span>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 100.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/watermelon"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-14_small.jpg?v=1609746480"
                                        />
                                      </a>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <span class="top_product_count">03</span>
                                    <div
                                      class="product-detail top-products-detail"
                                    >
                                      <a
                                        class="grid-link__title"
                                        href="/products/egg"
                                      >
                                        Egg
                                      </a>
                                      <span
                                        class="shopify-product-reviews-badge"
                                        data-id="5969999724734"
                                      ></span>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 10.00
                                          </div>

                                          <del>Rs. 199.00</del>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/egg"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-13_small.jpg?v=1609746757"
                                        />
                                      </a>
                                    </div>
                                  </li>

                                  <li class="products">
                                    <span class="top_product_count">04</span>
                                    <div
                                      class="product-detail top-products-detail"
                                    >
                                      <a
                                        class="grid-link__title"
                                        href="/products/grilled-meat"
                                      >
                                        Grilled Meat
                                      </a>
                                      <span
                                        class="shopify-product-reviews-badge"
                                        data-id="6151568851134"
                                      ></span>
                                      <div
                                        class="top-product-prices grid-link__meta"
                                      >
                                        <div class="product_price">
                                          <div class="grid-link__org_price">
                                            Rs. 280.00
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="products-container">
                                      <a
                                        class="thumb grid__item"
                                        href="/products/grilled-meat"
                                      >
                                        <img
                                          alt="featured product"
                                          src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-5_small.jpg?v=1609746347"
                                        />
                                      </a>
                                    </div>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div> -->

                        <!-- <div id="shopify-section-custom-text-type-1" class="shopify-section index-section">
                          <div data-section-id="custom-text-type-1" data-section-type="custom-text-block" class="custom-text-block" >
                            <div class="widget widget_custom_block">
                              <ul class="support_block">
                                <li class="grid__item">
                                  <div class="custom-text_section">
                                    <div class="support_section">
                                      <div class="support_icon">
                                        <a href=""
                                          ><i class="fas fa-gift"></i
                                        ></a>
                                      </div>

                                      <div class="support_text">
                                        <h6>Special Offer 1 + 1 = 3</h6>

                                        <p class="desc">
                                          Lorem ipsum dolor sit amet,
                                          consectetur
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </li>

                                <li class="grid__item">
                                  <div class="custom-text_section">
                                    <div class="support_section">
                                      <div class="support_icon">
                                        <a href=""
                                          ><i class="fas fa-money-check"></i
                                        ></a>
                                      </div>

                                      <div class="support_text">
                                        <h6>Free Reward Card</h6>

                                        <p class="desc">
                                          Ut enim ad minim veniam, quis nostrud
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </li>

                                <li class="grid__item">
                                  <div class="custom-text_section">
                                    <div class="support_section">
                                      <div class="support_icon">
                                        <a href=""
                                          ><i class="fas fa-truck"></i
                                        ></a>
                                      </div>

                                      <div class="support_text">
                                        <h6>Free Shipping</h6>

                                        <p class="desc">
                                          Fugiat nulla pariatur. Excepteur sint
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </li>

                                <li class="grid__item">
                                  <div class="custom-text_section">
                                    <div class="support_section">
                                      <div class="support_icon">
                                        <a href=""
                                          ><i class="fas fa-undo"></i
                                        ></a>
                                      </div>

                                      <div class="support_text">
                                        <h6>Order Return</h6>

                                        <p class="desc">
                                          nisi ut aliquip ex ea commodo
                                          consequat.
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div> -->

                        <div
                          id="shopify-section-sidebar-promoimage"
                          class="shopify-section"
                        >
                          <script type="text/javascript">
                            $(document).ready(function () {
                              $("#promo-carousel").owlCarousel({
                                loop: false,
                                // margin:10,
                                nav: false,
                                dots: true,
                                responsive: {
                                  0: {
                                    items: 1,
                                  },
                                  600: {
                                    items: 1,
                                  },
                                  1000: {
                                    items: 1,
                                  },
                                },
                              });
                            });
                          </script>
                        </div>
                      </div>
                    </div>
                  </div>