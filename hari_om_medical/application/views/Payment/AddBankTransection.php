 <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Bank/Manage')?>">Bank</a></li>
                                            <li class="breadcrumb-item active">Add Transection</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Add Transection</h4>
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
                                        <h4 class="header-title">Add Transection</h4>
                                        <p class="text-muted font-14">
                                           Please Fill (<span class="text-danger">*</span> Required) Input In the details..
                                        </p>


                                        <div class="tab-content">

                                                <form action="<?=base_url('BankPayment/Entry')?>" method="post">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="bankname" class="col-form-label">Transaction Type <span class="text-danger"  title="Required">*</span></label>
                                                           <select name="trans_type" id="trans_type" class="form-control" onchange="showbank()" required="true"><option value="">Select type</option>
                                                            <option value="payment">Payment</option>
                                                            <option value="receit">Receit </option>
                                                            <option value="banktrans">Bank Transfer</option>
                                                                </select>

                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accounttyp" class="col-form-label">Bank Name <span class="text-danger" title="Required">*</span></label>

                                                            <select name="bank_id" id="accounttyp" class="form-control" required>
                                                               <option value="">Select Account Type</option>
                                                               <?php foreach ($Banks as $key => $bank) {
    ?>
                                                               <option value="<?=$bank->bank_id?>"><?=$bank->bank_name?></option>
                                                           <?php }?>

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4" style="display: none;">
                                                            <label for="accounttyp" class="col-form-label">Transfer to Bank Name <span class="text-danger" title="Required">*</span></label>

                                                            <select name="bank_id1" class="form-control" required>
                                                               <option value="0">Select Account Type</option>
                                                               <?php foreach ($Banks as $key => $bank) {
    ?>
                                                               <option value="<?=$bank->bank_id?>"><?=$bank->bank_name?></option>
                                                           <?php }?>

                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="accountno" class="col-form-label">Transaction Date </label>
                                                           <input type="text" class="form-control date" id="birthdatepicker" name="transdate"
                                                                 value="<?=date('d-m-Y')?>"
                                                                 data-single-date-picker="true" data-date-format="dd-mm-yyyy" required="true">

                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="form-row form-group">
                                                      <div class="form-group col-md-6">
                                                            <label for="Amount" class="col-form-label">Amount </label>
                                                           <input type="text" class="form-control " id="Amount"  name="amt[]" required="true">
                                                        </div>
                                                      <div class="form-group col-md-6">
                                                            <label for="memo" class="col-form-label">Memo </label>
                                                           <textarea name="memo[]" class="form-control" id="memo" cols="30" rows="1" required="true"></textarea>
                                                        </div>
                                                    </div>
                                                    <div  id="addamtrow"></div>
                                                    <div class="form-row form-group">
                                                        <div class="col-md-12 text-right">
                                                            <a class="btn btn-info text-white" onclick="addamtrow()"><i class=" uil-plus-square"></i> Add Row</a>
                                                            <input type="hidden" name="count" value="1" id="count">
                                                        </div>
                                                    </div>



                                                    <a href="<?=base_url('Bank/Manage')?>" class="btn btn-danger ">Back</a>

                                                     <input type="submit" name="AddTxn" class="btn btn-success float-right" value="Add Transection">

                                                </form>

                                        </div> <!-- end tab-content-->

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->


                <script>
                    function addamtrow()
                    {
                        var count=$("#count").val();
                        

                        var html='<div class="form-row" id="newrow'+count+'"><div class="form-group col-md-6"><label for="Amount" class="col-form-label">Amount </label><input type="text" class="form-control " id="Amount"  name="amt[]" ></div><div class="form-group col-md-5"><label for="memo" class="col-form-label">Memo </label><textarea name="memo[]" class="form-control" id="memo" cols="30" rows="1"></textarea></div><div class="col-md-1 text-white" style="margin-top: 39px;"><a class="btn btn-sm btn-danger" onclick="removetxrow('+count+')"><i class="uil-trash"></i></a></div></div>';
                        $("#addamtrow").append(html);
                       var newcount=parseInt(count)+1;
                        $("#count").val(newcount);
                        }

                        function removetxrow(count)
                        {
                            $("#newrow"+count).remove();
                        // var countrow=$("#count").val();
                        // var newcount=parseInt(countrow)-1;
                        // $("#count").val(newcount);

                        }
                </script>