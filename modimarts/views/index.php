<?php
include 'header/head.php';
?>
<!-- CSS File -->
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'header/main.css';?>
</head>
<body>
<?php include 'header/total_product.php';?>
</body>
</html>
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
             <?php include 'common/leftmost.php'?>
            </div>
          <div class="grid__item wide--eight-tenths post-large--three-quarters">
              <!-- BEGIN content_for_index -->
              <div id="shopify-section-160319541064fa7c38" class="shopify-section index-section home-grid-banner">
                <div class="container-fluid">
                  <div class="grid-banner-type-4" style="margin-top: 0px; margin-bottom: 40px">
                    <div class="grid-uniform featuredItems">
                      <div class="grid__item wide--two-thirds post-large--two-thirds large--two-thirds medium--grid__item">
                        <?php include 'center/center.php';?>
                      <script>
                           function safetyCardClick(){
                               window.location = "https://allmart.world/<?=strurl("My Safety card")?>/P/<?=strcode(711)?>/<?=strcode(803)?>/<?=strcode(1427)?>";
                           }
                      </script>
                      <?php include 'common/rightmost.php';?>
<div id="shopify-section-1603344186923" class="shopify-section index-section category-section home-featured-collections-3">
                <div class=" container-fluid ">
                  <div style="margin-top:0px; margin-bottom:6px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Women</h2>
                      </div>
                    </div>
		<?php include 'common/women.php';?>
		</div>
</div>
<div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:0px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Men </h2>
                      </div>
                    </div>
		<?php include 'common/men.php';?>
		 </div>
</div>
<div class=" container-fluid ">
                  <div style="margin-top:41px; margin-bottom:0px;">
                    <div class="section-header section-header--small full-position-full-left">
                      <div class="border-title">
                        <h2 style="color:#000000;">Kid's </h2>
                      </div>
                    </div>
		<?php include 'common/kids.php';?>
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
                         <?php include 'common/featured_products.php';?>
                         </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
</div>
<?php include 'carousel/valueofferdiv.php';?>		
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
<?php include 'common/secureandsupport.php';?>
<?php include 'common/originalandgenuine.php';?>
<?php include 'common/newsletter.php';?>

<?php include 'footer/footer.php';?>