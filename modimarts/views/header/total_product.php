<?php include 'config/apidata.php';?>
<div class="table-wrapper">
    <table class="fl-table" border="1" class="table">
      <thead>
              <tr>
                   <th>Total Product</th>
             <?php
                        $categories=CategoryList('getCategoryList');

                        // while ($result23 = mysqli_fetch_array($sql23)) {
                          foreach ($categories as $key => $category) {
                              ?>
            <th><a href="https://allmart.world/catalog-product?category_id=<?=strcode($category->Category_id)?>"> <?=$category->Category?></a></th>
        <?php } ?>
                       
      <th><a href="https://allmart.world/list/value-offer/803">Value Offer</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
$categorys=CategoryList('getCategoryList');
$category_id=$_GET['category_id'];
// echo "$category_id";
$total_rows=$resultres->Total_records;
$total_pages = ceil($total_rows / $no_of_records_per_page);
?>
           <!-- <td><a href="<?php echo $total_pages; ?>"></a></td> -->
            <td>17235</td>
          <td>138</td>
      <td>368</td> 
      <td>121</td>
      <td>1329</td>
      <td>66</td>
      <td>7746</td>
      <td>7410</td> 
      <td>57</td> 
        </tr>
        <tbody>
    </table>
</div>

