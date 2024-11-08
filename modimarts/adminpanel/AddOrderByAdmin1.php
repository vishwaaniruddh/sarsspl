<?php
session_start();
include('config.php');
include('adminaccess.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->

<!--  jquery core -->   
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
    	$('input').checkBox();
    	$('#toggle-all').click(function() {
     	    $('#toggle-all').toggleClass('toggle-checked');
    	    $('#mainform input[type=checkbox]').checkBox('toggle');
    	    return false;
    	});
    });
</script>     

<![if !IE 7]>  

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
});
</script>

<![endif]>

<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
});
</script>

<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    $(function() {
      $("input.file_1").filestyle({ 
          image: "images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
        });
    });
</script>

<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
function delfun(id,remid)
{
    try
    {
        var reas="";
        var remcheck=0;
        <?php if($_SESSION['designation']!="0")
        {
            ?>
        reas=document.getElementById(remid).value;
        if(reas.trim()=="")
        {
            remcheck=1;
        }
        <?php } ?>
        
        if(remcheck==0)
        {
        
        var confirmv=confirm("Are you sure to delete");
        if(confirmv)
        {
            $.ajax({
                type: "POST",
                url: "deleteCustomer.php",
                data:'cmp='+ id + '&reas='+ reas,

                success: function(msg){
                    //alert(msg);
                    if(msg==1)
                    {
                        alert("Delete successfull");
                    }else
                    {
                        alert("Error");
                    }
                    window.location.reload();
                }
             });
            }
        }   else
        {
            alert("Enter Reason for deletion");
            document.getElementById(remid).focus();
        }
    }catch(exc)
    {
        alert(exc);
    }
}
</script> 
<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
    function shfunc(divid,stats)
    {
        try
        {
            // alert(divid);
            if(stats=="1")
            {
                document.getElementById(divid).style.display="block"; 
            }else
            {
                document.getElementById(divid).style.display="none";   
            }
        }catch(exc)
        {
            alert(exc);
        }
    }
</script>

<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<body> 

