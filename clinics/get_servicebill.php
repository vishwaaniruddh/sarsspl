<?php
include 'config.php';
$strPage = $_REQUEST['Page'];
if ($_REQUEST['mode'] == "Listing") {
	if (isset($_REQUEST['id']) && isset($_REQUEST['fname'])) {

		######## process of opd report  #############	
		$id = $_REQUEST['id'];
		$fname = $_REQUEST['fname'];
		$query = "select * from servicebill where id like('" . $id . "%') and serv_name like('" . $fname . "%')";
	} else if (isset($_REQUEST['fname'])) {


		$fname = $_REQUEST['fname'];
		$getdata = "select * from servicebill where serv_name like('" . $fname . "%')";
		$pdata = mysqli_fetch_assoc(mysqli_query($con, $getdata));
		$id = $pdata['id'];
		$query = "select * from servicebill where id = '" . $id . "'";
	} else if (isset($_REQUEST['id'])) {

		$id = $_REQUEST['id'];
		$query = "select * from servicebill where id like('" . $id . "%') ";
	} else {

		$query = "select * from servicebill";
	}

	$result = mysqli_query($con, $query);
	if (!$result) {
		mysqli_error($con);
	}

	$Num_Rows = mysqli_num_rows($result);

	########### pagins

	$Per_Page = 10;   // Records Per Page

	$Page = $strPage;
	if (!$strPage) {
		$Page = 1;
	}

	$Prev_Page = $Page - 1;
	$Next_Page = $Page + 1;


	$Page_Start = (($Per_Page * $Page) - $Per_Page);
	if ($Num_Rows <= $Per_Page) {
		$Num_Pages = 1;
	} else if (($Num_Rows % $Per_Page) == 0) {
		$Num_Pages = ($Num_Rows / $Per_Page);
	} else {
		$Num_Pages = ($Num_Rows / $Per_Page) + 1;
		$Num_Pages = (int)$Num_Pages;
	}

	$query .= " order  by id ASC LIMIT $Page_Start , $Per_Page";
	$result = mysqli_query($con, $query);

	if (!$result) {
		mysqli_error($con);
	}
}
?> 
<table width="1215" border="1" id="results" cellpadding="4" cellspacing="0">


	<tr>
		<td width="20" style="color:#ac0404; font-size:14px; font-weight:bold;">ID</td>
		<td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Bill No.</td>

		<td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Patient Name</td>
		<td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Age/Sex</td>
		<td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Contact</td>
		<td width="60" style="color:#ac0404; font-size:14px; font-weight:bold;">Address</td>

		<td width="30" style="color:#ac0404; font-size:14px; font-weight:bold;">Amount</td>
		<td width="20" style="color:#ac0404; font-size:14px; font-weight:bold;">Action</td>
	</tr>

	<?php
	$intRows = 0;
	if (mysqli_num_rows($result)) {
		while ($row = mysqli_fetch_array($result)) {
	?>

			<tr>
				<td> <?php echo $row[0]; ?></td>				
				<td> <?php echo $row[9]; ?></td>				
				<td> <?php echo $row[1]; ?></td>				
				<td> <?php echo $row[2]; ?></td>				
				<td> <?php echo $row[3]; ?></td>
				<td> <?php echo $row[4]; ?></td>				
				<td> <?php echo $row[5]; ?></td>
				<td> <a href='bill_print.php?billno=<?php echo $row[9]; ?>'> Print </a></td>

			</tr><?php
					$intRows++;
					?>

		<?php

		}
		echo "</table>";
		?>

		<div class="pagination" style="width:100%;">
			<font size="4" color="#000">
				<!--Total <?php //echo $Num_Rows;
							?> Record : -->
				<?php
				// } 
				if ($Prev_Page) {
					echo " <li><a href=\"JavaScript:searchById('Listing','$Prev_Page')\"> << Back</a> </li>";
				}

				for ($i = 1; $i <= $Num_Pages; $i++) {
					if ($i != $Page) {
						echo " <li><a href=\"JavaScript:searchById('Listing','$i')\">$i</a> </li>";
					} else {
						echo "<li class='currentpage'><b> $i </b></li>";
					}
				}
				if ($Page != $Num_Pages) {
					echo " <li><a href=\"JavaScript:searchById('Listing','$Next_Page')\">Next >></a> </li>";
				}
				?>
			</font>
		</div>
	<?php
		############
	} else {
		echo "<div class='error'>No Records Found!</div>";
	}


	################ home end

	?>