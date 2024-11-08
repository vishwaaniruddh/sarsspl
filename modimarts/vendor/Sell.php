<?php
$stsss="2";
include('config.php');
  $qry="select code,name from cities";
  $res=mysqli_query($con1,$qry);                
  $num=mysqli_num_rows($res);
  $qry1="select distinct code from categories";
  $res1=mysqli_query($con1,$qry1);                
  $num1=mysqli_num_rows($res1);     
  $qry2="select max(code) as ncode from clients";   
  $res2=mysqli_query($con1,$qry2);
  $row2=mysqli_fetch_array($res2);
  //$qry="select * from main_cat WHERE UNDER=0";
  // $result=mysqli_query($con1,$qry);  
?>
<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta https-equiv="X-UA-Compatible" content="IE=edge">
<title>Allmart</title>
<link rel="stylesheet" href="">
<meta name="description" content="My Store" />
<link href="https://allmart.world/user" rel="canonical" />
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
<!-- Ruchi -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                
<!--<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>-->
                
<script type="text/javascript" src="catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/theme/pav_bigstore/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/pavdeals/countdown.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
               
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<link href="datepc/dcalendar.picker.css" rel="stylesheet" type="text/css">
<script>
function getloc()
{
// alert("ok");
    $.ajax({
         type: "POST",
         url: "getlocationtestr.php",
		datatype:'json',	
   data:'',
         success: function(msg){
               //  alert(msg);
//alert(msg.city);
var jsr=JSON.parse(msg);
//alert(jsr['zip']);
document.getElementById("state").value=jsr['region_name'];
document.getElementById("Pincode").value=jsr['zip'];
document.getElementById("country").value=jsr['country_name'];
//document.getElementById("city").value=jsr['city'];
city2(jsr['city']);
document.getElementById("Latitude").value=jsr['latitude'];
document.getElementById("Longitude").value=jsr['longitude'];
//var sp=msg.split('####');

/*$("#state option").each(function(i){
alert($(this).text());
if($(this).text()==sp[0])
{
    alert($(this).text());
    $(this)prop('selected', true);
}
    });*/
}
});
}
</script>
<script>
function addItem()
{
    var nomem=document.getElementById('nomem').value;
    if(nomem>1){
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
            try
            {
    	        document.getElementById('attatch').innerHTML=xmlhttp.responseText;
            }catch(ex)
            {
                alert(ex);
            }
        }
      }
        xmlhttp.open("GET","../addrowimg.php?nomem="+nomem,true);
        xmlhttp.send();	
    } else {
      swal("No of partner should not be less than 2!");
    }
}
function city1()
{
var xmlhttp;
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
    document.getElementById("city1").innerHTML=xmlhttp.responseText;
  }
  }
  var str=document.getElementById('state').value;
 
xmlhttp.open("POST","getCity.php?id="+str,true);
//alert("getCity.php?id="+str);
xmlhttp.send();
}
function city2(city)
{
var xmlhttp;
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
        //alert(xmlhttp.responseText);
        document.getElementById("city1").innerHTML=xmlhttp.responseText;
        document.getElementById("cname").focus();
    }
  }
  var str=document.getElementById('state').value;
 
    xmlhttp.open("POST","getCity.php?id="+str+"&city="+city,true);
    //alert("getCity.php?id="+str);
    xmlhttp.send();
    }
var boolemail=false;
function checkemail()
{
    try
    {
        var element2 = $('#email');
        //alert("hello");
        var email=document.getElementById('email').value;
        if(email!=""){
            $.ajax({
                type: "POST",
                url: "checkemail.php",
    			async: false,
                data:'email='+email,
                success: function(msg){
                    $(element2).parent().addClass('');
                    $(element2).parent().removeClass('has-error');
                    $('.alert, .text-danger').remove();
                    if(msg==1)
                    {
                        boolemail=false;
                        // alert("Email id already exists !!");
                        //bool=false;
                     
                        $(element2).after('<div class="text-danger" id="emailerr">' +'Email Id is already registered' + '</div>');
                        $(element2).parent().addClass('has-error');
                   
                        element2.focus();
                    }else
                    {
                        boolemail=true;
                    }
                }
            }); 
        }
    }catch(exc)
    {
        alert(exc);
    }
    return boolemail;
}
function checkcontactno()
{
    var boolcont=false;
    //alert("hello");
    var element3 = $('#mobile');
    var mob=document.getElementById('mobile').value;
    // alert(email);
    if(mob!="")
    {
        $.ajax({
            type: "POST",
            url: "checkemail.php",
			async: false,
            data:'mob='+mob+'&sts=1',
            success: function(msg){
                //alert(mob);
                $(element3).parent().addClass('');
                $(element3).parent().removeClass('has-error');
                $('.alert, .text-danger').remove();
                if(msg==1)
                {
                    // alert("Email id already exists !!");
                    //bool=false;
     
                    $(element3).after('<div class="text-danger" id="emailerr">' +'Contact number is already registered' + '</div>');
                    $(element3).parent().addClass('has-error');
                    boolcont=false;
                    element3.focus();
}
            }
         }); 
   }
   return boolcont;
}
 
