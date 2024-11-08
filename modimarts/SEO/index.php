<?php
session_start();
 include('head.php');
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



             <?php include('sidebar.php') ?>

            </div>

            <div class="grid__item wide--eight-tenths post-large--three-quarters">

              <!-- BEGIN content_for_index -->

              <div id="shopify-section-160319541064fa7c38" class="shopify-section index-section home-grid-banner">

                <div class="container-fluid">

                  <div class="grid-banner-type-4" style="margin-top: 0px; margin-bottom: 40px">

                    <div class="grid-uniform featuredItems">

                      <div class="grid__item wide--two-thirds post-large--two-thirds large--two-thirds medium--grid__item">

                        <div class="middle-center">

                          <div class="overlay style_1" id="safetycardbannerimg" onclick="safetyCardClick()" style="cursor:pointer;">

                            <div class="featured-image">

                              <a class="banner_half_img" style="cursor:pointer;" href="https://allmart.world/<?=strurl("My Safety card")?>/P/<?=strcode(711)?>/<?=strcode(803)?>/<?=strcode(1427)?>">

                               <!-- <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/slider_e47ed983-2e47-4656-b071-e914845f4c6f_1000X.jpg?v=1610346063" alt="A World Of Groceries" />-->
                               <img src="https://allmart.world/assets/mysafetycard.jpg" alt="My Safety Card" />

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



                                <!-- <p class="additional-text" style="color: #362929">



                                </p> -->
                       

                                  
                              <!--  <a class="btn link3" href="new_product.php?catid=220&catname=Grocery & Staples" style="

                                          background: #5f9f0d;

                                          color: #ffffff;

                                        ">Shop Now</a> -->
                    <!--<a class="btn" href="product_detail.php?pid=711&catid=803&prod_id=1427" style="background: #f26522;color: #ffffff;margin-bottom:60px;margin-right:60px;">Shop Now</a>-->
                              </div>

                            </div>

                          </div>

                        </div>

                      </div>
                      
                      <script>
                           function safetyCardClick(){
                               window.location = "https://allmart.world/<?=strurl("My Safety card")?>/P/<?=strcode(711)?>/<?=strcode(803)?>/<?=strcode(1427)?>";
                           }
                      </script>

                      <div class="grid__item wide--one-third post-large--one-third large--one-third medium--grid__item">

                        <div class="middle-top">

                          <div class="overlay style_1">

                            <div class="featured-image">

                              <a class="banner_half_img" href="https://allmart.world/list/<?=strurl('Spices & Masalas')?>/<?=strcode(777)?>">

                                <img src="https://allmart.world/ecom/adminpanel/images/cat/thumb/Malasas_Spices.jpg" alt="Organic Honey" />

                              </a>

                            </div>

                            <div class="featured-content featured-content--160319541064fa7c38 imageText_position imgtxt-middle-right">

                              <div class="content-info" style="background: rgba(0, 0, 0, 0)">

                                <h5 style="color: #ffffff">

                                Organic Indian Spices

                                </h5>



                                <h4 style="color:#ffffff">

                                Spices & Masalas

                                </h4>

                                <a class="link btn link1" href="https://allmart.world/list/<?=strurl('Spices & Masalas')?>/<?=strcode(777)?>" style="background: #f26522;color: #ffffff;">Shop Now</a>

                              </div>

                            </div>

                          </div>

                        </div>



                        <div class="middle-bottom">

                          <div class="overlay style_1">

                            <div class="featured-image">

                              <a class="banner_half_img" href="#">

                                <img src="assets/Health & Personal Care.jpg" alt="Health & Personal Care" />

                              </a>

                            </div>

                            <div class="featured-content featured-content--160319541064fa7c38 imageText_position imgtxt-middle-right">

                              <div class="content-info" style="background: rgba(0, 0, 0, 0)">

                                <h5 style="color: #0e9aec">Health Products</h5>
                                <h4 style="color:#0e9aec">
                                 Personal Care
                                </h4>
                                <a class="link btn link2" href="https://allmart.world/list/<?=strurl('Health & Personal Care')?>/<?=strcode(771)?>" style="
                                          background: #ffc29b;
                                          color: #000000;
                                        ">Shop Now </a>

                              </div>

                            </div>

                          </div>

                        </div>

                      </div>




                    </div>

                  </div>

                </div>



                <style>
                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_1 .ovrly,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_2 .ovrly:before,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_2 .ovrly:after,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_3 .ovrly,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_4 .ovrly,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_6 .ovrly,

                  #shopify-section-160319541064fa7c38.home-grid-banner .overlay.style_7 .ovrly {

                    background: #ffffff;

                  }



                  #shopify-section-160319541064fa7c38.home-grid-banner .featured-content--160319541064fa7c38 .btn.link1:hover {

                    background: #ffffff !important;

                    color: #000000 !important;

                  }

                  #shopify-section-160319541064fa7c38.home-grid-banner .featured-content--160319541064fa7c38 .btn.link2:hover {

                    background: #ffffff !important;

                    color: #000000 !important;

                  }

                  #shopify-section-160319541064fa7c38.home-grid-banner .featured-content--160319541064fa7c38 .btn.link3:hover {

                    background: #f26522 !important;

                    color: #ffffff !important;

                  }

                  #shopify-section-160319541064fa7c38.home-grid-banner .featured-content--160319541064fa7c38 .btn.link4:hover {

                    color:  !important;

                  }

                  #shopify-section-160319541064fa7c38.home-grid-banner .featured-content--160319541064fa7c38 .btn.link5:hover {

                    color:  !important;

                  }
                </style>

              </div>

              <div id="shopify-section-1603344186923" class="shopify-section index-section category-section home-featured-collections-3">

                <div class=" container-fluid ">

                  <div style="margin-top:0px; margin-bottom:6px;">



                    <div class="section-header section-header--small full-position-full-left">

                      <div class="border-title">

                        <h2 style="color:#000000;">Fashion </h2>



                      </div>

                    </div>







                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">

                      <div class="grid__item">

                        <div class="category-items-block">

                          <div class="category-carousel 1">

                            <?php

                            $sql_category = mysqli_query($con1, "select * from main_cat where under = 1 and status=1");

                            $i = 1;

                            while ($row = mysqli_fetch_assoc($sql_category)) {

                            ?>



                              <div class="category-item">

                                <a href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>">

                                  <img src="https://allmart.world/ecom/adminpanel/<?php echo $row['cat_img']; ?>" alt="" style="width:123px;height:123px;" />

                                  <h5><span></span></h5>

                                  <p><?php echo ucwords($row['name']); ?></p>

                                </a>

                              </div>

                            <?php $i++;
                            } ?>



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

                        <h2 style="color:#000000;">Electronic </h2>



                      </div>

                    </div>







                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">

                      <div class="grid__item">

                        <div class="category-items-block">

                          <div class="category-carousel 2">

                            <?php

                            $sql_category = mysqli_query($con1, "select * from main_cat where under = 190 and status=1");

                            $i = 1;

                            while ($row = mysqli_fetch_assoc($sql_category)) {

                            ?>



                              <div class="category-item">

                                <a href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>">

                                  <img src="https://allmart.world/ecom/adminpanel/<?php echo $row['cat_img']; ?>" alt="" style="width:123px;height:123px;" />

                                  <h5><span></span></h5>

                                  <p><?php echo ucwords($row['name']); ?></p>

                                </a>

                              </div>

                            <?php $i++;
                            } ?>



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

                        <h2 style="color:#000000;">Grocery </h2>



                      </div>

                    </div>







                    <div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">

                      <div class="grid__item">

                        <div class="category-items-block">

                          <div class="category-carousel 3">

                            <?php

                            $sql_category = mysqli_query($con1, "select * from main_cat where under = 218 and status=1");

                            $i = 1;

                            while ($row = mysqli_fetch_assoc($sql_category)) {

                            ?>



                              <div class="category-item">

                                <a href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>">

                                  <img src="https://allmart.world/ecom/adminpanel/<?php echo $row['cat_img']; ?>" alt="" style="width:123px;height:123px;" />

                                  <h5><span></span></h5>

                                  <p><?php echo ucwords($row['name']); ?></p>

                                </a>

                              </div>

                            <?php $i++;
                            } ?>



                          </div>



                          <div class="category_nav carousel-arrow  3"></div>



                        </div>

                      </div>

                    </div>



                  </div>

                </div>

                <script>
                  var homeFeaturedColl3 = function() {

                    $('.category-carousel.1').not('.slick-initialized').slick({

                      autoplay: true,

                      autoplaySpeed: 5000,

                      infinite: false,

                      slidesToShow: 7,

                      slidesToScroll: 1,

                      arrows: true,

                      dots: false,

                      appendArrows: '.carousel-arrow.1',

                      responsive: [

                        {

                          breakpoint: 1424,

                          settings: {

                            slidesToShow: 5,

                            slidesToScroll: 5,

                            infinite: true,

                            dots: true

                          }

                        },

                        {

                          breakpoint: 800,

                          settings: {

                            slidesToShow: 3,

                            slidesToScroll: 3

                          }

                        },

                        {

                          breakpoint: 480,

                          settings: {

                            slidesToShow: 1,

                            slidesToScroll: 1

                          }

                        }

                        // You can unslick at a given breakpoint now by adding:

                        // settings: "unslick"

                        // instead of a settings object

                      ]





                    })

                    $('.category-carousel.2').not('.slick-initialized').slick({

                      autoplay: true,

                      autoplaySpeed: 5000,

                      infinite: false,

                      slidesToShow: 7,

                      slidesToScroll: 1,

                      arrows: true,

                      dots: false,

                      appendArrows: '.carousel-arrow.2',

                      responsive: [

                        {

                          breakpoint: 1424,

                          settings: {

                            slidesToShow: 5,

                            slidesToScroll: 5,

                            infinite: true,

                            dots: true

                          }

                        },

                        {

                          breakpoint: 800,

                          settings: {

                            slidesToShow: 3,

                            slidesToScroll: 3

                          }

                        },

                        {

                          breakpoint: 480,

                          settings: {

                            slidesToShow: 1,

                            slidesToScroll: 1

                          }

                        }

                        // You can unslick at a given breakpoint now by adding:

                        // settings: "unslick"

                        // instead of a settings object

                      ]





                    })

                    $('.category-carousel.3').not('.slick-initialized').slick({

                      autoplay: true,

                      autoplaySpeed: 5000,

                      infinite: false,

                      slidesToShow: 7,

                      slidesToScroll: 1,

                      arrows: true,

                      dots: false,

                      appendArrows: '.carousel-arrow.3',

                      responsive: [

                        {

                          breakpoint: 1424,

                          settings: {

                            slidesToShow: 5,

                            slidesToScroll: 5,

                            infinite: true,

                            dots: true

                          }

                        },

                        {

                          breakpoint: 800,

                          settings: {

                            slidesToShow: 3,

                            slidesToScroll: 3

                          }

                        },

                        {

                          breakpoint: 480,

                          settings: {

                            slidesToShow: 1,

                            slidesToScroll: 1

                          }

                        }

                        // You can unslick at a given breakpoint now by adding:

                        // settings: "unslick"

                        // instead of a settings object

                      ]





                    })

                  }



                  $(document).ready(function() {

                    homeFeaturedColl3();

                  })



                  $(document)

                    .on('shopify:section:load', homeFeaturedColl3)

                    .on('shopify:section:unload', homeFeaturedColl3)
                </script>







                <style>
                  .category-section .category-items-block .category-item p {

                    color: #000000;



                  }

                  .category-section .category-items-block .category-item:hover {

                    background: #ffffff;

                  }

                  .category-section .category-items-block .category-item {



                    background: #f7f7f7;

                  }

                  .category-section .category-items-block .category-item:hover {

                    background: #f7b111;

                  }
                </style>

              </div>

              <div id="shopify-section-1601706923f6670fe3" class="shopify-section index-section home-product-grid">

                <div class="product-grid-block" style="

                          margin-top: 50px;

                          margin-bottom: 30px;

                          float: left;

                          width: 100%;

                          background-color: #ffffff;

                        ">

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





                            <?php include('featured_product.php');?>





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

                            <?php include('OurValueProducts.php'); ?>

                            </ul>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>



              </div>

              <div id="shopify-section-1601880173dbb2abaa" class="shopify-section index-section home-grid-banner">

                <div class="container-fluid">

                  <div class="grid-banner-type-2" style="margin-top: 15px; margin-bottom: 60px">

                    <div class="grid-uniform featuredItems tw-bl-grd tw-bl-grd">

                      <div class="grid__item wide--one-half post-large--one-half large--one-half medium--one-half two-blocks">

                        <div class="overlay style_1">

                          <div class="featured-image">

                            <img src="https://allmart.world/ecom/adminpanel/images/cat/thumb/Malasas_Spices.jpg" alt="Foodgrains & Spices" />

                          </div>



                          <div class="featured-content oneimage-1601880173dbb2abaa-0 imageText_position imgtxt-middle-left">

                            <div class="content-info">

                              <!-- <h5 style="color: #ffffff">

                                Masalas just $10

                              </h5> -->



                              <h4 style="color: #ffffff">

                                Foodgrains & Spices

                              </h4>



                              <!-- <p class="additional-text" style="color: #ffffff">

                                Get Upto 30% Off

                              </p> -->



                              <a class="btn" href="https://allmart.world/list/<?=strurl('Foodgrains & Spices')?>/<?=strcode('656')?>" style="color: #000000">Shop Now</a>

                            </div>

                          </div>

                        </div>

                      </div>



                      <div class="grid__item wide--one-half post-large--one-half large--one-half medium--one-half two-blocks">

                        <div class="overlay style_1">

                          <div class="featured-image">

                            <img src="https://allmart.world/ecom/adminpanel/images/cat/thumb/fruits_veg.jpeg" alt="Fruits & Beverages" />

                          </div>



                          <div class="featured-content oneimage-1601880173dbb2abaa-1 imageText_position imgtxt-middle-left">

                            <div class="content-info">

                              <!-- <h5 style="color: #ffffff">

                                Fruits just $10

                              </h5> -->



                              <h4 style="color: #ffffff">

                                Fruits & Beverages

                              </h4>



                              <!-- <p class="additional-text" style="color: #ffffff">

                                Get Upto 25% Off

                              </p> -->



                              <a class="btn" href="https://allmart.world/list/<?=strurl('Fruits & Beverages')?>/<?=strcode('219')?>" style="color: #000000">Shop Now</a>

                            </div>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>



                <style>
                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_1 .ovrly,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_2 .ovrly:before,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_2 .ovrly:after,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_3 .ovrly,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_4 .ovrly,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_6 .ovrly,

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .overlay.style_7 .ovrly {

                    background: #ffffff;

                  }



                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-0 .link:hover {

                    color: #ffffff !important;

                  }

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-0 .btn {

                    background: #ffffff;

                    color: #000000;

                  }

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-0 .btn:hover {

                    background-color: #f7b111;

                    color: #ffffff;

                  }



                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-1 .link:hover {

                    color: #ffffff !important;

                  }

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-1 .btn {

                    background: #ffffff;

                    color: #000000;

                  }

                  #shopify-section-1601880173dbb2abaa.home-grid-banner .featured-content.oneimage-1601880173dbb2abaa-1 .btn:hover {

                    background-color: #f26522;

                    color: #ffffff;

                  }
                </style>

              </div>




              <!-- END content_for_index -->

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

                                <div class="icon-img">

                                  <a href="">

                                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-image-1_fc0a0b49-2138-4a49-9b8b-e3a09c58327b_medium.png?v=1609397977" alt="Free DELIVERY" /></a>

                                </div>

                                <div class="support_text">

                                  <h4 style="color: #313131">

                                    Free DELIVERY

                                  </h4>



                                  <p style="color: #3f3f3f" class="desc">

                                    When ordering from ₹500.

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

                                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/icon-2_medium.png?v=1610357696" alt="90 Days Return" /></a>

                                </div>

                                <div class="support_text">

                                  <h4 style="color: #313131">

                                    90 Days Return

                                  </h4>



                                  <p style="color: #3f3f3f" class="desc">

                                    If goods have problems

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

                                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/icon-4_medium.png?v=1610357712" alt="Secure Payment" /></a>

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

                                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/icon-3_medium.png?v=1610357725" alt="24/7 Support" /></a>

                                </div>

                                <div class="support_text">

                                  <h4 style="color: #313131">

                                    24/7 Support

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



                <style>
                  .support-block-type .support_section .support-wrapper:hover .support_text h4::after {

                    background: #000000 !important;

                  }

                  .support-block-type .support_section .support-wrapper .support_text h4::after {

                    background:  !important;

                  }

                  .support-block-type .support-wrapper:hover .support_icon a::before {

                    background: ;

                  }

                  .support-block-type .support-wrapper:hover .support_icon a {

                    color: #000000 !important;

                  }
                </style>

              </div>



