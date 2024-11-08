 <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Product</a></li>
                                            <li class="breadcrumb-item active">Stock</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Product Stock Report</h4>
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

                                            <!-- <div class="col-sm-8">
                                                <div class="text-sm-right">
                                                    <button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings"></i></button>
                                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                                </div>
                                            </div> -->
                                        </div>
                
                                        <div class="table-responsive">
                                            <table class="table dt-responsive nowrap w-100" id="allsale-datatable">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>S. No</th>
                                                        <th>Product</th>
                                                        <th>Category</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                        <th>HSN</th>
                                                        <th>GST</th>
                                                        <th>More Details</th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<?php
                                                	foreach ($Prolist as $key => $stock) {
                                                	    
                                                	    $itemid = $stock->item_id;
                                                		
                                                // 		$exp = $this->Product_M->getproductpurchasequantity($itemid);
                                                // 		print($exp);
                                                    //         $sql2 = "select sum(qty) as qty from `phppos_purchase_details` where item_id = '".$itemid."' ";
	 	                                                 //   $query2=$this->db->query($sql2);
	 	                                                 //   $exp = $query2->result();
	 	                                                 //   $qty = $exp['qty'];
                                                
                                                
                                                		
                                                	 ?>
                                                    <tr>
                                                        <td><?=$key+1?></td>
                                                        <td>
                                                            <?=$stock->name?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->category?>
                                                        </td>
                                                         <td>
                                                            <?=$stock->quantity?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->unit?>
                                                        </td>
                                                       

                                                        <td>
                                                           <?=$stock->hsn?>
                                                        </td>
                                                        <td>
                                                           <?=$stock->GST?>
                                                        </td>
                                                        <td>
                                                          <a href="<?=base_url('Product/ProductExpiryDetail')?>/<?=$stock->item_id?>"><button type="button" class="btn btn-success mb-2 mr-1"><i class="mdi mdi-settings">More Details</i></button></a> 
                                                        </td>
                                                        
                                                                                               
                    
                                                        
                                                    </tr>
                                                <?php } ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->        
                        
                    </div> <!-- container -->
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
