<?php
include("config.php");
 $tables=array('AGS01_sites','cor_sites','DIE002_sites','EPS_sites','EUR08_sites','FIS03_sites','FSS04_sites','ksb_sites','NCR09_sites','PRIZM07_sites','Ratnakar_sites','SBI_sites','Tata05_sites','TSIPL06_sites','VS_sites');
	$contents='';
	      $msql="SHOW COLUMNS FROM satyavan_cncindia.".$_GET['cid']."_sites";
              //$msql="SHOW COLUMNS FROM satyavan_cncindia.".$tab;
              $mresult = mysqli_query($con,$msql);
              $x=0;
              //$contents="SN\t";
              while($mrow=mysqli_fetch_row($mresult))
              {
                if($x<=50)
                $contents.=$mrow[0]."\t";
                else if($x==52)
                $contents.=$mrow[0]."\t";
                else if($x==54)
                $contents.=$mrow[0]."\n";
                $x++;
              }
              //  echo "SELECT * FROM ".$_GET['cid']."_sites";
              foreach($tables as $tab){$y=0;
		//$sql = "SELECT * FROM ".$_GET['cid']."_sites where (housekeeping='Y' or caretaker='Y' or maintenance='Y')"; // and active='Y'"; //echo $sql;
		$sql = "SELECT * FROM ".$tab." where (housekeeping='Y' or caretaker='Y' or maintenance='Y')";	
		$result = mysqli_query($con,$sql);
		while($row = mysqli_fetch_row($result))		
		{	//$contents.=++$y."\t";
		$contents.=$row[54]."\t";
		        
                        $contents.=str_replace("\n","",$row[1])."\t";
                        $contents.=str_replace("\n","",$row[2])."\t";
                        $contents.=str_replace("\n","",$row[3])."\t";
                        $contents.=str_replace("\n","",$row[4])."\t";
                        $contents.=str_replace("\n","",$row[5])."\t";
                        $contents.=str_replace("\n","",$row[6])."\t";
                        $contents.=str_replace("\n","",$row[7])."\t";
                        $contents.=str_replace("\n","",$row[8])."\t";
                        $contents.=str_replace("\n","",$row[9])."\t";
                        $contents.=str_replace("\n","",$row[10])."\t";
                        $contents.=str_replace("\n","",$row[11])."\t";
                        $contents.=str_replace("\n","",$row[12])."\t";
                        $contents.=str_replace("\n","",$row[13])."\t";
                        $contents.=str_replace("\n","",$row[14])."\t";
                        $contents.=str_replace("\n","",$row[15])."\t";
                        $contents.=str_replace("\n","",$row[16])."\t";
                       
                        $contents.=str_replace("\n","",$row[17])."\t";
                        $contents.=str_replace("\n","",$row[18])."\t";
                        $contents.=str_replace("\n","",$row[19])."\t";
                        $contents.=str_replace("\n","",$row[20])."\t";
                        $contents.=str_replace("\n","",$row[21])."\t";
                        $contents.=str_replace("\n","",$row[22])."\t";
                        $contents.=str_replace("\n","",$row[23])."\t";
                        $contents.=str_replace("\n","",$row[24])."\t";
                        $text = preg_replace('/\s+/', ' ', str_replace("\n","",$row[25]));
                        $contents.=$text."\t";
                        $contents.=str_replace("\n","",$row[26])."\t";
                        $contents.=str_replace("\n","",$row[27])."\t";
                        $contents.=str_replace("\n","",$row[28])."\t";
                        $contents.=str_replace("\n","",$row[29])."\t";
                        $contents.=str_replace("\n","",$row[30])."\t";
                        $contents.=str_replace("\n","",$row[31])."\t";
                        $contents.=str_replace("\n","",$row[32])."\t";
                        $contents.=str_replace("\n","",$row[33])."\t";
                        $contents.=str_replace("\n","",$row[34])."\t";
                        $contents.=str_replace("\n","",$row[35])."\t";
                        $contents.=str_replace("\n","",$row[36])."\t";
                        $contents.=str_replace("\n","",$row[37])."\t";
                        $contents.=str_replace("\n","",$row[38])."\t";
                        $contents.=str_replace("\n","",$row[39])."\t";
                        $contents.=str_replace("\n","",$row[40])."\t";
                        $contents.=str_replace("\n","",$row[41])."\t";
                        $contents.=str_replace("\n","",$row[42])."\t";
                        $contents.=str_replace("\n","",$row[43])."\t";
                        $contents.=str_replace("\n","",$row[44])."\t";
                        $contents.=str_replace("\n","",$row[45])."\t";
                        $contents.=str_replace("\n","",$row[46])."\t";
                        $contents.=str_replace("\n","",$row[47])."\t";
                        $contents.=str_replace("\n","",$row[48])."\t"; // escape internalt commas
                        $contents.=str_replace("\n","",$row[49])."\t";
                        
                        $contents.=str_replace("\n","",$row[50])."\t";
                         $contents.=str_replace("\n","",$row[52])."\t";
                         $contents.=str_replace("\n","",$row[0])."\n";		 	   			        
		} }
$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
 // header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
  header("Content-Disposition: attachment; filename=sites.xls");
  header("Content-Type: application/vnd.ms-excel");
  print $contents;
  
  
?>
<!--<script type="text/javascript">
window.close();
</script>-->