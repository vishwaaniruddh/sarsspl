<?php 
session_start();
include('adminaccess.php');
include('header.php');
include('config.php');



$cmp=$_GET['cmp'];
$sql = mysql_query("select * from clients where code='".$cmp."'");
echo "select * from clients where code='".$cmp."'";
		$row = mysql_fetch_array($sql);	
        
        $sql1 = mysql_query("select * from Bank_Details where Merchant_id='".$row['code']."'");
		$row1 = mysql_fetch_array($sql1);	
        
          
        
        
        $qry="select code,name from cities";
			  $res=mysql_query($qry);                
			  $num=mysql_num_rows($res);

						  $qry1="select distinct code from categories";
						 $res1=mysql_query($qry1);                
						  $num1=mysql_num_rows($res1);     

       					$qry2="select max(code) as ncode from clients";   
						 $res2=mysql_query($qry2);
						 $row2=mysql_fetch_array($res2);
						       
							  $qry="select * from main_cat WHERE UNDER=0";
             				  $result=mysql_query($qry);  
             	
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
       
       <style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>
<script>
          
          
           function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }  }
</script>          
       
              <script type="text/javascript" src="../catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="../requiredfunctions.js"></script>
    	     <link href="../catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/paneltool.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/colorpicker/css/colorpicker.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/animate.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/magnific/magnific-popup.css" rel="stylesheet" />
                <link href="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/fonts.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/homebuilder.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/sliderlayer/css/typo.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/pavnewsletter.css" rel="stylesheet" />
                <script type="text/javascript" src="../catalog/view/javascript/jquery/magnific/jquery.magnific-popup.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/bootstrap/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/theme/pav_bigstore/javascript/common.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/pavdeals/countdown.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/jquery/colorpicker/js/colorpicker.js"></script>
              
            <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.plugins.min.js"></script>
                <script type="text/javascript" src="../catalog/view/javascript/layerslider/jquery.themepunch.revolution.min.js"></script>
    <!-- FONT -->

        <!-- FONT -->
<script>

