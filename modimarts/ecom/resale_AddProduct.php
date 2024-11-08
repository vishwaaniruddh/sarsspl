<?php
//session_start();
include('config.php');
session_start();
/*var_dump($_SESSION);exit;
if(isset($_SESSION['email']) && isset($_SESSION['loginstats']))
{
    echo '1'
    ;exit;*/
?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Merabazaar</title>
<link rel="stylesheet" href="">
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
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <!-- FONT -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Roboto:300,400,500">
               <!-- Ruchi -->
    	        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                <style>
                .h1{
                    font-family: 'Roboto';font-size: 22px;
                   }
                  #btnAddProd
                 /* {
                      height: 25px;
                      padding-top: 0px;
                      margin-left: 35px;
                      padding-right: 0px;
                      padding-left: 0px;
                      padding-bottom: 0px;
                      width: 0px;"
                    } */
                </style>
                <script>
                    
function addItem()
{//alert("ok")
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
            newdiv.innerHTML=xmlhttp.responseText;	
            
            var table = document.getElementById("attatch");
            var rowCount = table.rows.length;
           
   if(rowCount==3){
       $("[name=hdImg]").hide();
   }else{
       $("[name=hdImg]").show();
   }
   
        	document.getElementById('attatch').appendChild(newdiv);
    }
  }
 
xmlhttp.open("GET","resale_addrowimg.php",true);
xmlhttp.send();	
}



function deleterow() {
    var table = document.getElementById("attatch");
    var rowCount = table.rows.length;
if(rowCount!=1){
    table.deleteRow(rowCount -1);
}

if(rowCount==3){
       $("[name=hdImg]").hide();
   }else{
       $("[name=hdImg]").show();
   }
   

}

function deleterowspec() {
    
    var table1 = document.getElementById("attatch1");
    var rowCount1 = table1.rows.length;
   
if(rowCount1!=1){
    table1.deleteRow(rowCount1 -1);
}
}





function addSpts()
{
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
xmlhttp.open("GET","resale_addrowspec.php",true);
xmlhttp.send();	
}


function cat_type()
{
   var cat=document.getElementById('Category');
   var cate=cat.options[cat.selectedIndex].text;
  
  document.getElementById('categorytype').value=cate;
  
}
</script>

