<?php 
include("config.php");

$todaysdtt=date("Y-m-d");


$sliderid1="5";//--latest products--//
$slidername1="latestprslider";

$sliderid2="6";//--featured products--//
$slidername2="featuredprslider";

$sliderid3="7";//--lates products--//
$slidername3="specialprslider";

$slidertablename="top_right_slider";

$qrylatf="select * from latest_featured_product where typ=1 order by id asc";
$qrylatfrws=mysqli_query($con3,$qrylatf);   
$latstprnrws=mysqli_num_rows($qrylatfrws);

$qryfeatured="select * from latest_featured_product where typ=2 order by id asc";
$qryfeaturedrws=mysqli_query($con3,$qryfeatured);   
$qryfeaturednumrws=mysqli_num_rows($qryfeaturedrws);

$qryspecial="select * from latest_featured_product where typ=3 order by id asc";
$qryspecialrws=mysqli_query($con3,$qryspecial);   
$qryspecialnumrws=mysqli_num_rows($qryspecialrws);

function distance3($lat1, $lon1, $lat2, $lon2, $unit) {
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
?>

<div class="tab-v5 ">
  <div class="tab-heading">
    <ul role="tablist" class="nav nav-tabs" id="product_tabs126552099">
        <li>
            <a data-toggle="tab" role="tab" href="#tab-latest126552099"  id="tab1" aria-expanded="true"><i class="fa "></i>Latest</a>
	    </li>
	    <li>
	        <a data-toggle="tab" role="tab" href="#tab-featured126552099" aria-expanded="true"><i class="fa "></i>Featured</a>
	    </li>
	    <li>
	        <a data-toggle="tab" role="tab" href="#tab-special126552099"  aria-expanded="true"><i class="fa "></i>Special</a>
	    </li>
     </ul>
    </div>    
    <div class="tab-content bg-white">
	    <div class="tab-pane fade box-products owl-carousel-play  tabcarousel126552099" id="tab-latest126552099" data-ride="owlcarousel">
            <div class="carousel-controls hidden-xs hidden-sm">
			    <a class="carousel-control left" href="#tab-latest126552099"   data-slide="prev"><i class="fa fa-angle-left"></i></a>
				<a class="carousel-control right" href="#tab-latest126552099"  data-slide="next"><i class="fa fa-angle-right"></i></a>
			</div>
            <div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true"id="latestid">
<!-----------------------------------------------latest images query-------------------------------------------------------------------------------------------------------------->													
	<?php
    $detsarr=array();
    for($ca=0;$ca<=8;$ca++)
    {
        $avilfrupdt=0;
        $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid1."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
        $qspbkd=mysqli_num_rows($qravdm);
        $bkit1=0;
        if($qspbkd==0)
        {
            //echo "okhere123";
            $bkit1=0;//slot not booked show admin products  
    
        }else
        {
            //  echo "okhere".$_POST["latitude"];
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
                    $dist=distance3(floatval($_POST["latitude"]),floatval($_POST["longitude"]), floatval($lat2), floatval($long2), "K");
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
            $bkit1=0;//show admin products
        }
        else
        {
                $key = array_search('$arrdist2[0]', $arrdist);
                
                  $qravdmf=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid1."' and slot_pos='".$ca."' and dt='".$todaysdtt."' and merchant_id='".$arraycid[$key]."'");
                    $qravdmfr=mysqli_fetch_array($qravdmf);
                   $bkit1= $qravdmfr["booking_id"];
            
            
        }
 
    }else
    {
        $bkit=0;//show admin products
    }
      
    
   }       
       
      
     $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid1."' and slot_pos='".$ca."' and booking_id='".$bkit1."' and stats='0'";
        
        
$qrylatfrws=mysqli_query($con3,$qrylatf2); 
$latstprnrws=mysqli_num_rows($qrylatfrws);

if($latstprnrws>0)
{
  //  echo "ok";
   $lat1=mysqli_fetch_array($qrylatfrws);
   
   $getprdets=mysqli_query($con3,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
    
    
    
        $getprdetsimg=mysqli_query($con3,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrwsimg=mysqli_fetch_array($getprdetsimg);
    
   
      
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt];
            
    }else
    {
        
         $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
    }
    
}
 //   print_r($detsarr);
    
   // echo "ok".$detsarr[0]["code"];
    $cnt=1;
    $itemcount=1;
    $itr=0;
