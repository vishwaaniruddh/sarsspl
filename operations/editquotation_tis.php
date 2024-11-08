<?php

include("access.php");
include("config.php");	


session_start();
//include("access.php");
if(!$_SESSION['user'])
{
?>
<script type="text/javascript">
alert("Sorry Your session has Expired");
window.location="index.php";
</script>
<?php
}




$qid=$_GET['qid'];
$qoid=$_GET['qoid'];
$sts=$_GET['strdt'];
$ends=$_GET['endt'];
$atms=$_GET['atm'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>


<script>
function getbank(val)
{
	//alert(val);







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
		
            //alert(xmlhttp.responseText);
            document.getElementById('bank').innerHTML='';
	    document.getElementById('bank').innerHTML=xmlhttp.responseText;
	
	
	    
	
          }
       }
       xmlhttp.open("GET","getbank.php?val="+val,true);
       xmlhttp.send();
      
	
}
function submitpart()
{

var quotid=document.getElementById('qotid1').value;

var partic=[];
		var fields = document.getElementsByName("part[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			partic.push(fields[i].value);
			}
var stxx=[];
		var stxx1= document.getElementsByName("stx[]");
		for(var i = 0; i < stxx1.length; i++) 
                   {
			stxx.push(stxx1[i].value);
			}
//alert(stxx);


var partyp=[];
		var fields1 = document.getElementsByName("pr[]");
		for(var i = 0; i < fields1.length; i++) 
                   {
			partyp.push(fields1[i].value);
			}


var partqty=[];
		var fields2 = document.getElementsByName("prc[]");
		for(var i = 0; i < fields2.length; i++) 
                   {
			partqty.push(fields2[i].value);
			}

var partrate=[];
		var fields3 = document.getElementsByName("rate[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			partrate.push(fields3[i].value);
			}



var partamt=[];
		var fields4 = document.getElementsByName("amt[]");
		for(var i = 0; i < fields4.length; i++) 
                   {
			partamt.push(fields4[i].value);
			}




var tcodearr=[];
		var fields5 = document.getElementsByName("tcode[]");
		for(var i = 0; i < fields5.length; i++) 
                   {
			tcodearr.push(fields5[i].value);
			}

var uom=[];
		var fields6 = document.getElementsByName("descdet[]");
		for(var i = 0; i < fields6.length; i++) 
                   {
			uom.push(fields6[i].value);
		}

var conf=confirm('Do you really want to submit the record?');
    
 

if(conf==true)
{


$.ajax({
            type: "POST",
            url: "addpart_toquot_tis.php",
    
            data: {partic:partic,partyp:partyp,partqty:partqty,partrate:partrate,partamt:partamt,quotid:quotid,tcode:tcodearr,uom:uom,stxx:stxx},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(msg){
               
                 
                alert(msg);
                window.open('editquotation_tis.php?qid='+quotid,'_self');
               
                
            }
        });

}







}



function calc(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var rt=document.getElementById(id).value;
var qt=document.getElementById('prc'+count).value;
if(rt!="" && qt!="")
{
var tamt=parseFloat(rt)*parseFloat(qt);
//vat price=parseFloat(tamt).toFixed(2);
//alert(parseFloat(tamt).toFixed(2));

document.getElementById('amt'+count).value=parseFloat(tamt).toFixed(2);


var totalamt=[];
		var fields = document.getElementsByName("amt1[]");
		for(var i = 0; i < fields.length; i++) 
                   {
                       
			totalamt.push(fields[i].value);
		
                 }


var gtotal = 0;
	for (i=0; i<totalamt.length; i++)
	{
         if(totalamt[i]!="")
      {
    gtotal +=parseFloat(totalamt[i]);
	}
	}

document.getElementById('total').value=parseFloat(gtotal).toFixed(2);


}


}


function calct(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var rt=document.getElementById(id).value;
var qt=document.getElementById('prc'+count).value;
if(rt!="" && qt!="")
{


var totalamt12=[];
		var fields12 = document.getElementsByName("amt1[]");
		for(var i = 0; i < fields12.length; i++) 
                   {
                       
			totalamt12.push(fields12[i].value);
		
                 }


var gtotal12 = 0;
	for (i=0; i<totalamt12.length; i++)
	{
         if(totalamt12[i]!="")
      {
    gtotal12 +=parseFloat(totalamt12[i]);
	}
	}

document.getElementById('total').value=parseFloat(gtotal12).toFixed(2);


}


}






