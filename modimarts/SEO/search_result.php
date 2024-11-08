<?php
 session_start(); 
include('head.php');
 global $con1;

if($_SESSION['gid']){
    $userid = $_SESSION['gid'];
    $username = get_username($userid);
    
}


function Getimg($pid,$cid,$prod_id)
	{
	     global $con1;
	   
		$qrya           = "SELECT * FROM `main_cat` WHERE `id`='$cid'";
		$resulta        = mysqli_query($con1, $qrya);
		$rowa           = mysqli_fetch_row($resulta);
    	$aa             = $rowa[2];
    	
    	

		
		if ($cid == 80)
			{
				$maincatid      = 5;
				$sql            = "select * from  `garment_product` where product_for='" . $maincatid . "' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0)";
			}
		else
			{
				if ($aa != 0)
					{
						$qrya1          = "select * from main_cat where id='" . $aa . "'";
						$resulta1       = mysqli_query($con1, $qrya1);
						$rowa1          = mysqli_fetch_row($resulta1);
						$Maincate       = $rowa1[4];
					}
				
			}
		
		if ($Maincate == 1)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `fashion_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 190)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$pid' order by id asc  limit 0,1");
				//  $imgrow=mysqli_fetch_row($sqlimg23mn);
				//  echo "SELECT img,thumbs,midsize,largeSize FROM `electronics_img` WHERE `product_id`='$prod_id' order by id asc  limit 0,1";
				
			}
		else if ($Maincate == 218)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `grocery_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 760)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `kits_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 657)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `service_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else if ($Maincate == 767)
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `promotion_product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		else
			{
				$sqlimg23mn     = mysqli_query($con1, "SELECT img,thumbs,midsize,largeSize FROM `product_img` WHERE `product_id`='$pid' order by id asc limit 0,1");
			}
		$frtu           = mysqli_fetch_array($sqlimg23mn);
		
		if (isset($_GET['gid']))
			{
				$jewellery      = false;
				// $maincatid = ' in(5,10,22,27,28)';
				if ($cid == 80)
					{
						$maincatid      = ' in(22,27,28,29)';
					}
				else if ($cid == 82)
					{
						$maincatid      = ' in(8)';
					}
				else if ($cid == 84)
					{
						$maincatid      = ' in(10)';
					}
				else if ($cid == 85)
					{
						$maincatid      = ' in(5)';
					}
				else if ($cid == 117)
					{
						// jewellery
						$jewellery      = true;
						$maincatid      = ' in(19)';
					}
				else if ($cid == 117)
					{
						// jewellery
						$jewellery      = true;
						$maincatid      = ' in(19)';
					}
				if ($jewellery)
					{
						$prcode         = $data['product_code'];
						$sql            = "SELECT * FROM `product` WHERE `categories_id` " . $maincatid . " and product_id=" . $_GET['gid'];
						$sqlimg         = "SELECT img_name FROM `product_images_new` WHERE `product_id`=" . $_GET['gid'];
					}
				else
					{
						$prcode         = $data['gproduct_code'];
						$sql            = "select * from  `garment_product` where product_for " . $maincatid . " and gproduct_id=" . $_GET['gid'];
						$sqlimg         = "SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=" . $_GET['gid'];
					}
				// $sql="select * from  `garment_product` where product_for ".$maincatid." and gproduct_id=".$_GET['gid'];
				$result         = mysqli_query($con1, $sql);
				$data           = mysqli_fetch_array($result);
				//print_r($data);
				if ($jewellery)
					{
						$prcode         = $data['product_code'];
					}
				else
					{
						$prcode         = $data['gproduct_code'];
					}
				$rate_qry       = mysqli_query($con1, "SELECT unit_price,cost_price,quantity FROM phppos_items where name like '" . $prcode . "'");
				$rate           = mysqli_fetch_row($rate_qry);
				// $sqlimg="SELECT img_name FROM `product_images_new` WHERE `gproduct_id`=".$_GET['gid'];
				// echo $sqlimg;
				$qryimg         = mysqli_query($con1, $sqlimg);
				$rowimg         = mysqli_fetch_row($qryimg);
				$path           = trim($pathmain . "uploads" . $rowimg[0]);
				$expl           = explode('/', $path);
				$pth1           = trim($pathmain . "mid1/" . $expl[$cnt - 1]);
				
				$pro_img        = "http://yosshitaneha.com/" . $path;

				return $pro_img;
			}
		else
			{
				$categogy       = $cid;
				$prod_id        = $prod_id;
				$cust_pid       = $pid;
				if ($categogy == '761')
					{
						$pro_img        = 'https://allmart.world/ecom/' . get_kit_info($cust_pid, 'photo');
					}
				else
					{
						$pro_img        = 'https://allmart.world/ecom/' . $frtu[0];
					}
			}
			return $pro_img;
	}
?>


<? 

$search = $_REQUEST['search'];

function get_electronics_image($id){
    global $con1;
    
    $sql = mysqli_query($con1,"select * from electronics_img where product_id ='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['thumbs'];
}


?>


<?
// function get_parent_cat($cat){
//     global $con1;
//     $sql = mysqli_query($con1,"select * from main_cat where id='".$cat."'");
//     $sql_result = mysqli_fetch_assoc($sql);
//     if($sql_result['under']==0){
//         return '0';
//     }
//     else{
//         return $sql_result['under'];
//     }
// }

// function level_one($id){
    
// }
// if(get_parent_cat(762)!=0){
//     echo get_parent_cat(762);
// }


// // echo get_parent_cat(218);



// return;



$supported_image = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);



if($search){

$view = "(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join electronics as pd on pm.id=pd.name where pm.product_model like '%".$search."%'  and pm.status=1  order by pd.price ) as p group by p.product_model) 

UNION 

(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join fashion as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)
UNION


(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join grocery as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1 order by pd.price ) as p group by p.product_model)

UNION

(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join services as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)


UNION

(select p.* from (select pm.product_model,pm.offer_price,pm.allmart_commission,pm.category_id,pd.code,pd.price,pd.total_amt,pd.name,pd.photo from product_model as pm join products as pd on pm.id=pd.name where pm.product_model like '%".$search."%' and pm.status=1  order by pd.price ) as p group by p.product_model)";





$view=mysqli_query($con1,$view);
    
    
$jwel = mysqli_query($con1, "SELECT * FROM product WHERE product_name like '%".$search."%'  and status=1 order by product_id desc limit 200");


$garment =mysqli_query($con1,"select * from  `garment_product` where gproduct_name like '%".$search."%' and  gproduct_id in(select gproduct_id from product_images_new where gproduct_id>0) and status=1  order by garment_id desc limit 200");
 
 
 if(mysqli_num_rows($view) || mysqli_num_rows($jwel) || mysqli_num_rows($garment)){
     

 
 

?>



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

                <div

                  class="grid__item wide--one-fifth post-large--one-quarter left-sidebar"

                >

               <?php include('pro_sidebar.php'); ?>

                </div>

                <div

                  class="collection_grid_template grid__item wide--four-fifths post-large--three-quarters"

                >

                  <div

                    id="shopify-section-collection-template"

                    class="shopify-section"

                  >

                    <div class="grid__item">

                      <div class="collection-grid">

                        <div

                          class="grid-uniform grid-link__container col-main"

                          data-section-id="collection-template"

                          data-section-type="collection-template"

                        >

                          <div class="toolbar">

                            <div class="sidebar-label">

                              <div class="sidebar-button">

                                <div class="tags-filter">

                                  <button

                                    id="showTagsFilter"

                                    class="btn tag-fillter"

                                  >

                                    <svg

                                      data-name="Layer 1"

                                      id="Layer_1"

                                      viewBox="0 0 48 48"

                                      xmlns="http://www.w3.org/2000/svg"

                                    >

                                      <title></title>

                                      <path

                                        d="M47,12a2,2,0,0,0-2-2H24a2,2,0,0,0,0,4H45A2,2,0,0,0,47,12Z"

                                      ></path>

                                      <path

                                        d="M3,14H8.35a6,6,0,1,0,0-4H3a2,2,0,0,0,0,4Zm11-4a2,2,0,1,1-2,2A2,2,0,0,1,14,10Z"

                                      ></path>

                                      <path

                                        d="M45,22H37.65a6,6,0,1,0,0,4H45a2,2,0,0,0,0-4ZM32,26a2,2,0,1,1,2-2A2,2,0,0,1,32,26Z"

                                      ></path>

                                      <path

                                        d="M22,22H3a2,2,0,0,0,0,4H22a2,2,0,0,0,0-4Z"

                                      ></path>

                                      <path

                                        d="M45,34H28a2,2,0,0,0,0,4H45a2,2,0,0,0,0-4Z"

                                      ></path>

                                      <path

                                        d="M18,30a6,6,0,0,0-5.65,4H3a2,2,0,0,0,0,4h9.35A6,6,0,1,0,18,30Zm0,8a2,2,0,1,1,2-2A2,2,0,0,1,18,38Z"

                                      ></path>

                                    </svg>

                                    Refine by

                                  </button>

                                  <!-- <button id="showTagsFilter2" class="btn tag-fillter"><i class="fa fa-sliders"></i></button> -->

                                </div>

                              </div>

                            </div>



                            <div

                              class="view-mode grid__item wide--one-third post-large--four-tenths large--four-tenths"

                            >

                              <div

                                class="filters-toolbar__view-as toolbar-col"

                                data-view-as

                              >

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



                            <div

                              class="grid__item wide--five-tenths post-large--six-tenths large--six-tenths right"

                            >

                              <div

                                class="filters-toolbar__limited-view toolbar-col"

                                data-limited-view

                              >

                                <label> Show: </label>



                                <div class="limited-view">

                                  <div

                                    class="label-tab"

                                    data-toggle="dropdown"

                                    aria-expanded="false"

                                  >

                                    <span name="paginateBy" class="label-text">

                                      20

                                    </span>



                                    <span class="icon-dropdown">

                                      <i class="fa fa-chevron-down"></i>

                                    </span>

                                  </div>



                                  <ul class="dropdown-menu">

                                    <li>

                                      <span data-value="8"> 8 </span>

                                    </li>

                                    <li>

                                      <span data-value="12"> 12 </span>

                                    </li>

                                    <li>

                                      <span data-value="16"> 16 </span>

                                    </li>

                                    <li class="active">

                                      <span data-value="20"> 20 </span>

                                    </li>

                                    <li>

                                      <span data-value="24"> 24 </span>

                                    </li>

                                    <li>

                                      <span data-value="30"> 30 </span>

                                    </li>

                                    <li>

                                      <span data-value="50"> 50 </span>

                                    </li>

                                  </ul>

                                </div>

                              </div>



                              <div class="filter-sortby toolbar-col">

                                <label for="sort-by">Sort by:</label>

                                <input type="text" id="sort-by" />

                                <div class="sorting-section">

                                  <button

                                    class="btn dropdown-toggle"

                                    data-toggle="dropdown"

                                  >

                                    <span>Featured</span>

                                  </button>



                                  <ul class="dropdown-menu" role="menu">

                                    <li class="active">

                                      <a href="manual">Featured</a>

                                    </li>

                                    <li>

                                      <a href="price-ascending"

                                        >Price, low to high</a

                                      >

                                    </li>

                                    <li>

                                      <a href="price-descending"

                                        >Price, high to low</a

                                      >

                                    </li>

                                    <li>

                                      <a href="title-ascending"> A-Z</a>

                                    </li>

                                    <li>

                                      <a href="title-descending">Z-A</a>

                                    </li>

                                    <li>

                                      <a href="created-ascending"

                                        >Date, old to new</a

                                      >

                                    </li>

                                    <li>

                                      <a href="created-descending"

                                        >Date, new to old</a

                                      >

                                    </li>

                                    <li>

                                      <a href="best-selling">Best Selling</a>

                                    </li>

                                  </ul>

                                </div>

                              </div>

                            </div>

                          </div>



                          <div

                            class="product-collection products-grid-view products-grid grid-uniform"

                          >



                                       
   
       
                          <? while($view_result = mysqli_fetch_assoc($view)){ 
    
    $getipuaevts2=mysqli_query($con1,"SELECT * FROM `fashion_img` WHERE product_id='".$view_result['code']."'");
    $rws3=mysqli_fetch_assoc($getipuaevts2);
   
    $cat = $view_result['category_id'];
   
    $productname=$view_result["product_model"];
    $imageViewproduct="https://allmart.world/ecom/".$rws3['img'];
    $productprice=$view_result["price"];
    $productid=$view_result["name"];
    $offer_price=$view_result["offer_price"]; 
    $finalPrice=$view_result["total_amt"];
    $allmart_commission = $view_result['allmart_commission'];
    
    
    
            
            
if($cat =='205'){
    $code = $view_result['code'];
    $image = get_electronics_image($code);
    
}else{
    if(!file_exists($imageViewproduct)){
     $image = $view_result['photo'];
    }else{
     $image = $rws3['img'];
    }
   //  $image = $rws3['img'];
}
            

    $name = $view_result['product_model'];
    
    
    $getimgdata=Getimg($view_result['code'],$view_result['category_id'],$view_result['name']);
    // var_dump($getimgdata);
    ?>
    
<li class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

                              id="product-6151883718846"

                              id="product-6151883718846"

                            >

                              <div class="products product-hover-11">

                                <div class="product-container">

                               

                                <a href="product_detail.php?pid=<?php echo $view_result['code'];?>&catid=<?php echo $view_result['category_id'];?>&prod_id=<?php echo $view_result['name'];?>"> 

                              

                                    <div class="ImageOverlayCa"></div>



                                    <? if($_GET['catid']==761){ ?>

                                        <a href="product_detail.php?pid=<?php echo $rws2['code'];?>&catid=761&prod_id=<?php echo $rws2['name'];?>"> 

                                      <? } else { ?>

                                        <a href="product_detail.php?pid=<?php echo $rws2['code'];?>&catid=<?php echo $rws2['category_id'];?>&prod_id=<?php echo $rws2['name'];?>"> 

                                      <? }

                                      ?>

                                      <img

                                        src="<?=$getimgdata?>"

                                        class="featured-image"

                                        alt=" <?php echo $name; ?>"

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

                                              href="black-tea"

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

                                        id="<?php echo $name; ?>"

                                        class="quickview-button quick-view-text product_link"

                                        data-view="<?php echo $name; ?>"

                                        ><i class="fa fa-search"></i

                                      ></a>

                                    </div>

                                  </div>

                                </div>



                                <div class="product-detail">

                                  <!-- <p class="product-vendor">

                                    <span>Groca</span>

                                  </p> -->



                                  <a href="product_detail.php?pid=<?php echo $view_result['code'];?>&catid=<?php echo $view_result['category_id'];?>&prod_id=<?php echo $view_result['name'];?>">

                                  <?php echo $name; ?>

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

                                  </div>



                                  <form

                                    action="product_detail.php?pid=<?php echo $view_result['code'];?>&catid=<?php echo $view_result['category_id'];?>&prod_id=<?php echo $view_result['name'];?>"

                                    method="post"

                                    class="variants clearfix"

                                    id="cart-form-6151883718846"

                                  >

                                    <input

                                      type="hidden"

                                      name="id"

                                      value="37823643418814"

                                    />

                                    <a

                                      class="add-cart-btn btn"

                                      title="Add to Cart"

                                    >

                                      <i class="fas fa-cart-plus"></i> Add to

                                      Cart

                                    </a>

                                  </form>



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

				<!-- <input type="hidden" class="totalnorecord" value="<?php echo $totalnorecord?>" >			 -->

<!--Srishringar starts here-->
<? while($view_result1 = mysqli_fetch_assoc($jwel)){ 
    
    
    $cat = $view_result1['categories_id'];
    
    $prod_name = $view_result1['product_name'];
    $prcode = $view_result1['product_code'];
    $prodid = $view_result1['product_id'];
    $sqlimg="SELECT img_name FROM product_images_new WHERE product_id='".$prodid."'";

        $qryimg=mysqli_query($con1,$sqlimg);
        $rowimg=mysqli_fetch_row($qryimg);
        $path=trim($pathmain."uploads".$rowimg[0]);
        $expl=explode('/',$path);
        $pth1=trim($pathmain."mid1/".$expl[$cnt-1]);
        $rate_qry = mysqli_query($con1,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
        $rate=mysqli_fetch_row($rate_qry);
        $image = "http://yosshitaneha.com/".$path;

        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        
        
    if (in_array($ext, $supported_image)) {
        
        $handle = curl_init($image);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if($httpCode != 404) { ?>
      <li

                              class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

                              id="product-6151883718846"

                              id="product-6151883718846"

                            >

                              <div class="products product-hover-11">

                                <div class="product-container">

                                  <a

                                    href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>"

                                    class="grid-link"

                                  >

                                    <div class="ImageOverlayCa"></div>



                                    <a

                                      href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $categoryId;?>&gid=<?php echo $prodid;?>"

                                      class="grid-link"

                                    >

                                      <img

                                        src="<?php echo $image; ?>"

                                        class="featured-image"

                                        alt="<?php echo $prod_name; ?>"

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

                                              href="black-tea"

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

                                        id="black-tea"

                                        class="quickview-button quick-view-text product_link"

                                        data-view="black-tea"

                                        ><i class="fa fa-search"></i

                                      ></a>

                                    </div>

                                  </div>

                                </div>



                                <div class="product-detail">

                                  <!-- <p class="product-vendor">

                                    <span>Groca</span>

                                  </p> -->



                                  <a href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>">

                                  <?php echo $prod_name; ?></a>



                                  <div class="grid-link__meta">

                                    <div class="product_price">

                                      <div

                                        class="grid-link__org_price"

                                        id="ProductPrice"

                                      >

                                      ₹<?php echo $rate[0]?>

                                      </div>

                                    </div>

                                  </div>



                                  <form

                                    action="#"

                                    method="post"

                                    class="variants clearfix"

                                    id="cart-form-6151883718846"

                                  >

                                    <input

                                      type="hidden"

                                      name="id"

                                      value="37823643418814"

                                    />

                                    <a

                                      class="add-cart-btn btn"

                                      title="Add to Cart"

                                    >

                                      <i class="fas fa-cart-plus"></i> Add to

                                      Cart

                                    </a>

                                  </form>



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

	        <?php
 } curl_close($handle); } ?>

     			
        			
  <? } ?>


  <? while($view_result2 = mysqli_fetch_assoc($garment)){ 
  
  
  $cat = $view_result2['categories_id'];
  
  $prod_name = $view_result2['gproduct_name'];
  $prcode = $view_result2['gproduct_code'];
  $prodid = $view_result2['gproduct_id'];
  $sqlimg="SELECT img_name FROM product_images_new WHERE gproduct_id='".$prodid."'";


      $qryimg=mysqli_query($con1,$sqlimg);
      $rowimg=mysqli_fetch_row($qryimg);
      
      $path=trim($pathmain."uploads".$rowimg[0]);
      
      $expl=explode('/',$path);
      
      $pth1=trim($pathmain."mid1/".$expl[$cnt-1]);
      
      $rate_qry = mysqli_query($con1,"SELECT unit_price,cost_price,quantity FROM phppos_items where name like '".$prcode."'");
      $rate=mysqli_fetch_row($rate_qry);

      $image = "http://yosshitaneha.com/".$path;
      $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      
      
  if (in_array($ext, $supported_image)) {
      
      $handle = curl_init($image);
      curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
      $response = curl_exec($handle);
      $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

          if($httpCode != 404) {
               ?>

<li class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

        id="product-6151883718846"

        id="product-6151883718846"

        >

        <div class="products product-hover-11">

        <div class="product-container">

            <a

            href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>"

            class="grid-link"

            >

            <div class="ImageOverlayCa"></div>



            <a

                href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>"

                class="grid-link"

            >

                <img

                src="<?php echo $image; ?>"

                class="featured-image"

                alt="<?php echo $prod_name; ?>"

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

                        href="black-tea"

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

                id="black-tea"

                class="quickview-button quick-view-text product_link"

                data-view="black-tea"

                ><i class="fa fa-search"></i

                ></a>

            </div>

            </div>

        </div>



        <div class="product-detail">

            <!-- <p class="product-vendor">

            <span>Groca</span>

            </p> -->



            <a href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>">

            <?php echo $prod_name; ?></a>



            <div class="grid-link__meta">

            <div class="product_price">

                <div

                class="grid-link__org_price"

                id="ProductPrice"

                >

                ₹<?php echo $rate[0]?>

                </div>

            </div>

            </div>



            <form

            action="#"

            method="post"

            class="variants clearfix"

            id="cart-form-6151883718846"

            >

            <input

                type="hidden"

                name="id"

                value="37823643418814"

            />

            <a

                class="add-cart-btn btn"

                title="Add to Cart"

            >

                <i class="fas fa-cart-plus"></i> Add to

                Cart

            </a>

            </form>



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

	
		
<? } curl_close($handle); } ?>
    
    
    <? } ?>


</div>   

</div>
  
  

<?
}
else{ ?>
  
  <div class="container">
      <h3 style="text-align:center; color:red;">
          SORRY ! NO PRODUCTS.. TRY WITH DIFFERENT NAME..
      </h3>
  </div> 
<? }
?>


<hr>


    
    <? $sql = mysqli_query($con1,"select * from main_cat where name like '".$search."%'");
    
    if(mysqli_num_rows($sql)){ ?>
        


<div class="container">
    

<h2>Categories</h2>

  <div class="row">
      
      
    <? while($sql_result = mysqli_fetch_assoc($sql)){ ?>

        <li class="grid__item item-row wide--one-fifth post-large--one-fifth large--one-third medium--one-half small--one-half"

id="product-6151883718846"

id="product-6151883718846"

>

<div class="products product-hover-11">

<div class="product-container">

    <a

    href="new_product.php?catid=<? echo $sql_result['id']; ?>"

    class="grid-link"

    >

    <div class="ImageOverlayCa"></div>



    <a

        href="new_product.php?catid=<? echo $sql_result['id']; ?>"

        class="grid-link"

    >

        <img

        src="https://allmart.world/ecom/adminpanel/<? echo $sql_result['cat_img']; ?>"

        class="featured-image"

        alt="<?php echo $sql_result['name'];?>"

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

                href="black-tea"

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

        id="black-tea"

        class="quickview-button quick-view-text product_link"

        data-view="black-tea"

        ><i class="fa fa-search"></i

        ></a>

    </div>

    </div>

</div>



<div class="product-detail">

    <!-- <p class="product-vendor">

    <span>Groca</span>

    </p> -->



    <a href="product_detail.php?pid=<?php echo $prodid;?>&catid=<?php echo $cat;?>&gid=<?php echo $prodid;?>">

    <?php echo $sql_result['name'];?></a>



    <div class="grid-link__meta">

    

    </div>



    <form

    action="#"

    method="post"

    class="variants clearfix"

    id="cart-form-6151883718846"

    >

    <input

        type="hidden"

        name="id"

        value="37823643418814"

    />

    <a

        class="add-cart-btn btn"

        title="Add to Cart"

    >

        <i class="fas fa-cart-plus"></i> Add to

        Cart

    </a>

    </form>



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


        
     <? } ?>
       </div> 
    
   </div> 
   
<? } ?>

    <? } ?>




                   

  <div class="dt-sc-hr-invisible-large"></div>

</main>

<?php include('footer.php');?>

