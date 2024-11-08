<?php
session_start();

if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{ 
    $id=$_SESSION['id'];
    $pcode=$_GET['pcode'];
    $pcat=$_GET['cat'];

    include "config.php"; 
    if($pcat==1)
    {
         $qry2="select *  from fashion where code='$pcode'  and ccode='$id'";   
    }
    else if($pcat==190)
    {
         $qry2="select *  from electronics where code='$pcode'  and ccode='$id'";   
    }
    else if($pcat==218)
    {
         $qry2="select *  from grocery where code='$pcode'  and ccode='$id'";   
    }else if($pcat==482)
    {
         $qry2="select *  from Resale where code='$pcode'  and ccode='$id'";   
    }
    else
    {
     $qry2="select *  from products where code='$pcode'  and ccode='$id'";   
    }
    $res2=mysqli_query($con1,$qry2);
    $nrwsd=mysqli_num_rows($res2);
    $row2=mysqli_fetch_array($res2);  
    //ruchi Get product name by id
    $prod = mysqli_query($con1,"SELECT product_model FROM product_model where id='".$row2[1]."'");
    $product_name = mysqli_fetch_assoc($prod);
    //ruchi Get brand name by id
    $brand = mysqli_query($con1,"SELECT brand FROM brand where id='".$row2['brand']."'");
    $brand_name = mysqli_fetch_assoc($brand);
    $sltcat=mysqli_query($con1,"SELECT name FROM `main_cat` where id ='".$row2[4]."' ");
    $sltcat=mysqli_fetch_array($sltcat);
?>
<!doctype html>
<html lang="en">
    <head>
    <!--============================ ck Editor ===============-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="adstyle.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
<!--============================ ck Editor ===============-->
<!-- Meta -->
  <meta charset="UTF-8">
  <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <title>1clickguide user panel</title>
<script>
function addItem()
{
    //alert("ok");
  if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else
    {
        // code for IE6, IE5
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
function addSpts()
{
  //alert("ok");
  if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        var newdivs=document.createElement("tr");
        //alert(xmlhttp.responseText);
        //newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
        newdivs.innerHTML=xmlhttp.responseText; 
      document.getElementById('attatch1').appendChild(newdivs);
    }
  }
    //alert("addrow_image.php?cnt="+cnt);
    xmlhttp.open("GET","addrowspec.php",true);
    xmlhttp.send(); 
}
</script>
<?php include('header.php'); ?>
<!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
        <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
        <div class="sitemap grid-6">
            <ul>
                <li><span>1click</span><i>/</i></li>
                <li><a href="index.php">User Panel</a></li>
            </ul>
        </div>
    </div>
    </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Edit Product </strong></h3>
            </header>
            <div class="widget-body"> <div>
            <form id="form11" name="form11" action="processEditProduct.php" method="post" enctype="multipart/form-data" onsubmit="return t1()">
                <table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch">
                                                <tr>
                                                  <td align="center" colspan="2"><b><font color="#000000" size="+1">YOUR PRODUCT DETAILS</font></b> </td>
                                                <tr>

                                                  <td>Product Code</td>

                                                  <td colspan="3">
                                                      <input type="hidden" id="prcat" name="prcat" value="<?php echo $pcat?>"/>
                                                      <input type="text" name="pcode" class="form form-full" value="<?php echo $row2[0];?>" readonly="readonly"/></td>

                                                </tr>
                                                <tr>
                                                  <td>Product Name</td>
                                                  <td colspan="3"><input type="text" name="pname" class="form form-full" value="<?php echo $product_name['product_model'];?>" required/></td>

                                                </tr>

                                              <!--  <tr>

                                                  <td><div align="left">Product Description</div></td>

                                                  <td colspan="3"><input type="text" name="pdesc" class="form form-full" value="<?php echo $row2[3];?>" required/></td>

                                                </tr>-->
                                                
                                                
                                                
                                                <tr>

                                                  <td width="300px">Other</td>

                                                  <td colspan="3"><textarea  id="editor1" name="editor1"  ><?php echo $row2[3];?></textarea></td>
                                                 </tr>
                                                
                                                
                                                
                                                
                                                 <tr>

                                                  <td><div align="left">Product Brand<?php echo $row2["brand"];?></div></td>

                                                  <td colspan="3"><input type="text" name="pbrand" id="pbrand" class="form form-full" value="<?php echo $brand_name["brand"];?>" required/></td>

                                                </tr>
                                                

                  <tr>

                                                  <td><div align="left">Product Category</div></td>


<?php 
$clintct=mysqli_query($con1,"SELECT cid,subscribe FROM `clients` WHERE `code` = '".$id."'");
$clintctf=mysqli_fetch_row($clintct);
$catarr="";
?>

<!--
<script>
  $(document).ready(function(){
    document.getElementById("pcat").value  ="<?php echo $row2[4]?>";
  });
  </script>
-->


                                                  <td colspan="3">
                                                      <select id="pcat" name="pcat" class="form form-full" onchange="chkcategory();"  required>
                                                          
                                                      
                                                      
                                                      <?php 


$maincat=mysqli_query($con1,"SELECT id FROM `main_cat` where under in ($clintctf[0])");

while($maincatf=mysqli_fetch_row($maincat))
{
    if($catarr==""){
    $catarr=$maincatf[0];
    }else{
        
      $catarr=$catarr.','.$maincatf[0];
        
    }
}



$querycat=mysqli_query($con1,"SELECT * FROM `main_cat` where id in ($catarr) ");
//echo "SELECT * FROM `main_cat` where id in ($catarr) ";
while($querycatf=mysqli_fetch_array($querycat))
{
    
    ?>
    
    <optgroup label="<?php  echo $querycatf[1];?>" >
    
 <!--   <option value="<?php  echo $querycatf[0];?>" style="background-color:#66e0ff" selected disabled><?php  echo $querycatf[1];?> --></option>
    
    <?php
    $querycat1=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$querycatf[0]."' order by name ");
while($fechcat=mysqli_fetch_array($querycat1))
{
    
    $querycat2=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$fechcat[0]."' order by name "); 
    $fechcatr=mysqli_num_rows($querycat2);
    
    if($fechcatr>0)
    {
?>
<optgroup label="<?php  echo $fechcat[1];?>">

 <?php
   
while($fechcat2=mysqli_fetch_array($querycat2))
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
                                                     
                                                      
                                                      
                                                      
                                                      
                                                      
                                                   <!--  <div id="res"> <input type="text" name="pcat" class="form form-full" value="<?php echo $row2[4];?>"/></div>-->

                                                    </td>

                </tr>





                
                                
                <script>
        
         
        
        
        function chkcategory(){
           
           var pcat = document.getElementById("pcat");
           var proct = pcat.options[pcat.selectedIndex].value;
         
           $.ajax({
                    type: 'POST',    
                    url:'hideColorSize.php',
                    data:'proct='+proct, 
                    
                    success: function(msg){
                   // alert(msg);
                    if(msg==1){
                   $("#h1").show();
                   $("#h2").show();
                    }
                    else{
                        $("#h1").hide();
                        $("#h2").hide();
                    }
                     
         }
     });

        }
</script>

                
                
    
<?php 
 
 $qry="select * from fashioncolor ";
 $result=mysqli_query($con1,$qry); 
?>

                                                  <tr id="h1" style="display:none">
                                                  <td><div align="left">Product color</div></td>
                                                  <td colspan="3">
                                                   <div class="compny">

    
                                                  <span class="input">
                                                  <select   id="Catcolor" name="Catcolor"    onchange="chcolor()" style="width: 50px;" multiple="multiple">
                                                  <option   value="" />Select Color</option>
                                                    <?php 
                                                   while($row = mysqli_fetch_row($result))
                                          {  ?>
        
        
        
                                            <option   value="<?php echo $row[0]; ?>" /><?php echo $row[1]; ?></option>
                                          <br/>
    
                                <?php } ?>
                            </select>
                        </span>
                    </div>
                                                  </td>
                                                  </tr>


<input type="hidden" id="hidden_color" name="hidden_color" value="<?php echo $row2['color']; ?>"/>
<input type="hidden" id="hidden_size" name="hidden_size" value="<?php echo $row2['size']; ?>"/>
<input type="hidden" id="hidden_sizeid" name="hidden_sizeid" value="<?php echo $row2['size_id']; ?>"/>
                                                 <tr id="h2" style="display:none">
                                                  <td><div align="left">Product Size</div></td>
                                                  <td colspan="3">
                                                    <div class="Fsize">
                                                <span class="input">
                                                    <select   id="size" name="size"    onchange="chsize()" style="width: 150px;" multiple="multiple">
                                                      <option   value="" style="width: 150px;"/>Select Size</option>
                                                        <option   value="1" />Small</option>
                                                        <option   value="2" />Medium</option>
                                                        <option   value="3" />Large</option>
                                                        <option   value="4" />XL</option>
                                                        <option   value="5" />XXL</option>
                                                        
                    
                                                    </select>
                                                </span>
                                            </div>  
                                                    
                                                  </td>
                                                  </tr>


                
                






                                                <tr>
 <tr>

                                                  <td><div align="left">Product Image</div></td>

                                                  <td colspan="3">
                                                      
                                                      <?php 
                                                      if($pcat==1)
                                                       {
                                                        $slting=mysqli_query($con1,"SELECT * FROM `fashion_img` where product_id='".$pcode."'");
                                                        
                                                       }
                                                       else if($pcat==190)
                                                       {
                                                        $slting=mysqli_query($con1,"SELECT * FROM `electronics_img` where product_id='".$pcode."'");
                                                       }
                                                        else if($pcat==218)
                                                       {
                                                        $slting=mysqli_query($con1,"SELECT * FROM `grocery_img` where product_id='".$pcode."'");
                                                       }
                                                         else if($pcat==482)
                                                       {
                                                        $slting=mysqli_query($con1,"SELECT * FROM `Resale_img` where product_id='".$pcode."'");
                                                       }
                                                        else 
                                                       {
                                                      
                                                        $slting=mysqli_query($con1,"SELECT * FROM `product_img` where product_id='".$pcode."'");
                                                       }
                                                       
                                                       
                                                       
while($sltingf=mysqli_fetch_array($slting))
{
  
?>
                                                    
                                                      
                                                       <img src="<?php echo $mainpath.$sltingf['img']; ?>" width="50" height="50">
                                                      <input type="file" name="image[]" class="form" />
                                                 <input type="hidden" name="oldimg[]" class="form" value="<?php echo $sltingf['img']; ?>"/>
                                                 <input type="hidden" name="oldimgid[]" class="form" value="<?php echo $sltingf['id']; ?>"/>
                                                 
                                                 <input type="hidden" name="oldimgthumbs[]" class="form" value="<?php echo $sltingf['thumbs']; ?>"/>
                                                 
                                                 <input type="hidden" name="oldimgmidsize[]" class="form" value="<?php echo $sltingf['midsize']; ?>"/>
                                                 <?php }
                                                 ?>
<button type="button" class="btn blue" onClick="addItem();">ADD MORE Images</button></td>
                                                </tr>                                                                                               

                                              

                </table>
<table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch1">

                                               
                                                <tr>

                                                  <td width="270px"><div align="left">Price</div></td>

                                                  <td colspan="3" ><input type="text" name="price" class="form form-full" value="<?php echo $row2[6]?>" required/></td>

                                                </tr>
                                                
                                                
                                                
                                              
                                                
                                                
                                             <tr>

                                                  <td width="300px"> <div align="left">Discount</div></td>

                                                  <td colspan="3"><input type="radio" name="discount" class="form " id="disct" value="P" checked>% <input type="radio" name="discount" class="form " value="R">Rs. <input type="text" name="discnt" id="discnt" class="form " onkeyup="return t1()" value="<?php echo $row2[8]; ?>"/></td>

                                                </tr>
                                              
                                                 
                                                
                                                
                                                <tr>

                                                  <td width="300px">Long Description</td>

                                                  <td colspan="3"><textarea  id="editor" name="editor" cols='60' value="  " ><?php echo $row2['Long_desc'];?></textarea></td>
                                                 </tr>
                                                 
                                                
                                                
                                                
                                                <tr>
                                                  <td width="300px">Product Description</td>
                                                  <td colspan="3"><input type="text" name="P_desc" value="<?php echo $row2[7]; ?>" class="form form-full" /></td>
                                                </tr>



                                                  <tr>
                                                    <td width="300px">Specifications</td>
                                                  <td>
                                                      
                                                    
                                                  <?php 
                                                              if($pcat==1)
                                                                    {
                                                                          $qryspc=mysqli_query($con1,"SELECT * FROM `fashionSpecification` where product_id='".$pcode."'");
                                                      // echo "SELECT * FROM `fashionSpecification` where product_id='".$pcode."'";
                                                                    }
                                                                    else if($pcat==190)
                                                                    { $qryspc=mysqli_query($con1,"SELECT * FROM `electronicsSpecification` where product_id='".$pcode."'");
                                                       
                                                                    }
                                                                    else if($pcat==218)
                                                                    { $qryspc=mysqli_query($con1,"SELECT * FROM `grocerySpecification` where product_id='".$pcode."'");
                                                       
                                                                    }
                                                                     else if($pcat==482)
                                                                    { $qryspc=mysqli_query($con1,"SELECT * FROM `ResaleSpecification` where product_id='".$pcode."'");
                                                       
                                                                    }
                                                                    else
                                                                    {
                                                                    $qryspc=mysqli_query($con1,"SELECT * FROM `productspecification` where product_id='".$pcode."'");
                                                                    }

                                                  
                                                  
                                                  
                                                       // $qryspc=mysqli_query($con1,"SELECT * FROM `productspecification` where product_id='".$pcode."'");
                                                        
                                                                                              
while($prspcf=mysqli_fetch_array($qryspc))
{
   
    
?>
                                        <tr>
                                                 <td> <input type="text" name="specification1[]" value= "<?php echo $prspcf[2]; ?>" class="form form-full" /></td>
                                                <td><input type="text" name="specification[]" value="<?php echo $prspcf[3]; ?>" class="form form-full" /></td>
                                                <td><input type="hidden" name="id[]" value="<?php echo $prspcf[0]; ?>" class="form form-full" /></td>
                                                
                                                 
                                              
                                              





<?php } ?>
<td ><button type="button" class="btn blue" onClick="addSpts()">Add More</button></td>
</tr>
</td>
</tr>
</table>
<table>

                                        <tr>

                                          <td colspan="2" align="center">
<input type="hidden" name="ccode" id="ccode" value="<?php echo $id; ?>">
                                                  

<?php if($nrwsd>0) { ?>
                                            <input type="submit" value="Save Product" id="submit" name="submit" class="btn btn-submit" />
                                            
                                            <?php } ?>
                                              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error" onClick="history.go(-1);" />

                                        

                                          </td>

                                        </tr>

                                    </table>                                     
  </td>
 </tr>
  </table>
 </form>
    </div>
 
</div>
          </div>
        </div>
          </div>
        </div>
        
       
     <!-- Footer -->
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


<!--=================================ck editor=======================-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="script.js"></script>
<script src="ckeditor/ckeditor.js"></script>
  <script src="ckeditor/samples/js/sample.js"></script>
  <link rel="stylesheet" href="ckeditor/samples/css/samples.css">
  <script src="ckeditor/samples/js/sample1.js"></script>
<script>
  initSample();
    initSample1();
</script>
<!--=================================ck editor=======================-->



<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>

 
 
<script>

$(document).ready(function(){
    
    document.getElementById("pcat").value  ="<?php echo $row2[4]?>";
    chkcategory();
     
      
     
  });





$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.compny select option');
  var selected = $('.compny').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.compny').find('select').empty().append( my_options );
  $('.compny').find('select').val(selected);
  
  // set it to multiple
  $('.compny').find('select').attr('multiple', true);
  
  // remove all option
  $('.compny').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.compny').find('select').multiselect();
  
  
})

