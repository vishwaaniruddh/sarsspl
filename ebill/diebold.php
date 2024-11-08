<?php

session_start();

echo $_SESSION['user'];

?>



<style>

th

{

font-size:12px;

}

</style>

<?php ini_set( "display_errors", 0);

$id = $_GET['id'];



 $cid=$_POST['cid'];

 $bid=$_POST['bid'];

 $comp=$_POST['comp'];



//if($id!=2) echo "You are not authorised to see this page";

// header('Location:managesite1.php?id='.$id); 

 $nwords = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen", "Twenty", 30 => "Thirty", 40 => "Forty", 50 => "Fifty", 60 => "Sixty", 70 => "Seventy", 80 => "Eighty", 90 => "Ninety" ); 

function int_to_words($x)

       {

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

              mysqli_w .= $nwords[floor($x/100)] .' Hundred'; 

mysqli_             $r = fmod($x, 100);

                   if($r > 0)

                   {

                       $w .= ' and '. int_to_words($r);

                   }

               } else if($x < 100000) 

               {

                   $w .= int_to_words(floor($x/1000)) .' Thousand';

                   $r = fmod($x, 1000);

                   if($r > 0)
mysqli_
     mysqli_        {
mysqli_
                       $w .= ' '; 
mysqli_
                       if($r < 100)
mysqli_
       mysqli_          {
mysqli_
                           $w .= 'and ';

                       }

                       $w .= int_to_words($r);

                   } 
mysqli_
               } else if($x < 10000000){

        mysqli_     $w .= int_to_words(floor($x/100000)) .' Lakh';
mysqli_
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

        mysqli_urn $w;
mysqli_
       }
mysqli_
$hostname='localhost'; //// specify host, i.e. 'localhost'

$user='smysqli_n_cncindi'; //// specify username
mysqli_
$pass='Satya1234sar56'; //// specify password

$dbase='mysqli_an_cncindia'; //// specify database name
mysqli_
$connection = mysql_connect("$hostname" , "$user" , "$pass") 

or die ("Can't connect to MySQL");
mysqli_
mysql_select_db($dbasmysqli_onnection) or die ("Can't select database.");


mysqli_
mysqli_
mysqli_
mysqli_

			

              	

$bills=$_POST['bills'];

$bill=$_SESSION['$bills'];

$cb= count($bills);



if($cb==0)

{

 ?>

   <script>

   alert("please select site for creating bill");

   window.location="<?php echo $_SERVER['HTTP_REFERER']; ?>"; 

   </script>

   <?php 

}

$rescomp=mysql_query("select * from company_details where compid='$comp'");

$qry=mysql_query("select cust_name from ".$cid."_sites ");

                $r1=mysql_fetch_row($qry); 

                $cust_name=$r1[0];

           $rowcomp=mysql_fetch_row($rescomp); 

		   //echo "select * from ebillcharges where Cid='$cid' and Bid='$bid'";

$qry1=mysql_query("select * from ebillcharges where Cid='$cid' and Bid='$bid'");  

//echo mysql_num_rows($qry1); 

if(mysql_num_rows($qry1)>0)         















   $raterow=mysql_fetch_row($qry1); 

   else

   {

    $qr=mysql_query("select * from ebillcharges where Cid='$cid' and Bid='All'");  

    $raterow=mysql_fetch_row($qr); 

   }

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

<style type="text/css">

<!--

.style1 {
mysqli_
	color: #0080FF;mysqli_
mysqli_
	font-weight: bold;

}mysqli_

body {mysqli_

	background-color: #FFFFFF;
mysqli_
}
mysqli_
mysqli_



</style>

</head>

mysqli_

<body>mysqli_

<scripmysqli_="text/javascript">     

        function PrintDiv() {    

           var divToPrint = document.getElementById('front');

           var popupWin = window.open('', '_blank', 'width=800,height=500');

           popupWin.document.open();

           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');

            popupWin.document.close();

                }



        function PrintDiv1() {    

           var divToPrint = document.getElementById('back');

           var popupWin = window.open('', '_blank', 'width=800,height=500');

      mysqli_opupWin.document.open();

           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');

            popupWin.document.close();

                }

     </script>

