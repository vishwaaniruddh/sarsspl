<?php echo include("config.php");?>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="script.js"></script>

<form name="frm1" id="frm1" method="post" enctype="multipart/form-data">
<div id="maind" align="center">
<div align="center">
<!--<input type="text" name="incr" id="incr" value="1" />-->
<input type="hidden" name="partcount" id="partcount" value="1" />


<div align="center">

<table id="myTable" style="width:840px" border="2" align="center">


<th>Particulars</th>
<th style="width:30px">Quantity</th>
<th >Rate</th>
<th>Service tax</th>
<th>Amount</th>
<th>Code(For Tata)</th>
<th >Uom(For Tata)</th>
<th></th>
<th></th>



<?php 

$id=$_POST['id'];
$sendid=$_POST['sendid'];


 $getinvm1=mysqli_query($con,"select * from  rnm_invoice where send_id='".$sendid."'");
   $mnrow1=mysqli_fetch_array($getinvm1);
   
   
   
   $getanexdets1=mysqli_query($con,"select * from  rnm_invoice_details where send_id='".$sendid."' and id='".$id."'  ");
            

 while($annexrows1=mysqli_fetch_array($getanexdets1))
   {
      
       $gtdetsfrmquot1=mysqli_query($con,"select * from quotation1 where id='".$annexrows1["qid"]."'");
       $gdtsrwss1=mysqli_fetch_array($gtdetsfrmquot1);
       
       $qrynm=mysqli_query($con,"select cust_name from $gdtsrwss1[2]_sites where cust_id='".$gdtsrwss1[2]."' ");
$qname=mysqli_fetch_array($qrynm);
       
$edqry2=mysqli_query($con,"Select distinct(particular) from Rnm_quotation_details where qid='".$gdtsrwss1[0]."' ");

$gtot2=mysqli_query($con,"Select sum(Total) from Rnm_quotation_details where qid='".$gdtsrwss1[0]."'");
$rowtot=mysqli_fetch_array($gtot2);
$partid=1;
$descid=1;
?>


<?php

while($rowqry2=mysqli_fetch_array($edqry2))
{

?>
    <tr>


 <td width="190" align="left" colspan="8">
  <input type="text" name="part" id="part<?php echo $partid; ?>"  value="<?php echo $rowqry2[0]; ?>" readonly="readonly"/>
 
  </td>

</tr>
<?php
 //echo "select * from Rnm_quotation_details where particular='".$rowqry2[0]."' and qid='".$gdtsrwss1[0]."'";
  $subqry2=mysqli_query($con,"select * from Rnm_quotation_details where particular='".$rowqry2[0]."' and qid='".$gdtsrwss1[0]."'");
  //echo "select * from quotation_details where particular='".$rowqry2[0]."' and qid='".$qid."'";
  $numr=mysqli_num_rows($subqry2);
  //$subrow=mysqli_fetch_array($subqry2);


  while($subrow=mysqli_fetch_array($subqry2))
{
//print_r($subrow);
?>

  <tr>
  <td align="center" width="400" >
         <input type="hidden" style="width:30px" name="id"  id="id<?php echo $descid; ?>" value="<?php echo $subrow[0]; ?>" readonly="readonly" />
         <input type="text" style="width:200px" name="pr"  id="pr<?php echo $descid; ?>" value="<?php echo $subrow[3]; ?>"  />
  </td>

  <td align="center">
     
       <input style="width:30px" type="text" name="prc" id="prc<?php echo $descid; ?>" value="<?php  echo $subrow[4]; ?>" />
  </td>

  


   <td align="center">
       <input style="width:55px" type="text" name="rate" id="rate<?php echo $descid; ?>" value="<?php  echo $subrow[5]; ?>" onblur="calc(this.id);" />
  </td>
  <!--******************add by priyanka******************-->
 <td align="center">
       <input style="width:55px" type="text" name="stx1" id="stx<?php echo $descid; ?>" value="<?php  echo $subrow[9]; ?>" onblur="Stx(this.id);" />
  </td>
  <!--*******-->
  
    <td align="center">
       <input style="width:55px" type="text" name="amt1[]" id="amt<?php echo $descid; ?>" value="<?php  echo $subrow[6]; ?>" onblur="calct(this.id);" />
  </td>


 

   <td align="center">
       <input style="width:55px" type="text" name="tcode" id="tcode<?php echo $descid; ?>" value="<?php  echo $subrow[7]; ?>" />
  </td>
  
  <td align="center">
     
       <input style="width:150px" type="text" name="descdet" id="descdet<?php echo $descid; ?>" value="<?php  echo $subrow[8]; ?>" />
  </td>

  
  <td align="center">
       <input type="button" style="width:55px" type="button" name="upd" id="upd<?php echo $descid; ?>" value="Update" onclick="updfunc(this.id)"/>
  </td>
  
      <td align="center">
       <input type="button" style="width:55px" type="button" name="del" id="del<?php echo $descid; ?>" value="Delete" onclick="delfunc(this.id)"/>
  </td>




</tr> 








<?php

$descid++;

?>
<!--
<script>

document.getElementById("incr").value=<?php echo $descid ;?>;

</script>
-->
<?php
}

$partid++;
?>
<input type="hidden" name="incr" id="incr" value="<?php if($descid==""){ echo '1'; }else{ echo $descid+1 ;}?>" />
<script>
document.getElementById('partcount').value="<?php echo $partid;?>";
</script>

<?php } ?>

 <input type="hidden" name="qotid1" id="qotid1" value="<?php echo $gdtsrwss1[0]; ?>" readonly="readonly"/>

<?

}
?>

