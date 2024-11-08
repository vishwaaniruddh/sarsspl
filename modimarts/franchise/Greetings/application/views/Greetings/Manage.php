 <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/tables/datatable/datatables.min.css">
    <!-- END: Vendor CSS-->
     
     
      <!-- BEGIN: Content-->
      <div class="app-content content">
         <div class="content-overlay">
         </div>
         <div class="content-wrapper">
            <div class="content-header row">
              <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">View Greetings</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?=base_url('Greetings/View')?>">Greetings</a>
                  </li>
                  <li class="breadcrumb-item active">View Greetings
                  </li>
                </ol>
              </div>
            </div>
          </div>
            </div>
            <div class="content-body"><!-- Zero configuration table -->
          <section id="configuration">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">List Of Promotion Images</h4>
                              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                              <div class="heading-elements">
                                  <ul class="list-inline mb-0">
                                      <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                      <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body card-dashboard">
                                  <div class="table-responsive">
                                      <table class="table table-striped table-bordered zero-configuration">
                                          <thead>
                                              <tr>
                                                  <th>S. No</th>
                                                  <th>Name</th>
                                                  <th>View</th>                                     
                                              </tr>
                                          </thead>
                                          <tbody>
                                          	<?php 
                                          	foreach ($promotion as $key => $value) {
                                          	 	?>
                                              <tr>
                                              	<td><?=$key+1?></td>                 
                                              	<td><?=$value->promotions?></td>                 
                                              	<td><a href="<?=base_url('Greeting/View')?>/<?=$value->id?>" class="btn btn-success">View</a></td>                  
                                              </tr>
                                              <?php 
                                               }
                                               ?>
                                          </tbody>
                                          
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
        </div>
         </div>
      </div>
       <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/tables/datatables/datatable-basic.min.js"></script>
    <!-- END: Page JS-->
      