function finalval()
{
    if(checkcont() && checkemail() )
    {
       return true; 
    }
    else
    {
        return false; 
    }
}
/*function validation()
{
    var Ldesignation=document.getElementById('Ldesignation').value;
    var Registn=document.getElementById('Registn').value;
    var cin=document.getElementById('cin').value;
    var gumastaNo=document.getElementById('gumastaNo').value;
    var busiAadhar=document.getElementById('busiAadhar').value;
    var comnyPan=document.getElementById('comnyPan').value;
    var tanno=document.getElementById('tanno').value;
    //var Establishment=document.getElementById('Establishment').value;
    var vat=document.getElementById('vat').value;
    var adhar=document.getElementById('adhar').value;
    var pan=document.getElementById('pan').value;
      
    var comtyp= document.getElementById('ctyp').value;
    
} */
 
function checkcont()
{
    try {
        var favorite = [];
        $.each($("input[name='sport']:checked"), function(){            
            favorite.push($(this).val());
        });
    
        var qlg=favorite.length;
        var q=favorite;
        
        /*
        var selected = $(".compny option:selected");
        var message = "";
        var mes="";
        selected.each(function () {
        //message += $(this).text() + " " + $(this).val() + "\n";
        mes+=$(this).text()+" ";
        message += $(this).val()+" ";
        });
                  
        var q3 = mes.split("  ");
        //var q3= fields3.slice(0, -1);
        //alert(q3);
                   
        var fields2 = message.split(" ");
        var q= fields2.slice(0, -1);
        
        document.getElementById('cat').value=q;
        document.getElementById('catn').value=q3;
        var fields2 = message.split(/[^\s]+/).length - 1;*/
        
        var fields2 = qlg - 1;
        //alert("fields2 -"+fields2)
        document.getElementById('cat').value=q;
        //var fields2 = document.getElementsByName("compny[]");
        var cat=0;
        for(var i = 0; i <= fields2; i++) 
        {  
            if(q)    
            //  if(fields2[i].checked==true)
            {
                cat=1;
            }
        }   
        if(cat==0){
            alert("select atleast 1 category !!");
            return false;
        }else{
           return true;
        }
        //return true;        
    }catch(e){
        alert(e);
    }
}
</script>
<style>
    #notification {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 17px;
    }

    #notification.showalrt{
        visibility: visible;
         -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

</style>
<style type="text/css">
#loginForm .has-error .control-label,
#loginForm .has-error .help-block,
#loginForm .has-error .form-control-feedback {
    color: #f39c12;
}

#loginForm .has-success .control-label,
#loginForm .has-success .help-block,
#loginForm .has-success .form-control-feedback {
    color: #18bc9c;
}
</style>

<style>
.button {
  display: inline-block;
  padding: 2px 20px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 10px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

</style>

<style>
.multiselect {
	width: 200px;
}
.selectBox {
	position: relative;
}

.selectBox select {
	width: 100%;
	font-weight: bold;
}
#checkboxes{
	display: none;
	border: 1px #dadada solid;
}
#checkboxes label {
	display: block;
	    color: #2d2222;

}
#checkboxes label:hover {
	background-color : red;
}
/* Ruchi  */
.breadcrumb {
    padding: 10px 15px;
    margin-bottom: 0;
    list-style: none;
    background-color: transparent;
    border-radius: 0px;
}
.cart-top .cart-inner {
    float :none;
}
#topbar .current-lang {
    margin-right: -67px !important; 
}
</style>
</head>
  <body class="common-home page-common-home layout-fullwidth" onload="getloc();">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        <header id="header-layout" class="header-v2">
            <div id="header-main">
            <div class="">
            <div class="row">
            <?php include('menucopy.php')?>
            </div>
        </div>
    </div>
   <!-- <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
                                <div class="container">
                                    <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                </div>
            </div>
            </div>
        </div>
    </div>-->
