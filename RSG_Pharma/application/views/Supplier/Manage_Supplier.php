<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">
                                Supplier
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Manage
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Supplier Manage
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
     <?=$this->session->flashdata('FlashMassage');?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-8">
                           
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a class="btn btn-danger mb-2 mr-2" href="<?=base_url('Supplier/New')?>" >
                                    <i class="mdi mdi-basket mr-1">
                                    </i>
                                    Add New Supplier
                                </a>
                                <!-- <button class="btn btn-light mb-2" type="button">
                                    Export
                                </button> -->
                            </div>
                        </div>
                        <!-- end col-->
                    </div>
                    <div class="table-responsive">
                
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="thead-light">
                                <tr>
                                    
                                    <th>
                                        Serial No
                                    </th>
                                    <th>
                                        Company Name
                                    </th>
                                    <th>
                                        First Name
                                    </th>
                                    <th>
                                        Last Name
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone Number
                                    </th>
                                    <th style="width: 125px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
                            	foreach ($suppliers as $key => $supplier) {
                            		
                            	?>
                                <tr>
                                   
                                    <td>
                                        <a class="text-body font-weight-bold" href="#">
                                            <?=$key+1?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=$supplier->company_name?>
                                    </td>
                                    <td>
                                        <?=$supplier->data->first_name?>
                                    </td>
                                    <td>
                                       <?=$supplier->data->last_name?>
                                    </td>
                                    <td>
                                        <?=$supplier->data->email?>
                                    </td>
                                    <td>
                                       <?=$supplier->data->phone_number?>
                                    </td>
                                    <td>
                                        <a class="action-icon" href="<?=base_url('Supplier/View')?>/<?=$supplier->data->person_id?>">
                                            <i class="mdi mdi-eye">
                                            </i>
                                        </a>
                                        <a class="action-icon" href="<?=base_url('Supplier/Edit')?>/<?=$supplier->data->person_id?>">
                                            <i class="mdi mdi-square-edit-outline">
                                            </i>
                                        </a>
                                        <a class="action-icon" href="javascript:void(0);">
                                            <i class="mdi mdi-delete">
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                               <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->
