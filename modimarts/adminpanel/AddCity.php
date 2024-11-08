<?php
session_start();
	include('config.php');
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}
 include('header.php'); ?>
<!-- start content-outer -->


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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
var booldata="";
            function addcity1(){
               var cname=document.getElementById("cname").value;
               var code=document.getElementById("code").value;
               //alert(code);
          
             if(cname!=""){
             
                $.ajax({
                    
                    type:'POST',
                    url:'checkcity1.php',
                    async:false,
                     data:'cname='+cname+'&code='+code,
                //data:'code='+code+'&cname='+cname,

                    success:function(msg){
                        //alert(msg);
                       if(msg=="1")
                       {
                           alert("city already exist");
                           booldata= false;
                       }
                        else
                       {
                            booldata= true;
                       }
                       
                       
                    }
                })}
                else
                {
                    alert("please Enter city name ");
                booldata= false;
                }
                return booldata;
            }
        </script>
        
        <script>
        var booldat="";
            function key1(){
               var cname=document.getElementById("cname").value;
               var code=document.getElementById("code").value;
               var add1=document.getElementById("add1").value;
              // alert(code);
          //alert("hello")
             if(add1!=""){
            
                $.ajax({
                    
                    type:'POST',
                    url:'checkkey1.php',
                    data:'add1='+add1+'&code='+code+'&cname='+cname,
                    
                    success:function(msg){
                        //alert(msg);
                      
                       if(msg=="1")
                       {
                           alert("key already exist");
                           booldat= false;
                       }
                       else
                       {
                            booldat= true;
                       }
                      // alert("ram"+booldat)
                    }
                })}
                else{
                    alert("please Enter key ");
                    booldat= false;
                }
                return booldat;
            }
            
            function both(){
    if(addcity1() && key1())
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
            function key(){
               var cname=document.getElementById("cname").value;
               var code=document.getElementById("code").value;
               var add1=document.getElementById("add1").value;
               //alert(code);
          //alert("hello")

                $.ajax({
                    
                    type:'POST',
                    url:'checkcity1.php',
                    //data:'add1='+add1+'&code='+code+'&cname='+cname,
                    
                    success:function(msg){
                        alert(msg);
                      
                       
                    }
                })
                
            }
        </script>
        
        <script>
            function bid(){
                addcity1();
                key1();
                
                
             //  alert("hello");
                var cname=document.getElementById("cname").value;
               var code=document.getElementById("code").value;
               var add1=document.getElementById("add1").value;
              
             // alert(id);
                $.ajax({
                    
                    type:'POST',
                    url:'processAddCity.php',
                     data:'add1='+add1+'&code='+code+'&cname='+cname,
                    success:function(msg){
                        //alert(msg);
                         if(msg=="1")
                       {
                           window.open("cities.php","_self");
                       }

                    }
                })
                
            }
        </script>

<script>
function cancel()
{
window.open("cities.php","_SELF");
}
</script>

<div id="content-outer" align="center">
<!-- start content -->
<div id="content">


<div id="page-heading" align="center">
  <h1>Add City</h1></div>


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
<form action="processAddCity.php"  method="post" onsubmit="return both()">

<table width="50%" style=" background:linear-gradient(to bottom, #99ccff 0%, #6699ff 100%);"  border="0" id="id-form">
<br>
<tr height="40"  >

<td width="30%"  align="center">State Name</td>

<td width="70%"  ><select name="code" id="code" class="inp-form" >
<?php 
$stt=mysql_query("SELECT * FROM `states`");
echo mysql_error();
while($sttf=mysql_fetch_array($stt))
{
?>
<option value="<?php echo $sttf[0]; ?>"><?php echo $sttf[1]; ?></option>

<?php } ?>
</select>

</td></tr>



<tr height="30">

<td align="center" >City Name</td>

<td><input name="cname" id="cname" size="50" type="text" class="inp-form"  required  /></td></tr>

<tr height="30">

<td height="30" align="center">Keywords</td>

<td><input name="add1" id="add1" size="50" type="text"  class="inp-form" required  /></td></tr>


<tr>
<td  align="center"><input class="button" type="Submit" value="Save" /></td>
<!--<td  align="center"><button class="button" onclick="bid();" type="button">save</button></td>-->
<td  align="center"><button class="button" onclick="cancel();"; type="button">Cancel</button></td>
</tr>

</table></form>
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
 