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
                                  </ul>
                              </div>
                          </div>
                          <div class="card-content collapse show">
                              <div class="card-body card-dashboard">
                                  <p class="card-text">List Of provided Template</p>
                                    <?php
                                     if(($userData->select_types!=='')  && ($userData->select_types!==NULL))
                                     { $selectdata=json_decode($userData->select_types);
                                      $selectdata1 = implode(',', $selectdata);; $selected="checked";
                                     }
                                     else
                                     {
                                      $selectdata1="";
                                     }
                                     
                                   
                                    ?>
                                  <div class="dropdown text-right m-2">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ft ft-download"></i> Download All
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                      
                                       <!-- <a class="dropdown-item" href="<?=base_url()?>/Greetings/MultiView/1"  target="_blank"><i class="ft ft-download"></i> Template 1</a>
                                                        <a class="dropdown-item" href="<?=base_url()?>/Greetings/MultiView/1" target="_blank"><i class="ft ft-download"></i> Template 2</a>
                                                        <a class="dropdown-item" href="<?=base_url()?>/Greetings/MultiView/2" target="_blank"><i class="ft ft-download"></i> Template 3</a>
                                                        <a class="dropdown-item" href="<?=base_url()?>/Greetings/MultiView/4" target="_blank"><i class="ft ft-download"></i> Template 4</a> -->
                                                                                                              <!--Franchisee-->
                                                       <?php if($userData->is_franchisee == '1'){ ?>
                                                       <form action="<?=base_url()?>/Greetings/MultiView/8" method="post" target="_blank">
                                                       <input type="hidden" name="promo" id="pro1" value="<?=$selectdata1?>">
                                                          <a class="dropdown-item"  onclick="$(this).closest('form').submit();" ><i class="ft ft-download"></i> Download With Footer Image</a>
                                                       </form>

                                                       <!--Paid Customer-->
                                                       <?php } if($userData->is_franchisee == '2') { ?>
                                                       <form action="<?=base_url()?>/Greetings/MultiView/5" method="post" target="_blank">
                                                           <input type="hidden" name="promo" id="pro2" value="<?=$selectdata1?>">
                                                        <a class="dropdown-item"  onclick="$(this).closest('form').submit();"><i class="ft ft-download"></i> Download With Footer Image</a>
                                                        </form>
                                                        <form action="<?=base_url()?>/Greetings/MultiView/6" method="post" target="_blank">
                                                        <input type="hidden" name="promo" id="pro3" value="<?=$selectdata1?>">
                                                        <a class="dropdown-item" onclick="$(this).closest('form').submit();"><i class="ft ft-download"></i> Download With Advt Image And Name </a>
                                                            <!--Free Customer-->
                                                            </form>
                                                      <?php } if($userData->is_franchisee == '0') {?>
                                                      <form action="<?=base_url()?>/Greetings/MultiView/7" method="post" target="_blank">
                                                         <input type="hidden" name="promo" id="pro4" value="<?=$selectdata1?>">
                                                        <a class="dropdown-item" onclick="$(this).closest('form').submit();" ><i class="ft ft-download"></i> Download Image with Advt and Name</a>
                                                       </form>
                                                        
                                                      <?php } if($userData->is_franchisee == '4') {?>
                                                      <form action="<?=base_url()?>/Greetings/MultiView/7" method="post" target="_blank">
                                                         <input type="hidden" name="promo" id="pro4" value="<?=$selectdata1?>">
                                                        <a class="dropdown-item" onclick="$(this).closest('form').submit();" ><i class="ft ft-download"></i> Download Image with Advt and Name</a>
                                                       </form>
                                                        <?php }?>
                                     </div>
                                  </div>
                                  <div class="table-responsive">


                                <!--   <a href="<?=base_url()?>/Greetings/MultiView/1" style="float:right;margin:5px;" target="_blank" class="btn  btn-info text-right mb-3"><i class="fa fa-download"></i> Download All</a> -->
                                      <table class="table">
                                        	<thead>
                                        		<th>S.NO</th>
                                        			<th>Name</th>
                                        			<th>Select</th>
                                        	</thead>
                                        	<tbody>
                                        	    <?php

                                              //  var_dump($selectdata);
                                                if(($userData->select_types!=='') || ($userData->select_types!==NULL))
                                                  {
                                                    $selected="checked";


                                                  }
                                                  else
                                                  {
                                                    $selected="";

                                                  }
                                                  $newpro = array();
                                        	     foreach ($promotionsimage as $key => $promoimg)
                                      {


                                           $encturl=$promoimg->imgid;
                                           $no=$key+1;
                                           if(($userData->select_types!=='') && ($userData->select_types!==NULL)){

                                              if(in_array($encturl ,$selectdata) )
                                                  {
                                                    $selected="checked";
                                                  }
                                                  else
                                                  {
                                                    $selected="";
                                                    
                                                  }
                                                 
                                           }
                                           array_push($newpro, $encturl);
                                        	    ?>
                                        		<tr>
                                        			<td><?=$key+1?></td>
                                        			<td><?=$promoimg->promotions?></td>
                                        			<!-- <td> -->
                                        			     <!-- Example single danger button -->
                                                    <!-- <div class="btn-group">
                                                      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Download
                                                      </button>
                                                      <div class="dropdown-menu">

                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download/'.$encturl.'/'.$no)?>"  target="_blank"><i class="ft ft-download"></i> Template 1</a>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download2/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Template 2</a>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download3/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Template 3</a>
                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download4/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Template 4</a>

                                                        <a class="dropdown-item" href="<?=base_url('Greetings/Download6/'.$encturl)?>" target="_blank"><i class="ft ft-download"></i> Download With Footer Image</a>

                                                    </div> -->


                                                    <td><input type="checkbox" name="promo[]"  onclick="Togglearray(<?=$promoimg->imgid?>)" value="<?=$promoimg->imgid?>" <?=$selected?>></td>

                                        		</tr>
                                        		<?php } ?>
                                        	</tbody>
                                        </table>
                                        <?php
                                         if(($userData->select_types!=='') || ($userData->select_types!==NULL))
                                         {
                                          $selectdata = $newpro;
                                          $selectdata1 = implode(',', $selectdata);;

                                         }
                                         else
                                         {
                                          $selectdata=json_decode($userData->select_types);
                                          $selectdata1 = implode(',', $selectdata);;

                                         }
                                        
                                        ?>
                                        <input type="hidden" id="newdata" value="<?=$selectdata1?>">


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






                  <script>
                    var result = undefined;
                    window.onload = function(){
                    var string = $("#newdata").val();
                         result = string.split(',');
                         $("#pro1").val(result);
                      $("#pro2").val(result);
                      $("#pro3").val(result);
                      $("#pro4").val(result);
                    }
                   
                    function Togglearray(newItem)
                    {
                      // var string = $("#newdata").val();
                      newItem = ""+newItem+"";
                      
                      // console.log(result);
                       var array = result;
                      //  console.log(array);
                      array.indexOf(newItem) === -1 ? array.push(newItem) : array.splice(array.indexOf(newItem), 1);

                      console.log(array);
                      // $("#pro1").val('');
                      // $("#pro2").val('');
                      // $("#pro3").val('');
                      // $("#pro4").val('');

                      $("#pro1").val(array);
                      $("#pro2").val(array);
                      $("#pro3").val(array);
                      $("#pro4").val(array);
                    }




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
