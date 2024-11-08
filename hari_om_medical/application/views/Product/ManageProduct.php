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
                         <?=$this->session->flashdata('FlashMassage');?>

                        <!-- Form row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                         <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="<?=base_url('Product/Add')?>" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle mr-2"></i> Add Products</a>
                                            </div>
                                            <!-- <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div> -->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive " id="basic-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Product</th>
                                                        <th>Supplier</th>
                                                        <th>Category</th>
                                                        <th>Unit</th>
                                                        <th>Quantity</th> 
                                                        <th>HSN</th>
                                                        <th>GST</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php
                                                	foreach ($Prolist as $key => $stock) {
                                                		
                                                	 ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <?=$stock->name?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                            $supplier_id = $stock->supplier_id;
                                                            
                                                             $supp_name= $this->Product_M->getcompanyname($supplier_id);
                                                            // echo $supp_name;
                                                            echo $supplier_id;
                                                            
                                                            ?>
                                                             
                                                        </td>
                                                        <td>
                                                           <?=$stock->category?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->unit?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->quantity?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->hsn?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->GST?>
                                                        </td>
                                                        <td>
                                                            <a href="<?=base_url('Product/ProductEdit')?>/<?=$stock->item_id?>" class="btn btn-sm btn-info">Edit</a>
                                                           
                                                        </td>
                                                                                               
                    
                                                        
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