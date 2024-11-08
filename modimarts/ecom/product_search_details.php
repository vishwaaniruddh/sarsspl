<?php
session_start();
include('config.php');
include 'getlocationforsearch.php';

if($_REQUEST['latitude']!="")
{
$lat1 =floatval($_REQUEST['latitude']);
$lon1= floatval($_REQUEST['longitude']);
$reqstats="";

if($_REQUEST['reqstats']!="")
{
   $reqstats=1; //means it is from android
    
}


$srchtxt=$_REQUEST["srchtxt"];
$strPage = $_REQUEST['Page'];
$sort=$_REQUEST['sortby'];


$livecityid=0;
$livecitynm="";


  $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat1).','.trim($lon1).'&sensor=false';
    $json = @file_get_contents($url);
   // $data = json_decode($json);
   $status = $data->status;

 $output= json_decode($json);

    for($j=0;$j<count($output->results[0]->address_components);$j++){
        
        if($output->results[0]->address_components[$j]->types[0]=="locality")
                {
                    
                  $livecitynm=$output->results[0]->address_components[$j]->long_name;
                    
                }
               
            }

//echo $livecitynm;
/*$PublicIP = get_client_ip(); 
 $json2  = file_get_contents("https://freegeoip.net/json/$PublicIP");
 $json2  =  json_decode($json2 ,true);
p

$livecityid=0;
$livecitynm="";
for($j=0;$j<count($data->results[0]->address_components);$j++){
               // echo '<b>'.$data->results[0]->address_components[$j]->types[0].': </b>  '.$data->results[0]->address_components[$j]->long_name.'<br/>';
                
                
                if($data->results[0]->address_components[$j]->types[0]=="locality")
                {
                    
                  $livecitynm=$data->results[0]->address_components[$j]->long_name;
                    
                }
            }

/*if($status == "OK"){
        //get address from json data
        $location = $data->results[0]->formatted_address;
        echo $location;
    }else{
        $location =  '';
    }*/
    
   // echo "select code FROM `cities` where name='".$livecitynm."'"; 
$gtstateid=mysqli_query($con1,"select code FROM `cities` where name='".$livecitynm."'");
$nrtm=mysqli_num_rows($gtstateid);
if($nrtm>0)
{
    
    $frtrs=mysqli_fetch_array($gtstateid);
    $livecityid=$frtrs["code"];
}


$maketemp1 = "CREATE TEMPORARY TABLE merchantdets(merchant_id int,distance float(10,2),latitude varchar(500),longitude varchar(500))"; 

 $exec1=mysqli_query($con1,$maketemp1);
 
 $maketempf = "CREATE TEMPORARY TABLE merchantdetsf(merchant_id int,distance float(10,2),code int,name varchar(550),description varchar(250),category varchar(500),category_name varchar(500), price float(10,2),discount float(10,2),total_amt float(10,2),photo varchar(500))"; 

 $execf=mysqli_query($con1,$maketempf);
echo mysqli_error();
$cidsarry=array();
//echo "select code from clients where city='".$livecityid."'";
$gtcls=mysqli_query($con1,"select code,Latitude,Longitude from clients where city='".$livecityid."'");
$nrtss=mysqli_num_rows($gtcls);
if($nrtss>0)
{
    while($frclts=mysqli_fetch_array($gtcls))
    {
    
    $lat2=$frclts["Latitude"];
    $lon2=$frclts["Longitude"];
    
    //echo $lat1."---".$lon1."---".$lat2."---".$lon2."</br>";
    $dist=distance($lat1, $lon1, floatval($lat2), floatval($lon2), "K");
    
    
    
    
    
    
    
  $insr=mysqli_query($con1,"insert into merchantdets(merchant_id,distance,latitude,longitude) values ('".$frclts["code"]."','".$dist."','".$lat2."','".$lon2."')");
 
  echo mysqli_error();
    }
}




/*$getall=mysqli_query($con1,"select * from merchantdets order by distance asc");
while($re=mysqli_fetch_array($getall))
{

echo $re[0]."--".$re[1]."--".$re[2]."--".$re[3]."</br>";

}*/

$getall=mysqli_query($con1,"select * from merchantdets order by distance asc");
while($re=mysqli_fetch_array($getall))
{
    

     $gtallrds=mysqli_query($con1,"select * from Productviewtable where ccode='".$re["merchant_id"]."'");
    
    while($prrws=mysqli_fetch_array($gtallrds))
    {
    
    $gtcatnm=mysqli_query($con1,"select * from main_cat where id='".$prrws["category"]."'");
    $ftchnmer=mysqli_fetch_array($gtcatnm);
  
        $insr=mysqli_query($con1,"insert into merchantdetsf(merchant_id,distance,code,name,category,category_name,price,discount,total_amt,photo,description) values ('".$re["merchant_id"]."','".$re["distance"]."','".$prrws["code"]."','".mysqli_real_escape_string($prrws["name"])."','".mysqli_real_escape_string($prrws["category"])."','".mysqli_real_escape_string($ftchnmer["name"])."','".$prrws["price"]."','".$prrws["discount"]."','".$prrws["total_amt"]."','".$prrws["photo"]."','".mysqli_real_escape_string($prrws["description"])."')");
        
 //echo "insert into merchantdetsf(merchant_id,distance,code,name,category,category_name,price,discount,total_amt,photo,description) values ('".$re["merchant_id"]."','".$re["distance"]."','".$prrws["code"]."','".mysql_real_escape_string($prrws["name"])."','".mysql_real_escape_string($prrws["category"])."','".mysql_real_escape_string($ftchnmer["name"])."','".$prrws["price"]."','".$prrws["discount"]."','".$prrws["total_amt"]."','".$prrws["photo"]."','".mysql_real_escape_string($prrws["description"])."')";
 if(!$insr)
 {
     echo mysqli_error()."</br>";
     
     
 }
        
    }
}
//print_r($cidsarry);












$View="SELECT * FROM Productviewtable where 1 and status='1' ";
  

if($srchtxt!="")
{


$View.= " and name like'%".$srchtxt."%' or  description like'%".$srchtxt."%' or product_type like'%".$srchtxt."%' or brand like'%".$srchtxt."%'";

}

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

$View.="order by code asc,";

	
if($sort!="")
{
  if($sort==1)
  {
      $View.=" name ASC ";
      
  }
    
  elseif($sort==2)
  {
      $View.=" name desc ";
      
  }
  elseif($sort==3)
  {
      $View.=" total_amt ASC ";
      
  }
  elseif($sort==4)
  {
      $View.=" total_amt DESC ";
      
  }
}

//$View.=" ORDER BY cust ASC ";

	
	
	
	$View.=" LIMIT $Page_Start , $Per_Page";
//	echo $View;
	
	$qrys=mysqli_query($con1,$View);
	//echo $View;
echo mysqli_error();	
	
	
	
	
	
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
	<div class="products-block block-content">
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
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 product-col product-layout product-grid" >
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
                 <i class="hidden-lg hidden-sm hidden-md fa fa-shopping-cart"></i><span class="hidden-xs">Add to Cart11</span>
              </button>
              
              <?php echo $rwss["merchant_id"]."distance : ".$rwss["distance"];?>
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

} ?>