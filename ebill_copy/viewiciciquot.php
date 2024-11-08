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
<?php	
      
     
   
//echo "select * from quotation1 where qid='".$qid."'";   
$qry1=mysqli_query($con,"select * from quotation1 where id='".$qid."'");
$qrrow=mysqli_fetch_array($qry1);



?>

<div id="exptexcl" align="center"><br><br><br><br><br><br><br><br><br>

<table ALIGN="CENTER">

<tr><td colspan="14" align="center"><?php echo $qrrow[1]; ?></td></tr></table>


<table width="995" border="1" cellpadding="2" cellspacing="0"  id="custtable" style="margin-top:5px;"> 
<tr><td >SOL ID:<?php echo $qrrow[3]; ?></td></tr>
<tr><td colspan="10"><?php echo  "Branch Name:-".$qrrow[6]." ". " ( "."Sol ID-".$qrrow[3].")";?> </td></tr>

<tr><td colspan="10"></td></tr>

<th width="10" style="font-weight:normal">Sr No</th>
<th width="500" style="font-weight:normal">Material Text</th>
<th width="150" style="font-weight:normal">Material Group</th>	
<th width="150" style="font-weight:normal" >Service No</th>	
<th width="85" style="font-weight:normal">Gross Price</th>
<th width="75" style="font-weight:normal">Quantity</th>
<th width="80" style="font-weight:normal">Unit</th>
<th width="85" style="font-weight:normal">Amount</th>
<th width="250" style="font-weight:normal">Remark</th>




<?php
//echo "select * from icici_quot_details where qid='".$qid."'";
$qdet=mysqli_query($con,"select * from icici_quot_details where qid='".$qid."'");
$tamt=0;
$ct=1;
while($gdeta=mysqli_fetch_array($qdet))

{

?>
<tr>
<td align="center"><?php echo $ct;?></td>
<td align="center"><?php echo $gdeta[4];?></td>
<td align="center"><?php echo $gdeta[2];?></td>
<td align="center"><?php echo $gdeta[3];?></td>

<td align="center"><?php echo $gdeta[5];?></td>
<td align="center"><?php echo $gdeta[6];?></td>
<td align="center"><?php echo $gdeta[7];?></td>
<td align="center"><?php echo round($gdeta[8]); $tamt=$tamt+round($gdeta[8]); ?></td>
<td align="center"><?php echo $gdeta[9];?></td>


</tr>



<?php

$ct++;
 }
 
 
?>
<tr>
<td colspan="7" align="left"></td>
<td align="center"><?php echo "<b>".round($tamt)."<b>";?></td>
</tr>

</table>
<div>
<table width="995" cellpadding="2" cellspacing="0" >
<tr height="50">
<td height="45"></td>
</tr>
<tr>
<td align="left">For Clear Secured Services Pvt Ltd</td>
<td colspan="13"></td>
</tr>
</table>
</div>
							
</div>
<center>
&nbsp;&nbsp;&nbsp;
<input type="button" name="GENERATE" id="GENERATE" value="PRINT PDF" onclick="PrintDiv('exptexcl');" />
<input type="button" id="exp" onclick="tableToExcel('exptexcl', 'Table Export Example')" value="Export To Excel"/>	
   </center>   
</center>
</body>
</head>
</html>
