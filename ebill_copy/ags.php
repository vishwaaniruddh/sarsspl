<?php

session_start();

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

                   $w .= $nwords[floor($x/100)] .' Hundred'; 
mysqli_
                   $r = fmod($x, 100);
mysqli_
                   if($r > 0)

                   {

                       $w .= ' and '. int_to_words($r);

                   }

               } else if($x < 100000) 

               {

                   $w .= int_to_words(floor($x/1000)) .' Thousand';

                   $r = fmod($x, 1000);

                   if($r > 0)

         mysqli_    {
mysqli_
                    mysqli_.= ' '; 

                    mysqli_$r < 100)
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

        mysqli_ }
mysqli_
           }
mysqli_
           return $w;

       }mysqli_
mysqli_
$hostname='localhost'; //// specify host, i.e. 'localhost'

$user='smysqli_n_cncindi'; //// specify username
mysqli_
$pass='Satya1234sar56'; //// specify password

$dbase='satyavan_cncindia'; //// specify database name
mysqli_
$connection = mysql_cmysqli_("$hostname" , "$user" , "$pass") 

or die ("Can't connect to MySQL");
mysqli_
mysql_select_db($dbase , mysqli_ction) or die ("Can't select database.");
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

                $cust_name=$cid;

           $rowcomp=mysql_fetch_row($rescomp); 

$qry1=mysql_query("select * from ebillcharges where Cid='$cid' and Bid='$bid'");  

//echo mysql_num_rows($qry1); 

if(mysql_num_rows($qry1)>0)         



mysqli_
mysqli_
mysqli_


mysqli_

mysqli_


mysqli_

   $raterowmysqli__fetch_row($qry1); 
mysqli_
   else

   {

    $qr=mysql_query("select * from ebillcharges where Cid='$cid' and Bid='All'");  

    $raterow=mysql_fetch_row($qr); 
mysqli_
   }
mysqli_
 ?>
mysqli_
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Untitled Document</title>

<style type="text/css">

<!--

.style1 {

	color: #0080FF;

	font-weight: bold;

}

body {

	background-color: #FFFFFF;

}



mysqli_
mysqli_
</style>

</head>



<body>

<script type="text/javascript">     

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

          mysqli_Win.document.open();
mysqli_
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');

            popupWin.document.close();
mysqli_
                }mysqli_

     </script>
mysqli_
<div id='front'>mysqli_
mysqli_
 mysqli_

<?php 

$currentdate=date('Y-m-d');

$sql5 = "select max(invoice_no) from send_bill where comp='$comp'";

$res5 = mysql_query($sql5);

$row5 = mysql_fetch_row($res5);

$newinvoice_no=$row5[0]+1;

$res4=mysql_query("insert into send_bill(customer_name,bank,date,invoice_no,comp) values('$cid','$bid','$currentdate','$newinvoice_no','$comp')");



$sql5 = "select max(send_id) from send_bill";

$res5 = mysql_query($sql5);

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



<table width="867">

<tr height="150px"><td>&nbsp;</td></tr>

  <tr><td width="597">Invoice No:-

          <?php 

    if($comp==1){

		echo "CSS";

	}else if($comp==2){

		echo "C&C";

	}else if($comp==3){

		echo "CS";

	}

    ?>
mysqli_
/EB/mysqli_echo $newinvoice_no; ?>/2013-14</td>

  <td width="258"><div align="left">Date : <?php echo date("d.m.Y"); ?></div></td>

</tr><tr><td>  Bank : 

      <?php echo $bid; ?></td></tr></table>

<table width="995" height="185" border="0">

 <!-- <tr>

  <td width="989" height="45"><b>Sub:</b>&nbsp;&nbsp;  Reimbursement Of Actual Expense Of Electricity Bill Payment</td>

  </tr>-->

  <tr><td>



