<?php
session_start();
if (isset($_SESSION['adminuser']) && isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    //echo "id".$id;
    include "config.php";
    $qry2 = "select max(code) as ncode from products";
    $res2 = mysqli_query($con1, $qry2);
    $row2 = mysqli_fetch_array($res2);
    ?>
<!doctype html>
<html lang="en">
<head>
    <META HTTPS-EQUIV="Pragma" CONTENT="no-cache">
    <META HTTPS-EQUIV="Expires" CONTENT="-1">
    <!--============================ ck Editor ===============-->
    <meta https-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<link rel="stylesheet" href="adstyle.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
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
  <title>Vendor Add-product</title>
  <style>
      body{
          font-family: 'Open Sans',sans-serif !important;
          /*font: 16px / 1.8 Arial, 'Helvetica Neue', Helvetica, sans-serif;*/
          font: 16px , 'Open Sans',  sans-serif !important;
        }
        .lbl-prop{
            color: red;
            font-size: 14px;
        }

        .tables tr{
                border-bottom: 0 !important;
        }
        .no-space{
                white-space: nowrap;
        }
  </style>
<script>
/* Ruchi
function subsmonth(m,rs)
{
    var month=m;
    var price=rs;
    var mid=document.getElementById("ccode").value;
    window.open('subscriptionRecipt.php?mo='+month+'&pr='+price+'&mid='+mid , "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
} */
/*
function subsmonth(m,rs)
{   var month=m;
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

function subsmonth(id,mid)
{
    //alert(id);
    //var mid=document.getElementById("ccode").value;
    window.open('subscriptionRecipt.php?id='+id+'&mid='+mid , "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}

function addItem()
{
    //alert("ok");
    if (window.XMLHttpRequest)
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
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
            var rowCountImg=document.getElementById('imgcunrow').value;
            if(rowCountImg==2){
              $("#hdIMG").hide();
            } else {
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
    {
        // code for IE7+, Firefox, Chrome, Opera, Safari
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
//code for if subscription package is expire then update clients table and  Subscription table
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
    //  alert("hh");
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
            /* Ruchi :
            else if(newSubCat==""){alert("please Select Sub Category"); return false;}
            else if(newUnderSubCat==""){alert("Please select under sub category value"); return false;}*/

            else if(CreateNewCategory==""){alert("Please Enter New Category Name"); return false;}
            else if(fileName==""){alert("Please Select File "); return false;}
            else{
                chkCreatedCategory();
                if(bool==true){return true;}
                else{return false;}
            }
        } else {
                t1();
                 alert('b'+bool)
                if(bool==true){return true;}
                else{return false;}
        }
}
function subscrip(){
  var subs=document.getElementById("subs").value;
  if(subs=="Deactive")
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
 if(subs=="Expired")
 {
    var r = confirm("your subscription is Expire, Are you sure you want to subscrip");
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

<?php include 'header.php';?>
<body onload="autos();">
<!--code for subscription pop up window  choose pakage   :-code start -->
<!--Ruchi-->
<?php
$qry = mysqli_query($con1, "SELECT s.id as sid,s.period,s.type,sd.rate,sd.discount,sd.id FROM subscriptions s join  subscription_details sd on s.id=sd.subscription_id where sd.status!=2");
    ?>
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
            <thead>
                <tr>
                  <th scope="col">Sr no</th>
                  <th scope="col">Type</th>
                  <th scope="col">Period</th>
                  <th scope="col">Rate</th>
                  <th scope="col">Discount</th>
                  <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- <thead class="thead-dark">-->
                <?php $cnt = 1;
    while ($row = mysqli_fetch_assoc($qry)) {?>
                <tr>
                    <td>
                        <div class="payment-description">
                            <?php echo $cnt; ?>
                            <input type="hidden" name="id" value="<?php echo $row['sid']; ?>" >
                        </div>
                    </td>
                    <td>
                        <?php echo $row['type']; ?>
                    </td>
                    <td>
                        <?php echo $row['period']; ?>
                    </td>
                    <td>
                        <?php echo $row['rate']; ?>
                    </td>
                    <td>
                        <?php echo $row['discount']; ?>
                    </td>
                    <td>
                        <input type="button" class="btn-warning modal-css" value="Subscribe" onclick="subsmonth('<?php echo $row['id']; ?>','<?php echo $id; ?>');"/>
                    </td>
                </tr>
                <?php $cnt++;}?>
                <!--</thead>-->
            </table>
            <!--<p >Some other text</p>-->
        </div>
    </div>
</div>
<!-- Title & Sitemap -->
    <div class="title-sitemap grid-12">
        <h1 class="grid-10"><i>&#xf132;</i><span> Welcome to Vendor Panel</span> </h1>
    </div>
    </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div>
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title" style="line-height: 0px !important;"><strong > Add Product </strong></h3>
            </header>
            <div class="widget-body"><div>
            <form id="form11" name="form11"  action="add_prod_process.php" method="post" enctype="multipart/form-data" onsubmit="return validation()" >
            <!--<form id="form11" name="form11" onsubmit="return subscrip();" action="processAddProducts.php" method="post" enctype="multipart/form-data"  >-->
            <table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch">
           <tr>
            <td align="center" colspan="2"><b><font color="#000000" size="+1"> YOUR PRODUCT DETAILS </font></b> </td>
                <!-- <tr>
                    <td>Product Code</td>
                    <td colspan="3"><input type="text" name="pcode" class="form form-full" value="<?php echo $row2[0] + 1; ?>" readonly="readonly"/></td>
                </tr>-->
                <tr>
                    <td><div align="left">Product Category</div></td>
                    <td colspan="3">
                        <div id="res">
<?php
$clintct  = mysqli_query($con1, "SELECT cid,subscribe,email FROM `clients` WHERE `code` = '" . $id . "'");
    $clintctf = mysqli_fetch_row($clintct);
    $catarr   = "";

/* Ruchi */
    $sub              = '';
    $is_subscribe_qry = mysqli_query($con1, "SELECT *  FROM `Subscription` WHERE `mid` = '" . $id . "'");
    $is_subscribe     = mysqli_fetch_assoc($is_subscribe_qry);
    $cnt              = mysqli_num_rows($is_subscribe_qry);
    if ($cnt > 0) {
        /* echo '<pre>'; print_r($is_subscribe); echo '</pre>';*/
        $date = date('Y-m-d');
        if (strtotime($date) < strtotime($is_subscribe['tilldate'])) {
            $sub = 'Active';
        } else if (strtotime($date) > strtotime($is_subscribe['tilldate']) && strtotime($date) < strtotime($is_subscribe['grace_start_date'])) {
            $sub = 'Grace_Active';
        } else if (strtotime($date) > strtotime($is_subscribe['tilldate']) && strtotime($date) > strtotime($is_subscribe['grace_start_date'])) {
            $sub = 'Expired';
        } else {
            $sub = 'Deactive';
        }
    }
    $sub = 'Expired';
//echo 's:'.$sub;
    ?>

<!--<input type="hidden" id="subs" value="<?php echo $clintctf[1] ?>"/>-->
<input type="hidden" id="subs" value="<?php echo $sub; ?>"/>
<!-- Ruchi 10 sep 19 -->
<input type="hidden" id="email" name="email" value="<?php echo $clintctf[2] ?>"/>
<!--<select id="pcat" name="pcat" class="form form-full" onchange="chkcategory();" required>
    <option value="">Select Category</option>
<optgroup label="Add New Category">
<option value="AddNewCategory">Create Category</option></optgroup>
<?php
$maincat = mysqli_query($con1, "SELECT id FROM `main_cat` where  under in ($clintctf[0]) and status=1 ");
    while ($maincatf = mysqli_fetch_row($maincat)) {
        if ($catarr == "") {
            $catarr = $maincatf[0];
        } else {
            $catarr = $catarr . ',' . $maincatf[0];
        }
    }
    echo $catarr;
    $querycat = mysqli_query($con1, "SELECT * FROM `main_cat` where id in ($catarr) or under in($catarr) and status=1 order by name");
    while ($querycatf = mysqli_fetch_array($querycat)) {
        ?>
    <optgroup label="<?php echo $querycatf[1]; ?>" >
 </option>
<?php
$querycat1 = mysqli_query($con1, "SELECT * FROM `main_cat` where under ='" . $querycatf[0] . "'  and status=1 order by name ");
        while ($fechcat = mysqli_fetch_array($querycat1)) {
            $querycat2 = mysqli_query($con1, "SELECT * FROM `main_cat` where under ='" . $fechcat[0] . "' and status=1 order by name ");
            $fechcatr  = mysqli_num_rows($querycat2);
            if ($fechcatr > 0) {
                ?>
<optgroup label="<?php echo $fechcat[1]; ?>">

 <?php

                while ($fechcat2 = mysqli_fetch_array($querycat2)) {

                    ?>
<option value="<?php echo $fechcat2[0]; ?>"><?php echo $fechcat2[1]; ?></option>

<?php
}
            } else {
                ?>
    <option value="<?php echo $fechcat[0]; ?>"><?php echo $fechcat[1]; ?></option>
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
            <select id="Maincat" name="Maincat" class="form form-full" onchange="chkcategory();setSubCategory2('Maincat','Maincategory','newSubCat2');getBrands('Maincat',this.value);" >
                <option value="">Select Category</option>
                <optgroup label="Add New Category">
                <option value="AddNewCategory">Create Category</option></optgroup>
                <?php
$maincat = mysqli_query($con1, "SELECT id FROM `main_cat` where under in ($clintctf[0]) and status=1");
    while ($maincatf = mysqli_fetch_row($maincat)) {
        if ($catarr == "") {
            $catarr = $maincatf[0];
        } else {
            $catarr = $catarr . ',' . $maincatf[0];
        }
    }
    $querycat = mysqli_query($con1, "SELECT id,name FROM `main_cat` where  id IN ($clintctf[0]) and status=1 order by name");
    ?>
                <optgroup label="Product Category">
                <?
    while ($querycatf = mysqli_fetch_array($querycat)) {?>
                <option value="<?php echo $querycatf['id']; ?>"><?php echo $querycatf['name']; ?></option>
                <?php }?></optgroup>
            </select>
        <!--<input type="text" name="pcat" class="form form-full" />--></div>
        </td>
    </tr>
    <tr id="hd_NewCategory3" Style="">
        <td>Select Sub Category</td>
        <td>
            <select id="newSubCat2" name="newSubCat2" class="form form-full" onchange="setSubCategory2('newSubCat2','Subcat','pcat'),getBrands('newSubCat2',this.value);">
              <option value="">Select</option>
            </select>
        </td>
        <td>Select Product</td>
        <td>
            <select id="pcat" name="pcat" class="form form-full" onchange="getBrands('pcat',this.value);">
                <option value="">Select</option>
            </select>
        </td>
    </tr>
  <tr id="hd_NewCategory1" Style="display:none">
      <td>Select Main Category</td>
      <td>
          <select id="newMainCat" name="newMainCat"   onchange="setSubCategory2('newMainCat','Maincategory','newSubCat')"><option value="">Select</option>
      <?php $mnCat = mysqli_query($con1, "SELECT id,name FROM `main_cat` where id IN ($clintctf[0]) and status=1 ");
    while ($fetchC = mysqli_fetch_array($mnCat)) {
        ?>
      <option value="<?php echo $fetchC['id']; ?>"><?php echo $fetchC['name']; ?></option>
      <?php }?>
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
    <tr>
      <td>Select Brand</td>
      <td>

        <select name="pbrand"  id="pbrand" onchange="getProducts('pbrand');">
              <option value="">Select</option>

                <option id="otherbrand" value="otherbrand">other</option>
        </select>
        </td>
        <td>
        <div id="showbrand" style="display:none;">
           New Brand <input type="text" name="new_brand" id="new_brand"/>
        </div>
        </td>
        <tr>
            <td>
          <label>Weight: <small>Only in number</small></label>   <input type="text" class="form-control" name="weight" />
        </td>
        <td>
            <label for="">Type</label>
            <select name="type" class="form-control">
                <option value="Kg">Kg</option>
                <option value="Ltr">Ltr</option>
            </select>
        </td>
        </tr>

    </tr>
    <tr>
                              <td><div align="left">Related Product Group</div></td>
                              <td colspan="3">

                                  <select name="reletedpro" id="" class="form-control">
                                      <option value="">Select Related Group</option>
                                      <?php
$relatedgrp = mysqli_query($con1, "SELECT * FROM related_product_group ");
    // $rela_pro = mysqli_fetch_assoc($relatedgrp);

    while ($rela_pro = mysqli_fetch_array($relatedgrp)) {
        ?>
                                      <option value="<?=$rela_pro['id']?>" <?php if ($rela_pro['id'] == $product_name['related_grp_id']) {echo 'selected';}?>><?=$rela_pro['groupname']?></option>
                                    <?php
}
    ?>
                                  </select>
                                  </td>
                            </tr>
 <!-- </div>-->
 <tr>
    <td>Select Product Model</td>
        <td>
        <select name="pname"  id="pname" onchange="showDiv(this,'product');">
            <option value="">Select</option>
                <?php /*$prod=mysqli_query($con1,"SELECT * FROM `product_model` where status=1");
    while($fetchProd=mysqli_fetch_array($prod)){
    ?>
    <option value="<?php echo $fetchProd['id'];?>"><?php echo $fetchProd['product_model'];?></option>
    <?php  }*/?>
            <option id="otherproduct" value="otherproduct">other</option>
        </select>
        </td>
        <td>
        <div id="showproduct" style="display:none;">
           New Product <input type="text" id="new_product" name="new_product"/>
        </div>
        </td>
    </tr>
<?php /*<tr>
    <td>Product Name</td>
    <td colspan="3">
    <!--<input type="text" name="pname" class="form form-full" onclick="subscrip();" required/>-->
    <input type="text" name="pname" class="form form-full" required/>
    </td>
    </tr>*/?>
<!-- <tr>
        <td><div align="left">Product Description</div></td>
        <td colspan="3"><input type="text" name="pdesc" class="form form-full" required/></td>
    </tr>-->
   <!-- <tr>
    <td>
        <div align="left">Product Brand</div>
    </td>
      <td colspan="3"><input type="text" name="pbrand" class="form form-full" required/></td>
</tr>-->
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
                        newoption+='<option  id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'>'+ jsr[i]["name"]+'</option></optgroup>';
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

    /* Ruchi */
    function getBrands(feild,CatId){
   var pcat = document.getElementById(feild);
   var proct = pcat.options[pcat.selectedIndex].value;
   document.getElementById('hdCategory').value=proct;
    //alert(feild+'  '+proct)
    //chkcategory();
     $.ajax({
            type: 'POST',
            url:'setBrand.php',
            data:'proct='+proct+'&feild=pcat',
            datatype:'json',
            success: function(msg){
                //alert(msg)
                var jsr=JSON.parse(msg);
                //alert(jsr.length);
                var newoption=' <option value="">Select</option>' ;
                $('#pbrand').empty();

                for(var i=0;i<jsr.length;i++)
                {
                    //alert(jsr[i]['id'])
                   newoption+= '<option id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'   >'+jsr[i]["brand"]+'</option> ';
                }
                newoption+='<option id="otherbrand" value="otherbrand">other</option>';
                //alert(newoption);
                $('#pbrand').append(newoption);
            }
        });
    }
       /* $(document).ready(function(){
       $('#pbrand').change(function(){
           if ($(this).val() == 'other') {
               alert('pp');
               $('#showbrand').css({'display':'block'});
           }
        });
  });*/
  /* Ruchi */
    function getProducts(feild){
   var pcat = document.getElementById(feild);
   var proct = pcat.options[pcat.selectedIndex].value;
    if(proct=='otherbrand'){
    document.getElementById('showbrand').style.display = "block";
   } else{
        document.getElementById('showbrand').style.display = "none";

    //alert(feild+'  '+CatId)
    //chkcategory();
     $.ajax({
            type: 'POST',
            url:'setBrand.php',
            data:'proct='+proct+'&feild='+pcat+'&product=1',
            datatype:'json',
            success: function(msg){
            //alert(msg)
            var jsr=JSON.parse(msg);
            //alert(jsr.length);
               var newoption=' <option value="">Select</option>' ;
                $('#pname').empty();

                for(var i=0;i<jsr.length;i++)
                {
                    //alert(jsr[i]['id'])
                   newoption+= '<option id='+ jsr[i]["id"]+' value='+ jsr[i]["id"]+'   >'+jsr[i]["product"]+'</option> ';
                }
                newoption+='<option id="otherproduct" value="otherproduct">other</option>';
                //alert(newoption);
              $('#pname').append(newoption);
                }
            });
    }
        }
  function showDiv(select,id){
    var main_cat = document.getElementById('Maincat').id;
    //alert(select.value);
   if(select.value=='other'+id){
    document.getElementById('show'+id).style.display = "block";
   } else{
        document.getElementById('show'+id).style.display = "none";
   }
   if(select.id=='pname' && select.value!='otherproduct'){
       var i=select.value;
       $.ajax({
            type: 'POST',
            url:'getProductDetails.php',
            data:'id='+i+'&main_cat'+main_cat,
            datatype:'json',
            success: function(msg){
                var elem =['price','others','discnt'];
                alert(msg)
                var jsr=JSON.parse(msg);
                //alert(jsr[0]['image'].length);
                var img='';
                for(i=0;i<jsr[0]['image'].length;i++){
                     img+='<img src="https://allmart.world/'+jsr[0]['image'][1]+'" width="17%">';
                }
                $('#pimage').append(img);
                for(i=0;i<elem.length;i++){
                    //alert(elem[i])
                    document.getElementById(elem[i]).value = jsr[0][elem[i]];
                    //document.getElementById(elem[i]).readOnly = true;
                }
                CKEDITOR.instances['editor'].setData(jsr[0]['Long_desc']);
                CKEDITOR.instances['editor1'].setData(jsr[0]['description']);
                //CKEDITOR.instances['editor'].setReadOnly(true);
                //CKEDITOR.instances['editor1'].setReadOnly(true);
            }
        });
   }
}
function showEditor(id,get,set){
    //alert('id : '+id+'g : '+get+'s : '+set)
    document.getElementById(id).style.display = "block";
    var s =CKEDITOR.instances[get].getData();
    var a = document.getElementById('others')
    //alert('ff'+s)
    var v = '';
    if(s!=''){
        v = s;
    } else {
        v = a;
    }
    document.getElementById(set).value=v;
}

    </script>
    <?php
$qry    = "select * from fashioncolor ";
    $result = mysqli_query($con1, $qry);
    ?>
    <!--<tr id="h1" style="display:none">
        <td><div align="left">Product color</div></td>
        <td colspan="3">
            <div class="compny">
                <span class="input">
                    <select id="Catcolor" name="Catcolor" class="form form-full"   onchange="chcolor()" style="width: 50px;">
                      <option   value="" />Select Color</option>
                        <?php
while ($row = mysqli_fetch_row($result)) {?>
                        <option   value="<?php echo $row[0]; ?>" /><?php echo $row[1]; ?></option><br/>
                        <?php }?>
                    </select>
                </span>
            </div>
        </td>
    </tr>-->
    <!--<input type="hidden" id="hidden_color" name="hidden_color"/>
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
    </tr>-->

    <tr>
      <td>Product Unit</td>
      <td>
        <?php
$quanty_query = "select * from product_quantity ";
    $qtyresult    = mysqli_query($con1, $quanty_query);
    ?>
        <select name="quantity_unit"  id="quantity_unit" >
              <option value="">Select</option>
               <?php while ($row = mysqli_fetch_row($qtyresult)) {?>
                        <option   value="<?php echo $row[1]; ?>" /><?php echo $row[1]; ?></option><br/>
                        <?php }?>
        </select>
        </td>
        <td>

            Product Quantity : <input type="number" name="quantity" id="quantity" class="form form-full" step="0.1"/>

        </td>
    </tr>

    <tr>
        <td><div align="left">Product Image</div></td>
        <td >
            <div id="pimage"></div>
        </td>
        <td>
            <input type="hidden" id="imgcunrow" name="imgcunrow" value="0"/>
            <input type="file" name="image[]" class="form"    />
            <button type="button" class="btn blue" id="hdIMG" onClick="addItem();">ADD MORE Images</button>
        </td>
    </tr>

    <tr>
        <td><div align="left">Product Video</div></td>
        <td >
            <div id="pvideo"></div>
        </td>
        <td>
            <!--<input type="hidden" id="imgcunrow" name="imgcunrow" value="0"/>-->
            <input type="file" name="video" class="form"    />

        </td>
    </tr>
</table>
<table class="tables"  align="center" cellpadding="4" cellspacing="0" id="attatch1">
    <tr>
        <td ><div align="left">MRP</div></td>
        <td ><input type="text" name="price" id="price" class="form form-full" onchange="a()"  /></td>
        </tr>
        <tr><td >
          <div align="left">Allmart Commission</div>
        </td>
        <td  >
            <!--<input type="text" name="new_price" id="new_price" class="form form-full" onchange="a()" />-->
            <input type="text" name="allmart_commission" id="allmart_commission" class="form form-full" onchange="a()" />
        </td>
    </tr>
    <tr>
        <td ><div align="left" class="no-space">Provide Shipping : </div></td>
        <td >
            <select name="is_provide_shipping" id="is_provide_shipping" class="form-control" onchange="ischeckShop()">
                <option value="">Select Provide Shipping</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
    </tr>
    <tr id="shippingtype" style="display: none;">
        <td ><div align="left" class="no-space">Shipping charges : </div></td>
        <td >
             <select name="is_shipping" id="is_shipping" class="form-control" onchange="isShop()">
                <option value="">Select Shipping Charge</option>
                <option value="1">Charges</option>
                <option value="0">Free</option>
            </select>
        </td>
    </tr>
    <tr id="shipping1" style="display: none;">
        <td ><div align="left" class="no-space">Shipping charges(within area) : </div></td>
        <td ><input type="text" name="shipping_in_area" id="shipping_in_area" class="form form-full"  /></td>
    </tr>
    <tr id="shipping2" style="display: none;">
        <td ><div align="left" class="no-space">Shipping charges(outside state) : </div></td>
        <td ><input type="text" name="shipping_out_state" id="shipping_out_state" class="form form-full"  /></td>
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
        <td width="300px"> <div align="left">Offer Price</div></td>
        <td colspan="3">
            <input type="radio" name="discount" id="disct"  class="form" value="P" checked> %
            <input type="radio" name="discount" class="form" value="R">Rs. <input type="text" name="discnt" id="discnt" class="form" onkeyup="t1()" value="" />
        </td>
    </tr>
    <script>
        var bool1=false;
        function t1() {
           if(document.getElementById('disct').checked==true) {
                if(document.getElementById('discnt').value>95) {
                     alert("please change discount value");
                     bool1=false;
                } else {
                     bool1=true;
                }
            }
        }
        $('#discnt').on('input', function () {
            this.value = this.value.match(/^\d+\.?\d{0,2}/);
        });
    </script>
     <tr>
        <td width="300px">Long Description</td>
        <td colspan="3">
            <textarea id="editor" name="editor"></textarea>
            <button type="button" class="btn blue" onclick="showEditor('showeditor','editor','new_Long_desc');">Add More</button>
        </td>
        <td >
          <!--<button type="button" class="btn blue" onclick="showEditor('showeditor');">Add More</button>-->
            <div id="showeditor" style="display:none;">
                Additional Decription <input type="text" name="new_Long_desc" id="new_Long_desc"/>
            </div>
        </td>
     </tr>
     <tr>
      <td >Product Description</td>
      <td >
            <input type="text" id="new_others" name="new_others" class="form form-full" /></td>
            <button type="button" class="btn blue" onclick="showEditor('showeothers','others','new_others');">Add More</button>
      <td >
          <!--<button type="button" class="btn blue" onclick="showEditor('showeditor');">Add More</button>-->
            <div id="showeothers" style="display:none;">
                Additional Decription <input type="text" name="others" id="others"/>
            </div>
        </td>
     </tr>
     <tr>
      <td >Other</td>
      <td ><textarea  id="editor1" name="editor1"  ></textarea></td>
      <button type="button" class="btn blue" onclick="showEditor('showeditor1','editor1','new_description');">Add More</button>
      <td >
          <!--<button type="button" class="btn blue" onclick="showEditor('showeditor');">Add More</button>-->
            <div id="showeditor1" style="display:none;">
                Additional Decription <input type="text" name="new_description" id="new_description"/>
            </div>
        </td>
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
            <input type="hidden" name="hdCategory" id="hdCategory" value="0">
            <input type="submit" value="Add Product" id="add_submit" name="submit" class="btn btn-submit" <?php if ($sub == 'Deactive') {echo 'disabled';}?> />
            <?php if ($sub == 'Deactive') {?>
                <label class="lbl-prop">Please choose any subscription !</label>
            <?php }?>
                &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
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
} else {
    header("location: index.php");
}
?>
<!--=================================ck editor=======================-->
<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/custom.css">
  <!--<script type="text/javascript" src="script.js"></script>-->
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

<script>
    function isShop()
    {
        var is_shipping = $("#is_shipping").val();

        if (is_shipping=='1')
        {
            $("#shipping1").show();
            $("#shipping2").show();
        }
        else
        {
            $("#shipping1").hide();
            $("#shipping2").hide();
        }
    }
</script>

<script>
    function ischeckShop()
    {
        var is_provide_shipping = $("#is_provide_shipping").val();
        // alert(is_provide_shipping);

        if (is_provide_shipping=='1')
        {
            $("#shippingtype").show();
        }
        else
        {
            $("#shippingtype").hide();
            $("#shipping1").hide();
            $("#shipping2").hide();
        }
    }
</script>
 <!--<link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
-->
<link rel="stylesheet" type="text/css" href="css/dropdown.css">

