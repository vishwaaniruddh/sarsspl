<?php
$stsss="2";
include('config.php');
  $qry="select code,name from cities";
			  $res=mysqli_que$con1,ry($qry);                
			  $num=mysqli_num_rows($res);
						 $qry1="select distinct code from categories";
						 $res1=mysqli_quer$con1,y($qry1);                
						 $num1=mysqli_num_rows($res1);     
       					 $qry2="select max(code) as ncode from clients";   
						 $res2=mysqli_quer$con1,y($qry2);
						 $row2=mysqli_fetch_array($res2);
							 // $qry="select * from main_cat WHERE UNDER=0";
             				 // $result=mysqli_que$con1,ry($qry);  
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

//alert(jsr['region_name']);


document.getElementById("state").value=jsr['region_name'];
//document.getElementById("city").value=jsr['city'];
city2(jsr['city']);
//document.getElementById("Latitude").value=jsr['latitude'];
//document.getElementById("Longitude").value=jsr['longitude'];

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
		

	//	var newdiv=document.createElement("div");
//alert(xmlhttp.responseText);
//newdiv.innerHTML=xmlhttp.responseText+"<td><input type='button' value='Remove' onClick='removeElement("+num+")'><td></tr></div><tbody><table>";
//newdiv.innerHTML=xmlhttp.responseText;
try
{
	document.getElementById('attatch').innerHTML=xmlhttp.responseText;

}catch(ex)
{
    alert(ex);
}
    }
  }
  
    var nomem=document.getElementById('nomem').value;
  //alert("addrow_image.php?cnt="+cnt);
xmlhttp.open("GET","addrowimg.php?nomem="+nomem,true);
xmlhttp.send();	
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
       // alert(xmlhttp.responseText);
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
   
    if(checkcont() && checkemail() &&validation() )
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
    
   
}
 
 function validation()
 {
     var Ldesignation=document.getElementById('Ldesignation').value;
     var Registn=document.getElementById('Registn').value;
     var cin=document.getElementById('cin').value;
     var gumastaNo=document.getElementById('gumastaNo').value;
     var busiAadhar=document.getElementById('busiAadhar').value;
     var comnyPan=document.getElementById('comnyPan').value;
     var tanno=document.getElementById('tanno').value;
     var Establishment=document.getElementById('Establishment').value;
     var vat=document.getElementById('vat').value;
     var adhar=document.getElementById('adhar').value;
     var pan=document.getElementById('pan').value;
      
      var comtyp= document.getElementById('ctyp').value;
   
    if(comtyp=="1"){
    
                 
                       if(Registn=="")
                          { document.getElementById('Registn').setAttribute('required','required');
                            return false; 
                          }
                         else if(cin=="")
                          {
                            document.getElementById('cin').setAttribute('required','required');
                            return false; 
                          }
                               
                            else if(gumastaNo=="" && busiAadhar=="")
                          { alert("Please Enter Gumasta Either Business Aadhar ");
                            return false; 
                          }
                                
                            /*   else if(busiAadhar=="")
                          { document.getElementById('busiAadhar').setAttribute('required','required');
                            return false; 
                          }*/
                                
                              else if(comnyPan=="")
                          { document.getElementById('comnyPan').setAttribute('required','required');
                            return false; 
                          }
                                
                                
                              else if(tanno=="")
                          { document.getElementById('tanno').setAttribute('required','required');
                            return false; 
                          }
                               
                             else if(vat=="")
                          { document.getElementById('vat').setAttribute('required','required');
                            return false; 
                          }
                          else
                          {  
                                return true;
                              
                          }
                               
                              
                              
                      }
                      
         if(comtyp=="2"){
             
             if(gumastaNo=="")
                          { 
                              document.getElementById('gumastaNo').setAttribute('required','required');
                            return false; 
                          }
                                
                               else if(busiAadhar=="")
                          { document.getElementById('busiAadhar').setAttribute('required','required');
                            return false; 
                          }
                          else if(tanno=="")
                          { document.getElementById('tanno').setAttribute('required','required');
                            return false; 
                          }
                            else if(adhar=="")
                          { document.getElementById('adhar').setAttribute('required','required');
                            return false; 
                          }
                          else if(pan=="")
                          { document.getElementById('pan').setAttribute('required','required');
                            return false; 
                          }    
                           else if(vat=="")
                          { document.getElementById('vat').setAttribute('required','required');
                            return false; 
                          }    
                           else
                          {  
                                return true;
                              
                          }
                   }
         
         if(comtyp=="3"){ 
                if(adhar=="")
                          { 
                              document.getElementById('adhar').setAttribute('required','required');
                            return false; 
                          }
                          else if(pan=="")
                          { 
                              document.getElementById('pan').setAttribute('required','required');
                            return false; 
                          }  
                          else
                          {  
                                return true;
                              
                          }
             
                 }
                 
        if(comtyp=="4"){
                if(Ldesignation=="")
                          {
                            document.getElementById('Ldesignation').setAttribute('required','required');
          
                            return false; 
                          }
                           else if(cin=="")
                          {
                            document.getElementById('cin').setAttribute('required','required');
                            return false; 
                          }
                               
                            else if(gumastaNo=="")
                          { document.getElementById('gumastaNo').setAttribute('required','required');
                            return false; 
                          }
                                
                               else if(busiAadhar=="")
                          { document.getElementById('busiAadhar').setAttribute('required','required');
                            return false; 
                          }
                                
                              else if(comnyPan=="")
                          { document.getElementById('comnyPan').setAttribute('required','required');
                            return false; 
                          }
                                
                                
                              else if(tanno=="")
                          { document.getElementById('tanno').setAttribute('required','required');
                            return false; 
                          }
                             else if(Establishment=="")
                          { document.getElementById('Establishment').setAttribute('required','required');
                            return false; 
                          }
                            else if(vat=="")
                          { document.getElementById('vat').setAttribute('required','required');
                            return false; 
                          }  
                                  
                        
                          else
                          {  
                                return true;
                              
                          }
             
                 }
             
                 
                 
                 
 } 
 
 
 function checkcont()
{
try{
    
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
                //  message += $(this).text() + " " + $(this).val() + "\n";
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
 // alert("fields2 -"+fields2)
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
      // return true;           
                 
}catch(e){
    alert(e);
}
}

 
 

 
 
