<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Supplier/View_Bill')?>">Bank</a></li>
                                            <li class="breadcrumb-item active">Add Transaction</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> Transaction</h4>
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
                                                <form class="form-inline" method="post" action="#">
                                                    <div class="form-group mb-2">
                                                        <label for="inputPassword2" class="sr-only">Search</label>
                                                        <select name="bank_id" id="accounttyp" class="form-control" required>
                                                               <option value="">Select Account Type</option>
                                                               <option value="0">All Bank</option>
                                                               <?php foreach ($Banks as $key => $bank) {
                                                                     ?>
                                                               <option value="<?=$bank->bank_id?>"><?=$bank->bank_name?></option>
                                                           <?php }?>

                                                            </select>
                                                    </div>
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <!-- <div class="form-group"> -->
                                                            <!-- <label>Predefined Date Ranges</label> -->
                                                            <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-date-format="dd/mm/yyyy" data-target-display="#selectedValue"  data-cancel-class="btn-light">
                                                                <i class="mdi mdi-calendar"></i>&nbsp;
                                                                <span id="selectedValue"></span> <i class="mdi mdi-menu-down"></i>
                                                            </div>
                                                            <input type="hidden" id="start" name="start">
                                                            <input type="hidden" id="end" name="end">
                                                        <!-- </div> -->

                                                    </div>
                                                    <button type="submit" class="btn btn-info mb-2">Search</button> 
                                                   

                                                </form>                            
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="text-lg-right">
                                                    <a type="button" href="<?=base_url('BankPayment/Entry')?>" class="btn btn-danger mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i> Add Bank Entry</a>
                                                    <!-- <button type="button" class="btn btn-light mb-2">Export</button> -->
                                                </div>
                                            </div><!-- end col-->
                                        </div>
                
                                        <div class="table-responsive">
                                             <table class="table table-centered mb-0 " id="basic-datatable" >
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Serial No</th>
                                                        <th>Transaction ID</th>
                                                        <th>Date</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                        <th>Payment Memo</th>
                                                        <!-- <th style="width: 125px;">Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(isset($Payment_details) && $Payment_details!=null){
                                                    foreach ($Payment_details as $key => $payment) {
                                                     ?>
                                                    <tr>
                                                        <td>
                                                            <?=$key+1?>
                                                        </td>
                                                        <td><a href="" class="text-body font-weight-bold"><?=$payment->trans_id?></a> </td>
                                                        <td >
                                                            <span style="white-space: nowrap;"><?=date('d-m-Y',strtotime($payment->trans_date))?></span>
                                                        </td>
                                                        <td>
                                                            <?php if($payment->trans_type=="payment" || $payment->trans_type=="banktrans")
                                                            {
                                                                echo "<span class='text-danger'>".$payment->trans_amt."</span>";

                                                            }
                                                              ?>
                                                        </td>
                                                        <td>
                                                           <?php if($payment->trans_type=="receit")
                                                            {
                                                                echo "<span class='text-success'>".$payment->trans_amt."</span>";

                                                            }
                                                              ?>
                                                        </td>
                                                        <td>
                                                            <?=$payment->trans_memo?>
                                                        </td>
                                                        
                                                       <!--  <td>
                                                            <a href="<?=base_url('Bill/Invoice')?>/<?=$payment->trans_id?>" class=" btn btn-info btn-sm"> <i class="mdi mdi-eye"></i>View</a>
                                                           
                                                        </td> -->
                                                    </tr>
                                                    <?php
                                                     }
                                                 }
                                                     ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <button class="btn btn-success">Total Credit :- <strong><?php if(isset($Payment_details[0]->total_credit) && $Payment_details[0]->total_credit!=null){?> <?=$Payment_details[0]->total_credit?><?php }else { echo "0";} ?></strong></button>
                                        <button class="btn btn-danger">Total Debit:- <strong><?php if(isset($Payment_details[0]->total_debit) && $Payment_details[0]->total_debit!=null){?> <?=$Payment_details[0]->total_debit?><?php }else { echo "0";} ?></strong></button>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
                        
                    </div> <!-- container -->

                    <!-- <script>
                        $('#reportrange').daterangepicker({   
                            locale: {
                                format: 'YYYY-MM-DD'
                            }
                    </script> -->  

                    <script type="text/javascript">
$(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        $("#start").val(start.format('YYYY-MM-DD'));
        $("#end").val(end.format('YYYY-MM-DD'));
        
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment()],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }



    }, cb);

    cb(start, end);

   
});
</script> 

                      