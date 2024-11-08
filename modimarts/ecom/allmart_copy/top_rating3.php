<?php 
include("config.php");
$sliderid="11";
$slidername="topratingslider3";
$slidertablename="top_right_slider3";
$todaysdtt=date("Y-m-d");

//print_r($slotarr);
//echo in_array("1", $slotarr);
if($_SESSION['id']!="")
{
}
?>
<div class="widget panel ">
    <div class="widget-heading panel-heading block-borderbox"><h4 class="panel-title">  &nbsp; &nbsp;</h4>Discount Offers </div>
	<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list957231386"  data-ride="owlcarousel">
		<div class="carousel-controls">
			<a class="carousel-control left center" href="#product_list957231386"   data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control right center" href="#product_list957231386"  data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">
		    <?php include('showsliderlocationwse.php'); ?>
		    <?php
            $detsarr=array();
            for($ca=0;$ca<=8;$ca++)
            {
                $avilfrupdt=0;
                $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
                $qspbkd=mysqli_num_rows($qravdm);
                $bkit=0;
                if($qspbkd==0)
                {
                    //echo "okhere123";
                    $bkit=0;//slot not booked show admin products  
    
                } else {
                    // echo "okhere".$_POST["latitude"];
                    if($_POST["latitude"]!="")
                    {
                        $arrdist=array();
                        $arraycid=array();
                        while($rfrws=mysqli_fetch_array($qravdm))
                        {
                            $qrgetds=mysqli_query($con1,"SELECT * FROM `clients` where code='".$rfrws['merchant_id']."'");
                            $frds=mysqli_fetch_array($qrgetds);
                            if($frds["Latitude"]!="")
                            {
                                $lat2=floatval($frds["Latitude"]);
                                $long2=floatval($frds["Longitude"]);
                                $dist=distance(floatval($_POST["latitude"]),floatval($_POST["longitude"]), floatval($lat2), floatval($long2), "K");
                                if($dist<=5)
                                {
                                   $arrdist[]=$dist;
                                   $arrdist2[]=$dist;
                                   $arraycid[]=$rfrws['merchant_id'];
                                }
                            }
                        }
                        if(count($arrdist2)>0 )
                        {
                            sort($arrdist2);  
                        }
                        if(count($arrdist)==0)
                        {
                            $bkit=0;//show admin products
                        } else {
                            $key = array_search('$arrdist2[0]', $arrdist);
                            $qravdmf=mysqli_query("select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".$todaysdtt."' and merchant_id='".$arraycid[$key]."'");
                            $qravdmfr=mysqli_fetch_array($qravdmf);
                            $bkit= $qravdmfr["booking_id"];
                        }
                    } else {
                        $bkit=0;//show admin products
                    }
                }        
                $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid."' and slot_pos='".$ca."' and booking_id='".$bkit."' and stats='0'";
                $qrylatfrws=mysqli_query($con1,$qrylatf2); 
                $latstprnrws=mysqli_num_rows($qrylatfrws);

                if($latstprnrws>0)
                {
                    $lat1=mysqli_fetch_array($qrylatfrws);
                    /* Ruchi :
                    $getprdets=mysqli_query($con3,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");*/
                    $qry_data = "select pd.*,p.product_model,p.id,p.category_id,p.description as descr,p.brand_id,p.others as other,p.Long_desc as longdesc,p.status as pstatus from Productviewtable pd join product_model p on pd.name = p.id where pd.code='".$lat1['pid']."' and p.category_id='".$lat1['cat']."' ";
                    $getprdets=mysqli_query($con1,$qry_data);
                    $prdrws=mysqli_fetch_array($getprdets);
                    $getprdetsimg=mysqli_query($con1,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
                    $prdrwsimg=mysqli_fetch_array($getprdetsimg);
                    $detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'pname'=>$prdrws['product_model'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category_id'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt];
                    
                } else {
                    $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
                }
                //print_r($detsarr)."<>";  
            }
            $cnt=1;
            $itemcount=1;
            $itr=0;
            $slides=1;
            while($slides<=2)
            { ?>
                <div class="item  products-block">
                    <div class="row products-row last">
                        <?php
                        $nm=1;
                        for($a=0;$a<4;$a++)
                        {
                            if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
                            { ?>
                                <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
                                    <div class="product-block">
                                        <div class="image">
                                            <div class="product-img img">
                                                <a class="img" title="<?php echo $detsarr[$itr]['pname'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>">
                                                    <img class="img-responsive" src="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['pname'];?>" style="height:150px; width: 100%; object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
                                                </a>          
                                                <div class="compare hover-icon">  </div>  
                                            </div> 
                                        </div>
                                        <div class="product-meta">
                                            <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"><p class="b"><?php echo $detsarr[$itr]['pname'];?></p></a></h6>
                                            <p class="description">.....</p>
                                            <div class="price">
                                                <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
                                                <?php if($detsarr[$itr]['discount']>0){?>
                                                    <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span>  
                                                <?php } ?>
                                            </div>
                                            <div class="">
                                                <div class="cart">            
                                                    <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $detsarr[$itr]['code'];?>','<?php echo $detsarr[$itr]['category'];?>');">
                                                        <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
                                                    </button>
                                                </div>
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
                                                    <img class="img-responsive" src="<?php echo $noproductimg;?>" title="" style=" width: 100%;height: 200px;object-fit: contain"  />
                                                </a>          
                                                <div class="compare hover-icon">  </div>  
                                            </div>
                                        </div>
                                        <div class="product-meta">
                                            <h6 class="name"><a href="javascript:void(0);"></a></h6>
                                            <p class="description">.....</p>
                                        </div>  
                                    </div>
    							</div>
                            <?php }
                            $nm++;
                            $cnt++;
                            $itr++;
                        } ?>
                    </div>
                </div>
                <?php
                $itemcount++;
                $slides++;
            } ?>
        </div>
	</div>
	<div class="clearfix"></div>
</div>