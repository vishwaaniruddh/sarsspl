<?php session_start();
include 'head.php';


$categorys=CategoryList('getCategoryList');
// $Total_records=$res_responce->Total_records;

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

 <form action="#" method="get">
 <select name="category_id"  onchange="this.form.submit()" >
  <option value="">Select Category</option>
<?php for ($i=0; $i <count($categorys) ; $i++) {  ?>
   <option value="<?=$categorys[$i]->Category_id?>" <?php if($category_id==$categorys[$i]->Category_id){ echo "selected";} ?> ><?=$categorys[$i]->Category?></option>
 <?php } ?>
 </select>
 </form>
 <br/>
 <div class="product-collection products-grid-view products-grid grid-uniform" >
  <?php


if(isset($_GET['category_id'])){
$category_id=$_GET['category_id'];
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&token=8cc6be81ea4f574acf24aa1aaae2252d&category_id=".$category_id;
}
else
{
 
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&token=8cc6be81ea4f574acf24aa1aaae2252d";
}


$resultres=GetCategoryList($addurl,'getProductList');
$products=$resultres->Records;
$total_rows=$resultres->Total_records;

$total_pages = ceil($total_rows / $no_of_records_per_page);

$nextpage = $pageno * $no_of_records_per_page;

if(isset($_GET['category_id'])){
$category_id=$_GET['category_id'];
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&start_point=".$offset."&end_point=".$nextpage."&token=8cc6be81ea4f574acf24aa1aaae2252d&category_id=".$category_id;
}
else
{
 
$addurl="https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=400%20&action=getProductList&start_point=".$offset."&end_point=".$nextpage."&token=8cc6be81ea4f574acf24aa1aaae2252d";
}

$resultres=GetCategoryList($addurl,'getProductList');;
$products=$resultres->Records;





   for ($j=0; $j < count($products) ; $j++) { 
    ?>
  <li class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

                              

                            >

                              <div class="products product-hover-11">

                                <div class="product-container">

                               

                                <a href="https://allmart.world/Product-Details/<?=$products[$j]->Product_id?>"> 

                              

                                    <div class="ImageOverlayCa"></div>



                                    <a href="https://allmart.world/Product-Details/<?=$products[$j]->Product_id?>">

                                      <img

                                        src="https://thebrandtadka.com/images_inventory_products/front_images/<?=$products[$j]->Product_image?>"

                                        class="featured-image"

                                        alt=""

                                        style="width:200px;height:200px;"

                                      />

                                    </a>

                                  </a>



                                  <div class="product_right_tag"></div>

                                  <div class="ImageWrapper">

                                    <div class="product-button">

                                      <div class="add-to-wishlist">

                                        <div class="show">

                                          <div

                                            class="default-wishbutton-black-tea loading"

                                          >

                                            <a

                                              title="Add to wishlist"

                                              class="add-in-wishlist-js"

                                              href="black-tea"

                                              ><i class="far fa-heart"></i

                                              ><span class="tooltip-label"

                                                >Add to wishlist</span

                                              ></a

                                            >

                                          </div>

                                          <div

                                            class="loading-wishbutton-black-tea loading"

                                            style="

                                              display: none;

                                              pointer-events: none;

                                            "

                                          >

                                            <a

                                              class="add_to_wishlist"

                                             

                                              ><i class="fas fa-spinner"></i

                                            ></a>

                                          </div>

                                          <div

                                            class="added-wishbutton-black-tea loading"

                                            style="display: none"

                                          >

                                            <a

                                              title="View Wishlist"

                                              class="added-wishlist add_to_wishlist"

                                              href="#"

                                              ><i class="fas fa-heart"></i

                                              ><span class="tooltip-label"

                                                >View Wishlist</span

                                              ></a

                                            >

                                          </div>

                                        </div>

                                      </div>



                                      <a

                                        href="javascript:void(0)"

                                        title="Quick View"

                                       

                                        class="quickview-button quick-view-text product_link"

                                        

                                        ><i class="fa fa-search"></i

                                      ></a>

                                    </div>

                                  </div>

                                </div>



                                <div class="product-detail">

                                  <!-- <p class="product-vendor">

                                    <span>Groca</span>

                                  </p> -->



                                  <a href="https://allmart.world/Product-Details/<?=$products[$j]->Product_id?>">

                            <?=$products[$j]->Title?>

            </a>



                                  <div class="grid-link__meta">

                                    <div class="product_price">

                                      <div

                                        class="grid-link__org_price"

                                        id="ProductPrice"

                                      >

                                      <span>₹ <?=$products[$j]->Price?></span>

                                      </div>

                                    </div>

                                  </div>



                                 

 <a

                                      class="add-cart-btn btn"

                                      title="Add to Cart"                                      
                                      

                                    >

                                      <i class="fas fa-cart-plus"></i> Add to

                                      Cart

                                    </a>



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
<?php } ?>

 </div>
 <br/>

    <?php
    if(isset($_GET['category_id'])){
      $catlink="&category_id=".$category_id;
      }
      else
      {
      $catlink="";
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