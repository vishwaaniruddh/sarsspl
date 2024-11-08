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

function subfunc()
{

var quotid=document.getElementById('qotid1').value;

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




var conf=confirm('Do you really want to submit the record?');
    
 

if(conf==true)
{



  $.ajax({
            type: "POST",
            url: "process_addicici_det.php",
            data: {matgarr:matgarr,servnoarr:servnoarr,matextarr:matextarr,gpricearr:gpricearr,qntyarr:qntyarr,unitarr:unitarr,amtarr:amtarr,remarr:remarr,qid:quotid},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
                   success: function(msg){
               
                 
                alert(msg);
                   
                window.open('iciciquotedit.php?qid='+quotid,'_self');
               
                
            }
        });






}  /*end of confirm if */



}

















function getserdet(id)
{

//alert(id);
var count= id.replace( /^\D+/g, '').trim();  

var servno=document.getElementById('servno'+count).value;
//alert(matg+"-"+servno);
var custd=document.getElementById('cust1').value;
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

  
    
    
 }
     
     });
}

}









function calc(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var gprice=document.getElementById('gprice'+count).value;
var qnty=document.getElementById('qnty'+count).value;


if(gprice!="" && qnty!="")
{
var tamt=parseFloat(gprice)*parseFloat(qnty);

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









function calc1(id)
{
//alert(id);
var count= id.replace( /^\D+/g, '').trim();  
var gprice=document.getElementById('gprice'+count).value;
var qnty=document.getElementById('qnty'+count).value;

if(gprice!="" && qnty!="")
{
var tamt=parseFloat(gprice)*parseFloat(qnty);

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







function updfunc(id)
{
var count= id.replace( /^\D+/g, '').trim(); 
var qid=document.getElementById('qotid1').value;
//alert(qid);
var detailid=document.getElementById('detid'+count).value;
//alert(detailid);
var matg=document.getElementById('matg'+count).value;
var servno=document.getElementById('servno'+count).value;
var matext=document.getElementById('matext'+count).value;
var gprice=document.getElementById('gprice'+count).value;
var qnty=document.getElementById('qnty'+count).value;
var unit=document.getElementById('unit'+count).value
var amt=document.getElementById('amt'+count).value;
var rem=document.getElementById('rem'+count).value
var updremark=document.getElementById('remark').value;

var tqtamt=document.getElementById('fprevt').value;

//alert(descdet);

if(updremark=="")
{
alert("Please enter remark");
}
else
{
var fd=new FormData($('#frm1')[0]);
	//lert(fd);

fd.append('qid',qid);
fd.append('matg',matg);
fd.append('servno',servno);
fd.append('matext',matext);
fd.append('gprice',gprice);
fd.append('qnty',qnty);
fd.append('unit',unit);
fd.append('amt',amt); 
 fd.append('rem',rem);
fd.append('updremark',updremark);    
  fd.append('tqtamt',tqtamt); 
   fd.append('detailid',detailid); 
  
 var conf=confirm('Are you sure to Update the record?');
    
 

if(conf==true)
{     
        $.ajax({
            url: "icici_quot_update.php",
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
               
window.open('iciciquotedit.php?qid='+qid,'_self');
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
var detailid=document.getElementById('detid'+count).value;
var updremark=document.getElementById('remark').value;

var tqtamt=document.getElementById('fprevt').value;

if(updremark=="")
{
alert("Please enter remark");
}
else
{
var fd=new FormData($('#frm1')[0]);
	//lert(fd);

fd.append('qid',qid);
fd.append('detailid',detailid);
fd.append('updremark',updremark);
fd.append('tqtamt',tqtamt); 
 
      
 var conf=confirm('Are you sure to Delete the record?');
    
 

if(conf==true)
{     
        $.ajax({
            url: "icici_quot_delete.php",
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
                
window.open('iciciquotedit.php?qid='+qid,'_self');
            }           
       });


}
}
}











function updsol()
{
var quotid=document.getElementById('qotid1').value;
var solid=document.getElementById('atm1').value;
var updr=document.getElementById('remark').value;
//alert(quotid);


 if(updr=="")

{
alert("please enter remark");

}
else
{

var conf=confirm('Do you really want to update Sol ID?');
    


if(conf==true)
{



  $.ajax({
            type: "POST",
            url: "process_icicisolid_editt.php",
            data: {qid:quotid,solid:solid,updr:updr},
             beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
                   success: function(msg){
               
                 
                alert(msg);
                   
                window.open('iciciquotedit.php?qid='+quotid,'_self');
               
                
            }
        });






}  /*end of confirm if */

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
var patm=document.getElementById('atmfe').value;
document.getElementById('atm1').value=patm;
}

}
else
{

detfunc();
}


}
});


}



function detfunc()
{
//alert('hello');

var atm=document.getElementById('atm1').value;
//alert(atm);
$.ajax({
   type: 'POST',    
url:'geticicidetails.php',
data:'atm='+atm,
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
     // alert(s2[1]);
     document.getElementById('proj').value=s2[1];

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
 
    }
  
    
    
 }
     
     });



}









</script>
<style>

#tabed{
  width: 900px ;
  
 
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

<?php 
//echo "Select * from quotation1 where id='".$qid."'";
$edqry=mysqli_query($con,"Select * from quotation1 where id='".$qid."'");
$row=mysqli_fetch_array($edqry);


?>

<input type="hidden" name="atmfe" id="atmfe" value="<?php echo $row[3]; ?>"  />

<table width="790" border="2">
<tr>
<th>Quotation Id</th>
<th>Customer</th>
<th>Sol ID</th>
<th>Bank</th>
<th>Project ID</th>
<th>Location</th>
<th>City</th>
<th>State</th>

</tr>



 


<td>

<input type="text" name="qotid1" id="qotid1" value="<?php echo $row[0]; ?>" readonly="readonly"/>
</td>
<td>

<input type="text" name="cust1" id="cust1" value="<?php echo $row[2]; ?>" readonly="readonly"/>
</td>
<td>
<input type="text" name="atm1" id="atm1" value="<?php echo $row[3]; ?>" onblur="chckfunc();"  readonly="readonly"/>
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
<td>
<!--<input type="button" name="updsolid" id="updsolid"  value="Update SOL ID" onclick="updsol();"/>-->
</td>


</tr>

</table>




</div>
&nbsp;&nbsp;&nbsp;

<div align="center">

<table id="myTable" style="width:840px" border="2" align="center">

<th>Srno</th>
<th>Material Group</th>
<th>Service No</th>
<th>Material Text</th>
<th>Gross Price </th>
<th>Quantity</th>
<th>Unit</th>
<th>Amount</th>
<th>Remark</th>
<th>update</th>
<th>delete</th>

<?php 
$tamt=0;

$getsum=mysqli_query($con,"select sum(amt) from icici_quot_details where qid='".$qid."'");
$srow=mysqli_fetch_array($getsum);

$getqry=mysqli_query($con,"select * from icici_quot_details where qid='".$qid."'");
//echo "select * from icici_quot_details where qid='".$qid."'";
$rwno='1';
while($rw=mysqli_fetch_array($getqry))
{
?>

<tr>

<td align="center" ><input type="text" style="width:40px;" name="srno" id="srno1"  value="<?php echo $rwno; ?> " readonly /></td>
<td align="center" style="display:none;" ><input type="text" style="width:40px;" name="detid1[]" id="detid<?php echo $rwno; ?>"  value="<?php echo $rw[0];?>" readonly /></td>
<td align="center" ><input type="text" style="width:85px;" name="matg1[]" id="matg<?php echo $rwno; ?>"  value="<?php echo $rw[2];?>" onblur="getserdet(this.id);" /></td>
<td align="center" ><input type="text" style="width:85px;" name="servno1[]" id="servno<?php echo $rwno; ?>" onblur="getserdet(this.id);" value="<?php echo $rw[3];?>" onblur="getserdet(this.id);" /> </td>
<td align="center" ><input type="text" style="width:175px;" name="matext1[]" id="matext<?php echo $rwno; ?>" value="<?php echo $rw[4];?>" /> </td>
<td align="center" ><input type="text" style="width:75px;" name="gprice1[]" id="gprice<?php echo $rwno; ?>" value="<?php echo $rw[5];?>" /> </td>
<td align="center" ><input type="text" style="width:75px;" name="qnty1[]" id="qnty<?php echo $rwno; ?>" onblur="calc(this.id);" value="<?php echo $rw[6];?>" onblur="calc(this.id);" /></td>
<td align="center" ><input type="text" style="width:50px;" name="unit1[]" id="unit<?php echo $rwno; ?>" value="<?php echo $rw[7];?>" /></td>
<td align="center" ><input type="text" style="width:75px;" name="amt1[]" id="amt<?php echo $rwno; ?>" value="<?php echo round($rw[8]); $tamt=$tamt+round($rw[8]);?>" readonly /></td>
<td align="center" ><input type="text" style="width:175px;" name="rem1[]" id="rem<?php echo $rwno; ?>" value="<?php echo $rw[9];?>" /> </td>


  <td align="center">
       <input type="button" style="width:55px" type="button" name="upd<?php echo $rwno; ?>" id="upd<?php echo $rwno; ?>" value="Update" onclick="updfunc(this.id)"/>
  </td>
  
      <td align="center">
       <input type="button" style="width:55px" type="button" name="del<?php echo $rwno; ?>" id="del<?php echo $rwno; ?>" value="Delete" onclick="delfunc(this.id)"/>
  </td>


</tr> 

<?php 
$rwno++;
?>
<script>

document.getElementById('incr').value="<?php echo $rwno; ?>";

</script>
<?php } ?>




</table>
<br>
<table style="width:790px" border="2" align="center">

<tr>
<td colspan="7" width="300"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total" id="total" readonly="readonly" value="<?php echo $tamt;?>" ><input type="hidden"  name="fprevt" id="fprevt" value="<?php echo round($srow[0]);?>"/></td>
</tr>

<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="remark" id="remark" ></textarea></td>
<td  width="150">Attach email</td>
<td ><input type="file" name="email_cpy" id="email_cpy"></td>

</tr>
</table>
 
<center><input type="button" name="addp" id="addp" value="Add Details" onclick="funcaddr(1);"/>
<input type="button" name="bck" id="bck" value="Back" onclick="window.open('icici_quot_view.php?qoid=<?php echo $qoid;?>'+'&strdt=<?php echo $sts;?>'+'&endt=<?php echo $ends;?>'+'&oatm=<?php echo $atms;?>','_self');"
/>
</center>
 

<center>
</div>
<div >
<table style="display:none"  id="hiddent">
<tr>

<td align="center" ><input type="text" style="width:40px;" /></td>
<td align="center" ><input type="text" style="width:85px;" /></td>
<td align="center" ><input type="text" style="width:85px;"  onblur="getserdet(this.id);" /></td>
<td align="center" ><input type="text" style="width:175px;" /></td>
<td align="center" ><input type="text" style="width:75px;" /></td>
<td align="center" ><input type="text" style="width:75px;"  onblur="calc1(this.id);" /></td>
<td align="center" ><input type="text" style="width:50px;" /></td>
<td align="center" ><input type="text" style="width:75px;" readonly="readonly"/></td>
<td align="center" ><input type="text" style="width:175px;" /></td>

</tr>

</table>

</div>



<div id="tabed" align="left">
<table id="edtable" style="display:none" border="2" align="center">
<th>Srno</th>
<th>Material Group</th>
<th>Service No</th>
<th>Material Text</th>
<th>Gross Price </th>
<th>Quantity</th>
<th>Unit</th>
<th>Amount</th>
<th>Remark</th>


</table>

<table style="display:none" border="2" align="center" id="totable">
<tr>
<td colspan="8" width="800"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total1" id="total1" readonly="readonly"  ></td>
</tr>
</table>
<div align="center" id="hbutton" style="display:none"><input type="button" value="Submit" onclick="subfunc();"></div>
</div>
<script>

var idname= ["srno","matg","servno","matext","gprice","qnty","unit","amt","rem"];

   function funcaddr(b)
   {
 $("#edtable").css("display", "block");  
$("#totable").css("display", "block");
$("#hbutton").css("display", "block");
   for($c=0;$c<b;$c++)
   {
   var cnt=document.getElementById('incr').value;
   var clone= $("#hiddent tr:nth-child(1)").clone();
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