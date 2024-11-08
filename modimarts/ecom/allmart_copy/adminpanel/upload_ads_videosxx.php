<?php
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
?>
<?php  include('header.php');
include('config.php');
 ?>
 <!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" class="ltr" lang="en">
    <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Merabazaar</title>
        <link rel="stylesheet" href="">
       <script srzc="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="datepc/dcalendar.picker.js"></script>
<script>
$(document).ready(function(){
   $('#fdt').dcalendarpicker({format: 'dd-mm-yyyy'});
$('#tdt').dcalendarpicker({format: 'dd-mm-yyyy'});
});

</script>
    <!-- FONT -->

        <!-- FONT -->

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
<script>
/*function latestprods()
{

try
{
 
    $.ajax({
   type: 'POST',    
url:'Latest.php',
dataType: 'html',
success: function(data){
    alert(data);
//document.getElementById('latestslider').html(html);//=msg;
$("#latestslider").load("Latest.php");
         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
}catch(exc)
{
    alert(exc);
}
    
}
*/


/*function funonsale()
{
    alert("chjeck");
   $.ajax({
   type: 'POST',    
url:'onsale.php',
data :'',
success: function(data){
    alert(data);
document.getElementById('showsale').innerHTML=data;

         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });  
}*/





function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;

if (event.keyCode == 8 || event.keyCode == 46
 || event.keyCode == 37 || event.keyCode == 39) {
    return true;
}
else if ( key < 48 || key > 57 ) {
    return false;
}
else return true;
};

function updtfn(id,str,typ,num)
{

try
{
   // alert(id);
    var elid=str+num;
    var newid=document.getElementById(elid).value;
 //alert(newid);
 $.ajax({
   type: 'POST',    
url:'processupdatehomepagedetails.php',
data:'updid='+id+'&newid='+newid+'&str='+str+'&typ='+typ,
success: function(msg){
    alert(msg);
   
   if(msg==2)
   {
       
       alert("Error");
   }
   
window.location.reload();
         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
}catch(exc)
{
    alert(exc);
}
    
}

function delfun(id,typ,str)
{

try
{
   
   var confirmr=confirm("Are you sure you want to delete");
   
   if(confirmr)
   {
 $.ajax({
   type: 'POST',    
url:'processupdeletehomepagedetails.php',
data:'updid='+id+'&typ='+typ+'&str='+str,
success: function(msg){
  //  alert(msg);

if(msg==2)
   {
       
       alert("Error");
   }
   
window.location.reload();
   
         },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
     });
   }
}catch(exc)
{
    alert(exc);
}
    
}



</script>
<script>
</script>

<script>

var myVideos = [];
window.URL = window.URL || window.webkitURL;
function setFileInfo(files,id) {
myVideos.length=0;
  myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';
  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(this.src)
    var duration = video.duration;
    myVideos[myVideos.length-1].duration = duration;
    updateInfos(id);
  }
  video.src = URL.createObjectURL(files[0]);;
}

function updateInfos(id){

      document.querySelector('#durationv'+id).value=myVideos[0].duration;
    return false;
  }
  
  function checkduration(){
      try{
          
       var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
      
       if ((Date.parse(fdt) > Date.parse(tdt))) {
        alert("To date should be greater than From date");
        
       }else{
      
   
     var durarr=[];
		var fields3 = document.getElementsByName("durationv[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			durarr.push(fields3[i].value);
			}

     $.ajax({
            url: "check_duration.php",
            type: "POST",
            data:{tdt:tdt,fdt:fdt,durarr:durarr},    
            //contentType: false,
            //cache: false,
            //processData:false,
            success: function(text){
              
              
              
              if (text !=""){
                if(confirm(text + " Are you sure you want to continue ???")){
                    
                     submfunc();
                }
                
                else {
                    
                   return false;
                    
                }
              }
            },
    error: function (request, status, error) {
        alert(request.responseText);
        alert(error);
        
    }
        });
       }
      }catch(e){
          
          alert(e);
      }
       return false;
}
  
 function submfunc()
{
    try{
    var fdt= document.getElementById('fdt').value;
    var tdt= document.getElementById('tdt').value;
    
    
var namearr=[];


		var fields = document.getElementsByName("dname[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			namearr.push(fields[i].value);
			}

var descarr=[];
		var fields2 = document.getElementsByName("desc[]");
		for(var i = 0; i < fields2.length; i++) 
                   {
			descarr.push(fields2[i].value);
			}
var durarr=[];
		var fields3 = document.getElementsByName("durationv[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			durarr.push(fields3[i].value);
			}


//alert(id);
var fd=new FormData($('#formf')[0]);
  //fd.append('id',id);
for (var i = 0; i < namearr.length; i++) {
    fd.append('namearr[]', namearr[i]);
}
for (var i = 0; i < descarr.length; i++) {
    fd.append('descarr[]', descarr[i]);
}
for (var i = 0; i < durarr.length; i++) {
    fd.append('durarr[]', durarr[i]);

//alert(durarr[i]);
}
 fd.append('fdt', fdt);
 fd.append('tdt', tdt);


//alert("hrlloS");
$.ajax({
            url: "process_upload_adpg.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,
beforeSend:function() {
       
$("#Submit").attr("disabled", true);  
$("#shprogdiv").show();
$("#prog").val('0');

            },xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                if(myXhr.upload){
                    myXhr.upload.addEventListener('progress',progress, false);
                }
                return myXhr;
        },
 
             
            success: function(text){
	//alert("teststt");			  
       //  alert("chk"+text);
      //    alert(data.Error);


if(text==1)
{
alert("Ads Uploaded Successfully !!");
//location.reload();

window.open('adsapprovaldetails.php','_self');
}
else if(text==2)
{
alert("Please upload only mp4 files ");
}
 else if(text==3)
{
alert("Error in uploading video");
}
else if(text==5)
{
alert("sql error");

} 
else if(text==10)
{
alert("upload error");

} 
else if(text==50)
{
alert("Session has been expired");
window.open("logout.php");

} 


 $("#Submit").attr("disabled", false);  
 document.getElementById('Submit').innerHTML="Submit";             
           },
    error: function (request, status, error) {
        alert("chk7"+request.responseText);
        alert(error.responseText);
         alert("readyState: " + xhr.readyState);
   alert("responseText: "+ xhr.responseText);
    alert("status: " + xhr.status);
    alert("text status: " + textStatus);
    alert("error: " + err);
    }
        });
  
    }catch(ex){
        alert(ex);
    }
return false;
        
}
//}

function progress(e)
{
    try{

    if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;

        var Percentage = (current * 100)/max;
$("#prog").val(Percentage);
$("#shperc").val(Math.round(Percentage)+"% uploaded");


        if(Percentage >= 100)
        {
      
        }
    } 
    }catch(ex){
        alert(ex);
    }
 }


 
  