/*
 var bool2=true;
function checkcont()
{

//alert("hello");
    var mob=document.getElementById('contact').value;
   // alert(email);
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			
   data:'mob='+mob='&sts=1',
             success: function(msg){
                 alert(msg);
   $('.text-danger').parent().addClass('form-group required');
                  $('.text-danger').parent().removeClass('has-error');
                 $('.alert, .text-danger').remove();
if(msg==1)
{
   // alert("Email id already exists !!");
    //bool=false;
     var element2 = $('#contact');
$(element2).after('<div class="text-danger">' +'Contact No is already registered' + '</div>');
$('.text-danger').parent().addClass('has-error');
    bool2=false;
    element2.focus();
}

            }
         }); 
   return bool2;
}




function finalval()
{
    if(!checkcont())
    {
       return false; 
    }
    else if(checkemail())
    {
        
        return false; 
        
    }else
    {
      return true;   
    }
    
    
}*/
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
      
    <div class="row">      <br>  <div id="content1" class="col-sm-2"> </div>       <div id="container content" class="col-sm-8" style="background-color: #f5f5f5;border-radius:1%;">      
   <br><center> If you are already a Member <a href="user/index.php">Click Here</a>
    <h1>Register Account</center></h1>
      <p><!--If you already have an account with us, please login at the <a href="login.php">login page</a>.--></p>
    


 		<form action="processAddCustomer.php" method="post" enctype="multipart/form-data" id="loginForm"  class="form-horizontal" autocomplete="OFF" onsubmit="return finalval();">
		  <input type="hidden" name="Latitude" id="Latitude" readonly>
          <input type="hidden" name="Longitude" id="Longitude" readonly>

