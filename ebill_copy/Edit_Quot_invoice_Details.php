<?php 
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');
include("config.php");
$st_flag=0;
$sendid=$_GET["sendId"];
//$sendid="21";

$nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 
function int_to_words($x)
       {
	   //echo $x;
           global $nwords;
           if(!is_numeric($x))
           {
               $w = '#';
           }else if(fmod($x, 1) != 0)
           {
               $w = '#'; 
           }else{
               if($x < 0)
               {
                   $w = 'minus ';
                   $x = -$x;
               }else{
                   $w = '';
               } 
               if($x < 21)
               {
                   $w .= $nwords[$x];
               }else if($x < 100)
               {
                   $w .= $nwords[10 * floor($x/10)];
                   $r = fmod($x, 10); 
                   if($r > 0)
                   {
                       $w .= '-'. $nwords[$r];
                   }
               } else if($x < 1000)
               {
                   $w .= $nwords[floor($x/100)] .' Hundred'; 
                   $r = fmod($x, 100);
                   if($r > 0)
                   {
                       $w .= ' and '. int_to_words($r);
                   }
               } else if($x < 100000) 
               {
                   $w .= int_to_words(floor($x/1000)) .' Thousand';
                   $r = fmod($x, 1000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $w .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               } else if($x < 10000000){
                   $w .= int_to_words(floor($x/100000)) .' Lakh';
                   $r = fmod($x, 100000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }else {
                   $w .= int_to_words(floor($x/10000000)) .' Crore';
                   $r = fmod($x, 10000000);
                   if($r > 0)
                   {
                       $w .= ' '; 
                       if($r < 100)
                       {
                           $word .= 'and ';
                       }
                       $w .= int_to_words($r);
                   } 
               }
           }
           return $w;
       }
       
 
?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="excel.js" type="text/javascript"></script>
<script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('annexp');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

        function PrintDiv1() {    
           var divToPrint = document.getElementById('inv');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
				 function PrintDiv2() {    
           var divToPrint = document.getElementById('page2');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
                
                
                	 function PrintDiv3() {    
           var divToPrint = document.getElementById('page3');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
                
             
                
     </script>
     
<!--------------------------------- annexure start-------------------------------->
<div align="center" ><b><h3>Edit Invoice</h3></b></div>

<div id="annexp">
    
    <table width="100%" border="1" cellpadding="0"  cellspacing="0">
  <th>Sr No</th>
   <th>Customer</th>
   <th>Project</th>
   <th>Bank</th>
   <th>Atm ID</th>
   <th>Site ID</th>
   <th>City</th>
   <th>State</th>
   <th>Location</th>
   <th>Work Details </th>
   <th>Month</th>
   <th>Approval Date</th>
   <th>Edit Approval Amount</th>
   <th>Approved By</th>
   
   
   <?php 
   
   $getinvm=mysqli_query($con,"select * from  rnm_invoice where send_id='".$sendid."'");
   $mnrow=mysqli_fetch_array($getinvm);
   
   
   
   $getanexdets=mysqli_query($con,"select * from  rnm_invoice_details where send_id='".$sendid."'");
             $getanexdets_NumRows=mysqli_num_rows($getanexdets);
             
             
   $srno=1;
   $ttmt=0;
   $bk="";
   while($annexrows=mysqli_fetch_array($getanexdets))
   {
       
       $gtdetsfrmquot=mysqli_query($con,"select * from quotation1 where id='".$annexrows["qid"]."'");
       $gdtsrwss=mysqli_fetch_array($gtdetsfrmquot);
       
      $bk= $gdtsrwss["bank"];
       
     //  echo "select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'";
       $stts=mysqli_query($con,"select * from ".$gdtsrwss["cust"]."_sites where atm_id1='".$gdtsrwss["atm"]."'");
       $sttsrws=mysqli_fetch_array($stts);
       
      // echo "Select * from quotation_approve_details where qid='".$gdtsrwss[0]."'";
       $gapdet=mysqli_query($con,"Select * from rnm_invoice_details where qid='".$gdtsrwss[0]."'");
$nurws=mysqli_num_rows($gapdet);

if($nurws>0)
{
$approw=mysqli_fetch_array($gapdet);


}
   ?>
   
   <tr>
       <td><?php echo $srno; ?></td>
   <td><?php echo $annexrows["cust"];?></td>
   <td><?php echo $annexrows["project"];?></td>
   <!--<td><select id="bank1" name="bank1" onclick='getbank(<?php echo $annexrows["cust"];?>)'>-->
       <td>
           <select name="bank[]" id="bank<?php echo $srno; ?>" onfocus="getbank('<?php echo $annexrows["cust"];?>','<?php echo $srno; ?>')">
           <option value="<?php echo $annexrows["bank"];?>" selected><?php echo $annexrows["bank"];?></option>
           </select>
       </td>
   <td><input type="text" id="annexr_atm<?php echo $srno; ?>" name="annexr_atm[]" value="<?php echo $annexrows["atm"];?>" /></td>
   <td><?php echo $annexrows["site_id"];?></td>
   <td><?php echo $annexrows["city"];?></td>
   
   
   
   <td>
   <select name="state[]" id="state<?php echo $srno; ?>" onfocus="getState('<?php echo $srno; ?>')">
           <option value="<?php echo $annexrows["state"];?>" selected><?php echo $annexrows["state"];?></option>
           </select>
   
   
   
   </td>
   <td><?php echo $annexrows["location"];?></td>
   	       <td  align="left" width="300">
	     
<?php

if($gdtsrwss[2]=='ICICI' || $gdtsrwss[2]=='RATNAKAR' || $gdtsrwss[2]=='ICICI_Direct' || $gdtsrwss[2]=='Knight_Frank' || $gdtsrwss[2]=='BajajFinance' || $gdtsrwss[2]=='kotak')
{
?>
<table border='1'>
<?php
$qdetici=mysqli_query($con,"select * from icici_quot_details where qid='".$gdtsrwss[0]."'");
 while($gdetca2=mysqli_fetch_array($qdetici))
 {
 ?>
<tr>

  <td width="100"><?php echo $gdetca2[2];?></td>
  <td width="100"><?php echo $gdetca2[3];?></td>
<td width="200"><?php echo $gdetca2[4];?></td>
<td width="100"><?php echo $gdetca2[5];?></td>
<td width="100"><?php echo $gdetca2[6];?></td>
<td width="100"><?php echo $gdetca2[7];?></td>
<td width="100"><?php echo $gdetca2[8];?></td>
<td width="100"><?php echo $gdetca2[9];?></td>


</tr>
<?php
}
?>
</table>
<?php
 } 
 else
{
 ?>
 <table ><input type="button" value="Edit Work Details" onclick="setvalueForworkdetailsID(<?php echo $annexrows[id];?>,<?php echo $sendid; ?>,<?php echo $srno; ?>)"/>

<?php
 
$qdetc=mysqli_query($con,"select distinct(particular) from Rnm_quotation_details where qid='".$gdtsrwss[0]."'");
 while($gdetca=mysqli_fetch_array($qdetc))
 {
?>


<tr><td colspan="2" align="center"><b><?php echo $gdetca[0];?></b></td></tr>
<?php
  $gpart=mysqli_query($con,"select * from Rnm_quotation_details where particular='".$gdetca[0]."' and qid='".$gdtsrwss[0]."'");
$str='a';
while($gparta=mysqli_fetch_array($gpart))
 {
?>
  <tr><td width=""><?php echo "(".$str.")".$gparta[3];?></td>
<td  align="left"><?php echo "(".$gparta[4]."*".round($gparta[5]).")" ;?></td>
</tr>

<?
$str++;
 }

  
 }
?>
</table>
<?php
}?>
</td>

   <td><?php echo date("M-Y",strtotime($approw["ApprovalDate"]));?></td>
   <td><?php
   $mnth=date("M-Y",strtotime($approw["ApprovalDate"]));
   if($approw["ApprovalDate"]!="0000-00-00"){ echo date("d-M-Y",strtotime($approw["ApprovalDate"])); } ?></td>
   <td align="right"> <input type="hidden" id="edit_qid<?php echo $srno; ?>" name="edit_qid[]" value="<?php echo $annexrows['id'];?>"> <input type="text" id="edit_amt<?php echo $srno; ?>" name="edit_amt[]" onblur="effectAmt()"  value="<?php echo $approw["ApprovalAmount"]; $ttmt=$ttmt+$approw["ApprovalAmount"];?>"></td>
   <td ><?php echo $approw["ApprovedBy"]; ?></td>
   </tr>
   <?php
   $srno++;
   } ?>
   <tr>
      <td colspan="12" align="center">Total Amount</td>
      <td colspan="" align="right"><div id="tamt"><?php echo $ttmt;?></div></td>
      <td></td>
       </tr>
   </table>
</div>    

<div id="workdetails"></div>
	
	


<input type="hidden" id="srnocount" name="srnocount" value="">
      <div align="center" style="margin-top:50px">
          <input type="button" value="submit" onclick="SubEditAmt()"></div>
<!--------------------------------- annexure end-------------------------------->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">

var idname= ["pr","prc","rate","stx","amt","tcode","descdet"];

 $(document).on('click', '#addp', function() {
$('#addp').click(function()
{
   
$("#edtable").css("display", "block");
$("#totable").css("display", "block");
$("#hbutton").css("display", "block");
  var a = 0;

var pcnt=document.getElementById('partcount').value;
//alert(pcnt)

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
  //alert(pcnt+"aaaa")
  
  document.getElementById('partcount').value=pcnt;
  

});
	
	
   });
   
   
  
   
   function funcaddr()
   {
   
   for($c=1;$c<11;$c++)
   {
   var cnt=document.getElementById('incr').value;
   //alert(cnt+"sai")
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

























<script>
    function setvalueForworkdetailsID(id,sendid,$srno){
    
         $.ajax({
           type:'post',
           url:'workdetails.php',
           data:'id='+id+'&sendid='+sendid,
           success: function(msg){
          // alert(msg);
           document.getElementById('workdetails').innerHTML=msg;  
           document.getElementById('srnocount').value=$srno;  
           }
       });
       
       
    }

    function effectAmt(){
       // alert("hi")
       var edit_amt= document.getElementsByName("edit_amt[]");
      // var a = [];
        var sum = 0;
       for(var i=0;i<edit_amt.length;i++){
             sum =sum+ parseInt(edit_amt[i].value);
         //  a.push(edit_amt[i].value);
         
        }
        
        document.getElementById("tamt").innerHTML=sum;
       // alert(sum)
         
         
            }
    
   function SubEditAmt(){
      var edit_amt= document.getElementsByName("edit_amt[]");
       var edit_qid= document.getElementsByName("edit_qid[]");
        var annexr_atm= document.getElementsByName("annexr_atm[]");
         var bank= document.getElementsByName("bank[]");
          var state= document.getElementsByName("state[]");
        var a = [];
        var b = [];
        var c = [];
        var d = [];
        var e = [];
       for(var i=0;i<edit_amt.length;i++){
           
           a.push(edit_amt[i].value);
           b.push(edit_qid[i].value);
           c.push(annexr_atm[i].value);
           d.push(bank[i].value);
           e.push(state[i].value);
        }
        
     //  alert("hi"+a)
      
       $.ajax({
           type:'post',
           url:'edit_amt.php',
           data:'a='+a+'&b='+b+'&c='+c+'&d='+d+'&e='+e,
           success: function(msg){
          // alert(msg);
               if(msg==1){
                   alert("update Successfully!")
               }
               else{
                   alert("Error");
               }
           }
       });
       
       
   }
    
      
              function getbank(cust,srno){
 //  alert("by"+cust)
$.ajax({
   type: 'POST',    
url:'get_quotation1_bank.php',
data:'cust='+cust,
success: function(msg){
document.getElementById('bank'+srno).innerHTML="";

document.getElementById('bank'+srno).innerHTML=msg;

 
         }
     });



}   

function getState(srno){
   // alert("hii")
    $.ajax({
   type: 'POST',    
url:'get_state.php',
data:'',
success: function(msg){
   // alert(msg)
document.getElementById('state'+srno).innerHTML="";

document.getElementById('state'+srno).innerHTML=msg;

 
         }
     });
    
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
            url: "addpart_toquot.php",
    
            data: {partic:partic,partyp:partyp,partqty:partqty,partrate:partrate,partamt:partamt,quotid:quotid,tcode:tcodearr,uom:uom,stxx:stxx},   
            beforeSend: function()
                   {
        
                  $('#maind').html("'<h1>Processing Request ...</h1>");
                  },
            success: function(msg){
               
                 
            //   alert(msg);
               window.open('Edit_Quot_invoice_Details.php?sendId='+<?php echo $sendid ;?>,'_self');
                
            }
        });

}


}





function calc(id)
{
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
 var srcnt=document.getElementById('srnocount').value;
document.getElementById('edit_amt'+srcnt).value=parseFloat(gtotal).toFixed(2);

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
 var srcnt=document.getElementById('srnocount').value;

document.getElementById('edit_amt'+srcnt).value=parseFloat(gtotal12).toFixed(2);


}


}






function calc1(id)
{

var count= id.replace( /^\D+/g, '').trim();  
var rt=document.getElementById(id).value;
var qt=document.getElementById('prc'+count).value;
if(rt!="" && qt!="")
{
var tamt=parseFloat(rt)*parseFloat(qt);
//vat price=parseFloat(tamt).toFixed(2);
//alert("anand"+parseFloat(tamt).toFixed(2));
alert("anand"+parseFloat(tamt).toFixed(2))
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

var detailid=document.getElementById('id'+count).value;
//alert(detailid);
var pr=document.getElementById('pr'+count).value;
var prc=document.getElementById('prc'+count).value;
var rate=document.getElementById('rate'+count).value;
var amt=document.getElementById('amt'+count).value;
var rem=document.getElementById('rem').value;

var tqtamt=document.getElementById('fprevt').value;
alert(tqtamt+"pal")

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
            url: "quotdetails_updateqtrnm.php",
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
            //    alert("ram")
            alert(text);
               
window.open('Edit_Quot_invoice_Details.php?sendId='+<?php echo $sendid ;?>,'_self');
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
            url: "quotdetails_deleteqtrnm.php",
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
                
            window.open('Edit_Quot_invoice_Details.php?sendId='+<?php echo $sendid ;?>,'_self');
            }           
       });


}
}
}


</script>



<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>




