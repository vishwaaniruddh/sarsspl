<?php 
    include 'header_blog.php'; 
    
?>
        <!-- Page Title -->
        <section class="page-title p_relative centred">
            <div class="bg-layer p_absolute l_0 parallax_none parallax-bg" data-parallax='{"y": 100}' style="background-image: url(assets/images/background/page-title-5.jpg);"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1 class="d_block fs_60 lh_70 fw_bold mb_10">Blog</h1>
                    
                </div>
            </div>
        </section>
        <!-- End Page Title -->

<!-- blog-grid-two -->
        <section class="blog-masonry-two p_relative sec-pad">
            <div class="auto-container">

                    
                <div class="sortable-masonry">
                    <div class="items-container row clearfix">
                     <?php 
                    $sql = mysqli_query($con,"select * from blog_details_insert order by id desc");
                    while($row = mysqli_fetch_assoc($sql)){ ?>    
                        
                        <div class="col-lg-4 col-md-6 col-sm-12 masonry-item small-column all product finance business">
                            <div class="news-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                <div class="inner-box p_relative d_block mb_60">
                                    <div class="image-box p_relative d_block">
                                        <figure class="image p_relative d_block"><a href="blog_detail_test.php?id=<?php echo $row['id'];?>" target="_new"><img src=<?php echo $row['image1']; ?> alt=""></a></figure>
                                    </div>
                                    <div class="lower-content p_relative d_block pt_25">
                                        <h4 class="p_relative d_block fs_20 lh_28 mb_7"><a href="blog_detail_test.php?id=<?php echo $row['id'];?>" target="_new"><?php echo $row['heading'];?></a></h4>
                                        <ul class="post-info clearfix p_relative d_block mb_17">
                                            <li class="p_relative d_iblock float_left mr_30 fs_16"><a href="blog_detail_test.php?id=<?php echo $row['id'];?>" target="_new"><?php echo $row['category'];  ?></a></li>
                                            
                                        </ul>
                                        <p class="d_block font_family_poppins"><?php echo $row['listing_content']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <?php    }
                
                ?>
                    </div>
                </div>
               
            </div>
        </section>
        <!-- blog-grid-two end -->

<?php include 'footer.php';?>