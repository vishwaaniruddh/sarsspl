<?php 
include("access.php");
include("config.php");
session_start();


$repod=$_GET['repod'];
$rename=$_GET['rename'];
$resv=$_GET['resv'];

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>New Bill Package Entry</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="script.js"></script>
 <link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<script type="text/javascript">


function dates(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();
$('#pdate'+count).datepicker();
$('#pdate'+count).datepicker('show');
}


function validate()
{

var podnum=document.getElementById('podno').value;
var podname=document.getElementById('name').value;
var supid=document.getElementById('sv').value;

if(!podnum.length>0 || !podname.length>0 )
{
alert("Please enter Pod number and Name");

return false;
}
if(supid==-1)
{
alert("select supervisor");
return false;
}
return true;

}




function subf(typ)
{


var poda= document.getElementById("podno").value;
var namea= document.getElementById("name").value;
var supa= document.getElementById("sv").value;

//alert("hello");

var atmida=[];
		var fields = document.getElementsByName("atmid[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			atmida.push(fields[i].value);
			}
var pdate=[];
		var fieldp = document.getElementsByName("pdate[]");
		for(var i = 0; i < fieldp.length; i++) 
                   {
			pdate.push(fieldp[i].value);
			}



var srnoa=[];
		var fields1 = document.getElementsByName("srno[]");
		for(var i = 0; i < fields1.length; i++) 
                   {
			srnoa.push(fields1[i].value);
			}


var trcka=[];
		var fields2 = document.getElementsByName("trackid[]");
		for(var i = 0; i < fields2.length; i++) 
                   {
			trcka.push(fields2[i].value);
			}

var rca=[];
		var fields3 = document.getElementsByName("recon_chrg[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			rca.push(fields3[i].value);
			}

var dca=[];
		var fields4 = document.getElementsByName("discon_chrg[]");
		for(var i = 0; i < fields4.length; i++) 
                   {
			dca.push(fields4[i].value);
			}
var latea=[];
		var fields5 = document.getElementsByName("after_duedt_chrg[]");
		for(var i = 0; i < fields5.length; i++) 
                   {
			latea.push(fields5[i].value);
			}
var sda=[];
		var fields6 = document.getElementsByName("sd[]");
		for(var i = 0; i < fields6.length; i++) 
                   {
			sda.push(fields6[i].value);
			}

var amta=[];
		var fields7 = document.getElementsByName("amt[]");
		for(var i = 0; i < fields7.length; i++) 
                   {
			amta.push(fields7[i].value);
			}

var tamta=[];
		var fields8 = document.getElementsByName("tamt[]");
		for(var i = 0; i < fields8.length; i++) 
                   {
			tamta.push(fields8[i].value);
			}

if(validate())
{

var conf=confirm('Do you really want to submit the record?');
    

if(conf==true)
{


$.ajax({
            type: "POST",
            url: "processbillpackage.php",
            data: {atmidf:atmida,srnof:srnoa,trackerf:trcka,supf:supa,podf:poda,namef:namea,rcf:rca,dcf:dca,latef:latea,sdf:sda,amtf:amta,tamtf:tamta,pdate:pdate},
            success: function(msg){
               
                alert(msg);
                  if(typ==2)
                {
                self.location='ebillpackageentry.php?repod=' + poda+'&rename='+namea+'&resv='+supa;
                }
                  else
              {
                  self.location='ebillpackageentry.php';
               }
            }
        });

}

}




}