function calc1(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var rt=document.getElementById(id).value;
var qt=document.getElementById('prc'+count).value;
if(rt!="" && qt!="")
{
var tamt=parseFloat(rt)*parseFloat(qt);
//vat price=parseFloat(tamt).toFixed(2);
//alert(parseFloat(tamt).toFixed(2));

document.getElementById('amt'+count).value=parseFloat(tamt).toFixed(2);


var totalamt1=[];
		var fields1 = document.getElementsByName("amt[]");
		for(var i = 0; i < fields1.length; i++) 
                   {
                       
			totalamt1.push(fields1[i].value);
		
                 }


var gtotal1 = 0;
	for (i=0; i<totalamt1.length; i++)
	{
         if(totalamt1[i]!="")
      {
    gtotal1 +=parseFloat(totalamt1[i]);
	}
	}

document.getElementById('total1').value=parseFloat(gtotal1).toFixed(2);


}


}


function Stx(id)
{
var count= id.replace( /^\D+/g, '').trim();  
var svtx=document.getElementById(id).value;
var rt=document.getElementById('rate'+count).value;
var qt=document.getElementById('prc'+count).value;
var amt=document.getElementById('amt'+count).value;
if(svtx!="" && amt!="")
{
var num=(parseFloat(svtx)/100)*(parseFloat(rt)*parseFloat(qt));
//alert(num);
var tamt=(parseFloat(rt)*parseFloat(qt))+num;
//alert(tamt);

document.getElementById('amt'+count).value=parseFloat(tamt).toFixed(2);


var totalamt=[];
		var fields = document.getElementsByName("amt1[]");
		for(var i = 0; i < fields.length; i++) 
                   {                       
			totalamt.push(fields[i].value);
		
                 }


var gtotal = 0;
	for (i=0; i<totalamt.length; i++)
	{
         if(totalamt[i]!="")
      {
    gtotal +=parseFloat(totalamt[i]);
	}
	}

document.getElementById('total').value=parseFloat(gtotal).toFixed(2);






}

}


function Stfx1(id)
{
var count= id.replace( /^\D+/g, '').trim();  
var svtx=document.getElementById(id).value;
var rt=document.getElementById('rate'+count).value;
var qt=document.getElementById('prc'+count).value;
var amt=document.getElementById('amt'+count).value;
if(svtx!="" && amt!="")
{
var num=(parseFloat(svtx)/100)*(parseFloat(rt)*parseFloat(qt));
//alert(num);
var tamt=(parseFloat(rt)*parseFloat(qt))+num;
//alert(tamt);

document.getElementById('amt'+count).value=parseFloat(tamt).toFixed(2);


var totalamt=[];
		var fields = document.getElementsByName("amt[]");
		for(var i = 0; i < fields.length; i++) 
                   {                       
			totalamt.push(fields[i].value);
		
                 }


var gtotal = 0;
	for (i=0; i<totalamt.length; i++)
	{
         if(totalamt[i]!="")
      {
    gtotal +=parseFloat(totalamt[i]);
	}
	}

document.getElementById('total1').value=parseFloat(gtotal).toFixed(2);






}

}



