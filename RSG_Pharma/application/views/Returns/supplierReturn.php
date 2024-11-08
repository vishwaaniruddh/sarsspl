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
                                Supplier
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            View Bill
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">
                    Supplier Bill
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
                    <!-- <div class="row mb-2"> -->
                        <!-- <div class="col-lg-8"> -->
                            <!-- <form class="form-inline">
                                <div class="form-group mb-2">
                                    <label class="sr-only" for="inputPassword2">
                                        Search
                                    </label>
                                    <input class="form-control" id="inputPassword2" placeholder="Search..." type="search">
                                    </input>
                                </div>
                                <div class="form-group mx-sm-3 mb-2">
                                    <label class="mr-2" for="status-select">
                                        Status
                                    </label>
                                    <select class="custom-select" id="status-select">
                                        <option selected="">
                                            Choose...
                                        </option>
                                        <option value="1">
                                            Paid
                                        </option>
                                        <option value="2">
                                            Awaiting Authorization
                                        </option>
                                        <option value="3">
                                            Payment failed
                                        </option>
                                        <option value="4">
                                            Cash On Delivery
                                        </option>
                                        <option value="5">
                                            Fulfilled
                                        </option>
                                        <option value="6">
                                            Unfulfilled
                                        </option>
                                    </select>
                                </div>
                            </form> -->
                        <!-- </div> -->
                        <!-- <div class="col-lg-4">
                            <div class="text-lg-right">
                                <a class="btn btn-danger mb-2 mr-2" href="<?=base_url('Supplier/Bill_entry')?>" >
                                    <i class="mdi mdi-basket mr-1">
                                    </i>
                                    Add New Order
                                </a>
                              <button class="btn btn-light mb-2" type="button">
                                    Export
                                </button> 
                            </div>
                        </div> -->
                        <!-- end col-->
                    <!-- </div> -->
                    <div class="table-responsive">
                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                            <thead class="thead-light">
                                <tr>
                                    <th>
                                        S. No
                                    </th>
                                    <th>
                                        Order ID
                                    </th>
                                    <th>
                                        Supplier Name
                                    </th>
                                    <th>
                                        Date
                                    </th>                                   
                                    <th>
                                       Total Amount
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                foreach ($all_bills as $key => $bill) {
                                ?>


                                <tr>
                                    <td>
                                        <?=$key+1?>
                                    </td>
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
                                   
                                    
                                     <td> <a class="text-body font-weight-bold">
                                     <?=$bill->totalamt?>
                                     </a>
                                    </td>
                                    <td><a href="<?=base_url('Return/ProductSupplier')?>/<?=$bill->pur_id?>" class="btn btn-danger btn-sm">Return</a></td>
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