function getdetails(val,type,id)
{
//alert(val+" "+type);
//alert(cnt);
//alert(id);
//alert(id);
//var count=id.match(/\d+/g);
var count= id.replace( /^\D+/g, '').trim();
//alert(count);
//


if((document.getElementById('cons'+count).checked==true && type=='Consumer_No') || type=='atm_id1')
{
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
	//alert(xmlhttp.responseText);
	var s=xmlhttp.responseText;
	var s2=s.split("###$$$");
	//
	//alert(xmlhttp.responseText);
       //alert(s2[0]);
	if(s2[0]=='NA')
	{
        alert(s2[1]);
	//document.getElementById('err').innerHTML=xmlhttp.responseText;
	document.getElementById('con_no'+count).value="";
	document.getElementById('address'+count).value="";
	document.getElementById('trackid'+count).value="";
	document.getElementById('client'+count).value="";
	document.getElementById('bank'+count).value="";
	document.getElementById('atmid'+count).value="";
	
	}
	else
	{
	
	//alert("fine");
	document.getElementById('con_no'+count).value=s2[0];
        //alert(document.getElementById('con_no'+count).value);
	document.getElementById('address'+count).value=s2[1];

        document.getElementById('trackid'+count).value=s2[2];

	  document.getElementById('client'+count).value=s2[3];

	document.getElementById('bank'+count).value=s2[4];
        //document.getElementById('tamt'+count).value="0";

	if(document.getElementById('atmid'+count).value=="")
	document.getElementById('atmid'+count).value=s2[5];
	

	}


    }
  }
  
if(!val=="")
{
//alert("getebdetails.php?val="+val+"&type="+type+'&cid='+cid);
xmlhttp.open("GET","getdetpackentry.php?val="+val+"&type="+type,true);
xmlhttp.send();
}
}	
}






function func(id)
{
var count= id.replace( /^\D+/g, '').trim();
var rc=document.getElementById('recon_chrg'+count).value;

var dc=document.getElementById('discon_chrg'+count).value;
var sd=document.getElementById('sd'+count).value;
var latec=document.getElementById('after_duedt_chrg'+count).value;
var amt=document.getElementById('amt'+count).value;


if(rc=="")
{
rc=0;
}
if(dc=="")
{
dc=0;
}
if(sd=="")
{
sd=0;
}
if(latec=="")
{
latec=0;
}
if(amt=="")
{
amt=0;
}

var totalamt=parseFloat(rc)+parseFloat(dc)+parseFloat(sd)+parseFloat(latec)+parseFloat(amt);

document.getElementById('tamt'+count).value=parseFloat(totalamt).toFixed(2);;

                      var totpayamt = [];
		var fields = document.getElementsByName("tamt[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			totpayamt.push(fields[i].value);
			}
	
	var gtotal = 0;
	for (i=0; i<totpayamt.length; i++)
	{
          if(totpayamt[i]!="")
             {
              gtotal +=parseFloat(totpayamt[i]);
	      }
	}
	
document.getElementById('totaloftamt').value=parseFloat(gtotal).toFixed(2);








}

function calc(id)
{
 var totpayamt1 = [];
		var fields = document.getElementsByName("tamt[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			totpayamt1.push(fields[i].value);

                   }
	var gtotal1 = 0;
	for (i=0; i<totpayamt1.length; i++)
	{ 
          if(totpayamt1[i]!="")
             {
    gtotal1 +=parseFloat(totpayamt1[i]);
	    }
	}
	

document.getElementById('totaloftamt').value=parseFloat(gtotal1).toFixed(2);
}

</script>



</head>
<body >
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?></center>
<div align="left">
  <h2 class="style1"></h2>
</div><br /><br />
<form id="form1" name="form1" method="post" >
<div align="center"><label>POD NO<label><input type="text" name="podno" id="podno" value="<?php if($repod!="") echo $repod; ?>"  /> &nbsp; &nbsp;<label>Name<label><input type="text" name="name" id="name"   value="<?php if($rename!="") echo $rename; ?>"/>
<label>Supervisor </label><select name="sv" id="sv" >
			   <?php
                  
                                   if($resv=="") 
                                 {
                                     ?>
                                        <option value="-1">Select</option>
                                  <?php
			  
			  $sup=mysqli_query($con,"select hname,aid from fundaccounts order by hname ASC");
				   while($supro=mysqli_fetch_array($sup))
				{ ?>
				   <option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]; ?></option>
			   <?php } 
                                }
                                    elseif($resv!="")
                                     {
                                    

                                     $sup=mysqli_query($con,"select hname,aid from fundaccounts where aid='".$resv."' order by hname ASC");
                                      while($supro=mysqli_fetch_array($sup))  
                                    { 
                                      ?>
				   <option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]; ?></option>


                               <?php } 

                                  }

                                 ?>  
			    </select>


