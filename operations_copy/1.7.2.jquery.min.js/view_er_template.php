<?php 

//include("access.php");

session_start();

include("config.php");



?>

<?php 

//echo $_SESSION['designation'];

if($_SESSION['designation']=='11')

	$_SESSION['custid']='all';

 

 //echo $_SESSION['user'];

 //echo  $_SESSION['custid'];

 ?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>EBill Recharge-<?php echo $_SESSION['user']; ?></title>

<link href="style.css" rel="stylesheet" type="text/css" />

<link href="menu.css" rel="stylesheet" type="text/css" />

<!--datepicker-->

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />

<script src="datepicker/datepick_js.js" type="text/javascript"></script>

<!--Slide down div  -->

<script src="js/jquery.min.js.js" type="text/javascript"></script>

 

 

 

 

<style> 

body {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: .8em;

	}

 

/* the div that holds the date picker calendar */

.dpDiv {

	}

 

 

/* the table (within the div) that holds the date picker calendar */

.dpTable {

	font-family: Tahoma, Arial, Helvetica, sans-serif;

	font-size: 12px;

	text-align: center;

	color: #505050;

	background-color: #ece9d8;

	border: 1px solid #AAAAAA;

	}

 

 

/* a table row that holds date numbers (either blank or 1-31) */

.dpTR {

	}

 

 

/* the top table row that holds the month, year, and forward/backward 



buttons */

.dpTitleTR {

	}

 

 

/* the second table row, that holds the names of days of the week (Mo, 



Tu, We, etc.) */

.dpDayTR {

	}

 

 

/* the bottom table row, that has the "This Month" and "Close" buttons 



*/

.dpTodayButtonTR {

	}

 

 

/* a table cell that holds a date number (either blank or 1-31) */

.dpTD {

	border: 1px solid #ece9d8;

	}

 

 

/* a table cell that holds a highlighted day (usually either today's 



date or the current date field value) */

.dpDayHighlightTD {

	background-color: #CCCCCC;

	border: 1px solid #AAAAAA;

	}

 

 

/* the date number table cell that the mouse pointer is currently over 



(you can use contrasting colors to make it apparent which cell is being 



hovered over) */

.dpTDHover {mysqli_query($con,

	background-color: #aca998;

	border: 1px solid #888888;

	cursor: pointer;

	color: red;
mysqli_query($con,
	}

 

 

/* the table cell that holmysqli_query($con,of the month and the year */

.dpTitleTD {

	}

 

 

/* a table cell that holds one of the forward/backward buttons */

.dpButtonTD {

	}

 

 

/* the table cell that holds the "This Month" or "Close" button at the 



bottom */

.dpTodayButtonTD {

	}

 

 

/* a table cell that holds the names of days of the week (Mo, Tu, We, 



etc.) */

.dpDayTD {

	background-color: #CCCCCC;

	border: 1px solid #AAAAAA;

	color: white;

	}

 

 

/* additional style information for the text that indicates the month 



and year */

.dpTitleText {

	font-size: 12px;

	color: gray;

	font-weight: bold;

	}

 

 

/* additional style information for the cell that holds a highlighted 



day (usually either today's date or the current date field value) */ 

.dpDayHighlight {

	color: 4060ff;

	font-weight: bold;

	}

 

 

/* the forward/backward buttons at the top */

.dpButton {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	padding: 0px;

	}

 

 

/* the "This Month" and "Close" buttons at the bottom */

.dpTodayButton {

	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: gray;

	background: #d8e8ff;

	font-weight: bold;

	}

 

</style> 



<script src="php_calendar/scripts.js" type="text/javascript"></script>

</head>



<body>

<center>

<?php include("menubar.php"); ?>

</center>

<div align="center">

  <h2 class="style1">View Recharge Template</h2>

</div>

<div >

<table id="myTable" border="1">

	<tr align="center">

		<th>Template </th>

		<th>Supervisor </th>

		<th>Select Client </th>

		<th>Total Amount </th>

		<th>Edit</th>

		<th>Requset</th>

	</tr>

	<?php

		//echo "select * from recharge_template where status=1";

		$view_temptlate=mysqli_query($con,"select * from recharge_template where status=1");

		if($view_temptlate>0)

		{

			while($row=mysqli_fetch_array($view_temptlate))

			{

	?>

	<tr>

		<td align="center"><b><?php echo $row['tmt_id']; ?></b></td>

		<td><?php echo $row['supervisor']; ?></td>

		<td><?php $str=mysqli_query($con,"Select contact_first from contacts where type='c' and short_name='".$row['cust_id']."'");

					$contact=mysqli_fetch_row($str);

					echo $contact[0];

				    ?>

		</td/>

            	<td><?php 

            				//echo "select sum(amount) from recharge_template_details where tmt_id=".$row['tmt_id']." and status=1";

            				$tamt_qry=mysqli_query($con,"select sum(amount) from recharge_template_details where tmt_id=".$row['tmt_id']." and status=1");

            			    	 $tamt=mysqli_fetch_row($tamt_qry);

            			    	 echo $tamt[0];

            			    ?>

           	</td>

            	<td><a href="edit_er_template.php?tmt_id=<?php echo $row['tmt_id']; ?>">Edit</a></td>

            	<td><a href="req_er_template.php?tmt_id=<?php echo $row['tmt_id']; ?>">Raise</a></td>

        </tr>

        <?php

        		}

        	}

        	else

        		echo mysqli_error();

        ?>

</table>

</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="script.js"></script>

</body>

</html>