<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!------------------------------  start nav-outer-repeat....... START ------------------------->
<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Orders</h1>
	</div>
	<!-- end page-heading -->
  <form action="AddOrderProcess1.php" method="post" onsubmit="return Checkform()">
  <!-- <form action="#" method="post"onsubmit="return Checkform()" > -->
	<div class="row form-group">
		<div class="col-md-3">
            <div class="form-group">
                <label>Order Date</label>
                <input type="text" name="orderdate" value="<?=date('d-m-Y h:i:s a')?>" class="form-control" id=""  required>
            </div>			
		</div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Transaction id</label>
                <input type="text" name="txnid" value="txn<?=time()?>" class="form-control" id="" required readonly>
            </div>          
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Order Type</label>
                <select name="ordertype" id="" class="form-control" required>
                    <option value="">Select Order Type</option>
                    <option value="online">Online</option>
                    <option value="cod">Cod</option>
                    <option value="Cash">Cash</option>
                    <option value="CreatedByAdmin">Created By Admin</option>
                    <option value="Account Transfer">Account Transfer </option>
                </select>
            </div>          
        </div>
        <!-- <div class="col-md-3">
            <div class="form-group">
                <label>Customer Name </label>
                <input type="text" name="customre_Name" id="" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Customer Email </label>
                <input type="email" name="customre_Email" id="" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Customer Mobile</label>
                <input type="number" name="customre_Mob" id="" class="form-control" required>
            </div>          
        </div> -->
        <!--  <div class="col-md-3">
            <div class="form-group">
                <label>GST Number </label>
                <input type="text" name="gstnumber" id="" data-uppercase="1" class="form-control" placeholder="Enter GST Number">
            </div>          
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>PAN Number</label>
                <input type="text" name="pannumber" data-uppercase="1" id="" class="form-control" placeholder="Enter Pan Number">
            </div>          
        </div> -->
	</div>
  <div class="row">
    <div class="col-md-6">
      <h4>Shipping Details</h4>
      <div class="col-md-12">
            <div class="form-group">
                <label>Shipping Customer Name </label>
                <input type="text" name="customre_Name" id="customre_Name" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Customer Email </label>
                <input type="email" name="customre_Email" id="customre_Email" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Customer Mobile</label>
                <input type="number" name="customre_Mob" id="customre_Mob" class="form-control" required>
            </div>          
        </div>
      <div class="col-md-12">
            <div class="form-group">
                <label>Shipping Address</label>
                <textarea name="shipping_addres" id="shipping_addres" class="form-control" cols="30" rows="1" required></textarea>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>City </label>
                <input type="text" name="shipping_city" id="shipping_city" class="form-control" placeholder="Enter City " required>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>State </label>
                    <select name="shipping_state" id="shipping_state" class="form-control" required>
                      <option value="">Select State</option>
                        <?php $state_sql = mysqli_query($con1,"SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");
                         while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                      <option value="<? echo $state_sql_result['state_name'];?>" <? if($state_sql_result['state_name'] == $state){ echo 'selected'; }?>>
                                            <?=$state_sql_result['state_name'];?>
                                      </option>
                                    <? } ?>
                    </select>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Pincode</label>
                <input type="number" name="shipping_zip" id="shipping_zip" class="form-control" placeholder="Enter Pincode">
            </div>          
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>GST Number </label>
                <input type="text" name="gstnumber" id="gstnumber" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Enter GST Number">
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>PAN Number</label>
                <input type="text" name="pannumber" onkeyup="this.value = this.value.toUpperCase();" id="pannumber" class="form-control" placeholder="Enter Pan Number">
            </div>          
        </div>

    </div>
    <div class="col-md-6"><h4>Billing Details </h4>
       <input type="checkbox" name="billingtoo" class="form-group" onclick="FillBilling(this.form)" />
                <span style="color:blue; font-size: 18px; padding: 10px;"><b>same as above</b></span>
      <div class="col-md-12">
            <div class="form-group">
                <label>Customer Name </label>
                <input type="text" name="bill_name" id="bill_name" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Customer Email </label>
                <input type="email" name="bill_mail" id="bill_mail" class="form-control" required>
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Customer Mobile</label>
                <input type="number" name="bill_phone" id="bill_phone" class="form-control" required>
            </div>          
        </div>
      <div class="col-md-12">
            <div class="form-group">
                <label>Billing Address </label>
                <textarea name="billing_addres" id="billing_addres" class="form-control" cols="30" rows="1" required></textarea>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing City </label>
                <input type="text" name="billing_city" id="billing_city" class="form-control" placeholder="Enter City " required>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing State </label>
                    <select name="billing_state" id="billing_state" class="form-control" required>
                      <option value="">Select State</option>
                        <?php $state_sql = mysqli_query($con1,"SELECT * FROM `states` ORDER BY `states`.`state_name` ASC");
                         while($state_sql_result = mysqli_fetch_assoc($state_sql)){ ?>
                                      <option value="<? echo $state_sql_result['state_name'];?>" <? if($state_sql_result['state_name'] == $state){ echo 'selected'; }?>>
                                            <?=$state_sql_result['state_name'];?>
                                      </option>
                                    <? } ?>
                    </select>
            </div>          
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Billing Pincode</label>
                <input type="number" name="billing_zip" id="billing_zip" class="form-control" placeholder="Enter Pincode">
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Billing GST Number </label>
                <input type="text" name="bill_gstnumber" id="bill_gstnumber" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Enter GST Number">
            </div>          
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Billing PAN Number</label>
                <input type="text" name="bill_pannumber" onkeyup="this.value = this.value.toUpperCase();" id="bill_pannumber" class="form-control" placeholder="Enter Pan Number">
            </div>          
        </div>
    </div>
  </div>
  <br/>
  <br/>
     <div class="row">
        <div class="col-md-1">
           <label><small>API Product</small></label> <input type="checkbox" id="apicheck" class="form-control">
        </div>
                                                    <div class="col-md-9">
                                                      <div class="form-group" >
                                                          <label>Enter Product Name</label>
                                                          <input type="text" list="prolist" class="form-control typeahead" id="productdescrip"  placeholder="Enter Product Name">
                                                          <datalist id="prolist">
                                                          </datalist>

                                                      </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                      <div class="form-group" >
                                                          <br/>
                                                          <a   class="btn btn-primary text-white" style="margin-top:3%;" onclick="Addtolist()" >Add product</a>
                                                      </div>
                                                    </div>
                                                  </div>
    <div class="row">
        <!-- <h3>Order Details</h3> -->
        <table class="table table-responsive">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            <tbody>
            <!-- <tr id="prorow_1">
                <td >
                    <input type="text" name="productId[]" class="form-control" id="productId_1">
                </td>
                <td>
                    <input type="text" name="productprice[]" class="form-control" id="productprice_1">
                </td>
                <td>
                    <input type="text" name="productqty[]" class="form-control" id="productqty_1">
                </td>
                <td>
                    <input type="text" name="pro_total[]" class="form-control" id="pro_total_1">
                </td>
                <td></td>
            </tr> -->            
            </tbody>
            <tbody  id="addrowhere"></tbody>
            <tfoot>
              
                
                <tr>
                    <td colspan="3" align="right">Discount</td>
                    <td> <input colspan="2" type="number" name="discount" class="form-control" value="0" >                     
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Shipping Charges</td>
                    <td> <input colspan="2" type="number" name="shipping_charges" class="form-control" value="0" >
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td> <input colspan="2" type="number" name="g_total" class="form-control" value="0" id="g_total" readonly>
                      <input  type="hidden" name="totalqty" value="" id="totalqty" required>
                      <input type="hidden" type="hidden" id="rowcount" value="0">
                    </td>
                </tr>
                  <tr>
                    <td colspan="5" align="right"><button  type="submit" class="btn btn-danger float-right">Add Order</button></td>
                    
                </tr>
            </tfoot>
            
        </table>
        
    </div>
    </form>

	
