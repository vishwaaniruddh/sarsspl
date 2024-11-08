<?php 
//session_start();
include("access.php");

include('config.php');

$tid=$_GET['tid'];

//echo $tid;

$qrym=mysqli_query($con,"select * from salary_generate_details where tid='".$tid."'");
$qrmrow=mysqli_fetch_array($qrym);

//echo count($reqs);

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
                       $w .= ' '. $nwords[$r];
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
<html>
<head>
<script type="text/javascript">     
        function PrintDiv(id) {   
       <!-- document.getElementById('hide').style.display='none';--> 
           var divToPrint = document.getElementById(id);
           
           var popupWin = window.open('', '_blank', 'width=800,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
</script>
</head>
<body>
<center>
<div id="ppdf" ><br><br><br><br><br><br><br><br><br>
<table width="995" border="0" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr><td width="600" >TO	</td><td>			<B>DATE :-<?php if($qrmrow[16]!='0000-00-00'){ echo $qrmrow[16]; }?> </B>	</td></tr>
<tr><td width="600" >ICICI BANK LTD.</td><td>			</td></tr>
<tr><td width="600" >SION BRANCH </td><td>			</td></tr>					
<tr><td width="600" >MUMBAI</td><td>			</td></tr>								
<tr><td width="600" ></td><td>			</td></tr>								
<tr><td width="600" ></td><td>			</td></tr>												
					
<tr><td width="600" >Respected Sir / Madam,</td><td>			</td></tr>	
<tr><td width="600" ></td><td>			</td></tr>																				
<tr><td width="600" >Please debit  on my a/c No. <?php echo $qrmrow[8]; ?> & my account recognised as</td><td>			</td></tr>													
<tr><td width="600" >Clear Secured Services Pvt. Ltd. Kindly credit to following accounts.	</td><td>			</td></tr>																					
</table>
<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<th width="10">Sr NO</th>
<th width="200px">Account Name</th>	
<th width="180px" align="center">Account No.</th>	
<th width="60">Amount</th>
<th width="200">Location</th>
<th width="200">Remarks</th>
<?php	
        $total=0;

       
    
$qry1=mysqli_query($con,"select distinct(accno) from salary_generate_details where tid='$tid'");
$ct=1;
while($qrrow=mysqli_fetch_array($qry1))
{

$gname=mysqli_query($con,"select * from salary_acc where accno='".$qrrow[0]."'");
$nmrow=mysqli_fetch_array($gname);


$nofrows=mysqli_num_rows($gname);
$locatn="";
if($nofrows>1)
{

$gloc=mysqli_query($con,"select location from salary_acc where accno='".$qrrow[0]."'");

$locnofrows=mysqli_num_rows($gloc);
$locarr=array();
while($locnrs=mysqli_fetch_array($gloc))
{
$locarr[]=$locnrs[0];
}
for($i=0;$i<count($locarr);$i++)
{
if($i==(count($locarr)-1))
{
$locatn.=$locarr[$i];
}else
{
$locatn.=$locarr[$i].",";
}
}


}
else
{
$locatn=$nmrow[6];
}


$amtsum=mysqli_query($con,"select sum(tamount) from salary_generate_details where tid='".$tid."' and accno='".$qrrow[0]."'");
$amtros=mysqli_fetch_array($amtsum);
?><div class=article>
<div class=title><tr>
<td width="10" align='center'><?php echo $ct++; ?></td>
<td width="200" align='left'><?php echo $nmrow[1]; ?></td>
<td width="180px"  align="center"><?php echo $nmrow[2]; ?></td>
<td width="60" align='right' style='padding-right:15px'><?php echo number_format($amtros[0],2); $total=$total+$amtros[0]; ?></td>
<td width="200" align='left'><?php echo $locatn; ?></td>
<td align='left' width="200"></td>
</tr></div></div>
<?php
 }
?>
<tr><td colspan=3 align='right' ><B>TOTAL AMOUNT</B></td><td align='right'  style='padding-right:15px'><B><?php echo number_format($total,2); ?></B></td><td></td><td></td></tr>
</table>
<table width="995" border="0" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr><td width="600" ><B><?php echo '(Rupees : '.int_to_words($total).' Only.)'; ?></B>	</td><td>				</td></tr>
<tr><td width="600" ></td><td>			</td></tr>
<tr><td width="600" ><B>Thanking You,</B></td><td>			</td></tr>					
<tr><td width="600" ><B>Yours Faithfully</B></td><td>			</td></tr>								
<tr><td width="600" >For Clear Secured Services Pvt. Ltd.</td><td>			</td></tr>								
<tr><td width="600" >&nbsp;</td><td>			</td></tr>																	
<tr><td width="600" >&nbsp;</td><td>			</td></tr>	
<tr><td width="600" ><B>Authorised Signatory</B></td><td>			</td></tr>													
<tr><td width="600" ></td><td>			</td></tr>																					
</table>										
</div><input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('ppdf');" />
<!--<input type="button" name="excl" id="excl" value="Export to Excel" onclick="window.open('salaryexp.php?tid=<?php echo $tid; ?>','_blank');" />-->
<br><br>
      <a href="salary_fr.php" >HOME</a>   

   
</center></body>
</head>
</html>
