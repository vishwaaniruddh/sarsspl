                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Bank/View')?>">Bank</a></li>
                                            <li class="breadcrumb-item active">View Bank</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Bank</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <!-- <form class="form-inline">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">Search</label>
                                                        <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="status-select" class="mr-2">Status</label>
                                                        <select class="custom-select" id="status-select">
                                                            <option selected>Choose...</option>
                                                            <option value="1">Paid</option>
                                                            <option value="2">Awaiting Authorization</option>
                                                            <option value="3">Payment failed</option>
                                                            <option value="4">Cash On Delivery</option>
                                                            <option value="5">Fulfilled</option>
                                                            <option value="6">Unfulfilled</option>
                                                        </select>
                                                    </div>
                                                </form>   -->                          
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <a type="button" href="<?=base_url('Bank/Add')?>" class="btn btn-danger mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i> Add New Bank</a>
                                                    <!-- <button type="button" class="btn btn-light mb-2">Export</button> -->
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0" id="basic-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Serial No</th>
                                                        <th>Bank Name</th>
                                                        <th>Account Number</th>
                                                        <th> Bank Address</th>
                                                        <th> Account Type</th>
                                                        <th>Last Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    foreach ($Banks as $key => $bank) {
                                                     ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td><?=$bank->bank_name?></td>
                                                        <td><?=$bank->ac_no?></td>
                                                        <td><?=$bank->address?></td>
                                                        <td>
                                                            <?php 
                                                            if($bank->ac_type==1)
                                                            {
                                                             echo "Petty Cash";
                                                            }
                                                            else if($bank->ac_type==2)
                                                            {
                                                                echo "Saving Account";
                                                            }
                                                            else if($bank->ac_type==3)
                                                            {
                                                                echo "Current Account";
                                                            }
                                                            else if($bank->ac_type==4)
                                                            {
                                                                echo "OverDraft Account";
                                                            }
                                                           ?></td>
                                                        <td><?=$bank->overdraft?></td>
                                                        
                                                    </tr>
                                                    <?php
                                                     }
                                                     ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
                        
                    </div> <!-- container