<!-- Start Content-->
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="<?=base_url()?>">
                                Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">
                                Customer
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            View Bill
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Customer Bill
                </h4>
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
                        </div>
                        <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a class="btn btn-danger mb-2 mr-2" href="<?=base_url('Sale/BillRetailer')?>" >
                                    <i class="mdi mdi-basket mr-1">
                                    </i>
                                    Add New Sale
                                </a>
                                 <button class="btn btn-secondary mb-2 mr-2" type="button">
                                     <i class="mdi mdi-file-export mr-1">
                                    </i>
                                    Export
                                </button> 
                            </div>
                        </div>
                        <!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table id="sale-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>S. No</th>
                                    <th>
                                        Order ID
                                    </th>
                                    <th>
                                        Customer Name
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Payment Status
                                    </th>
                                    <th>
                                        Total Quantity
                                    </th>
                                    <th>
                                       Outstanding
                                    </th>

                                    <th style="width: 125px;">
                                        Action
                                    </th>
                                    <th>
                                        Discount
                                    </th>
                                    <th>
                                        GST
                                    </th>
                                    <th>
                                       Total Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($all_bills as $key => $bill) {
                                ?>

                                <tr>
                                    <td><?=$key+1?></td>
                                    <td>
                                        <a class="text-body font-weight-bold">
                                            <?=$bill->bill_id?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-body font-weight-bold">
                                            <?php if(isset($bill->supplier_name)){ echo $bill->supplier_name; }?>
                                        </a>
                                    </td>
                                    <td>
                                        <?=date('d-m-Y', strtotime($bill->date))?>

                                    </td>
                                    <td>
                                        <h5>
                                            <?php //if($bill->outstanding==0){ 
                                                if($bill->pay_status==1){
                                            ?>
                                            <span class="badge badge-success-lighten">
                                                <i class="mdi mdi-coin">
                                                </i>
                                                Paid
                                            </span>
                                        <?php } else { ?>
                                            
                                            <span class="badge badge-danger-lighten">
                                                <i class="mdi mdi-coin">
                                                </i>
                                                Un-Paid
                                            </span>
                                           
                                           <?php }?>

                                        </h5>
                                    </td>
                                    <td>
                                        <?=$bill->totalqty?>
                                    </td>
                                    <td>
                                        <?=$bill->outstanding?>
                                    </td>

                                    <td>                                        
                                        <a class="action-icon" href="<?=base_url('Sale/Bill_detailsTwo')?>/<?=$bill->pur_id?>">
                                            <i class="mdi mdi-eye">
                                            </i>
                                        </a>
                                        <a class="action-icon" href="<?=base_url('Sale/Bill_EditTwo')?>/<?=$bill->pur_id?>">
                                            <!--<a class="action-icon" href="<?=base_url('Sale/Bill_Edit')?>/<?=$bill->pur_id?>">-->
                                            <i class="mdi mdi-square-edit-outline">
                                            </i>
                                        </a>
                                        <a class="action-icon" href="#" onclick="return Checkdel()">
                                            <i class="mdi mdi-delete">
                                            </i>
                                        </a>
                                    </td>
                                    <td>
                                      <?=$bill->discount?>  <?php
                                      if($bill->discount!=0){
                                       if($bill->dis_type=='percentage')
                                      { echo "%";}
                                      else
                                        {echo "Rs."; }
                                        }
                                         ?>
                                    </td>
                                    <td>
                                      <?=$bill->gstper?><?php
                                      if($bill->gstper!=0){
                                       if($bill->gsttype=='percentage')
                                      { echo "%";}
                                      else
                                        {echo "Rs."; }
                                        }
                                         ?>
                                    </td>
                                     <td> <a class="text-body font-weight-bold">
                                     <?=$bill->totalamt?>
                                     </a>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->

<script>
    function Checkdel()
    {
        return confirm("Are you sure delete this Record");
    }
</script>

<script>
$(document).ready(function() {
    $('#sale-datatable').DataTable( {
        dom: 'Bfrtip',
         buttons: [
            'copyHtml5',
            'csvHtml5',
            'pdfHtml5',
            
        ]
    } );
} );
</script>