</div>
<br>
<div align="left" id="err"></div>

<input type="hidden" name="incr" id="incr" value="2" />
 <table id="myTable" width="790" border="1" align="left" cellpadding="4" cellspacing="0">
 <tr></>
 <td width="15" >Sr No<input type="text" name="srno[]" style="width:20px" id="srno1"  readonly="readonly" value="1" /></td>
  <td width="120" height="52">ATM ID<input type="text" name="atmid[]" id="atmid1"   onblur="getdetails(this.value,'atm_id1',this.id);" /></td>
 
 <td width="120" height="52">Client <input type="text" name="client[]" id="client1"  readonly="readonly" /></td>
 
	
	 <td width="85" height="52">Bank <input type="text" name="bank[]" id="bank1" style="width:70px" readonly="readonly" /></td>
	   
			  
	<td width="146" height="52"> Address <textarea name="address[]" id="address1"  readonly="readonly"  /></textarea></td>
	 <td width="80" style="display:none" height="52">Tracker ID <input style="width:55px" id="trackid1" type="text" name="trackid[]"  readonly="readonly" /></td>
	<td width="120" height="52">Consumer No<input  type="checkbox" name="cons[]"
id="cons1" />&nbsp;&nbsp;Search<br> <input type="text" name="con_no"  id="con_no1" onblur="getdetails(this.value,'Consumer_No',this.id);" /><br /></td>
     
<td width="120" height="55">Paid Date<input type="text" name="pdate[]" id="pdate1" placeholder="dd-mm-yyyy" /></td>
 <td width="120" height="55">RC<input type="text" style="width:52px" name="recon_chrg[]" id="recon_chrg1" onblur="func(this.id)"/></td>
 <td width="120" height="55">DC<input type="text" style="width:52px" name="discon_chrg[]" id="discon_chrg1" onblur="func(this.id)"/></td>
 <td width="120" height="52">SD<input type="text" style="width:55px" name="sd[]" id="sd1" onblur="func(this.id)"/></td>
 <td width="120" height="60">Late charges<input type="text" style="width:75px" id="after_duedt_chrg1"  name="after_duedt_chrg[]"  onblur="func(this.id)"/></td>
 <td width="120" height="52">Amount<input type="text"  style="width:55px" name="amt[]" id="amt1" onblur="func(this.id)"/></td>
 <td width="120" height="52">Total Amount<input type="text"style="width:55px"  name="tamt[]"  id="tamt1" onblur="calc(this.id)"/></td>
 
 </tr>
</table>

<div align="right"><label><b>Total<b><label><input type="text" id="totaloftamt" name="totaloftamt" style="width:70px" readonly="readonly" /></div>
<div align="right"><input type="button" id="addr" value="Add row"/></div>
<script>
	
        var idname= ["srno","atmid", "client", "bank","trackid","cons","con_no","pdate","recon_chrg","discon_chrg","sd","after_duedt_chrg","amt","tamt"];
   
   
$( document ).ready(function(){
$('#addr').click(function()
{
  var i = 0;

var cnt=document.getElementById('incr').value;
var clone= $("table tr:first").clone();

if(cnt>70)
{
alert("please submit or click submit and continue to add more records");
}
else
{
 
clone.find("input").each(function() 
{
if(i==0)
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


clone.find("textarea").attr(
{
'id':"address"+cnt,		
      'name':"address[]",
'value':''
});
clone.end();



clone.appendTo("table");
  cnt=parseInt(cnt)+1;
  document.getElementById('incr').value=cnt;

}
	
	});
	
	
   });




</script>
<div align="center">
<input type="button" name="s1" id="s1" value="Submit" onclick="subf(1);"/>
<input type="button" name="s2" id="s2" value="Submit & Continue" onclick="subf(2);"/></div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</div>
</form>
</body>
</html>