</div>

<script>
    // function Addrow()
    // {
    //    var rowcount= $("#rowcount").val();
    //    var count=parseInt(rowcount)+1;
    //    var html='<tr id="prorow_'+count+'"><td ><input type="text" name="productId[]" class="form-control" id="productId_'+count+'"></td><td><input type="text" name="productprice[]" class="form-control" id="productprice_'+count+'"></td><td><input type="text" name="productqty[]" class="form-control" id="productqty_'+count+'"></td><td><input type="text" name="pro_total[]" class="form-control" id="pro_total_'+count+'"></td><td><button class="btn btn-sm btn-danger" onclick="Remove('+count+')">remove</button></td></td></tr>';
    //    $("#addrowhere").append(html);
    //    $("#rowcount").val(count);

    // }

    function Remove(count)
    {
        $("#prorow_"+count).remove();
        subtotal();


    }
</script>
<script>
     $("#productdescrip").on("keyup", function(e) {
                   var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :productdescrip}
                     

                      // alert(productdescrip);
                      // var apicheck=$('#apicheck').val();
                      if($('#apicheck').prop('checked')){
                        // alert("API Pro");
                  $.ajax({
                          type: 'POST',
                          url: "apiSearch.php",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                            $("#prolist").html(resultData); 
                            // console.log(resultData); 
                          }
                    });
                      }else{

                    $.ajax({
                          type: 'POST',
                          url: "productserach.php",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                            $("#prolist").html(resultData); 
                            // console.log(resultData); 
                          }
                    });
                 // alert("NOT API Pro");
                }
                

                  }
                  });

                   function Addtolist()
                   {
                     var productdescrip= $("#productdescrip").val();
                   var n = productdescrip.length;
                   if (n>2) {
                      var myKeyVals = { proname :productdescrip}
                       if($('#apicheck').prop('checked')){

                        $.ajax({
                          type: 'POST',
                          url: "apiSearchdata.php",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.apidata[0].Title;
                           var offer_price=data.apidata[0].Price;
                           var prod_id=data.apidata[0].Product_id;
                           var pid=data.apidata[0].Sku_id;
                           var gst1=data.apidata[0].Gst_per_first;
                           var gst2=data.apidata[0].Gst_per_second;
                           var color=data.color;
                           var size=data.size;
                           if(offer_price>100)
                           {
                            var gst=gst2;
                           }
                           else
                           {
                            var gst=gst1;
                           }
                           var vendor="Tadka";
                           var category_id=data.apidata[0].Sku_id;
                           var Hsn_code=data.apidata[0].Hsn_code;
                           var photo='https://thebrandtadka.com/images_inventory_products/front_images/'+data.apidata[0].Medium_file;
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1;
                            var prolink='<a href="/product_detail.php?pid='+pid+'&catid='+category_id+'&prod_id='+prod_id+'"><img src="'+photo+'"width="50" height = "50" alt=""></a>';

                           var prodata ='<input type="hidden" name="pid[]" value="'+pid+'"><input name="prod_id[]" type="hidden" value="'+prod_id+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="outside_product[]" value="1"><input type="hidden" name="size[]" value="'+size+'"><input type="hidden" name="color[]" value="'+color+'"><input type="hidden" name="hsn[]" value="'+Hsn_code+'"><input type="hidden" name="gst[]" value="'+gst+'"><input type="hidden" name="mrp[]" value="'+offer_price+'"><input type="hidden" name="vendor[]" value="'+vendor+'"><input type="hidden" name="pro_img[]" value="'+photo+'">';

                            var html='<tr id="prorow_'+count+'"><td ><input type="text" name="productId[]" class="form-control" value="'+productname+'" id="productId_'+count+'" readonly>'+prodata+'</td><td><input type="text" name="productprice[]" value="'+offer_price+'" onChange="subtotal()"  class="form-control cprice" id="productprice_'+count+'"></td><td><input type="text" name="productqty[]" onChange="subtotal()"  class="form-control qty" id="productqty_'+count+'"></td><td><input type="text" onChange="subtotal()"  name="pro_total[]" class="form-control subtotal" onChange="subtotal()"  id="pro_total_'+count+'"></td><td><button class="btn btn-sm btn-danger" onclick="Remove('+count+')">remove</button></td></td></tr>';

                            // $("#addrow").append(rowhtml);


                            $("#addrowhere").append(html);
                            $("#rowcount").val(count);

                            $("#productdescrip").val("");
                            $("#prolist").html(""); 
                           
                          }
                    });

                       }
                       else {
                     
                     $.ajax({
                          type: 'POST',
                          url: "productdetails.php",
                          data: myKeyVals,
                          success: function(resultData) { 
                            // alert(resultData);
                         var data = $.parseJSON(resultData)
                           var productname=data.product_model;
                           var offer_price=data.total_amt;
                           var prod_id=data.id;
                           var pid=data.code;
                           var vendor=data.vendor;
                           var category_id=data.category_id;
                           var photo='/ecom/'+data.photo;
                           
                            var rowcount= $("#rowcount").val();
                            var count=parseInt(rowcount)+1;
                            var prolink='<a href="/product_detail.php?pid='+pid+'&catid='+category_id+'&prod_id='+prod_id+'"><img src="'+photo+'"width="50" height = "50" alt=""></a>';

                           var prodata ='<input type="hidden" name="pid[]" value="'+pid+'"><input name="prod_id[]" type="hidden" value="'+prod_id+'"><input type="hidden" name="category_id[]" value="'+category_id+'"><input type="hidden" name="vendor[]" value="'+vendor+'"><input type="hidden" name="photo[]" value="'+photo+'">';

                            var html='<tr id="prorow_'+count+'"><td ><input type="text" name="productId[]" class="form-control" value="'+productname+'" id="productId_'+count+'" readonly>'+prodata+'</td><td><input type="text" name="productprice[]" value="'+offer_price+'" onChange="subtotal()"  class="form-control cprice" id="productprice_'+count+'"></td><td><input type="text" name="productqty[]" onChange="subtotal()"  class="form-control qty" id="productqty_'+count+'"></td><td><input type="text" onChange="subtotal()"  name="pro_total[]" class="form-control subtotal" onChange="subtotal()"  id="pro_total_'+count+'"></td><td><button class="btn btn-sm btn-danger" onclick="Remove('+count+')">remove</button></td></td></tr>';

                            // $("#addrow").append(rowhtml);


                            $("#addrowhere").append(html);
                            $("#rowcount").val(count);

                            $("#productdescrip").val("");
                            $("#prolist").html(""); 
                           
                          }
                    });
                 }

                   }
                   }

