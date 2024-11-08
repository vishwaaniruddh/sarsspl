 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="<?=base_url('Product/Manage')?>">Product</a></li>
                                            <li class="breadcrumb-item active">Add</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Product List as per Itemid</h4>
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
                                        <?php  
                                            $itemid = $product->item_id;
                                            $name = $product->name;
                                            $category = $product->category;
                                            $supp_id = $product->supplier_id;
                                            $supp_name = '';
                                            
                                            if($supp_id!='') {
                                                $y = $this->Product_M->getcompanyname($product->supplier_id);
                                                $supp_name = substr($y[0]->company_name,0);
                                            }
                                        ?>
                                        
                                        <h4 class="header-title">Supplier Name : <?=$supp_name?></h4>
                                        <h4 class="header-title">Product Name : <?=$name?></h4>
                                        <h4 class="header-title">Product Category : <?=$category?></h4> <br>

                                        
                                        <div class="table-responsive">
                                            <table class="table dt-responsive nowrap w-100" id="allsale-datatable">
                                                
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Serial No</th>
                                                    <th>HSN</th>
                                                    <th>Batch No</th>
                                                    <th>GST</th>
                                                    <th>Quantity</th>
                                                    <th>Expiry</th>
                                                    <th>Rate</th>
                                                    <th>Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    foreach($PurchaseDetails as $key => $purchaseprod){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?=$key+1?>
                                                    </td>
                                                        <td><?=$purchaseprod->hsn?></td>
                                                    <td>
                                                        <?=$purchaseprod->batch_no?>
                                                    </td>
                                                    <td>
                                                        <?=$purchaseprod->gst." %"?>
                                                    </td>
                                                    <td>
                                                        <?=$purchaseprod->qty?>
                                                    </td>
                                                    <td>
                                                        <h5> <?=date('m/y',strtotime($purchaseprod->expiry_date))?></h5>
                                                    </td>
                                                    <td>
                                                        <h5> <?=$purchaseprod->rate?></h5>
                                                    </td>
                                                    <td>
                                                        <h5> <?=$purchaseprod->price?> </h5>
                                                    </td>
                                                </tr>
                                                <?php
                                                }?>
                                                
                                                
                                                </tbody>
                                            </table>
                                        </div>

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->
                
<!-- Add this script to the HTML file -->
<script>
$(document).ready(function() {
    $('#allsale-datatable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copyHtml5',
    // 'csvHtml5',
    {
    extend: 'csvHtml5',
    text: 'Export CSV',
    filename: 'View All Sale Bill', // Set your custom filename here
    
    },
    'pdfHtml5',
    
    ]
    } );
} );
</script>