<div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Capture Current Location</font></label>
     <div class="col-sm-9">
        <input type="checkbox" id="caploc" name="caploc" checked/>
    </div>
</div>
 <div class="form-group required">
    <label class="col-sm-3 control-label" for="input-firstname">
        <font color="black" >Company Type</font></label>
     <div class="col-sm-9">
        <select  class="form-control" id="ctyp" name="ctyp" class="inp-form" required  onchange="disfn('');" >
            <option value="0">Select type</option>
            <option value="1" >Partnership</option>
            <option value="2" >Proprietorship</option>
            <!-- <option value="3" >Individual </option>-->
            <option value="4" >Limited company </option>
        </select>
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
  function disfn(sts){
      try
      {
           //==================================================================
        var r= document.getElementById('ctyp').value;
        $.ajax({
             type: "POST",
             url: "regIndividual.php",
			 data:'id='+r,
         success: function (dat) {
                       // alert(dat)
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
                        alert("error" + msg);
                    }
         }); 
  //=================================================================               
          if(document.getElementById('ctyp').value=="1")
            {
                //hide compname st Ccity CArea Caddress CTelephn Cfax Cemail Cperson  lDesignatn  Cmobile   Ccategory  Clogo  shopLic  dtofreg   PartshipRegis  Partshipcn 
               //PtsGumasta PartshipBusiAadhr  PartshipcomnyPan  Partshiptanno  Yestablis  adhno pcn Eno gstno

                document.getElementById('id-email').style.display="none";
                document.getElementById('id-Cemail').style.display="block";
                document.getElementById('id-cat').style.display="none";
                document.getElementById('id-Ccat').style.display="block";
                document.getElementById('id-logo').style.display="none";
                document.getElementById('id-Clogo').style.display="block";
                document.getElementById('id-name').style.display="none";
                document.getElementById('id-Cname').style.display="block";
                document.getElementById('id-teleph').style.display="none";
                document.getElementById('id-Cteleph').style.display="block";

                document.getElementById('hide').style.display="block";
                document.getElementById('compname').style.display="block";
                document.getElementById('st').style.display="block";
                document.getElementById('Ccity').style.display="block";
                document.getElementById('CArea').style.display="block";
                document.getElementById('Caddress').style.display="block";
                
                document.getElementById('CPincode').style.display="block";
                
                document.getElementById('CTelephn').style.display="block";
                document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
              //document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
                document.getElementById('shopLic').style.display="block";
                document.getElementById('dtofreg').style.display="block";
               //document.getElementById('PartshipRegis').style.display="block";
                document.getElementById('Partshipcn').style.display="block";
                document.getElementById('PtsGumasta').style.display="block";
                document.getElementById('PartshipBusiAadhr').style.display="block";
                document.getElementById('PartshipcomnyPan').style.display="block";
                document.getElementById('Partshiptanno').style.display="block";
               //document.getElementById('Yestablis').style.display="block";
               //document.getElementById('adhno').style.display="block";
               //document.getElementById('pcn').style.display="block";
               //document.getElementById('Eno').style.display="block";
                document.getElementById('gstno').style.display="block";
                
                
                
                document.getElementById('adhar').value=" ";
                document.getElementById('adhno').style.display="none";
                document.getElementById('yoe').value=" ";
                document.getElementById('Yestablis').style.display="none";
                document.getElementById('Establishment').value=" ";
                document.getElementById('Eno').style.display="none";
                document.getElementById('lic').value=" ";
                document.getElementById('shopLic').style.display="none";
                document.getElementById('pan').value=" ";
                document.getElementById('pcn').style.display="none";
                document.getElementById('Ldesignation').value=" ";
                document.getElementById('lDesignatn').style.display="none";
                document.getElementById('Registn').value=" ";
                document.getElementById('PartshipRegis').style.display="none";
                
                document.getElementById('nomem').setAttribute('required','required');
              }
              else if(document.getElementById('ctyp').value=="2")
              {  
              document.getElementById('id-email').style.display="none";
              document.getElementById('id-Cemail').style.display="block";
              document.getElementById('id-cat').style.display="none";
              document.getElementById('id-Ccat').style.display="block";
              document.getElementById('id-logo').style.display="none";
              document.getElementById('id-Clogo').style.display="block";
              document.getElementById('id-name').style.display="none";
              document.getElementById('id-Cname').style.display="block";
              document.getElementById('id-teleph').style.display="none";
              document.getElementById('id-Cteleph').style.display="block";
                 
                //document.getElementById('hide').style.display="block";
                document.getElementById('compname').style.display="block";
                document.getElementById('st').style.display="block";
                document.getElementById('Ccity').style.display="block";
                document.getElementById('CArea').style.display="block";
                document.getElementById('Caddress').style.display="block";
                
                document.getElementById('CPincode').style.display="block";
                
                document.getElementById('CTelephn').style.display="block";
                document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
               //document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
                //document.getElementById('shopLic').style.display="block";
                //document.getElementById('dtofreg').style.display="block";
                //document.getElementById('PartshipRegis').style.display="block";
                //document.getElementById('Partshipcn').style.display="block";
                document.getElementById('PtsGumasta').style.display="block";
                document.getElementById('PartshipBusiAadhr').style.display="block";
               //document.getElementById('PartshipcomnyPan').style.display="block";
                document.getElementById('Partshiptanno').style.display="block";
                //document.getElementById('Yestablis').style.display="block";
                document.getElementById('adhno').style.display="block";
                document.getElementById('pcn').style.display="block";
               //document.getElementById('Eno').style.display="block";
                document.getElementById('gstno').style.display="block";
                
              document.getElementById('nomem').value="";
              document.getElementById('hide').style.display="none";
              document.getElementById('Ldesignation').value="";
              document.getElementById('lDesignatn').style.display="none";
              document.getElementById('lic').value="";
              document.getElementById('shopLic').style.display="none";
              document.getElementById('Registn').value="";
              document.getElementById('PartshipRegis').style.display="none";
              document.getElementById('cin').value="";
              document.getElementById('Partshipcn').style.display="none";
              document.getElementById('comnyPan').value="";
              document.getElementById('PartshipcomnyPan').style.display="none";
              document.getElementById('yoe').value="";
              document.getElementById('Yestablis').style.display="none";
              document.getElementById('Establishment').value="";
              document.getElementById('Eno').style.display="none";
              document.getElementById('rdate').value=""; 
              document.getElementById('dtofreg').style.display="none";    
                      
              document.getElementById('nomem').removeAttribute('required','required');
              document.getElementById('attatch').innerHTML="";
            }
             else if(document.getElementById('ctyp').value=="3")
              {  
               // document.getElementById('hide').style.display="block";
                document.getElementById('compname').style.display="block";
                document.getElementById('st').style.display="block";
                document.getElementById('Ccity').style.display="block";
                document.getElementById('CArea').style.display="block";
                document.getElementById('Caddress').style.display="block";
                
                document.getElementById('CPincode').style.display="block";
                
               document.getElementById('CTelephn').style.display="block";
               //document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
               //document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
               //document.getElementById('shopLic').style.display="block";
               //document.getElementById('dtofreg').style.display="block";
              //document.getElementById('PartshipRegis').style.display="block";
              //document.getElementById('Partshipcn').style.display="block";
               //document.getElementById('PtsGumasta').style.display="block";
              //document.getElementById('PartshipBusiAadhr').style.display="block";
               //document.getElementById('PartshipcomnyPan').style.display="block";
                //document.getElementById('Partshiptanno').style.display="block";
             //document.getElementById('Yestablis').style.display="block";
                document.getElementById('adhno').style.display="block";
                document.getElementById('pcn').style.display="block";
              //document.getElementById('Eno').style.display="block";
               //document.getElementById('gstno').style.display="block";
               
               document.getElementById('id-email').style.display="block";
               document.getElementById('id-Cemail').style.display="none";
               document.getElementById('id-cat').style.display="block";
               document.getElementById('id-Ccat').style.display="none";
               document.getElementById('id-logo').style.display="block";
               document.getElementById('id-Clogo').style.display="none";
               document.getElementById('id-name').style.display="block";
               document.getElementById('id-Cname').style.display="none";
               document.getElementById('id-teleph').style.display="block";
               
              document.getElementById('id-Cteleph').style.display="none";
                 
              document.getElementById('nomem').value="";
              document.getElementById('hide').style.display="none";
              document.getElementById('fax').value="";
              document.getElementById('Cfax').style.display="none";
              document.getElementById('rdate').value="";
              document.getElementById('dtofreg').style.display="none";
              document.getElementById('Ldesignation').value="";
              document.getElementById('lDesignatn').style.display="none";
              document.getElementById('lic').value="";
                 document.getElementById('shopLic').style.display="none";
                  document.getElementById('Registn').value="";
                  document.getElementById('PartshipRegis').style.display="none";
                   document.getElementById('cin').value="";
                   document.getElementById('Partshipcn').style.display="none";
                    document.getElementById('gumastaNo').value="";
                    document.getElementById('PtsGumasta').style.display="none";
                     document.getElementById('busiAadhar').value="";
                     document.getElementById('PartshipBusiAadhr').style.display="none";
                       document.getElementById('comnyPan').value="";
                       document.getElementById('PartshipcomnyPan').style.display="none";
                          document.getElementById('tanno').value="";
                          document.getElementById('Partshiptanno').style.display="none";
                           document.getElementById('yoe').value="";
                           document.getElementById('Yestablis').style.display="none";
                            document.getElementById('Establishment').value="";
                            document.getElementById('Eno').style.display="none";
                             document.getElementById('vat').value="";
                             document.getElementById('gstno').style.display="none";
                                    
          
               document.getElementById('nomem').removeAttribute('required','required');
               document.getElementById('attatch').innerHTML="";
                  }
                 else if(document.getElementById('ctyp').value=="4")
                  {
                  document.getElementById('id-email').style.display="none";
                  document.getElementById('id-Cemail').style.display="block";
                    document.getElementById('id-cat').style.display="none";
                    document.getElementById('id-Ccat').style.display="block";
                      document.getElementById('id-logo').style.display="none";
                      document.getElementById('id-Clogo').style.display="block";
                        document.getElementById('id-name').style.display="none";
                        document.getElementById('id-Cname').style.display="block";
                           document.getElementById('id-teleph').style.display="none";
                           document.getElementById('id-Cteleph').style.display="block";
                 
                      
                      
                      // document.getElementById('hide').style.display="block";
                document.getElementById('compname').style.display="block";
                document.getElementById('st').style.display="block";
                document.getElementById('Ccity').style.display="block";
                document.getElementById('CArea').style.display="block";
                document.getElementById('Caddress').style.display="block";
                 document.getElementById('CPincode').style.display="block";
                document.getElementById('CTelephn').style.display="block";
                  document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
                document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
               //  document.getElementById('shopLic').style.display="block";
               // document.getElementById('dtofreg').style.display="block";
              // document.getElementById('PartshipRegis').style.display="block";
                document.getElementById('Partshipcn').style.display="block";
                document.getElementById('PtsGumasta').style.display="block";
                document.getElementById('PartshipBusiAadhr').style.display="block";
                document.getElementById('PartshipcomnyPan').style.display="block";
                document.getElementById('Partshiptanno').style.display="block";
                document.getElementById('Yestablis').style.display="block";
              //document.getElementById('adhno').style.display="block";
               //document.getElementById('pcn').style.display="block";
                document.getElementById('Eno').style.display="block";
                document.getElementById('gstno').style.display="block";
                    
                      
               document.getElementById('nomem').value=""; 
               document.getElementById('hide').style.display="none";
                document.getElementById('lic').value=""; 
                document.getElementById('shopLic').style.display="none";  
                document.getElementById('Registn').value=""; 
                    document.getElementById('PartshipRegis').style.display="none";    
                       document.getElementById('adhar').value=""; 
                       document.getElementById('adhno').style.display="none";    
                          document.getElementById('pan').value=""; 
                          document.getElementById('pcn').style.display="none";    
                             document.getElementById('rdate').value=""; 
                             document.getElementById('dtofreg').style.display="none";
    
                      document.getElementById('nomem').removeAttribute('required','required');
                      document.getElementById('attatch').innerHTML="";
                }
                  }catch(ex)
                  {
                    alert(ex);  
                  }
              }
          </script>
             <div class="form-group " id="hide" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">No. of Partner</font></label>
            <div class="col-sm-9">
                <input type="text" id="nomem" name="nomem" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onblur="addItem();"> 
            </div>
          </div>
         <div class="form-group " >
            <label class="col-sm-3 control-label" for="input-firstname"><font color="black" ></font></label>
             <div class="col-sm-9" id="attatch">
            </div>
          </div>
        <div class="form-group required" id="compname">
        <label class="col-sm-3 control-label" for="input-firstname" id="id-Cname"><font color="black" >Company Name</font></label>
          <label class="col-sm-3 control-label" for="input-firstname" id="id-name" style="display:none"><font color="black" >Name</font></label>
           <div class="col-sm-9">
              <input type="text" name="cname" id="cname" placeholder=" Name"  class="form-control" size="50" tabindex=0 required autofocus/>
           </div>
        </div>
        <div class="form-group required" id="st">
          <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >State</font></label>
                <div class="col-sm-9">
                   <select name="state"   id="state" class="form-control" class="styledselect_form_1"  onchange="city1()" ><option value="0" style="width: 12em" >Select</option>
                           <?php 
                                $sqlm=mysqli_query($con1,"select * from states");
                                while($rowm=mysqli_fetch_row($sqlm)){
                            ?>
	         			   <option value="<?php echo $rowm[1]; ?>"><?php echo $rowm[1]; ?></option>
                           <?php } ?>
                    </select>
                </div>
          </div>
           
          <div class="form-group required" id="Ccity">
            <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >City</font></label>
             <div class="col-sm-9">
                <div id="city1" >
                    <select  name="city" class="form-control" class="styledselect_form_1" id="city" ><option value="0" style="width: 15em" >select</option>
                    
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group required" id="CArea">
            <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Area</font></label>
             <div class="col-sm-9">
                <input type="text"  class="form-control" name="area" id="area"   required autofocus/><div id="search_suggest">
        
            </div>
        </div>
    </div>
    <div class="form-group required" id="Caddress">
        <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Address</font></label>
        <div class="col-sm-9">
            <input type="text"  class="form-control" name="add2"  class="in-form" required autofocus/>
        </div>
    </div>
    <div class="form-group required" id="CPincode">
        <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Pincode</font></label>
        <div class="col-sm-9">
            <input type="text"  class="form-control" name="Pincode"  class="in-form" required autofocus/>
        </div>
    </div>
    <div class="form-group " id="CTelephn">
        <label class="col-sm-3 control-label" for="input-firstname" id="id-Cteleph"><font color="black" >Company Telephone</font></label>
        <label class="col-sm-3 control-label" for="input-firstname" id="id-teleph" style="display:none"><font color="black" >Telephone</font></label>
        <div class="col-sm-9">
            <input type="text" name="phone" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="phone"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'  />
            
            <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
        </div>
    </div>
    <div class="form-group" id="Cfax">
        <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Fax</font></label>
        <div class="col-sm-9">
            <input type="text" name="fax" maxlength ="11" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="fax"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'  />
            <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
        </div>
    </div>
    <div class="form-group required" id="Cemail">
        <label class="col-sm-3 control-label" for="input-firstname" id="id-Cemail"><font color="black" >Company Email</font></label>
          <label class="col-sm-3 control-label" for="input-firstname" id="id-email" style="display:none"><font color="black" >Email-ID</font></label>
        <div class="col-sm-9">
            <input type="email"  class="form-control" name="email" id="email" class="inp-form" onblur="checkemail();" required autofocus/>Email will be sent to this email id<br/>
        </div>
    </div>
    <div class="form-group required" id="Cperson">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Contact Person</font></label>
     <div class="col-sm-9">
            
