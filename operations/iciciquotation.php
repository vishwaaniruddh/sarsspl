<?php

include("access.php");
session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{





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

<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>-->
<script type="text/javascript" src="script.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

function calc(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  

var qt=document.getElementById('qnty'+count).value;

var rt=document.getElementById('gprice'+count).value;

if(qt=="")
{
qt='1';
}

if(rt!="")
{
var tamt=parseFloat(rt)*parseFloat(qt);
//vat price=parseFloat(tamt).toFixed(2);
//alert(parseFloat(tamt).toFixed(2));

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

document.getElementById('total').value=parseFloat(gtotal).toFixed(2);


}


}



function chckfunc()
{

var atm=document.getElementById('atm1').value;
//alert(atm);

$.ajax({
   type: 'POST',    
url:'check_atm.php',
data:'atm='+atm,
success: function(msg)
{

//alert(msg);
if(msg==1)
{
  
var conf=confirm('Quotation for this ATM already exists Do yo want to continue');
    
 

if(conf==true)
{
detfunc();
}
else
{
document.getElementById('atm1').value="";
}

}
else
{

detfunc();
}


}
});


}


/*get atm material group or serv no details*/
function getserdet(id)
{

//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var servno=document.getElementById('servno'+count).value;
var custd=document.getElementById('cust1').value;


//alert(servno);
if(servno!="")
{
$.ajax({
   type: 'POST',    
url:'geticicrate.php',
data:'servno='+servno+'&custd='+custd,
success: function(msg)
{
//alert(msg);
 if(msg!=1)
 {     
  //alert(msg);
    var s2=msg.split("#");
   //document.getElementById('show').innerHTML=msg;



     if(s2[1]!="")
      {
     // alert(s2[1]);
     document.getElementById('matg'+count).value=s2[1];

      }

    if(s2[2]!="")
    {
    document.getElementById('servno'+count).value=s2[2];

     }


    if(s2[3]!="")
    {
    document.getElementById('matext'+count).value=s2[3];

     }

     if(s2[4]!="")
    {
    document.getElementById('gprice'+count).value=s2[4];

     }
 
    }

  document.getElementById('qnty'+count).focus();
    
    
 }
     
     });



}













}




/*get atm details*/
function detfunc()
{
//alert('hello');
var cust=document.getElementById('cust1').value;
var atm=document.getElementById('atm1').value;
//alert(atm);
//alert(cust);
$.ajax({
   type: 'POST',    
url:'geticicidetails.php',
data:'atm='+atm+'&cust='+cust,
success: function(msg)
{
//alert(msg);
 if(msg!=1)
 {     
  // alert(msg);
    var s2=msg.split("#");
   //document.getElementById('show').innerHTML=msg;


    if(s2[1]!="")
    {
    document.getElementById('bank').value=s2[1];

     }
     

    if(s2[2]!="")
    {
    document.getElementById('ta').value=s2[2];

     }


    if(s2[3]!="")
    {
    document.getElementById('city').value=s2[3];

     }

     if(s2[4]!="")
    {
    document.getElementById('state').value=s2[4];

     }
 
 document.getElementById('typ').focus();
    }
  
    
    
 }
     
     });



}


/* Submit Function*/
function subfunc()
{

var cust=document.getElementById('cust1').value;
 var sol=document.getElementById('atm1').value;
 var bank=document.getElementById('bank').value; 
var loc=document.getElementById('ta').value;
var city=document.getElementById('city').value;
var state=document.getElementById('state').value;
var typ=document.getElementById('typ').value;
var sv=document.getElementById('sv').value;

var matgarr=[];
		var fields = document.getElementsByName("matg[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			matgarr.push(fields[i].value);
			}

//alert(matgarr);


var servnoarr=[];
		var fields2 = document.getElementsByName("servno[]");
		for(var i = 0; i < fields2.length; i++) 
                   {
			servnoarr.push(fields2[i].value);
			}

//alert(servnoarr);

var matextarr=[];
		var fields3 = document.getElementsByName("matext[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			matextarr.push(fields3[i].value);
			}

//alert(matextarr);

var gpricearr=[];
		var fields4= document.getElementsByName("gprice[]");
		for(var i = 0; i < fields4.length; i++) 
                   {
			gpricearr.push(fields4[i].value);
			}

//alert(gpricearr);

var qntyarr=[];
		var fields5= document.getElementsByName("qnty[]");
		for(var i = 0; i < fields5.length; i++) 
                   {
			qntyarr.push(fields5[i].value);
			}

//alert(qntyarr);

var unitarr=[];
		var fields6= document.getElementsByName("unit[]");
		for(var i = 0; i < fields6.length; i++) 
                   {
			unitarr.push(fields6[i].value);
			}


//alert(unitarr);

var amtarr=[];
		var fields7= document.getElementsByName("amt[]");
		for(var i = 0; i < fields7.length; i++) 
                   {
			amtarr.push(fields7[i].value);
			}


//alert(amtarr);

var remarr=[];
		var fields8= document.getElementsByName("rem[]");
		for(var i = 0; i < fields8.length; i++) 
                   {
			remarr.push(fields8[i].value);
			}


//alert(remarr);

if(validate())
{


var conf=confirm('Do you really want to submit the record?');
    
 

if(conf==true)
{



  $.ajax({
            type: "POST",
            url: "process_icici_quotation.php",
            data: {matgarr:matgarr,servnoarr:servnoarr,matextarr:matextarr,gpricearr:gpricearr,qntyarr:qntyarr,unitarr:unitarr,amtarr:amtarr,remarr,remarr,sol:sol,bank:bank,loc:loc,cust:cust,city:city,state:state,typ:typ,sv:sv},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
                   success: function(msg){
               
                 
                alert(msg);
                   
                window.open('iciciquotation.php','_self');
               
                
            }
        });






}  /*end of confirm if */


} /*end of validate if */

}



function validate()
{

var atm=document.getElementById('atm1').value;
var typ=document.getElementById('typ').value;
//var sv=document.getElementById('sv').value;
var city=document.getElementById('city').value;
var state=document.getElementById('state').value;

if(atm=="")
{
alert("please enter Sol ID");
return false;
}
else if(typ=="-1")
{
alert("please select category");
return false;
}
else if(city=="")
{
alert("Please Select city");
return false;

}
else if(state=="")
{
alert("Please Select state");
return false;

}


return true;
}




</script>

<body onload="funcaddr(9);" >

<center>
<?php include("menubar.php"); ?>
<h2>Quotation</h2>
</center>
<form name="frm1" method="post" >

<input type="hidden"  name="incr" id="incr" value="2" />

<div id="maind" align="center">
<div align="center">


<table width="790" border="2">
<tr>
<th>Customer</th>
<th>Sol ID</th>
<th>Bank</th>
<th>Location</th>
<th>City</th>
<th>State</th>
<th>Category</th>
<th>Beneficiary</th>
</tr>

<tr>
 
 
 
 <td>
<?php
//echo $_SESSION['custid'];
$sql="Select short_name,contact_first from contacts where type='c' ";

$carr=explode(',',$_SESSION['custid']);

$cnt=count($carr);

for($i=0;$i<$cnt;$i++)
{
 if($i==0)
{


$sql.=" and short_name='".$carr[$i]."'";
}
else
{
$sql.=" or short_name='".$carr[$i]."'";

}

}

$qry=mysqli_query($con,$sql);
?>
<select  name="cust1" id="cust1"  >
<option value="">Select Client</option>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" ><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> 
</td>
 

<td>
<input type="text" name="atm1" id="atm1" onblur="chckfunc();" />
</td>

<td>
<input type="text" name="bank" id="bank" >


</select>
</td>


<!--<td>
<select style="width:150px" name="proj" id="proj" >
<option value="">select</option>
<?php 
$qrp=mysqli_query($con,"Select distinct(projectid) from ICICI_sites ");
while($qrr=mysqli_fetch_array($qrp))
{

?>
<option value="<?php echo $qrr[0]; ?>"><?php echo $qrr[0]; ?></option>

<?php } ?>
</select>
</td>-->


<td>
<textarea name="ta" id="ta" ></textarea>
</td>

<td>

<select name="city" id="city" >
<option value="">Select City</option>
<?php $cityqr=mysqli_query($con,"select *from quotation1citydet");
while($ctrws=mysqli_fetch_array($cityqr))
{
?>
<option value='<?php echo $ctrws[1];?>'><?php echo $ctrws[1];?></option>
<?php } ?>
</select>
</td>

<td>
<select name="state" id="state" />
<option value="">Select State</option>
<?php $stqr=mysqli_query($con,"select *from quotation1statedet");
while($strws=mysqli_fetch_array($stqr))
{
?>
<option value='<?php echo $strws[1];?>'><?php echo $strws[1];?></option>
<?php } ?>
</select>
</td>

<td>
<select  id="typ" name="typ" >
<option value="-1">Select type</option>
<option value="f">Fixed Cost</option>
<option value="a">Approval Basis</option>
<option value="po">PO Basis</option>
</select>
</td>

<td>
<select name="sv" id="sv"><option value="-1">Select</option>
   <?php
 //  $sup=mysqli_query($con,"select username from login where designation='11' and serviceauth='3' and deptid='4' order by username ASC");
 $sup=mysqli_query($con,"select distinct(hname),aid,accno from fundaccounts where status=0 order by hname ASC");
 
    
	 while($supro=mysqli_fetch_array($sup))
	{ ?>
	   <option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]."/".$supro[2]; ?></option>
   <?php } ?>  
    </select>
