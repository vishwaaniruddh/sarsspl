<?php 
include("config.php");
$sliderid="4";
$slidername="bestsellerslider";
$slidertablename="top_right_slider";
//print_r($slotarr);
  //echo in_array("1", $slotarr);
  
//echo $qrylatf2;
$todaysdtt=date("Y-m-d");

?>

<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list1854855228"  data-ride="owlcarousel" >
						<div class="carousel-controls">
				<a class="carousel-control left center" href="#product_list1854855228"   data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right center" href="#product_list1854855228"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">


<?php
   
    include('showsliderlocationwse.php');
   
?>

					<?php
    $detsarr=array();
    
   
    for($ca=0;$ca<=4;$ca++)
    {
  
  
   $avilfrupdt=0;
   
       $qravdm=mysqli_query($con1,"select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysqli_num_rows($qravdm);
    
   $bkit=0;
   if($qspbkd==0)
   {
    //echo "okhere123";
       $bkit=0;//slot not booked show admin products  
    
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
        }
        else
        {
                $key = array_search('$arrdist2[0]', $arrdist);
                
                  $qravdmf=mysqli_query("select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".$todaysdtt."' and merchant_id='".$arraycid[$key]."'");
                    $qravdmfr=mysqli_fetch_array($qravdmf);
                   $bkit= $qravdmfr["booking_id"];
            
            
        }
 
    }else
    {
        $bkit=0;//show admin products
    }
      
    
   }            
        $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid."' and slot_pos='".$ca."' and booking_id='".$bkit."' and stats='0'";
      
      
  // echo $qrylatf2;
$qrylatfrws=mysqli_query($con1,$qrylatf2); 
$latstprnrws=mysqli_num_rows($qrylatfrws);

if($latstprnrws>0)
{
   $lat1=mysqli_fetch_array($qrylatfrws);
   
   
    $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
    
    $getprdetsimg=mysqli_query($con1,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrwsimg=mysqli_fetch_array($getprdetsimg);
    
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'distance'=>""];
    
    
}else
{
      
 
     $gtallprdshwn=mysqli_query($con1,"select pid,category from slider_location_dets where city_id='".$livecityid."' and slot_id='".$sliderid."' and slot_pos='".$ca."' and sts=0 and entrydt='".$todaysdtt."'  ");
    echo mysqli_error();
    $gtallprdnr=mysqli_num_rows($gtallprdshwn);
    
    if($gtallprdnr>0)
    {
       
    $lat1=mysqli_fetch_array($gtallprdshwn);
   
   
    $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['category']."' ");
    $prdrws=mysqli_fetch_array($getprdets);
    
    $getprdetsimg=mysqli_query($con1,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['category']."' ");
    $prdrwsimg=mysqli_fetch_array($getprdetsimg);
        
        
        $detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'distance'=>""];
        
    }else
    {
    
    $detsarr[]=['code'=>0,'name'=>"",'ccode'=>"",'description'=>"",'category'=>"",'photo'=>"",'price'=>"",'discount'=>"",'discount_type'=>"",'total_amt'=>"",'updtid'=>"",'distance'=>""];
    }
 
  
}
  
 //  print_r($detsarr)."<>";     
        
    }
    
    
  $merchntidsall=array();
    
    $Viewrt=mysqli_query($con1,"SELECT distinct(merchant_id) FROM merchantdetsfm where 1 order by distance asc");
 echo mysqli_error();
$nrtws=mysqli_num_rows($Viewrt);
if($nrtws>0)
{

while($lat1=mysqli_fetch_array($Viewrt))
{
    
    $merchntidsall[]=$lat1["merchant_id"];
}
 //print_r($merchntidsall);

if(count($merchntidsall)>0)
{
shuffle($merchntidsall);
}

$clintarindx=0;
  for($ca=0;$ca<count($detsarr);$ca++)
    {
  
  if(isset($merchntidsall[$clintarindx]))
  {
  //execute code here

  if($detsarr[$ca]["code"]=="0")
  {
      
      
      
     $Viewrt=mysqli_query($con1,"SELECT * FROM merchantdetsfm where merchant_id='".$merchntidsall[$clintarindx]."'  order by distance asc limit 0,1");
   echo mysqli_error();
$nrtws=mysqli_num_rows($Viewrt);

   if($nrtws>0)
   {
       
        $lat1=mysqli_fetch_array($Viewrt);
   
   
        $getprdets=mysqli_query($con1,"select * from Productviewtable where code='".$lat1['code']."' and category='".$lat1['category']."' ");
        $prdrws=mysqli_fetch_array($getprdets);
    
        $getprdetsimg=mysqli_query($con1,"select * from Productviewimg where product_id='".$lat1['code']."' and category='".$lat1['category']."' ");
        $prdrwsimg=mysqli_fetch_array($getprdetsimg);
   
      
      $gtdsct=mysqli_query($con1,"select distance from merchantdetsm where merchant_id='".$prdrws['ccode']."'");
      $dstrws=mysqli_fetch_array($gtdsct);
      
      
      $insqrtl=mysqli_query($con1,"INSERT INTO `slider_location_dets`(`city_id`, `slot_id`, `slot_pos`, `user_id`, `pid`, `entrydt`,category) VALUES ('".$livecityid."','".$sliderid."','".$ca."','".$prdrws['ccode']."','".$prdrws['code']."','".$todaysdtt."','".$prdrws['category']."')");
      
      
      $detsarr[$ca]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>"",'distance'=>$dstrws[0]];
   }
   
   $clintarindx++;
  }
  
    }
    }

}     
    $slides=1;
    $cnt=1;
    $itemcount=1;
     $itr=0;
while($slides<=2)
{
?>
<div class="item  products-block">
<div class="row products-row last">
 <?php
$nm=1;



for($a=0;$a<2;$a++)
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
      </br>
        <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>&catid=<?php echo $detsarr[$itr]['category'];?>"><p class="c"><?php echo $detsarr[$itr]['name'];?></p></a></h6>
         
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
             
  
</div>





							    </div>

            
            <?php
        }
$nm++;
$cnt++;
 $itr++;
} ?>

														</div>																		</div>

<?php

$slides++;
}


?>
 




			  			</div>
	</div>