 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Product/Category')?>">Category</a></li>
                                            <li class="breadcrumb-item active">Add</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Category</h4>
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
                                        <h4 class="header-title">Add Category</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Product/AddCategory')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="categoryname" class="col-form-label">Category Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="categoryname" id="categoryname" placeholder="Category-Name" required>
                                                            
                                                        </div>                                                        
                                                    </div>
        
                                                    <a href="<?=base_url('Product/Category')?>" class="btn btn-danger ">Back</a>
                                                   
                                                     <input type="submit" name="addcat" class="btn btn-success float-right" value="Add Category">
                                                     
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->