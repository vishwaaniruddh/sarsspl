<?php session_start();
include 'head.php';

$catid         = $_GET['catid'];
$total_records = 0;

function get_all($cat)
{

    global $con1;

    $sql = mysqli_query($con1, "select id from main_cat where under = '" . $cat . "' and status=1");

    while ($sql_result = mysqli_fetch_assoc($sql)) {

        $id[] = $sql_result['id'];
    }
    return $id;
}

$all_cat = get_all($catid);

foreach ($all_cat as $key => $val) {

    $all[] = get_all($val);
}

$id = array_merge($all_cat, $all);

$id  = json_encode($id);
$id  = str_replace(array('[', ']', '"'), '', $id);
$arr = explode(',', $id);
$id  = "'" . implode("', '", $arr) . "'";

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

  <?php

$sqlbrdcr = mysqli_query($con1, "select * from main_cat where id ='" . $_GET['catid'] . "'");

$fbrws = mysqli_fetch_array($sqlbrdcr);

if ($fbrws['under'] == "0") {

    ?>

  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

  <span><?php echo $fbrws['name']; ?></span>

  <?php

} else {

    $exs = 0;

    $idbrdcrmbarr = array();

    $iddbr = $fbrws['id'];

    while ($exs == 0) {

        $sqlbrdcr2 = mysqli_query($con1, "select * from main_cat where id ='" . $iddbr . "' and status");

        $fbrws2 = mysqli_fetch_array($sqlbrdcr2);

        array_unshift($idbrdcrmbarr, $iddbr);

        if ($fbrws2['under'] == "0") {

            $iddbr = "0";

            $exs = 1;

            break;

        } else {

            $iddbr = $fbrws2['under'];

        }

    }

}

for ($c = 0; $c < count($idbrdcrmbarr); $c++) {

    $sqlbrdcr23 = mysqli_query($con1, "select * from main_cat where id ='" . $idbrdcrmbarr[$c] . "'");

    $fbrws23 = mysqli_fetch_array($sqlbrdcr23);

    if ($c == count($idbrdcrmbarr) - 2) {

        $pcatid = $fbrws23['id'];

    }

    if ($c == count($idbrdcrmbarr) - 1) {?>

  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

  <span><?php echo $fbrws23['name']; ?></span>

  <?php } else {?>

  <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>

  <span><?php echo $fbrws23['name']; ?></span>

  <?php }

}

?>

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
                          data-section-type="collection-template"
                        >
                          <div class="toolbar">
                            <div class="sidebar-label">
                              <div class="sidebar-button">
                                <div class="tags-filter">
                                  <button id="showTagsFilter"
                                    class="btn tag-fillter"
                                  >
                                    <svg
                                      data-name="Layer 1"
                                      id="Layer_1"
                                      viewBox="0 0 48 48"
                                      xmlns="https://www.w3.org/2000/svg"
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
                           

                            <div class="filter-sortby toolbar-col">
                              <label for="sort-by">Sort by Discount:</label>
                              <div class="single-shorter">
                                            <?php
                                if ($catid == 803) {
                                    $qrygetvalueproduct = mysqli_query($con1, "select * from products where category ='" . $catid . "' and status=1 ");
                                    $total_records      = mysqli_num_rows($qrygetvalueproduct);
                                }
                                ?>
                                <select id='sort' name='sort'  onchange="getval(this);">
                                <option value="">Select</option>
                                  <option id="3" value='3'>High to low</option>
                                  <option id="4" value='4'>Low to High</option>
                                </select>
                              </div>
                            </div>
                            <div class="filters-toolbar__limited-view toolbar-col"
                                data-limited-view
                              >
                              <label>Sort By Price:</label>
                              <div class="shop-top">
                            <div class="shop-shorter">
                                 <div class="single-shorter">
                                                                                                <?php
                                    if ($catid == 803) {
                                        $qrygetvalueproduct = mysqli_query($con1, "select * from products where category ='" . $catid . "' and status=1 ");
                                        $total_records      = mysqli_num_rows($qrygetvalueproduct);
                                    }
                                    ?>
                                <select id='sort' name='sort'  onchange="getval(this);">
                                <option value="">Select</option>
                                  <option id="1" value='1'>Higher to lower</option>
                                  <option id="2" value='2'>Lower to Higher</option>
                                </select>
                                <input type="hidden" name="filter_type" id="filter_type" value="0">
                              </div>

                            <div class="single-shorter" >
                            </div>

                </div>

              </div>

                              </div>
                            </div>
                          </div>
                          <div class="product-collection products-grid-view products-grid grid-uniform" id="products"  >


          <div class="row" id="results">  </div>




                </div>



