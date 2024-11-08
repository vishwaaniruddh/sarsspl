<?php
include("access.php");
include("config.php");


if(!$_SESSION['user'])
{
	?>
	<script type="text/javascript">
		alert("Sorry Your session has Expired");
		window.location="index.php";
	</script>
	<?php
}


$custr=$_GET['cr'];
$acmr=$_GET['acmr'];
$catr=$_GET['catr'];
$typr=$_GET['typr'];
$atmr=$_GET['atmr'];
$fr=$_GET['fr'];
$er=$_GET['er'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CSS-<?php echo $_SESSION['user']; ?></title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="menu.css" rel="stylesheet" type="text/css" />
	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
	<script type="text/javascript">

		var tableToExcel = (function() {
//alert("hii");
			var uri = 'data:application/vnd.ms-excel;base64,'
			, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
			, base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
			, format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
			return function(table, name) {
				if (!table.nodeType) table = document.getElementById(table)
					var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
				window.location.href = uri + base64(format(template, ctx))
			}
		})()
	</script>

	<script>



		function expex()
		{


			$('#frm1').attr('action', 'frexportnew.php').attr('target','_blank');
			$('#frm1').submit();

		}


		function getaccm(cst)
		{

			$.ajax({
				type: 'POST',    
				url:'get_accmanager.php',
				data:'cust='+cst,
				success: function(msg){

//alert(msg);
					document.getElementById('accname').innerHTML=msg;

					
				}
			});



		}

		function archquot(id)
		{

			var counts=id.replace( /^\D+/g, '').trim();
//lert(count);
			var qid=document.getElementById('qid'+counts).value;
//alert(qid);
			var conf=confirm('Do you really want to archieve the record?');
			

			if(conf==true)
			{

				$.ajax({
					type: 'POST',    
					url:'processquot_archieve.php',
					data:'qid='+qid,
					beforeSend: function()
					{
						document.getElementById(id).disabled=true;
						
						
					},
					success: function(msg){
						alert(msg);
						if(msg.trim()=='Error')
						{
							document.getElementById(id).disabled=false;
						}
						else
						{
							document.getElementById(id).value="Archieved";

						}
//window.open('view_quot_fr.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')





					}
				});



			}
		}

		function remvarchquot(id)
		{

			var counts=id.replace( /^\D+/g, '').trim();
//lert(count);
			var qid=document.getElementById('qid'+counts).value;
//alert(qid);
			var conf=confirm('Do you really want to remove the record from archieve?');
			

			if(conf==true)
			{

				$.ajax({
					type: 'POST',    
					url:'processquot_remvarchieve.php',
					data:'qid='+qid,
					beforeSend: function()
					{
						document.getElementById(id).disabled=true;
						
						
					},
					success: function(msg){
						alert(msg);
						if(msg.trim()=='Error')
						{
							document.getElementById(id).disabled=false;
						}
						else
						{
							document.getElementById(id).value="Done";

						}
//window.open('view_quot_fr.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')





					}
				});



			}
		}




		function edtsqts(id,custt,qid)
		{

//alert(custt);
			if(custt=='ICICI' || custt=='RATNAKAR' || custt=='ICICI_Direct' || custt=='Knight_Frank' ||  custt=='BajajFinance' || custt=='kotak')
			{
//window.open('rnmicicieditquotation.php?qid='+qid,'_blank');
//alert("ok");
			}
			else
			{
				window.open('rnmeditquotation.php?qid='+qid,'_blank');
			}
//if($custt=='ICICI' || $custt=='RATNAKAR' || $custt=='ICICI_Direct' || $custt=='Knight_Frank')
//{
//alert("icici");
//}
//else
//{
//window.open('rnmeditquotation.php?qid='+qid,'_blank');
//}



		}


		function edtappdetfc(id,qid)
		{

//alert(qid);
			window.open('appedit_quotrnm.php?qid='+qid,'_blank');

//if($custt=='ICICI' || $custt=='RATNAKAR' || $custt=='ICICI_Direct' || $custt=='Knight_Frank')
//{
//alert("icici");
//}
//else
//{
//window.open('rnmeditquotation.php?qid='+qid,'_blank');
//}



		}





		function subm()
		{


			$('#frm1').attr('action', 'showrnmquotpay.php');
			$('#frm1').submit();

		}

		function vdtefunc(id)
		{
//lert(id);
			var count= id.replace( /^\D+/g, '').trim();
//lert(count);
			var qid=document.getElementById('qid'+count).value;

			var ct=document.getElementById('customer'+count).value.trim();
//alert(qid);
//alert(ct);
			if(ct=="Fidility")
			{

				window.open('viewfisquotdetails.php?qid='+qid,'_blank');
			}
			else if(ct=="Tata")
			{

				window.open('viewtataquotdetails.php?qid='+qid,'_blank');
			}
			else if(ct=="ICICI"  || ct=="RATNAKAR" || ct=="ICICI Direct" || ct=="Knight Frank"  || ct=='BajajFinance' || ct=='kotak' )
			{
				window.open('viewiciciquot.php?qid='+qid,'_blank');

			}
			else
			{

				window.open('viewquotdetails.php?qid='+qid,'_blank');
			} 



		}
		function vhisfunc(id)
		{

			var count= id.replace( /^\D+/g, '').trim();
//lert(count);
			var qid=document.getElementById('qid'+count).value;

//alert(qid);

			window.open('viewoldquot.php?qid='+qid,'_blank');
			



		}


		function func(strpg,perpg)
		{

			var cust=document.getElementById('cust1').value;
			var stat=document.getElementById('stat').value;
			var strdt=document.getElementById('sdate').value;
			var endt=document.getElementById('edate').value;
			var atm=document.getElementById('atmid').value;
			var accname=document.getElementById('accname').value;
			var type=document.getElementById('type').value;
			var rnmtyp=document.getElementById('rnmtyp').value;
			var benf=document.getElementById('benf').value;
			var qid=document.getElementById('reqid').value;


			var exnm=[];

			$('#excust').each(function() {
				
				exnm.push($(this).val());
				
			});




			if(perpg=="")
			{
				perp='50';
			}
			else
			{
				perp=document.getElementById(perpg).value;
			}



			var Page="";
			if(strpg!="")
			{
				Page=strpg;
			}






//alert(accname);

//alert(atm);
			$.ajax({
				type: 'POST',    
				url:'getquotdetails_fr.php',
				beforeSend: function()
				{
					
					document.getElementById("search").innerHTML ="<center><img src=loader.gif></center>";
				},
				data:'cust='+cust+'&strdt='+strdt+'&endt='+endt+'&atm='+atm+'&stat='+stat+'&accname='+accname+'&type='+type+'&perpg='+perp+'&Page='+Page+'&rnmtyp='+rnmtyp+'&benf='+benf+'&exnm='+exnm+'&qid='+qid,
				success: function(msg){

//alert(msg);
					document.getElementById('search').innerHTML=msg;



					lcalc();
					
				}
			});





		}

		function gofunc(id)
		{
			var cust=document.getElementById('cust1').value;
			var stat=document.getElementById('stat').value;
			var strdt=document.getElementById('sdate').value;
			var endt=document.getElementById('edate').value;
			var atm=document.getElementById('atmid').value;
			var accname=document.getElementById('accname').value;
			var type=document.getElementById('type').value;





			var counts=id.replace( /^\D+/g, '').trim();
//alert(counts);

			var upreqamt=document.getElementById('upreqamt'+counts).value;
			var uprem=document.getElementById('uprem'+counts).value;
			var qid=document.getElementById('qid'+counts).value;
			var supe=document.getElementById('sv'+counts).value;
//alert(supe);
//alert(upreqamt+"-"+uprem);

			if(upreqamt=="")
			{

				alert("Enter Required Amount");
			}
			else
			{
				if(upreqamt.match(/^\d+$/)) {
					
					

					var conf=confirm('Do you really want to update the record?');
					

					if(conf==true)
					{


						$.ajax({
							type: 'POST',    
							url:'qtdet_reqamt.php',
							data:'qid='+qid+'&upreqamt='+upreqamt+'&uprem='+uprem+'&sup='+supe,
							beforeSend: function()
							{
								document.getElementById("up"+counts).disabled=true;
								document.getElementById("rej"+counts).disabled=true;       
								document.getElementById("go"+counts).disabled=true;
								
							},
							success: function(msg){
								alert(msg);
								if(msg.trim()=='Error')
								{
									document.getElementById("up"+counts).disabled=false;
									document.getElementById("rej"+counts).disabled=false;       
									document.getElementById("go"+counts).disabled=false;

									document.getElementById("udiv"+counts).style.display ='none';
								}
								else
								{
									document.getElementById("up"+counts).value="Approved";

									document.getElementById("udiv"+counts).style.display ='none';
								}

//window.open('view_quot_fr.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')





							}
						});


					}

				}
				else
				{

					alert("please enter Numbers in Required Amount");
				}
			}

		}








		function rnmnorthapp(id)
		{




			var counts=id.replace( /^\D+/g, '').trim();
//alert(counts);

			var qid=document.getElementById('qid'+counts).value;

			var conf=confirm('Do you really want to approve ?');
			
//alert(qid);
			if(conf==true)
			{


				$.ajax({
					type: 'POST',    
					url:'process_approve_rnmnorth.php',
					data:'qid='+qid,
					beforeSend: function()
					{
						document.getElementById("rnmapp"+counts).disabled=true;
						document.getElementById("rejnorth"+counts).disabled=true;         
					},
					success: function(msg){

						if(msg.trim()=='Error')
						{
 //document.getElementById("rnmapp"+counts).value="Error";
							document.getElementById("rnmapp"+counts).disabled=false;
							document.getElementById("rejnorth"+counts).disabled=false;
							alert(msg);
						}
						else
						{
							alert(msg);
							document.getElementById("rnmapp"+counts).value="approve done";
						}
//window.open('view_quot_fr.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')





					}
				});


			}




		}


		function rnmnorthrej(id)
		{
			var counts=id.replace( /^\D+/g, '').trim();
//alert(counts);

			var qid=document.getElementById('qid'+counts).value;
			var remn=document.getElementById('remnorth'+counts).value;
			if(remn=="")
			{
				alert("please enter remark");
			}
			else
			{
				var conf=confirm('Do you really want to reject?');

				if(conf==true)
				{


					$.ajax({
						type: 'POST',    
						url:'qtdet_rejectamt.php',
						data:'qid='+qid+'&uprem='+remn,
						beforeSend: function()
						{
							document.getElementById("rejnorth"+counts).disabled=true;
							
						},
						success: function(msg){


							if(msg.trim()=='Error')
							{

								document.getElementById("rejnorth"+counts).disabled=false;
								alert(msg);
							}
							else
							{
								alert(msg);
								document.getElementById("rejnorth"+counts).value="reject done";
							}



						}
					});


				}





			}  

		}



		function rejfunc(id)
		{

			var cust=document.getElementById('cust1').value;
			var stat=document.getElementById('stat').value;
			var strdt=document.getElementById('sdate').value;
			var endt=document.getElementById('edate').value;
			var atm=document.getElementById('atmid').value;
			var accname=document.getElementById('accname').value;
			var type=document.getElementById('type').value;






			var counts=id.replace( /^\D+/g, '').trim();
//alert(counts);

//var upreqamt=document.getElementById('upreqamt'+counts).value;
			var uprem=document.getElementById('uprem'+counts).value;
			var qid=document.getElementById('qid'+counts).value;

//alert(upreqamt+"-"+uprem);

			if(uprem=="")
			{
				alert("please enter remark");

			}
			else
			{

				var conf=confirm('Do you really want to reject?');
				

				if(conf==true)
				{


					$.ajax({
						type: 'POST',    
						url:'qtdet_rejectamt.php',
						beforeSend: function()
						{
							document.getElementById("rej"+counts).disabled=true;       
							document.getElementById("go"+counts).disabled=true;
							document.getElementById("up"+counts).disabled=true;
							
						},
						data:'qid='+qid+'&uprem='+uprem,
						success: function(msg){

							if(msg.trim()=='Error')
							{

								document.getElementById("rej"+counts).disabled=false;
								alert(msg);
							}
							else
							{
								alert(msg);
								document.getElementById("rej"+counts).value="reject done";
								document.getElementById("up"+counts).value="reject done";
								document.getElementById("udiv"+counts).style.display ='none';
							}
						}
					});


				}

			}


		}


		function showdiv(id)
		{

			var count= id.replace( /^\D+/g, '').trim();
//alert(count);
			document.getElementById("udiv"+count).style.display = 'block';



		}


		
		function addamt()
		{
			var total = 0;

 $('input:checkbox:checked').each(function(){ // iterate through each checked element.
 	var amount = $(this).attr("amount") ; 
 	
 	total += isNaN(parseInt(amount)) ? 0 : parseInt(amount);
 });     
 
 $("#seltot").val(total);
 
//   var payd=[];
// $("input:checkbox[name=pay[]]:checked").each(function(){
//     payd.push($(this).val());
// });

// document.getElementById('payarr').value=payd;


//  //alert(amt+" "+id);
//   if(document.getElementById(id).checked==true)
//   document.getElementById('seltot').value=Number(document.getElementById('seltot').value)+Number(amt);
//   else
//   document.getElementById('seltot').value=Number(document.getElementById('seltot').value)-Number(amt);

}

$(window).ready(function(){
//	addamt(amt,id);
		addamt();
});



function lcalc()
{

	var payd=[];
	
    $('input:checkbox:checked').each(function(){ // iterate through each checked element.

    	payd.push($(this).val());
    //   total += isNaN(parseInt($(this).val())) ? 0 : parseInt($(this).val());

    });     
    
    
    
// $("input:checkbox[name=pay[]]:checked").each(function(){
//     
// });


    document.getElementById('payarr').value=payd;

    var paymsel=[];
    var fields = document.getElementsByName("chckpay[]");
    for(var i = 0; i < fields.length; i++) 
    {
    	paymsel.push(fields[i].value);
    }



//alert(paymsel);


    var seltotal= 0;
    for (i=0; i<paymsel.length; i++)
    { 
    	if(paymsel[i]!="")
    	{
    		seltotal+=parseFloat(paymsel[i]);
    	}
    }
    
    document.getElementById('seltot').value=seltotal;

}



function showdivnw(id)
{

//alert(id);

	var count= id.replace( /^\D+/g, '').trim();
//alert(count);
	document.getElementById("udivnew"+count).style.display = 'block';


}



function updaternment(idd)
{

	var counts=idd.replace( /^\D+/g, '').trim();
//alert(counts);

	var upreqamt=document.getElementById('upreqamtrnm'+counts).value;
	var uprem=document.getElementById('upremrnm'+counts).value;
	var qid=document.getElementById('qid'+counts).value;
//alert(upreqamt);
//alert(supe);
//alert(upreqamt+"-"+uprem);

	if(upreqamt=="")
	{

		alert("Enter Required Amount");
	}
	else
	{
		if(upreqamt.match(/^\d+$/)) {
			
			

			var conf=confirm('Do you really want to update the record?');
			

			if(conf==true)
			{


				$.ajax({
					type: 'POST',    
					url:'proc_rnmupdtq.php',
					data:'qid='+qid+'&upreqamt='+upreqamt+'&uprem='+uprem,
					beforeSend: function()
					{
						document.getElementById("updnw"+counts).disabled=true;    
						document.getElementById("gornm"+counts).disabled=true;
						
					},
					success: function(msg){
						alert(msg);
						if(msg.trim()=='Error')
						{
							document.getElementById("updnw"+counts).disabled=false;
							
							document.getElementById("gornm"+counts).disabled=false;

							document.getElementById("udivnew"+counts).style.display ='none';
						}
						else
						{
							document.getElementById("updnw"+counts).value="Updated";

							document.getElementById("udivnew"+counts).style.display ='none';
						}

//window.open('view_quot_fr.php?&cr='+cust+'&acmr='+accname+'&catr='+type+'&typr='+stat+'&atmr='+atm+'&fr='+strdt+'&er='+endt,'_self')





					}
				});


			}

		}
		else
		{

			alert("please enter Numbers in Required Amount");
		}
	}



}

</script>
</head>
<body  <?php if($custr!="" || $acmr!="" || $catr!="" || $typr!="" || $atmr!="" || $fr!="" || $er!="" ) {?>onload='func('','');' <?php }?> >
	<form id='frm1' method="post" >
		<input type="text" name="payarr" id="payarr" readonly>
		<center>
			<?php  include("menubar.php"); ?>
			<h2 class="h2color">RNM FUND REQUESTS </h2>


			<br />
			<table  border="0" cellpadding="0" cellspacing="0">

				<tr>

					<?php

					$sql="Select short_name,contact_first from contacts where type='c' ";
					if($_SESSION['custid']!='all')
						$sql.=" and short_name='".$_SESSION['custid']."'";
//echo $sql;
					$qry=mysqli_query($con,$sql);

					?>
					<th >

						<input type="hidden" name="dept" id="dept" value="<?php echo $_SESSION['dept']; ?>"/>
						<input type="hidden" name="service" id="service" value="<?php echo $_SESSION['serviceauth']; ?>"/>
						<input type="hidden" name="desig" id="desig" value="<?php echo $_SESSION['designation']; ?>"/>

						<select  name="cust1" id="cust1" onchange="getaccm(this.value);" >
							<option value="">Select Client</option>
							<?php
							while($clro=mysqli_fetch_row($qry))
							{
								?>
								<option value="<?php echo $clro[0]; ?>" <?php if($custr==$clro[0]){ echo "selected"; } ?>><?php echo $clro[1]; ?></option>
								<?php
							}
							?>
						</select> </th>


						<th>
							<?
							$sql2="Select short_name,contact_first from contacts where type='c' ";
							$qry2=mysqli_query($con,$sql2);
							?>

							<select  multiple name="excust[]" id="excust" style="height:85px;" >
								<option value="">exclude Client</option>
								<?php
								while($clro1=mysqli_fetch_row($qry2))
								{
									?>
									<option value="<?php echo $clro1[0]; ?>" ><?php echo $clro1[1]; ?></option>
									<?php
								}
								?>
							</select> </th>


							<th>
								<?php // echo "select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby in quotation1) "; ?>
								<select id="accname" name="accname" onchange="func();">

									<option value="-1">select made by</option>
									<?php 

									$qrs=mysqli_query($con,"select srno,username from login where designation='8' and serviceauth='2' and deptid='4' ");

									while($qrsrow=mysqli_fetch_array($qrs))
									{

										?>

										<option value="<?php echo $qrsrow[0];?>"  <?php if($acmr==$qrsrow[0]){ echo "selected"; } ?>><?php echo $qrsrow[1];?></option>
									<?php } 

									$qrs2=mysqli_query($con,"select srno,username from login where designation='11' and serviceauth='3' and deptid='4' and srno in(select reqby from quotation1) ");

									while($qrsrow2=mysqli_fetch_array($qrs2))
									{

										?>

										<option value="<?php echo $qrsrow2[0];?>" ><?php echo $qrsrow2[1];?></option>
									<?php } ?>




								</select>
							</th>


							<th><select id="type" name="type" onchange="func();">
								<option value="-1">select category</option>

								<option value="f"  <?php if($catr=='f'){ echo "selected"; } ?>>Fixed Cost</option>
								<option value="a" <?php if($catr=='a'){ echo "selected"; } ?>>Approval Basis</option>

							</select>
						</th>



						<th><select id="benf" name="benf" onchange="func();">

							<?php if($_SESSION['dept']!='7') { ?>

								<option value="0" >select beneficiary</option>

							<?php } ?>
							<?php
							$fqr="select hname,aid,accno from fundaccounts where status=0 ";

							if($_SESSION['designation']=="20" & $_SESSION['dept']=='7') { 

								$fqr.=" and hname='Vikrant Enterprises'";
							}

							$fqr.=" order by hname ASC";
							$sup=mysqli_query($con,$fqr);
							
							
							while($supro=mysqli_fetch_array($sup))
								{ ?>
									<option value="<?php echo $supro[1]; ?>" ><?php echo $supro[0]."/".$supro[2]; ?></option>
								<?php } ?>  
							</select>

						</th>




						<th><select id="stat" name="stat" onchange="func();">


							<!--<option value="-1">status</option>-->

							<option value="0" >Pending</option>

							<option value="1" <?php if($typr=='1'){ echo "selected"; } ?>>Fund processing</option>
							<option value="3" <?php if($typr=='3'){ echo "selected"; } ?>>Rnm North approval pending</option>
							<option value="2" <?php if($typr=='2'){ echo "selected"; } ?>>Closed</option>
							<option value="10" <?php if($typr=='10'){ echo "selected"; } ?>>Rejected</option>
							<option value="100" <?php if($typr=='100'){ echo "selected"; } ?>>Archieved</option>

						</select></th>



						<th><select id="rnmtyp"  onchange="func();">

							<option value="" >All</option>

							<option value="556" >rnmfund</option>

							<option value="558" >rnmnorth</option>

						</select></th>




						<th width="75"><input type="text" name="atmid" id="atmid" placeholder="AtmID" value="<?php if($atmr!=""){ echo $atmr; }?>"/></th>
						<th width="75"><input type="text" name="sdate" id="sdate" onclick="displayDatePicker('sdate');" value="<?php if($fr!=""){ echo $fr; }?>"  placeholder="From Date"/></th>

						<th width="75"><input type="text" name="edate" id="edate"  onclick="displayDatePicker('edate');" value="<?php if($er!=""){ echo $er; }?>" placeholder="To Date"/></th>

						<th><textarea style="height:70px" name="reqid" id="reqid" placeholder="Qid" rows="1"></textarea></th>
						<th><input type="button" name="search"  value="search" onclick="func('','');"/></td>
						</tr>
					</table>
				</center>



				<center>
					<div id="search"></div>

				</center>
			
				<script type="text/javascript" src="script.js"></script>
			</body>
			</html>
			<?php 

		?>