 <div class="grid__item  large--one-whole ">

                            <div class="product-container" style="height: 19.5em; width:13em ">

                              <a class="grid__item" href="#">
                                

                                <img alt="featured product" src="<?=$getimgdata?>" style="height:180px; width:125%; background-size:contain; background-repeat:no-repeat; " />
                                
                                 
                              </a>
                              <? echo substr($productname, 0,25) ; ?>
                               <br/>
                              <span>MRP-₹<?php echo $productprice;?></span>
                              <br/>
                                 <span>Offer Price-₹<?php echo $finalPrice;?></span>
                               <br>
                               <?php if($finalPrice<$productprice){?>
                                   <div class="product_right_tag offer_exist">
                                    <span class="offer-price">
                                      <b><?php echo round((1 - ($finalPrice / $productprice)) * 100,0);?> % Off
                                    </b></span>
                                  </div>
                                  <?php } ?>
                            </div>
                                     
</div> 