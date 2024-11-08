<?php $Totalamt="0";?>

<b style="margin-left: 38%;font-size:30px" id="total"> </b>

					<table  border="3" align="center" cellspacing="10" cellpadding="10">
					<tr><center>
				
				<th>Description</th>
				<th>Amount</th>
			
				</center>
				</tr>
				<?php
				  include("config.php");
				 $client=$_POST['cid'];
				  $frm=$_POST['frmdt'];
					 $to=$_POST['todt'];
				
				 if($client=="ALL")
				 {
				  $query=mysqli_query($con,"select sum(AMOUNT),DISCRIPTION FROM Online_TransferData where TRANSFER_DATE  between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') group by DISCRIPTION");
				 }
				 else
				 {
				 $query=mysqli_query($con, "select sum(AMOUNT),DISCRIPTION FROM Online_TransferData where DISCRIPTION='".$client."'  and  TRANSFER_DATE  between STR_TO_DATE('".$frm."','%d/%m/%Y') and STR_TO_DATE('".$to."','%d/%m/%Y') group by DISCRIPTION ");
				 }
					
					
					while($row=mysqli_fetch_row($query))
					{
				
						
					?><tr>
					
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[0]; ?></td>
				
						</tr><?php
				$Totalamt+=$row[0];
				
					}
				
					?>
					<tr>
					    <td><b>Total :</b></td><td><b><?php echo $Totalamt; ?></b></td>
					</tr>
					
					
				</table>
				</center>
				<script>
				    $("#total").text("Total Amt :"+<?php echo $Totalamt;?>)
				</script>