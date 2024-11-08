<?php

//session_start();

include ("access.php");

//echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation']." ".$_SESSION['dept'];

?>

<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>CSS
		<?php echo $_SESSION['user']; ?>
	</title>

	<link href="style.css" rel="stylesheet" type="text/css" />

	<link href="menu.css" rel="stylesheet" type="text/css" />

	<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

	<script src="datepicker/datepick_js.js" type="text/javascript"></script>

	<script src="excel.js" type="text/javascript"></script>

	<script type="text/javascript">

		function isNumberKey(evt) {

			var charCode = (evt.which) ? evt.which : event.keyCode;

			if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))

				return false;



			return true;

		}

		function getbank(val, type) {

			//alert(val);



			//alert(num);

			//	document.getElementById('image').innerHTML="<img src='loading.gif' width='100px' height='50px'>";

			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

				xmlhttp = new XMLHttpRequest();

			}

			else {// code for IE6, IE5

				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

			}

			xmlhttp.onreadystatechange = function () {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {



					//alert(xmlhttp.responseText);

					document.getElementById('bank').innerHTML = '';

					document.getElementById('bank').innerHTML = xmlhttp.responseText;



					getproject(val, 'projectid');



				}

			}



			xmlhttp.open("GET", "getcustbank.php?val=" + val + "&type=" + type, true);

			xmlhttp.send();

			//alert("getcustbank.php?val="+val+"&type="+type);



		}

		function getproject(val, type) {

			if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

				xmlhttp = new XMLHttpRequest();

			}

			else {// code for IE6, IE5

				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

			}

			xmlhttp.onreadystatechange = function () {

				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {



					//alert(xmlhttp.responseText);

					document.getElementById('proj').innerHTML = '';

					document.getElementById('proj').innerHTML = xmlhttp.responseText;




					mysqli_
				}

			}


			mysqli_
			//alert("getebillproj.phmysqli_"+val+"&type="+type);
			mysqli_
			xmlhttp.open("GET", "getebillproj_threshhold.php?val=" + val + "&type=" + type, true);

			xmlhttp.send();





		}

		function searchById(a, b, perpg) {

			//alert(a+" "+b+" "+perpg);

			var ppg = '';

			if (perpg == '')

				ppg = '50';

			else

				ppg = document.getElementById(perpg).value;

			var cid = document.getElementById('cid').value;

			var bank = document.getElementById('bank').value;

			var proj = document.getElementById('proj').value;

			//alert(ppg);

			document.getElementById("datahere").innerHTML = "<center><img src=loader.gif></center>";



			HttPRequest = false;

			if (window.XMLHttpRequest) { // Mozilla, Safari,...

				HttPRequest = new XMLHttpRequest();

				if (HttPRequest.overrideMimeType) {

					HttPRequest.overrideMimeType('text/html');

				}

			} else if (window.ActiveXObject) { // IE

				try {

					HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");

				} catch (e) {

					try {

						HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");

					} catch (e) { }

				}

			}



			if (!HttPRequest) {

				alert('Cannot create XMLHTTP instance');

				return false;

			}



			var url = 'getthreshhold_val.php';

			var pmeters = "cid=" + cid + "&bank=" + bank + "&proj=" + proj + '&Page=' + b + '&perpg=' + ppg;

			//alert(pmeters);

			HttPRequest.open('POST', url, true);



			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			HttPRequest.setRequestHeader("Content-length", pmeters.length);

			HttPRequest.setRequestHeader("Connection", "close");

			HttPRequest.send(pmeters);



			//alert("gg"); 

			HttPRequest.onreadystatechange = function () {

				if (HttPRequest.readyState == 4) // Return Request

				{

					var response = HttPRequest.responseText;

					//alert(response);

					document.getElementById("datahere").innerHTML = response;

				}

			}

		}

	</script>

</head>

<body>

	<center>

		<?php include ("menubar.php"); ?>



		<h2 class="h2color">View Threshhold</h2>

		<table border="1" cellpadding="2" cellspacing="2">

			<tr>

				<td>

					<select name="cid" id="cid" required="required" onchange="getbank(this.value,'ebill');">
						<option value="">select Client</option>

						<?php

						// $result1 = mysqli_query($con,"SELECT DISTINCT cust_name, cust_id FROM sites where atm_id1 in (select ATM_ID from ebill where Active='Y')");
						
						$sql = "SELECT contact_first, short_name FROM contacts where type='c' and short_name in(select distinct(cust_id) from mastersites) order by contact_first ASC";

						//  if($_SESSION['custid']!='all')
						
						//  $sql.="  and short_name in ($cl)";
						


						//echo $sql;
						
						$result1 = mysqli_query($sql);

						// $result1 = mysqli_query($con,"SELECT DISTINCT s.cust_name, s.cust_id FROM sites s,ebill e where s.atm_id1 =e.ATM_ID and e.Active='Y'");
						
						while ($row1 = mysqli_fetch_row($result1)) { ?>

							<option value="<?php echo $row1[1]; ?>">
								<?php echo $row1[0]; ?>
							</option>

						<?php } ?>

					</select>

				</td>

				<td>

					<select name="bank" id="bank" required="required">
						<option value="">select Bank</option>
					</select>

				</td>

				<td>

					<select name="proj" id="proj" required="required">
						<option value="">select Project</option>
					</select>

				</td>

				<td>

					<input type="button" value="Search" onclick="searchById('Listing','1','');" />

				</td>

			</tr>

		</table>

		<div id="datahere"></div>

	</center>

	<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

	<script type="text/javascript" src="script.js"></script>

</body>

</html>