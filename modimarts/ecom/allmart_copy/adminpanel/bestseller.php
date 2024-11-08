<?php 
include("config.php");
$sliderid="4";
$slidername="bestseller";
$slidertablename="top_right_slider";


//print_r($slotarr);
  //echo in_array("1", $slotarr);
  if($_SESSION['id']!="")
  {
}
//echo $qrylatf2;
$gtbkid=mysql_query("select * from advertise_booking where dt='".date("Y-m-d")."' and slot='".$sliderid."'");
$nrts=mysql_num_rows($gtbkid);
$bkit=0;//----0 is for admin---//
if($nrts>0)
{
    $frt=mysql_fetch_array($gtbkid);
    $bkit=$frt[0];
    
    
}

?>

<div class="list box-products owl-carousel-play panel-body block-content bg-white" id="product_list500423425"  data-ride="owlcarousel" >
						<div class="carousel-controls">
				<a class="carousel-control left center" href="#product_list500423425"   data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="carousel-control right center" href="#product_list500423425"  data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
						<div class="owl-carousel product-grid"  data-show="1" data-pagination="false" data-navigation="true">



					<?php
    $detsarr=array();
    
   
    for($ca=0;$ca<=4;$ca++)
    {
         
          $avilfrupdt=0;
   
       $qravdm=mysql_query("select * from advertise_booking where  slot='".$sliderid."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysql_num_rows($qravdm);
    
   
    $bkit=0;
   if($qspbkd==0)
   {
      $avilfrupdt="1";
       
   } else
   {
       $avilfrupdt="0";
     
       
   }  
       
      
    
        $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid."' and slot_pos='".$ca."' and user_id='".$_SESSION["id"]."'  and stats='0'";
        
$qrylatfrws=mysqli_query($con3,$qrylatf2); 
$latstprnrws=mysqli_num_rows($qrylatfrws);

if($latstprnrws>0)
{
   $lat1=mysqli_fetch_array($qrylatfrws);
   
   
    $getprdets=mysqli_query($con3,"select * from Productviewtable where code='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
      
      
        $getprdetsimg=mysqli_query($con3,"select * from Productviewimg where product_id='".$lat1['pid']."' and category='".$lat1['cat']."' ");
      $prdrwsimg=mysqli_fetch_array($getprdetsimg);
    
   
   
    
   
   $avilfrupdt=0;
   
   if($bkit==0)
   {
      $avilfrupdt="1";//---$bkit==0 is booking id 0 which is of admin-----//
       
   }
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrwsimg['img'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id'],'avail'=>$avilfrupdt];
    
    
}else
{
      
 
    
    
   $detsarr[]=['code'=>"0",'avail'=>$avilfrupdt];
  
}
        
 //  print_r($detsarr)."<>";     
        
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
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>">
            <img class="img-responsive" src="<?php echo "../".$prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style="height:150px; width: 100%;
  object-fit: contain"  onerror="this.onerror=null;this.src='images/noimg.png';" />
          </a>          
          <div class="compare hover-icon">     
          
          </div>  
                  
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
          
            <?php 
            
            if($detsarr[$itr]['avail']==1)
            {
            ?>
            
              <div>
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername.$itr;?>" id="<?php echo $slidername.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
              <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="saledelfun('<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Delete</span>
              </button>
              </div>
              <?php } ?>
              
                <div class="action">
                      <div class="cart">            
               
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
<!--<div class="image">
        
        <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
              
             
            <img class="img-responsive" src="images/noimg.png" title="" style=" width: 100%;
  height: 150px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
            
               
          </div>  
                 
        </div>
      </div>-->
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"></a></h6>
         
        <p class="description">.....</p>
        
                   <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span>  
             <?php } ?>
            
                  </div>
                  </div>
          <?php
          
           if($detsarr[$itr]['avail']==1)
        {
            ?>
              <div>
                     
                 <!--==========================================-->
                <div class="image">
        <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
           <img class="img-responsive" src="images/noimg.png" title="" style=" width:100%; height: 150px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
         </div>  
        </div>
    </div>
          
           <!--==========================================-->  
                 
                  
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername.$itr;?>" id="<?php echo $slidername.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
             
              </div>
              <?php } else{ ?>
                 <!--==========================================-->
               <div class="image">
       <div class="product-img img">
          <a class="img" title="" href="javacript:void(0);">
           <img class="img-responsive" src="images/booked.png" title="" style=" width: 100%;
  height: 150px;object-fit: contain"  />
          </a>          
          <div class="compare hover-icon">     
         </div>  
        </div>
        </div>
        
      
               <!--==========================================-->  
                 
                 
                  <?php }?>
               
 
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
} ?>
 




			  			</div>
	</div>