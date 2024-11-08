<?php
session_start();
include('config.php');
$maketemp = "CREATE TEMPORARY TABLE tempsubcatids(catid int)"; 

$exec=mysqli_query($con1,$maketemp);
echo mysqli_error($con1);

       /*$getsubcatidfromtemp=mysqli_query($con1,"select * from tempsubcatids");
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
        <link href="css/form.css" rel="stylesheet" />
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
    //alert(l1+" "+l2);
    var catids=document.getElementById('catids').value;
    var sortby=document.getElementById('inputsort').value;
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
    var pg="catinprodview.php";
    var minv=$('#slider-range').slider("values")[0]; // for slider with single knob or lower value of range
    var maxv=$('#slider-range').slider("values")[1]; // for highest value of range
    //alert(pg);
    $.ajax({
       type: 'POST',    
    url:'catinprodview.php',
    dataType: 'html',
    data:{Page:Page,perpg:perp,mdi:'<?php echo $_GET['mdi'];?>',sts:'<?php echo $_GET['st'];?>',catids:catids,sortby:sortby,minv:minv,maxv,maxv},
    success: function(msg){
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
<style>
.fixed_div{
     margin-left: 17%;
}
/* Create two equal columns that floats next to each other */
.column5 {
    float: left;
    width: 70%;
    padding: 10px;
    /* Should be removed. Only for demonstration */
}
/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
/* Create two equal columns that floats next to each other */
.columnn {
    float: left;
    width: 30%;
    padding: 10px;
}
#sticky {
    position: -webkit-sticky;
    position: sticky;
    top: 20%;
    width: 17%;
}
</style>
</head>
<body class="common-home page-common-home layout-fullwidth" onload="">
  <!--=================== for menu ===============-->
    <div style=" position: -webkit-sticky;position: sticky;top: 0px;z-index:1;">
        <header id="header-layout" class="header-v2">
             <div id="header-main">
                <div>
                    <div class="row">
                        <?php include('menucopy.php')?>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
        <div class="container">
            <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
        </div>
  </div>
  <!-- sys-notification -->
    <div id="sys-notification">
        <div class="container">
            <div id="notification"></div>
        </div>
    </div>
    <!-- /sys-notification -->
    <div class="breadcrumbs space-30">
        <div class="container"> 
	        <div class="container-inner">
	            <ul class="list-unstyled breadcrumb-links">
				    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
					    <?php
    					    $sqlbrdcr = mysqli_query($con1,"select * from main_cat where id ='".$_GET['mdi']."'");
    						//echo "select * from main_cat where id ='".$_GET['mdi']."'";
							$fbrws=mysqli_fetch_array($sqlbrdcr);
							if($fbrws['under']=="0")
							{
							    //echo "ok";
    						?>  
    						<li><a href="product.php?mdi=<?php echo $fbrws['id'];?>"><?php echo $fbrws['name'];?></a></li>  
    						<?php
							} else
							{
							   $exs=0;
							   $idbrdcrmbarr=array();
							   $iddbr=$fbrws['id'];
							   while($exs==0)
							   {
							     // echo "select * from main_cat where id ='".$iddbr."'";
							       	$sqlbrdcr2 = mysqli_query($con1,"select * from main_cat where id ='".$iddbr."'");
						         	$fbrws2=mysqli_fetch_array($sqlbrdcr2);
						         	//$idbrdcrmbarr[]=$iddbr;
						        	array_unshift($idbrdcrmbarr, $iddbr);
						         	if($fbrws2['under']=="0")
						         	{
						         	    $iddbr="0";
				         	    	    $exs=1;
				         	    	    break;
						         	} else
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
							?>
						</ul>
					</div>
                </div>
            </div>
            <!--=============================================-->
<div class="row" >
   <div  id="sticky" >
      <div class="columnn" >
       <!--<img  src="images/logo.png" alt="Avatar">-->
            <div class="main-columns container" style="margin-right: 0px;margin-left: 11px;width: 217px;">
                <div class="row">
				    <div id="column-left" class="col-lg-12 col-md-3 col-sm-12 sidebar col-xs-12">
                        <div class="panel panel-default">
                          <div class="panel-heading"><h4 class="panel-title">Categories</h4></div>
                          <div class="tree-menu"  id="catshow">
                            <ul id="accordion14945721881688183652" class="box-category list-group accordion"> 
                            <?php 
                                category_tree($_GET['mdi']);
                                function category_tree($catid){
                                    //global $conn;
                                    global $con1;
                                    global $catids;
                                    $sql2 = "select * from main_cat where under ='".$catid."'";
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
                                <li class="collapse accordion-body in" class="active">
                                    <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){/* echo  " (".$cprodexs.")";*/ } ?></a>
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
                    //====================code======================
                    $chkqrnrprodcts=mysqli_query($con1,"select * from Productviewtable where category ='".$idc."' and status='1'");
                    //echo  "select * from Productviewtable where category ='".$idc."' and status='1'";
                     $cprodexs=mysqli_num_rows($chkqrnrprodcts);
                    //echo "gdgdfg".$idc;
                    ?>
                    <li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ /*echo " (".$cprodexs.")";*/ } ?></a>
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
            </ul>      
            <input type="hidden" id="catids" name="catids" value="<?php echo  $catids;?>">
        </div>
    </div>
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
    <div class="panel panel-default">
</div> 
</div></div> 
</div></div> 
</div>
<div class="fixed_div">
   <div id="sidebar-main" class="col-md-12 col-sm-12 col-xs-12" >
	<div class="product-filter no-shadow">
        <div class="inner clearfix" >
            <div class="filter-right col-lg-10 col-md-10 col-sm-10 col-xs-12" style="padding-left: 0px;padding-right: 0px;">
                <div class="product-compare col-lg-3  col-md-3 col-sm-3 col-xs-12 pull-right">
                    <a href=""></a>
                </div>
                <div class="sort col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-left" style="width: 221px;padding-left: 8px;padding-right: 0px;">
                    <span>Sort By:</span>
                    <select id="inputsort" class="form-control" onchange="funcs('','');">
                        <option value="1">Name (A - Z)</option>
                        <option value="2">Name (Z - A)</option>
                        <option value="3">Price (Low &gt; High)</option>
                        <option value="4">Price (High &gt; Low)</option>
                        <option value="5">Rating (Highest)</option>
                        <option value="6">Rating (Lowest)</option>
                    </select>
                </div>
                <div class="limit col-lg-2 col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-left"  style="padding-left: 0px;padding-right: 0px; width: 185px;">
                    <!-- <span>Show:</span>-->
                    <select name="perpg" id="perpg" onChange="funcs('','perpg');" style="display:none"  class="form-control">
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
            <div class="limit col-lg-3 col-lg-3 col-lg-3 col-sm-3 col-xs-12 pull-right" >
                <?php include('filtertestrah.php');?>
			</div>
        </div>
    </div>
</div>
<div id="content">
    <div class="clearfix"></div>
</div>
</div> 
</div>
</div>
<div style="position:-webkit-sticky;position: sticky;">
<footer id="footer" class="nostylingboxs">
<?php include("footer.php")?>
</footer>
<div>
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
	});
}); 
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
	});
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 });
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
</script>
<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</div>
</body>
<!--You have made no changes to save.-->
</html>
<script>
$(window).scroll(function(){
    var scrolled = $(window).scrollTop();
    if(scrolled > 750){
    //alert(scrolled)
    $("#sticky").css({"position":"absolute"});
    } else{
        $("#sticky").css({"position":"sticky"});
    }
});
</script>