<input type="text"  name="contactPerson" class="form-control" class="inp-form" placeholder="Enter character only"  required autofocus/>
                          </div>
          </div> 
            
            <div class="form-group " id="lDesignatn" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Designation</font></label>
            <div class="col-sm-9">
            <input type="text" id="Ldesignation" name="Ldesignation" class="form-control"  /> 
            </div>
            </div>
            
            
          
          <div class="form-group required" id="Cmobile">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Mobile</font></label>
                      <div class="col-sm-9">
              <input type="text" name="mobile" maxlength ="10" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontactno();" value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
         </div>
          
            <div  class="form-group required" id="Ccategory">
    <label class="col-sm-3 control-label" for="input-firstname" id="id-Ccat"><font color="black" >Company Category</font></label>
     <label class="col-sm-3 control-label" for="input-firstname" id="id-cat" style="display:none"><font color="black" >Category</font></label>
   <input type="hidden" id="cat" name="cat">
   <input type="hidden" id="catn" name="catn">
   
     <div class="col-sm-9">
            
<!--<select name="cat" id="cat"  class="form-control" class="styledselect_form_1"  required><option value="" >select</option>-->

<!--<div class="compny">
    <span class="input">
     <select   id="compny" name="compny"     >
         <?php 
           		 //  while($row = mysqli_fetch_row($result))
					{  ?>
  	<option   value="<?php// echo $row[0]; ?>" /> <?php //echo $row[1]; ?><?php //echo $rowm[1]; ?></option>
                     <br/>
   	
                   <?php } ?>
        </select>
    </span>
