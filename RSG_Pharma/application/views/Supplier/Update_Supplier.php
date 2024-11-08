 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Supplier/Manage')?>">Supplier</a></li>
                                            <li class="breadcrumb-item active">Update Supplier</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Supplier</h4>
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
                                        <h4 class="header-title">Update Supplier</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the supplier details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Supplier/Edit')?>/<?=urlencode($this->encryption->encrypt($supplier->person_id))?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="companyname" class="col-form-label">Company Name <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="companyname" id="companyname" value="<?=$supplier->company_name?>" placeholder="Company-Name" required> 
                                                            <input type="hidden"  name="person_id" id="person_id" value="<?=$supplier->person_id?>"required>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="firstname" class="col-form-label">First Name <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$supplier->first_name?>" placeholder="First-name" required>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Lastname" class="col-form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="Lastname" id="Lastname" value="<?=$supplier->last_name?>" placeholder="Last-name">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" id="email" value="<?=$supplier->email?>" placeholder="Email">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="birthdate" class="col-form-label">Date Of Birth</label>
                                                            <input type="text"  value="<?=date('d-m-Y',strtotime($supplier->dob))?>" name="birthdate" class="form-control date" data-single-date-picker="true"  data-date-format="dd-mm-yyyy">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="phonenumber" class="col-form-label">Phone Number <span class="text-danger" title="Required">*</span></label>
                                                            <input type="number" class="form-control" value="<?=$supplier->phone_number?>" name="phonenumber" id="phonenumber" placeholder="Phone Number" required>
                                                        </div>
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Address <span class="text-danger" title="Required">*</span></label>
                                                        <input type="text" name="inputAddress" class="form-control" id="inputAddress" value="<?=$supplier->address_1?>" placeholder="1234 Main St" required>
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="inputAddress2" class="col-form-label">Address 2</label>
                                                        <input type="text" class="form-control" name="inputAddress2" id="inputAddress2" value="<?=$supplier->address_2?>" placeholder="Apartment, studio, or floor">
                                                    </div>
        
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputCity" class="col-form-label">City <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$supplier->city?>" name="inputCity" id="inputCity" required>
                                                        </div>
                                                        
                                                         <div class="form-group col-md-4">
                                                            <label for="inputState" class="col-form-label">State <span class="text-danger" title="Required">*</span></label>             
                                                            <select name="state" class="form-control" id="inputState" required>
                                                                <option value="">Select State</option>
                                                                <?php foreach ($statelist as $key => $state) {
                                                                   ?>
                                                                    <option value="<?=$state->state_name?>" <?php if($state->state_name==$supplier->state){ echo "selected";} ?>><?=$state->state_name?></option>
                                                                   <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="inputZip"  class="col-form-label">Zip <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$supplier->zip?>" name="inputZip" id="inputZip" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="country" class="col-form-label">Country <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$supplier->country?>" name="country"  id="country" placeholder="Country" required>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Account No</label>
                                                            <input type="text" class="form-control" name="accountno" id="accountno" value="<?=$supplier->account_number?>" placeholder="Account No">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="ifsccode" class="col-form-label">IFSC Code</label>
                                                            <input type="text" class="form-control" value="<?=$supplier->ifsccode?>" name="ifsccode" id="ifsccode" placeholder="IFSC Code">
                                                        </div>
                                                    </div>
        
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="pannumber" class="col-form-label">Pan Number</label>
                                                            <input type="text" class="form-control" name="pannumber" id="pannumber" value="<?=$supplier->pannumber?>" placeholder="Pan Number">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="gstno" class="col-form-label">GST No</label>
                                                            <input type="text" class="form-control" value="<?=$supplier->gstno?>" name="gstno" id="gstno" placeholder="GST No">
                                                        </div>
                                                        
                                                    </div>
        
                                                    <div class="form-row">
                                                         <div class="form-group col-md-12">
                                                            <label for="comments" class="col-form-label">Comments</label>                             
                                                            <textarea name="comments" id="comments" class="form-control" cols="30" rows="7" placeholder="Comments Here"><?=$supplier->comments?></textarea>
                                                        </div>

                                                        <!-- <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                            <label class="custom-control-label" for="customCheck11">Check this custom checkbox</label>
                                                        </div> -->
                                                    </div>
        
                                                    <input type="submit" class="btn btn-success float-right" name="updatebtn" value="Update Supplier">
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->