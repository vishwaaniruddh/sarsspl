<?php
session_start();
include('config.php');
$stsss="1";

//$sqldel ="DROP TABLE IF EXISTS `tempsubcatids`";
//mysqli_query ($con1,$sqldel) or ( "Error " . mysqli_error ($con1) ) ;

$maketemp = "CREATE TEMPORARY TABLE tempsubcatids(catid int)"; 

 $exec=mysqli_query($con1,$maketemp);
echo mysqli_error($con1);

       /* $getsubcatidfromtemp=mysqli_query($con1,"select * from tempsubcatids"); 
        echo mysqli_error($con1);
        while($rws2=mysqli_fetch_array($getsubcatidfromtemp))
        {
            
            echo $rws2[0]."<br>";
        }*/
        $catids="";
   $catids2=array();

?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" class="ltr" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Products</title>
          <meta name="description" content="My Store" />
<link href="http://sarmicrosystems.in/oc1/" rel="canonical" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="requiredfunctions.js"></script>

    	     <link href="catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
            
                <script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
               
    <!-- FONT -->

        <!-- FONT -->
    <!-- FONT -->

        <!-- FONT -->
        <style>

#notification {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 17px;
}

#notification.showalrt{
    visibility: visible;
     -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
   
}

</style>
<script>
/*function perpgfunc(numrows,perp)
{
    try
    {
     var min = 1,
    max = numrows,
    var select = document.getElementById('perpg');

for (var i = min; i<=max; i++){
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
}
}catch(exc)
{
   alert(exc); 
}
}*/

function perpgfunc(numrows,perp)
{
try
{
    document.getElementById("perpg").options.length = 0;
//alert(numrows);
 var min = 1;
    max = numrows;
    var select = document.getElementById('perpg');
for (var i = min; i<=max; i++){
    if(i%50==0)
 {
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
 }

  
}

    if(document.getElementById("perpg").options.length ==0)
    {
        perp=numrows;
    }
 var opt2 = document.createElement('option');
    opt2.value = numrows;
    opt2.innerHTML = 'All';
    select.appendChild(opt2);
       
document.getElementById('perpg').value=perp; 

}catch(exc)
{
    
    alert(exc);
}
}


function funcs(strPage,perpg)
{
try
{
    //alert(strPage);
var srchtxt=document.getElementById('srchtxt').value;
var catids=document.getElementById('catids').value;
var sortby=document.getElementById('inputsort').value;
var latitude=document.getElementById('latitude').value;
var longitude=document.getElementById('longitude').value;


//alert(latitude+"--"+longitude);

 var minv=$('#slider-range').slider("values")[0]; // for slider with single knob or lower value of range
var maxv=$('#slider-range').slider("values")[1]; // for highest value of range


//var amount=document.getElementById('amount').value;

if(perpg=="")
{
perp='50';
}
else
{
perp=document.getElementById(perpg).value;
}
var Page="";
if(strPage!="")
{
Page=strPage;
}




$.ajax({
   type: 'POST',    
url:'Resale_product_search_detailsCopy.php',
dataType: 'html',
data:{Page:Page,perpg:perp,srchtxt:srchtxt,sortby:sortby,longitude:longitude,latitude:latitude,minv:minv,maxv:maxv},

success: function(msg){
   // alert(msg);
document.getElementById('content').innerHTML=msg;
perpgfunc(document.getElementById('nmrws').value,document.getElementById('perpgforfunc').value);

         }
     });
}catch(exc)
{
    
    alert(exc);
}
}



/*function getcatdets()
{
    
 try
{
$.ajax({
   type: 'POST',    
url:'getcategorydets.php',
data:{mdi:'<?php echo $_GET["mdi"];?>',sts='<?php echo $_GET["st"];?>'},

success: function(msg){
alert(msg);
//location.reload(menu.php);
//location.href="menu.php";
  document.getElementById('catshow').innerHTML=msg;

         }
     });
}catch(exc)
{
    
    //alert("");
}
   
    
    
    
}
*/