</header>
        <!-- /header -->
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
              <div id="sys-notification1">
          <div class="container">
            <div id="notification1">
            </div>
          </div>
        </div>
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
        </style>
        <style>
        .form-control {
            width: 95%;
            padding: 8px 8px;
        }
        </style>
        <div class="container" >
            <!-- <ul class="breadcrumb">
                <li><a href="http://sarmicrosystems.in/oc1/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Register</a></li>
            </ul>-->
            <div class="row">
                <br> <div id="content1" class="col-sm-2"> </div>
                <div id="container content" class="col-sm-8" style="background-color: #f5f5f5;border-radius:1%;">      
                    <br><center> If you are already a Member <a href="user/index.php">Click Here</a>
                    <h1>Register Account</center></h1>
                    <p><!--If you already have an account with us, please login at the <a href="login.php">login page</a>.--></p>
             		<form action="sell_process.php" method="post" enctype="multipart/form-data" id="loginForm"  class="form-horizontal" autocomplete="OFF" onsubmit="return finalval();">
            		    
                    <div class="form-group col-md-12">
                        <label class="col-md-2 control-label">Company Type</label>
                        <div class="col-md-10 inputGroupContainer">
                           <div class="input-group">
                              <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                              <select class="selectpicker form-control" id="ctyp" name="ctyp"  required  onchange="disfn('');">
                                <option value="0">Select type</option>
                                <option value="1" >Partnership</option>
                                <option value="2" >Proprietorship</option>
                                <!-- <option value="3" >Individual </option>-->
                                <option value="4" >Limited company/Pvt. Limited Company </option>
                              </select>
                           </div>
                        </div>
                    </div>
                    
                <script>
                	var expanded = false;
                	function showCheckBoxes(){
                    	var checkboxes = document.getElementById("checkboxes");
                    	if(!expanded){
                    		checkboxes.style.display = "block";
                    		expanded = true;
                    	}else{
                    		checkboxes.style.display = "none";
                    		expanded = false;
                    	}
                	}
                </script>
        <script>
        function showElements(elem) {
        	//alert(elem);
        	for(i=0;i<elem.length;i++)
        	{
        		$("#"+elem[i]).show();
        	     //$("#"+elem[i]).attr("required", 'required');
        	 }
        }
        function hideElements(elem){
        	for(i=0;i<elem.length;i++)
        	{
        		$("#"+elem[i]).hide();
        	    //$("#"+elem[i]).removeAttr('required')
        	 }
        }
        function disfn(sts){
            // alert('1');
            try
            {
                //==================================================================
                var r= document.getElementById('ctyp').value;
                //alert(r);
                $.ajax({
                     type: "POST",
                     url: "regIndividual.php",
        			 data:'id='+r,
                    success: function (dat) {
                        //alert('e'+dat)
                         var data=$.parseJSON(dat);
                          $("#checkboxes").empty();
        				var checkboxes = document.getElementById("checkboxes");
                        for (var i = 0; i < data.length; i++) {
        				    //	alert(data[i]['id'])
        					var node = document.createElement('div'); 
        				    node.innerHTML = '<label id="'+ data[i]['id'] +'"><input type="checkbox" value="'+ data[i]['id'] +'" id="'+ data[i]['id'] +'" name="sport"/>'+data[i]['name'] +'</label>';       
        				    document.getElementById('checkboxes').appendChild(node);
                        }
                    },
                    error: function (msg) {
                        //alert("error" + msg);
                    }
                });
                //======================================================================================       
                if(document.getElementById('ctyp').value=="1")
                {
                    var show=['hide','adhno','pcn','compname','Partshipcn','PartshipcomnyPan','Cperson','Cmobile','Cemail','CTelephn','PtsGumasta','PartshipBusiAadhr','Partshiptanno','gstno','bnknm','brNam','ifscod','acno','acNam','CPincode'];
                    var hide=['compname','st','Ccity','CArea','Caddress','CTelephn','Cfax','Cperson','lDesignatn','Cmobile','category','Clogo','shopLic','dtofreg','PartshipRegis','Partshipcn','PtsGumasta','PartshipBusiAadhr','PartshipcomnyPan','Partshiptanno','Yestablis','adhno','pcn','Eno','gstno'];
                    hideElements(hide);  
                    showElements(show);
                }
                /*else if(document.getElementById('ctyp').value=="2")
                {
                    var show=['compname','Caddress','Cperson','Cemail','Cmobile','Cperson','pcn','adhno','PtsGumasta','Partshiptanno','gstno','Ccategory','Clogo','wing','flat','road_no','locality','bldg','landmark','bnknm','brNam','ifscod','acno','acNam','CPincode'];
                    var hide=['compname','st','Ccity','CArea','Caddress','CTelephn','Cfax','Cemail','Cperson','lDesignatn','Cmobile','category','Clogo','shopLic','dtofreg','PartshipRegis','Partshipcn','PtsGumasta','PartshipBusiAadhr','PartshipcomnyPan','Partshiptanno','Yestablis','adhno','pcn','Eno','gstno'];
                    hideElements(hide);
                    showElements(show);
                    if(document.getElementById('hide').style.display="block") {
                        document.getElementById('hide').style.display="none";
                        document.getElementById('no_of_partners').style.display="none";
                    } 
                }
                else if(document.getElementById('ctyp').value=="3")
                {  
                    var show=['compname','Caddress','Cperson','Cemail','Cmobile','Cperson','pcn','PtsGumasta','Partshiptanno','gstno','Ccategory','Clogo','wing','flat','road_no','locality','bldg','landmark','bnknm','brNam','ifscod','acno','acNam','CPincode'];
                    var hide=['compname','st','Ccity','CArea','Caddress','CTelephn','Cfax','Cemail','Cperson','lDesignatn','Cmobile','category','Clogo','shopLic','dtofreg','PartshipRegis','Partshipcn','PtsGumasta','PartshipBusiAadhr','PartshipcomnyPan','Partshiptanno','Yestablis','adhno','pcn','Eno','gstno'];
                     hideElements(hide);
                    showElements(show);
                }*/
            }catch(ex)
            {
                //alert('1'+ex);  
            }
        }
    </script>
    <div class="form-group col-md-6" id="hide" style="display:none">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">No. of Partner</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i></span>
                 <input type="text" id="nomem" name="nomem" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="addItem();"> 
           </div>
        </div>
    </div>
    <div class="form-group col-md-12" >
        <label class="col-md-2 control-label" for="input-firstname" >*</label>
        <div class="col-md-10 inputGroupContainer" id="attatch">
        </div>
     </div>
     
      <div class="form-group col-md-6" id="compname">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">Company Name</label><!--<span class="required">*</span>-->
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <input type="text" name="cname" id="cname" placeholder=" Name"  class="form-control" size="50" tabindex=0 />
           </div>
        </div>
     </div>
     <div class="form-group col-md-6">
        <label class="col-md-4 control-label">Country</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
              <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
              <select class="selectpicker form-control" name="country" id="country" class="form-control">
                <option value="0" ></option>
                    <?php 
                        $sql_query=mysqli_query($con1,"select * from country");
                        while($row=mysqli_fetch_row($sql_query)){
                    ?>
			            <option value="<?php echo $row[1]; ?>" <?php if($row[0]==$country){ echo "selected";} ?> data-cid="<?php echo $row[0]; ?>"> <?php echo $row[1]; ?></option>
            <?php } ?>
              </select>
           </div>
        </div>
     </div>
        <div class="form-group col-md-6" id="st">
            <label class="col-md-4 control-label">State</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group">
                  <span class="input-group-addon" style="max-width: 100%;"><i class="fa fa-globe" aria-hidden="true"></i></span>
                  <select class="selectpicker form-control styledselect_form_1" name="state" id="state" onchange="city1()">
                     <option value="0" style="width: 12em" >Select</option>
                           <?php 
                                $sqlm=mysqli_query($con1,"select * from states");
                                while($rowm=mysqli_fetch_row($sqlm)){
                            ?>
	         			   <option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
                           <?php } ?>
                  </select>
               </div>
            </div>
        </div>
        
        <!-- new added feilds : Ruchi -->
         <div class="form-group col-md-6" id="flat">
            <label class="col-md-4 control-label" for="input-firstname">Flat / Plot NO.</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                   <input type="text" name="flat"  placeholder="Plot NO" id="PlotNO" class="form-control" value="<?php if($flat!=""){ echo $flat;} ?>" />
                </div>
            </div>
          </div>
          <div class="form-group col-md-6" id="wing">
            <label class="col-md-4 control-label" for="input-firstname">Wing No.</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="glyphicon glyphicon-option-horizontal"></i></span>
                   <input type="text" name="wing" placeholder="Wing No" id="WingNo" class="form-control" value="<?php if($wing!=""){ echo $wing;} ?>" />
                </div>
            </div>
          </div>
          <div class="form-group col-md-6" id="bldg">
            <label class="col-md-4 control-label" for="input-firstname">Building Name</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                   <input type="text" name="BuildingName"  placeholder="Building Name" id="BuildingName" class="form-control" value="<?php if($bldg!=""){ echo $bldg;} ?>" />
                </div>
            </div>
          </div>
          <div class="form-group col-md-6" id="road_no">
            <label class="col-md-4 control-label" for="input-firstname">Road No.</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                   <input type="text" name="RoadNo" placeholder="Road No" id="RoadNo" class="form-control" value="<?php if($road_no!=""){ echo $road_no;} ?>" />
                </div>
            </div>
          </div>
          <div class="form-group col-md-6" id="landmark">
            <label class="col-md-4 control-label" for="input-firstname">LandMark</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                   <input type="text" name="landMark" placeholder="LandMark" id="landMark" class="form-control" value="<?php if($landmark!=""){ echo $landmark;} ?>" />
                </div>
            </div>
          </div>
          <div class="form-group col-md-6" id="locality">
            <label class="col-md-4 control-label" for="input-firstname">Locality</label>
            <div class="col-md-8 inputGroupContainer">
                <div class="input-group">
                   <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                   <input type="text" name="Locality"  placeholder="Locality"  id="Locality" class="form-control" value="<?php if($locality!=""){ echo $locality;} ?>" />
                </div>
            </div>
          </div>
       
          <div class="form-group col-md-6" id="Ccity">
            <label class="col-md-4 control-label">City</label>
            <div class="col-md-8 inputGroupContainer">
               <div class="input-group" id="city1">
                  <span class="input-group-addon" style="max-width: 100%;"><i class="fa fa-globe" aria-hidden="true"></i></span>
                  <select class="selectpicker form-control styledselect_form_1" name="city" id="city">
                     <option value="0" style="width: 12em" >Select</option>
                           
                  </select>
               </div>
            </div>
        </div>
    
    <div class="form-group col-md-6" id="CPincode">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">Pincode</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <input type="text" name="Pincode" id="Pincode"  placeholder=" Pincode"  class="form-control" size="50" tabindex=0 />
           </div>
           <span style="color:red">Kindly verify your pincode!</span>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="CTelephn">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cteleph">Company Telephone</label>
        <label class="col-md-4 control-label" for="input-firstname" id="id-teleph" style="display:none"><font color="black" >Telephone</font></label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" aria-hidden="true"></i></span>
               <input type="text" name="phone" id="phone"  class="form-control" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="phone"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' />
               <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="Cemail">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cemail">Company Email</label>
        <label class="col-sm-3 control-label" for="input-firstname" id="id-email" ><font color="black" >Email-ID</font></label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                <input type="email" name="email" id="email" class="form-control" onblur="checkemail();" />
           </div>
           <span style="color:#f0ad4e"> Email will be sent to this email id!</span>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="Cperson">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">Contact Person</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <input type="text" name="contactPerson" id="contactPerson" placeholder=" Enter character only" class="form-control" size="50" tabindex=0  />
           </div>
        </div>
    </div>

    <div class="form-group col-md-6" id="lDesignatn" style="display:none">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">Designation</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
           <input type="text" name="Ldesignation" id="Ldesignation" placeholder=" Designation" class="form-control" />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="Cmobile">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Cname">Mobile</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></i></span>
            <input type="text" name="mobile" id="mobile" placeholder=" mobile" class="form-control" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontactno();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'  />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="Ccategory">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Ccat">Company Category</label>
        <label class="col-md-4 control-label" for="input-firstname" id="id-cat" style="display:none"><font color="black" >Category</font></label>
        <div class="col-md-8 inputGroupContainer">
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
                <input type="hidden" id="cat" name="cat">
                <input type="hidden" id="catn" name="catn">
                <div class="multiselect">
                	<div class="selectbox" onclick="showCheckBoxes()">
                		<select id="compny" name="compny"  class="form-control" >
                			<option>Select option</option>
                		</select>
                		<div class="overSelect"></div>
                	</div> 
        	        <!-- Ruchi : <div id="checkboxes" class="checkboxes" style="display: block;width: 599px;" ></div>-->
        	        <div id="checkboxes" class="checkboxes"></div>
                </div>
                <div id="res" ></div>
           </div>
        </div>
    </div>
       
      <div class="form-group col-md-6" id="Clogo">
        <label class="col-md-4 control-label" for="input-firstname" id="id-Clogo">Company Logo</label>
        <label class="col-md-4 control-label" for="input-firstname" id="id-logo" style="display:none"><font color="black" >Logo</font></label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-flag" aria-hidden="true"></i></span>
                <input type="file" name="logo"  padding="0" class="form-control" class="inp-form"  size="50"/>
           </div>
           <span style="color:red">( Upload image only..)</span>
        </div>
    </div>
    
  <!--<div class="form-group col-md-6" id="shopLic">
    <label class="col-md-4 control-label" for="input-firstname">Shop and Establisment Licence</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
               <input type="text" name="lic" id="lic" placeholder="lic" class="form-control">
           </div>
        </div>
    </div>-->
    
    <!--<div class="form-group col-md-6" id="dtofreg">
        <label class="col-md-4 control-label" for="input-firstname">Date Of Registration</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-registration-mark"></i></span>
               <input type="text" class="form-control" name="rdate" id="rdate" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form" />
                
                <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="datepc/dcalendar.picker.js"></script>
                <script>
                    $('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
                </script>
           </div>
        </div>
    </div>-->
    
    <!--<div class="form-group col-md-6" id="PartshipRegis" style="display:none">
    <label class="col-md-4 control-label" for="input-firstname">Registeration No.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
               <input type="text" name="Registn" id="Registn" placeholder="lic" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
           </div>
        </div>
    </div>-->
    
    <div class="form-group col-md-6" id="PtsGumasta" style="display:none">
        <label class="col-md-4 control-label" for="input-firstname">Gumasta/Business Aadhar No.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
               <input type="text" name="gumastaNo" id="RegisgumastaNotn" placeholder="Gumasta" class="form-control" >
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="PartshipcomnyPan" style="display:none">
        <label class="col-md-4 control-label" for="input-firstname">Company Pan No.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
               <input type="text" name="comnyPan" id="comnyPan" placeholder="Pan No." class="form-control" >
           </div>
        </div>
    </div>
   
    <!--<div class="form-group col-md-6" id="Partshiptanno" style="display:none">
        <label class="col-md-4 control-label" for="input-firstname">TAN No.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
               <input type="text" name="tanno" id="tanno" placeholder="TAN No." class="form-control" >
           </div>
        </div>
    </div>-->
    
    <!--<div class="form-group col-md-6" id="Yestablis">
        <label class="col-md-4 control-label" for="input-firstname">Year Of Establishment</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
               
                <input type="text" name="yoe" maxlength ="4" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="yoe"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' />
                <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
           </div>
        </div>
    </div>-->
    
    <div class="form-group col-md-6" id="adhno">
        <label class="col-md-4 control-label" for="input-firstname">Adhar card no.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                <input type="text" name="adhar" maxlength ="13" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Adhar Number" <?php } ?> id="adhar"  class="form-control" value="<?php if($adhar!=""){ echo $adhar;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'   />
                <!--<input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($adhar!=""){ echo  $adhar;} ?>"/>-->
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="pcn">
        <label class="col-md-4 control-label" for="input-firstname">Pan card no.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-id-card" aria-hidden="true"></i></span>
                <input type="text" name="pan"  class="form-control" placeholder="Pancard number"  />
           </div>
        </div>
    </div>
    
    <!--<div class="form-group col-md-6" id="Eno">
        <label class="col-md-4 control-label" for="input-firstname">Establishment no.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
               <input type="text" name="Establishment" id="Establishment"  class="form-control" placeholder="Establishment number" />
           </div>
        </div>
    </div>-->
    
    <div class="form-group col-md-6" id="gstno">
        <label class="col-md-4 control-label" for="input-firstname">GSTIN NO.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
               <input type="text" name="vat" id="vat"  class="form-control" placeholder="GSTIN number" />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="bnknm">
        <label class="col-md-4 control-label" for="input-firstname">Bank Name</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-hospital-o" aria-hidden="true"></i></span>
               <input type="text" name="bknm" id="bknm"  class="form-control" placeholder="Bank Name" />
           </div>
        </div>
    </div>
   
    <div class="form-group col-md-6" id="brNam">
        <label class="col-md-4 control-label" for="input-firstname">Branch Name</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
               <input type="text" name="brchnm" id="brchnm"  class="form-control" placeholder="Branch Name"   />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="ifscod">
        <label class="col-md-4 control-label" for="input-firstname">IFSC Code</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
               <input type="text" name="ifscode" id="ifscode"  class="form-control" placeholder="IFSC Code"   />
           </div>
        </div>
    </div>
    
    
    <div class="form-group col-md-6" id="acno">
        <label class="col-md-4 control-label" for="input-firstname">Account NO.</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
               <input type="text" name="actno" id="actno"  class="form-control" placeholder="Account Number"  />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" id="acNam">
        <label class="col-md-4 control-label" for="input-firstname">Account Holder Name</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
               <input type="text" name="acholnm" id="acholnm" class="form-control" placeholder="Account Holder Name"  />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" >
        <label class="col-md-4 control-label" for="input-firstname">Introducer Id</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
               <input type="text" name="introducer_id" id="introducer_id" class="form-control" placeholder="introducer id"  />
           </div>
        </div>
    </div>
    
    <div class="form-group col-md-6" >
        <label class="col-md-4 control-label" for="input-firstname">Free Introducer Id</label>
        <div class="col-md-8 inputGroupContainer">
           <div class="input-group">
               <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>
               <input type="text" name="free_introducer_id" id="free_introducer_id" class="form-control" placeholder="Free introducer id"  />
           </div>
        </div>
    </div>
    
    
    <div class="col-md-6"></div>
    <div class="col-md-12">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-8 inputGroupContainer">
            <input type="submit" class="btn btn-primary" value=Submit name="submit" style="border-radius: 10px; margin-top: 4px;" />
            <!--<button type="button" style="border-radius: 10px;" class="btn btn-primary"   onclick='window.open("admin.php","_self");'>Cancel</button>-->
            <button type="button" style="border-radius: 10px;" class="btn btn-primary"   onclick='window.open("https://allmart.world/user/index.php","_self");'>Cancel</button>
        </div>
    </div>
         <br>
        </div>
          <style>
button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 8px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
     border-radius: 8px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
 <!-- /////////////////////////////////////////////-->
</form>
</div>
</div>
</div>
<script type="text/javascript"><!--
// Sort the custom fields
$('#account .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#account .form-group').length) {
		$('#account .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#account .form-group').length) {
		$('#account .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#account .form-group').length) {
		$('#account .form-group:first').before(this);
	}
});

