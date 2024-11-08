<!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Supplier</a></li>
                                            <li class="breadcrumb-item active">Bill Entry</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Supplier Bill Entry</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                         <?=$this->session->flashdata('FlashMassage');?>

                        <div class="row">
                            <div class="col-12">
                              <form action="<?=base_url('Supplier/create_bill')?>" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Input Types</h4> -->
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Reference No:</label>
                                                                <input type="text" name="pur_id" value="<?=$billno?>" class="form-control" >
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Supplier Reference No:</label>
                                                                <input type="text" name="bill_id" value="ORDNO-<?=$billno?>" class="form-control" >
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">   Supplier Name:</label>
                                                                <select name="supp_id" id="supplier" class="form-control" required>
                                                                  <option value="">Select Supplier</option>
                                                                  <?php
                                                                  foreach ($supplier as $key => $value) {
                                                                  ?>
                                                                  <option value="<?=$value->person_id?>"><?=$value->company_name?></option>
                                                                  <?php
                                                                }
                                                                  ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill Date :</label>
                                                                 <input type="text" class="form-control date" value="<?=date('d-m-Y')?>"  name="bill_date" data-single-date-picker="true" data-date-format="dd-mm-yyyy">
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
                                                               <th>Item Description<span class="text-danger">*</span></th>
                                                               <th>Batch No<span class="text-danger">*</span></th>
                                                               <th>Expiry Date<span class="text-danger">*</span></th>
                                                               <th>MRP<span class="text-danger">*</span></th>
                                                               <th>Rate<span class="text-danger">*</span></th>
                                                               <th>Quantity<span class="text-danger">*</span></th>
                                                               <th>Scheme Quantity</th>
                                                               <th>GST(%)</th>
                                                               <th>Amount</th>
                                                               <th>Discount</th>
                                                               <th>Action</th>
                                                           </tr>
                                                          
                                                           <tbody id="addrow">

                                                           </tbody>
                                                          
                                                        </table>
                                                    </div>
                                                    <br/>
                                                    <hr/>
                                                    <br/>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Quantity :</label>
                                                                <input type="hidden" value="0" id="totalcount" class="form-control" readonly>
                                                                <input type="text" value="0" id="totalqty" name="totalqty" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Amount :</label>
                                                                <input type="text" id="totalamt" name="totalamt" class="form-control" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <div class="form-group mb-3 ">
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
            updater: function(item) { debugger;
                Addtolist(item.id)
                console.log("selectDivision====="+item.id)
                return item;
            }
        });
                    </script>