</script>

<script type="text/javascript">
    $(document).ready(function(){
        var active = $('.collapse.in').attr('id');
        $('span[data-target=#'+active+']').html("<i class='fa fa-angle-down'></i>");

        $('.collapse').on('show.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("<i class='fa fa-angle-down'></i>");
        });
        $('.collapse').on('hide.bs.collapse', function () {
            $('span[data-target=#'+$(this).attr('id')+']').html("<i class='fa fa-angle-right'></i>");
        });
    });
</script>
      </head>
  <body class="common-home page-common-home layout-fullwidth" onload="">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
<header id="header-layout" class="header-v2">
    <div id="topbar" class="topbar-v1">
  <div class="container">
  <?php include('topbar.php')?>
</div>
</div>    <div id="header-main">
        <div class="">
            <div class="row">
            <?php include('resale_menu.php')?>
            </div>
        </div>
    </div>
    
   
</header>

        <!-- /header -->
        
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
        
  <div class="breadcrumbs space-30">
       <div class="container"> 
	     <!--  <div class="container-inner">
	        	        	 <ul class="list-unstyled breadcrumb-links">
								<li><a href="index.php"><i class="fa fa-home"></i></a></li>
								<?php
								/*
							$sqlbrdcr = mysqli_query($con1,"select * from main_cat where id ='".$_GET['mdi']."'");
								$fbrws=mysqli_fetch_array($sqlbrdcr);
								if($fbrws['under']=="0")
								{
								    //echo "ok";
								  ?>  
								  <li><a href="product.php?mdi=<?php echo $fbrws['id'];?>"><?php echo $fbrws['name'];?></a></li>  
								<?php
								    
								}else
								{
								    $exs=0;
								    $idbrdcrmbarr=array();
								   $iddbr=$fbrws['id'];
								   while($exs==0)
								   {
								      //echo "select * from main_cat where id ='".$iddbr."'";
								       	$sqlbrdcr2 = mysqli_query($con1,"select * from main_cat where id ='".$iddbr."'");
							         	$fbrws2=mysqli_fetch_array($sqlbrdcr2);
							         	//$idbrdcrmbarr[]=$iddbr;
							         	array_unshift($idbrdcrmbarr, $iddbr);
							         	if($fbrws2['under']=="0")
							         	{
							         	 $iddbr="0";
							         	    	$exs=1;
							         	    	break;
							         	}else
							         	{
							         	 $iddbr= $fbrws2['under'];  
							         	}
							         
								   }
								   
								    //print_r($idbrdcrmbarr);
								}
								
								
								for($c=0;$c<count($idbrdcrmbarr);$c++)
								{
								    	$sqlbrdcr23 = mysqli_query($con1,"select * from main_cat where id ='".$idbrdcrmbarr[$c]."'");
							         	$fbrws23=mysqli_fetch_array($sqlbrdcr23);
							         	
							         	if($c==count($idbrdcrmbarr)-2)
							         	{
							         	    $pcatid=$fbrws23['id'];
							         	}
								?>
								<li><a href="product.php?mdi=<?php echo $fbrws23['id'];?>"><?php echo $fbrws23['name'];?></a></li>
								<?php
								    
								}
								
								*/
								?>
								<!--<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61">Fashion</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69">Mens</a></li>
								<li><a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69_67">T-Shirt</a></li>-->
						<!--		</ul>
					</div>-->
    </div>
</div>