$slides=1;
    
   while($slides<=2)
{
?>	
    <div class="item ">
<div class="row box-product">

<?php
$nm=1;

for($a=0;$a<4;$a++)
    {    
      
      if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
        {
        ?>
   																						    
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>">
            <img class="img-responsive" src="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style="height:150px; width: 100%;
  object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
          </a>          
          <div class="compare hover-icon">     
          
          </div>  
                  
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
       
          
        <div class="">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $detsarr[$itr]['code'];?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div>     
        
  </div>  
</div>





							    </div>

<?php 
           
        }
        else
        {
           ?> 
             <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
       <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
              
             
            <img class="img-responsive" src="<?php echo $noproductimg;?>" title="" style=" width: 100%;
  height: 200px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
            
               
          </div>  
                 
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"></a></h6>
         
       
               
  </div>  
</div>





							    </div>

            
            <?php
        }
$nm++;
$cnt++;
 $itr++;
} ?>							    
									    
									    
</div>
</div>
    <?php
    
        $itemcount++;
        $slides++;
    }
    
 ?>
    
  
    
    
					  					</div>
				</div>


<!-----------------------------------------------latest images query end-------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------featured products start----------------------------------------------------------------------------------------------->



	<div class="tab-pane fade box-products owl-carousel-play  tabcarousel126552099" id="tab-featured126552099" data-ride="owlcarousel">

										<div class="carousel-controls hidden-xs hidden-sm">
					<a class="carousel-control left" href="#tab-featured126552099"   data-slide="prev"><i class="fa fa-angle-left"></i></a>
					<a class="carousel-control right" href="#tab-featured126552099"  data-slide="next"><i class="fa fa-angle-right"></i></a>
					</div>
<div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true"id="latestid">
	<?php
	unset($detsarr);
    $detsarr=array();
    
    
    for($ca=0;$ca<=8;$ca++)
    {
  
  
   $avilfrupdt=0;
   
       $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid2."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysqli_num_rows($qravdm);
    
   
    $bkit2=0;
   
   if($qspbkd==0)
   {
    //echo "okhere123";
       $bkit1=0;//slot not booked show admin products  
    
   }else
   {
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
        
        
            $dist=distance3(floatval($_POST["latitude"]),floatval($_POST["longitude"]), floatval($lat2), floatval($long2), "K");
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
    
            $bkit1=0;//show admin products
        }
        else
        {
    
                $key = array_search('$arrdist2[0]', $arrdist);
                
                  $qravdmf=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid2."' and slot_pos='".$ca."' and dt='".$todaysdtt."' and merchant_id='".$arraycid[$key]."'");
                    $qravdmfr=mysqli_fetch_array($qravdmf);
                   $bkit2= $qravdmfr["booking_id"];
            
            
        }
 
    }else
    {
        $bkit=0;//show admin products
    }
      
    
   }       
       
      
     $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid2."' and slot_pos='".$ca."' and booking_id='".$bkit2."' and stats='0'";
        
           
      

        
        
$qrylatfrws=mysqli_query($con3,$qrylatf2); 
$latstprnrws=mysqli_num_rows($qrylatfrws);

if($latstprnrws>0)
{
   $lat1=mysqli_fetch_array($qrylatfrws);
   
   
   $getprdets=mysqli_query($con3,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
         
        $getprdetsimg=mysqli_query($con3,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrwsimg=mysqli_fetch_array($getprdetsimg);

    
      
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt];
   
        
    }else
    {
         $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
    }
    
}
    //print_r($detsarr);
    
   // echo "ok".$detsarr[0]["code"];
    $cnt=1;
    $itemcount=1;
    $itr=0;
$slides=1;
    
   while($slides<=2)
{
?>	
    <div class="item ">
<div class="row box-product">

<?php
$nm=1;

for($a=0;$a<4;$a++)
    {    
      
      if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
        {
        ?>
   																						    
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>">
            <img class="img-responsive" src="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style="height:150px; width: 100%;
  object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
          </a>          
          <div class="compare hover-icon">     
          
          </div>  
                  
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
        <p class="description">.....</p>
        
                   <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span>  
             <?php } ?>
            
                  </div>
          
              
               <div class="">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $detsarr[$itr]['code'];?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div> 
           
              
                   
  </div>  
</div>





							    </div>

<?php 
           
        }
        else
        {
           ?> 
             <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
              
             
             <img class="img-responsive" src="<?php echo $noproductimg;?>" title="" style=" width: 100%;
  height: 200px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
            
               
          </div>  
                 
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"></a></h6>
         
        <p class="description">.....</p>
        
                   <div class="price">
                
            
                  </div>
          
               
  </div>  
</div>





							    </div>

            
            <?php
        }
$nm++;
$cnt++;
 $itr++;
} ?>							    
									    
									    
</div>
</div>
    <?php
    
        $itemcount++;
        $slides++;
    }
    
 ?>
    
  
    
    
					  					</div>
				</div>




					
							
