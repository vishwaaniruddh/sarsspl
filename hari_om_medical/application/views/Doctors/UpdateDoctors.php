 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Doctors/Manage')?>">Doctors</a></li>
                                            <li class="breadcrumb-item active">Update Doctors</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Doctors</h4>
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
                                        <h4 class="header-title">Update Doctors</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the Doctors details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Doctors/Edit')?>/<?=urlencode($Doctors->person_id)?>" method="post">
                                                    <div class="form-row">
                                                        
                                                        <div class="form-group col-md-4">
                                                            <label for="firstname" class="col-form-label">First Name <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$Doctors->first_name?>" placeholder="First-name" required>
                                                            <input type="hidden" name="persons_id" id="persons_id" value="<?=$Doctors->person_id?>" >
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="Lastname" class="col-form-label">Last Name</label>
                                                            <input type="text" class="form-control" name="Lastname" id="Lastname" value="<?=$Doctors->last_name?>" placeholder="Last-name">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="email" class="col-form-label">Email</label>
                                                            <input type="email" name="email" class="form-control" id="email" value="<?=$Doctors->email?>" placeholder="Email">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="birthdate" class="col-form-label">Date Of Birth</label>
                                                            <input type="text" class="form-control date"  value="<?=date('Y-m-d',strtotime($Doctors->dob))?>" name="birthdate" class="form-control date" data-single-date-picker="true"  data-date-format="dd-mm-yyyy">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="phonenumber" class="col-form-label">Phone Number <span class="text-danger" title="Required">*</span></label>
                                                            <input type="number" class="form-control" value="<?=$Doctors->phone_number?>" name="phonenumber" id="phonenumber" placeholder="Phone Number" required>
                                                        </div>
                                                    </div>
        
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Address <span class="text-danger" title="Required">*</span></label>
                                                        <input type="text" name="inputAddress" class="form-control" id="inputAddress" value="<?=$Doctors->address_1?>" placeholder="1234 Main St" required>
                                                    </div>
        
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="inputCity" class="col-form-label">City <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Doctors->city?>" name="inputCity" id="inputCity" required>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="inputState" class="col-form-label">State <span class="text-danger" title="Required">*</span></label>
                                                            
                                                            <select name="state" class="form-control" id="inputState" required>
                                                                <option value="">Select State</option>
                                                                <?php foreach ($statelist as $key => $state) {
                                                                   ?>
                                                                    <option value="<?=$state->state_name?>" <?php if($state->state_name==$Doctors->state){ echo "selected";} ?>><?=$state->state_name?></option>
                                                                   <?php
                                                                } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="inputZip"  class="col-form-label">Zip <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Doctors->zip?>" name="inputZip" id="inputZip" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="country" class="col-form-label">Country <span class="text-danger" title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$Doctors->country?>" name="country"  id="country" placeholder="Country" required>
                                                        </div>
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Account No</label>
                                                            <input type="text" class="form-control" name="accountno" id="accountno" value="<?=$Doctors->account_number?>" placeholder="Account No">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="ifsccode" class="col-form-label">IFSC Code</label>
                                                            <input type="text" class="form-control" value="<?=$Doctors->ifsccode?>" name="ifsccode" id="ifsccode" placeholder="IFSC Code">
                                                        </div> -->
                                                 <!--    </div>
        
                                                    <div class="form-row"> -->
                                                        <div class="form-group col-md-4">
                                                            <label for="pannumber" class="col-form-label">Pan Number</label>
                                                            <input type="text" class="form-control" name="pannumber" id="pannumber" value="<?=$Doctors->pannumber?>" onkeyup="this.value = this.value.toUpperCase();" placeholder="Pan Number">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="gstno" class="col-form-label">GST No</label>
                                                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" value="<?=$Doctors->gstno?>" name="gstno" id="gstno" placeholder="GST No">
                                                        </div>
                                                        
                                                    </div>
        
                                                    <div class="form-row">
                                                         <div class="form-group col-md-12">
                                                            <label for="comments" class="col-form-label">Comments</label>                             
                                                            <textarea name="comments" id="comments" class="form-control" cols="30" rows="7" placeholder="Comments Here"><?=$Doctors->comments?></textarea>
                                                        </div>

                                                        <!-- <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="customCheck11">
                                                            <label class="custom-control-label" for="customCheck11">Check this custom checkbox</label>
                                                        </div> -->
                                                    </div>
        
                                                    <input type="submit" class="btn btn-success float-right" name="updatebtn" value="Update Doctors">
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->