<!-----<div class="main-columns container">
<div class="row">
				<div id="column-left" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="panel panel-default">
        
        <!--======================== code for category show ========   
        
  <div class="panel-heading"><h4 class="panel-title">Categories</h4></div>
  <div class="tree-menu"  id="catshow">
      
   
      
      
      
      
 <ul id="accordion14945721881688183652" class="box-category list-group accordion">
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=59">ABC (0)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=74">Electronics (0)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61" class="active">Fashion (7)</a>
                        <div class="accordion-heading pull-right">
            <span data-toggle="collapse" data-parent="#accordion214945721881688183652" data-target="#collapse_214945721881688183652" class="bg"><i class='fa fa-angle-right'></i></span>
        </div>
        
        <ul id="collapse_214945721881688183652" class="collapse accordion-body in">
                    <li>
                        <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_69" class="active">Mens (7)</a>
                      </li>
                    <li>
                        <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=61_72">Women (1)</a>
                      </li>
                  </ul>
              </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=63">sale (0)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=20">Desktops (13)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=18">Laptops &amp; Notebooks (5)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25">Components (3)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=57">Tablets (1)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=17">Software (0)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=24">Phones &amp; PDAs (3)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=33">Cameras (2)</a>
                      </li>
            <li class="list-group-item accordion-group">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=34">MP3 Players (4)</a>
                      </li>
          </ul>
          
          <!--===========================code for category =================
          
     <ul id="accordion14945721881688183652" class="box-category list-group accordion"> 
         -->
           <?php 
   /*===========================code for category =================
          
        category_tree($_GET['mdi']);
          echo "ram1".$_GET['mdi'];
          function category_tree($catid){
//global $conn;

global $con1;
global $catids;

$sql2 = "select * from main_cat where under ='".$catid."'";
//echo  "ram1".$sql2;
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):

$i = 0;
if ($i == 0)

?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php
$idc=$row->id;

$chkqrnrprodcts=mysqli_query($con1,"select * from Productviewtable where category ='".$idc."' and status=1");

//echo "select * from products where category ='".$idc."' and status=1";
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;
?>
<li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ echo  " (".$cprodexs.")"; } ?></a>
 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 
 if($chkissubcat==0)
 {
      if($catids=="")
     {
         $catids=$idc;
     }
     else
     {
         $catids=$catids.",".$idc;
     }

     
 }
 category_tree($row->id);
 echo '</li>';
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
          */
          
          
          
          
          
          
          //include('getallcatest.php');
        /*$getsubcatidfromtemp=mysqli_query($con1,"select * from tempsubcatids"); 
        echo mysqli_error($con1);
        while($rws2=mysqli_fetch_array($getsubcatidfromtemp))
        {
            
            echo $rws2[0]."<br>";
        }*/
        
        
        
        /*=================== code for show category =============
        
     if(trim($catids)=="")
          {
          $catids=$_GET['mdi'];
          category_tree2($pcatid);
          }
          
          
         
          function category_tree2($catid){
//global $conn;

global $con1;
global $catids;

$sql2 = "select * from main_cat where under ='".$catid."'";
echo "ram". $sql2;
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php
$idc=$row->id;

//====================code======================
$chkqrnrprodcts=mysqli_query($con1,"select * from Productviewtable where category ='".$idc."' and status='1'");
//echo  "select * from Productviewtable where category ='".$idc."' and status='1'";
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;

?>
<li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ echo " (".$cprodexs.")"; } ?></a>
 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);

 category_tree2($row->id);
 echo '</li>';
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}       
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          ?>
         
         
         
         
         
          <?php 
  /*
     $conn =  mysqli_connect("localhost","sarmicro_1click","Click123*","sarmicro_1click");
     
          category_tree($_GET['mdi']);
          
          function category_tree($catid){
//global $conn;

global $con1;
global $catids;

$sql2 = "select * from main_cat where under ='".$catid."'";
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php
$idc=$row->id;

$chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;
?>
<li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ echo " (".$cprodexs.")"; } ?></a>
 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 
 if($chkissubcat==0)
 {
      if($catids=="")
     {
         $catids=$idc;
     }
     else
     {
         $catids=$catids.",".$idc;
     }

     
 }
 category_tree($row->id);
 echo '</li>';
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
          
          //include('getallcatest.php');
       
     if(trim($catids)=="")
          {
          $catids=$_GET['mdi'];
          category_tree2($pcatid);
          }
          
          
         
          function category_tree2($catid){
//global $conn;

global $con1;
global $catids;

$sql2 = "select * from main_cat where under ='".$catid."'";
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php
$idc=$row->id;

$chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;
?>
<li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ echo " (".$cprodexs.")"; } ?></a>
 <?php
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);

 category_tree2($row->id);
 echo '</li>';
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}       
          
          
          
          
          
          
          
          
          
          
        
          */
          
          
          ?>
          
  <!-- </ul> -->   
          
          
          <input type="hidden" id="catids" name="catids" value="<?php echo  $catids;?>">
          

          
  


    <div class="panel panel-default" style="margin-bottom: 100px;">
	<div class="panel-heading block-borderbox" style="padding-top: 0px;">
	

  
   <div id="sidebar-main" class="col-md-12 col-sm-12 col-xs-12" >
       
       
	<div class="product-filter no-shadow">
    <div class="inner clearfix">
       <!-- <div class="display col-lg-2 col-md-2 col-sm-2 hidden-xs">
            <div class="btn-group group-switch">
                <button type="button" id="list-view" class="btn btn-switch" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                <button type="button" id="grid-view" class="btn btn-switch active" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
            </div>
        </div>-->
        
        <div class="filter-right col-lg-12 col-md-10 col-sm-10 col-xs-12">
           
          
          <div class="limit col-lg-2 col-md-3 col-sm-4 col-xs-12 ">
                <span>Show:</span>
                <select name="perpg" id="perpg" onChange="funcs('','perpg');"  class="form-control">
                    
                   
                     <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%50==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i; ?></option>
 <?php
 }
 }
 
 ?>

                                                            </select>
            </div>
              <div class="sort col-lg-3 col-md-3 col-sm-5 col-xs-12 ">
                <span>Sort By:</span>
                <select id="inputsort" class="form-control" onchange="funcs('','');">
                                                                                                <option value="1">Name (A - Z)</option>
                                                                                                <option value="2">Name (Z - A)</option>
                                                                                                <option value="3">Price (Low &gt; High)</option>
                                                                                                <option value="4">Price (High &gt; Low)</option>
                                                                                              <!--  <option value="5">Rating (Highest)</option>
                                                                                                <option value="6">Rating (Lowest)</option>-->
                                                                                                </select>
                                                                                               
            </div>
             <!--<div class="product-compare col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                <a href="http://sarmicrosystems.in/oc/index.php?route=product/compare" class="btn btn-link" id="compare-total">Product Compare (0)</a>
            </div>-->
            <div class="limit col-lg-4 col-md-3 col-sm-4 col-xs-12 pull-right">
             <div class="product_right">
					