</div>
-->



<div class="multiselect">
		<div class="selectbox" onclick="showCheckBoxes()">
			<select id="compny" name="compny"  class="form-control" style="width: 288%;" >
				<option>Select option</option>
			</select>
			
			<div class="overSelect"></div>
	
		</div> 
		
		<div id="checkboxes" class="checkboxes" style="display: block;width: 599px;" >
			
		</div>
		
	</div>




    <div id="res" ></div>
                          </div>
          </div>
           
          
            
          
            <div class="form-group " id="Clogo">
               <label class="col-sm-3 control-label" for="input-firstname" id="id-Clogo"><font color="black" >Company Logo</font></label>
            <label class="col-sm-3 control-label" for="input-firstname" id="id-logo" style="display:none"><font color="black" >Logo</font></label>
           
            <div class="col-sm-9">
               <input type="file" name="logo"  padding="0" class="form-control" class="inp-form"  size="50"/><p style="color:red">( Upload image only..)</p>
            </div>
          </div>
            
            
            

      
            
          
            <div class="form-group " id="shopLic">
               <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Shop and Establisment Licence</font></label>
              <div class="col-sm-9">
                <input type="text"  class="form-control" id="lic" name="lic" size="50" class="inp-form" />
              </div>
            </div>
          
            
            
            
            
                    <div class="form-group " id="dtofreg">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Date Of Registration</font></label>
     <div class="col-sm-9">
            
