 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Product/Manage')?>">Product</a></li>
                                            <li class="breadcrumb-item active">Add</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Product</h4>
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
                                        <h4 class="header-title">Add Product</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Product/Add')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="bankname" class="col-form-label">Product Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="productname" id="productname" placeholder="Product-Name" required>
                                                           
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accounttyp" class="col-form-label">Product Category <span class="text-danger" title="Required">*</span></label>
                                                            <select name="category" id="accounttyp" class="form-control" required>
                                                               <option value="0">Product Category</option>
                                                               <?php foreach ($catlist as $key => $cat) {?>
                                                                 <option value="<?=$cat->category?>"><?=$cat->category?></option>
                                                              <?php } ?>
                                                              
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Product Price </label>
                                                           <input type="text" name="price" id="price" class="form-control" placeholder="Product Price">

                                                        </div>
                                                    </div>
                                                  <!--  <div class="form-row">

                                                        <div class="form-group col-md-4">
                                                            <label for="ifsccode" class="col-form-label">Batch No </label>
                                                           <input type="text" name="Batchno" id="batchno" class="form-control" placeholder="Batch No">

                                                        </div>           
                                                        
                                                        <div class="form-group col-md-4">
                                                            <label for="openbal" class="col-form-label">Expiry Date<span class="text-danger" title="Required">*</span></label>
                                                            <input type="date" class="form-control" name="expirydate" id="expirydate" placeholder="Expiry Date" required>
                                                        </div>
                                                    </div>-->
        
                                                    
        
                                                    <a href="<?=base_url('Product/Stock')?>" class="btn btn-danger ">Back</a>
                                                   
                                                     <input type="submit" name="addproduct" class="btn btn-success float-right" value="Add Product">
                                                     
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->