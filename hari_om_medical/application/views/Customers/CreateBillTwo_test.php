<!-- Start Content-->
<div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                                            <li class="breadcrumb-item active">Sale Entry</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customer Sale Entry</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                         <?=$this->session->flashdata('FlashMassage');?>

                        <div class="row">
                            <div class="col-12">
                              <form action="<?=base_url('Customers/create_billtwo')?>" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Input Types</h4> -->
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Invoice No:</label>
                                                                <input type="text" name="pur_id" value="<?=$billno?>" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill No:</label>
                                                                <input type="text" name="bill_id" value="BillNo-<?=$billno?>" class="form-control" readonly>
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
                                                                 <input type="text" class="form-control date"  name="bill_date"  value="<?=date('d-m-Y')?>" data-date-format="dd-mm-yyyy">
                                                            </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-9">
                                                      <div class="form-group" >
                                                          <label>Enter Product Name</label>
                                                          <input type="text" class="form-control typeahead" id="productdescrip"  placeholder="Enter Product Name">      
                                                      </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                      <div class="form-group" >
                                                          <br/>
                                                          <a   class="btn btn-info text-white" style="margin-top:3%;" onclick="Addtolist()" >Add product</a>
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
                                                               <th>MRP</th>
                                                               <th>Quantity</th>
                                                               <th>Amount</th>
                                                               <th>Remove</th>
                                                           </tr>
                                                           <!-- <tbody>
                                                              <tr id="rowid_1">
                                                                  <td>
                                                                    <input  name="pro_id[]" type="hidden"/>
                                                                      <input class="form-control" id="itemname_1" onkeyup="Searchpro(this.value)" type="text">
                                                                      </input>
                                                                  </td>
                                                                  <td>
                                                                      <input class="form-control" id="category_1" type="text">
                                                                      </input>
                                                                  </td>
                                                                  <td>
                                                                      <input class="form-control" id="simpleinput" type="text">
                                                                      </input>
                                                                  </td>
                                                                  <td>
                                                                      <input class="form-control" id="simpleinput" type="text">
                                                                      </input>
                                                                  </td>
                                                                  <td>
                                                                      <input class="form-control" id="simpleinput" type="text">
                                                                      </input>
                                                                  </td>
                                                                  <td>
                                                                      <a class="btn btn-danger text-white" onclick="deleterow(1)">
                                                                          <i class="uil-trash-alt">
                                                                          </i>
                                                                      </a>
                                                                  </td>
                                                              </tr>
                                                           </tbody> -->
                                                           <tbody id="addrow">

                                                           </tbody>
                                                           <!-- <tr>
                                                             <td colspan="7" align="right"><a  onclick="AddnewRow()" class="btn btn-success text-white"><i class="uil-plus-square"></i></a></td>
                                                           </tr> -->
                                                        </table>
                                                    </div>
                                                    <br/>
                                                    <hr/>
                                                    <br/>
                                                   
                                                        <div class="col-md-2">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Quantity :</label>
                                                                <input type="hidden" value="0" id="totalcount" class="form-control" readonly>
                                                                <input type="text" value="0" id="totalqty" name="totalqty" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Amount :</label>
                                                                <input type="text" id="totalamt" name="totalamt" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="mt-2">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio1" name="dis" value="1" onClick="calcAmtTwo()" class="dis custom-control-input" >
                                                                <label class="custom-control-label" for="radio1">%</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio2" name="dis" value="0" onClick="calcAmtTwo()" class="dis custom-control-input" checked>
                                                                <label class="custom-control-label" for="radio2">Rs</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Discount</label>
                                                                <input type="text" name="per" id="per" value="0" onKeyUp="calcAmtTwo()" class=" per form-control">
                                                                <input type="hidden" value="0" id="disamt" name="disamt">
                                                                <input type="hidden" value="0" name="addgst" id="addgst">
                                                                <input type="hidden" value="0" name="distype" id="distype">
                                                               <input type="hidden" name="gsttype" id="gsttype">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3 ">
                                                                <label for="simpleinput">Payable Amount </label>
                                                                <input type="text" name="payamt" id="payamt" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3 ">
                                                                <label for="simpleinput">Referred By:</label>
                                                                <select name="doc_id" id="Doctor" class="form-control" required>
                                                                  <option value="">Select Doctor</option>
                                                                  <?php
                                                                  foreach ($Doctors as $key => $doctor) {
                                                                  ?>
                                                                  <option value="<?=$doctor->person_id?>"><?=$doctor->first_name?> <?=$doctor->last_name?></option>
                                                                  <?php
                                                                }
                                                                  ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3 ">
                                                                <label for="simpleinput">Payment Mode:</label>
                                                                <select name="pay_mode" id="pay_mode" class="form-control" onchange="checkpaymode(this.value)" required>
                                                                  <option value="">Select Mode</option>
                                                                  <option value="cash">Cash</option>
                                                                  <option value="credit">Credit</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-3" style="display:none" id="careoff_credit">
                                                            <div class="form-group mb-3 ">
                                                                <label for="simpleinput">Payment Mode:</label>
                                                                <input type="text" class="form-control" name="careoff" id="careoff" >
                                                            </div>
                                                        </div>

                                                       
                                                    <!-- <div class="col-md-1">
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
                                                         
                                                </div> -->

                                               
                                            </div> <!-- end preview-->
                                            <div class="row">
                                                <div class="col-md-12 text-right">
                                                    <input type="Submit" class="btn btn-danger" value="Submit">
                                                </div>
                                            </div>
                                            <!-- end row-->
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
                        function checkpaymode(val){
                           if(val =="credit"){
                               
                               $("#careoff_credit").show();
                           }else{
                               
                               $("#careoff_credit").hide();
                           }
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
                AddtolistTwo(item.id)
                // console.log("selectDivision====="+item)
                return item;
            }
        });
                    </script>


