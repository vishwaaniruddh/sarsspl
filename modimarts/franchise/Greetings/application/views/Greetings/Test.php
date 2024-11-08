 <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/')?>vendors/css/tables/datatable/datatables.min.css">
     <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <!-- END: Vendor CSS--> 
    <?php 
        
        $img=$user_Data->image;
        $logo=$user_Data->logo;
        $maincol=8;
        $mr=2;
        
        if($img=='')
        {
            $maincol+=2;
            $mr+=1;
        }
       
        
          if($logo=='')
        {
            $maincol+=2;
            $mr+=1;
        }
         ?>  

      <!-- Demo styles -->
    <style>
      
      .swiper {
        width: 100%;
        height: 100%;
      }

      .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
      }

      .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>  
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
                                  <div class="table-responsive">
                                    
                                      
                                  <a href="#" style="float:right;margin:5px;" target="_blank" data-toggle="modal" data-target="#exampleModalCenter" class="btn  btn-info text-right mb-3"><i class="fa fa-download"></i> Download All</a>
                                      <table class="table">
                                        	<thead>
                                        		<th>S.NO</th>
                                        			<th>Name</th>
                                        			<!-- <th>Download</th> -->
                                        	</thead>
                                        	<tbody>
                                        	    <?php
                                        	     foreach ($promotionsimage as $key => $promoimg)
                                      {
                                           $encturl=$promoimg->imgid;
                                           $no=$key+1;
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
                                        			     
                                        		</tr>
                                        		<?php } ?>
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
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
           <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><a href="<?=base_url('assets/exmpl/temp1.png')?>"><img src="<?=base_url('assets/exmpl/temp1.png')?>" style="width:100%;" alt=""><div>
                    <div class="row">
                        <?php
                        if($logo!=='')
                           {
                        ?>
                        <div class="col-sm-2 col-xs-2 col-md-2 text-left " style="margin-top: auto;margin-bottom: auto;">
                            <img id="greetimg" alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$user_Data->logo?>" style="width: 100%;"/>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-<?=$maincol?> col-sm-<?=$maincol?> col-xs-<?=$maincol?> content p-<?=$mr?>">
                           <?php if($user_Data->content!=''){ ?>  <h2 style="text-align: center;"><?=$user_Data->content?></h2><?php } ?>
                             <?php if($user_Data->content1!=''){ ?><h2 style="text-align: center;"><?=$user_Data->content1?></h2><?php } ?>
                            <?php if($user_Data->content2!=''){ ?> <h2 style="text-align: center;"><?=$user_Data->content2?></h2><?php } ?>
                            <?php if($user_Data->content3!=''){ ?> <h2 style="text-align: center;"><?=$user_Data->content3?></h2><?php } ?>
                            <p style="text-align:center" class="m-0" >
                                <?=$user_Data->customer_name?> -<?=$user_Data->mobile_number?>
                            </p>
                            <h2 style="text-align:center" class="m-0" >
                               <?php if($user_Data->email!=''){ ?> <?=$user_Data->email?> <?php } if($user_Data->website!=''){ ?>&nbsp;&nbsp;  <?=$user_Data->website?> <?php }?>
                            </h2>
                           
                        </div>
                        <?php
                         if($img!=='')
                            {
                        ?>
                        <div class="col-md-2 col-sm-2 col-xs-2 text-right " style="margin-top: auto;margin-bottom: auto;">
                            <img alt="" src="https://allmart.world/franchise/promotions_cms/customer_promotion/<?=$user_Data->image?>" style="width: 100%;"/>
                        </div>
                        <?php
                          }
                        ?>
                    </div>
                </div></a></div>
        <div class="swiper-slide"><a href="<?=base_url('assets/exmpl/temp1.png')?>"><img src="<?=base_url('assets/exmpl/temp2.jpeg')?>" style="width:100%;" alt=""></a></div>
        <div class="swiper-slide"><a href="<?=base_url('assets/exmpl/temp1.png')?>"><img src="<?=base_url('assets/exmpl/temp3.jpeg')?>" style="width:100%;" alt=""></a></div>
        <div class="swiper-slide"><a href="<?=base_url('assets/exmpl/temp1.png')?>"><img src="<?=base_url('assets/exmpl/temp4.jpeg')?>" style="width:100%;" alt=""></a></div>
        <div class="swiper-slide"><a href="<?=base_url('assets/exmpl/temp1.png')?>"><img src="<?=base_url('assets/exmpl/temp5.jpeg')?>" style="width:100%;" alt=""></a></div>
        
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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


    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".mySwiper", {
        pagination: {
          el: ".swiper-pagination",
          type: "fraction",
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
                
       <!-- BEGIN: Page Vendor JS-->
    <script src="<?=base_url('assets/')?>vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

       <!-- BEGIN: Page JS-->
    <script src="<?=base_url('assets/')?>js/scripts/tables/datatables/datatable-basic.min.js"></script>
    <!-- END: Page JS-->

    
      
