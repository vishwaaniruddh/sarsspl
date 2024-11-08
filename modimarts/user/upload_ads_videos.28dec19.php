<?php
ini_set('post_max_size', '200M');
ini_set('upload_max_filesize', '200M');
session_start();
	
/*Check whether the session variable SESS_MEMBER_ID is present or not*/
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>  
<?php 
/*ini_set( "display_errors", 0);   */ 
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
function booksecondsondt(rowid,dtts,seconds,month,year,blid,selid)
{
    document.getElementById("shd").innerHTML="Please Wait...";
        /*alert(rowid);
        alert(dtts);
        alert(seconds);
        alert(month);
        alert(year);*/
        //alert(blid);
        //document.getElementById("blid").disabled=true;
        var tymst=document.getElementById("tymst").value;
        $.ajax({
           type:"post",
           url:"../ads_book_entry.php",
           data:{dt:dtts,mnth:month,yr:year,dur:seconds,tymst:tymst,rowid:rowid,selid:selid},
           success:function(msg)
           {
                // alert(msg);
                var hjson=JSON.parse(msg);
                // alert(hjson[0]["sts"]);
                if(hjson[0]["sts"]=="10")
                {
                   alert("Session Expired Please Login Again");
                   window.open("index.php","_self");
                } else if(hjson[0]["sts"]=="1") {
                   //alert(hjson[0]["rws"]);
                   document.getElementById("dateslectedid"+rowid).value=hjson[0]["rws"];
                } else if(hjson[0]["sts"]=="20")
                {
                   alert("Already booked ");
                } else {
                   alert("Error try again later");
               }
               document.getElementById("tymst").value=hjson[0]["tymst"];
               getcalendar(rowid,month,year);
           }
        });
    }
    var videoscnt=1;
    function showavailfunc()
    {
        try
        {
            var adsnmarr=[];
            var adsnmarrindx=[];
            var tymst=document.getElementById("tymst").value;
            var nmr=document.getElementsByName("dname[]");
            for(var a=0;a<nmr.length;a++)
            {
                adsnmarr.push(nmr[a].value);
                var idd=nmr[a].id;
                var cnt=idd.replace( /[^\d.]/g, '' ).trim();
                adsnmarrindx.push(cnt);
            }
            //alert("ok");
            //alert(adsnmarr.length);
            if(adsnmarr.length>0)
            {
                //alert("o2");
                $.ajax({
                    type: 'POST',    
                    url:'../show_ads_details_summ.php',
                    data:{tymst:tymst,adsnmarr:adsnmarr,adsnmarrindx:adsnmarrindx},
                    error:function (jqXHR, exception) {
                    alert(jqXHR.status);
                },
                success: function(msg){
                   //alert(msg);
                   //availdets.length=0;
                   try
                   {
                    var availdets=JSON.parse(msg);
                   } catch(ex) {
                       alert(ex);
                   }
                    var strr='<table border="1" width="100%">';
                    strr=strr+'<th  style="text-align:center;background-color:grey;"><p style="font-size:16px; color:#FFF;">Date</p></th>';
                  
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Ad Name</p></th>';
                   
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Ad Duration</p></th>';
                   
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Number of times your Ad will be played</p></th>';
                
                
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Total seconds your Ad will be played </p></th>';
                
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Rate Per Second in paise</p></th>';
                
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Total paise</p></th>';
                    strr=strr+'<th class="table-header-repeat line-left minwidth-1" style="text-align:center"><p style="font-size:12px; color:#FFF;">Total Rs</p></th>';
                   
                   
                    //alert(availdets.length);
                    var totrs=0;
                    for(var a=0;a<availdets.length;a++)
                    {
                        strr=strr+"<tr>";
                        strr=strr+'<td align="center">'+availdets[a]["date"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["adname"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["adduration"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["tottymstoplay"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["totaldur"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["rate"]+'</td>';
                        strr=strr+'<td align="center">'+availdets[a]["totlrt"]+'</td>';
                        strr=strr+'<td align="right">'+availdets[a]["totrs"]+'</td>';
                       
                        totrs=Number(totrs)+Number(availdets[a]["totrs"]);
                        strr=strr+"</tr>";
                    }
                    strr=strr+"<tr>";
                    strr=strr+'<td align="right" colspan="7">Total Amount in Rupees</td>';
                    strr=strr+'<td align="right">Rs '+totrs+'</td>';
                    strr=strr+'<td ></td>';
                    strr=strr+"</tr>";
                    strr=strr+"</table>";
                    //alert(strr);
                    document.getElementById("shw").innerHTML=strr
                      
                    detsmod.style.display="block";
                    document.getElementById("subtndiv").style.display="block"; 
                  }
                });  
             }
        } catch(ex) {
            alert(ex);
        }
    }

function formatBytes(bytes){
  var kb = 1024;
  var ndx = Math.floor( Math.log(bytes) / Math.log(kb) ); 
  var fileSizeTypes = ["bytes", "kb", "mb", "gb", "tb", "pb", "eb", "zb", "yb"];

  return {
    size: +(bytes / kb / kb).toFixed(2),
    type: fileSizeTypes[ndx]
  };
}
var totuplodsize=100;  
var uploadedsize=0;
var myVideos = [];
window.URL = window.URL || window.webkitURL;
function setFileInfo(files,id) {
  //alert(uploadedsize);
    try
    {
        if(document.getElementById("sizeinmb"+id).value!="")
        {
            alert(document.getElementById("sizeinmb"+id).value);
            uploadedsize=Math.round(parseFloat(uploadedsize))-Math.round(parseFloat(document.getElementById("sizeinmb"+id).value));
        }
        //alert(uploadedsize);
        myVideos.length=0;
        if(files[0].type==="video/mp4" || files[0].type==="video/ogg" ||  files[0].type==="video/webm")
        {
            var _size=files[0].size;
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100);//+' '+fSExt[i];
            var fylsz=exactSize;
            //alert(fylsz);
            //alert(Math.round(uploadedsize));
            var nmchk=Math.round(parseFloat(uploadedsize))+Math.round(parseFloat(fylsz));   
            // alert(nmchk);
            if(Number(nmchk)<=Number(totuplodsize))
            {
                uploadedsize=nmchk;
                myVideos.push(files[0]);
                
                var video = document.createElement('video');
                video.preload = 'metadata';
                video.onloadedmetadata = function() {
                    window.URL.revokeObjectURL(this.src)
                    var duration = video.duration;
                    myVideos[myVideos.length-1].duration = duration;
                    updateInfos(id);
                }
              video.src = URL.createObjectURL(files[0]);
            } else {
                alert("Maximum 100mb allowed at a time");
                 document.querySelector('#img'+id).value="";
            } 
        } else {
            alert("Sorry this format is not supported");
            document.querySelector('#img'+id).value="";
        }
    } catch(ex) {
        alert(ex);
    }
}
function updateInfos(id) 
{
    var dr=0;
    var dr=String(myVideos[0].duration);
    var _size=myVideos[0].size;
         
    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
    i=0;while(_size>900){_size/=1024;i++;}
    var exactSize = (Math.round(_size*100)/100);//+' '+fSExt[i];
    var fylsz=exactSize;
         
    //alert(dr);
    var spl=dr.split('.'); 
    if(spl.length>0)
    {
       dr=Number(spl[0])+Number(1); 
    } else {
        dr=myVideos[0].duration;
    }
    document.querySelector('#durationv'+id).value=dr;
    document.querySelector('#sizeinmb'+id).value=fylsz; 
    return false;
}  
  $(document).ready(function()
  {
    try
    {
        $(".errlable").css("display", "none"); 
    } catch(ex) {
          alert(ex);
    }
  });
  function valfnc()
  {
        try
        {
          var vexs=0;
          var nm=document.getElementsByName("dname[]");
          
          var fl=document.getElementsByName("img[]");
          
          var dateslected=document.getElementsByName("dateslectedid[]");
          
          for(var a=0;a<nm.length;a++)
          {
              if(nm[a].value=="")
              {
                var idd=nm[a].id;
                var cnt=idd.replace( /[^\d.]/g, '' ).trim();

                document.getElementById("dnamelable"+cnt).style.display="block";
                  
                vexs++; 
              }
              if(fl[a].value=="")
              {
                var idd=fl[a].id;
                var cnt=idd.replace( /[^\d.]/g, '' ).trim();
                document.getElementById("imglable"+cnt).style.display="block";
                vexs++; 
              }
              
              if(dateslected[a].value=="" || dateslected[a].value=="0")
              {
                var idd=dateslected[a].id;
                var cnt=idd.replace( /[^\d.]/g, '' ).trim();
                document.getElementById("dtslable"+cnt).style.display="block";
                vexs++; 
              }
          }
          if(vexs==0)
          {
             return true;
          } else {
             return false;
          } 
        }catch(ex) {
            alert(ex);
        }
  }
  
  function submfunc2()
  {
     
  }
  function submfunc()
  {
    try{
         $(".errlable").css("display", "none"); 
        if(valfnc())
        {
            enabledisablefunc(1);
            var fd=new FormData($('#formf')[0]);
            var nms=document.getElementsByName("dname[]");
            for(var b=0;b<nms.length;b++)
            {
                var idd=nms[b].id;
                var cnt=idd.replace( /[^\d.]/g, '' ).trim();
                fd.append('cnts[]',cnt);
            }

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
                //alert(text);
                 var jss=JSON.parse(text);
                 if(jss["available"]=="0")
                 {
                    if(jss["errorsts"]=="0")
                    {
                        alert("Upload Successful");
                        window.location.reload(true);
                    }
                    else if(jss["errorsts"]=="10")
                    {
                      alert("Session Expired");
                      window.open("index.php","_self");
                    } else {
                        alert("Error");
                        enabledisablefunc(2);
                    } 
                } else {
                    alert("Sorry Slot not available");
                    showavailfunc();
                    enabledisablefunc(2);
                }
                
	    
    
},
    error: function (request, status, error) {
        alert("chk7"+request.responseText);
        alert(error.responseText);
        alert("readyState: " + xhr.readyState);
        alert("responseText: "+ xhr.responseText);
        alert("status: " + xhr.status);
        alert("text status: " + textStatus);
        alert("error: " + err);
        enabledisablefunc(2);
    }
});
    } else {
        alert("Rectify Validation Errors");
        detsmod.style.display="none";
    }
}catch(ex){
    alert(ex);
    enabledisablefunc(2);
}
return false;
}
//}
function enabledisablefunc(sts)
{
    if(sts=="1")
    {
      $("#subtndiv").hide();
      document.getElementById("clsbx").disabled=true;
    }else {
        document.getElementById("clsbx").disabled=false;
        $("#subtndiv").show();
        $("#shprogdiv").hide();
        $("#prog").val('0');
    }
}
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
    } catch(ex) {
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
        <input type="hidden" name="tymst" id="tymst">
        <!-- Start: page-top-outer --><!-- End: page-top-outer -->
	
        <div class="clear">&nbsp;</div>
        <div class="clear"></div>
        <!-- start content-outer ......................................START -->
        <div id="content-outer">
            <!-- start content -->
            <div id="content">
	            <!--  start page-heading -->
            	<div id="page-heading">
            		<h1></h1>
            	</div>
	            <div id="mn">
	                <!-- end page-heading -->
	                <div class="title-sitemap grid-12">
                        <h1 class="grid-10"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
                    </div>
                    <!--Ruchi : <div class="data grid-12">-->
                    <div class=" grid-12">
                        <!-- Simple Chart -->
                        <div class="grid-10">
                            <div class="widget">
                                <header class="widget-header">
                                    <div class="widget-header-icon">&#xf109;</div>
                                    <h3 class="widget-header-title"><strong>Upload Ads Videos</strong></h3>
                                </header>
                                <div class="widget-body">
                                    <div id="vdets" style="margin-left:5px;">
                                        <div id="dv0">
                                	      <table class="tables" align="center" width="100%">
                                             <tr>
                                			    <td>
                                			       ADS Name<font color="red">*</font>
                                			    </td>
                                				 <td>
                                				  <input type="text" placeholder="Enter Name..."   id="dname0" name="dname[]"   class="form form-full"  required>
                                				  <lable class='errlable' id='dnamelable0' style='display:none;'><font color='red' size='1'>Name is Mandatory</font></lable>
                                				 </td>
                                			  </tr>
                                              <tr> 
                                               <td>Select File<font color="red">*</font></td>
                                               <td>
                                                 <input type="file" id="img0"  class="form form-full"  name="img[]" onchange="setFileInfo(this.files,'0')" ></br>
                                                 <lable class='errlable' id='imglable0' style='display:none;'><font color='red' size='1'>Select File</font></lable>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Duration </td>
                                                <td>
                                                  <input type="text" style="width:40%" id="durationv0"  class="form form-full"  name="durationv[]" readonly>
                                                  <input type="hidden" style="width:40%" id="sizeinmb0"  class="form form-full"  name="sizeinmb[]" readonly>
                                                </td>
                                            </tr>
                                            <tr>              
                                                <td>Description</td>
                                				<td>
                                				    <input type="text" placeholder="Description"  id="desc0" name="desc[]"   class="form form-full"  required >
                                				</td>
                                			</tr>
                                			<tr>
                                				<td></td>
                            				    <td>
                            				        <input type="button"  class="btn btn-error"  id="dated0" name="dated[]"  onclick='selctdtfunc(0,"","");' value="Select Date">
                            				        <input type="hidden"  class="btn btn-error"  id="dateslectedid0" name="dateslectedid[]"  class="inp-form" value="0">
                            				        <lable class='errlable'  id='dtslable0' style='display:none;'><font color='red' size='1'>Select Dates</font></lable>
                            				    </td>
                                                <td>
                                                    <button type="button"  class="btn btn-error" id="remv0" name="remv0" onclick="remfunc(0);">X</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="button" class="btn btn-submit"name="addmore" value="Add More Ads" onclick="addmorefunc();"/>
                                                    <input type="button" class="btn btn-error" name="search" value="Show Details" onclick="showavailfunc();"/>
                                                </td>
                                            </tr>
                                	        </table>
	                                    </div>
	                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="uploaddiv">
            <center>
        	    <table border="0" cellpadding="0" cellspacing="0"  id="id-form">
        		    <tr>
        		        <th>&nbsp;</th>
        		        <td valign="top"></td>
        		        <td></td>
        	       </tr>
        		</table>
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
<style>
.uommod {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-contentuom{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 90%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
.modeldets{
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-contendets{
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 90%;
    height:75%;
}
</style>
<div id="myModal" class="uommod">
  <!-- Modal content -->
  <div class="modal-contentuom" >
    <button type="button" id="clsb" class="close">X</button>
    <div id="shd">
        <?php//  include 'cal.php'; ?>
    </div>
</div>
</div>
<div id="myModaldets" class="modeldets">
<!-- Modal content -->
<center>
  <div class="modal-contendets" >
    <!--<c>-->
        <button type="button" id="clsbx" class="close">X</button>
        <div id="shw">
            <?php  // include 'cal.php'; ?>
        </div>
    </br>
<div class="row" id="subtndiv">
    <div class="col-md-5"></div>
    <div class="col-md-2" >
        <input type="button"  id="Submit"  value="Submit" class="form-submit"  style="width:80px"  onclick="submfunc();"/>
        </div>
    <div class="col-md-5"></div>
</div>
<div id="shprogdiv" style="display:none;">
    <div class="col-md-5"></div>
    <div class="col-md-2" >
        <progress id="prog" max="100" value="0" style="height:30px"></progress><br>
        <input style="width:100px;" type="text" id="shperc" readonly/>
    </div>
    <div class="col-md-5"></div>
</div>
</div>
</center>
</div>
<script>
var uomfmod = document.getElementById("myModal");
var detsmod = document.getElementById("myModaldets");

var uomclosbtn = document.getElementById("clsb");
var divdetsclsbtn = document.getElementById("clsbx");

uomclosbtn.onclick = function () {
    uomfmod.style.display = "none";
}

divdetsclsbtn.onclick = function () {
    detsmod.style.display = "none";
}
function chkfunc()
{
    alert("ok");
}
 function selctdtfunc(rowid,month,year)
 {
    //alert(month);
    var dur=document.getElementById("durationv"+rowid).value;
    if(document.getElementById("dname"+rowid).value==""){
        alert("Enter Ads Name");
        document.getElementById("dname"+rowid).focus();
    } else if(dur=="") {
      alert("Select Ad to upload");
    } else {
        getcalendar(rowid,month,year);
    }
}
function getcalendar(rowid,month,year) 
{
    try
    {
        document.getElementById("shd").innerHTML="Please Wait..";
        var dur=document.getElementById("durationv"+rowid).value;
        var tymst=document.getElementById("tymst").value;
        $.ajax({
            type:"post",
            url:"../adminpanel/cal.php",
            data:{dur:dur,rowid:rowid,month:month,year:year,tymst:tymst},
            success:function(data)
            {
              document.getElementById("shd").innerHTML=data;
              $('<link href="calendarcodes/mycal/calendar.css" rel="stylesheet" />').appendTo("head");
            }
         });
    uomfmod.style.display = "block";
    } catch(ex) {
        alert(ex);
    }
}
function remfunc(rowid)
{
    try
    {
        var tymst=document.getElementById("tymst").value;
        $.ajax({
           type:"post",
           url:"../remvadsfromv.php",
           async:false,
           data:{rowid:rowid,tymstmp:tymst},
           success:function(data)
           {
             //alert(data);
               if(data=="1")
               {
                    remove("dv"+rowid);
               } else {
                    alert("Error"); 
               }
           }
        });
    } catch(ex) {
        alert(ex);
    }
}
function remove(id) {
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}
</script>
<!-- end footer -->
</form>
</body>
</html>