<div id="shopify-section-home-wide-banner-1" class="shopify-section index-section home-wide-banner">

  <div class="container">

    <div class="wide-banner-type" style="

              margin-top: 0px;

              margin-bottom: 0px;



              background-image: url('//cdn.shopify.com/s/files/1/0505/1269/1390/files/img-4_705773b7-20ef-4f02-b468-20850646d48c_1920X.jpg?v=1610355011');

              background-repeat: no-repeat;

              background-position: center center;

              background-attachment: fixed;

            ">

      <div class="grid-uniform CollectionItems">

        <div class="grid__item wide--one-whole banner-content text-center">

          <h6 style="color: #000000">100% Healthy & Affordable Price</h6>



          <h3 style="color: #b2b548">

            Original And genuine Brands <span style="color: #000000"></span>

          </h3>



          <div class="deal-content">

            <p style="color: #000000">Small Changes Big Difference</p>



            <script>
              //<![CDATA[

              jQuery(document).ready(function($) {

                $(".lof-clock-timer-detail").lofCountDown({

                  TargetDate: "",

                  DisplayFormat:

                    "<ul class='list-inline'><li class='day'>%%D%%<span>Days</span></li><li class='hours'>%%H%%<span>Hours</span></li><li class='mins'>%%M%%<span>Minutes</span></li><li class='seconds'>%%S%%<span>Seconds</span></li></ul>",

                  //FinishMessage: "Expired"

                });

              });

              //]]>
            </script>



            <div class="deal-btn">

              <a class="btn" href="https://allmart.world/list/<?=strurl('Value Offers')?>/<?=strcode(803)?>" style="

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



  <!-- <div id="shopify-section-home-brand-slider" class="shopify-section index-section client-logo">

    <div style="

            margin-top: 0px;

            margin-bottom: 0px;

            background-color: #f5f5f5;

            float: left;

            width: 100%;

          ">

      <div class="container-bg">

        <div class="grid-uniform">

          <div class="grid__item">

            <div class="client-logo-block">

              <div class="grid-uniform">

                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo-6_x150.png?v=1609399058" alt="" /></a>

                </div>



                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo5_x150.png?v=1609399068" alt="" /></a>

                </div>



                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo4_x150.png?v=1609399079" alt="" /></a>

                </div>



                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo3_x150.png?v=1609399093" alt="" /></a>

                </div>



                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo2_x150.png?v=1609399105" alt="" /></a>

                </div>



                <div class="logo-item grid__item wide--one-sixth post-large--one-sixth large--one-sixth medium--one-half small-grid__item">

                  <a href="">

                    <img src="//cdn.shopify.com/s/files/1/0505/1269/1390/files/D1-logo1_x150.png?v=1609399120" alt="" /></a>

                </div>

              </div>



              <div class="brand_nav carousel-arrow nav-middle"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <script type="text/javascript">

  window.brand_navigation = true;

  window.brand_pagination = true

</script>

  </div> -->

  <div id="shopify-section-home-newsletter" class="shopify-section index-section">

    <div data-section-id="home-newsletter" data-section-type="home-newsletter-block" class="home-newsletter-block" style="

            background-image: url('//cdn.shopify.com/s/files/1/0505/1269/1390/files/img-5_1920X.jpg?v=1610355697');

            background-repeat: no-repeat;

            background-attachment: fixed;

            background-position: center; ;

          ">

      <div class="newsletter-block style1">

        <div class="overlay"></div>

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

  <?php include('footer.php'); ?>