<input type="text"   class="form-control" name="rdate" id="rdate" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form"  autofocus/>
                         <!-- <script src="datepc/dcalendar.picker.js"></script>-->
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>

     
<script>
$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>


                          </div>
          </div> 
            
            
            
            
            
            
            <div class="form-group required" id="PartshipRegis" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Registeration No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="Registn" name="Registn" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" /> 
            </div>
            </div>
                   
          
            <div class="form-group required" id="Partshipcn" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">CIN No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="cin" name="cin" class="form-control" /> 
            </div>
            </div>
            
             <div class="form-group " id="PtsGumasta" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Gumasta </font></label>
            <div class="col-sm-9">
            <input type="text" id="gumastaNo" name="gumastaNo" class="form-control"  /> 
            </div>
            </div>   
            
            
            
            
            <div class="form-group " id="PartshipBusiAadhr" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Business Aadhar No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="busiAadhar" name="busiAadhar" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" /> 
            </div>
            </div>
            
  
           
            
            
           <div class="form-group required" id="PartshipcomnyPan" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Company Pan No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="comnyPan" name="comnyPan" class="form-control"  > 
            </div>
            </div>

            
            <div class="form-group required" id="Partshiptanno" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">TAN No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="tanno" name="tanno" class="form-control" /> 
            </div>
            </div>

            
            
             <div class="form-group " id="Yestablis">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Year Of Establishment</font></label>
     <div class="col-sm-9">
            
