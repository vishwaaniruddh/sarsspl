<?php
session_start();
include('config.php');
$strPage = $_POST['Page'];
$mdi=$_POST['mdi'];
$sts=$_POST['sts'];
$catids=$_POST['catids'];
$sort=$_POST['sortby'];
//echo 'mdi'.$mdi.'cid :'.$catids;

//============ query for get category which under in '0'==========

$qrya="select * from main_cat where id='".$catids."'";
//echo $qrya;
 $resulta=mysql_query($qrya);
 $rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];
//echo $aa;
   
if($aa!=0){
    $qrya1="select * from main_cat where id='".$aa."'";
    $resulta1=mysql_query($qrya1);
    $rowa1 = mysql_fetch_row($resulta1);
    $Maincate= $rowa1[4];
} ;
//echo $Maincate;
//==============================================================
/*Ruchi */
if($_POST["minv"]!="" && $_POST["maxv"]!=""){
    $min_total_amt = $_POST["minv"];
    $max_total_amt = $_POST["maxv"];
    
    //$View.= " and total_amt>='".$_POST["minv"]."'  and  total_amt<='".$_POST["maxv"]."'";
} else {
    $min_total_amt = 0;
    $max_total_amt = 150000;
}

if($Maincate==1){
    //$View="SELECT * FROM `fashion` where 1 and category in ($catids) and status=1"; //old
    //"select p.* from (select * from fashion where category ='".$mdi."' and status=1 order by price ) as p group by p.name"
    //select p.* from (select * from fashion where category ='65' and status=1 and total_amt>='0' and total_amt<='150000' order by price ) as p group by p.name
     $View="select p.* from (select * from fashion where category ='".$mdi."' and status=1 order by price ) as p group by p.name";
}
else if($Maincate==190)
{
    //$View="SELECT * FROM `electronics` where 1 and category in ($catids) and status=1";
    $View="select p.* from (select * from electronics where category ='".$mdi."' and status=1 order by price ) as p group by p.name";
} 
 else if($Maincate==218)
{
    //$View="SELECT * FROM `grocery` where 1 and category in ($catids) and status=1";
    $View="select p.* from (select * from grocery where category ='".$mdi."' and status=1 order by price ) as p group by p.name";
} 
 else 
{
    //$View="SELECT * FROM `products` where 1 and category in ($catids) and status=1";
    /*$View="select p.* from (select * from products where category ='".$mdi."' and status=1 order by price ) as p group by p.name";*/
    $View="select p.* from (select pm.product_model,pm.category_id,pd.code,pd.ccode,pd.price,pd.total_amt,pd.name from product_model as pm join products as pd on pm.id=pd.name where pm.category_id ='".$mdi."' and pm.status=1 and total_amt>='".$min_total_amt."'  and  total_amt<='".$max_total_amt."' order by pd.price ) as p group by p.product_model";
    //echo "select p.* from (select pm.product_model,pm.category_id,pd.price from product_model as pm join products as pd on pm.id=pd.name where pm.category_id ='".$mdi."' and status=1 order by pd.price ) as p group by p.product_model";
} 
/*if($_POST["minv"]!="" && $_POST["maxv"]!=""){ 
    $min_total_amt = $_POST["minv"];
    $max_total_amt = $_POST["maxv"];
    $View.= " and total_amt>='".$_POST["minv"]."'  and  total_amt<='".$_POST["maxv"]."'";
}*/
//echo $View;
$table=mysqli_query($con1,$View);
$Num_Rows =mysqli_num_rows($table);
//echo $Num_Rows;
?>
<!--<div align="center" style="display:none" >
 Records Per Page :
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 </div>0-->
<?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
//echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
    $Page=1;
}
$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
	
if($sort!="")
{
  if($sort==1)
  {
    $View.=" ORDER BY product_model ASC ";
  }
  elseif($sort==2)
  {
      $View.=" ORDER BY product_model desc ";
      
  }
  elseif($sort==3)
  {
      $View.=" ORDER BY total_amt ASC ";
      
  }
  elseif($sort==4)
  {
      $View.=" ORDER BY total_amt DESC ";
  }
}
    //$View.=" ORDER BY cust ASC ";
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysqli_query($con1,$View);
	echo $View;
	?>
<div id="products" class="product-grid">
	<div class="products-block block-content">
		<div class="row products-row">
			<input type="hidden" name="nmrws" id="nmrws" value="<?php echo $Num_Rows;?>">		    
			<input type="hidden" name="perpgforfunc" id="perpgforfunc" value="<?php echo $Per_Page;?>">	
<?php
$ct=mysqli_num_rows($qrys);
/*$n="";

if($ct<20)
{
    $n='2';
    
}
else if($ct<40){
    
    $n='3';
}
else if($ct<60){
    
    $n='4';
}
else if($ct<100){
    
    $n='5';
}
else{$n='1';}

for($i=0;$i<$n;$i++)
    {
        */
