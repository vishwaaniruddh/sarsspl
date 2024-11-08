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
        <div class="content-body">
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
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body card-dashboard">
                                  <p class="card-text">List Of provided Template</p>
                                  <div class="table-responsive">
                                      <table class="table table-striped table-bordered zero-configuration">
                                          <thead>
                                              <tr>
                                                  <th>S. No</th>
                                                  <th>Name</th>
                                                  <th>View</th>                                     
                                                  <th>Download</th>                                     
                                              </tr>
                                          </thead>
                                          <tbody>
                                          	<?php 
                                            foreach ($allpromo as $key => $pro) {
                                            //   $encturl=urlencode($this->encrypt->encode($pro->id));
                                              $encturl=$pro->id;
                                               ?>
                                               <tr>
                                                 <td><?=$key+1?></td>
                                                 <td><p ><?=$pro->promotions?></p></td>
                                                 <td><a href="#" class="btn btn-link" data-toggle="modal" data-target="#iconModal" data-heading="" onclick="SetImg('<?=$pro->image?>')" ><?=$pro->laung?></a></td>
                                                 <td>
                                                     <!--<a href="<?=base_url('Greetings/Download/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Download</a>-->
                                                 <!-- Example single danger button -->
                                                    <div class="btn-group">
                                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Download
                                                      </button>
                                                      <div class="dropdown-menu">
                                                          
                                                      <!--Franchisee-->
                                                        <?php if($userdata->is_franchisee==1){ ?>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download10/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Full Footer Image</a>
                                                                 <?php }
                                                                //  Paid Customer
                                                                 if($userdata->is_franchisee==2){ ?>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download6/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Full Footer Image</a>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download8/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Download With Advt Image And Name</a>
                                                          <?php } 
                                                        //   Free Customer
                                                            if($userdata->is_franchisee==0){
                                                          ?>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download9/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Download Image with Advt and Name</a>
                                                      <?php }
                                                      // Staff
                                                      if($userdata->is_franchisee==4){
                                                        ?>
                                                      <a class="dropdown-item" href="<?=base_url('Greetings/Download9/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Download Image with Advt and Name</a>
                                                    <?php }?>
                                                    </div>
                                                    </td>
                                                
                                               </tr>
                                               <?php
                                             } ?>
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


      
                 

                  <!-- Modal -->
                  <div class="modal fade text-left" id="iconModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
                   aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2"><i class="la la-road2"></i>Show Greetings</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h5><i class="la la-arrow-right"></i> Greeting Image</h5>
                          
                          
                         <img src="" id="promoimg" alt="" style="width: 100%;">
                         <div id="loader_img" style="text-align: center;" >
                           <img src="<?=base_url('assets/images/load.gif')?>" alt=""><br/>
                           Loading...
                         </div>
                         
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                    </div>
                  </div>


                  <script>
      function SetImg(img)
      {

        // show loading image
        $('#loader_img').show();

        $("#promoimg").attr("src", img);
        // alert(img);
        // $(this).data("id")

        

        // main image loaded ?
        $('#promoimg').on('load', function(){
          // hide/remove the loading image
          $('#loader_img').hide();
        });

      }
    </script>
                
       <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/tables/datatables/datatable-basic.min.js"></script>
    <!-- END: Page JS-->

    
      
