<?php
session_start();
include('config.php');
$srchtxt=$_REQUEST["srchtxt"];
$strPage = $_REQUEST['Page'];
$sort=$_REQUEST['sortby'];
$minv=$_REQUEST['minv'];
$maxv=$_REQUEST['maxv'];
  
if($srchtxt!="")
{
$View="SELECT * FROM Productviewtable where status='1' ";

$View.= " and (name like'%".$srchtxt."%' or  description like'%".$srchtxt."%' or product_type like'%".$srchtxt."%' or brand like'%".$srchtxt."%' or keyword1 like'%".$srchtxt."%')";

	if($_POST["minv"]!="" && $_POST["maxv"]!="")
	{
$View.= " and total_amt>='".$minv."'  and  total_amt<='".$maxv."'";
    }

//$View.="order by code asc,";
	
	
if($sort!="")
{
  if($sort==1)
  {
      $View.=" order by name ASC ";
  }
  elseif($sort==2)
  {
      $View.=" order by name desc ";
  }
  elseif($sort==3)
  {
      $View.=" order by total_amt ASC ";
  }
  elseif($sort==4)
  {
      $View.=" order by total_amt DESC ";
  }
}
else{
    
    $View.="order by code asc,";
}
echo $View;
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
$Per_Page =$_REQUEST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}

if($Per_Page=="")
{
    
    $Per_Page="10";
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







//$View.=" ORDER BY cust ASC ";

	
	
	
	$View.=" LIMIT $Page_Start , $Per_Page";
//	echo $View;
	
	$qrys=mysqli_query($con1,$View);
//	echo $View;
echo mysqli_error($con1);	
	
	
	
	
	
	if($reqstats==1)//if request iss from android only echo json 
{
    
    $rows = array();

    while($rwss=mysqli_fetch_array($qrys))
{
    

$rows[] = ['code'=>$rwss['code'],'name'=>$rwss['name'],'photo'=>trim($prodimgpth.$rwss['photo']),'total_amount'=>$rwss['total_amt']];



}

echo json_encode($rows);
    
    
}else
{
	?>
	


<div id="products" class="product-grid">
	<div class="products-block block-content" style="padding-top: 50px;" >
	    
	    
						<div class="row products-row">
				<input type="hidden" name="nmrws" id="nmrws" value="<?php echo $Num_Rows;?>">		    
				<input type="hidden" name="perpgforfunc" id="perpgforfunc" value="<?php echo $Per_Page;?>">		    
			
						    
<?php 
$rows = array();


while($rwss=mysqli_fetch_array($qrys))
{
   

$rows[] = $rwss;
$newh=0;
if($height>350)
{
   $newh="350px";
    
}else
{
   $newh= $height."px";
}
 
    $Viewimg="SELECT * FROM Productviewimg where 1 and product_id='".$rwss['code']."' and category='".$rwss['category']."'";

    $tableimg=mysqli_query($con1,$Viewimg);
   $Pimg= mysqli_fetch_array($tableimg);

    
?>
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 product-col product-layout product-grid" >
<div class="product-block">
<div class="image">
        
        <div class="product-img img">
          <!--<a class="img" title="<?php echo $rwss['name'];?>" href="details.php?prid=<?php echo $rwss['code'];?>">
              
             <center></center> 
             <img class="img-responsive" src="<?php echo trim($prodimgpth.$rwss['photo']);?>" title="<?php echo $rwss['name'];?>" alt="" 
             style='height:350px; width: 100%; object-fit: contain'/></center>
          </a>   -->  
          <a class="img" title="<?php echo $rwss['name'];?>" href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category'];?>">
              
             <center></center> 
             <img class="img-responsive" src="<?php echo trim($Pimg['midsize']);?>" title="<?php echo $rwss['name'];?>" alt="" 
             style='height:150px; width: 100%; object-fit: contain'/></center>
          </a> 
          
          <div class="compare hover-icon">     
              <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Compare this Product" onclick="comparefunc('<?php echo $rwss['code'];?>','<?php echo $rwss['category'];?>');"><i class="fa fa-exchange"></i></button>
                            <div class="quickview hidden-xs hidden-sm">
              <a class="iframe-link btn btn-default" data-toggle="tooltip" data-placement="top" href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category'];?>"  title="View" ><i class="fa fa-arrows-alt"></i></a>
              </div>
               
          </div>  
          <div class="wishlist hover-icon">
            <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Add to Wish List" onclick="wishlistfunc('<?php echo $rwss['code'];?>');"><i class="fa fa-heart"></i></button>
            <div class="zoom hidden-xs hidden-sm">
                          <a data-toggle="tooltip" data-placement="top" href="<?php echo $prodimgpth.$rwss['photo'];?>" class="product-zoom btn btn-default info-view colorbox cboxElement" title="<?php echo $rwss['name'];?>"><i class="fa fa-search-plus"></i></a>
                        </div> 
          </div>           
        </div>
      </div>
             
  <div class="product-meta">
        <h6 class="name"><a href="details.php?prid=<?php echo $rwss['code'];?>&catid=<?php echo $rwss['category'];?>"><?php echo $rwss['name'];?></a></h6>
         
      <!--  <p class="description"><?php echo $rwss['description'];?></p>-->
        
                              
                               <div class="price">
                      <span class="price-new"><i class="fa fa-inr"></i> <?php echo $rwss['total_amt'];?></span>
            <?php if($rwss['discount']>0){?>
            <span class="price-old"><?php echo $rwss['price'];?></span> 
             <?php } ?>
            
                  </div>
          
          
            
                <div class="action">
                      <div class="cart">            
               <button data-loading-text="Loading..." class="btn btn-default" type="button" onclick="addcart('<?php echo $rwss['code'];?>','<?php echo $rwss['category']?>')">
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart</span>
              </button>
              
            <!--  <?php echo $rwss["merchant_id"]."distance : ".$rwss["distance"];?>-->
            </div>
                  </div>     
  </div>  
</div>





		</div>
		
		<?php } ?>
							
				</div>
					</div>
</div>

<?php 



//echo json_encode($rows); 

?>

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
<div class="pagination" style="margin-top:30px;">


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
   
</div>   
</div>


<div class="pagination" style="width:100%;" align="center"><font size="4" color="#000">
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
<?php 

}
    
}else
{
    echo "NO Product";
}

 ?>