<?php include('filtertestrah.php');?>		 
			</div>
				 </div>
        </div>
    </div>
</div>

   <script>
              
              updatecart();
              
          </script>    
      <div id="content">
      <div class="clearfix"></div>
      
                  
                 
      
        
      
      </div>
   </div> </div>
   </div> 
		</div>
</div>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->



 
<footer id="footer" class="nostylingboxs">
 
  

  <?php include("footer.php")?>

</footer>
 
 
<div id="powered">
 <?php include('footerbottom.php')?>
</div>

  
<script type="text/javascript">
$(document).ready( function (){
	$(".paneltool .panelbutton").click( function(){	
		$(this).parent().toggleClass("active");
	} );
} );

</script>

<!------<div id="pav-paneltool" class="hidden-sm hidden-xs">
	<div class="paneltool themetool">
		<div class="panelbutton">
			<i class="fa fa-cog"></i>
		</div>
		<div class="panelcontent ">
			<div class="panelinner">
				<h4>Panel Tool</h4>
				<form action="/oc/index.php?route=product/category&path=61_69_67" method="post" class="clearfix"><div class="clearfix">
					<div class="group-input row">
						<label class="col-sm-4">Theme</label>
						<select class="col-sm-8" name="userparams[skin]">
							<option value="">default</option>
														<option value="blue" >blue</option>
														<option value="brown" >brown</option>
														<option value="green" >green</option>
														<option value="greenlight" >greenlight</option>
													</select>					
					</div>
					<div class="group-input row">
						<label class="col-sm-4">Layout</label>
						<select class="col-sm-8" name="userparams[layout]">
														<option value="fullwidth"  selected="selected" >Full Width</option>
														<option value="boxed-lg" >Boxed Desktop Large</option>
													</select>					
					</div>

					<hr>
					<div class="clearfix"></div>
					<p class="group-input pull-right">
						<button value="Apply" class="btn btn-small" name="btn-save" type="submit">Apply</button>
						<a class="btn btn-small" href="http://sarmicrosystems.in/oc/?pavreset=?"><span>Reset</span></a>
					</p>
				</div></form>
			</div>	
		</div>
	</div>
	
	<div class="paneltool editortool">
		<div class="panelbutton">
			<i class="fa fa-adjust"></i>
		</div>
		<div class="panelcontent editortool"><div class="panelinner">
							
				<h4>Live Theme Editor</h4>					
									<div class="clearfix" id="customize-body">			
						<ul class="nav nav-tabs" id="myTab">
														<li><a href="#tab-selectors">Layout Selectors</a></li>		
														<li><a href="#tab-elements">Layout Elements</a></li>		
													</ul>										
						<div class="tab-content" > 
														<div class="tab-pane" id="tab-selectors">
																<div class="accordion"  id="custom-accordionselectors">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsebody">
												Body Content	 
											</a>
										</div>

			                            <div id="collapsebody" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 													  <div class="form-group background-images"> 
															<label>Background Image</label>
															<a class="clear-bg btn btn-small" href="#">Clear</a>
															<input value="" type="hidden" name="customize[body][]" data-match="body" class="input-setting" data-selector="body,body #page" data-attrs="background-image">

															<div class="clearfix"></div>
															 <p><em style="font-size:10px">Those Images in folder YOURTHEME/img/patterns/</em></p>
															<div class="bi-wrapper clearfix">
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern1.png" data-val="../../img/patterns/pattern1.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern10.png" data-val="../../img/patterns/pattern10.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern11.png" data-val="../../img/patterns/pattern11.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern12.png" data-val="../../img/patterns/pattern12.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern13.png" data-val="../../img/patterns/pattern13.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern14.png" data-val="../../img/patterns/pattern14.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern15.png" data-val="../../img/patterns/pattern15.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern16.png" data-val="../../img/patterns/pattern16.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern17.png" data-val="../../img/patterns/pattern17.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern18.png" data-val="../../img/patterns/pattern18.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern19.png" data-val="../../img/patterns/pattern19.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern2.png" data-val="../../img/patterns/pattern2.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern20.png" data-val="../../img/patterns/pattern20.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern3.png" data-val="../../img/patterns/pattern3.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern4.png" data-val="../../img/patterns/pattern4.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern5.png" data-val="../../img/patterns/pattern5.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern6.png" data-val="../../img/patterns/pattern6.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern7.png" data-val="../../img/patterns/pattern7.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern8.png" data-val="../../img/patterns/pattern8.png">

															</div>
																														<div style="background:url('http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png') no-repeat center center;" class="pull-left" data-image="http://sarmicrosystems.in/oc/catalog/view/theme/pav_bigstore/image/pattern/pattern9.png" data-val="../../img/patterns/pattern9.png">

															</div>
																				                                    </div>
					                                  </div>
					                                  

																									 					                                   <div class="form-group">
						                                   <label>Font-Size</label>
						                                  	<select name="customize[body][]" data-match="body"  class="input-setting" data-selector="body,body #page" data-attrs="font-size">
																<option value="">Inherit</option>
																												<option value="9">9</option>
																														<option value="10">10</option>
																														<option value="11">11</option>
																														<option value="12">12</option>
																														<option value="13">13</option>
																														<option value="14">14</option>
																														<option value="15">15</option>
																														<option value="16">16</option>
																															</select>
																<a href="#" class="clear-bg btn btn-small">Clear</a>
					                                  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Font-Family</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="font-family"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body,body #page" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[body][]" data-match="body" type="text" class="input-setting" data-selector="body a,body #page a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsetop-bar">
												Top Bar	 
											</a>
										</div>

			                            <div id="collapsetop-bar" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link Color</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar a,#topbar .dropdown .dropdown-toggle" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[top-bar][]" data-match="top-bar" type="text" class="input-setting" data-selector="#topbar a:hover,#topbar .dropdown:hover .dropdown-toggle" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepav-mainnav">
												Main Menu	 
											</a>
										</div>

			                            <div id="collapsepav-mainnav" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background Color</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" type="text" class="input-setting" data-selector="#pav-mainnav,#pav-mainnav .navbar-default" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Link</label>
															<input value="" size="10" name="customize[pav-mainnav][]" data-match="pav-mainnav" type="text" class="input-setting" data-selector="#pav-megamenu .navbar-nav li a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-top">
												Footer top	 
											</a>
										</div>

			                            <div id="collapsefooter-top" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-top][]" data-match="footer-top" type="text" class="input-setting" data-selector=".footer-top" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsefooter-center">
												Footer Center	 
											</a>
										</div>

			                            <div id="collapsefooter-center" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center,.footer-center .container" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column,.footer-center .container .column .panel-title" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link hover</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".footer-center .container .column a:hover" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg newsletter</label>
															<input value="" size="10" name="customize[footer-center][]" data-match="footer-center" type="text" class="input-setting" data-selector=".btn-custom" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionselectors" href="#collapsepowered">
												Powered	 
											</a>
										</div>

			                            <div id="collapsepowered" class="accordion-body panel-collapse collapse ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Background </label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Text color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Link color</label>
															<input value="" size="10" name="customize[powered][]" data-match="powered" type="text" class="input-setting" data-selector="#powered .container a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	 </div>
															</div>
						   							<div class="tab-pane" id="tab-elements">
																<div class="accordion"  id="custom-accordionelements">
																  	            	   <div class="accordion-group">
			                            <div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#custom-accordionelements" href="#collapseproduct">
												Products	 
											</a>
										</div>

			                            <div id="collapseproduct" class="accordion-body panel-collapse collapse  in ">
				                            <div class="accordion-inner panel-body clearfix">
				                              														 					                                  <div class="form-group">
															<label>Product Name</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-block .name a" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price New</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".price .price-new" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Price Old</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".price .price-old" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Icon Color</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector="
				.cart .fa, .wishlist .fa, .compare .fa, .quick-view .fa,.zoom .fa
			" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Color Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-label" data-attrs="color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																									 					                                  <div class="form-group">
															<label>Bg Sale</label>
															<input value="" size="10" name="customize[product][]" data-match="product" type="text" class="input-setting" data-selector=".product-label.sale-exist" data-attrs="background-color"><a href="#" class="clear-bg btn btn-small">Clear</a>
													  </div>
					                                  

																                            </div>
			                            </div>
				                    </div>         	
																	 </div>
															</div>
						   						</div>   
					</div>    
				</div>
		</div>	 
	</div>

</div> ------>
 
<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 
 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');

		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );

	}	
	$input.val('');

	return false;
} );



 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 

</script>
</div>
<div class="sidebar-offcanvas visible-xs visible-sm">
    <div class="offcanvas-inner panel-offcanvas">
        <div class="offcanvas-heading clearfix">
            <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasmenu"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#offcanvasmenu").html($("#bs-megamenu").html());
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>

<script>
    
    //funcs('',''); 
</script>
</div>
</body></html>