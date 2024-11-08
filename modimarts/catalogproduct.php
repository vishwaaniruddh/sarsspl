<?php session_start();
include 'head.php';

// $catid         = $_GET['catid'];

$categorys=CategoryList('getCategoryList');
// $Total_records=$res_responce->Total_records;
if(isset($_GET['range']))
{
   $is_range= '&s_price_range='.$_GET['range'];
}
else
{
    $is_range='';
}

if(isset($_GET['category_id'])){
$category_id=$_GET['category_id'];
}
else
{
  $category_id='';
}

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 50;
$offset = ($pageno-1) * $no_of_records_per_page;
?>

<style>
    .single-product .product-img .product-action-2 a{
        color:white;
    }

    .single-product .product-img .product-action-2{
        left: 8%;
    bottom: 42%;
    }
    .single-product .button-head{
        background: gray;
    }
    .card {
        height: 350px;
        width: 100%;
    }
    .single-product .product-content{
        margin-top:0px;
    }
    .single-product .product-content h3 {
        line-height: 10px;
    }
    .single-product {
         margin-top: 50px;
    }
</style>
<!-- Breadcrumbs -->
<nav class="breadcrumb" aria-label="breadcrumbs">

<div class="container-bg">

  <h1>Products</h1>



  <span>Home</span>

</div>

</nav>

<main class="main-content">
  <div class="dt-sc-hr-invisible-small"></div>
  <div class="wrapper">
    <div class="grid-uniform">
      <div class="grid__item">
        <div class="container-bg">
          <div class="grid__item">
            <div class="grid__item collection-template">
              <div class="collection-products position-change">
                <div class="grid__item wide--one-fifth post-large--one-quarter left-sidebar" >
                  <div class="col-sidebar" data-sidebar>
                    <div class="close-sidebar">
                      <svg aria-hidden="true"
                        data-prefix="fal"
                        data-icon="times"
                        role="img"
                        xmlns="https://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                        class="svg-inline--fa fa-times fa-w-10 fa-2x">
                        <path
                          fill="currentColor"
                          d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"
                          class=""
                        ></path>
                      </svg>
                    </div>
                    <?php include 'pro_sidebar.php'?>
                  </div>
                </div>
                <div class="collection_grid_template grid__item wide--four-fifths post-large--three-quarters" >
                  <div
                    id="shopify-section-collection-template"
                    class="shopify-section">
                    <div class="grid__item">
                      <div class="collection-grid">
                        <div class="grid-uniform grid-link__container col-main"
                          data-section-id="collection-template"
                          data-section-type="collection-template">
                          <div class="toolbar">
                           
                            <div class="view-mode grid__item wide--one-third post-large--four-tenths large--four-tenths" >
                              <div class="filters-toolbar__view-as toolbar-col"  data-view-as>
                                <label> View: </label>
                                <div class="view-mode">
                                  <span
                                    class="icon-mode icon-mode-list"

                                    data-col="1"

                                  ></span>

                                  <span

                                    class="icon-mode icon-mode-grid grid-2"

                                    data-col="2"

                                  ></span>

                                  <span

                                    class="icon-mode icon-mode-grid grid-3"

                                    data-col="3"

                                  ></span>

                                  <span

                                    class="icon-mode icon-mode-grid grid-4"

                                    data-col="4"

                                  ></span>

                                  <span

                                    class="icon-mode icon-mode-grid grid-5 active"

                                    data-col="5"

                                  ></span>

                                </div>

                              </div>

                            </div>



                            <div class="grid__item wide--five-tenths post-large--six-tenths large--six-tenths right" >
                          
                            <div class="filters-toolbar__limited-view toolbar-col"
                                data-limited-view
                              >

                              <?php 
                              if(isset($_GET['category_id'])){

                                $category_id=$_GET['category_id'];
                                }
                                else
                                {
                                  $category_id='';
                                }

                                if(isset($_GET['range']))
                                {
                                 $data= explode(':', $_GET['range']);
                                 $newdata=$data[1];

                                }
                                else
                                {
                                 $newdata='10000'; 
                                }
                                 ?>
                                 <input type="hidden" id="category_id" value="<?=$category_id?>">
                                  <div style="display: block;margin-right:5px;">
                              <input type="range" min="1" max="30000" value="<?=$newdata?>" class="slider" id="myRange">
                                  <p>Value: <span id="demo" name="price"></span></p>
                                  </div>
                                  <button onclick="getval()" class="btn">Search</button>
                              <div class="shop-top">
                            <div class="shop-shorter">
                                 <div class="single-shorter">
                                     
                                                   <script>
                                                       function getval()
                                                       {
                                                        //   alert(val);
                                                        var demo=$("#demo").text();
                                                        var newval="1:"+demo;
                                                         var currentLocation = $("#category_id").val();
                                                        if(newval!=0){
                                                       
                                                        if(currentLocation!=''){
                                                           window.location = "?category_id="+currentLocation+"&range="+newval;
                                                        }
                                                        else
                                                        {
                                                          window.location = "?range="+newval;  
                                                        }
                                                    }else
                                                    {
                                                         window.location = "?category_id="+currentLocation;
                                                       }
                                                    }
                                                   </script>                                         
                               



                                <script>
                                var slider = document.getElementById("myRange");
                                var output = document.getElementById("demo");
                                output.innerHTML = slider.value;

                                slider.oninput = function() {
                                  output.innerHTML = this.value;
                                }
                                </script>
                                <input type="hidden" name="filter_type" id="filter_type" value="0">
                              </div>
                </div> 

              </div>

                              </div>
                            </div>
                          </div>
                          <div class="product-collection products-grid-view products-grid grid-uniform" id="products"  >


         
  <?php