<!--<input type="text"  class="form-control" name="fees" size="50" class="inp-form" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='4' />

                          </div>-->
                          
                           
              <input type="text" name="yoe" maxlength ="4" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="yoe"  class="form-control"  value="<?php if($Mobile!=""){ echo $Mobile;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
                          
                          
          </div>
            
          
           
          
             <div class="form-group required" id="adhno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Adhar card no.</font></label>
     <div class="col-sm-9">
            
<!--<input type="text" class="form-control" name="adhar" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="12" size="50" class="inp-form" required autofocus/>-->


              <input type="text" name="adhar" maxlength ="12" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Adhar Number" <?php } ?> id="adhar"  class="form-control" value="<?php if($adhar!=""){ echo $adhar;} ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' autofocus />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($adhar!=""){ echo  $adhar;} ?>"/>
                       
                         
                          </div>
          </div>
            
          
           <div class="form-group required" id="pcn">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Pan card no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control" name="pan" id="pan"  size="50" class="inp-form" placeholder="Pancard number"   autofocus/>
                          </div>
          </div>
            
          
           <div class="form-group required" id="Eno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Establishment no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control" id="Establishment" name="Establishment" placeholder="Establishment number" class="inp-form"  autofocus/>
                          </div>
          </div>
            


         
           <div class="form-group required" id="gstno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >GSTIN NO.</font></label>
     <div class="col-sm-9">
            