$qrys1=mysqli_query($con1,$View);
while($rwss=mysqli_fetch_array($qrys1))
{
    //var_dump($rwss);
    //$data = getimagesize(trim($prodimgpth.$rwss['photo']));
//$width = $data[0];
//$height = $data[1];

if($Maincate==1){
$slting=mysql_query("SELECT img FROM `fashion_img` where product_id='".$rwss['code']."' limit 0,1");
}
else if($Maincate==190)
{
    $slting=mysql_query("SELECT img FROM `electronics_img` where product_id='".$rwss['code']."' limit 0,1");
}
else if($Maincate==218)
{
    $slting=mysql_query("SELECT img FROM `grocery_img` where product_id='".$rwss['code']."' limit 0,1");
}
else
{
    $slting=mysql_query("SELECT img FROM `product_img` where product_id='".$rwss['code']."' limit 0,1");
}

$sltingf=mysql_fetch_array($slting);
$imgfd=$sltingf[0];

?>
<div class="col-lg-2 col-md-2 col-md-2 col-sm-2 col-xs-12 product-col product-layout product-grid">
    <div class="product-block">
        <div class="image">
            <div class="product-img img">
                <a class="img" title="<?php echo $rwss['product_model'];?>" href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category_id'];?>&prod_id=<?php echo $rwss['name'];?>">
                <center></center>  <img class="img-responsive" src="<?php echo trim($prodimgpth.$imgfd);?>" title="<?php echo $rwss['name'];?>" alt=""
          style='height:150px; width: 100%; object-fit: contain'/></center>
          </a>          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product"
              onclick="comparefunc('<?php echo $rwss['code'];?>','<?php echo $rwss['category_id'];?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category_id'];?>&prod_id=<?php echo $rwss['name'];?>"  title="View" >
                  <i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $rwss['code'];?>','<?php echo $rwss['category_id'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
              <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$imgfd;?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="<?php echo $rwss['product_model'];?>"><i class="fa fa-search-plus"></i></a>
            </div> 
          </div>           
        </div>
      </div>
             
             <style>
     p.b {
    white-space: nowrap; 
    width: 179px; 
    overflow: hidden;
    text-overflow: ellipsis; 
    text-align:center;
   /* border: 1px solid #000000;*/
}
     </style>   
     
 <?php 
    //ruchi Get product name by id
    /*$prod = mysql_query("SELECT product_model FROM product_model where id='".$rwss['name']."'");
    $product_name = mysql_fetch_assoc($prod);*/
    /*//ruchi Get brand name by id
    $brand = mysql_query("SELECT brand FROM brand where id='".$row['brand']."'");
    $brand_name = mysql_fetch_assoc($brand);*/
 ?>
     
     
  <div class="product-meta">
        <h5 class="name" style="width: 178px;padding-top: 20px;">
            <p class="b" style="width:146px"><b >
                <a href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category_id'];?>&prod_id=<?php echo $rwss['name'];?>" style="font-size:16px;"><?php echo $rwss['product_model'];?></a></b></p></h5>
         
      <!--  <p class="description"><?php echo $rwss['description'];?></p>-->
        
                              
                               <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $rwss['total_amt'];?></span>
            <?php if($rwss['discount']>0){?>
            <span class="price-old"><?php echo $rwss['price'];?></span> 
             <?php } ?>
           
                  </div>
                <div class="action">
                  <div class="cart">            
                    <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $rwss['code'];?>','<?php echo $catids?>')">
                      <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
                    </button>
                  </div>
                </div>     
  </div>  
</div>





		</div>
		
		<?php }
		//}
		?>
							
				</div>
					</div>
</div>


<div class="pagination-link paging clearfix">

    
</div>
<style>
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
   
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
}

.pagination a.active {
    background-color: #00a9e0;
    color: white;
    border: 1px solid #00a9e0;
}
.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<center>
<!--<div class="pagination" style="margin-top:30px;">


<?php
if($Num_Rows>0)
{


echo " <a href=\"JavaScript:funcs('1','perpg')\"> <<</a> ";

 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:funcs('$Prev_Page','perpg')\"> < </a> ";

 }
else 
{
    echo " <a href=\"JavaScript:void(0)\"><</a> ";
}

//$Num_Pages=5;

if($Page>=6)
{
$pg=$Page+1;
$pgstrt=$Page-3;
}
else
{

$pg=6;
$pgstrt=1;

}


//echo $pgstrt."---".$pg;
 for($i=$pgstrt;$i<=$pg;$i++)
 {
if($i<=$Num_Pages)
{
 ?>
  <a href="JavaScript:void(0)" class="<?php if($Page==$i){echo "active";}?>" onclick="funcs('<?php echo $i; ?>','perpg','<?php echo $src; ?>')" ><?php echo $i; ?></a>
 
<?php 
}
} ?>

<?php
if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:funcs('$Next_Page','perpg','$src')\">></a> ";
}
else
{
echo " <a href=\"JavaScript:void(0)\">></a> ";
}


echo " <a href=\"JavaScript:funcs('$Num_Pages','perpg','$src')\"> >></a> ";

?>
   
</div>   -->
</div>


<!--<div class="pagination" style="width:100%;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:funcs('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:funcs('$Next_Page','perpg')\">Next >></a> ";
}

}else
{
    echo "No products found";
}
?>
	
</div>

</center>