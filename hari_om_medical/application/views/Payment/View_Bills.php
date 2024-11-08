<!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Supplier/View_Bill')?>">Bill</a></li>
                                            <li class="breadcrumb-item active">View Payment</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Payment</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <div class="row mb-2">
                                            <div class="col-lg-8">
                                                <form class="form-inline">
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
                                                </form>                            
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <button type="button" class="btn btn-danger mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i> Add New Order</button>
                                                   
                                                </div>
                                            </div>
                                        </div> -->
                
                                        <div class="table-responsive">
                                            <table class="table table-centered mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Serial No</th>
                                                        <th>Bill ID</th>
                                                        <th>Date</th>
                                                        <th>Payment Status</th>
                                                        <th>Pay Amount</th>
                                                        <th>Payment Method</th>
                                                        <th style="width: 125px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($Payment_details as $key => $payment) {
                                                     ?>
                                                    <tr>
                                                        <td>
                                                            <?=$key+1?>
                                                        </td>
                                                        <td><a href="" class="text-body font-weight-bold"><?=$payment->bill_no?></a> </td>
                                                        <td>
                                                            <?=date('d-m-Y',strtotime($payment->paid_date))?>
                                                        </td>
                                                        <td>
                                                            <h5><span class="badge badge-success-lighten"><i class="mdi mdi-coin"></i> Paid</span></h5>
                                                        </td>
                                                        <td>
                                                           <?=$payment->amt?>
                                                        </td>
                                                        <td>
                                                            <h5><span class="badge  <?php if(ucfirst($payment->mode)=='Cash'){ echo "badge-success-lighten";} else { echo "badge-warning-lighten";} ?>">
                                                            <?=ucfirst($payment->mode)?>
                                                            </span></h5>
                                                        </td>
                                                        
                                                        <td>
                                                            <a href="<?=base_url('Bill/Invoice')?>/<?=$payment->trans_id?>" class=" btn btn-info btn-sm"> <i class="mdi mdi-eye"></i>View</a>
                                                           
                                                        </td>
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