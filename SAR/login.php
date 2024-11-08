<?php 

include 'header.php';?>



        <!-- registration-section -->
        <section class="registration-section pt_130 pb_150">
            <div class="auto-container">
                <div class="content-box p_relative d_block b_shadow_6 b_radius_5 pt_60 pr_50 pb_70 pl_50">
                    <div class="shape">
                        <div class="shape-1 p_absolute w_170 h_170 b_radius_50 bg-color-1"></div>
                        <div class="shape-2 b_140 p_absolute w_170 h_170 b_radius_50 bg-color-1"></div>
                        <div class="shape-3 p_absolute t_45 float-bob-y" style="background-image: url(assets/images/shape/shape-198.png);"></div>
                        <div class="shape-4 p_absolute w_95 h_95 b_50 float-bob-y" style="background-image: url(assets/images/shape/shape-197.png);"></div>
                    </div>
                    <div class="text p_relative d_block mb_25">
                        <h3 class="d_block fs_30 lh_40 fw_bold mb_5">Log in </h3>
                    </div>
                    <div class="form-inner">
                        <form action="login_process.php" method="post" class="default-form">
                            <div class="form-group">
                                <label class="p_relative d_block fs_15 font_family_poppins mb_5 color_black">Username*</label>
                                <input type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <label class="p_relative d_block fs_15 font_family_poppins mb_5 color_black">Password*</label>
                                <input type="password" name="password" placeholder="Password" required>
                            </div>
                            
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn theme-btn-five">Sign in <i class="icon-4"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- registration-section end -->



<?php include 'footer.php';?>