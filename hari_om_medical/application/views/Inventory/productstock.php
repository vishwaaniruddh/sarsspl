 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                                            <li class="breadcrumb-item active">Stock</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Product Stock</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="javascript:void(0);" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Products</a>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div>
                                        </div> -->
                
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive " id="basic-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Product</th>
                                                        <th>Category</th>
                                                        <th>Added Date</th>
                                                        <!-- <th>Price</th> -->
                                                        <th>Quantity</th>
                                                        <th>Status</th>
                                                        <!-- <th style="width: 85px;">Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php
                                                	foreach ($Stocks as $key => $stock) {
                                                		
                                                	 ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <?=$stock->productname?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->catname?>
                                                        </td>
                                                        <td>
                                                            <?=date('d-m-Y',strtotime($stock->updated_at))?>
                                                        </td>                
                    
                                                        <td>
                                                            <?=$stock->stock?>
                                                        </td>
                                                        <td>
                                                        	<?php if($stock->stock>0){

                                                        	?>
                                                            <span class="badge badge-success">In Stock</span>
                                                            <?php } else { ?>
                                                            <span class="badge badge-danger">Out of Stock</span>
                                                            <?php } ?>
                                                        </td>
                    
                                                        <!-- <td class="table-action">
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </td> -->
                                                    </tr>
                                                <?php } ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->        
                        
                    </div> <!-- container -->