function updfunc(id)
{
var count= id.replace( /^\D+/g, '').trim(); 
var qid=document.getElementById('qotid1').value;
//alert(qid);
var detailid=document.getElementById('id'+count).value;
//alert(detailid);
var pr=document.getElementById('pr'+count).value;
var prc=document.getElementById('prc'+count).value;
var rate=document.getElementById('rate'+count).value;
var amt=document.getElementById('amt'+count).value;
var rem=document.getElementById('rem').value;

var tqtamt=document.getElementById('fprevt').value;
var tcode=document.getElementById('tcode'+count).value;
var descdet=document.getElementById('descdet'+count).value;
var stx1=document.getElementById('stx'+count).value;
//alert(descdet);

if(rem=="")
{
alert("Please enter remark");
}
else
{
var fd=new FormData($('#frm1')[0]);
	//lert(fd);

fd.append('qid',qid);
fd.append('detailid',detailid);
fd.append('pr',pr);
fd.append('prc',prc);
fd.append('amt',amt);
fd.append('rate',rate);
fd.append('rem',rem);
fd.append('tqtamt',tqtamt); 
 fd.append('tcode',tcode);
fd.append('descdet',descdet);    
  fd.append('stx1',stx1); 
  
 var conf=confirm('Are you sure to Update the record?');
    
 

if(conf==true)
{     
        $.ajax({
            url: "quotdetails_update_tis.php",
            type: "POST",
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text){
             alert(text);
               
window.open('editquotation_tis.php?qid='+qid,'_self');
            }           
       });


}
}
}










function delfunc(id)
{
var count= id.replace( /^\D+/g, '').trim(); 
var qid=document.getElementById('qotid1').value;
//alert(qid);
var detailid=document.getElementById('id'+count).value;
var rem=document.getElementById('rem').value;
var tqtamt=document.getElementById('fprevt').value;


if(rem=="")
{
alert("Please enter remark");
}
else
{
var fd=new FormData($('#frm1')[0]);
	//lert(fd);

fd.append('qid',qid);
fd.append('detid',detailid);
fd.append('rem',rem);
fd.append('tqtamt',tqtamt); 
 
      
 var conf=confirm('Are you sure to Delete the record?');
    
 

if(conf==true)
{     
        $.ajax({
            url: "quotdetails_delete_tis.php",
            type: "POST",
            data: fd ,
            contentType: false,
            cache: false,
            processData:false,
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(text){
         
             alert(text);
                
window.open('editquotation_tis.php?qid='+qid,'_self');
            }           
       });


}
}
}



function cancqfunc()
{
var quotid=document.getElementById('qotid1').value;
var rem=document.getElementById('rem').value;


if(rem=="")
{
alert("Please enter Remark");

}
else
{
var conf=confirm('Are you sure to Cancel the Quotation?');
    
 

if(conf==true)
{     

$.ajax({
            type: "POST",
            url: "process_quotation_cancel_tis.php",
            data:'quotid='+quotid+'&rem='+rem,
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(msg){
               
                 
                alert(msg);
                window.open('viewquotaion.php','_self');
               
                
            }
        });

}

}
}





</script>
<style>
#tabed{
  width: 650px ;
  margin-left: auto ;
  margin-right: auto ;
}
</style>




</head>
<body>

<center>
<?php include("menubar.php"); ?>
<h2>Edit Quotation</h2>
</center>
<form name="frm1" id="frm1" method="post" enctype="multipart/form-data">
<div id="maind" align="center">
<div align="center">
<input type="hidden" name="incr" id="incr" value="1" />
<input type="hidden" name="partcount" id="partcount" value="1" />


<table width="790" border="2">
<tr>
<th>Quotation Id</th>
<th>Customer</th>
<th>Atm</th>
<th>Bank</th>
<th>Project ID</th>
<th>Location</th>
<th>City</th>
<th>State</th>

</tr>

<tr>
 
<?php 
//echo "Select * from quotation1 where id='".$qid."'";
$edqry=mysqli_query($con,"Select * from quotation1_tis where id='".$qid."'");
$row=mysqli_fetch_array($edqry);

$qrynm=mysqli_query($con,"select cust_name from $row[2]_sites where cust_id='".$row[2]."' ");
$qname=mysqli_fetch_array($qrynm);
?>

<td>

<input type="text" name="qotid1" id="qotid1" value="<?php echo $row[0]; ?>" readonly="readonly"/>
</td>
<td>

<input type="text" name="cust1" id="cust1" value="<?php echo $qname[0]; ?>" readonly="readonly"/>
</td>
<td>
<input type="text" name="atm1" id="atm1" value="<?php echo $row[3]; ?>" readonly="readonly"/>
</td>
<td>
<input type="text" name="bank" id="bank" value="<?php echo $row[4]; ?>" readonly="readonly"/>