if(isset($_GET['category_id'])){
$category_id=$_GET['category_id'];
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&token=8cc6be81ea4f574acf24aa1aaae2252d&category_id=".$category_id.$is_range;
}
else
{
 
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&token=8cc6be81ea4f574acf24aa1aaae2252d".$is_range;
}


$resultres=GetCategoryList($addurl,'getProductList');
$products=$resultres->Records;
$total_rows=$resultres->Total_records;

$total_pages = ceil($total_rows / $no_of_records_per_page);

$nextpage = $pageno * $no_of_records_per_page;

if(isset($_GET['category_id'])){
$category_id=$_GET['category_id'];
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&start_point=".$offset."&end_point=".$nextpage."&token=8cc6be81ea4f574acf24aa1aaae2252d&category_id=".$category_id.$is_range;
}
else
{
 
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&start_point=".$offset."&end_point=".$nextpage."&token=8cc6be81ea4f574acf24aa1aaae2252d".$is_range;
}

$resultres=GetCategoryList($addurl,'getProductList');
$products=$resultres->Records;

$count=count($products);
if($count){



    foreach ($products as $key => $product) {
            $productname = $product->Title;
            $imageViewproduct="https://thebrandtadka.com/images_inventory_products/front_images/".$product->Product_image;
            $productprice=$product->Price;
            $productid=$product->Product_id;
            $offer_price=$product->Price;
            $discount=$product->Price;
            $finalPrice=$product->Price;
    ?>
  <li class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

                              id="product-6151883718846"

                              id="product-6151883718846"

                            >

                              <div class="products product-hover-11">

                                <div class="product-container">

                                

                                <a href="https://allmart.world/Product-Details/<?=$product->Product_id?>">

                           
                                    <div class="ImageOverlayCa"></div>


                                <a href="https://allmart.world/Product-Details/<?=$product->Product_id?>">

                              

                                      <img

                                        src="<?php echo $imageViewproduct;?>"

                                        class="featured-image"

                                        alt=""

                                        style="width:200px;height:200px;"

                                      />

                                    </a>

                                  </a>
                                  <?php if($finalPrice<$productprice){?>
                                   <div class="product_right_tag offer_exist">
                                    <span class="offer-price">
                                      <b><?php echo round((1 - ($finalPrice / $productprice)) * 100,0);?> % Off
                                    </b></span>
                                  </div>
                                  <?php } ?>
                                  <div class="ImageWrapper">
                                    <div class="product-button">
                                       <div class="add-to-wishlist">
                                          <div class="show">
                                              <div ><a title="Add to wishlist" onclick="addwishlist()"  href="javascript:void(0)"><i class="far fa-heart"></i><span class="tooltip-label">Add to wishlist</span></a></div>
                                           </div>
                                       </div>
                                     </div>
                                    </div>
                                  </div>

                                <div class="product-detail">


                                <a href="https://allmart.world/Product-Details/<?=$product->Product_id?>">

                             
                                <?=substr($productname,0,18).".."?>
                                </a>



                                  <div class="grid-link__meta">

                                    <div class="product_price">

                                      <div

                                        class="grid-link__org_price"

                                        id="ProductPrice"

                                      >

                                      <span>₹<?php echo $finalPrice;?></span>
                                      </div>

                                    </div>
                                    <del class="grid-link__sale_price" id="ComparePrice">
                                    <?php if($finalPrice<$productprice){ ?>
                                   <del style="color:red;">₹<?php echo $productprice;?></del>
                                      <?php } ?>
                                    </del>

                                  </div>


                                    <!-- <a

                                      class="add-cart-btn btn"

                                      title="Add to Cart"
                                      onclick="addtocart()"

                                    >

                                      <i class="fas fa-cart-plus"></i> Add to

                                      Cart

                                    </a> -->


                                  <script type="text/javascript">

                                    $(document).ready(function () {

                                      $(".item-swatch").each(function () {

                                        if ($(this).children().length == 0) {

                                          $(this).remove();

                                        } else {

                                          $(this).show();

                                        }

                                      });

                                      $(".sizes-list").each(function () {

                                        if ($(this).children().length == 0) {

                                          $(this).remove();

                                        } else {

                                          $(this).show();

                                        }

                                      });

                                    });

                                  </script>

                                </div>

                              </div>

                            </li>
  <!-- gat -->

<?php }
}
else {
     ?>
     <h3 style="margin:10px;">Sorry. No Product Available.</h3>
     <?php
 } ?>


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

<div class="dt-sc-hr-invisible-large"></div>

</main>

      
  <?php


    if(isset($_GET['range'])){
      $range="&range=".$_GET['range'];
      }
      else
      {
      $range="";
      }  

    if(isset($_GET['category_id'])){
      $catlink="&category_id=".$category_id.$range;
      }
      else
      {
      $catlink="".$range;
      } 
       ?>
       <div class="text-center padding">
  <?=$offset?> - <?=$nextpage?> Records Out Of <?=$total_rows?>
</div>
<div class="text-center padding">
<a href="?pageno=1<?=$catlink?>" class="btn">First</a>
 <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1).$catlink; } ?>" class="btn <?php if($pageno <= 1){ echo 'disabled'; } ?>" >Prev</a>
  <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1).$catlink; } ?>" class="btn <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>" >Next</a>
  <a href="?pageno=<?php echo $total_pages; ?><?=$catlink?>" class="btn">Last</a>
</div>
 <?php include 'footer.php';?>