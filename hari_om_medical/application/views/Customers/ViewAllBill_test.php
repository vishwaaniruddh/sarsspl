<!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Sale/View_Bill')?>">Bill</a></li>
                                            <li class="breadcrumb-item active">Bill Payment</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Bill Payment</h4>
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
                                        <div class="row mb-2">
                                            <!-- <div class="col-lg-12"> -->
                                                <div class="col-md-3">
                                                    <div class="form-group mb-2">
                                                        <label for="cust_id">Select Customer</label>
                                                        <select name="cust_id" id="cust_id" class="form-control" required>
                                                                  <option value="">Select Customer</option>
                                                                  <option value="All">All</option>
                                                                  <?php
                                                                  foreach ($Customers as $key => $value) {
                                                                      
                                                                      $person_id = $value->person_id;
                                                                      $first_name = $value->first_name;
                                                                      $last_name = $value->last_name;
                                                                  ?>
                                                                  <option value="<?=$person_id?>"><?=$first_name?> <?=$last_name?></option>
                                                                  <?php
                                                                }
                                                                  ?>
                                                                </select>
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-4">-->
                                                <!--     <div class="form-group mx-sm-3 mb-2">-->
                                                        <!-- <div class="form-group"> -->
                                                            <!-- <label>Predefined Date Ranges</label> -->
                                                <!--            <div id="reportrange" class="form-control" data-toggle="date-picker-range" data-date-format="dd/mm/yyyy" data-target-display="#selectedValue"  data-cancel-class="btn-light">-->
                                                <!--                <i class="mdi mdi-calendar"></i>&nbsp;-->
                                                <!--                <span id="selectedValue"></span> <i class="mdi mdi-menu-down"></i>-->
                                                <!--                    <input type="hidden" id="start" name="start">-->
                                                <!--                    <input type="hidden" id="end" name="end">-->
                                                <!--            </div>-->
                                                            <!--<input type="hidden" id="start" name="start">-->
                                                            <!--<input type="hidden" id="end" name="end">-->
                                                        <!-- </div> -->

                                                <!--    </div>-->
                                                <!--</div>-->
                                                <div class="col-md-3">
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="startDate">Start Date:</label>
                                                        <input type="date" class="form-control" id="startDate" name="start">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <label for="endDate">End Date:</label>
                                                        <input type="date" class="form-control" id="endDate" name="end">
                                                    </div>
                                                </div>

                                                    
                                                   <div class="col-md-3">
                                                       
                                                    <div class="form-group mx-sm-3 mb-2">
                                                        <div class="form-group">
                                                             <label>Bill Type</label> 
                                                           <select name="cust_id" id="bill_type" class="form-control" required>
                                                                  <option value=""> Select Bill Type</option>
                                                                  <option value="0" selected>Un-Paid</option>
                                                                  <option value="1">Paid</option>
                                                                  <!--<option value="2">Both</option>-->
                                                                </select>
                                                        </div>

                                                    </div>
                                                   </div>
                                                <button type="submit" id="getdata" onclick="GetBillDeatils()" class="btn btn-info mb-2">Search</button> 
                                                   
                          
                                            </div>
                                            
                                        <!-- </div> -->
                                         <form id="purchse" action="<?=base_url('Sale/PayAmount')?>" method="post" onSubmit="return details();">
                                        <div id="billdetails"></div>
                                        </form>
                
                                       
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row --> 
                        
                    </div> <!-- container -->


     <script type="text/javascript">
                    $(function() {

                        var start = moment().subtract(29, 'days').startOf('day');
                        var end = moment().startOf('day');
                        

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
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                   
                }



            }, cb);

            cb(start, end);

           
        });
</script> 

<script>
    // function GetBillDeatils()
    // { 
    //     debugger;
    //     var cust_id = $("#cust_id").val();
    //     var start = $("#fromdate").val();
    //     var end = $("#todate").val();
    //     var bill_type = $("#bill_type").val();
    //     console.log(start);
        
    //     if(cust_id!='' && bill_type!=''){

    //     var myKeyVals = { cust_id :cust_id,start:start,end:end,bill_type:bill_type}

    //     $.ajax({
    //                       type: 'POST',
    //                       url: "<?=base_url()?>Sale/Getbillsajex_test",
    //                       data: myKeyVals,
    //                       success: function(resultData) { 
    //                           debugger;
    //                         // alert(resultData);
    //                         $("#billdetails").html(resultData); 
    //                         console.log(resultData); 
    //                       }
    //                 });
    // }

    // }
    

    $(function () {

        function GetBillDeatils() {
            
            debugger;
            var cust_id = $("#cust_id").val();
            var start = $("#startDate").val();
            var end = $("#endDate").val();
            var bill_type = $("#bill_type").val();

            if (cust_id != '' && bill_type != '' && start != '' && end != '') {
                var myKeyVals = {
                    cust_id: cust_id,
                    start: start,
                    end: end,
                    bill_type: bill_type
                };

                $.ajax({
                    type: 'POST',
                    url: "<?= base_url() ?>Sale/Getbillsajex_test",
                    data: myKeyVals,
                    success: function (resultData) {
                        $("#billdetails").html(resultData);
                        console.log(resultData);
                    }
                });
            }
        }

        $("#getdata").click(function () {
            GetBillDeatils();
        });
    });


</script>

<script>
    function total()
{
    var payment = document.getElementsByClassName('payment');
     var ttl=document.getElementsByClassName('ttl');
    
     var sumamt=0;
     for(i=0;i<ttl.length;i++)
     {//alert("hii1");
     //alert(ttl[i]);
        if(payment[i].checked)
        {   sumamt=sumamt+parseFloat(ttl[i].value);
            //alert("hii"+sumamt);  
        }    
    }
        document.getElementById('payamt').value=sumamt;
        if(sumamt>0)
        document.getElementById('paybtn').disabled=false;
        else
        document.getElementById('paybtn').disabled=true;
        //document.getElementById('totalqty').value=sumqty;*/
}
</script>
