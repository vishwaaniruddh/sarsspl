
<div class="grid-uniform" style="border: solid 1px #e5e5e5;border-radius: 12px;">
                      <div class="grid__item">
                        <div class="category-items-block">
                          <div class="category-carousel 1">
                            <?php
                                $gtwomen=GetCategoryProduct(3);
				//echo '<pre>';print_r($gtwomen);echo '</pre>';	
                                  foreach ($gtwomen as $key => $wopro) {
                                  ?>
                              <div class="category-item">
                                <a href="https://allmart.world/catalog-product?category_id=<?=strcode($wopro->Category_id)?>">
                                  <?php $proimg= getcatimg($wopro->Category_id); ?>
                                  <img loading="lazy" src="https://thebrandtadka.com/images_inventory_products/front_images/<?php echo $proimg[0]->Product_image; ?>" alt="" style="width:123px;height:123px;" />
                                  <h5><span></span></h5>
                                  <p><?php echo ucfirst($wopro->Category); ?></p>
                                </a>
                              </div>
                            <?php
                                  }
                                  ?>
                          </div>
                          <div class="category_nav carousel-arrow  1"></div>
                        </div>
                      </div>
                    </div>