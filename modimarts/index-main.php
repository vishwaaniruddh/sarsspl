<?php
session_start();
include 'head.php';
?>
<main class="main-home-content">
  <div class="wrapper">
    <div class="grid-uniform">
      <div class="grid__item">
        <div class="container-bg">
          <div class="grid-uniform">
            <div class="col-sidebar" data-sidebar>
              <div class="close-sidebar">
                <svg aria-hidden="true" data-prefix="fal" data-icon="times" role="img" xmlns="https://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-times fa-w-10 fa-2x">
                  <path fill="currentColor" d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z" class=""></path>
                </svg>
              </div>
             <?php include 'sidebar.php'?>
            </div>
          <div class="grid__item wide--eight-tenths post-large--three-quarters">
              <!-- BEGIN content_for_index -->
              <div id="shopify-section-160319541064fa7c38" class="shopify-section index-section home-grid-banner">
                <div class="container-fluid">
                  <div class="grid-banner-type-4" style="margin-top: 0px; margin-bottom: 40px">
                    <div class="grid-uniform featuredItems">
                      <div class="grid__item wide--two-thirds post-large--two-thirds large--two-thirds medium--grid__item">
                        <?php 
                        $getcenter=mysqli_query($con1,"SELECT * FROM `homepage_ads` WHERE `position`='2' LIMIT 0,2");
                        foreach ($getcenter as $key => $center) {
                           ?>

                        <div class="grid__item wide--one-half post-large--one-half large--one-half medium--one-half two-blocks">
                          <a href="<?=$center['url']?>">
                           <div class="middle-center">
                            <a href="<?=$center['url']?>">
                          <div class=" style_1"  style="cursor:pointer;">
                            <div class="featured-image">
                              <a class="banner_half_img" style="cursor:pointer;" href="<?=$center['url']?>">
                               <img loading="lazy" src="<?=$center['img_path']?>" alt="<?=$center['name']?>"  />
                              </a>
                            </div>
                            <div class="featured-content featured-content--160319541064fa7c38 imageText_position imgtxt-middle-right">
                              <div class="content-info" style="background: rgba(0, 0, 0, 0)">
                                <h3 style="color: #ff4349">
                                 <!-- Organic & chemical free products -->
                                </h3>
                                <h2 style="color: #5f9f0d">
                                 <!-- A World Of Groceries -->
                                </h2>
                             
                              </div>

                            </div>

                          </div>
                          </a>
                          

                        </div>
                        
                       </a>
                        </div>
                      <?php } ?>
                                               
                       

                      </div>
                     
                      <div class="grid__item wide--one-third post-large--one-third large--one-third medium--grid__item">
                        <?php 
                        $getright=mysqli_query($con1,"SELECT * FROM `homepage_ads` WHERE `position`='3' LIMIT 0,2");
                        foreach ($getright as $key => $right) {
                          
                         ?>
                        <div class="middle-top" style="border: 1px solid; border-radius:15px; padding:5px; color: #D6D6D4">
                          <div class=" style_1">
                            <div class="featured-image">
                              <a class="banner_half_img" href="<?=$right['url']?>">
                                <img loading="lazy" src="<?=$right['img_path']?>" alt="<?=$right['name']?>" />
                              </a>
                            </div>
                         
                          </div>
                        </div>
                      <?php 
                    }
                     ?>
                        
                    </div>
                    </div>
                  </div>
                </div>
           </div>
              <div id="shopify-section-1603344186923" class="shopify-section index-section category-section home-featured-collections-3">
                <div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:6px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Value Offer Products </h2>
                      </div>
                    </div>
                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">
                      <div class="grid__item">
                        <div class="category-items-block">
                          <div class="category-carousel 3">
                           
                          <!--ITEM-->
                          <div class="category-item">
                                <a href="/wow-probiotics-stronger-imunity/P/701/803/1397">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146808870.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>probiotics</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                          <!--ITEM-->
                          <div class="category-item">
                                <a href="/shampoo---activated-charcoal-keratin---wow---300ml/P/649/803/1346">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146726180.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>activated-charcoal</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                          <!--ITEM-->
                          <div class="category-item">
                                <a href="/hair-vanish---for-men---wow---100-ml/P/659/803/1356">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146874230.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>hair-vanish</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                          <!--ITEM-->
                          <div class="category-item">
                                <a href="/mask---n95---wildcraft---6-layer-q1/P/718/803/1429">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/06/16238428190.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>N 95 Mask</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                          <!--ITEM-->
                          <div class="category-item">
                                <a href="/mask---n95-----q2/P/655/803/1352">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146815880.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>MASK</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/sanitizer---with-neem-and-aloe-vera---bajaj---200-ml/P/713/803/1320">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/06/16239306200.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>sanitizer</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/shampoo---hardwater-defense---wow---300ml/P/651/803/1348">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146808870.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>Hardwater Defense</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/shampoo---hair-strengthening---wow---300ml/P/652/803/1349">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146810240.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>shampoo</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/essentitial-oil---sweet-orange---wow---15ml/P/662/803/1359">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146911930.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>essentitial-oil</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/face-cream---oil-control---himalaya---25-gms/P/677/803/1373">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/06/16239408840.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>himalaya oil-control</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              <!--ITEM-->
                          <div class="category-item">
                                <a href="/essentitial-oil---peppermint---wow---15ml/P/663/803/1360">
                                  
                                  <img loading="lazy" src="/ecom/userfiles/570/img/2021/03/16146935740.jpg" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p>peppermint essentitial Oil</p>
                                </a>
                              </div>
                              <!--ITEM END-->
                              
                          </div>
                          <div class="category_nav carousel-arrow 3"></div>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                 <div class=" container-fluid ">

                  <div style="margin-top:41px; margin-bottom:6px;">



                    <div class="section-header section-header--small full-position-full-left">

                      <div class="border-title">

                        <h2 style="color:#000000;">Offers Today </h2>



                      </div>

                    </div>

                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">

                      <div class="grid__item">

                        <div class="category-items-block">

                          <div class="category-carousel 1">
                           <?php include("TodayOffersSection.php"); ?>
                           </div>
                          <div class="category_nav carousel-arrow  1"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:6px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Women</h2>
                      </div>
                    </div>
                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">
                      <div class="grid__item">
                        <div class="category-items-block">
                          <div class="category-carousel 1">
                            <?php
                                $gtwomen=GetCategoryProduct(3);
                                  foreach ($gtwomen as $key => $wopro) {
                                  ?>
                              <div class="category-item">
                                <a href="/catalog-product?category_id=<?=strcode($wopro->Category_id)?>">
                                  <?php $proimg= getcatimg($wopro->Category_id); ?>
                                  <img loading="lazy" src="https://thebrandtadka.com/images_inventory_products/front_images/<?php echo $proimg; ?>" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p><?php echo ucfirst($wopro->Category); ?></p>
                                </a>
                              </div>
                            <?php
                                  }
                                  ?>
                          </div>
                          <div class="category_nav carousel-arrow  1"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:0px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Men </h2>
                      </div>
                    </div>
                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">
                      <div class="grid__item">
                        <div class="category-items-block">
                          <div class="category-carousel 2">
                            <?php
                                $mens=GetCategoryProduct(2);
                                  foreach ($mens as $key => $men) {
                            ?>
                              <div class="category-item">
                                <a href="/catalog-product?category_id=<?=strcode($men->Category_id)?>">
                                  <?php $proimg= getcatimg($men->Category_id); ?>
                                  <img loading="lazy" src="https://thebrandtadka.com/images_inventory_products/front_images/<?php echo $proimg; ?>" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p><?php echo ucfirst($men->Category); ?></p>
                                </a>
                              </div>
                            <?php
                                  }
                                  ?>
                          </div>
                          <div class="category_nav carousel-arrow  2"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:0px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Kid's </h2>
                      </div>
                    </div>
                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">
                      <div class="grid__item">
                        <div class="category-items-block">
                          <div class="category-carousel 3">
                           <?php
                                $kids=GetCategoryProduct(1);
                                  foreach ($kids as $key => $kid) {
                                  ?>
                              <div class="category-item">
                                <a href="/catalog-product?category_id=<?=strcode($kid->Category_id)?>">
                                  <?php $proimg= getcatimg($kid->Category_id); ?>
                                  <img loading="lazy" src="https://thebrandtadka.com/images_inventory_products/front_images/<?php echo $proimg; ?>" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p><?php echo ucfirst($kid->Category); ?></p>
                                </a>
                              </div>
                            <?php
                                  }
                                  ?>
                          </div>
                          <div class="category_nav carousel-arrow  3"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div id="shopify-section-1601706923f6670fe3" class="shopify-section index-section home-product-grid">
                <div class="product-grid-block" style="margin-top: 50px; margin-bottom: 30px; float: left; width: 100%; background-color: #ffffff;">

                  <div class="full">
                    <div class="product-block-inner">
                      <div class="section-header section-header--small full-position-full-left">
                        <div class="border-title">

                          <h2 class="section-header__title" style="color: #262626">

                            Featured Products

                          </h2>

                        </div>

                      </div>
                      <div class="grid-uniform">

                        <div class="grid__item product-grid-none default">

                          <div class="product-block load-wrapper">

                            <ul class="grid-uniform">
                         <?php include 'featured_product.php';?>





                            </ul>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>
              </div>

              <div id="shopify-section-1603253149d62f2c0d" class="shopify-section index-section home-product-grid">

                <div class="product-grid-block" style="

                          margin-top: 20px;

                          float: left;

                          width: 100%;

                          background-color: #ffffff;

                        ">

                  <div class="full">


                    <div class="product-block-inner">

                      <div class="section-header section-header--small full-position-full-left">

                        <div class="border-title">

                          <h2 class="section-header__title" style="color: #000000">

                            Our Value Products

                          </h2>

                        </div>

                      </div>



                      <div class="grid-uniform">

                        <div class="grid__item product-grid-none default">

                          <div class="product-block load-wrapper">

                            <ul class="grid-uniform">

                            <?php include 'OurValueProducts.php';?>

                            </ul>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>



              </div>

             




             

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</main>


              <div id="shopify-section-16018828935b857ec5" class="shopify-section index-section support-block-type">

                <div class="support-block-inner" style="

                          background: #fbfbfb;

                          margin-top: 0px;

                          margin-bottom: 45px;

                        ">

                  <div class="grid-uniform">

                    <div class="container">

                      <div class="grid__item"></div>

                      <div class="support-blk-section style1">

                        <ul class="support_block">

                          <li class="grid__item wide--one-quarter post-large--one-quarter large--one-half medium--one-half small-grid__item" data-wow-delay="ms">

                            <div class="support_section align-center">

                              <div class="support-wrapper">

                               



                          



                          <li class="grid__item wide--one-quarter post-large--one-quarter large--one-half medium--one-half small-grid__item" data-wow-delay="ms">

                            <div class="support_section align-center">

                              <div class="support-wrapper">

                                <div class="icon-img">

                                  <a href="">

                                    <img loading="lazy" src="/assets/icon-4_medium.png" alt="Secure Payment" /></a>

                                </div>

                                <div class="support_text">

                                  <h4 style="color: #313131">

                                    Secure Payment

                                  </h4>



                                  <p style="color: #3f3f3f" class="desc">

                                    100% secure payment

                                  </p>

                                </div>

                              </div>

                            </div>

                          </li>



                          <li class="grid__item wide--one-quarter post-large--one-quarter large--one-half medium--one-half small-grid__item" data-wow-delay="ms">

                            <div class="support_section align-center">

                              <div class="support-wrapper">

                                <div class="icon-img">

                                  <a href="">

                                    <img loading="lazy" src="/assets/icon-3_medium.png" alt=" Support" /></a>

                                </div>

                                <div class="support_text">

                                  <h4 style="color: #313131">

                                   Support

                                  </h4>
                                  <p style="color: #3f3f3f" class="desc">

                                    Dedicated support

                                  </p>

                                </div>

                              </div>

                            </div>
                          </li>

                        </ul>

                      </div>

                    </div>

                  </div>

                </div>




              </div>