</td>
<td>
<input type="text" name="proj" id="proj" value="<?php echo $row[5]; ?>" readonly="readonly"/>

</td>
<td>
<textarea name="ta" id="ta" readonly="readonly"?><?php echo $row[6]; ?></textarea>
</td>
<td>
<input type="text" name="city" id="city" value="<?php echo $row[7]; ?>" readonly="readonly"/>
</td>
<td>
<input type="text" name="state" id="state" value="<?php echo $row[8]; ?>" readonly="readonly"/>
</td>

</tr>

</table>




</div>
&nbsp;&nbsp;&nbsp;

<div align="center">

<table id="myTable" style="width:840px" border="2" align="center">


<th>Particulars</th>
<th style="width:30px">Quantity</th>
<th >Rate</th>
<th>Service tax</th>
<th>Amount</th>
<th>Code(For Tata)</th>
<th >Uom(For Tata)</th>
<th></th>
<th></th>



<?php
$edqry2=mysqli_query($con,"Select distinct(particular) from quotation_details_tis where qid='".$qid."' ");

$gtot2=mysqli_query($con,"Select sum(Total) from quotation_details_tis where qid='".$qid."'");
$rowtot=mysqli_fetch_array($gtot2);
$partid=1;
$descid=1;
?>


<?php

while($rowqry2=mysqli_fetch_array($edqry2))
{

?>
    <tr>



 
 <td width="190" align="left" colspan="8">
  <input type="text" name="part" id="part<?php echo $partid; ?>"  value="<?php echo $rowqry2[0]; ?>" readonly="readonly"/>
 
  </td>

</tr>
<?php
 
  $subqry2=mysqli_query($con,"select * from quotation_details_tis where particular='".$rowqry2[0]."' and qid='".$qid."'");
  //echo "select * from quotation_details where particular='".$rowqry2[0]."' and qid='".$qid."'";
  $numr=mysqli_num_rows($subqry2);
  //$subrow=mysqli_fetch_array($subqry2);

  
  while($subrow=mysqli_fetch_array($subqry2))
{
//print_r($subrow);

?>

  <tr>
  <td align="center" width="400" >
         <input type="hidden" style="width:30px" name="id"  id="id<?php echo $descid; ?>" value="<?php echo $subrow[0]; ?>" readonly="readonly" />
         <input type="text" style="width:200px" name="pr"  id="pr<?php echo $descid; ?>" value="<?php echo $subrow[3]; ?>"  />
  </td>

  <td align="center">
     
       <input style="width:30px" type="text" name="prc" id="prc<?php echo $descid; ?>" value="<?php  echo $subrow[4]; ?>" />
  </td>

  


   <td align="center">
       <input style="width:55px" type="text" name="rate" id="rate<?php echo $descid; ?>" value="<?php  echo $subrow[5]; ?>" onblur="calc(this.id);" />
  </td>
  <!--******************add by priyanka******************-->
 <td align="center">
       <input style="width:55px" type="text" name="stx1" id="stx<?php echo $descid; ?>" value="<?php  echo $subrow[9]; ?>" onblur="Stx(this.id);" />
  </td>
  <!--*******-->
  
    <td align="center">
       <input style="width:55px" type="text" name="amt1[]" id="amt<?php echo $descid; ?>" value="<?php  echo $subrow[6]; ?>" onblur="calct(this.id);" />
  </td>


 

   <td align="center">
       <input style="width:55px" type="text" name="tcode" id="tcode<?php echo $descid; ?>" value="<?php  echo $subrow[7]; ?>" />
  </td>
  
  <td align="center">
     
       <input style="width:150px" type="text" name="descdet" id="descdet<?php echo $descid; ?>" value="<?php  echo $subrow[8]; ?>" />
  </td>

  
  <td align="center">
       <input type="button" style="width:55px" type="button" name="upd" id="upd<?php echo $descid; ?>" value="Update" onclick="updfunc(this.id)"/>
  </td>
  
      <td align="center">
       <input type="button" style="width:55px" type="button" name="del" id="del<?php echo $descid; ?>" value="Delete" onclick="delfunc(this.id)"/>
  </td>




</tr> 








<?php

$descid++;
?>
<script>

document.getElementById('incr').value="<?php echo $descid; ?>";

</script>

<?php
}

$partid++;
?>

<script>

document.getElementById('partcount').value="<?php echo $partid;?>";




</script>

<?php


}

