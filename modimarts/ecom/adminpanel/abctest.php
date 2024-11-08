<?php 
include("config.php");
$qrylatf="select * from latest_featured_product where typ=1 order by id asc";
$qrylatfrws=mysqli_query($con3,$qrylatf);   
$latstprnrws=mysqli_num_rows($qrylatfrws);

  $detsarr=array();
    
    while($lat1=mysqli_fetch_array($qrylatfrws))
    {
    //echo "select * from products where code='".$lat1['product_id']."'";
    $getprdets=mysqli_query($con3,"select * from products where code='".$lat1['product_id']."' ");
      $prdrws=mysqli_fetch_array($getprdets);
    if($prdrws['code']!="")
    {
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrws['photo'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt'],'updtid'=>$lat1['id']];
    }
        
    }
    
    //print_r($detsarr);
    
   // echo "ok".$detsarr[0]["code"];
    $cnt=1;
    $itemcount=1;
    $itr=0;

    for($a=0;$a<count($detsarr);$a++)
    {
        if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
    {
    
    ?>	
    <div class="item ">
<div class="row box-product">

<?php
$nm=1;

while($nm!=5)
    {
      
      if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
        {
        ?>
<div class="col-lg-3 col-xs-12 col-sm-3 product-col">
									     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="javascript:void(0);" >
            <img class="img-responsive" src="<?php echo "../".$prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" alt=""  style='height:250px; width: 100%; object-fit: contain'/>
          </a>          
          <!--<div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="comparefunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>"  title="Quick View" ><i class="fa fa-arrows-alt"></i>
              </a>
              
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="<?php echo $detsarr[$itr]['name'];?>"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div> -->         
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
        <p class="description"><?php echo $prdrws['description']; ?></p>
        
              
             <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span> 
             <?php } ?>
             <br/>
             </div>
            
            <div>Product Id:<input style="width:60%;text-align:center" type="text" name="latest<?php echo $cnt;?>" id="latest<?php echo $cnt;?>" value="<?php echo $detsarr[$itr]['code'];?>" onkeypress='return validateQty(event);'></div>
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="updtfn('<?php echo $detsarr[$itr]['updtid'];?>','latest','1','<?php echo $cnt;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Update</span>
              </button>
              <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="delfun('<?php echo $detsarr[$itr]['updtid'];?>','1');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Delete</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





									    </div>

	<?php 
        $itr++;
            
        }else
        {
           ?> 
            
            <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
									     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="" href="javascript;void(0)" >
            <img class="img-responsive" src="images/noimg.png" title="" alt=""  style='height:250px; width: 100%; object-fit: contain'/>
          </a>          
          <!--<div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="comparefunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href=""  title="Quick View" ><i class="fa fa-arrows-alt"></i>
              </a>
              
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="<?php echo $detsarr[$itr]['name'];?>"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div> -->          
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
        <p class="description"><?php echo $prdrws['description']; ?></p>
        
              
             <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span> 
             <?php } ?></div>
             <div>Product Id:<input style="width:60%;text-align:center" type="text" name="latest<?php echo $cnt;?>" id="latest<?php echo $cnt;?>" value="" onkeypress='return validateQty(event);'></div>
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="updtfn('','latest','1','<?php echo $cnt;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Update</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





									    </div>
            
            <?php
        }
	$cnt++;
	$nm++;
	} 
	
	?>								    
									    
									    
</div>
</div>
    <?php
    
        $itemcount++;
    }
    
    } ?>
    
    <?php while($itemcount<3)
    {?>
    
    <div class="item ">
<div class="row box-product">

<?php
$nm=1;

while($nm!=5)
    {
      
     
           ?> 
            
            <div class="col-lg-3 col-xs-12 col-sm-3 product-col">
									     
<div class="product-block">

          
      <div class="image">
        
        <div class="product-img img">
          <a class="img" title="" href="javascript;void(0)" >
            <img class="img-responsive" src="images/noimg.png" title="" alt=""  style='height:250px; width: 100%; object-fit: contain'/>
          </a>          
          <!--<div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="comparefunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href=""  title="Quick View" ><i class="fa fa-arrows-alt"></i>
              </a>
              
              </div>
               
          </div> --> 
          <!--<div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="<?php echo $detsarr[$itr]['name'];?>"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div> -->          
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="javascript:void(0);"><?php echo $detsarr[$itr]['name'];?></a></h6>
         
        <p class="description"><?php echo $prdrws['description']; ?></p>
        
              
             <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $detsarr[$itr]['total_amt'];?></span>
            <?php if($detsarr[$itr]['discount']>0){?>
            <span class="price-old"><?php echo $detsarr[$itr]['price'];?></span> 
             <?php } ?></div>
             <div>Product Id:<input style="width:60%;text-align:center" type="text" name="latest<?php echo $cnt;?>" id="latest<?php echo $cnt;?>" value="" onkeypress='return validateQty(event);'></div>
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="updtfn('','latest','1','<?php echo $cnt;?>');">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Update</span>
              </button>
            </div>
                  </div>     
  </div>  
</div>





									    </div>
            
            <?php
	$cnt++;
	$nm++;
	} 
	
	?>								    
									    
									    
</div>
</div>
    
    <?php 
    $itemcount++;
    } ?>
  