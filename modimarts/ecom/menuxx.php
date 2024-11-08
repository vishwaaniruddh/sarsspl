<?php 
include("config.php");
 $qry="select * from main_cat where under=0 limit 0,4";
 $res=mysqli_query($con1,$qry);
?>
<script>


</script>
<body onload="" >
<nav id="pav-megamenu" class="navbar">
	<div class="navbar-header">
	  <button data-toggle="offcanvas" class="btn btn-primary canvas-menu hidden-lg hidden-md" type="button"><span class="fa fa-bars"></span>Menu</button>
	</div>
	<div class="collapse navbar-collapse" id="bs-megamenu">
		<ul class="nav navbar-nav megamenu">
		    <li class="home" >
		    <a href="index.php"><span class="menu-title">Home</span></a>
		    </li>
		    
		    <?php
		    while($rwss=mysqli_fetch_array($res))
		    {
		    
		    ?>
		    <li class="parent dropdown  aligned-left" >
		        <a class="dropdown-toggle" data-toggle="dropdown" href="product.php?mdi=<?php echo $rwss['id'];?>&st=1">
		            <span class="menu-title"><?php echo $rwss["name"];?></span><b class="caret"></b></a>
		            <div class="dropdown-menu level1"  style="width:800px" >
		                <div class="dropdown-menu-inner">
		                    <div class="row">
		                        
		                        <?php 
		                        
		                        $subcatarr=array();
		                        
		                        $qry2="select * from main_cat where under='".$rwss['id']."'";
                                $res2=mysqli_query($con1,$qry2);   
		                       while($rwss2=mysqli_fetch_array($res2))
		                        {
		                        $subcatarr[]=$rwss2[0];
		                        $subcatarr[]=$rwss2[1];
		                        }
		                        
		                        $subcatid=0;
		                        $subcatname=1;
		                        
		                        for($a=0;$a<count($subcatarr);$a++)
		                        {
		                            
		                            
		                        if($subcatarr[$subcatid]!="")
		                        {
		                        ?>
		                        
		                        <div class="mega-col col-xs-12 col-sm-12 col-md-3" data-type="menu" >
		                            <div class="mega-col-inner">
		                                <ul>
		        <li class="parent dropdown-submenu mega-group" >
		            <a class="dropdown-toggle" data-toggle="dropdown" href="product.php?mdi=<?php echo $subcatarr[$subcatid];?>&st=2">
		                <span class="menu-title"><b><?php echo $subcatarr[$subcatname]; ?></b></span><b class="caret"></b></a>
		                <div class="dropdown-mega level2"  ><div class="dropdown-menu-inner">
		                  <div class="row">  
		                    <?php
		                    $qry3="select * from main_cat where under='".$subcatarr[$subcatid]."' limit 0,10";
                                $res3=mysqli_query($con1,$qry3);   
		                       while($rwss3=mysqli_fetch_array($res3))
		                        {
		                    ?>
		                    
		                    <div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu" >
		                        <div class="mega-col-inner">
		                            <ul>
		                                <li class=" mega-group" >
		                                    <a href="product.php?mdi=<?php echo $rwss3['id'];?>&st=3">
		                                        <span class="menu-title"><?php echo $rwss3['name'];?></span></a></li>
		                                               
		                                                                                </ul>
		                                                                                </div>
		                                                                                </div>
		                                                                                 
		                                                                                
		                                                                               <?php } ?>
		                                                                               </div>
		                                                                                </li>
		                                                                                </ul>
		                                                                                </div>
		                                                                                </div>
		                                                                                
		                                                                                
		                                                                                <?php }
		                                                                                $subcatid=$subcatid+2;
		                                                                                $subcatname=$subcatname+2;
		                                                                               /*if($subcatarr[$subcatid]!="")
		                        {
		                        ?>
		                                                                               
		                                                   <div class="mega-col col-xs-12 col-sm-12 col-md-3" data-type="menu" >
		                            <div class="mega-col-inner">
		                                <ul>
		        <li class="parent dropdown-submenu mega-group" >
		            <a class="dropdown-toggle" data-toggle="dropdown" href="product.php?mdi=<?php echo $subcatarr[$subcatid];?>&st=2">
		                <span class="menu-title"><b><?php echo $subcatarr[$subcatname]; ?></b></span><b class="caret"></b></a>
		                <div class="dropdown-mega level2"  ><div class="dropdown-menu-inner">
		                    
		                    <div class="row">
		                        
		                         <?php
		                    $qry4="select * from main_cat where under='".$subcatarr[$subcatid]."' limit 0,10";
                                $res4=mysqli_query($con1,$qry4);   
		                       while($rwss4=mysqli_fetch_array($res4))
		                        {
		                    ?><div class="row">
		                        <div class="col-sm-12 mega-col" data-colwidth="12" data-type="menu" >
		                        <div class="mega-col-inner">
		                            <ul>
		                                <li class=" mega-group" >
		                                    <a href="product.php?mdi=<?php echo $rwss4[id];?>&st=3">
		                                        <span class="menu-title"><?php echo $rwss4['name']; ?></span></a></li>
		                                                                                </ul>
		                                                                                </div>
		                                                                                </div>
		                                                                                 </div>
		                                                                                <?php } ?>
		                                                                                </div>
		                                                                                </li>
		                                                                                </ul>
		                                                                                </div>
		                                                                                </div> 
		                                                                                <?php } 
		                                                                                 $subcatid=$subcatid+2;
		                                                                                $subcatname=$subcatname+2;*/
		                                                                                ?>
		                                                                                
		               <?php }
		    }
		               ?>                                                                 
		                                                                                
		             
</nav>     
</body>