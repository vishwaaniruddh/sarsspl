<?php
ini_set('post_max_size', '40M');
ini_set('upload_max_filesize', '30M');
session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>
<?php 
//	ini_set( "display_errors", 0);

include('config.php');

include('header.php'); 

	
?>

<style>
/*---Paging specific styling----*/     
	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}
	.paging.display{text-align:right;}
	.paging a, .paging span {padding:2px 8px 2px 8px; font-weight :normal}
	.paging span {font-weight:bold; color:#000; font-size:13px; }
	.paging a, .paging a:visited {color:#000; text-decoration:none; border:1px solid #dddddd;}
	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}
	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }
	.paging a.prn, .paging a.prn:visited { border:2px solid #dddddd;}
	.paging a.prn:hover { border-color:#000;}
	.paging p#total_count{color:#aaa; font-size:12px; font-weight: normal; padding-left:18px;}
	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}
</style>
<script>

var videoscnt=1;
 var availdets=[];
function showavailfunc()
{
    try
    {
     
     
        
   $.ajax({
   type: 'POST',    
   url:'show_availability_for_ads.php',
   data:$('#formf').serialize(),

   success: function(msg){
    
    
  // alert(msg);
   availdets.length=0;
  availdets=JSON.parse(msg);
   var strr='<table border="1">';
   /*
   strr=strr+'<tr><th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Date</p></th><th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Slots Available</p>	</th><th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Status</p>	</th>
				
				</tr>';*/
				
   strr=strr+'<tr><th  style="text-align:center"><p style="font-size:16px; color:#FFF;">Date</p></th>';
   strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Total Available Seconds</p></th>';
     strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Total Seconds Of your Ad</p></th>';
   
   strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Number of times your Ad will be played</p></th>';


strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Total seconds your Ad will be played </p></th>';
 strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Rate Per Second</p></th>';

   strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Total</p></th>';
    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:16px; color:#FFF;">Status</p></th>';
   strr=strr+'</tr>';
   
   var availdts=availdets["dtsavail"];
   
   
   var notavaildts=availdets["dtsnotavail"];
   
   
   for(var a=0;a<availdets["alldts"].length;a++)
   {
       strr=strr+"<tr>";
       strr=strr+'<td>'+availdets["alldts"][a]+'</td>';
       
       if(availdts.indexOf(availdets["alldts"][a])!="-1")
       {
           
           var indx=availdts.indexOf(availdets["alldts"][a]);
       
           strr=strr+'<td align="center">'+availdets["dtsavailtym"][indx]+' Seconds</td>';
           
           strr=strr+'<td align="center">'+availdets["duration"]+' seconds</td>';
           
           strr=strr+'<td align="center">'+availdets["tyms"]+'</td>';
           strr=strr+'<td align="center">'+availdets["dureacharr"][indx]+'</td>';
            strr=strr+'<td align="center">'+availdets["rated"][indx]+'</td>';
          
           strr=strr+'<td align="center">'+availdets["totarr"][indx]+'</td>';
           
           strr=strr+'<td align="center">Available</td>';
       
       }
       else
       {
            strr=strr+'<td align="center">0</td>';
           strr=strr+'<td align="center">0</td>';
            strr=strr+'<td align="center">0</td>';
           strr=strr+'<td align="center"></td>';
            strr=strr+'<td align="center">0</td>';
           strr=strr+'<td align="center"></td>';
           
            strr=strr+'<td>Unavailable</td>';
           
       }
       
      
   }
   strr=strr+"<tr>";
   strr=strr+'<td align="center" colspan="6">Total Amount</td>';
   strr=strr+'<td align="center">'+availdets["totamt"]+'</td>';
   strr=strr+'<td ></td>';
   
   strr=strr+"</tr>";
   
   strr=strr+"</table>";
   
  // alert(strr);
   
   document.getElementById("shw").innerHTML=strr
      
  document.getElementById("Submit").style.display="block";   
  }
         
     });  
   
        
    }
    catch(ex)
    {
        
        alert(ex);
    }
    
}

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


var dr=0;
var dr=String(myVideos[0].duration);
//alert(dr);
 var spl=dr.split('.');
if(spl.length>0)
{
   
   dr=Number(spl[0])+Number(1); 
}else
{
    
    dr=myVideos[0].duration;
}
      document.querySelector('#durationv'+id).value=dr;
    return false;
  }
  
  
  function submfunc()
{
    try{
    var fdt= document.getElementById('rdate').value;
    var tdt= document.getElementById('tdate').value;
    
    

	
//alert(id);
var fd=new FormData($('#formf')[0]);
  //fd.append('id',id);
  
  
  
for (var i = 0; i < availdets["dtsavail"].length; i++) {
    fd.append('availdtsarr[]', availdets["dtsavail"][i]);
    fd.append('rate[]', availdets["rated"][i]);
    fd.append('totarr[]', availdets["totarr"][i]);
    fd.append('dureacharr[]', availdets["dureacharr"][i]);
}
/*fd.append('fdt', fdt);
fd.append('tdt', tdt);
fd.append('duration', duration);
fd.append('name', name);
fd.append('desc', desc);
fd.append('tyms', tyms);*/


//alert("hrlloS");
$.ajax({
            url: "../process_upload_adpg.php",
            type: "POST",
            data:fd,    
            contentType: false,
            cache: false,
            processData:false,
beforeSend:function() {
       
//$("#Submit").attr("disabled", true);  
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
                
               // alert(text);
                
                 var jss=JSON.parse(text);
                 if(jss["available"]=="0")
                 {
                 if(jss["errorsts"]=="0")
                 {
                     
                     
                     alert("Upload Successful");
                     
                     window.location.reload(true);
                 }else
                 {
                     
                     alert("Error");
                     
                 }
                 }else
                 {
                     alert("Sorry Slot not available");
                     showavailfunc();
                     
                 }
                
	//alert("teststt");			  
       //  alert("chk"+text);
      //    alert(data.Error);

//alert(text);
/*if(text==1)
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
*/

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

function addmorefunc()
{
    
    $.ajax({
        url:"../addmoreadsphtmlpg.php",
        type:"POST",
       data:{videoscnt:videoscnt},
        beforeSend:function(){
            
            
        },
          success: function(text){
               // alert(text);
                
                var div = document.getElementById('vdets');

//div.innerHTML += text;
                $('#vdets').append(text);
                videoscnt=Number(videoscnt)+Number(1);
          }
                
        });
    
}
 
 
 
  
</script>
<body> 
 <form id="formf" method="POST" enctype="multipart/form-data" onsubmit="return submfunc();">
 
 
<!-- Start: page-top-outer --><!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
<div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<h1></h1>
	</div>
	
	<div id="mn">
	<!-- end page-heading -->
	<center>
	    
	    <div>
	        	<table align="center" width="50%">
	        	    <tr>
	        	        <td>From Date</td>
	        	        <td><input type="text" name="rdate" id="rdate"  class="inp-form" placeholder="from date"/></td>
	        	        <td> To Date</td>
	        	        <td><input type="text" name="tdate" id="tdate"  class="inp-form" placeholder="to date"/></td>
	      
	        </tr>
	        </table>
	        </div>
	        </br>
</br>

<div id="vdets">
    
    
    <div id="dv0">
	<table align="center" width="90%">
  
             <tr>
                 
			<td> ADS Name*</td>
				<td>
				<input type="text" placeholder="Enter Name..."  id="dname0" name="dname[]"  class="inp-form" required></td>
                 
             <td>Select File</td><td>
                 <input type="file" id="img0"  class="inp-form" name="img[]" onchange="setFileInfo(this.files,'0')" >
                
                 
                 
                 
                 </td>
                 
                 <td>
                     
                     Duration
                      <input type="text" id="durationv0" class="inp-form" name="durationv[]" readonly>
                     </td>
                 
                 <td>Description*</td>
				<td>	<input type="text" placeholder="Description"  id="desc0" name="desc[]"  class="inp-form" required ></td>
                 
                 </tr>
                 <tr>
                    
	<td></td></tr>

	</table>
	</div>
	
	
	
	</div>
</br>
</br>
</br>
 <link rel="stylesheet" href="newdatepicker/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  
  /*
  var dates = new Array();

function addDate(date) {
    if (jQuery.inArray(date, dates) < 0) 
        dates.push(date);
}

function removeDate(index) {
    dates.splice(index, 1);
}

// Adds a date if we don't have it yet, else remove it
function addOrRemoveDate(date) {
    var index = jQuery.inArray(date, dates);
    if (index >= 0) 
        removeDate(index);
    else 
        addDate(date);
}

// Takes a 1-digit number and inserts a zero before it
function padNumber(number) {
    var ret = new String(number);
    if (ret.length == 1) 
        ret = "0" + ret;
    return ret;
}

jQuery(function () {
    jQuery("#rdate").datepicker({
        onSelect: function (dateText, inst) {
            addOrRemoveDate(dateText);
        },
        beforeShowDay: function (date) {
            var year = date.getFullYear();
            // months and days are inserted into the array in the form, e.g "01/01/2009", but here the format is "1/1/2009"
            var month = padNumber(date.getMonth() + 1);
            var day = padNumber(date.getDate());
            // This depends on the datepicker's date format
            var dateString = month + "/" + day + "/" + year;

            var gotDate = jQuery.inArray(dateString, dates);
            if (gotDate >= 0) {
                // Enable date so it can be deselected. Set style to be highlighted
                return [true, "ui-state-highlight"];
            }
            // Dates not in the array are left enabled, but with no extra style
            return [true, ""];
        }
    });
});
*/
jQuery(function () {

$('#rdate').datepicker({
    changeMonth: true,
    changeYear: true,
    minDate: 0,
    //The calendar is recreated OnSelect for inline calendar
    onSelect: function (date, dp) {
        updateDatePickerCells();
    },
    onChangeMonthYear: function(month, year, dp) {
        updateDatePickerCells();
    },
    beforeShow: function(elem, dp) { //This is for non-inline datepicker
        updateDatePickerCells();
    }
});
});

/*
updateDatePickerCells();
function updateDatePickerCells(dp) {
    /* Wait until current callstack is finished so the datepicker
       is fully rendered before attempting to modify contents */
    setTimeout(function () {
        //Fill this with the data you want to insert (I use and AJAX request).  Key is day of month
        //NOTE* watch out for CSS special characters in the value
        var cellContents = {1: '20', 15: '60', 28: '$99.99'};

        //Select disabled days (span) for proper indexing but // apply the rule only to enabled days(a)
        $('.ui-datepicker td > *').each(function (idx, elem) {
            var value = cellContents[idx + 1] || 0;

            // dynamically create a css rule to add the contents //with the :after                         
  //             selector so we don't break the datepicker //functionality 
            var className = 'datepicker-content-' + CryptoJS.MD5(value).toString();

            if(value == 0)
                addCSSRule('.ui-datepicker td a.' + className + ':after {content: "\\a0";}'); //&nbsp;
            else
                addCSSRule('.ui-datepicker td a.' + className + ':after {content: "' + value + '";}');

            $(this).addClass(className);
        });
    }, 0);
}

var dynamicCSSRules = [];
function addCSSRule(rule) {
    if ($.inArray(rule, dynamicCSSRules) == -1) {
        $('head').append('<style>' + rule + '</style>');
        dynamicCSSRules.push(rule);
    }
*/
  </script>

<script>


//$('#rdate').dcalendarpicker({format: 'dd-mm-yyyy', range: 'multiple'});
/*$("#rdate").dcalendarpicker({
                        dateFormat: "@", // Unix timestamp
                        onSelect: function(dateText, inst){
                            addOrRemoveDate(dateText);
                        },
                        beforeShowDay: function(date){
                            var gotDate = $.inArray($.datepicker.formatDate($(this).datepicker('option', 'dateFormat'), date), dates);
                            if (gotDate >= 0) {
                                return [false,"ui-state-highlight", "Event Name"];
                            }
                            return [true, ""];
                        }
                    });    */
$('#tdate').dcalendarpicker({format: 'dd-mm-yyyy'});
</script>

<input type="button" class="btn" name="addmore" value="Add More Ads" onclick="addmorefunc();"/>

<input type="button" class="btn" name="search" value="Show Availability details" onclick="showavailfunc();"/>

	</center>
</div>
</br></br>

<center>
<div id="shw">
    
    
    
    </div>
</center>
 <div id="uploaddiv">
<center>
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

			<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="submit"  id="Submit" style="display:none;" value="" class="form-submit"/>
		
		</td>
		<td></td>
	</tr>
		</table>


<div id="shprogdiv" style="display:none;">
<progress id="prog" max="100" value="0" style="height:30px"></progress><br>
<input style="width:100px;" type="text" id="shperc" readonly/>
</div>


</div>
</div>


	<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 </form>
</body>
</html>