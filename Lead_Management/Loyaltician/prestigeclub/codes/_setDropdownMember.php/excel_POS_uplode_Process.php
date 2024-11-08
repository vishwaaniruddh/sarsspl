<?php
session_Start(); ?>
<html>

<head>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>


	<?php
	include ("config.php");
	$counter = 0;

	function fromExcelToLinux($excel_time)
	{
		return ($excel_time - 25569) * 86400;
	}



	require_once 'Excel/reader.php';
	// ExcelFile($filename, $encoding);
	$data = new Spreadsheet_Excel_Reader();


	// Set output Encoding.
	$data->setOutputEncoding('CP1251');


	$maxsize = '800';

	$size = ($_FILES['userfile']['size'] / 1024);

	if ($size > $maxsize) {
		echo "Your file size is " . $size;
		echo "File is too large to be uploaded. You can only upload " . $maxsize . " KB of data. Please go back and try again";
	} else {

		define("MAX_SIZE", "100");

		$fichier = $_FILES['userfile']['name'];

		function getExtension($str)
		{
			$i = strrpos($str, ".");
			if (!$i) {
				return "";
			}
			$l = strlen($str) - $i;
			$ext = substr($str, $i + 1, $l);
			return $ext;
		}


		if ($fichier) {

			$filename = stripslashes($_FILES['userfile']['name']);

			//get the extension of the file in a lower case format
			$extension = getExtension($filename);
			$extension = strtolower($extension);

			$image_name = time() . '.' . $extension;

			$newname = "POS_excel_img/" . $image_name;
			///echo $newname;	
	
			$copied = copy($_FILES['userfile']['tmp_name'], $newname);

			if (!$copied) {
				echo '<h1>Copy unsuccessfull!</h1>';
				$errors = 1;
			}
		}
		$error = 0;


		$data->read($newname);


		error_reporting(E_ALL ^ E_NOTICE);
		$ab = array();
		$contents = '';

		for ($x = 2; $x <= $data->sheets[0]['numRows']; $x++) {
			//echo $x." <br>";
	
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

				$ab = $data->sheets[0]['cells'][$x];
				///echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
	
			}// end j ka for loop
	

			$dat = $ab[4];

			if ($ab[4] != "" && $ab[4] != "-") {
				$RETRUNED_DATE = fromExcelToLinux($ab[4]);
				$Dt = date("Y-m-d", $RETRUNED_DATE);
			} else {
				$Dt = '0000-00-00';
			}


			/*
			$excel_date = $dat; //here is that value 41621 or 41631
			$unix_date = ($excel_date - 25569) * 86400;
			$excel_date = 25569 + ($unix_date / 86400);
			$unix_date = ($excel_date - 25569) * 86400;
			$Dt= gmdate("Y-m-d", $unix_date);
			*/


			if (strlen($ab[2]) == 8) {
				$type = "1";
			} else if (strlen($ab[2]) == 11) {
				$type = "2";
			} else {
				$type = "3";
			}

			$dupQ = mysqli_query($conn, "SELECT * FROM `POS_table` WHERE BillDate='" . $Dt . "' and CheckNo='" . $ab[6] . "'");

			if (mysqli_num_rows($dupQ) == "0") {




				$result = "insert into POS_table(City,CertificateNumber,Time,BillDate,POS_code,CheckNo,No_of_Pax,No_of_paxClose,TenderMediaNumber,FoodAmt,FoodDiscAmt,SoftBevAmt,SoftBevDiscAmt,IndianLiqAmt,IndianLiqDiscAmt,ImpLiqAmt,ImpLiqDiscAmt,TobaccoAmt,TobaccoDiscAmt,MiscAmt,MiscDiscAmt,Tips,AutomaticServiceCharge,NettAmount,TotalTaxCollected,GrossTotal,CashierNumber,type) values('" . $ab[1] . "','" . $ab[2] . "','" . $ab[3] . "','" . $Dt . "','" . $ab[5] . "','" . $ab[6] . "','" . $ab[7] . "','" . $ab[8] . "','" . $ab[9] . "','" . $ab[10] . "','" . $ab[11] . "','" . $ab[12] . "','" . $ab[13] . "','" . $ab[14] . "','" . $ab[15] . "','" . $ab[16] . "','" . $ab[17] . "','" . $ab[18] . "','" . $ab[19] . "','" . $ab[20] . "','" . $ab[21] . "','" . $ab[22] . "','" . $ab[23] . "','" . $ab[24] . "','" . $ab[25] . "','" . $ab[26] . "','" . $ab[27] . "','" . $type . "')";
			} else {
				$result = "insert into POS_table_Duplicate(City,CertificateNumber,Time,BillDate,POS_code,CheckNo,No_of_Pax,No_of_paxClose,TenderMediaNumber,FoodAmt,FoodDiscAmt,SoftBevAmt,SoftBevDiscAmt,IndianLiqAmt,IndianLiqDiscAmt,ImpLiqAmt,ImpLiqDiscAmt,TobaccoAmt,TobaccoDiscAmt,MiscAmt,MiscDiscAmt,Tips,AutomaticServiceCharge,NettAmount,TotalTaxCollected,GrossTotal,CashierNumber,type) values('" . $ab[1] . "','" . $ab[2] . "','" . $ab[3] . "','" . $Dt . "','" . $ab[5] . "','" . $ab[6] . "','" . $ab[7] . "','" . $ab[8] . "','" . $ab[9] . "','" . $ab[10] . "','" . $ab[11] . "','" . $ab[12] . "','" . $ab[13] . "','" . $ab[14] . "','" . $ab[15] . "','" . $ab[16] . "','" . $ab[17] . "','" . $ab[18] . "','" . $ab[19] . "','" . $ab[20] . "','" . $ab[21] . "','" . $ab[22] . "','" . $ab[23] . "','" . $ab[24] . "','" . $ab[25] . "','" . $ab[26] . "','" . $ab[27] . "','" . $type . "')";
			}

			$runresult = mysqli_query($conn, $result);
			$Lid = mysqli_insert_id($conn);

			$atmid = mysqli_insert_id($conn);

			if (!$runresult) {
				echo "failed" . mysqli_error($conn);
			} else {
				?>

				<script type="text/javascript">

					swal({
						title: "Success!",
						text: "Thank you, Data uploaded Successfully.!",
						icon: "success",
						// buttons: true,
						dangerMode: true,
					})
						.then((willDelete) => {
							if (willDelete) {

								window.open("excel_POS_uplode.php", "_self");

							}
						});



					//alert("Data uploaded successfully");
					//window.location='prospect_view.php';
				</script>
			<?php
			}


		}//end x ka for loop
//end sales site
	
		//header('location:newsite.php');
//}
//}
	}//print $contents;
	
	if (count($err) > 0) {
		$contents = strip_tags($contents); // remove html and php tags etc. str_replace(',', '\,', $row[faqdesk_answer_short])
//$fpWrite = fopen("export.csv", "w");
//fwrite($fpWrite,$contents);
		// header("Content-Disposition: attachment; filename=".$_GET['cid'].".xls");
		header("Content-Disposition: attachment; filename=rejectedsites.xls");
		header("Content-Type: application/vnd.ms-excel");
		print $contents;
		//echo "<br>";
		echo "<script type='text/javascript'>window.location='prospect_view.php';</script>";

	} else {
		?>
		<!--<script type="text/javascript">
alert("Data uploaded successfully");
window.location='prospect_view.php';
</script>
-->
		<?php
	}
	///print_r($data);
////print_r($data->formatRecords);
	?>