</script>

<script>
   function subtotal()
                    { //alert("hii");
                      var elem = document.getElementsByClassName('qty');
                       var price=document.getElementsByClassName('cprice');
                       //alert(price);
                       var subto=document.getElementsByClassName('subtotal');
                       var sumamt=0; var sumqty=0;
                       for(i=0;i<elem.length;i++)
                       {
                        if(elem[i]!=0 || price[i]!=0)
                        {
                          if(price[i].value=="")
                          price[i].value=0;
                          
                          if(elem[i].value=="")
                          elem[i].value=0;
                          
                          var subtotal=parseInt(elem[i].value)*parseInt(price[i].value);
                          subto[i].value=subtotal;
                          sumamt=sumamt+subtotal;
                          sumqty=sumqty+parseInt(elem[i].value);  
                        }  
                      }
                      
                          
                        document.getElementById('g_total').value=sumamt;
                        document.getElementById('totalqty').value=sumqty;                        
                        
                    }
</script>

<script>
  function Checkform()
  {
    var total=$("#g_total").val();
      total= parseInt(total);
    if(total>0)
    {
      return true;
    }
    else
    {
       return false;
    }

  }
</script>

<script>
    stvalue()
    {
        var customre_Name = $("#customre_Name").val();
    }
</script>

<script type="text/javascript">
         function FillBilling(f) {
          if(f.billingtoo.checked == true) {
             f.bill_name.value = f.customre_Name.value;
            f.bill_mail.value =f.customre_Email.value ;
            f.bill_phone.value=f.customre_Mob.value ;
             f.billing_addres.value=f.shipping_addres.value;
             f.billing_city.value=f.shipping_city.value;
             f.billing_state.value=f.shipping_state.value;
             f.billing_zip.value=f.shipping_zip.value;
            f.bill_gstnumber.value= f.gstnumber.value;
             f.bill_pannumber.value=f.pannumber.value;

          }
         else{
            f.bill_name.value='';
            f.bill_mail.value='';
            f.bill_phone.value='';
             f.billing_addres.value='';
             f.billing_city.value='';
             f.billing_state.value='';
            f.billing_zip.value='';
            f.bill_gstnumber.value='';
            f.bill_pannumber.value='';

        }
        }
    </script>
</body>
</html>