function chcolor(){
     
   var selected = $(".compny option:selected");
                var message = "";
                var message1 = "";
                selected.each(function () {
                //  message += $(this).text() + " " + $(this).val() + "\n";
                  message += $(this).val()+" ";
                 message1 += $(this).text()+"  ";
          
                });
              //alert(message1);
                
   var fields2 = message.split(" ");
    var q= fields2.slice(0, -1);
  //alert(q);
    var fields3 = message1.split("  ");
    var q1= fields3.slice(0, -1);
  // alert(q1);
   
 document.getElementById('hidden_color').value=q;
  
}


$(function() {
  // from http://stackoverflow.com/questions/45888/what-is-the-most-efficient-way-to-sort-an-html-selects-options-by-value-while
  var my_options = $('.Fsize select option');
  var selected = $('.Fsize').find('select').val();

  my_options.sort(function(a,b) {
    if (a.text > b.text) return 1;
    if (a.text < b.text) return -1;
    return 0
  })

  $('.Fsize').find('select').empty().append( my_options );
  $('.Fsize').find('select').val(selected);
  
  // set it to multiple
  $('.Fsize').find('select').attr('multiple', true);
  
  // remove all option
  $('.Fsize').find('select option[value=""]').remove();
  // add multiple select checkbox feature.
  $('.Fsize').find('select').multiselect();
 
 
})

