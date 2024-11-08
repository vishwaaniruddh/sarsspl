<?php
session_start();
include('config.php');
$id=$_POST['uid'];
?>
<table   border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
                <tr>
					     
                    <th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Uploaded by</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Date Of booking</p></th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Section position</p>	</th>
					<th class="table-header-repeat line-left minwidth-1"><p style="font-size:16px; color:#FFF;">Rate Total Amount</p>	</th>
                    <div class="clearfix"> </div>
							
			    </tr>
	
                       <tr>	
				
<?php

$qryforSliderSlotRat=mysql_query("select * from slider_slot_rate where id='".$id."'");
$fetc=mysql_fetch_array($qryforSliderSlotRat);

 $sldid=$fetc[1];
//$f= date("Y-m-d", strtotime($fetc[3]));
$t= date("Y-m-d", strtotime($fetc[4]));

//$qry=mysql_query("select * from advertise_booking where slot='".$sldid."' AND  dt BETWEEN '".$f."' AND '".$t."'");
$qry=mysql_query("select * from advertise_booking where slot='".$sldid."' AND  dt = '".$t."' ");


while($fetch=mysql_fetch_array($qry))
{
$qrypro=mysql_query("select name from clients where code='".$fetch[1]."'");
$fetchp=mysql_fetch_array($qrypro);

$qrypron=mysql_query("select name from adsslotdetails where id='".$fetc[1]."'");
$fetchn=mysql_fetch_array($qrypron);
?> 	                    

                    		<td><span><?php echo $fetchp[0];?></span></td>
							<td><span><?php echo $fetch[2];?></span></td>
							<td><span><?php echo $fetchn[0].">>".$fetch[5];?></span></td>
                            <!-- <td><span><?php $total=$fetchp[3]*$fetch[1];$tl=$tl+$total;echo $total; ?></span></td>-->
							<td><span><?php echo $fetch[6];?></span></td>

							<!--single.html--><div class="clearfix"> </div>
				</tr>		

<?php
}
$i++;
?>

</table>