<form method="post" action="showEbill.php" ><table border="1" cellspacing="0" cellpadding="4">

  <tr>

    <th width="24" scope="col"><div align="center">Sr No. </div></th>

    <th width="37" scope="col" ><div align="center">ATM ID</div></th>

    <th width="37" scope="col" ><div align="center">SITE ID</div></th>

      <th width="82" scope="col" ><div align="center">ELECTRICITY BOARD</div></th>

      <!-- <th width="185" scope="col" ><div align="center">LOCATION</div></th> -->

    <th width="81" scope="col" ><div align="center">CONSUMER NO.</div></th>

   <th width="76" scope="col" ><div align="center">CONSUMER NAME</div></th>

    <th width="44" scope="col"><div align="center">BILL DATE </div></th>       

    <th width="38" scope="col">DUE DATE </th>       

    <th width="71" scope="col"><div align="center">UNIT CONSUMED</div></th>  

     <!-- <th width="83" scope="col"><div align="center">USAGE START DATE </div></th>

        <th width="67" scope="col"><div align="center">USAGE END DATE </div></th> -->

          <th width="58" scope="col"><div align="center">MONTH</div></th>    

    <th width="60" scope="col"><div align="center">AMOUNT</div></th>  

      <th width="59" scope="col"><div align="center">INVOICE NO</div></th>  

      <th width="49" scope="col"><div align="center">PAID DATE</div></th>

           <th width="65" scope="col"><div align="center"> Last Sub-meter Reading</div></th>

           <th width="56" scope="col"><div align="center"> Rate of the Sub-meter Unit</div></th>

    

  </tr>

  <?php $sum=0;$schrg=0;

  $atm="";

        for($i=0;$i<$cb;$i++)///$i=0

             {

				

            

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

		

		    $res=mysql_query("select location,site_id from ".$cid."_sites where atm_id1='$row[3]'");

                $rows=mysql_fetch_row($res); 

                $location=$rows[0];

				              

			 $sum=$sum+$row1[4];	

			 $schrg=$schrg+$row[7];	

			 $month=date('F',strtotime($row1[7]));	

			

			$sql1 = "select * from  ebpayment where Bill_No='$bills[$i]'"; //echo $nsql;

                  $res1 = mysql_query($sql1);

				 

				 $row3 = mysql_fetch_row($res1);

				 

$res5=mysql_query("insert into send_bill_detail(send_id,atm_id,electric_board,location,consumer_no,bill_date,due_date,units_consumed,usdate,uedate,month,paid_amount,paid_date) values('$send_id','$row1[1]','$row[2]','$location','$row[1]','$row1[2]','$row1[9]','$row1[3]','$row1[6]','$row1[7]','$month','$row1[4]','$row3[2]')");

			if($i==0)

           		 $atm=$row1[1];

           		 else

           		  $atm=$atm.",".$row1[1];	 	                                              

			?>

		 <tr><td height="28" align="center"><?php echo $i+1; ?></td>

		     <td align="center"><?php echo $row[3]; ?></td>

             <td align="center"><?php echo $rows[1]; ?></td>

             <td align="center"><?php echo $row[2]; ?></td>

             <!--<td align="center"><?php echo  $location; ?></td>-->

			 <td align="center"><?php echo $row[1]; ?></td>

			 <td align="center"><?php echo $row[5]; ?></td>

			 <td align="center"><?php echo date('d/m/Y',strtotime($row1[2]));; ?></td>			 			              

			  <td align="center"><?php echo date('d/m/Y',strtotime($row1[9])); ?></td>			 			              

			   <td align="center"><?php echo $row1[3]; ?></td>

                <!--<td align="center"><?php echo date('d/m/Y',strtotime($row1[6])); ?></td>

                 <td align="center"><?php echo date('d/m/Y',strtotime($row1[7])) ?></td>-->

                  <td align="center"><?php echo $month; ?></td>



               			 			              

			 <td align="center"><?php echo $row1[4]; ?></td>	

             <td align="center"><?php echo $newinvoice_no; ?></td>		

             <td align="center"><?php  if(isset($row3[2]) and $row3[2]!='0000-00-00') echo date('d/m/Y',strtotime($row3[2])); //$bills[$i]; ?></td>  

             <td align="center">-&nbsp;</td>	

             <td align="center">-&nbsp;</td>	        

		</tr>

		<?php

	



		}

	$ins=mysql_query("INSERT INTO `satyavan_cncindia`.`invoiceebillatm` (`id`, `sendid`, `atmid`) VALUES (NULL, '".$send_id."', '".$atm."')");	

