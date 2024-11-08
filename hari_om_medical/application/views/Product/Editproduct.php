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
                                    <h4 class="page-title">Edit Product</h4>
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
                                        <h4 class="header-title">Edit Product</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Product/ProductEdit')?>/<?=$product->item_id?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="bankname" class="col-form-label">Product Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" value="<?=$product->name?>" name="productname" id="productname" placeholder="Product-Name" required>
                                                           
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="accounttyp" class="col-form-label">Product Category <span class="text-danger" title="Required">*</span></label>
                                                            <select name="category" id="accounttyp" class="form-control" required>
                                                               <option value="0">Product Category</option>
                                                               <?php foreach ($catlist as $key => $cat) {?>
                                                                 <option value="<?=$cat->category?>" <?php if($product->category==$cat->category){ echo "selected";} ?>><?=$cat->category?></option>
                                                              <?php } ?>
                                                              
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="hsn" class="col-form-label">GST </label>
                                                           <input type="text" name="GST" id="GST"  value="<?=$product->GST?>"class="form-control" placeholder="GST">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="hsn" class="col-form-label">HSN </label>
                                                           <input type="text" name="hsn" id="hsn"  value="<?=$product->hsn?>"class="form-control" placeholder="HSN">
                                                           <input type="hidden" value="<?=$product->item_id?>" name="item_id">

                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="unit" class="col-form-label">Unit <span class="text-danger" title="Required">*</span></label>
                                                           <input type="text" name="unit" id="unit" value="<?=$product->unit?>" class="form-control" placeholder="unit Like ml,gm,teb" required>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="rack" class="col-form-label">Quantity </label>
                                                           <input type="text" name="qty" value="<?=$product->quantity?>" id="qty" class="form-control" placeholder="Quantity">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label for="description" class="col-form-label">Product Description </label>
                                                         
                                                           <textarea class="form-control" rows="5" name="description" id="description"><?=$product->description?></textarea>
                                                        </div>
                                                    

                                                         
                                                        </div>          
                                                        
                                                        <!-- <div class="form-group col-md-4">
                                                            <label for="openbal" class="col-form-label">Expiry Date<span class="text-danger" title="Required">*</span></label>
                                                            <input type="date" class="form-control" name="expirydate" id="expirydate" placeholder="Expiry Date" required>
                                                        </div>
                                                    </div>
         -->
                                                    
        
                                                    <a href="<?=base_url('Product/Manage')?>" class="btn btn-danger ">Back</a>
                                                   
                                                     <input type="submit" name="Editproduct" class="btn btn-success float-right" value="Update Product">
                                                     
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->