function chsize(){
     var selected = $(".Fsize option:selected");
                var message = "";
                var message1 = "";
                selected.each(function () {
                //  message += $(this).text() + " " + $(this).val() + "\n";
                  message += $(this).val()+" ";
                 message1 += $(this).text()+"  ";
          
                });
              //alert(message1);
                
   var fields2 = message.split(" ");
    var q= fields2.slice(0, -1);
  //alert(q);
    var fields3 = message1.split("  ");
    var q1= fields3.slice(0, -1);
  // alert(q1);
   
    document.getElementById('hidden_size').value=q1;
    document.getElementById('hidden_sizeid').value=q;
  
  
  
}



</script>

<script>
         var valArr = [<?php echo $row2['size_id'];?>];
                        i = 0;
                        size = valArr.length;
                        $options = $('#size option');

                        for(i; i < size; i++)
                        {
                            $options.filter('[value="'+valArr[i]+'"]').prop('selected', true);
                        }
   
   

            var valArr1 = [<?php echo $row2['color'];?>];
               i = 0;
                size1 = valArr1.length;
                $options1 = $('#Catcolor option');

                for(i; i < size1; i++)
                {
                   $options1.filter('[value="'+valArr1[i]+'"]').prop('selected', true);
                }
     </script>
                                             
 <!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
-->
<link rel="stylesheet" type="text/css" href="css/dropdown.css">

<script>
                                                
                                              //  var bool1=false;
                                                function t1(){
                                                     
                                                   if(document.getElementById('disct').checked==true){
                                                     if(document.getElementById('discnt').value>95){
                                                         alert("please change discount value");
                                                         
                                                         return false;
                                                        
                                                     }
                                                     else{ 
                                                         return true;
                                                        
                                                         }
                                                        
                                                }
                                                   
                                                }
                                                </script>
