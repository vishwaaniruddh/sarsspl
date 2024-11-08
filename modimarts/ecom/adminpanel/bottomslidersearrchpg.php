<?php 
include("config.php");
$qrylatf="select * from deals_of_the_day";
$qrylatfrws=mysqli_query($con3,$qrylatf); 
echo mysqli_error($con3);
$latstprnrws=mysqli_num_rows($qrylatfrws);

    $detsarr=array();
    
    while($lat1=mysqli_fetch_array($qrylatfrws))
    {
    //echo "select * from products where code='".$lat1['product_id']."'";
    $getprdets=mysqli_query($con3,"select * from products where code='".$lat1['product_id']."'");
      $prdrws=mysqli_fetch_array($getprdets);
    
$detsarr[]=['code'=>$prdrws['code'],'name'=>$prdrws['name'],'ccode'=>$prdrws['ccode'],'description'=>$prdrws['description'],'category'=>$prdrws['category'],'photo'=>$prdrws['photo'],'price'=>$prdrws['price'],'discount'=>$prdrws['discount'],'discount_type'=>$prdrws['discount_type'],'total_amt'=>$prdrws['total_amt']];
    }
 $itr=0;
  for($a=0;$a<count($detsarr);$a++)
    {
         if($detsarr[$itr]["code"]>0 and $detsarr[$itr]["code"]!="")
    {
    
    ?>	
   
 
<div class="item  products-block">
<div class="row products-row last">
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
          <a class="img" title="<?php echo $detsarr[$itr]['name'];?>" href="details.php?prid=<?php echo $detsarr[$itr]['code'];?>">
            <img class="img-responsive" src="<?php echo "../".$prodimgpth.$detsarr[$itr]['photo'];?>" title="<?php echo $detsarr[$itr]['name'];?>" style=" width: 100%;
  height: 230px;object-fit: contain" alt="new pant" />
          </a>          
          <div class="compare hover-icon">     
             <!-- <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Edit" onclick="window.open("editbottomslider.php","_self","width=200,height=100")"><i class="fa fa-exchange"></i></button>-->
                           <!-- <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>"  title="Quick View" ><i class="fa fa-arrows-alt"></i></a>
              </div>-->
               
          </div>  
         <!-- <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $detsarr[$itr]['code'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$detsarr[$itr]['photo'];?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="new pant"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div> -->          
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
          
            
                <div class="action">
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
      $itr++;      
        } 
$nm++;
} ?>

														</div>																		</div>

<?php
    }
    
    //$itr++;
    } ?>