</td>




</tr>

</table>
<br>
<br>

<table border="2" cellpadding="4" id="icmain">
<th>Srno</th>
<th>Material Group</th>
<th>Service No</th>
<th>Material Text</th>
<th>Gross Price </th>
<th>Quantity</th>
<th>Unit</th>
<th>Amount</th>
<th>Remark</th>

<tr>

<td align="center" ><input type="text" style="width:40px;" name="srno" id="srno1" value="1" readonly tabindex="-1"/></td>
<td align="center" ><input type="text" style="width:85px;" name="matg[]" id="matg1"  /></td>
<td align="center" ><input type="text" style="width:85px;" name="servno[]" id="servno1" onblur="getserdet(this.id);" /></td>
<td align="center" ><input type="text" style="width:250px;" name="matext[]" id="matext1" /></td>
<td align="center" ><input type="text" style="width:75px;" name="gprice[]" id="gprice1" /></td>
<td align="center" ><input type="text" style="width:75px;" name="qnty[]" id="qnty1" onblur="calc(this.id);"/></td>
<td align="center" ><input type="text" style="width:50px;" name="unit[]" id="unit1"/></td>
<td align="center" ><input type="text" style="width:75px;" name="amt[]" id="amt1"  /></td>
<td align="center" ><input type="text" style="width:175px;" name="rem[]" id="rem1"/></td>

</tr>


</table>
<table align="center"  border="2">
<tr>
<td colspan="9" width="800"></td><td><input type="text" style="width:175px;" name="total" id="total" readonly/></td>
</tr>
<table>

<center><input type="button" onclick="subfunc();" value="Submit"><input type="button" onclick="funcaddr(1);" value="Addrow"></center>

</div>

<script>

var idname= ["srno","matg","servno","matext","gprice","qnty","unit","amt","rem"];

   function funcaddr(b)
   {
   
   for($c=0;$c<b;$c++)
   {
   var cnt=document.getElementById('incr').value;
   var clone= $("#icmain tr:nth-child(2)").clone();
   var i=0;
   
   
   
   clone.find("input").each(function() 
{

if(i=='0')
{
$(this).val(cnt);
}
else
{
$(this).val("");
}

    $(this).attr({
		'id':idname[i]+cnt,		
      'name':idname[i]+"[]"



               
    });

 i++;

  });
  
  clone.end();



clone.appendTo("#icmain");

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

<?php } ?>
