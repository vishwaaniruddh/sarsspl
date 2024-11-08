<?php include('header_blog.php'); ?>

<!-- Page Title -->
        <section class="page-title p_relative centred">
            <div class="bg-layer p_absolute l_0 parallax_none parallax-bg" data-parallax='{"y": 100}' style="background-image: url(assets/images/background/page-title-5.jpg);"></div>
            <div class="auto-container">
                <div class="content-box">
                    <h1 class="d_block fs_60 lh_70 fw_bold mb_10">Blog Details</h1>
                </div>
            </div>
        </section>
        <!-- End Page Title -->

           <?php
            $id = $_GET['id'];
            $prev = $id - 1;
            $next = $id + 1;
            
            if($prev==0){
                $prev = $prev;
            }
            
            if($id>$prev){
                $prev = $prev;
            }else {
                $prev = $id;
            }
            if($id>$next){
                $next = $next;
            }else {
                $next = $id;
            }
            
            // var_dump($_GET);
           
            $sql = mysqli_query($con,"select * from blog_details_insert where id='".$id."' order by id desc limit 1");
            $row= mysqli_fetch_assoc($sql);
           
           ?>
                    
        <!-- sidebar-page-container -->
        <section class="sidebar-page-container blog-standard-2 blog-details p_relative sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="blog-details-content p_relative d_block mr_20">
                            <div class="blog-post p_relative d_block mb_60">
                                <div class="content-one p_relative d_block mb_60">
                                    <div class="post-title p_relative d_block mb_60">
                                        <div class="category p_relative d_block mb_7"><a href="" class="d_iblock fs_16 font_family_poppins uppercase">E-Surveillance</a></div>
                                        <h2 class="d_block fs_40 lh_50 fw_bold mb_7"><?php echo $row['heading'];?></h2>
                                    </div>
                                    <figure class="image-box p_relative d_block b_radius_5 mb_65"><img src=<?php echo $row['image2']; ?> alt=""></figure>
                                    
                                    <div class="text">
                                        <p class="font_family_poppins mb_25"><?php echo $row['belowcontent'];?></p>
                                    </div>
                                    <br>
                                    <div class="content_block_27 mb_60">
                                        <div class="content-box p_relative d_block mr_30">
                                            <?php echo $row['description'];?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                
                            </div> 
                            <hr>
                            <div class="post-share-option clearfix p_relative d_block  ">
                                
                                <ul class="social-list clearfix pull-left">
                                    <li class="p_relative pull-left mr_20"><h6 class="fs_16 fw_medium lh_40">Share on:</h6></li>
                                    <li class="p_relative pull-left mr_10"><a href="http://www.facebook.com/sharer.php?u=https://sarmicrosystems.in/SAR/blog_detail.php" target="_blank" class="p_relative d_iblock fs_14 lh_20 font_family_poppins b_radius_50 w_40 h_40 lh_40 centred"><i class="fab fa-facebook-f"></i></a></li>
                                    <li class="p_relative pull-left mr_10"><a href="http://twitter.com/intent/tweet?url=https://sarmicrosystems.in/SAR/blog_detail.php&text=Check out Latest Blog!! &hashtags=sarsoftwaresolutions" target="_blank" class="p_relative d_iblock fs_14 lh_20 font_family_poppins b_radius_50 w_40 h_40 lh_40 centred"><i class="fab fa-twitter"></i></a></li>
                                    <!--<li class="p_relative pull-left"><a href="https://www.instagram.com/?url=https://www.instagram.com/?url=https://sarmicrosystems.in/SAR/blog_detail.php" target="_blank" class="p_relative d_iblock fs_14 lh_20 font_family_poppins b_radius_50 w_40 h_40 lh_40 centred"><i class="fab fa-instagram"></i></a></li>-->
                                    <li class="p_relative pull-left mr-20"><a href="http://www.linkedin.com/shareArticle?mini=true&url=c" target="_blank" class="p_relative d_iblock fs_14 lh_20 font_family_poppins b_radius_50 w_40 h_40 lh_40 centred"><i class="fab fa-linkedin"></i></a></li>
                                    <li class="p_relative pull-left ml-10 "><a href="mailto:?Subject=Check out our Blog!!&Body=Check%20the%20Latest%20Blog!!%20 https://sarmicrosystems.in/SAR/blog_detail.php" target="_blank" class="p_relative d_iblock fs_14 lh_20 font_family_poppins b_radius_50 w_40 h_40 lh_40 centred"><i class="fas fa-envelope"></i></a></li>
                                    
                                </ul>
                            </div>
                            <hr>
                            <div class="nav-btn p_relative d_block mb_5">
                                <div class="row clearfix">
                                   
                                    <div class="col-lg-6 col-md-6 col-sm-12 btn-column">
                                        <div class="single-btn prev-btn p_relative d_block b_radius_5 pt_25 pr_30 pb_25 pl_30 tran_5">
                                            <h6 class="d_block fs_15 fw_sbold mb_11"><a href="blog_detail_test.php?id=<?php echo $prev;?>" class="d_iblock color_black"><i class="far fa-long-arrow-left"></i>Previous</h6>
                                            <h5 class="d_block fs_17 lh_24 fw_sbold"><?php echo $row['heading'];?></a></h5>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 btn-column">
                                        <div class="single-btn next-btn text-right p_relative d_block b_radius_5 pt_35 pr_30 pb_25 pl_30 tran_5">
                                            <h6 class="d_block fs_15 fw_sbold mb_15"><a href="blog_detail_test.php?id=<?php echo $next;?>" class="d_iblock color_black">Next<i class="far fa-long-arrow-right"></i></a></h6>
                                            <h5 class="d_block fs_17 lh_24 fw_sbold">Take Action for the Best Strategy Benefits</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- sidebar-page-container end -->


<?php include('footer.php')?>