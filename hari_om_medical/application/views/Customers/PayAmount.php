 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Supplier/Manage')?>">Payment</a></li>
                                            <li class="breadcrumb-item active">Paybill</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Pay Bill</h4>
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
                                        <h4 class="header-title">Pay BIll</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the supplier details..
                                        </p>

                                        
                                        <div class="tab-content">
                                          
                                                <form action="<?=base_url('Sale/PayBill')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="suppliername" class="col-form-label">Supplier Name <span class="text-danger"  title="Required">*</span></label>
                                                            <input type="text" class="form-control" name="customername" id="customername" placeholder="Customer-Name" value="<?=$Customers->first_name."".$Customers->last_name?>" readonly>
                                                            <input type="hidden" name="person_id" value="<?=$Customers->person_id?>">
                                                           <input type="hidden" name="pur_id" value="<?php echo $bill1?>">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="paymentmode" class="col-form-label">Payment Mode <span class="text-danger" title="Required">*</span></label>
                                                            <select name="paymentmode" id="paymentmode" class="form-control" required>
                                                                <option value="">Select Mode</option>
                                                                <option value="Cash">Cash</option>
                                                                <option value="Cheque">Cheque</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="fromaccount" class="col-form-label">From Account <small class="text-right"><a href="<?=base_url('Bank/Add')?>">Add Bank</a></small></label>
                                                           <select name="fromaccount" id="fromaccount" class="form-control" required>
                                                               <option value="">Select Account</option>
                                                               <?php
                                                               foreach ($bank_details as $key => $bank) {
                                                                 ?>
                                                                 <option value="<?=$bank->bank_id?>"><?=$bank->bank_name?></option>
                                                                 <?php
                                                               }
                                                               ?>
                                                           </select>

                                                        </div>
                                                    </div>
                                                    <div class="form-row">           
                                                        <div class="form-group col-md-4">
                                                            <label for="paydate" class="col-form-label">Date</label>
                                                            <input type="text" class="form-control date" id="paydate" data-toggle="date-picker" name="paydate" data-single-date-picker="true">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="payamount" class="col-form-label">Amount <span class="text-danger" title="Required">*</span></label>
                                                            <input type="number" class="form-control" name="payamount" id="payamount" value="<?=$payamt?>" placeholder="Payment Amount" required min="1" step="0.01" max="<?=$payamt?>">
                                                        </div>
                                                    </div>
        
                                                    
        
                                                    <a href="<?=base_url('Sale/ViewAllBill')?>" class="btn btn-danger ">Back</a>
                                                    
                                                     <button type="submit" class="btn btn-success float-right">Complete Payment</button>
                                                      
        
                                                </form>                
                                           
                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->