function getloc()
{
 //alert("ok");

    $.ajax({
             type: "POST",
             url: "getlocationtestr.php",
		datatype:'json',	
   data:'',

             success: function(msg){
                // alert(msg);
//alert(msg.city);
var jsr=JSON.parse(msg);
//alert(jsr['region_name']);


document.getElementById("state").value=jsr['region_name'];
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

/*
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

*/


var boolemail=false;
function checkemail()
{
    
    try
    {
var element2 = $('#email');
//alert("hello");
    var email=document.getElementById('email').value;
    
    if(if(email.trim()!="")
    {
    
    var email2=document.getElementById('email2').value;
   // alert(email);
   if(email!=email2)
   {
   
   
   
    $.ajax({
             type: "POST",
             url: "checkemail.php",
			async: false,
   data:'email='+email,
             success: function(msg){
                 
                 $(element2).parent().addClass('');
                 $(element2).parent().removeClass('has-error');
                 $('#emailerr').remove();
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
    }
    }catch(exc)
    {
        //alert(exc);
    }
   return boolemail;
}

 
 
 
function checkcontactno()
{
var boolcont=false;
//alert("hello");
 var element3 = $('#mobile');
    var mob=document.getElementById('mobile').value;
    var mob2=document.getElementById('mobile2').value;
   // alert(email);
   if(mob!="")
   {
       
       
       if(mob!=mob2)
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
                 $('#conterr').remove();
if(msg==1)
{
   // alert("Email id already exists !!");
    //bool=false;
     
$(element3).after('<div class="text-danger" id="conterr">' +'Contact number is already registered' + '</div>');
$(element3).parent().addClass('has-error');
    boolcont=false;
    element3.focus();
}

            }
         }); 
       }
   }
   return boolcont;
}
 
 function finalval()
{
    if(checkcont1() && checkemail())
    {
       return true; 
    }
    else
    {
        
        return false; 
        
    }
    
   
}
function checkcont1()
{

//alert("hello");

try{
var fields2 = document.getElementsByName("cat[]");

    var cat=0;
    
    for(var i = 0; i < fields2.length; i++) 
                   {    
  if(fields2[i].checked==true)
{
    cat=1;
alert("category is requierd !!");
document.getElementById(fields2[i].id).focus();

}
                   }   
                   if(cat==0){
                       
                       return false;
                   }else{
   return true;
                   }
}catch(e){
    alert(e);
}
}
 

 function catselected(val)
 {
  var nm=""; 
      var ct=document.getElementById("companycat").value; 
    
     if(ct!="" )
     {
         
         nm=ct+","+val;
        }else
     {
         
          nm=val;
        
     }
     document.getElementById("companycat").value=nm;
     }
 


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
alert(xmlhttp.responseText);
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
  padding: 8px 20px;
  font-size: 18px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 10px;
 
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  

</style>
<?php   if(isset($_GET['sts']) & $_GET['sts']!="")
{ 
?>
<script>
showstatsfunc('<?php echo $_GET['sts'];?>');
</script>
<?php
}
?>
<script>
function disfn1(st){
    
                try
                  {
                  if(document.getElementById('ctyp').value=="1")
                  {

 //hide compname st Ccity CArea Caddress CTelephn Cfax Cemail Cperson  lDesignatn  Cmobile   Ccategory  Clogo  shopLic  dtofreg   PartshipRegis  Partshipcn 
   //PtsGumasta PartshipBusiAadhr  PartshipcomnyPan  Partshiptanno  Yestablis  adhno pcn Eno gstno

                  document.getElementById('id-email').style.display="none";
                  document.getElementById('id-Cemail').style.display="bolck";
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
                document.getElementById('CTelephn').style.display="block";
                  document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
              //  document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
                  document.getElementById('shopLic').style.display="block";
                document.getElementById('dtofreg').style.display="block";
               // document.getElementById('PartshipRegis').style.display="block";
                document.getElementById('Partshipcn').style.display="block";
                document.getElementById('PtsGumasta').style.display="block";
                document.getElementById('PartshipBusiAadhr').style.display="block";
                document.getElementById('PartshipcomnyPan').style.display="block";
                  document.getElementById('Partshiptanno').style.display="block";
               // document.getElementById('Yestablis').style.display="block";
               // document.getElementById('adhno').style.display="block";
               // document.getElementById('pcn').style.display="block";
               // document.getElementById('Eno').style.display="block";
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
                  document.getElementById('id-Cemail').style.display="bolck";
                    document.getElementById('id-cat').style.display="none";
                    document.getElementById('id-Ccat').style.display="block";
                      document.getElementById('id-logo').style.display="none";
                      document.getElementById('id-Clogo').style.display="block";
                        document.getElementById('id-name').style.display="none";
                        document.getElementById('id-Cname').style.display="block";
                            document.getElementById('id-teleph').style.display="none";
                            document.getElementById('id-Cteleph').style.display="block";
                 
                      
                      
                      
                      
                     //  document.getElementById('hide').style.display="block";
                document.getElementById('compname').style.display="block";
                document.getElementById('st').style.display="block";
                document.getElementById('Ccity').style.display="block";
                document.getElementById('CArea').style.display="block";
                document.getElementById('Caddress').style.display="block";
                document.getElementById('CTelephn').style.display="block";
                  document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
               // document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
                //  document.getElementById('shopLic').style.display="block";
               // document.getElementById('dtofreg').style.display="block";
                //document.getElementById('PartshipRegis').style.display="block";
              //  document.getElementById('Partshipcn').style.display="block";
                document.getElementById('PtsGumasta').style.display="block";
                document.getElementById('PartshipBusiAadhr').style.display="block";
               // document.getElementById('PartshipcomnyPan').style.display="block";
                  document.getElementById('Partshiptanno').style.display="block";
                //document.getElementById('Yestablis').style.display="block";
                document.getElementById('adhno').style.display="block";
                document.getElementById('pcn').style.display="block";
               // document.getElementById('Eno').style.display="block";
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
               document.getElementById('CTelephn').style.display="block";
               // document.getElementById('Cfax').style.display="block";
                document.getElementById('Cemail').style.display="block";
                document.getElementById('Cperson').style.display="block";
               // document.getElementById('lDesignatn').style.display="block";
                document.getElementById('Cmobile').style.display="block";
                document.getElementById('Ccategory').style.display="block";
                document.getElementById('Clogo').style.display="block";
               //  document.getElementById('shopLic').style.display="block";
               // document.getElementById('dtofreg').style.display="block";
              // document.getElementById('PartshipRegis').style.display="block";
              //  document.getElementById('Partshipcn').style.display="block";
               // document.getElementById('PtsGumasta').style.display="block";
              //  document.getElementById('PartshipBusiAadhr').style.display="block";
               // document.getElementById('PartshipcomnyPan').style.display="block";
                //  document.getElementById('Partshiptanno').style.display="block";
             //  document.getElementById('Yestablis').style.display="block";
                document.getElementById('adhno').style.display="block";
                document.getElementById('pcn').style.display="block";
              //  document.getElementById('Eno').style.display="block";
               // document.getElementById('gstno').style.display="block";
               
               
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
              //  document.getElementById('adhno').style.display="block";
               // document.getElementById('pcn').style.display="block";
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

      </head>
  <body class="common-home page-common-home layout-fullwidth" onload="disfn1('');">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
 

        <!-- /header -->
        <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
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
        
        
        
        
                        <div class="container" >
 <!-- <ul class="breadcrumb">
        <li><a href="http://sarmicrosystems.in/oc1/index.php?route=common/home"><i class="fa fa-home"></i></a></li>
       
        <li><a href="#">Register</a></li>
      </ul>-->
      
    <div class="row">        <div id="content1" class="col-sm-2"> </div>       <div id="content" class="col-sm-8" style="padding: 0px;">      <h1>Edit Account</h1>
      <p><!--If you already have an account with us, please login at the <a href="login.php">login page</a>.--></p>
    


 		<form action="processAddCustomer.php" method="post" enctype="multipart/form-data" id="loginForm"  class="form-horizontal" autocomplete="OFF" onsubmit="return finalval();">
  
		    <input type="hidden" id="Latitude" name="Latitude">
<input type="hidden" id="Longitude" name="Longitude">

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
            
<select  class="form-control" id="ctyp" name="ctyp" class="inp-form" required  onchange="disfn('');" disabled="disabled" >
    <option value="0">Select type</option>
    <option value="1" <?php if($row['companytyp']=="1") { echo "selected";} ?>>Partnership</option>
    <option value="2" <?php if($row['companytyp']=="2") { echo "selected";} ?>>Proprietorship</option>
    <option value="3" <?php if($row['companytyp']=="3") { echo "selected";} ?>>Individual </option>
     <option value="4" <?php if($row['companytyp']=="4") { echo "selected";} ?>>Limited company </option>
</select>
                          </div>
          </div>
            
            
              <?php $patnrpanr=explode(",",$row['partnerpancatd']);?>
          <div class="form-group " id="hide" style="display:<?php if($row['companytyp']=="1") { echo "block";}else{ echo "none";}?>">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black">No. of Partner</font></label>
     
            <div class="col-sm-9">
                <input type="text" id="nomem" name="nomem" class="form-control" onblur="addItem();" value="<?php echo count($patnrpanr);?>" disabled="disabled"> 
            </div>

                       
          </div>
            
         
         
          <?php if($row['companytyp']=="1") {?>
          <div class="form-group " >
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" ></font></label>
     <div class="col-sm-9" id="attatch">
            
            <?php 
            
            for($ar=0;$ar<count($patnrpanr);$ar++)
            {
            ?>
             <div><input type="text" id="pancard" name="pancard[]" class="form-control" value="<?php echo $patnrpanr[$ar]; ?>" required readonly> </div>

<?php } ?>


                          </div>
          </div>
          
         <?php } ?>
          
         
             

    <div class="form-group required" id="compname">
    <label class="col-sm-3 control-label" for="input-firstname" id="id-Cname"><font color="black" >Company Name</font></label>
      <label class="col-sm-3 control-label" for="input-firstname" id="id-name" style="display:none"><font color="black" >Name</font></label>
       <div class="col-sm-9">
          <input type="text" name="cname" id="cname" placeholder=" Name" value="<?php echo $row['name']; ?>"  class="form-control" size="50" tabindex=0 required autofocus disabled="disabled"/>
       </div>
    </div>
           
          
          <div class="form-group required" id="st">
    <label class="col-sm-3 control-label" for="input-firstname" ><font color="black" >State</font></label>
     <div class="col-sm-9">
            
              <select name="state" id="state" class="form-control" class="styledselect_form_1"  onchange="city1()" disabled="disabled">
                  <option value="0" style="width: 12em" disabled=disabled>Select</option>
                         <?php 
$sqlm=mysql_query("select * from states");
while($rowm=mysql_fetch_row($sqlm)){
?>
				<option disabled value="<?php echo $rowm[1]; ?>" <?php if($row[3]==$rowm[0]){ echo "selected";$stts=$rowm[1]; } ?>><?php echo $rowm[1]; ?></option>
<?php } 
$citydets=mysql_query("select * from cities where code='".$row[2]."'");
$citydetsrow=mysql_fetch_array($citydets);


$areadets=mysql_query("select * from cities where code='".$row[2]."'");
$areadetsrw=mysql_fetch_array($citydets);

?>
<script>city2('<?php echo $citydetsrow[2];?>');</script>
</select>
                          </div>
          </div>
           
          <div class="form-group required" id="Ccity">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >City</font></label>
     <div class="col-sm-9">
        <div id="city1" >
<select  name="city" class="form-control" class="styledselect_form_1" id="city" disabled=disabled>
    <option  value="<?php echo $citydetsrow[1]; ?>" style="width: 15em" ><?php echo $citydetsrow[2]; ?></option>

</select></div>                  </div>
          </div>


<div class="form-group required" id="CArea">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Area</font></label>
     <div class="col-sm-9">
            
              <input type="text"  class="form-control" name="area" id="area"  value="<?php echo $row['area']; ?>" required autofocus readonly/><div id="search_suggest">

</div>
                          </div>
          </div>
           
          
          
<div class="form-group required" id="Caddress">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Address</font></label>
     <div class="col-sm-9">
              <input type="text"  class="form-control" name="add2"  class="in-form"  value="<?php echo $row['address']; ?>" required autofocus readonly/>
        </div>
        </div>
            
          
          <div class="form-group required" id="CTelephn">
    <label class="col-sm-3 control-label" for="input-firstname" id="id-Cteleph"><font color="black" >Company Telephone</font></label>
    <label class="col-sm-3 control-label" for="input-firstname" id="id-teleph" style="display:none"><font color="black" >Telephone</font></label>
     <div class="col-sm-9">
                     
              <input type="text" name="phone" maxlength ="10" value="<?php echo $row['phone']; ?>" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="phone"  class="form-control"    onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
          </div>
            
          
             <div class="form-group" id="Cfax">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Company Fax</font></label>
     <div class="col-sm-9">
            <input type="text" name="fax" maxlength ="11" value="<?php echo $row['fax']; ?>" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="fax"  class="form-control"    onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46'  />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
          </div>
            
          
          
             <div class="form-group required" id="Cemail">
    <label class="col-sm-3 control-label" for="input-firstname" id="id-Cemail"><font color="black" >Company Email</font></label>
      <label class="col-sm-3 control-label" for="input-firstname" id="id-email" style="display:none"><font color="black" >Email-ID</font></label>
    <div class="col-sm-9">
            <input type="email"  class="form-control" name="email" id="email" class="inp-form"  value="<?php echo $row['email']; ?>" onblur="checkemail();" required autofocus/>Email will be sent to this email id<br/>
            </div>
                          </div>
         
            
          
           <div class="form-group required" id="Cperson">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Contact Person</font></label>
     <div class="col-sm-9">
            
<input type="text"  name="contactPerson" class="form-control" class="inp-form" value="<?php echo $row['contact']; ?>" placeholder="Enter character only"  required autofocus/>
                          </div>
          </div> 
            
            <div class="form-group " id="lDesignatn" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Designation</font></label>
            <div class="col-sm-9">
            <input type="text" id="Ldesignation" name="Ldesignation" class="form-control" value="<?php echo $row['designation']; ?>" /> 
            </div>
            </div>
            
            
          
          <div class="form-group required" id="Cmobile">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Mobile</font></label>
                      <div class="col-sm-9">
              <input type="text" name="mobile" maxlength ="10"  value="<?php echo $row['mobile']; ?>" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Mobile" <?php } ?> id="contact"  class="form-control" onblur="checkcontactno();"   onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' required autofocus/>
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
         </div>
          
          
          
          
                <div class="form-group required" id="Ccategory">
   <label class="col-sm-3 control-label" for="input-firstname" id="id-Ccat"><font color="black" >Company Category</font></label>
     <label class="col-sm-3 control-label" for="input-firstname" id="id-cat" style="display:none"><font color="black" >Category</font></label>
     <div class="col-sm-9">
            


<?php 

$catarr=explode(",",$row['cid']);

           		   while($rows = mysql_fetch_row($result))
					{  
					
					?>
                    
       <!-- <input type="checkbox" name="cat[]" value="<?php echo $rows[0]; ?>" <?php if(in_array($rows[0], $catarr)) { echo "checked";}?> disabled="disabled"/> <?php echo $rows[1]; ?><br/>

   <div id="res" ></div>
                          </div>
          </div>
          
          -->
            
         <input type="checkbox" onchange="catselected(this.value)" id="c" name="cat[]" value="<?php echo $rows[0]; ?>" <?php if(in_array($rows[0], $catarr)) {echo "checked"; }  ?>    <?php if(in_array($rows[0], $catarr)) { echo "disabled";} ?>  /> <?php echo $rows[1]; ?><br/>
   
 <?php if(in_array($rows[0], $catarr)) {
 
 ?>
 
 <script>
 
 catselected(<?php echo $rows[0]; ?>);
 </script>
 <?php
 
 }  ?> 


<?php } ?>

   <div id="res" ></div>
                          </div>
          </div>
          
          
          
          
          
          
          
          
          
          
            <div class="form-group " id="Clogo">
               <label class="col-sm-3 control-label" for="input-firstname" id="id-Clogo"><font color="black" >Company Logo</font></label>
            <label class="col-sm-3 control-label" for="input-firstname" id="id-logo" style="display:none"><font color="black" >Logo</font></label>
           
            <div class="col-sm-9">
                    <input type="hidden" name="oldlogo" size="50" value="<?php echo $row['logo']; ?>" />
            <img src="<?php echo $mainpath.$row['logo']; ?>" id="blah" height="200px" width="200px">
           
<input type="file" name="logo"  padding="0" class="form-control" class="inp-form"  size="50"  onchange="readURL(this);"/>
                          
            </div>
          </div>
            
            
            

      
            
          
            <div class="form-group " id="shopLic">
               <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Shop and Establisment Licence</font></label>
              <div class="col-sm-9">
                <input type="text"  class="form-control" id="lic" name="lic" size="50" class="inp-form" value="<?php echo $row['license']; ?>" readonly/>
              </div>
            </div>
          
            
            
            
            
                    <div class="form-group required" id="dtofreg">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Date Of Registration</font></label>
     <div class="col-sm-9">
            
<input type="text"   class="form-control" name="rdate" id="rdate" value="<?php echo date('d-m-Y',strtotime($row['rdate'])); ?>" data-maxdate="<?php echo date("Y-m-d", strtotime("+1 day"));?>"  class="inp-form" autofocus readonly/>
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
            <input type="text" id="Registn" name="Registn" class="form-control" value="<?php echo $row['yoe']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly/> 
            </div>
            </div>
                   
          
            <div class="form-group required" id="Partshipcn" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">CIN No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="cin" name="cin" class="form-control" value="<?php echo $row['CIN']; ?>" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly/> 
            </div>
            </div>
            
             <div class="form-group required" id="PtsGumasta" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Gumasta </font></label>
            <div class="col-sm-9">
            <input type="text" id="gumastaNo" name="gumastaNo" value="<?php echo $row['Gumasta']; ?>" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly/> 
            </div>
            </div>   
            
            
            
            
            <div class="form-group required" id="PartshipBusiAadhr" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Business Aadhar No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="busiAadhar" name="busiAadhar" value="<?php echo $row['BusiAadharNo']; ?>"	 class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly/> 
            </div>
            </div>
            
  
           
            
            
           <div class="form-group required" id="PartshipcomnyPan" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">Company Pan No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="comnyPan" name="comnyPan" value="<?php echo $row['CompanyPancard']; ?>" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly/> 
            </div>
            </div>

            
            <div class="form-group required" id="Partshiptanno" style="display:none">
            <label class="col-sm-3 control-label" ><font color="black">TAN No.</font></label>
            <div class="col-sm-9">
            <input type="text" id="tanno" name="tanno" value="<?php echo $row['Tanno']; ?>" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"  readonly/> 
            </div>
            </div>

            
            
             <div class="form-group " id="Yestablis">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Year Of Establishment</font></label>
     <div class="col-sm-9">
            
<!--<input type="text"  class="form-control" name="fees" size="50" class="inp-form" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength='4' />

                          </div>-->
                          
                           
              <input type="text" name="yoe" maxlength ="4" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="" <?php } ?> id="yoe"  class="form-control"  value="<?php echo $row['yoe']; ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($Mobile!=""){ echo  $Mobile;} ?>"/>
                       
                          </div>
                          
                          
                          
          </div>
            
          
           
          
             <div class="form-group required" id="adhno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Adhar card no.</font></label>
     <div class="col-sm-9">
            
<!--<input type="text" class="form-control" name="adhar" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="12" size="50" class="inp-form" required autofocus/>-->


              <input type="text" name="adhar" maxlength ="12" <?php if(!isset($_SESSION['loginstats']) & $_SESSION['loginstats']==""){?> placeholder="Adhar Number" <?php } ?> id="adhar"  class="form-control" value="<?php echo $row['adhar_no']; ?>"  onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' autofocus readonly />
                       <input type="hidden" name="contact2" id="contact2"   class="form-control" value="<?php if($adhar!=""){ echo  $adhar;} ?>"/>
                       
                         
                          </div>
          </div>
            
          
           <div class="form-group required" id="pcn">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Pan card no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control" name="pan" id="pan"  size="50" class="inp-form" placeholder="Pancard number" value="<?php echo $row['pan_no']; ?>"  autofocus readonly/>
                          </div>
          </div>
            
          
           <div class="form-group required" id="Eno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Establishment no.</font></label>
     <div class="col-sm-9">
            
<input type="text" class="form-control" id="Establishment" name="Establishment" placeholder="Establishment number" class="inp-form"  autofocus value="<?php echo $row[26]; ?>" readonly/>
                          </div>
          </div>
            


         
           <div class="form-group required" id="gstno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >GSTIN NO.</font></label>
     <div class="col-sm-9">
            
<input type="text" id="vat" name="vat" class="form-control"  class="inp-form" placeholder="GSTIN number"  autofocus value="<?php echo $row[23]; ?>" readonly/>
                          </div>
          </div>
            
            
            <div class="form-group required" id="bnknm">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Bank Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="bknm" name="bknm" class="form-control"  class="inp-form" placeholder="Bank Name" required autofocus value="<?php echo $row1['BankName']; ?>" readonly/>
                          </div>
          </div>
          
          
          <div class="form-group required" id="brNam">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Branch Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="brchnm" name="brchnm" class="form-control" placeholder="Branch Name"  class="inp-form" required autofocus value="<?php echo $row1['BranchName']; ?>" readonly/>
                          </div>
          </div>
            
          
          <div class="form-group required" id="ifscod">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >IFSC Code</font></label>
     <div class="col-sm-9">
            
<input type="text" id="ifscode" name="ifscode" class="form-control" placeholder="IFSC Code" value="<?php echo $row1['IFScode']; ?>" readonly onkeypress='return (event.which >= 48 && event.which <= 57) || event.which == 8 || event.which == 46' class="inp-form" required autofocus/>
                          </div>
          </div>
          
          
          
          <div class="form-group required" id="acno">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Account NO.</font></label>
     <div class="col-sm-9">
            
<input type="text" id="actno" name="actno" class="form-control"  class="inp-form" placeholder="Account Number" value="<?php echo $row1['AccountNumber']; ?>" readonly required autofocus/>
                          </div>
          </div>
        
           
          
          <div class="form-group required" id="acNam">
    <label class="col-sm-3 control-label" for="input-firstname"><font color="black" >Account Holder Name</font></label>
     <div class="col-sm-9">
            
<input type="text" id="acholnm" name="acholnm" class="form-control"  class="inp-form" placeholder="Account Holder Name" value="<?php echo $row1['AC_HoldersName']; ?>" readonly required autofocus/>
                          </div>
          </div>
            
            
            
            
            
            
            
            
            
          
         <div align="center">
         <input type="submit" class="button" value=Save />
        <button type="button"  onclick="window.open('admin.php','_self');";>Back</button>
         </div>
         

                     
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
</body></html>

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

 <link rel="stylesheet" type="text/css" href="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.css" />

 
 
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