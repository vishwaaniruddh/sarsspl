<?php 
session_start();
//echo $_SESSION['user'];
if(!isset($_SESSION['user']))
header('location:index.php');

include("config.php");
 $sql=$_POST['qrrr'];
  $cid=$_POST['cid'];
  //echo $sql;
	$table=mysqli_query($con,$sql);
if(!$table)
echo mysqli_error();
$count=0;
$invro=mysqli_fetch_array($table);
 $result=mysqli_query($con,"select id from contacts where short_name='$cid'");
                $row=mysqli_fetch_row($result); 
                $uid=$row[0];
//echo "select * from address_book where ref_id='$uid'";
                $result=mysqli_query($con,"select * from address_book where ref_id='$uid'");
                $addrow=mysqli_fetch_row($result); 
                $result=mysqli_query($con,"select billname from billcompany where cust_id='$cid'");
                $brow=mysqli_fetch_row($result); 
			
$cl=mysqli_query($con,"select contact_first from contacts where type='c' and short_name='$cid'");
$clr=mysqli_fetch_row($cl);	
$result = mysqli_query($con,$sql);
if(!$result)
echo mysqli_error();
		$num=mysqli_num_rows($result);
//echo $_SESSION['token']." ".$tok;	
//if($id!=2) echo "You are not authorised to see this page";
// header('Location:managesite1.php?id='.$id); 
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
include("config.php");


			
              	
//echo "select * from company_details where compid='$comp'";
$cust_id1=$cid;
				
					//echo "select id from contacts where short_name='$cust_id1'";	
				$resul4=mysqli_query($con,"select id from contacts where short_name='$cust_id1'");
                $ro4=mysqli_fetch_row($resul4); 
                $uid1=$ro4[0];
				//echo "select * from address_book where ref_id='$uid1'";
                $resul5=mysqli_query($con,"select * from address_book where ref_id='$uid1'");
                $addrow1=mysqli_fetch_row($resul5); 
                $resul6=mysqli_query($con,"select billname from billcompany where cust_id='$cust_id1'");
                $brow1=mysqli_fetch_row($resul6); 
 ?>
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
	margin-top:100pt;
}

/*#front {
   position:relative;
   display:table;
   table-layout:fixed;
   padding-top:25px;
   padding-bottom:20px;
   width: 94%;
   height:auto;
}*/
/*@page {
      margin: 80px;
   }*/
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
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
				 function PrintDiv2() {    
           var divToPrint = document.getElementById('page3');
           var popupWin = window.open('', '_blank', 'width=800,height=500');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
<div id="front"><br><br><br><br><br>
<table cellpadding="0" cellspacing="0" align="left" border="1" width="624">
    <tbody>
        <tr>
            <td colspan="2" valign="top" width="624">
                <p align="center">
                    <strong>DEBIT NOTE</strong>
                </p>
            </td>
        </tr>
       
        <tr>
            <td colspan="2" valign="top" width="624">
                <table><tr><td width="50%" valign="top"> To,
                <table>
                <tr height="18">
    <td height="18" colspan="2"><b><?php echo $addrow1[3]; ?></b></td>
    </tr>
                 <?php if($addrow1[18]!=''){ ?><tr height="18">
    <td height="18" colspan="2"><b><?php echo nl2br($addrow1[18]); ?></b></td>
    </tr><?php }else{ ?>
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

    <?php } ?>
                </table>
                </td>
                   <td valign="top" align="left" style="padding-left:80px">DB Note : <?php echo $invro[2]."-".$invro[7]; ?>
                    <?php
                  // $old = substr($invro[0],5,9);
		//echo $old;
		//$l = substr($row['id'],2,2);
		
		 $newinvoice_no=$invro['inv_no'];
		//echo $new;
		if($newinvoice_no<=9)
		  $newinvoice_no ="000".$newinvoice_no ;
		if($newinvoice_no>9 && $newinvoice_no <=99)
		 $newinvoice_no = "00".$newinvoice_no ;
		if($newinvoice_no>99 && $newinvoice_no <=999)
		 $newinvoice_no = "0".$newinvoice_no ;
		 
                    echo  $newinvoice_no."A"; ?> 
                    <br>Date &nbsp;:&nbsp; <?php echo date('d-M-Y',strtotime($invro[8])); ?></br>
                    </td></tr></table>
                
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" width="624">
                <p>
                    Electricity Accounts:
                <br>
                    Your above account with us has been debited for Rs: <strong><?php echo $invro[4]; ?></strong>/- as per attached annexure.
                </p>
            </td>
        </tr>
        <tr>
            <td rowspan="3" valign="top" width="348">&nbsp;
            </td>
             
            <td valign="middle" width="276">Amount
            </td>
        </tr>
      
        <tr>
            <td valign="top" width="276">&nbsp;
            </td>
        </tr><tr>
            <td valign="top" width="276">&nbsp;
            </td>
        </tr>
        <tr>
            <td valign="top" width="348">
               
                    Account opening Balance
                
            </td><td valign="top" width="348">
               &nbsp;
                 
                
            </td>
            
        </tr>
        <tr>
            <td valign="top" width="348">
            </td>
            <td valign="top" width="276">
            </td>
        </tr>
        <tr height="80px">
            <td valign="top" width="348">
                <p>
                    EB paid as per Annexure
                </p>
            </td>
            <td valign="top" width="276">
                <p>
                    <strong><?php echo number_format($invro[4],0); ?>/-</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="1">&nbsp;
            </td> <td valign="top" colspan="1">&nbsp;
            </td>
            
        </tr>
        <tr>
           <td valign="top" colspan="1">&nbsp;
            </td> <td valign="top" colspan="1">&nbsp;
            </td>
        </tr>
        <tr>
           <td valign="top" colspan="1">&nbsp;
            </td> <td valign="top" colspan="1">&nbsp;
            </td>
        </tr>
        <tr>
           <td valign="top" colspan="1">&nbsp;
            </td> <td valign="top" colspan="1">&nbsp;
            </td>
            
        </tr>
        <tr>
           <td valign="top" colspan="1">&nbsp;
            </td> <td valign="top" colspan="1">&nbsp;
            </td>
        </tr>
        <tr>
            <td valign="top" width="348">
                <p>
                    Account Closing Balance
                </p>
            </td>
            <td valign="top" width="276">&nbsp;
            </td>
        </tr>
        <tr>
            <td valign="top"  colspan="2"><hr size="3" style='background:black'>
            </td>
            
        </tr>
        <tr style="height:100pt;">
            <td valign="top" width="348">
                <p>
                    <strong>[Rupees in word:</strong>
                    <strong><?php echo int_to_words($invro[4]); ?>Only]</strong>
                </p>
            </td>
            <td valign="top" width="276">&nbsp;
            </td>
        </tr>
    </tbody>
</table>

</div>

<a onclick='PrintDiv();' href="#" onMouseOver="this.style.textDecoration='underline'" 
onmouseout="this.style.textDecoration='none'" ><font size='+2' color="#993333"> Print Debit Note </font></a>
</body></html>