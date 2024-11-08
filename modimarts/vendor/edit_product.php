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
    $prod = mysqli_query($con1,"SELECT product_model,related_grp_id,weight,type,gst_with FROM product_model where id='".$row2[1]."'");
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

  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <title>allmart Merchant panel</title>
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
        <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to Merchant Panel</span></h1>
        <div class="sitemap grid-6">
            <ul>
                <li><span>Allmart</span><i>/</i></li>
                <li><a href="index.php">Merchant Panel</a></li>
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
                                  <input type="text" name="pcode" class="form form-full" value="<?php echo $row2[0];?>" readonly="readonly"/>
                                </td>
                            </tr>
                            <tr>
                              <td>Product Name</td>
                              <td colspan="3">
                                  <input type="text" name="pname" class="form form-full" value="<?php echo $product_name['product_model'];?>" required/>
                                  <input type="hidden" name="pro_modal_id" class="form form-full" value="<?php echo $row2[1];?>" required/>
                                  </td>
                            </tr>
                            <!--  <tr>
                              <td><div align="left">Product Description</div></td>
                              <td colspan="3"><input type="text" name="pdesc" class="form form-full" value="<?php echo $row2[3];?>" required/></td>
                            </tr>-->

                            <tr>
                              <td width="300px">Other</td>
                              <td colspan="3"><textarea  id="editor1" name="editor1"  ><?php echo $row2[7];?></textarea></td>
                             </tr>

                            <tr>
                              <td><div align="left">Product Brand<?php echo $row2["brand"];?></div></td>
                              <td colspan="3">
                                  <input type="text" name="pbrand" id="pbrand" class="form form-full" value="<?php echo $brand_name["brand"];?>" required/>
                                  <input type="hidden" name="p_brand_id"  class="form form-full" value="<?php echo $row2['brand'];?>" required/>
                                  </td>
                            </tr>
                            <tr>
                              <td><div align="left">Related Product Group</div></td>
                              <td colspan="3">
                                  <select name="reletedpro" id="" class="form-control">
                                      <option value="">Select Related Group</option>
                                      <?php
                                      $relatedgrp = mysqli_query($con1,"SELECT * FROM related_product_group ");
                                      // $rela_pro = mysqli_fetch_assoc($relatedgrp);

                                     while($rela_pro=mysqli_fetch_array($relatedgrp)) {
                                      ?>
                                      <option value="<?=$rela_pro['id']?>" <?php if($rela_pro['id']==$product_name['related_grp_id']){ echo  'selected';}?>><?=$rela_pro['groupname']?></option>
                                    <?php
                                     }
                                    ?>
                                  </select>
                                  </td>
                            </tr>
                            <tr>
            <td >
          <label>Weight: </label>   <input type="text" class="form-control" value="<?=$product_name['weight']?>" name="weight" />
        </td>
        <td>
            <label for="">Type</label>
            <select name="type" class="form-control">
                <option <?php if($product_name['type']=="Kg"){ echo "selected";} ?> value="Kg">Kg</option>
                <option <?php if($product_name['type']=="Ltr"){ echo "selected";} ?> value="Ltr">Ltr</option>
            </select>
        </td>
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
                                    <select id="pcat" name="pcat" class="form form-full" onchange="chkcategory();" <?php if($_GET['cat']!=='803'){ ?>  required <?php }?>>
                                        <?php
                                         $catsearch="select id,name from main_cat where under=0";
                    $cqry=mysqli_query($con1,$catsearch);
                    while($crows = mysqli_fetch_assoc($cqry)){?>
                        <option value="<?php echo $crows['id'];?>"><?php echo $crows['name'];?> </option>
                    <?php }

                                        // $maincat=mysqli_query($con1,"SELECT * FROM `main_cat` where under in ($clintctf[0])");
                                        // if($_GET['cat']=='803'){
                                        // $maincat=mysqli_query($con1,"SELECT * FROM `main_cat` where id in ($clintctf[0])");
                                        // }
                                        //  if($_GET['cat']!=='803'){
                                        // while($maincatf=mysqli_fetch_row($maincat))
                                        // {
                                        //     if($catarr==""){
                                        //     $catarr=$maincatf[0];
                                        //     }else{

                                        //       $catarr=$catarr.','.$maincatf[0];

                                        //     }
                                        // }

                                        // $querycat=mysqli_query($con1,"SELECT * FROM `main_cat` where id in ($catarr) ");
                                        // //echo "SELECT * FROM `main_cat` where id in ($catarr) ";

                                        // while($querycatf=mysqli_fetch_array($querycat))
                                        // {
                                            ?>

                                            <!-- <optgroup label="<?php  echo $querycatf[1];?>" > -->
                                                <!--   <option value="<?php  echo $querycatf[0];?>" style="background-color:#66e0ff" selected disabled><?php  echo $querycatf[1];?> -->
                                                <!-- </option> -->
                                                <?php
                                                // $querycat1=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$querycatf[0]."' order by name ");
                                                // while($fechcat=mysqli_fetch_array($querycat1))
                                                // {
                                                //     $querycat2=mysqli_query($con1,"SELECT * FROM `main_cat` where under ='".$fechcat[0]."' order by name ");
                                                //     $fechcatr=mysqli_num_rows($querycat2);

                                                //     if($fechcatr>0)
                                                //     {
                                                ?>
                                                        <!-- <optgroup label="<?php  echo $fechcat[1];?>"> -->
                                                        <?php
                                                        // while($fechcat2=mysqli_fetch_array($querycat2))
                                                        // {
                                                            ?>
                                                           <!--  <option value="<?php  echo $fechcat2[0];?>" <?php if($sltcat==$fechcat2[0]){ echo "selected";} ?>><?php  echo $fechcat2[1];?></option> -->
                                                        <?php
                                                    //      }
                                                    // }
                                                    // else{
                                                     ?>
                                                        <!-- <option value="<?php  echo $fechcat[0];?>" <?php if($sltcat==$fechcat[0]){ echo "selected";} ?>><?php  echo $fechcat[1];?></option> -->
                                                    <?php
                                                     // }
                                                      ?>
                                                    <!-- </optgroup> -->
                                                <?php
                                                 // }
                                                  ?>
                                            <!-- </optgroup> -->
                                        <?php
                                         // }
                                    // }
                                    // else
                                    // {
                                    //    while($maincatf=mysqli_fetch_row($maincat))
                                    //     {
                                    //         ?>
                                    //        <option value="<?php  echo $maincatf[0];?>" <?php if($sltcat==$fechcat[0]){ echo "selected";} ?>><?php  echo $maincatf[1];?></option>
                                    //         <?php
                                    //     }
                                    // }


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

                                    success: function(msg) {
                                        // alert(msg);
                                        if(msg==1){
                                           $("#h1").show();
                                            $("#h2").show();
                                        } else {
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

                                                  $mainpath = "https://allmart.world/ecom/";
                                                  // $sltingf=mysqli_fetch_array($slting);
                                                  // var_dump($sltingf['img']);


                                                  while($sltingf=mysqli_fetch_array($slting))
                                                    {

                                                    ?>
                                                 <img src="<?php echo $mainpath.$sltingf['img']; ?>" width="100" height="100"><a class="btn btn-primary" onclick="Removeimg('<?=$sltingf['id']?>','<?=$sltingf['img']?>','<?=$pcat?>')">Remove Image</a>
                                                 <input type="file" name="image[]" class="form" />
                                                 <input type="hidden" name="oldimg[]" class="form" value="<?php echo $sltingf['img']; ?>"/>
                                                 <input type="hidden" name="oldimgid[]" class="form" value="<?php echo $sltingf['id']; ?>"/>

                                                 <input type="hidden" name="oldimgthumbs[]" class="form" value="<?php echo $sltingf['thumbs']; ?>"/>

                                                 <input type="hidden" name="oldimgmidsize[]" class="form" value="<?php echo $sltingf['midsize']; ?>"/>

                                                 <?php }
                                                 ?>
                                                  <button type="button" class="btn blue" onClick="addItem();">ADD MORE Images</button></td>
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
<table class="tables"  align="center" cellpadding="4" cellspacing="0"  id="attatch1">


                                                <tr>

                                                  <td width="270px"><div align="left">Price</div></td>

                                                  <td colspan="3" ><input type="text" name="price" class="form form-full" value="<?php echo $row2[6]?>" required/></td>

                                                </tr>
                                                <tr>

                                                  <td width="270px"><div align="left">GST</div></td>

                                                  <td colspan="3" >
                                                      <select name="gst_with" class="form-control" id="">
                                                          <option value="1" <?php if($product_name['gst_with']==1){echo "selected";} ?>>Exclusive GST (Price Without GST)</option><option value="0" <?php if($product_name['gst_with']==0){echo "selected";}  ?>>Inclusive GST (Price With GST)</option>
                                                      </select>
                                                  </td>

                                                </tr>






                                             <tr>

                                                  <td width="300px"> <div align="left">Discount</div></td>

                                                  <td colspan="3"><input type="radio" name="discount" class="form " id="disct" value="P" checked>% <input type="radio" name="discount" class="form " value="R">Rs. <input type="text" name="discnt" id="discnt" class="form " onkeyup="return t1()" value="<?php echo $row2[8]; ?>"/></td>

                                                </tr>

                                                 <tr>
                                                  <td ><div align="left" class="no-space">Provide Shipping : </div></td>
                                                  <td >
                                                      <select name="is_provide_shipping" id="is_provide_shipping" class="form-control" onchange="ischeckShop()">
                                                          <option value="">Select Provide Shipping</option>
                                                          <option <?php if($row2[30]==1){echo "Selected";} ?> value="1">Yes</option>
                                                          <option <?php if($row2[30]==0){echo "Selected";} ?> value="0">No</option>
                                                          <option <?php if($row2[30]==2){echo "Selected";} ?>  value="2">At Actual</option>
                                                      </select>
                                              </tr>
                                              <tr id="shippingtype">
                                                  <td ><div align="left" class="no-space">Shipping charges : </div></td>
                                                  <td >
                                                       <select name="is_shipping" id="is_shipping" class="form-control" onchange="isShop()">
                                                          <option value="">Select Shipping Charge</option>
                                                          <option <?php if($row2[31]==1){echo "Selected";} ?> value="1">Charges</option>
                                                          <option <?php if($row2[31]==0){echo "Selected";} ?> value="0">Free</option>
                                                      </select>
                                                  </td>
                                              </tr>
                                              <tr id="shipping1" >
                                                  <td ><div align="left" class="no-space">Shipping charges(within area) : </div></td>
                                                  <td ><input type="text" value="<?=$row2[26]?>" name="shipping_in_area" id="shipping_in_area" class="form form-full"  /></td>
                                              </tr>
                                              <tr id="shipping2">
                                                <td ><div align="left" class="no-space">Shipping charges(outside state) : </div></td>
                                                <td ><input type="text" value="<?=$row2[27]?>" name="shipping_out_state" id="shipping_out_state" class="form form-full"  /></td>
                                            </tr>
                                              <tr id="shipping2">
                                                <td ><div align="left" class="no-space">AllMart Commission (%): </div></td>
                                                <td ><input type="text" value="<?=$row2['allmart_commission']?>" name="allmart_commission" id="allmart_commission" class="form form-full"  /></td>
                                            </tr>




                                                <tr>

                                                  <td width="300px">Long Description</td>

                                                  <td colspan="3"><textarea  id="editor" name="editor" cols='60' value="  " ><?php echo $row2['Long_desc'];?></textarea></td>
                                                 </tr>




                                                <tr>
                                                  <td width="300px">Product Description</td>
                                                  <td colspan="3"><textarea type="text" id="editor2" name="P_desc"  class="form-control" ><?php echo $row2[3]; ?></textarea></td>
                                                </tr>



                                                  <tr>
                                                    <td width="300px">Specifications</td>
                                                  <td></tr>


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
 $value= explode('-',$prspcf['product_specification']);
 $val1= $value[0];
 $val2= $value[1];


?>
                                       <tr>
        <td width="150px">
        <lable>variants Name</lable>
        <input type="text" name="var_name[]" value="<?=$prspcf['specificationname']?>" class="form form-full" />
        <input type="hidden" value="<?=$prspcf['id']?>" name="speci_id[]">
        </td>
        <td>
        <div class="row">
        <div class="col-md-4">
        <lable>variants price</lable>
        <input type="text" name="var_price[]" value="<?=$prspcf['product_mrp']?>" class="form form-full" />
        </div>
        <div class="col-md-4">
        <lable>variants offer price</lable>
        <input type="text" name="product_offerprice[]" value="<?=$prspcf['product_offerprice']?>" class="form form-full" />
        </div>
        <div class="col-md-4">
         <lable>variants Image</lable>
         <img src="https://allmart.world/ecom/<?=$prspcf['product_img']?>" alt="" width='60' height='60'>
        <input type="file" name="var_img[]" class="form form-full" />
        <input type="hidden" name="oldimg[]" value="<?=$prspcf['product_img']?>">
        </div>
        </div>
        </td>
    </tr>
    <tr>
      <td>
         <lable>variants value</lable>
        <input type="text" name="var_val1[]"  value="<?=$val1?>" class="form form-full" />
       </td>
       <td>
        <lable>variants type</lable>
         <input list="variants1" class="form-control" value="<?=$val2?>" name="var_val2[]" >
         <datalist id="variants1">
        </datalist>
      </td>
    </tr>
<?php } ?>

<!-- <tr>
        <td width="150px">
        <lable>variants Name</lable>
        <input type="text" name="var_name[]" class="form form-full" />
        </td>
        <td>
        <div class="row">
        <div class="col-md-4">
        <lable>variants price</lable>
        <input type="text" name="var_price[]" class="form form-full" />
        </div>
        <div class="col-md-4">
        <lable>variants offer price</lable>
        <input type="text" name="product_offerprice[]" class="form form-full" />
        </div>
        <div class="col-md-4">
         <lable>variants Image</lable>
        <input type="file" name="var_img[]" class="form form-full" />
        </div>
        </div>
        </td>
    </tr>
    <tr>
    <td width="150px">
     <lable>variants Type</lable>
     <select class="form-control" name="var_type[]" onchange="getchng(this.value,'1')">
        <option value="">Select Master</option>
            <?php
        $gquery = mysqli_query($con1, "SELECT * FROM `product_variant_master` WHERE under ='0'");
        while ($rowq = mysqli_fetch_assoc($gquery)) {
            ?> <option value="<?=$rowq['id']?>" ><?=$rowq['name']?></option>
            <?php
            }
            ?>
        </select>
     </td>
      <td>
      <div class="row">
        <div class="col-md-6">
         <lable>variants value</lable>
        <input type="text" name="var_val1[]" class="form form-full" />
        </div>
         <div class="col-md-6">
        <lable>variants type</lable>
         <input list="variants1" class="form-control" name="var_val2[]" >
         <datalist id="variants1">
        </datalist>
        </div>
        </div>
      </td>
    </tr> -->
     <tbody id="addtable">
    </tbody>
    <tr>
    <td></td>
        <td>
          <a class="btn btn-primary" onclick="Addbtn()" >Add More</a>
          <input type="hidden" name="rowcount" id="rowcount" value="1">
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
          <li><a href="http://www.allmart.world">Home</a><span>/</span></li>

          <li><a href="http://www.allmart.world/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 allmart.world. All rights Reserved!
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
  <script src="ckeditor/samples/js/sample2.js"></script>
<script>
  initSample();
    initSample1();
    initSample2();
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
    <script>
function getchng(val,num)
        {
            $.ajax({
                url: 'getunit.php',
                type: 'post',
                data: {id:val},
                success: function(response){
                    // alert(response);
                    $('#variants'+num).html(response);
                }
                });
        //    alert(val);
        }
</script>

   <script>
function Removeimg(id,img,pcat)
        {
            $.ajax({
                url: 'removeimg.php',
                type: 'post',
                data: {id:id,img:img,pcat:pcat},
                success: function(response){
                    // alert(response);
                    location.reload();
                    // $('#variants'+num).html(response);
                }
                });
        //    alert(val);
        }
</script>

<script>
function Addbtn() {
    var nums=$('#rowcount').val();
    num=parseInt(nums)+1;
    $('#rowcount').val(num);

    var html='<tr><td width="150px"><lable>variants Name</lable><input type="text" name="var_name[]" class="form form-full" /></td><td><div class="row"><div class="col-md-4"><lable>variants price</lable><input type="text" name="var_price[]" class="form form-full" /></div><div class="col-md-4"><lable>variants offer price</lable><input type="text" name="product_offerprice[]" class="form form-full" /></div><div class="col-md-4"><lable>variants Image</lable><input type="file" name="var_img[]" class="form form-full" /></div></div></td></tr><tr><td width="150px"><lable>variants Type</lable><select class="form-control" name="var_type[]" onchange="getchng(this.value,'+num+')"><option value="">Select Master</option><?php  $gquery = mysqli_query($con1, "SELECT * FROM `product_variant_master` WHERE under ='0'"); while ($rowq = mysqli_fetch_assoc($gquery)) { ?> <option value="<?=$rowq['id']?>" ><?=$rowq['name']?></option><?php }?></select></td><td><div class="row"><div class="col-md-6"><lable>variants value</lable><input type="text" name="var_val1[]" class="form form-full" /></div><div class="col-md-6"><lable>variants type</lable><input list="variants'+num+'" class="form-control" name="var_val2[]" id="browser"><datalist id="variants'+num+'"></datalist></div></div></td></tr>';
    $("#addtable").append(html);
}
</script>
