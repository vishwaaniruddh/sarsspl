<?php
$hostname='localhost'; //// specify host, i.e. 'localhost'
$user='satyavan_cncindi'; //// specify username
$pass='Satya1234sar56'; //// specify password
$dbase='satyavan_cncindia'; //// specify database name
$connection = mysqli_connect("$hostname" , "$user" , "$pass") 
or die ("Can't connect to MySQL");
mysqli_select_db($dbase , $connection) or die ("Can't select database.");
	
              //  echo "SELECT * FROM ".$_GET['cid']."_sites";
              $qr=mysqli_query($con,"select short_name from contacts where type='c'");
              while($qrro=mysqli_fetch_array($qr))
              {
		$sql = "SELECT * FROM ".$qrro[0]."_sites"; //echo $sql;
			//echo $sql."<br>";
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($result))
		{	$contents.=$row[0]."\t";
                        $contents.=$row[1]."\t";
                        $contents.=$row[2]."\t";
                        $contents.=$row[3]."\t";
                        $contents.=$row[4]."\t";
                        $contents.=$row[5]."\t";
                        $contents.=$row[6]."\t";
                        $contents.=$row[7]."\t";
                        $contents.=$row[8]."\t";
                        $contents.=$row[9]."\t";
                        $contents.=$row[10]."\t";
                        $contents.=$row[11]."\t";
                        $contents.=$row[12]."\t";
                        $contents.=$row[13]."\t";
                        $contents.=$row[14]."\t";
                        $contents.=$row[15]."\t";
                        $contents.=$row[16]."\t";
                        $contents.=$row[17]."\t";
                        $contents.=$row[18]."\t";
                        $contents.=$row[19]."\t";
                        $contents.=$row[20]."\t";
                        $contents.=$row[21]."\t";
                        $contents.=$row[22]."\t";
                        $contents.=$row[23]."\t";
                        $contents.=$row[24]."\t";
                        $contents.=$row[25]."\t";
                        $contents.=$row[26]."\t";
                        $contents.=$row[27]."\t";
                        $contents.=$row[28]."\t";
                        $contents.=$row[29]."\t";
                        $contents.=$row[30]."\t";
                        $contents.=$row[31]."\t";
                        $contents.=$row[32]."\t";
                        $contents.=$row[33]."\t";
                        $contents.=$row[34]."\t";
                        $contents.=$row[35]."\t";
                        $contents.=$row[36]."\t";
                        $contents.=$row[37]."\t";
                        $contents.=$row[38]."\t";
                        $contents.=$row[39]."\t";
                        $contents.=$row[40]."\t";
                        $contents.=$row[41]."\t";
                        $contents.=$row[42]."\t";
                        $contents.=$row[43]."\t";
                        $contents.=$row[44]."\t";
                        $contents.=$row[45]."\t";
                        $contents.=$row[46]."\t";
                        $contents.=$row[47]."\t";
                        $contents.=$row[48]."\t"; // escape internalt commas
                        $contents.=$row[49]."\t";
                        $contents.=$row[50]."\t";
                        $contents.=$row[51]."\t";
                        $contents.=$row[52]."\t";
                        $contents.=$row[53]."\t";
                        $contents.=$row[54]."\n";		 	   			        
		}
		}
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("C:\\export.csv", "w");
//fwrite($fpWrite,$contents);
  header("Content-Disposition: attachment; filename=export.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
  
?>
<script type="text/javascript">
window.close();
</script>