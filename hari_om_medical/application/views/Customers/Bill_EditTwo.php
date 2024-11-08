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
                                            <li class="breadcrumb-item active">Edit Sale</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Customer Bill Edit</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                         <?=$this->session->flashdata('FlashMassage');?>

                        <div class="row">
                            <div class="col-12">
                              <form action="<?=base_url('Sale/Bill_Edit/'.$bills_data->pur_id)?>" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Input Types</h4> -->
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Invoice No:</label>
                                                                <input type="text" value="<?=$bills_data->pur_id?>" name="pur_id" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill No:</label>
                                                                <input type="text" name="bill_id" value="<?=$bills_data->bill_id?>" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Customer Name:</label>
                                                                <select name="cust_id" id="supplier" class="form-control" required>
                                                                  <option value="">Select Customer</option>
                                                                  <?php
                                                                  foreach ($supplier as $key => $value) {
                                                                  ?>
                                                                  <option value="<?=$value->person_id?>" <?php if($value->person_id==$bills_data->cust_id){ echo "selected";} ?>><?=$value->first_name." ".$value->last_name?></option>
                                                                  <?php
                                                                }
                                                                  ?>
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Bill Date :</label>
                                                                 <input type="text" class="form-control date" id="birthdatepicker" name="bill_date"  
                                                                 value="<?=date("d-m-Y",strtotime($bills_data->date))?>" 
                                                                 data-single-date-picker="true" data-date-format="dd-mm-yyyy">
                                                            </div>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="col-md-12 table-responsive">
                                                      <input type="hidden" name="rowcount" id="rowcount" value="1">
                                                        <table class="table">
                                                           <tr>
                                                               <th>Item Description</th>
                                                               <th>HSN/SAC</th>
                                                               <th>Rate</th>
                                                               <th>Quantity</th>
                                                               <th>Amount</th>
                                                                <th>Remove</th> 
                                                           </tr>

                                                           <!-- loop	 -->

                                                           <?php 
                                                           // var_dump($bills_data);
                                                           foreach ($getbill_product as $key => $product) {
                                                           	// var_dump($product);
                                                           	
                                                           ?>
                                                           <tr id="rowid_<?=$key+1?>">
															    <td>
															        <input id="item_no<?=$key+1?>" name="item_no[]" type="hidden" value="<?=$product->item_number?>"/>
															        <input name="item_cat[]" type="hidden" value="<?=$product->category?>"/>
															        <input  name="myitemid[]"  type="hidden" value="<?=$product->item_id?>"/>
															        <input class="form-control" id="itemname_<?=$key+1?>" name="itemname[]" readonly="" type="text" value="<?=$product->name?>"/>
															    </td>
															    <td>
															        <input class="form-control" name="hsn[]" value="<?=$product->item_id?>" type="text"/>
															    </td>
															    <td>
															        <input class="form-control cprice" id="cprice<?=$key+1?>" name="cprice[]" onkeyup="subtotalNew()" type="text" value="<?=$product->price?>"/>
															    </td>
															    <td>
															        <input class="form-control qty" id="qty<?=$key+1?>" name="qty[]" onkeyup="subtotalNew()" value="<?=$product->qty?>" type="text"/>
															    </td>
															    <td>
															        <input readonly class="form-control subtotal" id="subtotal<?=$key+1?>" name="totalamt" onkeyup="subtotalNew()" value="<?=$product->qty*$product->price?>" type="text"/>
															    </td>
															    <td>
															        <a class="btn btn-danger text-white" onclick="deleterow(<?=$key+1?>)">
															            <i class="uil-trash-alt">
															            </i>
															        </a>
															    </td>
															</tr>

														<?php } ?>

                                                           <!-- end loop -->
                                                          
                                                        </table>
                                                    </div>
                                                    <br/>
                                                    <hr/>
                                                    <br/>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Quantity :</label>
                                                                <input type="hidden" value="<?=$bills_data->totalqty?>" id="totalcount" class="form-control" readonly>
                                                                <input type="text" value="<?=$bills_data->totalqty?>" id="totalqty" name="totalqty" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Total Amount :</label>
                                                                <input type="text" id="totalamt" name="totalamt" value="<?=$bills_data->totalamt?>" class="form-control" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <div class="mt-2">
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio1" name="dis" value="1" onClick="calcAmt()" class="dis custom-control-input" <?php if($bills_data->dis_type=='percentage'){ echo "checked"; }?>>
                                                                <label class="custom-control-label" for="radio1">%</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="radio2" name="dis" value="0" onClick="calcAmt()" class="dis custom-control-input" <?php if($bills_data->dis_type=='Rupees'){ echo "checked"; }?>>
                                                                <label class="custom-control-label" for="radio2">Rs</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">Discount</label>
                                                                <input type="text" name="per" id="per" value="<?=$bills_data->discount?>" onKeyUp="calcAmt()" class=" per form-control">
                                                                <input type="hidden" value="<?=$bills_data->disamt?>" id="disamt" name="disamt">
                                                                <input type="hidden" value="<?=$bills_data->addgst?>" name="addgst" id="addgst">
                                                                <input type="hidden" value="<?=$bills_data->dis_type?>" name="distype" id="distype">
                                                               <input type="hidden" value="<?=$bills_data->gsttype?>" name="gsttype" id="gsttype">
                                                            </div>
                                                        </div>

                                                    <div class="col-md-1">
                                                            <div class="mt-2">
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="Radio3" name="gst" value="0" onClick="calcAmtgst()" class="gst custom-control-input" <?php if($bills_data->gsttype=='percentage'){ echo "checked"; }?>>
                                                                    <label class="custom-control-label" onClick="calcAmtgst()" for="Radio3">%</label>
                                                                </div>
                                                                <div class="custom-control custom-radio custom-control-inline">
                                                                    <input type="radio" id="Radio4" value="1" name="gst" onClick="calcAmtgst()" class=" gst custom-control-input" <?php if($bills_data->gsttype=='Rupees'){ echo "checked"; }?>>
                                                                    <label class="custom-control-label" onClick="calcAmtgst()" for="Radio4">Rs</label>
                                                                </div>
                                                            </div>
                                                       </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label for="simpleinput">GST </label>
                                                                <input type="text" id="gstper" name="gstper" value="<?=$bills_data->gstper?>" onkeyup="calcAmtgst()" class=" gstper form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group mb-3 offset-md-4">
                                                                <label for="simpleinput">Payable Amount </label>
                                                                <input type="text" name="payamt" id="payamt" value="<?=$bills_data->payamt?>" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                                <label for="simpleinput">Paid/Unpaid</label>
                                                                <select name="pay_status" class="form-control">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Paid</option>
                                                                    <option value="0">UnPaid</option>
                                                                </select>
                                                            </div>
                                                    </div>

                                                    <div class="col-md-9 text-right">
                                                        <input type="Submit" name="updtbtn" class="btn btn-danger" value="Update">
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


