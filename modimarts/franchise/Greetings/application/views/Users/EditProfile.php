<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Profile setting</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Account</a>
                  </li>
                  <li class="breadcrumb-item active">Profile setting
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <!-- <div class="content-header-right col-md-6 col-12">
            <div class="btn-group float-md-right">
              <button class="btn btn-info dropdown-toggle mb-1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
              <div class="dropdown-menu arrow"><a class="dropdown-item" href="#"><i class="fa fa-calendar-check mr-1"></i> Calender</a><a class="dropdown-item" href="#"><i class="fa fa-cart-plus mr-1"></i> Cart</a><a class="dropdown-item" href="#"><i class="fa fa-life-ring mr-1"></i> Support</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fa fa-cog mr-1"></i> Settings</a>
              </div>
            </div>
          </div> -->
        </div>
        <div class="content-body"><!-- account setting page start -->
                            <section id="page-account-settings">
                                <?=$this->session->flashdata('FlashMassage');?>
                                <div class="row">
                                    <!-- left menu section -->

                                    <div class="col-md-3 mb-2 mb-md-0">
                                        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                            <li class="nav-item">
                                                <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                                                    href="#account-vertical-general" aria-expanded="true">
                                                    <i class="ft-globe mr-50"></i>
                                                    General
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                                                    aria-expanded="false">
                                                    <i class="ft-lock mr-50"></i>
                                                    Change Password
                                                </a>
                                            </li>
                                            
                                           
                                        </ul>
                                    </div>
                                    <!-- right content section -->
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                                            aria-labelledby="account-pill-general" aria-expanded="true">
                                                            <form  action="#" method="post" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        <div class="media">
                                                                            <a href="javascript: void(0);">
                                                                                <img src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$userData->image?>"
                                                                                    class="rounded mr-75" alt="profile image" height="64" width="64">
                                                                            </a>
                                                                            
                                                                            <div class="media-body mt-75">
                                                                                <?php if($userData->image==''){ ?>
                                                                                <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                                                                    <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer"
                                                                                        for="account-upload">Upload new Image</label>
            
                                                                                    <input type="file" id="account-upload" name="image" onchange="get_detail(this)" accept="image/*" hidden>
                                                                                   
                                                                                    <button class="btn btn-sm btn-secondary ml-50" >Reset</button>
                                                                                </div>
                                                                                
                                                                                
                                                                                <p class=" ml-75 mt-50 text-danger" id="spnmsg" ></p>
                                                                                <p class="text-muted ml-75 mt-50"><small>Allowed JPG, GIF or PNG. Max
                                                                                        size of
                                                                                        1 Mb</small></p>
                                                                                         <?php }
                                                                            else{ ?>
                                                                           
                                                                           
                                                                            <label>Image</label>
                                                                            <div class="custom-file">
                                                                                          
                                                                                          <input type="file" class="custom-file-input" id="inputGroupFile02" accept="image/*" disabled>
                                                                                          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFile02">Choose file</label>
                                                                                      </div>
                                                                                      <p class="text-muted ml-75 mt-50"><small>Allowed images size of 1 Mb</small></p>
                                                                            <?php }?>
                                                                             </div>
                                                                            
                                                                             <input type="hidden" value="<?=$userData->image?>" name="oldimg" >
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="media">
                                                                            <a href="javascript: void(0);">
                                                                                <img src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$userData->logo?>"
                                                                                    class="rounded mr-75" alt="profile image" height="64" width="64">
                                                                            </a>
                                                                            <div class="media-body mt-75">
                                                                                <label>Logo</label>
                                                                                <div class="custom-file">
                                                                                          <input type="hidden" value="<?=$userData->logo?>" name="oldlogo">
                                                                                          <input type="file" class="custom-file-input" name="logo" id="inputGroupFile02" accept="image/*">
                                                                                          <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFile02">Choose file</label>
                                                                                      </div>
                                                                                      
                                                                                
                                                                                <p class=" ml-75 mt-50 text-danger" id="spnmsg1" ></p>
                                                                                <p class="text-muted ml-75 mt-50"><small>Allowed images size of 1 Mb</small></p>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="media">
                                                                            <a href="javascript: void(0);">
                                                                                <img src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$userData->footer_image?>"
                                                                                    class="rounded mr-75" alt="profile image" height="64" width="64">
                                                                            </a>
                                                                            <div class="media-body mt-75">
                                                                                <label>Footer image</label>
                                                                                <div class="custom-file">
                                                                                          <input type="hidden" value="<?=$userData->footer_image?>" name="oldfooter_image">
                                                                                          <input type="file" name="footer_image" class="custom-file-input" id="inputGroupFile03">
                                                                                          <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFile03">Choose file</label>
                                                                                          
                                                                                      </div>
                                                                                <p class=" ml-75 mt-50 text-danger" id="spnmsg1" ></p>
                                                                                <p class="text-muted ml-75 mt-50"><small>Allowed images size of 1 Mb</small></p>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-username">User name</label>
                                                                                <input type="hidden" name="UpdateData" value="1">
                                                                                <input type="text" class="form-control"  placeholder="customer Name" value="<?=$userData->customer_name?>" required readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Mobile</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="mobile"
                                                                                    placeholder="Mobile Number" value="<?=$userData->mobile_number?>" 
                                                                                    data-validation-required-message="This email field is required" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-name">Email Id</label>
                                                                                <input type="email" class="form-control"  name="email"
                                                                                maxlength="30"
                                                                                    placeholder="email" value="<?=$userData->email?>" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Line 1</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="content"
                                                                                maxlength="50"
                                                                                    placeholder="content" value="<?=$userData->content?>" 
                                                                                    data-validation-required-message="This email field is required"  >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Line 2</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="content1"
                                                                                maxlength="50"
                                                                                    placeholder="content" value="<?=$userData->content1?>" 
                                                                                    data-validation-required-message="This email field is required" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Line 3</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="content2"
                                                                               maxlength="50"
                                                                                    placeholder="content" value="<?=$userData->content2?>" 
                                                                                    data-validation-required-message="This email field is required" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Line 4</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="content3" maxlength="50"
                                                                                    placeholder="content" value="<?=$userData->content3?>" 
                                                                                    data-validation-required-message="This email field is required" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">website</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="website"
                                                                                maxlength="25"
                                                                                    placeholder="website" value="<?=$userData->website?>" 
                                                                                    data-validation-required-message="This email field is required" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-e-mail">Designation</label>
                                                                                <input type="text" class="form-control" id="account-e-mail"
                                                                                name="designation"
                                                                                maxlength="25"
                                                                                    placeholder="designation" value="<?=$userData->designation?>" 
                                                                                    data-validation-required-message="This email field is required" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                    
                                                                    
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Save
                                                                            changes</button>
                                                                        <button type="reset" class="btn btn-light">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                                            aria-labelledby="account-pill-password" aria-expanded="false">
                                                            <form action="#" method="post">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <input type="hidden" name="ChangePass" value="1">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-old-password">Old Password</label>
                                                                                <input type="password" class="form-control"
                                                                                    id="account-old-password" required placeholder="Old Password"
                                                                                    data-validation-required-message="This old password field is required" name="oldpassword">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-new-password">New Password</label>
                                                                                <input type="password" name="password" id="account-new-password"
                                                                                    class="form-control" placeholder="New Password" required
                                                                                    data-validation-required-message="The password field is required"
                                                                                    minlength="6" name="newpassword">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <div class="controls">
                                                                                <label for="account-retype-new-password">Retype New
                                                                                    Password</label>
                                                                                <input type="password" name="con-password" class="form-control"
                                                                                    required id="account-retype-new-password"
                                                                                    data-validation-match-match="password"
                                                                                    placeholder="New Password"
                                                                                    data-validation-required-message="The Confirm password field is required"
                                                                                    minlength="6" name="con-password">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                        <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0" id="btnSubmit">Save
                                                                            changes</button>
                                                                        <button type="reset" class="btn btn-light">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- account setting page end -->
        </div>
      </div>
    </div>
    <!-- END: Content-->

    

   <script>
