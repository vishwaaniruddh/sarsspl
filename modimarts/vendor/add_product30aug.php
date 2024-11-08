<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
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
  <link rel="stylesheet" type="text/css" href="pop.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
  <title>Merchant Add-product</title>
  <style>
      body{
              font-family: 'Open Sans',sans-serif !important;
              /*font: 16px / 1.8 Arial, 'Helvetica Neue', Helvetica, sans-serif;*/
              font: 16px , 'Open Sans',  sans-serif !important;
      }
  </style>
<script>

function subsmonth(m,rs)
{    
    var month=m;
    var price=rs;
    var mid=document.getElementById("ccode").value;
    window.open('subscriptionRecipt.php?mo='+month+'&pr='+price+'&mid='+mid , "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
} 

/*
function subsmonth(m,rs)
{    var month=m;
    var price=rs;

$.ajax({
   type: 'POST',    
url:'process_subscrib.php',
data:'month='+month+'&price='+price, 

success: function(msg){
alert(msg);
var modal = document.getElementById('myModal');
 modal.style.display = "none";
  window.open("add_product.php", "_self");
         }
     });

    
} */


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
 var rowCountImg=document.getElementById('imgcunrow').value;
  if(rowCountImg==2){
      $("#hdIMG").hide();
  }else{
      $("#hdIMG").show();
  }
 
 //var ctrw=1;
var r= parseInt(rowCountImg) + 1;
 
 //alert(parseInt(rowCountImg)+1)
    document.getElementById('imgcunrow').value=r;
    
    
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
var bool=true;
function chkCreatedCategory(){
  var Category=document.getElementById('CreateNewCategory').value;
  var pcat = document.getElementById("newMainCat");
  var MainCat = pcat.options[pcat.selectedIndex].value;
 $.ajax({
    type: 'POST',    
    url:'chkCreatedCategory.php',
    data:'Category='+Category+'&MainCat='+MainCat,
    success: function(msg){
   // alert(msg);
    if(msg==1){
    alert("Your New Category allready exist!");
    bool=false;
    }else{
      bool=true;
    }
     }
     });
}



//code  for if subscription package is expire then update clients table and  Subscription table  
function autos(){
    var ccode=document.getElementById('ccode').value;
                
 $.ajax({
   type: 'POST',    
url:'auto.php',
data:'ccode='+ccode,
success: function(msg){
//alert(msg);
         }
     });
}                              


function validation(){
   
           var pcat = document.getElementById("Maincat");
           var proct = pcat.options[pcat.selectedIndex].value;
      
          if(proct=="AddNewCategory"){
            var MainCat  = document.getElementById("newMainCat");
            var newMainCat = MainCat.options[MainCat.selectedIndex].value;
           
            var SubCat = document.getElementById("newSubCat");
            var newSubCat = SubCat.options[SubCat.selectedIndex].value;
            
             var UnderSubCat = document.getElementById("newSubCatUnder");
            var newUnderSubCat = UnderSubCat.options[UnderSubCat.selectedIndex].value;
            
             var CreateNewCategory  = document.getElementById("CreateNewCategory").value;
              var fileName = $("#NewCategoryImgUpload").val();
              
              
          
           if(newMainCat==""){alert("please Select Main Category"); return false;}
          else if(newSubCat==""){alert("please Select Sub Category"); return false;} 
          else if(newUnderSubCat==""){alert("Please select under sub category value"); return false;}
          
          else if(CreateNewCategory==""){alert("Please Enter New Category Name"); return false;} 
          else if(fileName==""){alert("Please Select File "); return false;}

         
        else{ 
           
          chkCreatedCategory();
            if(bool==true){return true;}
            else{return false;}
            }
          
          
          }else{
              t1();
            if(bool1==true){return true;}
            else{return false;}
            }
              
              
          }


</script>


<script>
function subscrip(){
  var subs=document.getElementById("subs").value;
  if(subs=="deactive")
 { 
     var r = confirm("Choose subscription package");
    if(r == true){
      s();
       return false;
     }
     /*swal({
      title: "Subscribe",
      text: "Choose subscription package!",
      type: "info",
      showCancelButton: true,
      confirmButtonClass: "btn-info",
      confirmButtonText: "Yes, Subscribe!",
      cancelButtonText: "No, cancel!",
      
    },
    function(isConfirm) {
      if (isConfirm) {
          alert('g')
        s();
       return false;
      } else {
        swal("Cancelled", " :)", "error");
      }
    });*/
 }
 if(subs=="Expire")
 { var r = confirm("your subscription is Expire, Are you sure you want to subscrip");
   if(r == true){
     s();
    return false;
      }
      }
  
  
    return true;
}

    function s(){
        
          // Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("submit1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

    modal.style.display = "block";


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
/*window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/
   
        
    }
    
    //
</script>
<!--code for subscription pop up window  choose pakage  :- Code End    -->

<?php
include('header.php');
?>

 

<body onload="autos();subscrip();">
    
    <!--code for subscription pop up window  choose pakage   :-code start -->
 
<!-- The Modal -->
<div  id="myModal" class="modal" style="left: 697px">
  <!-- Modal content -->
  <div class="modal-content" style="width:70%">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h4>Product Subscription </h4>
    </div>
    <div class="modal-body">
          <table class="table table-bordered" style="width:100%" >
              <thead class="thead-dark">
                <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">1 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                    </td>
                    <td>
                        <input type="button" class="btn-warning modal-css"  value="1 month" onclick="subsmonth('1','1000');"/>
                    </td>
                </tr>
                </thead>
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">3 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                         </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="3 month" onclick="subsmonth('3','3000');"/>
                  </td>
                 </tr>
                 
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">6 Month Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                         </td>
                    <td>
                           <input type="button" class="btn-warning modal-css" value="6 month" onclick="subsmonth('6','6000');"/>
                   </td>
                </tr>
            
                 <tr>
                    <td>
                        <div class="payment-description">
                            <p class="title open-sans">1 Year Trial Subscription</p>
                            <p class="description">Stream select videos in HD/4K and access 1 VR scene</p>
                        </div>
                         </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="12 month"  onclick="subsmonth('12','12000');"/>
                    </td>
                </tr>
                    </table>
                 <!--<p >Some other text</p>-->
                 
                 
    </div>
   
  </div>

</div>


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
              <h3 class="widget-header-title" style="line-height: 0px !important;"><strong >Add Product </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   	<form id="form11" name="form11"  action="processAddProducts.php" method="post" enctype="multipart/form-data" onsubmit="return validation()" >
     <!--	<form id="form11" name="form11" onsubmit="return subscrip();" action="processAddProducts.php" method="post" enctype="multipart/form-data"  >-->
      <table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch">
           <tr>
                <td align="center" colspan="2"><b><font color="#000000" size="+1">YOUR PRODUCT DETAILS</font></b> </td>
                <!-- <tr>
                    <td>Product Code</td>
                        <td colspan="3"><input type="text" name="pcode" class="form form-full" value="<?php echo $row2[0]+1;?>" readonly="readonly"/></td>
                            </tr>-->
                         <tr>
                      <td><div align="left">Product Category</div></td>
                <td colspan="3"><div id="res">
<?php 
$clintct=mysql_query("SELECT cid,subscribe FROM `clients` WHERE `code` = '".$id."'");
//echo "SELECT cid,subscribe FROM `clients` WHERE `code` = '".$id."'";
//echo "SELECT cid FROM `clients` WHERE `code` = '".$id."'";
$clintctf=mysql_fetch_row($clintct);

$catarr="";
//echo "test".$clintctf[0];
?>
<input type="hidden" id="subs" value="<?php echo $clintctf[1] ?>"/>
<!--<select id="pcat" name="pcat" class="form form-full" onchange="chkcategory();" required>
    <option value="">Select Category</option>
<optgroup label="Add New Category">
<option value="AddNewCategory">Create Category</option></optgroup>
<?php 
$maincat=mysql_query("SELECT id FROM `main_cat` where under in ($clintctf[0]) ");
while($maincatf=mysql_fetch_row($maincat))
{
    if($catarr==""){
    $catarr=$maincatf[0];
    }else{
      $catarr=$catarr.','.$maincatf[0];
    }
}
    $querycat=mysql_query("SELECT * FROM `main_cat` where id in ($catarr) or under in($catarr) order by name");
    while($querycatf=mysql_fetch_array($querycat))
    {
?>
    <optgroup label="<?php  echo $querycatf[1];?>" >
 </option>
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
</select>-->
<select id="Maincat" name="Maincat" class="form form-full" onchange="chkcategory();setSubCategory2('Maincat','Maincategory','newSubCat2');" required>
    <option value="">Select Category</option>
    <optgroup label="Add New Category">
    <option value="AddNewCategory">Create Category</option></optgroup>
    <?php 
        $maincat=mysql_query("SELECT id FROM `main_cat` where under in ($clintctf[0]) ");
        while($maincatf=mysql_fetch_row($maincat))
        {
            if($catarr==""){
            $catarr=$maincatf[0];
            }else {
              $catarr=$catarr.','.$maincatf[0];
            }
        }
        $querycat=mysql_query("SELECT id,name FROM `main_cat` where id IN ($clintctf[0]) order by name");
    ?>
    <optgroup label="Product Category">Product Category</optgroup>
    <?
        while($querycatf=mysql_fetch_array($querycat))
    {?>
      <option value="<?php echo $querycatf['id'];?>"><?php echo $querycatf['name'];?></option>
<?php
}
?>
</select>
<!--<input type="text" name="pcat" class="form form-full" />-->
</div>
</td>
</tr>
    <tr id="hd_NewCategory3" Style="">
        <td>Select Sub Category</td>
        <td><select id="newSubCat2" name="newSubCat2" class="form form-full" onchange="setSubCategory2('newSubCat2','Subcat','pcat')"><option value="">Select</option></select></td>
        <td>Select Category</td>
        <td>
            <select id="pcat" name="pcat" class="form form-full" >
              <option value="">Select</option>
            </select>
        </td>
    </tr>
    <tr id="hd_NewCategory1" Style="display:none">
      <td>Select Main Category</td>
      <td><select id="newMainCat" name="newMainCat"   onchange="setSubCategory2('newMainCat','Maincategory','newSubCat')"><option value="">Select</option>
      <?php $mnCat=mysql_query("SELECT id,name FROM `main_cat` where id IN ($clintctf[0])");
      while($fetchC=mysql_fetch_array($mnCat)){
      ?>
      <option value="<?php echo $fetchC['id'];?>"><?php echo $fetchC['name'];?></option>
      <?php } ?>
      </select>
     <!-- <td>Select Sub Category</td>-->
      <td><select id="newSubCat" name="newSubCat" onchange="setSubCategory2('newSubCat','Subcat','newSubCatUnder')"><option value="">Select</option></select></td>
      <td><select id="newSubCatUnder" name="newSubCatUnder"><option value="">Select</option></select></td>
      </tr>
   <tr id="hd_NewCategory2" Style="display:none">
       <td>Create New Category</td>
   <td><input type="text" name="CreateNewCategory" id="CreateNewCategory" class="form form-full"  onblur="chkCreatedCategory()" /></td>
   <td   colspan="2">Category Image
   <input type="file" id="NewCategoryImgUpload" name="NewCategoryImgUpload"></td>
   </tr>
                                                
                                                </div>


                                               
                                                <tr>

                                                  <td>Product Name</td>

                                                  <td colspan="3">
                                                      <!--<input type="text" name="pname" class="form form-full" onclick="subscrip();" required/>-->
                                                      <input type="text" name="pname" class="form form-full" required/>
                                                  </td>

                                                </tr>

                                               <!-- <tr>

                                                  <td><div align="left">Product Description</div></td>

                                                  <td colspan="3"><input type="text" name="pdesc" class="form form-full" required/></td>

                                                </tr>-->
                                             
                                                
                                                 <tr>

                                                  <td><div align="left">Product Brand</div></td>

                                                  <td colspan="3"><input type="text" name="pbrand" class="form form-full" required/></td>

                                                </tr>

		             
                
                <script>
                
                
                
                function setSubCategory(){
                    
           var pcat = document.getElementById("newMainCat");
           var proct = pcat.options[pcat.selectedIndex].value;
            //alert(proct)
            chkcategory();
             $.ajax({
                    type: 'POST',    
                    url:'setSubCategory.php',
                    data:'proct='+proct+'&maincat=NewCat', 
                     datatype:'json',
                    success: function(msg){
                   //alert(msg)
                   var jsr=JSON.parse(msg);
                       var newoption=' <option value="">Select</option>' ;
                        $('#newSubCat').empty();
                        
                        for(var i=0;i<jsr.length;i++)
                        {
                           newoption+= '<option id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'   >'+jsr[i]["name"]+'</option> ';
		                }                       
                     	$('#newSubCat').append(newoption);
                     
         }
     });
            
                }
                
                
                
                function setSubCategory2(dropvalue,diff,set){
                    
           var pcat = document.getElementById(dropvalue);
           var proct = pcat.options[pcat.selectedIndex].value;
            
           // chkcategory();
             $.ajax({
                    type: 'POST',    
                    url:'setSubCategory.php',
                    data:'proct='+proct+'&maincat='+diff, 
                     datatype:'json',
                    success: function(msg){
                    //  alert(msg)
                   var jsr=JSON.parse(msg);
                       var newoption=' <option value="">Select</option>' ;
                       var heading='';
                       
                           
//<optgroup label="Add New Category">
//<option value="AddNewCategory">Create Category</option></optgroup>
                        $('#'+set).empty();
                        
                     
                        
                       if(diff=="Subcat"){
                        
                            for(var i=0;i<jsr.length;i++)
                            {  
                                if(jsr[i]["heading"]!=""){
                                newoption+='<optgroup label='+ jsr[i]["name"]+'>';
                                newoption+=' <option  id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'>'+ jsr[i]["name"]+'</option></optgroup>';
                                }else{
                               newoption+= '<option id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'   >'+jsr[i]["name"]+'</option> ';
    		                         } 
    		                }  
                        }else{
                             for(var i=0;i<jsr.length;i++)
                                {  
                                   newoption+= '<option id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'   >'+jsr[i]["name"]+'</option> ';
        		                } 
		                } 
		                
		                if(set=="newSubCatUnder"){
                           newoption+= '<option id='+"none"+' value='+"none"+'   >'+"none"+'</option> '; 
                            }
		                
                     	$('#'+set).append(newoption);
                     
         }
     });
            
                }
                
                
                
        function chkcategory(){
           
           var pcat = document.getElementById("Maincat");
           var proct = pcat.options[pcat.selectedIndex].value;
      
         if(proct=="AddNewCategory"){
             
                $('#newSubCat2').prop('selectedIndex',0);
                $('#pcat').prop('selectedIndex',0);
            
                 $("#hd_NewCategory1").show();
                 $("#hd_NewCategory2").show();
                 $("#hd_NewCategory3").hide();
               
         }else{
                $('#newMainCat').prop('selectedIndex',0);
                $('#newSubCat').prop('selectedIndex',0);
             document.getElementById("CreateNewCategory").value="";
             
          $("#hd_NewCategory1").hide();
          $("#hd_NewCategory2").hide();
          $("#hd_NewCategory3").show();
         
         }
         
         
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
                        $("#h1").show();
                        $("#h2").show();
                    }
                     
         }
     });
//}
        }
</script>

                
                
                
<?php 

 $qry="select * from fashioncolor ";
 $result=mysql_query($qry); 
?>

                                                  <tr id="h1" style="display:none">
                                                  <td><div align="left">Product color</div></td>
                                                  <td colspan="3">
                                                   <div class="compny">

    
                                                  <span class="input">
                                                  <select   id="Catcolor" name="Catcolor" class="form form-full"   onchange="chcolor()" style="width: 50px;">
                                                	<option   value="" />Select Color</option>
                                                    <?php 
                                            		   while($row = mysql_fetch_row($result))
				                                	{  ?>
				
				
				
      	                                    <option   value="<?php echo $row[0]; ?>" /><?php echo $row[1]; ?></option>
                                          <br/>
   	
		                            <?php } ?>
                            </select>
                        </span>
                    </div>
                                                  </td>
                                                  </tr>


<input type="hidden" id="hidden_color" name="hidden_color"/>
<input type="hidden" id="hidden_size" name="hidden_size"/>
<input type="hidden" id="hidden_sizeid" name="hidden_sizeid" value="<?php echo $row2['size_id']; ?>"/>
                                                 <tr id="h2" style="display:none">
                                                  <td><div align="left">Product Size</div></td>
                                                  <td colspan="3">
                                                    <div class="Fsize">
                                                <span class="input">
                                                    <select   id="size" name="size" class="form form-full"   onchange="chsize()" style="width: 150px;">
                                                     	<option   value="" style="width: 150px;"/>Select Size</option>
                                                        <option   value="1" />Small</option>
                                                        <option   value="2" />Medium</option>
                                                        <option   value="3" />Large</option>
                                                        <option   value="4" />XL</option>
                                                      	<option   value="4" />XXL</option>
                                                      	
                    
                                                    </select>
                                                </span>
                                            </div>  
                                                    
                                                  </td>
                                                  </tr>




                                                <tr>

                                                  <td><div align="left">Product Image</div></td>

                                                  <td colspan="3">
                                                      <input type="hidden" id="imgcunrow" name="imgcunrow" value="0"/>
                                                      <input type="file" name="image[]" class="form"  required  />
<button type="button" class="btn blue" id="hdIMG" onClick="addItem();">ADD MORE Images</button></td>

                                                </tr>                                                                                               

                                              

                </table>
<table class="tables"  align="center" cellpadding="4" cellspacing="0" id="attatch1">

                                               
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

                                                  <td colspan="3"><input type="radio" name="discount" id="disct"  class="form " value="P" checked>% <input type="radio" name="discount"   class="form " value="R">Rs. <input type="text" name="discnt" id="discnt" class="form" onkeyup="t1()" value="" /></td>

                                                </tr>
                                                
                                                
                                                    <script>
                                                
var bool1=false;
                                                function t1(){ 
                                                   if(document.getElementById('disct').checked==true){
                                                     if(document.getElementById('discnt').value>95){
                                                         alert("please change discount value");
                                                         bool1=false;
                                                     }
                                                     else{ 
                                                         bool1=true;
                                                         }
                                                }}
                                                
                                                $('#discnt').on('input', function () {
        this.value = this.value.match(/^\d+\.?\d{0,2}/);
    });

                                                </script>
                                                
                                                
                                              
                                                
                                                
                                                
                                                 
                                                 
                                                  <tr>

                                                  <td width="300px">Long Description</td>

                                                  <td colspan="3"><textarea   id="editor" name="editor"></textarea></td>
                                                 </tr>
                                                 
                                                 
                                                 <tr>

                                                  <td width="300px">Product Description</td>

                                                  <td colspan="3"><input type="text" name="others" class="form form-full" /></td>
                                                 </tr>
                                                 
                                                     <tr>

                                                  <td width="300px">Other</td>

                                                  <td colspan="3"><textarea  id="editor1" name="editor1"  ></textarea></td>
                                                 </tr>
                                         <tr>
                                            <td width="300px">Specifications</td>
                                            <td><input type="text" name="specification1[]" class="form form-full" /></td>
                                            <td><input type="text" name="specification[]" class="form form-full" /></td>
                                            <td ><button type="button" class="btn blue" onClick="addSpts()">Add More</button></td>
                                        </tr>
                                    </table>
                                    <table>
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
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

 <!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
-->
<link rel="stylesheet" type="text/css" href="css/dropdown.css">







