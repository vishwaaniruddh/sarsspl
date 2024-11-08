 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                                            <li class="breadcrumb-item active">Manage</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Category</h4>
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
                                        <div class="col-lg-8">                           
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="text-lg-right">
                                                <a class="btn btn-danger mb-2 mr-2" href="<?=base_url('Product/AddCategory')?>" >
                                                    <i class="mdi mdi-basket mr-1">
                                                    </i>
                                                    Add Category
                                                </a>                                               
                                            </div>
                                        </div>
                                        <!-- end col-->
                                    </div>
                                        <div class="table-responsive">
                                            <table class="table table-centered w-100 dt-responsive " id="basic-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Category</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php
                                                	foreach ($catlist as $key => $cat) {
                                                		
                                                	 ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <?=$cat->category?>
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