</table>
<br>
<table style="width:790px" border="2" align="center">

<tr>
<td colspan="7" width="300"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total" id="total" readonly="readonly" value="<?php echo $rowtot[0];?>" ><input type="hidden" name="fprevt" id="fprevt" value="<?php echo $rowtot[0];?>"/></td>
</tr>
<tr>
<td width="150">Remark</td>
<td align="center"><textarea name="rem" id="rem" ></textarea></td>
<td  width="150">Attach email</td>
<td ><input type="file" name="email_cpy" id="email_cpy"></td>

</tr>
</table>
 
<center>
    <!--<input type="button" name="addp" id="addp" onclick="anand()" value="Add Particulars"/>-->
<input type="button" name="addp" id="addp"  value="Add Particulars"/>

<input type="button" name="bck" id="bck" value="Back" onclick="location.href='ViewQuot_invoice_Details.php?sendId='+<?php echo $sendid ;?>"  />

</center>
 

<center>
</div>






<table style="display:none"  id="hiddent">
 <tr>
  <td width="190" align="left" colspan="8">
  <input type="text" />
 
  </td>
  </tr>
  
   <tr>
   
   
  <td align="center" width="400" >
         
         <input type="text" style="width:200px"  />
  </td>

  <td align="center">
     
       <input style="width:30px" type="text"  />
  </td>


   <td align="center">
       <input style="width:55px" type="text"  onblur="calc1(this.id);"/>
  </td>

<td align="center">
       <input style="width:55px" type="text"  onblur="Stfx1(this.id);"/>
  </td>

    <td align="center">
       <input style="width:55px" type="text" readonly="readonly"/>
  </td>

<td align="center">
     
       <input style="width:55px" type="text"  />
  </td>

  <td align="center">
     
       <input style="width:150px" type="text"  />
  </td>


</tr> 


</table>

	
<div id="tabed" >
<table id="edtable" style="width:840px;display:none"  border="2" align="center">
<th>Particulars</th>
<th style="width:30px">Quantity</th>
<th>Rate</th>
<th>Service Taxx</th>
<th>Amount</th>
<th>Code(For Tata)</th>
<th>UOM(For Tata)</th>
</table>
<table style="display:none;width:840px"  border="2" align="center" id="totable">
<tr>
<td colspan="9" width="650"  align="center"><b>TOTAL</b></td>
<td align="left"><input type="text" name="total1" id="total1" readonly="readonly"  ></td>
</tr>
</table>
<div align="center" id="hbutton" style="display:none"><input type="button" value="Submit" onclick="submitpart();"></div>
</div>



</div></div>



</form>

