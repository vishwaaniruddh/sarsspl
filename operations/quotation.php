<?php
include("access.php");
session_start();
//include("access.php");
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

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

function getquot1hist()
{
var atm= document.getElementById("atm1").value;
//alert(atm);
$.ajax({
            type: "POST",
            url: "searchtest.php",
            data:'atm='+atm,
            success: function(msg){
               
                 
               // alert(msg);
                   
                //window.open('quotation.php','_self');
              document.getElementById("hst").innerHTML=msg; 
                
            },
    error: function (request, status, error) {
        alert(request.responseText);
    }
        });



}


function vdtefunc(qid,ct)
{

//alert(qid);
//alert(ct);
if(ct=="FIS03")
{

window.open('viewfisquotdetails.php?qid='+qid,'_blank');
}
else if(ct=="Tata05")
{

window.open('viewtataquotdetails.php?qid='+qid,'_blank');
}
else
{

 window.open('viewquotdetails.php?qid='+qid,'_blank');
  } 



}

function getbank()
{
	//alert(val);



  var cst=document.getElementById('cust1').value;
//alert(cst);



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
	
	getproject();
	    
	
          }
       }
       xmlhttp.open("GET","getbank.php?val="+cst,true);
       xmlhttp.send();
      
	
}


function getproject()
{
	//alert(val);
 
 var cst=document.getElementById('cust1').value;
//alert(cst);
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
       document.getElementById('proj').innerHTML='';
	document.getElementById('proj').innerHTML=xmlhttp.responseText;
	
	
      }
   }

  
   xmlhttp.open("GET","getprojquot.php?val="+cst,true);
   xmlhttp.send();

	
}







function submitfunc()
{

var cust= document.getElementById("cust1").value;
var bank="";
if(document.getElementById("bank").value=="0")
{
bank=document.getElementById("bn").value;
}
else
{
bank=document.getElementById("bank").value;
}


var address= document.getElementById("ta").value;
var city= document.getElementById("city").value;
var state= document.getElementById("state").value;
var atm= document.getElementById("atm1").value;


var proj= document.getElementById("proj").value;
var typ= document.getElementById("typ").value;
var sv= document.getElementById("sv").value;


var partic=[];
		var fields = document.getElementsByName("part[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			partic.push(fields[i].value);
			}


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


var svtxarr=[];
		var fields200 = document.getElementsByName("stx[]");
		for(var i = 0; i < fields200.length; i++) 
                   {
			svtxarr.push(fields200[i].value);
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




if(validate())
{
var conf=confirm('Do you really want to submit the record?');
 if(conf==true)
{
$.ajax({
            type: "POST",
            url: "process_quotation.php",
            data: {partic:partic,partyp:partyp,partqty:partqty,partrate:partrate,partamt:partamt,cust:cust,bank:bank,address:address,city:city,state:state,atm:atm,proj:proj,typ:typ,sv:sv,tcode:tcodearr,uom:uom,svtxarr:svtxarr},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(msg){
               
                 
               //alert(msg);
                   
                window.open('quotation.php','_self');
               
                
            }
        });

}



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
func();
getquot1hist();
}
else
{
document.getElementById('atm1').value="";
}

}
else
{

func();
getquot1hist();
}


}
});


}


function func()
{
//alert('hello');
//alert(id);
//var count= id.replace( /^\D+/g, '').trim();  
var atm=document.getElementById('atm1').value;
 //alert(atm);
var cid=document.getElementById('cust1').value;
//alert(cid);

$.ajax({
   type: 'POST',    
url:'getdetails.php',
data:'atm='+atm+'&cid='+cid,
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
     document.getElementById('bank').value=s2[1];
     enbtxt();

      }

    if(s2[2]!="")
    {
    document.getElementById('city').value=s2[2];

     }


    if(s2[3]!="")
    {
    document.getElementById('ta').value=s2[3];

     }

     if(s2[4]!="")
    {
    document.getElementById('state').value=s2[4];

     }
   if(s2[5]!="")
    {
    document.getElementById('proj').value=s2[5];

     }
    }
    else
    {
    enbtxt();
    }
    
    
 }
     
     });



}

function enbtxt()
{
var bankname=document.getElementById('bank').value;




if(bankname=="0")
{
 $("#bn").prop("disabled", false);

}

}