<input type="text" id="vat" name="vat" class="form-control"  class="inp-form" placeholder="GSTIN number"  autofocus/>
                          </div>
          </div>
            
            
            <div class="form-group required" id="bnknm">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Bank Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="bknm" name="bknm" class="form-control"  class="inp-form" placeholder="Bank Name" required autofocus/>
                          </div>
          </div>
          
          
          <div class="form-group required" id="brNam">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Branch Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="brchnm" name="brchnm" class="form-control" placeholder="Branch Name"  class="inp-form" required autofocus/>
                          </div>
          </div>
            
          
          <div class="form-group required" id="ifscod">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >IFSC Code</font></label>
     <div class="col-sm-9">
            
<input type="text" id="ifscode" name="ifscode" class="form-control" placeholder="IFSC Code"  class="inp-form" required autofocus/>
                          </div>
          </div>
          
          
          
          <div class="form-group required" id="acno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Account NO.</font></label>
     <div class="col-sm-9">
            
<input type="text" id="actno" name="actno" class="form-control"  class="inp-form" placeholder="Account Number" required autofocus/>
                          </div>
          </div>
        
           
          
          <div class="form-group required" id="acNam">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Account Holder Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="acholnm" name="acholnm" class="form-control"  class="inp-form" placeholder="Account Holder Name"  required autofocus/>
                          </div>
          </div>
            
            
            
            
            
            
            
            
            
          
         <div align="center">
            <input type="submit" class="btn btn-primary" value=Submit name="submit" style="border-radius: 10px; margin-top: 4px;" />
            <button type="button" style="border-radius: 10px;" class="btn btn-primary"   onclick='window.open("admin.php","_self");'>Cancel</button>
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
			$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('#custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('#custom-field' + custom_field['custom_field_id']).addClass('required');
				}
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
    
</script><div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
</body>
</html>