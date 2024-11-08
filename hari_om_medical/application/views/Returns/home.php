<style>
    ul .typeahead
    {
        width: 95%;
    }
</style>
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
                                            <li class="breadcrumb-item active">Bill Entry</li>
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
                              <form action="<?=base_url('Customers/create_bill')?>" method="post">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <h4 class="header-title">Input Types</h4> -->
                                            <div class="tab-pane show active" id="input-types-preview">
                                                
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <h4>Customer Return</h4>
                                                      <div class="form-group" >
                                                          <label>Enter Invoice No</label>
                                                          <input type="text" class="form-control typeahead" id="invoiceno"  placeholder="Enter Enter Invoice No">      
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>Supplier Return List</h4>
                                                      <div class="form-group" >
                                                          <label>Enter Supplier Name</label>
                                                          <input type="text" class="form-control typeahead" id="Suppliername"  placeholder="Enter Supplier Name">      
                                                      </div>
                                                    </div>
                                                  </div>
                                                  

                                                <!-- <div class="row">

                                                    <div class="col-md-12 text-right">
                                                        <input type="Submit" class="btn btn-danger" value="Submit">
                                                    </div>
                                                </div> -->
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
         
               // get invoice details
               $("#invoiceno").typeahead({
                 source: function (query, result) {
                $.ajax({
                    url: '<?=base_url()?>/Return/getInvoice',
                    data: 'invoiceno=' + query,
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
                var item_id=item.id;
                var url="<?=base_url('Return/InvoiceReturn')?>/"+item_id;
                window.location.replace(url);
                
            }
        });

         // get invoice details
                       $("#Suppliername").typeahead({
                         source: function (query, result) {
                        $.ajax({
                            url: '<?=base_url()?>/Return/getsupplier',
                            data: 'supp_name=' + query,
                            dataType: "json",
                            type: "POST",
                            success: function (data) {
                                
                                console.log(data);
                                result($.map(data, function (item) {
                                    return item;
                                }));
                            }
                        });
                    },
                    updater: function(item) {
                        // Addtolist1(item.id)
                        var item_id=item.id;
                        var url="<?=base_url('Return/supplierReturn')?>/"+item_id;
                        window.location.href = url;
                        
                        console.log("selectDivision====="+item)
                        return item;
                    }
                });


                    </script>