function calc(id)
{
<?php
if($_SESSION['user']!="")
{
?>



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

<?php
}
else
{
?>
alert("Sorry Your session has Expired");
window.location="index.php";

<?php
}
?>



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



function validate()
{
<?php
if($_SESSION['user']!="")
{
?>

var cust1=document.getElementById('cust1').value;
var atm=document.getElementById('atm1').value;
var type=document.getElementById('typ').value;
//var cust=document.getElementById('total').value;
var bank=document.getElementById('bank').value;
var bn=document.getElementById('bn').value;
var city=document.getElementById('city').value;
var state=document.getElementById('state').value;

if(cust1==0)
{
alert("Please select customer");
return false;
}
else if(atm=="")
{
alert("Please Enter Atm id");
return false;

}
else if(type=="-1")
{
alert("Please Select category");
return false;

}
else if(bank=="0" && bn=='0')
{
alert("Please Select bank");
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
else
{

return true;
}

<?php
}
else
{
?>
alert("Sorry Your session has Expired");
window.location="index.php";

<?php
}
?>
}


</script>


<style>

#left{
    border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px;
    
}

#container {
    width:90%;
    text-align:center;
}

#left {
    float:left;
left:20%;
   
}


#right {
    float:right;
    right:80%;
}


</style>

</head>
<body onload="getbank();">

<center>
<?php include("menubar.php"); ?>
<h2>Quotation</h2>
</center>
<form name="frm1" method="post" >

<div id="maind" align="center">



<div align="center">
<input type="hidden" name="incr" id="incr" value="11" />
<input type="hidden" name="partcount" id="partcount" value="2" />

<table width="790" border="2">
<tr>
<th>Customer</th>
<th>Atm</th>
<th>Bank</th>
<th>Other Bank</th>
<th>Project ID</th>
<th>Location</th>
<th>City</th>
<th>State</th>
<th>Category</th>
<th>Beneficiary Name</th>
</tr>

<tr>
 
<td >

<?php

$sql="Select short_name,contact_first from contacts where type='c' ";
$cnt="";
if($_SESSION['custid']!='all')
{
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
}

$qry=mysqli_query($con,$sql);
 ?>
 <select  name="cust1" id="cust1" onchange="getbank();" >
