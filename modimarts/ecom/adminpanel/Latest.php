<?php 
include("config.php");

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
?>


<div class="tab-v5 ">
    
  		<div class="tab-heading">
    
    
   
            <ul role="tablist" class="nav nav-tabs" id="product_tabs126552099">
            		               
            		                <li>
	                    <a data-toggle="tab" role="tab" href="#tab-latest126552099" onclick='shdv("lat")' id="tab1" aria-expanded="true"><i class="fa "></i>Latest</a>
	                    
	                     
	                </li>
	               
	            	                <li>
	                    <a data-toggle="tab" role="tab" href="#tab-featured126552099" onclick='shdv("feat")' aria-expanded="true"><i class="fa "></i>Featured</a>
	                </li>
	               
	            	                <li>
	                    <a data-toggle="tab" role="tab" href="#tab-special126552099" onclick='shdv("spec")' aria-expanded="true"><i class="fa "></i>Special</a>
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
       $qravdm=mysql_query("select * from advertise_booking where  slot='".$sliderid1."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysql_num_rows($qravdm);
    
   
    $bkit1=0;
   if($qspbkd==0)
   {
      $avilfrupdt="1";
      $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid1."' and slot_pos='".$ca."' and user_id='".$_SESSION["id"]."'  and stats='0'";
       
   } else
   {
       $ftrw=mysql_fetch_array($qravdm);
       $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid1."' and slot_pos='".$ca."' and user_id='".$ftrw["merchant_id"]."'  and stats='0'";
       $avilfrupdt="0";
     
       
   }  
       
      
    
        
        
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
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername1.$itr;?>" id="<?php echo $slidername1.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid1;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername1; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
              <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="saledelfun('<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername1; ?>');">
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
                 
                  
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername1.$itr;?>" id="<?php echo $slidername1.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid1;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername1; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
             
              </div>
              <?php }  else{ ?>
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
   
       $qravdm=mysql_query("select * from advertise_booking where  slot='".$sliderid2."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysql_num_rows($qravdm);
    
   
    $bkit2=0;
   if($qspbkd==0)
   {
      $avilfrupdt="1";
      $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid2."' and slot_pos='".$ca."' and user_id='".$_SESSION["id"]."'  and stats='0'";
       
   } else
   {
       $ftrw=mysql_fetch_array($qravdm);
       $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid2."' and slot_pos='".$ca."' and user_id='".$ftrw["merchant_id"]."'  and stats='0'";
       $avilfrupdt="0";
     
       
   }    
      
      

        
        
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
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername2.$itr;?>" id="<?php echo $slidername2.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid2;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername2; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
              <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="saledelfun('<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername2; ?>');">
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
                  
                  
                  
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername2.$itr;?>" id="<?php echo $slidername2.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid2;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername2; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
             
              </div>
              <?php }  else{ ?>
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
   
       $qravdm=mysql_query("select * from advertise_booking where  slot='".$sliderid3."' and slot_pos='".$ca."' and dt='".date("Y-m-d")."'");
       $qspbkd=mysql_num_rows($qravdm);
    
   
    $bkit2=0;
   if($qspbkd==0)
   {
      $avilfrupdt="1";
      $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid3."' and slot_pos='".$ca."' and user_id='".$_SESSION["id"]."'  and stats='0'";
       
   } else
   {
       $ftrw=mysql_fetch_array($qravdm);
       $qrylatf2="select id,pid,cat from top_right_slider where  slot_id='".$sliderid3."' and slot_pos='".$ca."' and user_id='".$ftrw["merchant_id"]."'  and stats='0'";
       $avilfrupdt="0";
     
       
   }    
      
      

        
        
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
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername3.$itr;?>" id="<?php echo $slidername3.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid3;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername3; ?>','<?php echo $itr;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="">Update</span>
              </button>
              <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="saledelfun('<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername3; ?>');">
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
                  
                  <input style="width:60%;text-align:center;display:none" type="text" name="<?php echo $slidername3.$itr;?>" id="<?php echo $slidername3.$itr;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'>
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="srchfsnchw('<?php echo $sliderid3;?>','<?php echo $detsarr[$itr]['updtid'];?>','<?php echo $slidername3; ?>','<?php echo $itr;?>');">
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