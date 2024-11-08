<?php
session_start();
// include('config.php');
include 'head.php';
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

$catg_id = $_GET['catid'];

$sql_category = mysqli_query($con1, "select * from main_cat where under = '$catg_id' and status=1");
$catnamee     = mysqli_fetch_assoc(mysqli_query($con1, "select * from main_cat where id = '$catg_id' and status=1"));

$i = 1;

?>




<!-- Breadcrumbs -->

<nav class="breadcrumb" aria-label="breadcrumbs">
        <div class="container-bg">
          <h1><?=$catnamee['name']?></h1>
          <a href="index.php">Home</a>

		  <?php
$sqlbrdcr = mysqli_query($con1, "select * from main_cat where id ='" . $_GET['catid'] . "'");

  $fbrws = mysqli_fetch_array($sqlbrdcr);
  if ($fbrws['under'] == "0") {
    ?> <span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
            						<span><a href="https://allmart.world/product/<?=strurl($fbrws['name'])?>/<?=strcode($fbrws['id'])?>"><?php echo $fbrws['name']; ?></a></span>
            						<?php
} else {
    $exs = 0;
    $idbrdcrmbarr = array();
    $iddbr = $fbrws['id'];
    while ($exs == 0) {
      $sqlbrdcr2 = mysqli_query($con1, "select * from main_cat where id ='" . $iddbr . "'");
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
    /*if($c==count($idbrdcrmbarr)-1){ ?>
    <li ><a href="#"><?php echo $fbrws23['name'];?></a></li>
    <?php } else { ?>
    <li > <a href="product.php?catid=<?php echo $fbrws23['id'];?>"><?php echo $fbrws23['name'];?><i class="ti-arrow-right"></i></a></li>
    <?php }*/

    ?>
									<span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
        							<span > <a href="https://allmart.world/product/<?=strurl($fbrws23['name'])?>/<?=strcode($fbrws23['id'])?>"><?php echo $fbrws23['name']; ?></a></span>
        							<?php
}
  ?>
									<span aria-hidden="true" class="breadcrumb__sep">&#47;</span>
        							<span ><a href="#"><?php echo $catnamee['name']; ?></a></span>

        </div>
      </nav>

<main class="main-content">
  <div class="dt-sc-hr-invisible-small"></div>

  <div class="wrapper">
    <div class="grid-uniform">
      <div class="grid__item">
        <div class="container-bg">
          <div class="grid__item">
            <div class="grid-uniform list-collection-products">
                  <?php
                  $count=mysqli_num_rows($sql_category);
                  if($count){

while ($row = mysqli_fetch_assoc($sql_category)) {

    $chkundrexs = mysqli_query($con1, "select * from main_cat where under ='" . $row['id'] . "' and status=1 order by name asc");
    $count      = mysqli_num_rows($chkundrexs);

    ?>
              <div class="grid__item grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-half small--one-whole text-center pickgradient-products" >
                <a
                  href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>"
                  title="Browse our <?=ucwords($row['name'])?> collection"
                  class="pickgradient grid-link"
                >
                  <img
                    src="https://allmart.world/ecom/adminpanel/<?php echo $row['cat_img']; ?>"
                    alt="<?=ucwords($row['name'])?>"
                    width="298"
                    height="293"
                  />
                </a>

                <div class="collection-detail">
                  <a
                    href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>"
                    title="Browse our <?=ucwords($row['name'])?> collection"
                    class="grid-link"
                  >
                    <span class="grid-link__title h4"><?=ucwords($row['name'])?></span></a
                  >
                  <p class="collection-count"><?=get_count($row['id'])?>  <span> Items</span></p>
                  <p class="collection-description"></p>

                  <a href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>" class="btn">View All</a>
                </div>
              </div>
              <?php
              }
                  }
                  else
                  {
                    $my_category = mysqli_query($con1, "select * from main_cat where id = '$catg_id' and status=1");

                    while ($row = mysqli_fetch_assoc($my_category)) {

    $chkundrexs = mysqli_query($con1, "select * from main_cat where under ='" . $row['id'] . "' and status=1 order by name asc");
    $count      = mysqli_num_rows($chkundrexs);

    ?>
              <div class="grid__item grid__item wide--one-quarter post-large--one-quarter large--one-quarter medium--one-half small--one-whole text-center pickgradient-products" >
                <a
                  href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>"
                  title="Browse our <?=ucwords($row['name'])?> collection"
                  class="pickgradient grid-link"
                >
                  <img
                    src="https://allmart.world/ecom/adminpanel/<?php echo $row['cat_img']; ?>"
                    alt="<?=ucwords($row['name'])?>"
                    width="298"
                    height="293"
                  />
                </a>

                <div class="collection-detail">
                  <a
                    href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>"
                    title="Browse our <?=ucwords($row['name'])?> collection"
                    class="grid-link"
                  >
                    <span class="grid-link__title h4"><?=ucwords($row['name'])?></span></a
                  >
                  <p class="collection-count"><?=get_count($row['id'])?>  <span> Items</span></p>
                  <p class="collection-description"></p>

                  <a href="https://allmart.world/list/<?=strurl($row['name'])?>/<?=strcode($row['id'])?>" class="btn">View All</a>
                </div>
              </div>
              <?php
}

                  }

              ?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="dt-sc-hr-invisible-large"></div>
</main>

<?php
include 'footer.php';
?>
