<?php
session_start();

 if(isset($_SESSION['SESS_USER_NAME']) && isset($_SESSION['SESS_USER_NAME']))
{	
$id=$_SESSION['id'];
//echo "id".$id;
include "config.php"; 
 $qry2="select max(code) as ncode from products";   

                          $res2=mysql_query($qry2);

                          $row2=mysql_fetch_array($res2);   
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
  <title>Merchant Add-product</title>
<script>
function addItem()
{
	
//alert("ok");
	if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		

		var newdiv=document.createElement("tr");
//alert(xmlhttp.responseText);
//newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
newdiv.innerHTML=xmlhttp.responseText;	
	document.getElementById('attatch').appendChild(newdiv);
    }
  }
  
    
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","addrowimg.php",true);
xmlhttp.send();	
}


</script>

<?php
include('header.php');
?>
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-10"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
        
        </div>
        
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Add Product </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   	<form id="form11" name="form11" action="processAddProducts.php" method="post" enctype="multipart/form-data" >
                                        
      <table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch">
                                                <tr>

                                                  <td align="center" colspan="2"><b><font color="#000000" size="+1">YOUR PRODUCT DETAILS</font></b> </td>

                                               <!-- <tr>

                                                  <td>Product Code</td>

                                                  <td colspan="3"><input type="text" name="pcode" class="form form-full" value="<?php echo $row2[0]+1;?>" readonly="readonly"/></td>

                                                </tr>-->

                                               
                                                <tr>

                                                  <td>Product Name</td>

                                                  <td colspan="3"><input type="text" name="pname" class="form form-full" required/></td>

                                                </tr>

                                                <tr>

                                                  <td><div align="left">Product Description</div></td>

                                                  <td colspan="3"><input type="text" name="pdesc" class="form form-full" required/></td>

                                                </tr>

		              <tr>

                                                  <td><div align="left">Product Category</div></td>

                                                  <td colspan="3"><div id="res">
<?php 
$clintct=mysql_query("SELECT cid FROM `clients` WHERE `code` = '".$id."'");
//echo "SELECT cid FROM `clients` WHERE `code` = '".$_SESSTION['id']."'";
//echo "SELECT cid FROM `clients` WHERE `code` = '".$id."'";
$clintctf=mysql_fetch_row($clintct);

$catarr="";
//echo "test".$clintctf[0];

?><select id="pcat" name="pcat" class="form form-full" required>
<?php 



$maincat=mysql_query("SELECT id FROM `main_cat` where under in ($clintctf[0])");
while($maincatf=mysql_fetch_row($maincat))
{
    if($catarr==""){
    $catarr=$maincatf[0];
    }else{
        
      $catarr=$catarr.','.$maincatf[0];
        
    }
}



$querycat=mysql_query("SELECT * FROM `main_cat` where id in ($catarr) ");

while($querycatf=mysql_fetch_array($querycat))
{
    
    ?>
    
    <optgroup label="<?php  echo $querycatf[1];?>" >
    
 <!--   <option value="<?php  echo $querycatf[0];?>" style="background-color:#66e0ff" selected disabled><?php  echo $querycatf[1];?> --></option>
    
    <?php
    $querycat1=mysql_query("SELECT * FROM `main_cat` where under ='".$querycatf[0]."' order by name ");
while($fechcat=mysql_fetch_array($querycat1))
{
    
    $querycat2=mysql_query("SELECT * FROM `main_cat` where under ='".$fechcat[0]."' order by name "); 
    $fechcatr=mysql_num_rows($querycat2);
    
    if($fechcatr>0)
    {
?>
<optgroup label="<?php  echo $fechcat[1];?>">

 <?php
   
while($fechcat2=mysql_fetch_array($querycat2))
{
    
    
?>
<option value="<?php  echo $fechcat2[0];?>"><?php  echo $fechcat2[1];?></option>

<?php 
}
}
else{
    ?>
    
    <option value="<?php  echo $fechcat[0];?>"><?php  echo $fechcat[1];?></option>
    <?php
}
?>
</optgroup>

<?php }
?>

</optgroup>
<?php
}
?>
</select>
<!--<input type="text" name="pcat" class="form form-full" />--></div>

                                                    </td>

                </tr>

                                                <tr>

                                                  <td><div align="left">Product Image</div></td>

                                                  <td colspan="3"><input type="file" name="image[]" class="form" required />
<button type="button" class="btn blue" onClick="addItem();">ADD MORE Images</button></td>

                                                </tr>                                                                                               

                                              

                </table>
<table class="tables"  align="center" cellpadding="4" cellspacing="0">

                                               
                                                <tr>

                                                  <td width="270px"><div align="left">Price</div></td>

                                                  <td colspan="3" ><input type="text" name="price" id="price" class="form form-full" onchange="a()" required/></td>

                                                </tr>
                                                
                                                <script>
                                                
                                                function a(){
                                                    
                                                  var p=document.getElementById("price").value;
                                                  if(p==0){alert(" Price Can Not be  Zero")}
                                                  
                                                }
                                                
                                                
                                                $('#price').on('input', function () {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });

                                                </script>
 <tr>

                                                  <td width="300px"> <div align="left">Discount</div></td>

                                                  <td colspan="3"><input type="radio" name="discount"  class="form " value="P" checked>% <input type="radio" name="discount" class="form " value="R">Rs. <input type="text" name="discnt" id="discnt" class="form " /></td>

                                                </tr>
                                                
                                                
                                                    <script>
                                                
                                                $('#discnt').on('input', function () {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });

                                                </script>
                                                <tr>

                                                  <td width="300px">Others</td>

                                                  <td colspan="3"><input type="text" name="others" class="form form-full" /></td>

                                               

                                          

                                        </tr>

                                        <tr>

                                          <td colspan="2" align="center">
<input type="hidden" name="ccode" id="ccode" value="<?php echo $id; ?>">
                                            <input type="submit" value="Add Product" id="submit" name="submit" class="btn btn-submit" />
                                              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error" onClick="history.go(-1);" />

                                        

                                          </td>

                                        </tr>

                                    </table>                                     
  </div>
 </form>
    </div>
 
</div>
          </div>
        </div>
          </div>
        </div>
        
       
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
 
  <!-- Go top -->
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>