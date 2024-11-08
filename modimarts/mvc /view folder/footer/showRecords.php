 <?php
    if(isset($_GET['category_id'])){
      $catlink="&category_id=".$category_id.$h_range;
      }
      else
      {
      $catlink="".$h_range;
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
?>