<div class="text-center padding">
  <div class="infinite-scrolling">
  <input type="hidden" name="total_record" id="total_record" value="0">
  <br/>
  <div id="loader_image"></div>
                <div class="margin10"></div>
                <div id="loader_message"></div>

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

</div>



<div class="dt-sc-hr-invisible-large"></div>

</main>

      <script type="text/javascript">
            var busy = false;
            var limit = 20
            var offset = 0;
            var catid = <?php echo $_GET['catid']; ?>;

            function displayRecords(lim, off,filter=0) {
                var total_record = document.getElementById('total_record').value;
                $.ajax({
                  type: "GET",
                  async: false,
                  url: "https://allmart.world/product_records.php",
                  data: "limit=" + lim + "&offset=" + off +"&catid="+catid + "&filter="+filter +"&total_record="+total_record,
                  cache: false,
                  beforeSend: function() {
                    $("#loader_message").html("").hide();
                    $('#loader_image').show();
                  },
                  success: function(html) {
                    $("#results").append(html);
                    $('#loader_image').hide();
                    var total = document.getElementById('total_record').value;
                    console.log(total);
                    if (offset >=total) {
                      $("#loader_message").html('<button class="btn btn-default" type="button">No more records.</button>').show()
                    } else {
                      $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
                    }
                    window.busy = false;
                  }
                });
            }

            function displaynewRecords(lim, off,filter=0) {
                var total_record = document.getElementById('total_record').value;
                $.ajax({
                  type: "GET",
                  async: false,
                  url: "https://allmart.world/product_records.php",
                  data: "limit=" + lim + "&offset=" + off +"&catid="+catid + "&filter="+filter +"&total_record="+total_record,
                  cache: false,
                  beforeSend: function() {
                    $("#loader_message").html("").hide();
                    $('#loader_image').show();
                  },
                  success: function(html) {
                    $("#results").html(html);
                    $('#loader_image').hide();
                    var total = document.getElementById('total_record').value;
                    console.log(total);
                    if (offset >=total) {
                      $("#loader_message").html('<button class="btn btn-default" type="button">No more records.</button>').show()
                    } else {
                      $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
                    }
                    window.busy = false;
                  }
                });
            }

            $(document).ready(function() {
                // start to load the first set of data
                filter = document.getElementById('filter_type').value;
                if (busy == false) {
                    busy = true;
                    // start to load the first set of data
                    displayRecords(limit, offset,filter);
                }

                $(window).scroll(function() {
                    // make sure u give the container id of the data to be loaded in.
                    if ($(window).scrollTop() + $(window).height() > $("#products").height() && !busy) {
                        busy = true;
                        offset = limit + offset;

                        // this is optional just to delay the loading of data
                        setTimeout(function() { displayRecords(limit, offset,filter); });

                        // you can remove the above code and can use directly this function
                        // displayRecords(limit, offset);

                    }
                });
              /*  var total_records = document.getElementById('total_record').value;
                alert(total_records);
                var totalloadrecord = document.getElementsByClassName("totalnorecord").value;
                alert(totalloadrecord);
                var total = total_records + totalloadrecord; */
              //  $('#total').text("Total Products : "+totalloadrecord);
            });

            function getval(id){
                var filter = id.value;
                document.getElementById('filter_type').value=filter;
                displaynewRecords(15,15,filter);
            };
        </script>
      <?php include 'footer.php';?>