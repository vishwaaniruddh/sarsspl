<?php
$hostname='localhost'; //// specify host, i.e. 'localhost'
$user='kevalj_cncindi'; //// specify username
$pass='Satya1234sar56'; //// specify password
$dbase='kevalj_cncindia'; //// specify database name
$connection = mysqli_connect("$hostname" , "$user" , "$pass") 
or die ("Can't connect to MySQL");
mysqli_select_db($dbase , $connection) or die ("Can't select database.");
	
	if(isset($_POST['cmdsub']))
	{
	
                $contents.="Sr. No \t INVOICE NO1 \tINVOICE NO2 \tINVOICE Date \t CUSTOMER \t BANK\t Project ID \t ATM ID \t SITE ID  \t LOCATION \t SERVICE PROVIDER \t Billing Unit \t Meter No. \t CONSUMER NO \t FROM DATE \t TO DATE \t BILL DATE \t DUE DATE \t Opening Reading \t Closing Reading \t Unit \t PAID DATE \t Amount \t Landloard Name \t STATE \t SUPERVISOR NAME \t MONTH
";
		$sql = "SELECT `send_id`, `customer_name`, `bank`, `date`, `amount`, `invoice_no`, `comp`, `projectid`, `entrydt`, `invoice2`, `status`, `servchrg`, `createdby` FROM send_bill where status=0 and customer_name<>'' and customer_name='".$_POST['cust']."'"; //echo $sql;
		$cnt=0;	
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($result))
		{
		$det=mysqli_query($con,"select `detail_id`, `send_id`, `atm_id`, `electric_board`, `location`, `consumer_no`, `bill_date`, `due_date`, `units_consumed`, `usdate`, `uedate`, `month`, `paid_amount`, `paid_date`, `status`, `srvchrg`,reqid from send_bill_detail where send_id='".$row[0]."' and status=0");
		while($detro=mysqli_fetch_array($det)){
		$site=mysqli_query($con,"select atm_id1,site_id,state from ".$row[1]."_sites where trackerid='".$detro[2]."'");
		$sitero=mysqli_fetch_row($site);
		
		$mtr=mysqli_query($con,"select meter_no from mastersites where cust_id='".$row[1]."' and trackerid='".$detro[2]."'");
		$mtrno=mysqli_fetch_row($mtr);
		
		$land=mysqli_query($con,"select landlord from ".$row[1]."_ebill where  atmtrackid='".$detro[2]."'");
		$landro=mysqli_fetch_row($land);
		
		$read=mysqli_query($con,"select opening_reading,closing_reading,supervisor from ebillfundrequests where req_no='".$detro[16]."'");
		$readro=mysqli_fetch_row($read);
		$cnt=$cnt+1;
		$contents.="\n";
		$contents.=$cnt."\t";
			$contents.=$row[5]."\t";
			$contents.=$row[9]."\t";
                        $contents.=$row[3]."\t";
                        $contents.=$row[1]."\t";
                         $contents.=$row[2]."\t";
                         $contents.=$row[7]."\t";
                        $contents.=$sitero[0]."\t";
                        $contents.=$sitero[1]."\t";
                        $contents.=$detro[4]."\t";
                      $contents.=$detro[3]."\t";
                      $contents.=$detro[8]."\t";
                      $contents.=$mtrno[0]."\t";
                      $contents.=$detro[5]."\t";
                      $contents.=$detro[9]."\t";
                      $contents.=$detro[10]."\t";
                      $contents.=$detro[6]."\t";
                      $contents.=$detro[7]."\t";
                      $contents.=$readro[0]."\t";
                      $contents.=$readro[1]."\t";
                      $contents.=$detro[8]."\t";
                      $contents.=$detro[13]."\t";
                      $contents.=$detro[12]."\t";
                   //landlord name   
                   $contents.=$landro[0]."\t";
                   $contents.=$sitero[2]."\t";
                      $contents.=$readro[2]."\t";
                      $contents.=$detro[11]."\t";
                      
                        }		 	   			        
		}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("exportebill.csv", "w");
//$fwrite($fpWrite,$contents);
  header("Content-Disposition: attachment; filename=ebillinvoice.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  }
  ?>
	<form name="frm1" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
	<select name="cust">
	
	<?php
	$ct=mysqli_query($con,"Select short_name,contact_first from contacts where type='c'");
	while($ctro=mysqli_fetch_array($ct))
	{
	?>
	<option value="<?php echo $ctro[0]; ?>"><?php echo $ctro[1]; ?></option>
	<?php
	}
	?></select>
	<input type="submit" name="cmdsub" value="Submit">
	</form>
	