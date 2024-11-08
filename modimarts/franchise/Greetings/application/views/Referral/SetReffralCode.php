 <!-- BEGIN: Vendor CSS-->
    <!-- END: Vendor CSS-->
      <!-- BEGIN: Content-->
      <div class="app-content content">
         <div class="content-overlay">
         </div>
         <div class="content-wrapper">
            <div class="content-header row">
              <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Referral Program</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?=base_url('Referral')?>">Referral</a>
                  </li>
                  <li class="breadcrumb-item active">Create Referral Link
                  </li>
                </ol>
              </div>
            </div>
          </div>
            </div>
            <div class="content-body"><!-- Zero configuration table -->
          <section id="configuration">
              <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card" >
                <?php if(isset($Refdata->id)){ ?>
                <div class="card-header">
                    <h4 class="card-title">Copy Referral Code</h4>
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12 form-group mb-5">
                               <fieldset>
                                <label>Copy Referral Code For Register Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="p1"  value="https://allmart.world/franchise/Greetings/User/Register?refcode=<?=$Refdata->code?>" placeholder="Button on right">
                            <div class="input-group-append">
                                <button class="btn btn-primary bg-info border-info" data-toggle="tooltip" data-placement="top" onclick="copyToClipboard('p1')"  data-original-title="Click to Copy Code" id="p1t" type="button"><i class="la la-clipboard"></i></button>
                            </div>
                          
                           
                        </div>
                    </fieldset>
                        </div>
                        <div class="col-md-12 form-group">
                             <fieldset>
                                <lable>Copy Referral Code For Register Franchise</lable>
                        <div class="input-group">
                            <input type="text" class="form-control" id="p2"  value="https://allmart.world/franchise/Greetings/Register/RegisterFranchise?refcode=<?=$Refdata->code?>" placeholder="Button on right">
                            <div class="input-group-append">
                                <button class="btn btn-primary bg-info border-info" data-toggle="tooltip" data-placement="top" onclick="copyToClipboard('p2')"  data-original-title="Click to Copy Code" id="p2t" type="button"><i class="la la-clipboard"></i></button>
                            </div>
                          
                           
                        </div>
                    </fieldset>
                        </div>
                    </div>
                 
                   

                </div>
            <?php }else{ ?>
                <div class="card-header">
                    <h4 class="card-title">Create Referral Code</h4>
                </div>
                <div class="card-body text-center">


                          
                            <a href='<?=base_url('CreateReferralCode')?>' class="btn btn-info" >Create Referral Code</a>
                        <!-- </div>
                    </fieldset> -->

                </div>
            <?php } ?>
            </div>
        </div>
              </div>
          </section>

          <section id="configuration">
              <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card" >
                        <div class="card-header">
                            <h4 class="card-title">Show Details</h4>
                        </div>
                        <div class="card-body ">
                            <table class="table ">
                            <thead></thead> 
                                <th>Sno.</th>
                                <th>Customer</th> 
                                <th>Mobile</th> 
                                <tbody>
                                    <?php 
                                    $User_Id = $this->session->LoggedUserId;
                                    $getdata=$this->db->query("SELECT * FROM `greetings_referral_code` Where user_id='".$User_Id."'");
                                    $dataresult=$getdata->row();
                                  $refcode=$dataresult->code;

                                    $getrefdata=$this->db->query("SELECT * FROM `customer_promotion` where refcode='".$refcode."' AND refcode<>''");
                                    $refdataresult=$getrefdata->result();
                                   foreach ($refdataresult as $key => $value) {
                                      
                                     ?>
                                        <tr> 
                                            <td> <?=$key+1?></td>
                                            <td><?=$value->customer_name?></td>
                                            <td><?=$value->mobile_number?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>    
                            </table>    
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
      
<script>
    function copyToClipboard(element) {

  
  var copyText = document.getElementById(element);
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  // alert("Copied the text: " + copyText.value);

}
</script>