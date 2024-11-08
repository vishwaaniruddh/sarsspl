<?php 
include('header.php');


?>

        <!-- Page Title -->
        <section class="page-title about-page-5 style-two p_relative centred">
            <div class="pattern-layer">
                <div class="shape-1 p_absolute l_120 t_120 rotate-me" style="background-image: url(assets/images/shape/shape-176.png);"></div>
                <div class="shape-2 p_absolute t_180 r_170 float-bob-y" style="background-image: url(assets/images/shape/shape-56.png);"></div>
                <div class="shape-3 p_absolute l_0 b_0" style="background-image: url(assets/images/shape/shape-189.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box">
                    <h1 class="d_block fs_70 lh_70 fw_bold">Insert Blog</h1>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
         <section class="contact-four p_relative sec-pad">
            
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 form-column">
                        <div class="form-inner p_relative ml_40 pt_45 pr_50 pb_50 pl_50 b_radius_10 b_shadow_6">
                            <div class="text p_relative d_block mb_35">
                                <h3 class="d_block fs_30 lh_40 fw_bold">Write your Post</h3>
                            </div>
                            <form method="post" action="blog_data.php" id="contact-form" enctype="multipart/form-data"> 
                                <div class="row clearfix">
                                    <div class="col-md-4 form-group">
                                        <label for="file1">Title Image</label>
                                         <input type="file" name="image1" onchange="previewFile(this)" required>
                                         <img id="previewImg" src="assets/images/transparent.png" alt=" Preview">
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="file2">Blog Detail Image </label>
                                        <input type="file" name="image2" id="image2" onchange="previewFile2(this)" required>
                                        <img id="previewImg" src="assets/images/transparent.png" alt=" Preview">
                                    </div>
                                    <!--<div class="col-md-4 form-group">-->
                                    <!--    <label for="file3">Image2</label>-->
                                    <!--    <input type="file" name="image3" id="image3" >-->
                                    <!--</div>-->
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="heading" placeholder="Heading" >
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="category"  placeholder="Category">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="text" name="content" placeholder="Listing Content" >
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="belowcontent" id="belowcontent" placeholder="Below Image Content" ></textarea>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <textarea name="description" id="description" ></textarea>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <input type="radio" id="active" name="act_inact" value="active">
                                        <label for="active">Active</label> 
                                        <input type="radio" id="inactive" name="act_inact" value="inactive">
                                        <label for="inactive">Inactive</label>
                                    </div>
                                   
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button class="theme-btn theme-btn-eight" type="submit" name="submit">Post<i class="icon-4"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
    function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
    function previewFile2(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
</script>
        <!-- footer-three -->
<?php include 'footer.php'; ?>