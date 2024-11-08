 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Supplier/Manage')?>">Bank</a></li>
                                            <li class="breadcrumb-item active">Add</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Bank</h4>
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
                                        <h4 class="header-title">Add Bank</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Bank/Add')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="bankname" class="col-form-label">Bank Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="bankname" id="bankname" placeholder="Bank-Name" required>
                                                           
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accounttyp" class="col-form-label">Account Type <span class="text-danger" title="Required">*</span></label>
                                                            <select name="accounttyp" id="accounttyp" class="form-control" required>
                                                               <option value="0">Select Account Type</option>
                                                               <option value="1">Petty Cash</option>
                                                               <option value="2">Saving Account</option>
                                                               <option value="3">Current Account</option>
                                                               <option value="4">OverDraft Account</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Account Number </label>
                                                           <input type="text" name="accountno" id="accountno" class="form-control" placeholder="Account No">

                                                        </div>
                                                    </div>
                                                    <div class="form-row">

                                                        <div class="form-group col-md-4">
                                                            <label for="ifsccode" class="col-form-label">IFSC Code </label>
                                                           <input type="text" name="ifsccode" id="ifsccode" class="form-control" placeholder="IFSC Code">

                                                        </div>           
                                                        <div class="form-group col-md-4">
                                                            <label for="bankadd" class="col-form-label">Bank Addess</label>
                                                            <textarea name="bankadd" id="bankadd" cols="30" rows="2" class="form-control" placeholder="Bank Addess"></textarea>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="openbal" class="col-form-label">Opening Balance <span class="text-danger" title="Required">*</span></label>
                                                            <input type="number" class="form-control" name="openbal" id="openbal" placeholder="Opening Balance" required>
                                                        </div>
                                                    </div>
        
                                                    
        
                                                    <a href="<?=base_url('Supplier/View_Bill')?>" class="btn btn-danger ">Back</a>
                                                   
                                                     <button type="submit" class="btn btn-success float-right">Add Bank</button>
                                                     
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->