$('#address .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#address .form-group').length) {
		$('#address .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') == $('#address .form-group').length) {
		$('#address .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#address .form-group').length) {
		$('#address .form-group:first').before(this);
	}
});

$('input[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/register/customfield&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			//$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('#custom-field' + custom_field['custom_field_id']).show();

				/*if (custom_field['required']) {
					$('#custom-field' + custom_field['custom_field_id']).addClass('required');
				}*/
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});


//--></script>
<script type="text/javascript"><!--

//--></script>
<script type="text/javascript"><!--
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=account/account/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '<option value=""> --- Please Select --- </option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"> --- None --- </option>';
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'country_id\']').trigger('change');
//--></script>

<!--
  $ospans: allow overrides width of columns base on thiers indexs. format array( column-index=>span number ), example array( 1=> 3 )[value from 1->12]
 -->
<div id="powered">
  <?php //include('footerbottom.php')
  ?>
</div>
  
<script type="text/javascript">
    $(document).ready( function (){
    	$(".paneltool .panelbutton").click( function(){	
    		$(this).parent().toggleClass("active");
    	} );
    } );
</script>


<script type="text/javascript">
$('#myTab a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
$('#myTab a:first').tab('show'); 

var $MAINCONTAINER = $("html");

/**
 * BACKGROUND-IMAGE SELECTION
 */
$(".background-images").each( function(){
	var $parent = this;
	var $input  = $(".input-setting", $parent ); 
	$(".bi-wrapper > div",this).click( function(){
		 $input.val( $(this).data('val') ); 
		 $('.bi-wrapper > div', $parent).removeClass('active');
		 $(this).addClass('active');
		 if( $input.data('selector') ){  
			$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
		 }
	} );
} ); 

$(".clear-bg").click( function(){
	var $parent = $(this).parent();
	var $input  = $(".input-setting", $parent ); 
	if( $input.val('') ) {
		if( $parent.hasClass("background-images") ) {
			$('.bi-wrapper > div',$parent).removeClass('active');	
			$($input.data('selector'),$("#main-preview iframe").contents()).css( $input.data('attrs'),'none' );
		}else {
			$input.attr( 'style','' )	
		}
		$($input.data('selector'), $($MAINCONTAINER) ).css( $input.data('attrs'),'inherit' );
	}	
	$input.val('');
	return false;
} );


 $('.accordion-group input.input-setting').each( function(){
 	 var input = this;
 	 $(input).attr('readonly','readonly');
 	 $(input).ColorPicker({
 	 	onChange:function (hsb, hex, rgb) {
 	 		$(input).css('backgroundColor', '#' + hex);
 	 		$(input).val( hex );
 	 		if( $(input).data('selector') ){  
				$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'),"#"+$(input).val() )
			}
 	 	}
 	 });
	} );
 $('.accordion-group select.input-setting').change( function(){
	var input = this; 
		if( $(input).data('selector') ){  
		var ex = $(input).data('attrs')=='font-size'?'px':"";
		$( $MAINCONTAINER ).find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
	}
 } );
 
 function showstatsfunc(sts)
{
    try
{
    //alert(sts);
    if(sts=="2")
    {
        document.getElementById('notification1').innerHTML='<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' +'Some error occured please try again'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    }
    else
    {
        document.getElementById('notification1').innerHTML='<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' +'Registration successfull please login'+ '<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
    }
}catch(exc)
{
    alert(exc);
}
}
</script>
  <?php   if(isset($_GET['sts']) & $_GET['sts']!="")
{ 
?>
<script>
showstatsfunc('<?php echo $_GET['sts'];?>');
</script>
<?php
}
?>
</div>
<script type="text/javascript">
</script><!--<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>-->
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>

<script>
$(document).ready(function(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(showLocation);
       
    }else{
        alert('Geolocation is not supported by this browser.');
    }
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

</script>
<br>
 <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />
<footer id="footer" class="nostylingboxs">
  <?php include("footer.php")?>
</footer>
  <?php include('footerbottom.php')?>
</div>
  
<script type="text/javascript">
    $(document).ready( function (){
    	$(".paneltool .panelbutton").click( function(){	
    		$(this).parent().toggleClass("active");
    	} );
    } );
</script>
<script type="text/javascript">
    //$("#offcanvasmenu").html($("#bs-megamenu").html());
</script>
<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
<!--Ruchi : 29 july Location picker -->	
<!--<script type="text/javascript">
$.get("https://ipinfo.io", function (response) {
    $("#ip").html("IP: " + response.ip);
    $("#address").html("Location: " + response.city + ", " + response.region);
	//$("#address").html("Location: " + response.state + ", " + response.region);
	//$("#address").html("Location: " + response.country + ", " + response.region);
    $("#details").html(JSON.stringify(response, null, 4));
    //$("#city").html(response.city);
	//$("#state").html(response.region);
	//$("#country").html(response.country);
    document.getElementById('city').value = response.city;
	document.getElementById('state').value = response.region;
}, "jsonp");
</script>-->
</body>
</html>