<div id="shopify-section-home-wide-banner-1" class="shopify-section index-section home-wide-banner">

  <div class="container">

    <div class="wide-banner-type" style="

              margin-top: 0px;

              margin-bottom: 0px;

              background-color: #86cfe8;

              

              background-repeat: no-repeat;

              background-position: center center;

              background-attachment: fixed;

            ">
<!-- background-image: url('/assets/img-4_705773b7-20ef-4f02-b468-20850646d48c_1920X.jpg');-->
      <div class="grid-uniform CollectionItems">

        <div class="grid__item wide--one-whole banner-content text-center">

          <h6 style="color: #000000">At Affordable Price</h6>



          <h3 style="color: #b2b548">

            Original And genuine Brands <span style="color: #000000"></span>

          </h3>



          <div class="deal-content">

            <p style="color: #000000">Small Changes Big Difference</p>



            



            <div class="deal-btn">

              <a class="btn" href="/list/<?=strurl('Value Offers')?>/<?=strcode(803)?>" style="

                        border: none;

                        color: #000000;

                        background-color: #ffffff;

                      ">Shop Now</a>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div id="shopify-section-home-blog-posts-2" class="shopify-section index-section home-blog-type">





  <div id="shopify-section-home-newsletter" class="shopify-section index-section">

    <div data-section-id="home-newsletter" data-section-type="home-newsletter-block" class="home-newsletter-block" style="

            background-image: url('/assets/img-5_1920X.jpg');

            background-repeat: no-repeat;

            background-attachment: fixed;

            background-position: center; ;

          ">

      <div class="newsletter-block style1">

        

        <div class="dt-sc-hr-invisible-large"></div>

        <div class="container">

          <div class="news-inner-block">

            <div class="section-header section-header--small full-position-default">

              <div class="border-title wow">

                <h2 class="newslet_title" style="color: #000000">

                  Newsletter

                </h2>



                <p style="color: #000000">

                  Subscribe to the weekly newsletter for all the latest

                  updates

                </p>

              </div>

            </div>



            <div class="mc-embedded-subscribe-form wow fadeInUp animated">

              <form method="post" action="/contact#contact_form" id="contact_form" accept-charset="UTF-8" class="contact-form">

                <input type="hidden" name="form_type" value="customer" /><input type="hidden" name="utf8" value="✓" />



                <div class="contact-input">

                  <input type="email" value="" placeholder="Enter your email" name="contact[email]" class="mail" aria-label="Enter your email" required="required" />

                  <input type="hidden" name="contact[tags]" value="newsletter" />

                  <button type="submit" class="btn subscribe" name="subscribe" value="">

                    Subscribe

                  </button>

                </div>

              </form>

            </div>

          </div>

        </div>

        <div class="dt-sc-hr-invisible-large"></div>

      </div>

    </div>

  </div>

  <?php include 'footer.php';?>