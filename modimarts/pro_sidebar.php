<div class="sidebar collection_sidebar mobileToggle">
                      <div id="shopify-section-sidebar-category" class="shopify-section" >
                        <div class="widget widget_product_categories">
                          <h4>Category</h4>
                          <ul class="product-categories dt-sc-toggle-frame-set dropdown multi-level-dropdown">
                         <?php
                         $categories=CategoryList('getCategoryList');
                         foreach ($categories as $key => $category) {
                        ?>
                          <li class="nav-item" >
                              <a class="nav-link" href="/catalog-product?category_id=<?=strcode($category->Category_id)?>">
                                <?php echo $category->Category; ?>
                              </a>
                          </li>

                        <?php } ?>
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
                        </div>

                      </div>

                    

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

                       <!--  <div class="widget widget_promo_img">

                          <ul

                            class="owl-carousel owl-theme promo-carousel promo-carousel-sidebar-banner"

                          >

                            <li>

                              <a href="#" title="">

                                <img

                                  src="#"

                                  alt=""

                                  title=""

                                />

                              </a>

                            </li>

                          </ul>

                        </div> -->



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