function get_detail()
{
 var size=$('#account-upload')[0].files[0].size;
 var extension=$('#account-upload').val().replace(/^.*\./, '');

 var validFileExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

 if ($.inArray(extension, validFileExtensions) == -1) {
      $('#account-upload').val("");
    $("#spnmsg").html("");
    alert("Not a Valid format");


 }
 else{

 if(size<1024000)
 {
$("#spnmsg").html("File Size : "+size+" <br>Extension : "+extension+"");
 }
 else
 {
    $("#spnmsg").html("Image Size Larger Then 1 MB");
    $('#account-upload').val("");
 }    
 
}
}

function get_detail1()
{
 var size=$('#account-upload1')[0].files[0].size;
 var extension=$('#account-upload1').val().replace(/^.*\./, '');

 var validFileExtensions = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];

 if ($.inArray(extension, validFileExtensions) == -1) {
      $('#account-upload1').val("");
    $("#spnmsg").html("");
    alert("Not a Valid format");


 }
 else{

 if(size<1024000)
 {
$("#spnmsg1").html("File Size : "+size+" <br>Extension : "+extension+"");
 }
 else
 {
    $("#spnmsg1").html("Image Size Larger Then 1 MB");
    $('#account-upload1').val("");
 }    
 
}
}


</script>