</script>

      </head>
  <body class="" >
      
      
      <form id="formf" method="POST" enctype="multipart/form-data" onsubmit="return checkduration();">
 <center>
     <div class="clear"></div>

<div id="content-outer">
 <div id="content">
     
     
     
     
     
     
     
     <table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
		
			<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
		
			<td> ADS Name*</td>
				<td><input type="hidden" id="durationv0" name="durationv[]" >
				<input type="text" placeholder="Enter Name..."  id="dname1" name="dname[]"  class="inp-form" required></td>
		</tr>
		<tr>
		
			<td>Description*</td>
				<td>	<input type="text" placeholder="Description"  id="desc1" name="desc[]"  class="inp-form" required ></td>
		</tr>
		
		<tr>
		
			<td>From date*</td>
				<td> <?php
                                    $mindt=date("Y-m-d", strtotime("+1 day"));
                                    ?>
				    	<input type="text" style="width:;" class="inp-form" data-mindate="<?php echo $mindt;?>"  id="fdt" /></td>
		</tr>
		<tr>
		
			<td>To Dtae*</td>
				<td>		<input type="text" style="width:;" class="inp-form"  id="tdt" data-mindate="<?php echo $mindt;?>" required/></td>
		</tr>
		<tr>
		
			<td>Video*</td>
				<td> <input type="file" id="img0" name="img[]" onchange="setFileInfo(this.files,'0')" ></td><td>
	<div class="bubble-left"></div>
	<div class="bubble-inner">Upload only mp4 videos and less then 5mb</div>
	<div class="bubble-right"></div>
	</td>
	
		</tr>
		
			<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit"  id="Submit" value="" class="form-submit"/>
			<input type="button"  id="Submit2" value="Check" class="form-submit" onclick="checkavilability();"/>
		</td>
		<td></td>
	</tr>
		</table>
	
<div id="shprogdiv" style="display:none;">
<progress id="prog" max="100" value="0" style="height:30px"></progress><br>
<input style="width:100px;" type="text" id="shperc" readonly/>
</div>
			
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>
     
     
     
     	
		       			
		       			
		       							</div>
		       							</div>
		       						


</center>
</form>
</body>
</html>