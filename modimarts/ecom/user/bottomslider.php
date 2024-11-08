<?php 
include("config.php");
$sliderid="8";
$slidername="bottomslider";
$slidertablename="top_right_slider";
//print_r($slotarr);
  //echo in_array("1", $slotarr);
  if($_SESSION['id']!="")
  {
  }
?> 
<div class="widget panel ">
	<div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">  &nbsp; &nbsp;</h4>Deals Of The Days &nbsp;&nbsp;</div>
		<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list1011535050"  data-ride="owlcarousel">
			<div class="carousel-controls"> 
				<a class="carousel-control left center" href="#product_list1011535050" data-slide="prev">
					<i class="fa fa-angle-left"></i> 
				</a>
				<a class="carousel-control right center" href="#product_list1011535050"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>      
			</div>  
			<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">
			    <?php
                $detsarr=array();   
                for($ca=0;$ca<=8;$ca++)
                {
                    $avilfrupdt=0;
                    $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."' and merchant_id='".$_SESSION["id"]."'");
                    $qspbkd=mysqli_num_rows($qravdm);
                    if($qspbkd>0)
                    {
                        $avilfrupdt="1";
                        $frt=mysqli_fetch_array($qravdm);
                        $bkit=$frt["booking_id"];
                        /*Ruchi*/
                        $bk_tildate=$frt["dt"];
                        $qrylatf2="select id,pid,cat,entrydt from top_right_slider where  slot_id='".$sliderid."' and slot_pos='".$ca."' and user_id='".$_SESSION["id"]."' and stats='0'";
                        $qrylatfrws=mysqli_query($con1,$qrylatf2); 
                        $latstprnrws=mysqli_num_rows($qrylatfrws);
                        if($latstprnrws>0)
                        {
                            $lat1=mysqli_fetch_array($qrylatfrws);
                            /* Ruchi 
                                $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
                            */
                            $getprdets=mysqli_query($con1,"select p.*,pm.product_model from Productviewtable p join product_model pm on p.name = pm.id where p.code='".$lat1['pid']."' and p.category='".$lat1['cat']."' ");
                            $prdrws=mysqli_fetch_array($getprdets);
                            $getprdetsimg=mysqli_query($con1,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
                            $prdrwsimg=mysqli_fetch_array($getprdetsimg);
                            $detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['product_model'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt,'bookingid'=>$bkit,'booking_date'=>$lat1['entrydt'],'till_date'=>$bk_tildate];
                        } else {   
                            $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt,'bookingid'=>$bkit];
                        }  
                    } else {
                        $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
                    }
                    //print_r($detsarr)."<>";
                }
                $cnt=1;
                $itemcount=1;
                $itr=0;
                $slides=1;
                while($slides<=2) { ?>	
                    <div class="item  products-block">
                        <div class="row products-row last">
                        <?php
                        $nm=1;  
                        for($a=0;$a<4;$a++)
                        {    
                            if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="") { ?>
                                <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
                                    <div class="product-block">
                                        <div class="image">
                                            <div class="product-img img">
                                              <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>">
                                                <img class="img-responsive" src="<?php echo "../".$prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style="height:150px; width: 100%;object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
                                              </a>          
                                              <div class="compare hover-icon"> </div>
                                            </div>
                                        </div>
                                        <div class="product-meta">
                                            <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>"><?php echo $detsarr[$itr]['name'];?></a></h6>
                                            <p class="description">.....</p>
                                            <div class="price">
                                                <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
                                                <?php if($detsarr[$itr]['discount']>0){?>
                                                    <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span>  
                                                <?php } ?>
                                            </div>
                                            <div> 
                                                <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="showModal('<?php echo $detsarr[$itr]['booking_date']; ?>','<?php echo $detsarr[$itr]['till_date']; ?>','<?php echo $sliderid;?>','<?php echo $itr;?>','<?php echo getrt($sliderid); ?>');">
                                                    <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart" ></i><span class="">Slot Availibility</span>
                                                </button>
                                            </div>
                                            <?php 
                                            if($detsarr[$itr]['avail']==1)
                                            {
                                                $admin_cid=mysqli_query($con1,"select cid,department from users where  cid='".$_SESSION["id"]."' ");
                                                $result_admin=mysqli_fetch_array($admin_cid);
                                                if($result_admin[0]==0 && $result_admin[1]=='admin'){ ?>
                                                    <div>
                                                        <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername.$itr;?>" id="<?php echo $slidername.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
                                                        <button data-loading-text="Loading..." class="btn btn-default" type="button"onclick="srchfsnchw('<?php echo $sliderid;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>','<?php echo $itr;?>','<?php echo $detsarr[$itr]['bookingid'];?>');">
                                                            <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
                                                        </button>
                                                        <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="saledelfun('<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>');">
                                                            <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Delete</span>
                                                        </button>
                                                    </div>
                                                <?php }  } ?>
                                            <div class="action">
                                                <div class="cart"></div>
                                            </div>     
                                        </div>  
                                    </div>
        						</div>
                                <?php } else { ?> 
                                    <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
                                        <div class="product-block">
                                            <div class="image">
                                                <div class="product-img img">   
                                                    <a class="img" title="" href="javacript:void(0);">
                                                        <img class="img-responsive" src="<?php echo $yourproducthere;?>" title="" style=" width: 100%; height: 150px;object-fit: contain"  />
                                                    </a>          
                                                    <div class="compare hover-icon"> </div>  
                                                </div>   
                                            </div>   
                                            <div class="product-meta">
                                                <h6 class="name"><a href="javascript:void(0);"></a></h6>
                                                <p class="description">.....</p>
                                                <?php  
                                                if($detsarr[$itr]['avail']!="1") { ?>
                                                    <div class="price">
                                                        <span class="price-new">Rate <i class="fa fa-inr"></i> <?php echo getrt($sliderid);?></span>
                                                    </div>
                                                <?php } ?>
                                                <?php if($detsarr[$itr]['avail']=="1"){ ?>
                                                    <div>
                                                        <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername.$itr;?>" id="<?php echo $slidername.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
                                                        <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>','<?php echo $itr;?>','<?php echo $detsarr[$itr]['bookingid'];?>');">
                                                            <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
                                                        </button>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div>    
                                                        <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername.$itr;?>" id="<?php echo $slidername.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
                                                        <?php if(getrt($sliderid)!="") { ?>
                                                            <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="slotbkfunc('<?php echo $sliderid;?>','<?php echo $itr;?>','<?php echo getrt($sliderid); ?>')">
                                                                <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">BOOK NOW</span>
                                                            </button>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>   
                                            </div>   
                                        </div>
							        </div>
							    <?php } $nm++; $cnt++; $itr++; } ?>
							</div>	
						</div>
						<?php $itemcount++; $slides++; } ?>
			  		</div>
			  	</div>
			  	<div class="clearfix"></div>
		    </div>