<?php if($cnt>1)
{
?>
<option value="">Select Client</option>
<?php } ?>
<?php
while($clro=mysqli_fetch_row($qry))
{
?>
<option value="<?php echo $clro[0]; ?>" <?php if($_SESSION['custid']==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
<?php
}
?>
</select> </th>


</td>
<td>
<input type="text" name="atm1" id="atm1" onblur="chckfunc();" />
</td>

<td>
<select style="width:150px" name="bank" id="bank" onchange="enbtxt();">
<option value="0">Select Bank</option>

</select>
</td>

<td>

<select  name="bn" id="bn" disabled="disabled"/>
<option value='0'>Select Bank</option>
<?php $nbqr=mysqli_query($con,"select *from quotation1bankdet");
while($nbrws=mysqli_fetch_array($nbqr))
{
?>
<option value='<?php echo $nbrws[1];?>'><?php echo $nbrws[1];?></option>
<?php } ?>
</select>
</td>
<td>
<select style="width:150px" name="proj" id="proj" >
<option value="0">Select</option>
</select>
</td>




<td>
<textarea name="ta" id="ta" ></textarea>
</td>
<td>
<select name="city" id="city" >
<option value="">Select City</option>
<?php $cityqr=mysqli_query($con,"select * from quotation1citydet  order by city ASC");
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
<?php $stqr=mysqli_query($con,"select * from quotation1statedet order by state ASC");
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
</div>
&nbsp;&nbsp;&nbsp;&nbsp;

<div align="center" id="container">
<div  id="left" >
<h3>History</h3>
<div id="hst"></div>
</div>

<div id="right">
<table id="myTable" style="width:800px" border="2" align="center" cellspacing='5' cellpadding='2'>



<th>Particulars</th>
<th style="width:30px">Quantity</th>
<th >Rate</th>
<th>Service tax</th>
<th>Amount</th>
<th>Code(For TATA)</th>
<th >UOM(For TATA)</th>



<tr>



 
 <td width="190" align="left" colspan="9">
  <input type="text" name="part[]" id="part1" />
 
  </td>


</tr>
<tr>
  <td align="center" width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr1" />
  </td>

  <td align="center">
       <input style="width:30px" type="text" name="prc[]" id="prc1"  />
  </td>

 
   

   <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate1" onblur="calc(this.id);"/>
  </td>

<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx1" onblur="Stx(this.id);" />
  </td>
  
    <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt1" readonly="readonly"/>
  </td>
  
     <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode1" />
  </td>

 <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet1" />
     </td>

</tr> 
<tr>
   <td align="center"  width="400" >
       <input type="text" style="width:200px" name="pr[]" id="pr2" />
   </td>

   <td align="center">
       <input style="width:30px" type="text" name="prc[]" id="prc2" />
   </td>

   

     <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate2" onblur="calc(this.id);"/>
  </td>


<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx2" onblur="Stx(this.id);"/>
  </td>

   <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt2" readonly="readonly" />
  </td>

 
   <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode2" />
  </td>

 <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet2" />
     </td>
</tr>
<tr>
    <td align="center" width="400">
          <input type="text" style="width:200px" name="pr[]" id="pr3" />
    </td>

     <td align="center">
           <input style="width:30px" type="text" name="prc[]" id="prc3" />
     </td>
   
    
      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate3" onblur="calc(this.id);"/>
  </td>

<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx3" onblur="Stx(this.id);"/>
  </td>
  
    <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt3" readonly="readonly"/>
  </td>
   <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode3" />
  </td>

 <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet3" />
     </td>

</tr> 
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr4"  />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc4" />
      </td>


       
  
      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate4" onblur="calc(this.id);" />
    </td>
<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx4" onblur="Stx(this.id);"/>
  </td>
  
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt4" readonly="readonly" />
  </td>
  
   <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode4" />
  </td>

  <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet4" />
     </td>
    
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr5" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc5" />
      </td>
  
     

      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate5" onblur="calc(this.id);" />
    </td>
<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx5" onblur="Stx(this.id);"/>
  </td>
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt5" readonly="readonly" />
  </td>

<td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode5" />
  </td>

    <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet5" />
     </td>
    
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr6" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc6" />
      </td>

      

      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate6" onblur="calc(this.id);" />
    </td>

<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx6" onblur="Stx(this.id);"/>
  </td>
  
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt6" readonly="readonly" />
  </td>

     <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode6" />
  </td>

    <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet6" />
     </td>
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr7" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc7" />
      </td>

        
 
      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate7" onblur="calc(this.id);" />
    </td>

<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx7" onblur="Stx(this.id);"/>
  </td>
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt7" readonly="readonly" />
  </td>
  
  <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode7" />
  </td>

  <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet7" />
     </td>
    
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr8" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc8" />
      </td>

   
      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate8" onblur="calc(this.id);" />
    </td>

<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx8" onblur="Stx(this.id);"/>
  </td>
  
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt8" readonly="readonly" />
  </td>
 <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode8" />
  </td> 


<td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet8" />
     </td>
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr9" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc9" />
      </td>
  
    

      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate9" onblur="calc(this.id);" />
    </td>
  
  <td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx9" onblur="Stx(this.id);"/>
  </td>
  
      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt9" readonly="readonly" />
  </td>

  <td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode9" />
  </td>


 <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet9" />
     </td>

    
</tr>
<tr>
     <td align="center"  width="400" >
         <input type="text" style="width:200px" name="pr[]" id="pr10" />
     </td>

     <td align="center">
          <input style="width:30px" type="text" name="prc[]" id="prc10" />
      </td>

       


      <td align="center">
       <input style="width:55px" type="text" name="rate[]" id="rate10" onblur="calc(this.id);" />
    </td>


<td align="center">
       <input style="width:80px" type="text" name="stx[]" id="stx10" onblur="Stx(this.id);" />
  </td>

      <td align="center">
       <input style="width:55px" type="text" name="amt[]" id="amt10" readonly="readonly" />
  </td>
<td align="center">
       <input style="width:80px" type="text" name="tcode[]" id="tcode10" />
  </td> 


     <td align="center">
           <input style="width:150px" type="text" name="descdet[]" id="descdet10" />
     </td>
</tr>







</table>
<table style="width:790px" border="2" align="center">
<tr>
<td colspan="4" align="right"><input type="text" name="total" id="total" readonly="readonly"></td>

</tr>
<table>
 
<center><input type="button" name="submit" id="submit" value="Submit" onclick="submitfunc();"/><input type="button" name="addp" id="addp" value="Add Particulars"/><!--<input type="button" id="addr" name="addr" value="Add row" />--><center>
</div>
</div>
</div>
<script>

   var idname= ["pr","prc","rate","stx","amt","tcode","descdet"];




$( document ).ready(function(){
$('#addr').click(function()
{
  var i = 0;

var cnt=document.getElementById('incr').value;
var clone= $("#myTable  tr:nth-child(3)").clone();


 
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



clone.appendTo("#myTable");

  cnt=parseInt(cnt)+1;
  document.getElementById('incr').value=cnt;






	
	});
	
	
   });
   
   
  

</script>
<script>

//var idname= ["pr","prc","rate","amt"];


$( document ).ready(function(){
$('#addp').click(function()
{
  var a = 0;

var pcnt=document.getElementById('partcount').value;
var clone= $("#myTable  tr:nth-child(2)").clone();



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
  clone.appendTo("#myTable");
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
   var clone= $("#myTable  tr:nth-child(3)").clone();
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



clone.appendTo("#myTable");

  cnt=parseInt(cnt)+1;
  document.getElementById('incr').value=cnt;

  
  }
  
   
   }
   
   
   

</script>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</form>
</body>
</html>
<?php } ?>