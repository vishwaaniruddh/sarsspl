<div class="sidebar collection_sidebar mobileToggle">
                      <div id="shopify-section-sidebar-category" class="shopify-section" >
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
                        </div>
                      </div>
                      <div class="refined-widgets">
                        <a href="javascript:void(0)" class="clear-all" style="display: none" >
                          Clear All
                        </a>
                      </div>
                      <div class="sidebar-block">
                        <div id="shopify-section-sidebar-colors" class="shopify-section">
                          <style type="text/css">
                            #shopify-section-sidebar-colors
                              .sidebar-tag
                              li
                              input[type="checkbox"]
                              + label {

                              font-size: 0;

                            }

                            #shopify-section-sidebar-colors

                              .sidebar-tag

                              li

                              input[type="checkbox"]

                              + label {

                              border: 1px solid #e5e5e5;

                              border-radius: 50%;

                              width: 24px;

                              height: 24px;

                              padding: 0;

                            }

                            #shopify-section-sidebar-colors

                              .sidebar-tag

                              li

                              input[type="checkbox"]:checked

                              + label {

                              box-shadow: inset 0px 0 0px 4px #ffffff;

                            }

                            #shopify-section-sidebar-colors

                              .sidebar-tag

                              li

                              input[type="checkbox"]

                              + label:before {

                              display: none;

                            }

                          </style>

                        </div>

                        <div

                          id="shopify-section-sidebar-tag-filters"

                          class="shopify-section"

                        >

                          <!-- <aside class="sidebar-tag filter tags shop by weight">

                            <div class="widget widget_tag_filter">

                              <h4>

                                <span>Shop By Weight </span>

                                <a

                                  href="javascript:void(0)"

                                  class="clear"

                                  style="display: none"

                                >

                                  <i class="fas fa-times"></i>

                                </a>

                              </h4>



                              <div class="widget-content">

                                <ul>

                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-weight1"

                                      value="100-gm"

                                    />

                                    <label for="shop-by-weight1">100 gm</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-weight2"

                                      value="150-gm"

                                    />

                                    <label for="shop-by-weight2">150 gm</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-weight3"

                                      value="250-gm"

                                    />

                                    <label for="shop-by-weight3">250 gm</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-weight4"

                                      value="1-kg"

                                    />

                                    <label for="shop-by-weight4">1 kg</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-weight5"

                                      value="1-ltr"

                                    />

                                    <label for="shop-by-weight5">1 ltr</label>

                                  </li>

                                </ul>

                              </div>

                            </div>

                          </aside> -->



                          <!-- <aside class="sidebar-tag filter tags shop by price">

                            <div class="widget widget_tag_filter">

                              <h4>

                                <span>Shop By Price </span>

                                <a

                                  href="javascript:void(0)"

                                  class="clear"

                                  style="display: none"

                                >

                                  <i class="fas fa-times"></i>

                                </a>

                              </h4>



                              <div class="widget-content">

                                <ul>

                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price1"

                                      value="1-100"

                                    />

                                    <label for="shop-by-price1"

                                      >$1 - $100</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price2"

                                      value="100-200"

                                    />

                                    <label for="shop-by-price2"

                                      >$100 - $200</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price3"

                                      value="200-300"

                                    />

                                    <label for="shop-by-price3"

                                      >$200 - $300</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price4"

                                      value="300-500"

                                    />

                                    <label for="shop-by-price4"

                                      >$300 - $500</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price5"

                                      value="300-400"

                                    />

                                    <label for="shop-by-price5"

                                      >$300 - $400</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-price6"

                                      value="700-1000"

                                    />

                                    <label for="shop-by-price6"

                                      >$700 - $1000</label

                                    >

                                  </li>

                                </ul>

                              </div>

                            </div>

                          </aside>



                          <aside class="sidebar-tag filter tags shop by brand">

                            <div class="widget widget_tag_filter">

                              <h4>

                                <span>Shop By Brand </span>

                                <a

                                  href="javascript:void(0)"

                                  class="clear"

                                  style="display: none"

                                >

                                  <i class="fas fa-times"></i>

                                </a>

                              </h4>



                              <div class="widget-content">

                                <ul>

                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-brand1"

                                      value="groca"

                                    />

                                    <label for="shop-by-brand1">Groca</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-brand2"

                                      value="fresho"

                                    />

                                    <label for="shop-by-brand2">Fresho</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-brand3"

                                      value="nara"

                                    />

                                    <label for="shop-by-brand3">Nara</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-brand4"

                                      value="sira"

                                    />

                                    <label for="shop-by-brand4">Sira</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-brand5"

                                      value="nama"

                                    />

                                    <label for="shop-by-brand5">Nama</label>

                                  </li>

                                </ul>

                              </div>

                            </div>

                          </aside>



                          <aside class="sidebar-tag filter tags shop by type">

                            <div class="widget widget_tag_filter">

                              <h4>

                                <span>Shop By Type </span>

                                <a

                                  href="javascript:void(0)"

                                  class="clear"

                                  style="display: none"

                                >

                                  <i class="fas fa-times"></i>

                                </a>

                              </h4>



                              <div class="widget-content">

                                <ul>

                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-type1"

                                      value="fruits"

                                    />

                                    <label for="shop-by-type1">Fruits</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-type2"

                                      value="vegetables"

                                    />

                                    <label for="shop-by-type2"

                                      >Vegetables</label

                                    >

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-type3"

                                      value="tea"

                                    />

                                    <label for="shop-by-type3">Tea</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-type4"

                                      value="snackes"

                                    />

                                    <label for="shop-by-type4">Snackes</label>

                                  </li>



                                  <li>

                                    <input

                                      type="checkbox"

                                      id="shop-by-type5"

                                      value="groceries"

                                    />

                                    <label for="shop-by-type5">Groceries</label>

                                  </li>

                                </ul>

                              </div>

                            </div>

                          </aside> -->

                        </div>

                      </div>

                      <!-- <div

                        id="shopify-section-sidebar-bestsellers"

                        class="shopify-section"

                      >

                        <div class="widget widget_top_rated_products">

                          <h4>Best Sellers</h4>



                          <div class="carousel-block">

                            <ul

                              class="no-bullets top-products sidebar-bestsellers owl-carousel owl-theme"

                            >

                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/potato"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-7_350X.jpg?v=1609746865"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/potato"

                                  >

                                    Potato

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="5970000773310"

                                  ></span>



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

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/watermelon"

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

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/watermelon"

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

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/egg"

                                  >

                                    <div class="featured-tag">

                                      <span class="badge badge--sale">

                                        <span class="gift-tag badge__text"

                                          >Sale</span

                                        >

                                      </span>

                                    </div>



                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-13_350X.jpg?v=1609746757"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/egg"

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

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/grilled-meat"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-5_350X.jpg?v=1609746347"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/grilled-meat"

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

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/weight-gain-powder"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-1_350X.jpg?v=1609746366"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/weight-gain-powder"

                                  >

                                    Weight Gain Powder

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151569670334"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 175.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/packed-rice"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-2_350X.jpg?v=1609746230"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/packed-rice"

                                  >

                                    Packed Rice

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151570292926"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 140.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/watermelon-juice"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-3_350X.jpg?v=1609746274"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/watermelon-juice"

                                  >

                                    Watermelon juice

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151570489534"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 70.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/honey"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-4_350X.jpg?v=1609746293"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/honey"

                                  >

                                    Honey

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151571210430"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 253.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/whole-wheat-bread"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-6_350X.jpg?v=1609746315"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/whole-wheat-bread"

                                  >

                                    Whole wheat bread

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151571341502"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 50.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/kiwi"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-9_350X.jpg?v=1609746550"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/kiwi"

                                  >

                                    Kiwi

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151690977470"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 120.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/unsalted-peanut-cookies"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-10_350X.jpg?v=1609746599"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/unsalted-peanut-cookies"

                                  >

                                    Unsalted Peanut Cookies

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151692484798"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 115.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/buns"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-8_350X.jpg?v=1609746634"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/buns"

                                  >

                                    Buns

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151693926590"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 40.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/energy-powder"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-12_350X.jpg?v=1609746665"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/energy-powder"

                                  >

                                    Energy powder

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151694942398"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 254.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/organic-tea"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-1_350X.png?v=1609760018"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/organic-tea"

                                  >

                                    Organic Tea

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151742390462"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 180.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/chocolate-protein-powder"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-2_350X.png?v=1609759551"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/chocolate-protein-powder"

                                  >

                                    Chocolate Protein Powder

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151742914750"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 523.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/orange"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-17_350X.jpg?v=1609750778"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/orange"

                                  >

                                    Orange

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151814447294"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 150.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/chocolate-cookies"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-18_350X.jpg?v=1609750841"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/chocolate-cookies"

                                  >

                                    Chocolate Cookies

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151822606526"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 120.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/waffle-ice-cream"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-19_350X.jpg?v=1609750906"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/waffle-ice-cream"

                                  >

                                    Waffle Ice Cream

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151825031358"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 65.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/salt-biscuit"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-20_350X.jpg?v=1609750950"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/salt-biscuit"

                                  >

                                    Salt Biscuit

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151825785022"

                                  ></span>



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

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/walnut-chocolate-bar"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-21_350X.jpg?v=1609750984"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/walnut-chocolate-bar"

                                  >

                                    Walnut Chocolate Bar

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151826833598"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 75.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/sliced-watermelon"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-22_350X.jpg?v=1609751045"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/sliced-watermelon"

                                  >

                                    Sliced Watermelon

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151827652798"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 50.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/herb-soap-bar"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-23_350X.jpg?v=1609751073"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/herb-soap-bar"

                                  >

                                    Herb Soap Bar

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151828799678"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 85.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/goose-berry"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-24_350X.jpg?v=1609751108"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/goose-berry"

                                  >

                                    Goose Berry

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151829553342"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 60.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/millet"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-25_350X.jpg?v=1609751262"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/millet"

                                  >

                                    Millet

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151833157822"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 240.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/fresh-kale"

                                  >

                                    <div class="featured-tag">

                                      <span class="badge badge--sale">

                                        <span class="gift-tag badge__text"

                                          >Sale</span

                                        >

                                      </span>

                                    </div>



                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-26_350X.jpg?v=1609752550"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/fresh-kale"

                                  >

                                    Fresh Kale

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151844921534"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 50.00

                                      </div>



                                      <del>Rs. 199.00</del>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/cucumber"

                                  >

                                    <div class="featured-tag">

                                      <span class="badge badge--sale">

                                        <span class="gift-tag badge__text"

                                          >Sale</span

                                        >

                                      </span>

                                    </div>



                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-27_350X.jpg?v=1609752609"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/cucumber"

                                  >

                                    Cucumber

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151845314750"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 110.00

                                      </div>



                                      <del>Rs. 199.00</del>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/handmade-soap-bar"

                                  >

                                    <div class="featured-tag">

                                      <span class="badge badge--sale">

                                        <span class="gift-tag badge__text"

                                          >Sale</span

                                        >

                                      </span>

                                    </div>



                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-28_350X.jpg?v=1609752648"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/handmade-soap-bar"

                                  >

                                    Handmade Soap Bar

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151845675198"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 75.00

                                      </div>



                                      <del>Rs. 199.00</del>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/fresh-meat"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-29_350X.jpg?v=1609752676"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/fresh-meat"

                                  >

                                    Fresh Meat

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151846297790"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 200.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/homemade-cookies"

                                  >

                                    <div class="featured-tag">

                                      <span class="badge badge--sale">

                                        <span class="gift-tag badge__text"

                                          >Sale</span

                                        >

                                      </span>

                                    </div>



                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-30_350X.jpg?v=1609752709"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/homemade-cookies"

                                  >

                                    Homemade Cookies

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151846527166"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 145.00

                                      </div>



                                      <del>Rs. 199.00</del>

                                    </div>

                                  </div>

                                </div>

                              </li>



                              <li class="products">

                                <div class="product-container">

                                  <a

                                    class="thumb grid__item"

                                    href="/collections/all/products/black-tea"

                                  >

                                    <img

                                      alt="featured product"

                                      src="//cdn.shopify.com/s/files/1/0505/1269/1390/products/Image-31_350X.jpg?v=1609755675"

                                    />

                                  </a>

                                </div>



                                <div class="product-detail">

                                  <a

                                    class="grid-link__title"

                                    href="/collections/all/products/black-tea"

                                  >

                                    Black Tea

                                  </a>

                                  <span

                                    class="shopify-product-reviews-badge"

                                    data-id="6151883718846"

                                  ></span>



                                  <div

                                    class="top-product-prices grid-link__meta"

                                  >

                                    <div class="product_price">

                                      <div class="grid-link__org_price">

                                        Rs. 200.00

                                      </div>

                                    </div>

                                  </div>

                                </div>

                              </li>

                            </ul>

                            <div

                              class="sidabar_nav top_products_nav sidebar-bestsellers"

                            ></div>

                          </div>

                        </div> -->



                        <script type="text/javascript">

                          $(document).ready(function () {

                            $(".top-products.sidebar-bestsellers").owlCarousel({

                              items: 1,

                              loop: false,

                              nav: true,

                              dots: false,

                              mouseDrag: false,

                              navContainer:

                                ".top_products_nav.sidebar-bestsellers",

                              navText: [

                                '<a class="prev btn active"><i class="fa fa-angle-left"></i></a>',

                                '<a class="next btn"><i class="fa fa-angle-right"></i></a>',

                              ],

                            });

                          });

                        </script>

                      </div>

                      <div

                        id="shopify-section-sidebar-banner"

                        class="shopify-section"

                      >

                        <div class="widget widget_promo_img">

                          <ul

                            class="owl-carousel owl-theme promo-carousel promo-carousel-sidebar-banner"

                          >

                            <li>

                              <a href="/collections" title="">

                                <img

                                  src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/1_500x500.jpg?v=1610456506"

                                  alt=""

                                  title=""

                                />

                              </a>

                            </li>

                          </ul>

                        </div>



                        <script type="text/javascript">

                          $(document).ready(function () {

                            $(".promo-carousel-sidebar-banner").owlCarousel({

                              loop: false,

                              // margin:10,

                              mouseDrag: false,

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