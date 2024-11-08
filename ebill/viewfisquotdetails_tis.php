<?php

include("config.php");
$qid=$_GET['qid'];
//echo $qid;

/*

 function no_to_words($no)
    {   
     $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
        if($no == 0)
            return ' ';
        else {
    	$novalue='';
    	$highno=$no;
    	$remainno=0;
    	$value=100;
    	$value1=1000;       
                while($no>=100)    {
                    if(($value <= $no) &&($no  < $value1))    {
                    $novalue=$words["$value"];
                    $highno = (int)($no/$value);
                    $remainno = $no % $value;
                    break;
                    }
                    $value= $value1;
                    $value1 = $value * 100;
                }       
              if(array_key_exists("$highno",$words))
                  return $words["$highno"]." ".$novalue." ".no_to_words($remainno);
              else {
                 $unit=$highno%10;
                 $ten =(int)($highno/10)*10;            
                 return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".no_to_words($remainno);
               }
        }
    }
    //echo no_to_words(12345401);




*/
function no_to_words($num)
{

$no = round($num);
  // $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo "<b>"."(Rupees : ".strtoupper($result). "ONLY ) "."<b>";


}



?>



<html>
<head>
<script src="excel.js" type="text/javascript"></script>
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
<?php	
      
     
   
//echo "select * from quotation1 where qid='".$qid."'";   
$qry1=mysqli_query($con,"select * from quotation1_tis where id='".$qid."'");
$qrrow=mysqli_fetch_array($qry1);

$qrynm=mysqli_query($con,"select cust_name,site_id from $qrrow[2]_sites where cust_id='".$qrrow[2]."' ");
$qname=mysqli_fetch_array($qrynm);

?>

<div id="exptexcl" align="center"><br><br><br><br><br><br><br><br><br>
<center>
<table>
<tr><td colspan="14" align="center"><?php echo $qrrow[1]; ?></td></tr></table>
</center>

<table  border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 


<th width="10" style="font-weight:normal">Sr No</th>
<!--<th width="10" style="font-weight:normal">Vendor</th>-->
<th width="200" style="font-weight:normal">ATM ID</th>
<th width="450" style="font-weight:normal">Site Address</th>
<th width="200" style="font-weight:normal">State</th>
<th width="180" style="font-weight:normal" >Bank's Name</th>	
<th width="180" style="font-weight:normal" >Vendor Name</th>	
<th width="200" style="font-weight:normal">Zone</th>
<th width="180" style="font-weight:normal" >Segment</th>	
<th width="550" style="font-weight:normal">Job Description</th>
<th width="60" style="font-weight:normal">Qty</th>
<th width="200" style="font-weight:normal">Rates per Item</th>
<th width="200" style="font-weight:normal">Amount</th>



<?php

$qdet=mysqli_query($con,"select distinct(particular),sum(Total) from quotation_details_tis where qid='".$qid."'");
$gdeta=mysqli_fetch_array($qdet);

 $gpartnew=mysqli_query($con,"select * from quotation_details_tis where particular='".$gdeta[0]."' and qid='".$qid."'");
$gpartnewrws=mysqli_fetch_array($gpartnew);
$exceptn=$gpartnewrws[0];

$ct=1;


?>
<tr>
<td align="center"><?php echo $ct;?></td>
<!--<td align="center">CSS</td>-->
<td align="center"><?php echo $qrrow[3];?></td>
<td align="center" width="400"><?php echo $qrrow[6];?></td>
<td align="center"><?php echo $qrrow[8];?></td>
<td align="center"><?php echo $qrrow[4];?></td>
<td align="center"><?php echo "CSS";?></td>
<td align="center"><?php echo "";?></td>
<td align="center"><?php echo $gdeta[0];?></td>
<td ><?php echo "(a)".$gpartnewrws[3];?></td>
<td align="center"><?php echo round($gpartnewrws[5]);?></td>
<td align="center"><?php echo round($gpartnewrws[4]);?></td>
<td align="center"><?php echo round($gpartnewrws[6]);?></td>
</tr>






<?php

/*$getnum=mysqli_query($con,"select * from quotation_details where id='".$qid."'");
$num=mysqli_num_rows($qdet);*/

$qdetc=mysqli_query($con,"select distinct(particular) from quotation_details_tis where qid='".$qid."'");
$num=mysqli_num_rows($qdetc);
//echo $num;

$i=1;
 while($gdetca=mysqli_fetch_array($qdetc))
 {
 
 $gpart=mysqli_query($con,"select * from quotation_details_tis where particular='".$gdetca[0]."' and qid='".$qid."'");
if($i==1)
{
$str= 'b';
 while($gparta=mysqli_fetch_array($gpart))
 {
 if($gparta[0]!=$exceptn)
{
 ?>
 
 <tr>
 <td ></td>
 <td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>

 

 
 <td align="left">
 <?php echo "(".$str.")"." ".$gparta[3];?>
 </td>
 
 
 <td align="center">
 <?php echo round($gparta[5]);?>
 </td>
 
 <td align="center">
 <?php echo $gparta[4];?>
 </td>

 <td align="center">
 <?php echo round($gparta[6]);?>
 </td>
 
  
 

 

 </tr>
 
 
 
 <?php
 $str++;
 }
 }
 }
 else
 {
 $str2= 'b';

$fisnewq=mysqli_query($con,"select * from quotation_details_tis where particular='".$gdetca[0]."' and qid='".$qid."'");
$fisrws=mysqli_fetch_array($fisnewq);
$expn2=$fisrws[0];

 ?>
 
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
 <td align="center"><?php echo $gdetca[0];?></td>
 <td align="left">
 <?php echo "(".$str2.")"." ".$fisrws[3];?>
 </td>
<td align="center">
 <?php echo round($fisrws[5]);?>
 </td>
 
 <td align="center">
 <?php echo $fisrws[4];?>
 </td>

 <td align="center">
 <?php echo round($fisrws[6]);?>
 </td>
 

 <?php
 while($gparta=mysqli_fetch_array($gpart))
 {
 
 if($gparta[0]!=$expn2)
 {
 ?>
 
 
 
 
  <tr>

<td ></td>
 <td ></td>
 <td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>

 
 <td align="left">
 <?php echo "(".$str2.")"." ".$gparta[3];?>
 </td>
 
 
 <td align="center">
 <?php echo round($gparta[5]);?>
 </td>
 
 <td align="center">
 <?php echo $gparta[4];?>
 </td>

 <td align="center">
 <?php echo round($gparta[6]);?>
 </td>
 
  
 

 

 </tr>
 
 
 <?php
$str2++;
}
 }
 }
 $i++;
 }
 
 
?>
<tr>
<!--<td colspan="8" align="left"><?php echo no_to_words(round($gdeta[1])); ?></td>-->
<td colspan="8" align="left"></td>
<td colspan="3" align="center"><b>Total Amt<b></td>
<td align="center"><?php echo "<b>"."INR ".round($gdeta[1])."<b>";?></td>
</tr>

</table>
<div>
<table width="995" cellpadding="2" cellspacing="0" >
<tr height="50">
<td height="45"></td>
</tr>
<tr>
<td align="left">For Clear Secured Services Pvt Ltd</td>
<td colspan="8"></td>
</tr>
</table>
</div>
							
</div>
  &nbsp;&nbsp;&nbsp;
<input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('exptexcl');" />
<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	    
</center>
</body>
</head>
</html>
