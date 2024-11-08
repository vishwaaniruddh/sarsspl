<?php 
include("config.php");
$mnqr=mysqli_query($con1,"select * from main_cat");
$nr=mysqli_num_rows($mnqr);


 $qry="select * from main_cat where under=0 limit 4,".$nr;
 $res=mysqli_query($con1,$qry);
?>
<div class="top-verticalmenu hidden-xs hidden-sm">
	<div class="menu-heading d-heading">
	<h4><span class="fa fa-bars pull-left"></span> categories </h4>
	</div> 
	<div id="pav-verticalmenu"> 
	<div class="menu-content d-content">
	  	<div class="pav-verticalmenu fix-top">
		<div class="navbar navbar-verticalmenu">
			<div class="verticalmenu" role="navigation">
				<div class="navbar-header">
				<a href="javascript:;" data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle">
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			    </a>
				<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav verticalmenu">
				    <?php while($rs=mysqli_fetch_array($res))
				    {?>
				    
<li class="bg1 topdropdow parent dropdown " >
					<a href="product.php?mdi=<?php echo $rs['id'];?>" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clock-o"></i><span class="menu-title"><?php echo $rs['name'];?></span><span class="menu-desc"><!--Quisque ac neque et augue-->
</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:700px" ><div class="dropdown-menu-inner">
<div class="row">
   <?php 
   $qr2=mysqli_query($con1,"select * from main_cat where under='".$rs['id']."'");
   while($rs2=mysqli_fetch_array($qr2))
				    {?> 
    <div class="mega-col col-md-6 " > 
    <div class="mega-col-inner">
<div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title"><?php echo $rs2['name'];?></h4>
<div class="">
	<ul class="content list-unstyled">
	    <?php 
   $qr3=mysqli_query($con1,"select * from main_cat where under='".$rs2['id']."'");
   while($rs3=mysqli_fetch_array($qr3))
				    {?> 
				<li>
            <a href="product.php?mdi=<?php echo $rs3['id'];?>">
                <span><?php echo $rs3['name'];?></span>
            </a>
        </li>
				
        <?php } ?>
			</ul>
</div></div></div></div></div>
<?php } ?>
<!--<div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Cloth</h4>
<div class="">
	<ul class="content list-unstyled">
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_65">
                <span>Fashion</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_28">
                <span>Gym Wear</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_31">
                <span>Pant</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_29">
                <span>shirt</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_32">
                <span>Shoes</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_30">
                <span>Watch</span>
            </a>
        </li>
			</ul>
</div></div></div></div></div></div></div></div>-->
</li>
<?php } ?>
<!--<li class="bg1 parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=46" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gift"></i><span class="menu-title">Accessories</span><span class="menu-desc">Quisque ac neque et augue
auctor aliquet</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:500px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"></div><div class="pavo-widget"></div><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Automative</h4>

<div class="">
	<ul class="content list-unstyled">
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_65">
                <span>Fashion</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_28">
                <span>Gym Wear</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_31">
                <span>Pant</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_29">
                <span>shirt</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_32">
                <span>Shoes</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_30">
                <span>Watch</span>
            </a>
        </li>
			</ul>
</div></div></div></div></div><div class="mega-col col-md-5 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget">
<div class="widget-html    ">
        <h4 class="widget-heading title">
        Makes a photoshop    </h4>
    	<div class="widget-inner -content clearfix">
		 <div class="content ">    <p>Lorem ipsum dolor sit amet consectetuer adipiscing eli Aenean commodo ligula bus et magnis dis parturient eu pretium quis sem.</p><p>Lorem ipsum dolor sit amet consectetuer adipiscing eli Aenean commodo ligula.</p></div>	</div>
</div>
</div></div></div></div></div></div></div></li>-->
<!--<li class="bg1 topdropdow parent dropdown " >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=45" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-clock-o"></i><span class="menu-title">Home &amp; Garden</span><span class="menu-desc">Quisque ac neque et augue
bendum</span><b class="caret"></b></a><div class="dropdown-menu"  style="width:700px" ><div class="dropdown-menu-inner"><div class="row"><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Electronics</h4>

<div class="">
	<ul class="content list-unstyled">
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_65">
                <span>Fashion</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_28">
                <span>Gym Wear</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_31">
                <span>Pant</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_29">
                <span>shirt</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_32">
                <span>Shoes</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_30">
                <span>Watch</span>
            </a>
        </li>
			</ul>
</div></div></div></div></div><div class="mega-col col-md-6 " > <div class="mega-col-inner"><div class="pavo-widget"><div class="pavo-widget"><h4 class="widget-heading title">Cloth</h4>

<div class="">
	<ul class="content list-unstyled">
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_65">
                <span>Fashion</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_28">
                <span>Gym Wear</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_31">
                <span>Pant</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_29">
                <span>shirt</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_32">
                <span>Shoes</span>
            </a>
        </li>
				<li>
            <a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=25_30">
                <span>Watch</span>
            </a>
        </li>
			</ul>
</div></div></div></div></div></div></div></div></li>-->
<!--<li class="" >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=57"><i class="fa fa-fax"></i><span class="menu-title">Automotive</span><span class="menu-desc">Lorem quis bibendum auctor
nibh id elit. </span></a></li>
<li class="" >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=42"><i class="fa fa-support"></i><span class="menu-title">Beauty &amp; Health</span><span class="menu-desc">Duis sed odio sit amet nibh mauris.</span></a></li>
					<li class="" >
					<a href="http://sarmicrosystems.in/oc/index.php?route=product/category&amp;path=17"><i class="fa fa-umbrella"></i><span class="menu-title">Toys, Kids &amp; Baby</span><span class="menu-desc">Quisque ac neque et augue
auctor aliquet</span></a></li>-->

</ul>				</div></div>
			</div>
		</div>
	</div>
	</div>
	</div>
</div>