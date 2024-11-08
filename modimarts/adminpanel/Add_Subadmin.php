<?php
session_start();
	include('config.php');
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
 include('header.php');?>
<!-- start content-outer -->
<html>
    <head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="multiSelectDropdown.css">

 <style>
.multiselect {
    width:20em;
   
    height: 5px;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
}
.ms-options-wrap > button > span {
    display: inline-block;
}

.ms-options-wrap > .ms-options {
    position: absolute;
    left: 300;
    width: 20%;
    margin-top: 1px;
    margin-bottom: 20px;
    background: white;
    color:#000;
    z-index: 2000;
    border: 1px solid #aaa;
    overflow: auto;
    visibility: hidden;
     height: 50px;
}

</style>


<style>
.button {
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




.label {
    display: inline-block;
    font-size: 100%;
    font-weight: normal;
    line-height: 4px !important;
    color: #000;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
     height: 15px;
    width: 64px;
   padding:-30px;
}


</style>
<script>
 
  function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31
              && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
</script>
<script>
    function id1(){
       var emailid=document.getElementById("emailid").value;
         if(emailid!=""){
            $.ajax({
                type:'POST',
                url:'checkemail2.php',
                 data:'emailid='+emailid,
                success:function(msg){
                   if(msg=="1")
                   {
                       alert("email already exist");
                   }
                }
            })}
        else(alert("please Enter Email-ID "));
    }
</script>
<script>
    function validation(){
        var drop=document.getElementById("drop").value;
        var subname = document.getElementById("subname").value;
    	var mobile = document.getElementById("mobile").value;
    	var pass = document.getElementById("pass").value;
    	var emailid = document.getElementById("emailid").value;
    	var emailFilter =  /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
    	if (subname == "")
    	{
    	    alert("sub admin name can not be empty");
    		return false;
    	}
    	else if (mobile == "")
    	{
    		alert("mobile can not be empty");
    		return false;
    	}
    	else if ( pass == "")
    	{
    		alert(" password can not to be empty");
    		return false;
    	}
    	else if ( emailid == "")
    	{
    		alert(" please fill email id ");
    		return false;
    	}
    	else if (!emailFilter.test(emailid))
    	{
    		alert("invalid email ")
    		return false;
    	}else{
    	    return true;
    	}
    }
</script>
</head>
<body>
<div id="content-outer" align="center">
<!-- start content -->
<div id="content">
    <div id="page-heading" align="center">
      <h1>Create Sub Admin </h1>
    </div>
    <table border="0" width="50%" style=" background:linear-gradient(to bottom, #99ccff 0%, #6699ff 100%);"  cellpadding="0" cellspacing="0" id="content-table">
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
            	<!--  start content-table-inner -->
            	<div id="content-table-inner" style="padding-left:300px;" >
	                <table border="0" width="100%"    cellpadding="0" cellspacing="0">
                    	<tr valign="top">
                    	    <td>
                                <form name="myForm" action="Add_subAdmin_process.php"  method="post" onsubmit="return validation()">
                                    <table width="50%" style=" b<ackground:linear-gradient(to bottom, #99ccff 0%, #6699ff 100%);"  border="0" id="id-form"><br>
                                        <tr height="30">
                                            <td align="center" >Roll</td>
                                                <td> 
                                                    <select size="1" name="newroll"  id="newroll"  style="width: 200px;height:28px"required>
                                                        <option value="">select</option>
                                                        <?php 
                                                        $qrcustnm="select * from roll";
                                                        $fcustname=mysql_query($qrcustnm) ;
                                                        while($rw=mysql_fetch_array($fcustname))
                                                        { ?>
                                                        <option value="<?php echo $rw[0]; ?>"><?php echo $rw[1]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <!--
                                                    <select size="5" name="lstStates" multiple="multiple" id="lstStates" onchange="per() " required>
            
                                                    <optgroup label="Merchant">
                                                       <optgroup label=" ">
                                                       <option value="1">Add Merchant</option>
                                                       <option value="2">View Merchant</option>
                                                       <option value="3">Merchant Report</option>
                                                       </optgroup>
                                                    </optgroup>
                                                  
                                                    <optgroup label="Admin Products">
                                                        </optgroup>
                                                        <optgroup label="Homepage Display Ads">
                                                        <option value="4">Homepage Display Ads</option>
                                                    </optgroup>
                                                       
                                                    <optgroup label="Visual Advertisement">
                                                        <option value="5">Upload Ads</option>
                                                        <option value="6">View Ads</option>
                                                        <option value="7">ads slot booking</option>
                                                        <option value="8">set todays date for ads</option>
                                                    </optgroup>
                                                 
                                                    <optgroup label="Reports">
                                                        <option value="9">products uploaded</option>
                                                        <option value="10">Homepage Display Ads</option>
                                                   </optgroup>
                                                 
                                                  
                                                    <optgroup label="Merchant Products">
                                                        <optgroup label=" ">
                                                        <option value="11">Products Approval</option>
                                                        </optgroup>
                                                    </optgroup>
                                                  
                                                  
                                                    <optgroup label="Parameters">
                                                        <optgroup label=" ">
                                                        <option value="12">Rate per second </option>
                                                        </optgroup >
                                                    </optgroup>
                                                  
                                                  
                                                    <optgroup label="Area"></optgroup>
                                                        <optgroup label="Cities">
                                                        <option value="13">Add Cities</option>
                                                        <option value="14">View Cities</option>
                                                    </optgroup>
                                                       
                                                    <optgroup label="Areas">
                                                        <option value="15">Add Areas</option>
                                                        <option value="16">View Areas</option>
                                                    </optgroup>
                                                 
                                                 
                                                    <optgroup label="Category">
                                                        <optgroup label=" ">
                                                        <option value="17">Add Category</option>
                                                        <option value="18">View Category</option>
                                                        </optgroup>
                                                    </optgroup>
                                                  
                                                    <optgroup label="Orders">
                                                        <optgroup label=" ">
                                                        <option value="19">Order Details</option>
                                                        </optgroup>
                                                    </optgroup>
                                                  
                                                  
                                                    <optgroup label="Sub Admin">
                                                        <optgroup label=" ">
                                                        <option value="20">Add Sub Admin</option>
                                                        </optgroup>
                                                    </optgroup>
                                                </select>
                                                -->
                                            </td>
                                        </tr>
                                        <tr height="40"  >
                                            <td width="30%"  align="center">Sub Admin Name</td>
                                            <td width="70%" > <input type="text" name="subname" id="subname" size="50"  class="inp-form"   /> </td>
                                        </tr>
                                        <tr height="30">
                                            <td align="center" >Mobile No.</td>
                                            <td><input name="mobile" id="mobile" size="50" type="text" class="inp-form"  onkeypress="return isNumberKey(event)" maxlength="10" /></td>
                                        </tr>
                                        <tr height="30">
                                           <td height="30" align="center">Email</td>
                                           <td><input type="text" name="emailid" id="emailid" size="50"  class="inp-form"  onblur="id1()" /></td>
                                        </tr>
                                        
                                        <tr height="30">
                                           <td height="30" align="center">Password</td>
                                           <td><input name="pass" id="pass" size="50" type="Password" value=""  class="inp-form"   />
                                           <input name="drop" id="drop" size="50" type="hidden" value=""  class="inp-form" required  />
                                           </td>
                                        </tr>
                                        <tr>
                                            <td  align="center"><input class="button" type="Submit" value="Save" /></td>
                                        </tr>
                                    </table>
                                </form>
                                <!-- end id-form  -->
	                        </td>
	                        <td>
	                            <!--  start related-activities --><!-- end related-activities -->
                            </td>
                        </tr>
                        <tr>
                            <td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
                            <td></td>
                        </tr>
                    </table>
                    <div class="clear"></div>
                </div>
                <!--  end content-table-inner  -->
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
    <!--  end content -->
    <div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->
<div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left 
	<div id="footer-left">
	Admin Skin &copy; Copyright Internet Dreams Ltd. <a href="">www.netdreams.co.uk</a>. All rights reserved.</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://rawgit.com/nobleclem/jQuery-MultiSelect/master/jquery.multiselect.js"></script>
 <script>
 function per(){
   var obj = myForm.lstStates,
        options = obj.options, 
        selected = [], i, str;
    for (i = 0; i < options.length; i++) {
        options[i].selected && selected.push(obj[i].value);
    }
    str = selected.join();
    // what should I write here??
   // alert("Options selected are " + str);
    document.getElementById("drop").value=str;
 }
    $(function () {
        $('#lstStates').multiselect({
        buttonText: function(options){
          if (options.length === 0) {
              return 'No option selected ...';
           }
           var labels = [];
           options.each(function() {
               if ($(this).attr('value') !== undefined) {
                   labels.push($(this).attr('value'));
               } 
            });
             return labels.join(', ');  
            alert(labels.join(', '));
         }
    }); 
});
</script>
</body>
</html>

