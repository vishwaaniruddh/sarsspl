 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                                            <li class="breadcrumb-item active">Scheme</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Manage Scheme</h4>
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
                                                <a class="btn btn-danger mb-2 mr-2" href="<?=base_url('Settings/AddScheme')?>" >
                                                    <i class="mdi mdi-plus">
                                                    </i>
                                                    Add Scheme
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
                                                        <th>Scheme Name</th>
                                                        <th>Buy ON</th>
                                                        <th>Get Free</th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php
                                                	foreach ($Schemes as $key => $Scheme) {
                                                		
                                                	 ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <?=$Scheme->SchemeName?>
                                                        </td> 
                                                         <td>
                                                            <?=$Scheme->buy?>
                                                        </td> 
                                                         <td>
                                                            <?=$Scheme->free?>
                                                        </td> 
                                                         <!-- <td>
                                                            <?=$Scheme->free?>
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