$res6=mysql_query("update send_bill set amount='".$sum."' where send_id='".$send_id."'");

?>

<tr><td colspan="9">&nbsp;</td>

<td><b>Total</b></td>

<td align="center"><?php echo $sum.".00" ?></td><td></td></tr>

<!--<tr><td height="29" colspan="13"><b>[Rs.  <?php $st=int_to_words($sum); echo $st; ?>  ]</b>

</td></tr>-->

</table></form>



</br></br></br>







   <!-- <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>-->





<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>

<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table>





</td></tr>

</table>







<br/><br/>

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

			

			<table height="564" border="1" bordercolor="#000000">

           <tr height="150px"><td>&nbsp;</td></tr>

            <tr><td width="983">

            <table width="985" border="1">

              <tr><td>

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

			</td><td valign="top">



 <table width="332" align="right" cellpadding="0" cellspacing="0">

  <tr><td>From- <?php echo $rowcomp[1]; ?></td></tr>

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

    /EB/<?php echo $newinvoice_no; ?>-A/2013-14</td>

  </tr>

  <tr height="20">

    <td width="208" height="20">Date : <?php echo date("d.m.Y"); ?></td>

    <td width="4">&nbsp;</td>

  </tr>

  <tr height="20">

    <td width="208" height="26">Bank : <?php echo $bid; ?></td>

    <td width="4">&nbsp;</td>

  </tr>

   

</table></td></tr></table>



<table width="982" height="261" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000">

<tr><td colspan="5">PARTICULARS</td><td>AMOUNT</td><td></td></tr>

<tr>

<td height="186" colspan="5" align="left"><b>As per enclosed annexture, Electricity Invoice of Amount.</b><br /><br /><br /><br />

Service Tax No : AADCC5952HST001<br />

PAN. No : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AADCC5952H<br />

Service Category : Electricity Bill</td>

<td width="80" align="right" valign="top"><br />

  <br /><br /><?php //echo  $to=$cb*$raterow[2];

  echo $sum; ?></td>

<td width="79">&nbsp;</td>

</tr>



<?php

//echo "select * from ebillcharges where Bid='$bid' and Cid='".$cid."'";

/*$sl=mysql_query("select * from ebillcharges where Bid='$bid' and Cid='".$cid."'");

$rs=mysql_fetch_row($sl); 

if($rs[3]==0){



}

else{



echo $to;

$svt=$to*0.12;

$ec=$svt*0.02;

$shec=$svt*0.01;

$gtotal=$to+$svt+$ec+$shec;*/

		function formatTwoDecimals($value, $trim)

{

   $after_comma = substr(strrchr($value, $trim), 0, 3);

   $in_front_of_comma = (int) $value;





   $final = $in_front_of_comma . $after_comma;



   return $final;

}

			





?><!--<tr>

<td colspan="5" align="right">Service Tax@<?php echo $rs[3]; ?>%</td><td width="424" align="right"><?php echo $svt; ?></td><td></td>

</tr>

<td colspan="5" align="right"> Education Cess @<?php echo $rs[4]; ?>%</td><td align="right"><?php echo $ec; ?></td><td></td></tr>

<td colspan="5" align="right">Secondary &amp; Higher Education Cess    @<?php echo $rs[5]; ?>%</td><td align="right"><?php echo $shec; ?></td><td></td></tr>-->

<tr>





  <td colspan="5" align="right"><b> Total</b></td>

    

    <td align="right"><?php echo formatTwoDecimals($sum, "."); ?></td>

    <td></td>

</tr>



<?php //} ?>

</table>

<br/>

<div>

<table width="100%"><tr><td align="center" width="50%"><?php echo $_SESSION['user']; ?><br />E-Bill Executive</td>

<td width="50%" align="center">Bharat Pundit<br />E-Bill Head</td></tr></table></div>

<br/></br>

 

</br></br></br></br>



    <div  align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>



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



$email=array("sshinde@cssindia.in", "pgupta@cssindia.in", "ebill@cssindia.in", "vimal@cssindia.in","accounts@cssindia.in","billdesk@cssindia.in","mailme.deepakjha@gmail.com");



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