?>

</table>
<br>
<table style="width:790px" border="2" align="center">

<tr>
<td colspan="7" width="300"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total" id="total" readonly="readonly" value="<?php echo $rowtot[0];?>" ><input type="hidden" name="fprevt" id="fprevt" value="<?php echo $rowtot[0];?>"/></td>
</tr>
<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem" id="rem" ></textarea></td>
<td  width="150">Attach email</td>
<td ><input type="file" name="email_cpy" id="email_cpy"></td>

</tr>
</table>
 
<center><input type="button" name="addp" id="addp" value="Add Particulars"/>

<input type="button" name="bck" id="bck" value="Back" <?php if($_GET['supvl']=="") { ?> onclick="window.open('quotation_approve_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"  <?php } else {?>
onclick="window.open('sup_view_quot_tis.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"  <?php }?>
/>
</center>
 

<center>
</div>
<div >
<table style="display:none"  id="hiddent">
 <tr>
  <td width="190" align="left" colspan="8">
  <input type="text" />
 
  </td>
  </tr>
  
   <tr>
   
   
  <td align="center" width="400" >
         
         <input type="text" style="width:200px"  />
  </td>

  <td align="center">
     
       <input style="width:30px" type="text"  />
  </td>


   <td align="center">
       <input style="width:55px" type="text"  onblur="calc1(this.id);"/>
  </td>

<td align="center">
       <input style="width:55px" type="text"  onblur="Stfx1(this.id);"/>
  </td>

    <td align="center">
       <input style="width:55px" type="text" readonly="readonly"/>
  </td>

<td align="center">
     
       <input style="width:55px" type="text"  />
  </td>

  <td align="center">
     
       <input style="width:150px" type="text"  />
  </td>


</tr> 


</table>

<div id="tabed">
<table id="edtable" style="display:none" border="2" align="center">
<th>Particulars</th>
<th style="width:30px">Quantity</th>
<th >Rate</th>
<th >Service Taxx</th>
<th>Amount</th>
<th>Code(For Tata)</th>
<th>UOM(For Tata)</th>
</table>
<table style="display:none" border="2" align="center" id="totable">
<tr>
<td colspan="9" width="650"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total1" id="total1" readonly="readonly"  ></td>
</tr>
</table>
<div align="center" id="hbutton" style="display:none"><input type="button" value="Submit" onclick="submitpart();"></div>
</div>
<script>

var idname= ["pr","prc","rate","stx","amt","tcode","descdet"];

$( document ).ready(function(){
$('#addp').click(function()
{
$("#edtable").css("display", "block");
$("#totable").css("display", "block");
$("#hbutton").css("display", "block");
  var a = 0;

var pcnt=document.getElementById('partcount').value;
var clone= $("#hiddent tr:nth-child(1)").clone();



clone.find("input").each(function() 
{




$(this).val("");

  $(this).attr({
		'id':"part"+pcnt,		
      'name':"part[]"

});


 a++;

  });
  
  clone.end();
  clone.appendTo("#edtable");
  funcaddr();
  pcnt=parseInt(pcnt)+1;
  document.getElementById('partcount').value=pcnt;
  

});
	
	
   });
   
   
   function funcaddr()
   {
   
   for($c=1;$c<11;$c++)
   {
   var cnt=document.getElementById('incr').value;
   var clone= $("#hiddent tr:nth-child(2)").clone();
   var i=0;
   
   
   
   clone.find("input").each(function() 
{




$(this).val("");


    $(this).attr({
		'id':idname[i]+cnt,		
      'name':idname[i]+"[]"



               
    });

 i++;

  });
  
  clone.end();



clone.appendTo("#edtable");

  cnt=parseInt(cnt)+1;
  document.getElementById('incr').value=cnt;

  
  }
  
   
   }
   
   
   

</script>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</form>
</body>
</html>