<!---------------------------------------------------------------------featured products end----------------------------------------------------------------------------------------------->							
							
							
<!---------------------------------------------------------------------special products start----------------------------------------------------------------------------------------------->
							

	<div class="tab-pane fade box-products owl-carousel-play  tabcarousel126552099" id="tab-special126552099" data-ride="owlcarousel">

										<div class="carousel-controls hidden-xs hidden-sm">
					<a class="carousel-control left" href="#tab-special126552099"   data-slide="prev"><i class="fa fa-angle-left"></i></a>
					<a class="carousel-control right" href="#tab-special126552099"  data-slide="next"><i class="fa fa-angle-right"></i></a>
					</div>
<div class="owl-carousel" data-show="1" data-pagination="false" data-navigation="true"id="latestid">
	<?php
	unset($detsarr);
    $detsarr=array();
    
    
    for($ca=0;$ca<=8;$ca++)
    {
  
  
   $avilfrupdt=0;
   
       $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid3."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysqli_num_rows($qravdm);
    
   
    $bkit2=0;
   if($qspbkd==0)
   {
    //echo "okhere123";
       $bkit1=0;//slot not booked show admin products  
    
   }else
   {
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
        
        
            $dist=distance3(floatval($_POST["latitude"]),floatval($_POST["longitude"]), floatval($lat2), floatval($long2), "K");
                
    
                
            
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
            $bkit1=0;//show admin products
        }
        else
        {
                $key = array_search('$arrdist2[0]', $arrdist);
                
                  $qravdmf=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid3."' and slot_pos='".$ca."' and dt='".$todaysdtt."' and merchant_id='".$arraycid[$key]."'");
                  $qravdmfr=mysqli_fetch_array($qravdmf);
                  $bkit3= $qravdmfr["booking_id"];
            
            
        }
 
    }else
    {
        $bkit=0;//show admin products
    }
      
    
   }       
       
      
     $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid3."' and slot_pos='".$ca."' and booking_id='".$bkit3."' and stats='0'";
        
        
      
      

        
        
$qrylatfrws=mysqli_query($con3,$qrylatf2); 
$latstprnrws=mysqli_num_rows($qrylatfrws);

if($latstprnrws>0)
{
   $lat1=mysqli_fetch_array($qrylatfrws);
   
   
   $getprdets=mysqli_query($con3,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
         
        $getprdetsimg=mysqli_query($con3,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrwsimg=mysqli_fetch_array($getprdetsimg);

    
      
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt];
   
        
    }else
    {
        
         $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
    }
    
}
//print_r($detsarr);
    
   // echo "ok".$detsarr[0]["code"];
    $cnt=1;
    $itemcount=1;
    $itr=0;
$slides=1;
    
   while($slides<=2)
{
?>	
    <div class="item ">
<div class="row box-product">

<?php
$nm=1;

for($a=0;$a<4;$a++)
    {    
      
      if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
        {
        ?>
   																						    
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>">
            <img class="img-responsive" src="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style="height:150px; width: 100%;
  object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
          </a>          
          <div class="compare hover-icon">     
          
          </div>  
                  
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
        <p class="description">.....</p>
        
                   <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span>  
             <?php } ?>
            
                  </div>
          
                 <div class="">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $detsarr[$itr]['code'];?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
            </div>
                  </div> 
                
                
                     
  </div>  
</div>





							    </div>

<?php 
           
        }
        else
        {
           ?> 
             <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
              
             
            <img class="img-responsive" src="<?php echo $noproductimg;?>" title="" style=" width: 100%;
  height: 200px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
            
               
          </div>  
                 
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"></a></h6>
         
        <p class="description">.....</p>
        
                 
          
               
  </div>  
</div>





							    </div>

            
            <?php
        }
$nm++;
$cnt++;
 $itr++;
} ?>							    
									    
									    
</div>
</div>
    <?php
    
        $itemcount++;
        $slides++;
    }
    
 ?>
    
  
    
    
					  					</div>
				</div>
							

<!---------------------------------------------------------------------special products end----------------------------------------------------------------------------------------------->
							

					</div>
					<script>
$(function () {
$('#product_tabs126552099 a:first').tab('show');
})

</script>