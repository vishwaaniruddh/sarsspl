 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Settings/ManageScheme')?>">Manage Scheme</a></li>
                                            <li class="breadcrumb-item active">Add Scheme</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Scheme</h4>
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
                                        <h4 class="header-title">Add Scheme</h4>
                                        <!-- <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p> -->

                                        <div class="tab-content">
                                                <form action="<?=base_url('Settings/AddScheme')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="bankname" class="col-form-label">Scheme Name<span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="SchemeName" id="SchemeName" placeholder="Scheme-Name" required>
                                                           
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Product Buy</label>
                                                           <input type="number" name="buy" id="price" class="form-control" placeholder="Product buy">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Product Free</label>
                                                           <input type="number" name="free" id="free" class="form-control" placeholder="Product free">
                                                        </div>
                                                    </div>
                                                    <a href="<?=base_url('Settings/ManageScheme')?>" class="btn btn-danger ">Back</a>
                                                     <input type="submit" name="addScheme" class="btn btn-success float-right" value="Add Scheme">
                                                </form>   
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->