<div id='front'>

  <!--

<center><img src="image002.jpg" width="520" height="60" /></center>-->

  <div align="center" style="width:20%">

  <!-- <h2>E-BILL INVOICE</h2> -->

</div>

<?php 

$currentdate=date('Y-m-d');

$sql5 = "select max(invoice_no) from send_bill where comp='$comp'";

$res5 = mymysqli_ery($sql5);
mysqli_
$row5 = mysql_fetch_row($res5);

$newinvoice_no=$row5[0]+1;
mysqli_
$res4=mysql_query("insmysqli_to send_bill(customer_name,bank,date,invoice_no,comp) values('$cid','$bid','$currentdate','$newinvoice_no','$comp')");


mysqli_
$sql5 = "select max(sendmysqli_rom send_bill";
mysqli_
$res5 = mysql_query($smysqli_

$row5 = mysql_fetch_row($res5);

$send_id=$row5[0];



$resul3=mysql_query("select cust_id,atmsite_address from ".$cid."_sites ");

                $ro3=mysql_fetch_row($resul3); 

                $cust_id1=$cid;

				

						

				$resul4=mysql_query("select id from contacts where short_name='$cust_id1'");

                $ro4=mysql_fetch_row($resul4); 

                $uid1=$ro4[0];

				

                $resul5=mysql_query("select * from address_book where ref_id='$uid1'");

                $addrow1=mysql_fetch_row($resul5); 

                $resul6=mysql_query("select billname from billcompany where cust_id='$cust_id1'");

                $brow1=mysql_fetch_row($resul6); 

?>







<p>

</p>

<table width="997" cellpadding="0" cellspacing="0">

 <tr height="150px"><td>&nbsp;</td></tr>

  <tr height="17">

    <td height="17" width="393"><b>To,</b></td>

    <td width="300">&nbsp;</td>

     <td width="302" rowspan="8" align="right" valign="top"><table width="230" height="67" align="right" cellpadding="0" cellspacing="0">

  <col width="151" />

  <col width="72" />

  <tr height="18">

    <td height="19" colspan="2"><div align="left">Invoice No:-

    <?php 

    if($comp==1){

		echo "CSS";

	}else if($comp==2){

		echo "C&C";

	}else if($comp==3){

		echo "CS";

	}mysqli_
mysqli_
    ?>

    /EB/<?php echo $newinvoice_no; ?>/<?php if(date('m')>='4'){ echo date('Y')."-".date('y',strtotime('+1 year')); }else{ echo date('Y',strtotime('-1 year'))."-".date('y'); } ?></div></td>

  </tr>
mysqli_
  <tr height="20">mysqli_

    <td wmysqli_158" height="22"><div align="left">Date : <?php echo date("d.m.Y"); ?></div></td>
mysqli_
    <td width="22"><div align="left"></div></td>
mysqli_
  </mysqli_

  <!--<tr height="20">

    <td width="158" height="20"><div align="left">Bank : <?php echo $bid; ?></div></td>

    <td width="22"><div align="left"></div></td>

  </tr>-->

</table></td>

    

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[3]; ?></td>

    </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>

    </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>

    </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>

    </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>

    </tr>

<tr height="18">

    <td height="18" colspan="2"><?php echo "Phone:".$addrow1[11]; ?></td>

    </tr>

    <td height="18" colspan="2"></td>

     </tr>

</table>





<table width="995" height="185" border="0">

  <tr>

  <td width="989" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Electricity Bills.</td>

  </tr>

  <tr><td>



<form method="post" action="showEbill.php" ><table width="988" border="1" cellpadding="4" cellspacing="0">

  <tr>

    <th width="28" scope="col"><div align="center">Sr No. </div></th>

    <th width="44" scope="col" ><div align="center">BANK</div></th>

    <th width="44" scope="col" ><div align="center">SITE ID</div></th>

      <th width="75" scope="col" ><div align="center">ATM ID</div></th>

       <th width="185" scope="col" >

         <div align="center">CONSUMER NO.</div>       </th> 

    <th width="90" scope="col" ><div align="center">LOCATION</div></th>

  

    <th width="53" scope="col" colspan="2"><div align="center">BILLING PERIOD </div></th>       

   <!-- <th width="47" scope="col">DUE DATE </th> -->      

    <th width="48" scope="col"><div align="center">PAID DATE</div></th>  

     <th width="83" scope="col"><div align="center">BILL DATE </div></th>

        <th width="67" scope="col"><div align="center">UNITS</div></th> 

          <!--<th width="62" scope="col"><div align="center">MONTH</div></th> -->   

    <th width="72" scope="col"><div align="center"> AMOUNT</div></th>   

      

  </tr>

  <?php $sum=0;$schrg=0;

        for($i=0;$i<$cb;$i++)///$i=0

             {

				

           // echo "select * from ebdetails where bill_no='$bills[$i]'";;

              $n1sql = "select * from ebdetails where bill_no='$bills[$i]'";

              $result1 = mysql_query($n1sql);

              $row1 = mysql_fetch_row($result1);

			  $num=mysql_num_rows($result1);

                $nsql = "select * from ".$cid."_ebill where ATM_ID='$row1[1]'"; //echo $nsql;

				 //$nsql = "select * from ebdetails where site_id='SN000523'";

                $result = mysql_query($nsql);

             

		$row = mysql_fetch_row($result);

		

		$sqll="update ebdetails set print='y' where bill_no='$bills[$i]'";

	$ress = mysql_query($sqll);

		//echo "select location from sites where atm_id1='$row[3]'";

		    $res=mysql_query("select atmsite_address,site_id from ".$cid."_sites where atm_id1='$row[3]'");

                $rows=mysql_fetch_row($res); 

                $location=$rows[0];

				              

			 $sum=$sum+$row1[4];	

			 $schrg=$schrg+$row[7];	

			 $month=date('F',strtotime($row1[7]));	

			

			$sql1 = "select * from  ebpayment where Bill_No='$bills[$i]'"; //echo $nsql;

                  $res1 = mysql_query($sql1);

				 

				 $row3 = mysql_fetch_row($res1);

				 

$res5=mysql_query("insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date) values('$send_id','$row1[1]','$row[2]','$location','$row[1]','$row1[2]','$row1[9]','$row1[3]','$row1[6]','$row1[7]','$month','$row1[4]','$row3[2]')");

				 	                                              

			?>

		 <tr><td height="28" align="center"><?php echo $i+1; ?></td>

         <td align="center"><?php echo $bid; ?></td>

		     <td align="center"><?php echo $rows[1]; ?></td>

             <td align="center"><?php echo $row[3]; ?></td>

             <td align="center"><?php echo $row[1]; ?></td>

			 <td align="center"><?php echo  $location; ?></td>

			 

			 <td align="center"><?php echo date('d/m/Y',strtotime($row1[6]));; ?></td>			 			              

			  <td align="center"><?php echo date('d/m/Y',strtotime($row1[7])); ?></td>			 			              

		      <td align="center"><?php  if(isset($row3[2]) and $row3[2]!='0000-00-00') echo date('d/m/Y',strtotime($row3[2])); //$bills[$i]; ?></td>

                <td align="center"><?php echo date('d/m/Y',strtotime($row1[2])); ?></td>

                 <td align="center"><?php echo $row1[3]; ?></td>

               		 			              

			 <td align="center"><?php echo $row1[4]; ?></td>			

                      

		</tr>

		<?php

	



		}

		

$res6=mysql_query("update send_bill set amount='".$sum."' where send_id='".$send_id."'");

?>

<tr><td colspan="11" align="right">&nbsp;<b>Total Billing Amount</b></td>

<td align="center"><?php echo $sum.".00" ?></td></tr>

<tr><td height="29" colspan="12"><b>[Rs.  <?php $st=int_to_words($sum); echo $st; ?>  ]</b>

</td></tr>

</table>

</form>



</br><table width="100%"><tr><td width="50%" align="center">For <?php echo $rowcomp[1]; ?></td><td width="50%" align="center">For <?php echo $rowcomp[1]; ?></td></tr></table></br></br>



<div>

<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>

<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table></div>



    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>







</td></tr>

</table></div><br/><br/>

<center><a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 

onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 1 </font></a><br/></center>

<?php

        

/////////////////////////////////////	

$atm=$row[3];	

    

	$result3=mysql_query("select cust_id,atmsite_address from ".$cid."_sites where atm_id1='$atm'");

                $row3=mysql_fetch_row($result3); 

                $cust_id=$row3[0];

				

						

				$result4=mysql_query("select id from contacts where short_name='$cust_id'");

                $row4=mysql_fetch_row($result4); 

                $uid=$row4[0];

				

                $result5=mysql_query("select * from address_book where ref_id='$uid'");

                $addrow=mysql_fetch_row($result5); 

                $result6=mysql_query("select billname from billcompany where cust_id='$cust_id'");

                $brow=mysql_fetch_row($result6); 

     

	  

	 

			?>

			<div id='back' >

			

			<table width="991">

            <tr height="150px"><td></td></tr>

            <tr><td align="center"><b>TAX INVOICE</b>	</td></tr>

            <tr><td width="983">

			<table cellspacing="0" cellpadding="0" align="right">

  <col width="151" />

  <col width="72" />

  <tr height="18">

    <td height="18" colspan="2">Invoice No:-  <?php 

    if($comp==1){

		echo "CSS";

	}else if($comp==2){

		echo "C&C";

	}else if($comp==3){

		echo "CS";

	}

    ?>

    /EB/<?php echo $newinvoice_no; ?>-A/<?php if(date('m')>='4'){ echo date('Y')."-".date('y',strtotime('+1 year')); }else{ echo date('Y',strtotime('-1 year'))."-".date('y'); } ?></td>

  </tr>

  <tr height="20">

    <td width="208" height="20">Bill Date : <?php echo date("d.m.Y"); ?></td>

    <td width="4">&nbsp;</td>

  </tr>

  <tr height="20">

    <td width="208" height="20"><!--Bank : <?php echo $bid; ?>--></td>

    <td width="4">&nbsp;</td>

  </tr>

</table>



 <table cellspacing="0" cellpadding="0">

 

  <tr height="17">

    <td height="17" width="74"><b>To,</b></td>

    <td width="189">&nbsp;</td>

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[3]; ?></td>

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[5]; ?></td>

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[6]; ?></td>

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[7]."-".$addrow1[9]; ?></td>

  </tr>

  <tr height="18">

    <td height="18" colspan="2"><?php echo $addrow1[8].",".$addrow1[10]; ?></td>

  </tr>

<tr height="18">

    <td height="18" colspan="2"><?php echo "Phone:".$addrow1[11]; ?></td>

  </tr>

    <td height="18" colspan="2"></td>

  </tr>

</table>



<table width="981" border="1" cellpadding="4" cellspacing="0">

<tr>

<td height="21" colspan="5" align="center"><b>Bill For Service Charges of Electricity Bills Payment</b></td>

</tr>

<tr><td width="87"><b>Sr.No </b></td>



<td width="176"><b>Bank</b></td>



<td width="176"><b>ATM ID</b></td>

<td width="114"><b>Service Charges Amount</b> </td>

</tr><?php $to=$cb*$raterow[2]; ?>

<?php

$srno=0;

//echo $cb;

$to=0;

//echo "select * from ebillcharges where Bid='$bid' and Cid='".$cid."'";

 //$sl=mysql_query("select * from ebillcharges where Bid='$bid' and Cid='".$cid."'");

//$rs=mysql_fetch_row($sl);

for($i=0;$i<$cb;$i++)

{

$srno=$srno+1;

//echo "select * from ebdetails where bill_no='$bills[$i]'";

  $n1sql = "select * from ebdetails where bill_no='$bills[$i]'";

              $result1 = mysql_query($n1sql);

              $row1 = mysql_fetch_row($result1);

			 // echo "select bank from ".$cid."_sites where atm_id1='".$row1[1]."'";

			 $bnk=mysql_query("select bank from ".$cid."_sites where atm_id1='".$row1[1]."'");

$bnkro=mysql_fetch_row($bnk);

//echo "select * from ebillcharges where Bid='$bnkro[0]' and Cid='".$cid."'";

$sl=mysql_query("select * from ebillcharges where Bid='$bnkro[0]' and Cid='".$cid."'");

$rs=mysql_fetch_row($sl);		

?>

<tr>



<td width="176"><?php echo $srno; ?></td>

<td width="176"><?php echo $bnkro[0]; ?></td>

<td width="176"><?php echo $row1[1]; ?></td>

<td><?php

if($rs[2]=='')

$to=$to+0;

else

$to=$to+$rs[2];

if($rs[2]=='')

echo "00.00";

else

 echo $rs[2].".00"; ?></td>

</tr>

<?php

}

//echo "select * from ebillcharges where Bid='$bid' and Cid='".$cid."'"; 



if($rs[3]==0){



}

else{

echo $to;

$svt=$to*0.12;

$ec=$svt*0.02;

$shec=$svt*0.01;

$gtotal=$to+$svt+$ec+$shec;



function formatTwoDecimals($value, $trim)

{

   $after_comma = substr(strrchr($value, $trim), 0, 3);

   $in_front_of_comma = (int) $value;





   $final = $in_front_of_comma . $after_comma;



   return $final;

}



?><tr>

<td colspan="3" align="right">Service Tax@<?php echo $rs[3] ?>%</td><td><?php echo $svt ?></td></tr>

<td colspan="3" align="right"> Education Cess @<?php echo $rs[4] ?>%</td><td><?php echo $ec; ?></td></tr>

<td colspan="3" align="right">Secondary &amp; Higher Education Cess    @<?php echo $rs[5] ?>%</td><td><?php echo $shec; ?></td></tr>





  <td colspan="3" align="right"><b>Grand Total</b></td>

    <td><?php echo formatTwoDecimals($gtotal, "."); ?></td></tr>



<?php } ?>



</table><br/>

 <!--<p align="right">For :<?php //echo $rowcomp[1]; ?></p> --></br>

 <table width="983">

   <tr><td width="536">

  PAN    No:- <?php echo $rowcomp[2]; ?><br/>

      

Service    Tax No:- <?php echo $rowcomp[3]; ?> <br />

Service Category : Electricity Bill

</td><td width="435" valign="top">

For :<?php echo $rowcomp[1]; ?></td>

   </tr></table>



</br></br>

<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>

<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table>



</br></br>



    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>



</td></tr></table>

</div>



<br/><br/><center><a onclick='PrintDiv1(); 'href="#" onMouseOver="this.style.textDecoration='underline'" 

onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Page 2 </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

<a href="generateEbill.php?cid=<?php echo $cid ?>&bid=<?php echo $bid ?>" onMouseOver="this.style.textDecoration='underline'" 

onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Back </font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



 <!--<a href="Billexp1.php?id=<?php //echo $id ?>&cid=<?php //echo $cid ?>&bid=<?php //echo $bid ?>&comp=<?php //echo $comp ?>&bills=<?php //echo $cb; ?>" style="text-decoration:none; font-size:20px;" >Export To Excel</a>-->

</center>



</body>

</html>

<?php

 if($comp==1){

		$st= "CSS";

	}else if($comp==2){

		$st="C&C";

	}else if($comp==3){

		$st="CS";

	}

$bill_no=$st."/EB/".$newinvoice_no."/2012";

$bdate=date("d.m.Y");



$email=array("sshinde@cssindia.in", "pgupta@cssindia.in", "ebill@cssindia.in", "vimal@cssindia.in","accounts@cssindia.in","billdesk@cssindia.in","mailme.deepakjha@gmail.c");



$em=count($email);

for($i=0;$i<$em;$i++){

$pfw_header = "From: support@sarmicrosystems.in";



// EDIT My Contact Form, to yours

$pfw_subject = "eBill details ";



// EDIT to your email address

$pfw_email_to = "$email[$i]";



$pfw_message = "Company Name: \t $addrow1[3] \n\n"  

. "Bill No.: \t $bill_no \n\n"

."Bill Date: \t $bdate \n\n"

."Amount: \t $sum \n\n"

."Bank name: \t $bid \n";

@mail($pfw_email_to, $pfw_subject ,$pfw_message, $pfw_header ) ;

}

?>