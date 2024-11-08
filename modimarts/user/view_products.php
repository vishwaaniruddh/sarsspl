<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
//echo $id." ".$_SESSION['adminuser'];
include "config.php"; 
/* Ruchi :
$qry="select * from products where ccode='$id' ";  
$qrys=mysqli_query($con1,$qry);                
$num=mysql_num_rows($qrys);*/

$qry1="select name,code from cities";
$res1=mysqli_query($con1,$qry1);                
$num1=mysqli_num_rows($res1);

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="author" content="Acura">
    <meta name="description" content="Acura - A Real Admin Template">
    <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
    <!-- Responsive viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- Title -->
    <title>Merchant-View Products</title>
  
    <script src="js/jquery.min.js"></script>
    <!-- Ruchi :
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />-->
    <link href="css/style-min.css" rel="stylesheet" type="text/css" media="all" />
    
    <script type="text/javascript" src="../adminpanel/datepick_js.js"> </script>
    <link type="text/css" href="date_css.css"  rel="stylesheet" />
      
    <script>
    function funcs(strPage,perpg)
    {
    /*
    var fdate=document.getElementById('fdate').value;
    var tdate=document.getElementById('tdate').value;
    var progress=document.getElementById('progressid').value;
    var actionid=document.getElementById('actionid').value;
    var orderid=document.getElementById('orderid').value;
    */
    var catid= document.getElementById("catd").value;
    if(perpg=="")
    {
        perp='10';
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
        url:'viewproductsearch.php',
        data:'Page='+Page+'&perpg='+perp+'&catid='+catid,   /*+'&fdate='+fdate+'&tdate='+tdate+'&progress='+progress+'&actionid='+actionid+'&orderid='+orderid,*/
    
        success: function(msg){
            //alert(msg);
            document.getElementById('show').innerHTML=msg;
            }
        });
    }
function search(){
    try
    {
        var catid= document.getElementById("catd").value;
        //var catid=catid.options[catid.selectedIndex].value;
    } catch(ex) {
        alert(ex);
    }
    //alert (catid);
    $.ajax({
      type:'POST',
      url:'searcategor.php',
      data:'id='+catid,
      success: function(msg){
          //alert(msg);
          document.getElementById(msg)
      }
    })
}
  </script>
  </head>
  <body onload="funcs('','')">
  <?php
    include('header.php');
  ?>  
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
      <!--    <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>-->
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Manage Products </strong></h3>
            </header>
            <!-- dropdown searching section -->
            <div class="dropdown">
                <select id="catd"> 
                    <?php
                    $catsearch="select id,name from main_cat where under=0";
                    $cqry=mysqli_query($con1,$catsearch);
                    while($crows = mysqli_fetch_assoc($cqry)){?>
                        <option value="<?php echo $crows['id'];?>"><?php echo $crows['name'];?>
    
                        </option>
                    <?php } ?>
                </select>
                <input type="button" name="search" value="search" onclick="funcs('','')"/>
            </div>
            <div class="widget-body">
             <div>
                <div id="show"></div>
            </div>
          </div>
        </div>
      <!-- Footer -->
    <!-- Footer 
      <footer class="footer grid-12">
        <ul class="footer-sitemap grid-12">
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 1clickguide.org. All rights Reserved!
        </div>
      </footer>
    </div>
  </div>
 -->
  <!-- Go top -->
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>