</head>
  <body class="common-home page-common-home layout-fullwidth" onload="">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
      <header id="header-layout" class="header-v2">
         <div id="header-main">
            <div class="row">
            <?php include('resale_menu.php')?>
            </div>
         </div>
      </header>
      <div class="container">
    <div >
    <div class="row col-sm-offset-2" align="center">
    <div id="content" class="col-sm-9 container">      
    <h3>Add Product Details</h3>
    	<form id="form11" name="form11"  action="resale_processAddProducts.php" method="post" enctype="multipart/form-data"  >
       <fieldset id="account">
          <!--<legend>YOUR PRODUCT DETAILS</legend>-->
          <div class="form-group col-md-12">
            <label class="col-md-4 control-label">Product Name</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
               <input id="productName" name="productName" placeholder="Product Name" class="form-control" required="true" value="" type="text">
            </div>
            </div>
         </div>	
          <!--<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-productName">Product Name</label>
            <div class="col-sm-9">
              <input type="text" name="productName"  id="productName" class="form-control" placeholder="Product Name"  required autofocus/>
            </div>
          </div>-->
          <div class="form-group col-md-12">
            <label class="col-md-4 control-label">Brand</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
               <input id="brand" name="brand" placeholder="Brand" class="form-control" required="true"  type="text">
            </div>
            </div>
         </div>	
          <!--<div class="form-group required">
            <label class="col-sm-2 control-label" for="input-Brand">Brand</label>
            <div class="col-sm-9">
              <input type="text" name="brand"  placeholder="brand"  id="brand" class="form-control"  required autofocus/>
            </div>
          </div>-->
          <div class="form-group col-md-12">
            <label class="col-md-4 control-label">Price</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
               <input id="price" name="price" placeholder="price" class="form-control" required="true"  type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autofocus>
            </div>
            </div>
         </div>
          
         <!-- <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-Price">Price</label>
            <div class="col-sm-9">
              <input type="text" name="price"  placeholder="price"  id="price" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  required autofocus/>
            </div>
          </div>-->
          <div class="form-group col-md-12">
            <label class="col-md-4 control-label">Category</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                    <input type="hidden" id="categorytype" name="categorytype" />
                    <select  name="Category" id="Category" class="form-control" onchange="cat_type()" required autofocus>
                        <option value="" >Select Category</option>
               <?php 
               $qcategory=mysqli_query($con1,"select * from resale_category");
                while($result=mysqli_fetch_array($qcategory)){
               ?>
               <option value="<?php echo $result[0]; ?>" ><?php echo $result[1]; ?></option>
                 <? } ?>
             </select>
            </div>
            </div>
         </div>
          <?php /* <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-Price">Category</label>
            <div class="col-sm-9">
                <input type="hidden" id="categorytype" name="categorytype" />
                
             <select  name="Category"   id="Category" class="form-control" onchange="cat_type()" required autofocus>
                 <option value="" >Select Category</option>
               <?php 
               $qcategory=mysqli_query($con1,"select * from resale_category");
                while($result=mysqli_fetch_array($qcategory)){
               ?>
               <option value="<?php echo $result[0]; ?>" ><?php echo $result[1]; ?></option>
                 <? } ?>
             </select>
             </div>
          </div>
          */?>
          <div class="form-group col-md-12">    
            <label class="col-md-4 control-label">Long Description</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <textarea rows="3" id="editor"  name="editor" class="form-control" required autofocus/></textarea>
              </div>
            </div>
          </div>
          
         <!-- <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-Price" style="width: 141px;padding-top: 202px;">Long Description</label>
            <div class="col-sm-9">
              <textarea   id="editor" name="editor"></textarea>
            </div>
          </div>-->
         <!-- <div class="form-group col-md-12">
            <label class="col-md-2 control-label">Specifications</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                    <span><input type="text" name="specification1[]" class="form-control col-md-4"  />
                    <input type="text" name="specification[]" class="form-control col-md-4" />
                    <button type="button" class="btn blue col-md-2" onClick="addSpts()" id="btnAddProd"/><img src="images\addprod.png"/></button>
                    <button type="button" class="btn blue col-md-2" onClick="deleterowspec();" id="btnAddProd"><img src="images\remove.jpg"/></button>
                    </span>
                </div>
            </div>
         </div> -->
          <div class="form-group col-md-12" >
            <label class="col-md-4 control-label">Specifications</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group">
                   <table id="attatch1">
                        <tr>
                            <td class="col-md-4"><input type="text" name="specification1[]" class="form-control" style="margin: 0px 202px 8px -25px;"/></td>
                            <td class="col-md-4"><input type="text" name="specification[]" class="form-control" /></td>
                            <td class="col-md-3"><button type="button" class="btn blue" onClick="addSpts()" id="btnAddProd" /><img src="images\addprod.png"/>
                            </button><button type="button" class="btn blue" onClick="deleterowspec();" id="btnAddProd"><img src="images\remove.jpg"/></button></td>
                       </tr>
                    </table> 
                </div>
            </div>
        <!-- </div>-->
          <!--<table id="attatch1">
            <tr >
                <td class="col-sm-1 control-label" for="input-Specifications">Specifications</td>
                <td class="col-sm-4"><input type="text" name="specification1[]" class="form-control" style="margin-left: 14px;" /></td>
                <td class="col-sm-4"><input type="text" name="specification[]" class="form-control" /></td>
                <td class="col-sm-3"><button type="button" class="btn blue" onClick="addSpts()" id="btnAddProd" style="margin-left: 0px;"/><img src="images\addprod.png"/></button><button type="button" class="btn blue" onClick="deleterowspec();" id="btnAddProd"><img src="images\remove.jpg"/></button></td>
           </tr>
          </table> -->
           <div class="form-group col-md-12" style="padding-top: 15px;" >
               <label class="col-md-4 control-label">Product Image</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group">
                   <table id="attatch">
                       <tr>
                           <!--<td class="col-sm-1 control-label" for="input-Image">cccc</td>-->
                           <td class="col-sm-4"><input type="file" name="image[]" class="form-control"  required  style="margin: 0px 202px 8px -25px;"/></td>
                           <td class="col-sm-4"><button type="button" class="btn blue" onClick="addItem();"  id="btnAddProd" name="hdImg" ><img src="images\addprod.png"/></button>
                           <button type="button" class="btn blue" onClick="deleterow();" id="btnAddProd"><img src="images\remove.jpg"/></button></td>
                       <td class="col-sm-3"></td>
                       </tr>
                    </table> 
                </div>
            </div>
         </div>
          
          <!--<table id="attatch">
               <tr>
                   <td class="col-sm-1 control-label" for="input-Image">Product Image</td>
                   <td class="col-sm-4"><input type="file" name="image[]" class="form-control"  required  style="margin-left: 52px;"/></td>
                   <td class="col-sm-4"><button type="button" class="btn blue" onClick="addItem();"  id="btnAddProd" name="hdImg" ><img src="images\addprod.png"/></button>
                   <button type="button" class="btn blue" onClick="deleterow();" id="btnAddProd"><img src="images\remove.jpg"/></button></td>
               <td class="col-sm-3"></td>
               </tr>
          </table>-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400|Roboto:300,400,500">
        <style>
        input[type=text], textarea {
  -webkit-transition: all 0.30s ease-in-out;
  -moz-transition: all 0.30s ease-in-out;
  -ms-transition: all 0.30s ease-in-out;
  -o-transition: all 0.30s ease-in-out;
  outline: none;
  border: 1px solid #DDDDDD;
}
input[type=text]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
input[type=email]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
input[type=password]:focus, textarea:focus {
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
.form-control {
    border-radius: 10px; 
}
           
        </style>
       <div class="buttons col-md-12">
        <span style="    display: -webkit-inline-box;">
            <input type="submit" name="submit" value="Submit" data-loading-text="Loading..."  class="btn btn-primary" style="display:block;border-radius: 0;"/>
            <input type="button" name="Cancel" value="Cancel" data-loading-text="Loading..."  class="btn btn-primary" style="display:block;border-radius: 0;" onClick="javascript:history.go(-1)"/>
        </span>       
       </div>
    </form>
</div></div></div></div><br/>
<footer id="footer" class="nostylingboxs">
  <?php include("resale_footer.php")?>
</footer>
<div id="powered">
  <?php include('footerbottom.php')?>
</div>
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
</div>
</body>
</html>

<!--=================================ck editor=======================-->
<?php/*
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="script.js"></script>
<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<!--<link rel="stylesheet" href="ckeditor/samples/css/samples.css">-->
	<script src="ckeditor/samples/js/sample1.js"></script>
<script>
	initSample();
</script>
*/?>
<!--=================================ck editor=======================-->

   <?php
/*}else
{ 
 header("location: index.php");
} */           
               