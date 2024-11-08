 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="#">Settings</a></li>
                                            <li class="breadcrumb-item active">Manage</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Settings</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                         <?=$this->session->flashdata('FlashMassage');?>

                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Manage Settings</h4>
                                        <!-- <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p> -->
                                        <div class="tab-content">
                                                <form action="<?=base_url('Settings/UpdateSettings')?>" method="post" enctype="multipart/form-data">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Company Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->Company_name?>" name="Company_name" id="companyname" placeholder="Company Name" required>
                                                            <input type="hidden" class="form-control" value="<?=$Settings->setting_id?>" name="setting_id">
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Company Logo <span class="text-danger"  title="Required">*</span></label><br/>
                                                            
                                                            <input type="file" class="form-control" name="logo">
                                                            <input type="hidden" class="form-control" value="<?=$Settings->logo?>" name="oldlogo">
                                                            <img src="<?=base_url()."/".$Settings->logo?>" alt="" width="50px" height="50px">
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Email<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="email" class="form-control" value="<?=$Settings->email?>"  placeholder="Email" name="email" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Phone No<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->Phone_no?>"  id="companyname" name="Phone_no" placeholder="Phone No" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Account No<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->accountNumber?>"  id="companyname" name="accountNumber" placeholder="Account No" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Bank Name<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->BankName?>"  id="companyname" name="BankName" placeholder="Bank Name" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">IFSC Code<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->IFSCCode?>"  id="companyname" name="IFSCCode" placeholder="IFSC Code" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">GST No. <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->GST?>"  id="companyname" placeholder="GST No." name="GST" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">PAN No. <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->PAN?>"  id="companyname" placeholder="PAN No." name="PAN" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">User Name<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->user_name?>"  id="companyname" placeholder="User Name" name="user_name" required>
                                                            
                                                        </div> 
                                                        <div class="form-group col-md-6">
                                                            <label for="slogan" class="col-form-label">Slogan<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->slogan?>"  id="slogan" placeholder="slogan" name="slogan" required>
                                                            
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="Jurisdiction" class="col-form-label">Jurisdiction<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Settings->Jurisdiction?>"  id="Jurisdiction" placeholder="Jurisdiction" name="Jurisdiction" required>
                                                            
                                                        </div> 
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">Licence No. <span class="text-danger"  title="Required">*</span></label>
                                                            <textarea name="Licence_no" placeholder="Licence No."  class="form-control" cols="30" rows="10"><?=$Settings->Licence_no?></textarea>                       
                                                        </div> 
                                                        <div class="form-group col-md-6">
                                                            <label for="companyname" class="col-form-label">Address<span class="text-danger"  title="Required">*</span></label>
                                                            <textarea name="Address" placeholder="Address" class="form-control" cols="30" rows="10"><?=$Settings->Address?></textarea>                       
                                                        </div>                                                        
                                                    </div>
        
                                                    <!-- <a href="#" class="btn btn-danger ">Update</a> -->
                                                   
                                                     <input type="submit" name="addsettings" class="btn btn-success float-right" value="Update Details">
                                                     
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->