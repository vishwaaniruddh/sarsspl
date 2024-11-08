<div class="col-sidebar" data-sidebar>
                    <div class="close-sidebar">
                      <svg
                        aria-hidden="true"
                        data-prefix="fal"
                        data-icon="times"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                        class="svg-inline--fa fa-times fa-w-10 fa-2x"
                      >
                        <path
                          fill="currentColor"
                          d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"
                          class=""
                        ></path>
                      </svg>
                    </div>
                    <div
                      class="grid__item wide--one-fifth post-large--one-quarter left-sidebar sidebar mobileToggle"
                    >
                      <div class="product_sidebar">
                        <div
                          id="shopify-section-sidebar-category"
                          class="shopify-section"
                        >
                          <div class="widget widget_product_categories">
                            <h4>Category</h4>

                            <ul class="product-categories dt-sc-toggle-frame-set dropdown multi-level-dropdown">
                         <?php
                         $categories=CategoryList('getCategoryList');
                         foreach ($categories as $key => $category) {
                        ?>
                          <li class="nav-item" >
                              <a class="nav-link" href="/catalog-product?category_id=<?=strcode($category->Category_id)?>">
                                <?php echo $category->Category; ?>
                              </a>
                          </li>

                        <?php } ?>
                      </ul>

                            </ul>
                          </div>
                        </div>
                      
                      </div>
                    </div>
                  </div>