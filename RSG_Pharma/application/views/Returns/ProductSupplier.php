<!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Return</a></li>
                                            <li class="breadcrumb-item active">Entry</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customer Return Entry</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                         <?=$this->session->flashdata('FlashMassage');?>

                        <div class="row">
                            <div class="col-12">
                              <!-- <form action="<?=base_url('Customers/create_bill')?>" method="post"> -->
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Input Types</h4> -->
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Invoice No:</label>
                                                                <input type="text" name="pur_id" value="<?=$bills_data->pur_id?>" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill No:</label>
                                                                <input type="text" name="bill_id" value="BillNo-<?=$bills_data->pur_id?>" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Customer Name:</label>
                                                                <select name="cust_id" id="Customer" class="form-control" required>
                                                                  <option value="">Select Customer</option>
                                                                  <?php
                                                                  foreach ($Customers as $key => $value) {
                                                                  ?>
                                                                  <option value="<?=$value->person_id?>"><?=$value->first_name?> <?=$value->last_name?></option>
                                                                  <?php
                                                                }
                                                                  ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill Date :</label>
                                                                 <input type="text" class="form-control date"  name="bill_date" value="<?=$bills_data->date?>"  data-date-format="dd-mm-yyyy">
                                                            </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-12 table-responsive">
                                                      <input type="hidden" name="rowcount" id="rowcount" value="1">
                                                        <table class="table">
                                                           <tr>
                                                               <th>Item Description</th>
                                                               <th>Batch No</th>
                                                               <th>Expiry Date</th>
                                                               <th>Rate</th>
                                                               <th>Quantity</th>
                                                               <th>Amount</th>
                                                               <th>Remove</th>
                                                           </tr>
                                                           <tbody id="addrow">

                                                           </tbody>
                                                        </table>
                                                    </div>
                                                    <br/>
                                                    <hr/>
                                                    <br/>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Quantity :</label>
                                                                <input type="hidden" value="0" id="totalcount" class="form-control" readonly>
                                                                <input type="text" value="<?=$bills_data->totalqty?>" id="totalqty" name="totalqty" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Amount :</label>
                                                                <input type="text" id="totalamt" value="<?=$bills_data->payamt?>" name="totalamt" class="form-control" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="mt-2">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio1" name="dis" value="1" onClick="calcAmt()" class="dis custom-control-input" checked>
                                                                <label class="custom-control-label" for="radio1">%</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio2" name="dis" value="0" onClick="calcAmt()" class="dis custom-control-input">
                                                                <label class="custom-control-label" for="radio2">Rs</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Discount</label>
                                                                <input type="text" name="per" id="per" value="0" onKeyUp="calcAmt()" class=" per form-control">
                                                                <input type="hidden" value="0" id="disamt" name="disamt">
                                                                <input type="hidden" value="0" name="addgst" id="addgst">
                                                                <input type="hidden" value="0" name="distype" id="distype">
                                                               <input type="hidden" name="gsttype" id="gsttype">
                                                            </div>
                                                        </div>

                                                    <div class="col-md-1">
                                                            <div class="mt-2">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="Radio3" name="gst" value="0" onClick="calcAmtgst()" class="gst custom-control-input" checked>
                                                                    <label class="custom-control-label" onClick="calcAmtgst()" for="Radio3">%</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="Radio4" value="1" name="gst" onClick="calcAmtgst()" class=" gst custom-control-input">
                                                                    <label class="custom-control-label" onClick="calcAmtgst()" for="Radio4">Rs</label>
                                                                </div>
                                                            </div>
                                                       </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">GST </label>
                                                                <input type="text" id="gstper" name="gstper" value="0" onkeyup="calcAmtgst()" class=" gstper form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group mb-3 offset-md-4">
                                                                <label for="simpleinput">Payable Amount </label>
                                                                <input type="text" name="payamt" id="payamt" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-12 text-right">
                                                        <input type="Submit" class="btn btn-danger" value="Submit">
                                                    </div>
                                                </div>
                                                <!-- end row-->
                                            </div> <!-- end preview-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                              </form>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->
                    </div>

                    <script>
                      function deleterow(rowid)
                      {

                    var totalcount=$("#totalcount").val();
                      totalcount= parseInt(totalcount)-1;
                       $("#totalcount").val(totalcount);
                        $("#rowid_"+rowid).remove();
                        subtotal();

                      }
                    </script>

             <script>
              

               $("#productdescrip").typeahead({
                 source: function (query, result) {
                $.ajax({
                    url: '<?=base_url()?>/Account/productsearch',
                    data: 'proname=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            },
            updater: function(item) {
                Addtolist1(item.id)
                // console.log("selectDivision====="+item)
                return item;
            }
        });
                    </script>


