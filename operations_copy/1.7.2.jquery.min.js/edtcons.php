<?php
include("access.php");
include("config.php");
$tempid=$_GET['tempid'];
$qry=mysqli_query($con,"Select * from tempebill where tempid='".$tempid."'");
$row = mysqli_fetch_row($qry);

//echo "Select * from newtempsites where id='".$tempid."'";
$qry2=mysqli_query($con,"Select * from newtempsites where id='".$tempid."'");
$row2 = mysqli_fetch_row($qry2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
</head>

<body>

<center>
<?php include("menubar.php");

//echo $_SESSION['branch'];
 ?></center>
<div align="center">
  <h2 class="style1">EDIT Consumer Details</h2>
</div><br /><br />

<form id="form1" name="form1" method="post" action="updateconsme.php">
<table width="790" border="1" align="center" cellpadding="4" cellspacing="0">
 <tr>
    <td width="146" height="52"><div align="center"><b>Consumer No</b></div></td>
    <td width="211"><div align="center">
      <p>
        <input type="text" name="con_no"  value="<?php echo $row[1]; ?>" />
        </p>
      </div></td>
  <td width="29"></td>
    <td width="122"><div align="center"><b>Distributor</b></div></td>
    <td width="248"><div align="center">
      <p>
        <input type="text" name="distributor"  value="<?php echo $row[2]; ?>"/>
      </p>
    </div></td>
  </tr>
 
   <tr>
 <td width="146" height="52"><div align="center"><b>ATM ID</b></div></td>
 <td><div align="center">
   <p>
     <input type="text" name="atmid" value="<?php echo $row2[17]; ?>" readonly="readonly" />
   </p>
 </div></td>
    <td width="29"></td>
     <td><div align="center"><b>LandLord</b></div></td>
     <td><div align="center">
       <input type="text" name="landlord" value="<?php echo $row[5]; ?>"/>
     </div></td>
  </tr> 
  
   <tr>
 <td width="146" height="52"><div align="center"><b>Billing Unit</b></div></td>
 <td><div align="center">
   <p>
     <input type="text" name="billunit" value="<?php echo $row[10]; ?>" />
   </p>
 </div></td>
    <td width="29"></td>
     <td><div align="center"><b>Meter No</b></div></td>
     <td><div align="center">
       <input type="text" name="meterno" value="<?php echo $row[11]; ?>"/>
     </div></td>
  </tr> 
  
   <tr>
    <td colspan="11" align="center"><input type="hidden" name="custid" value="<?php echo $row[9]; ?>" /><input type="hidden" name="tempid" value="<?php echo $tempid; ?>" /><input type="submit" value="submit" /> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="newsitelevel1.php?cid=<?php echo $row[9]; ?>">cancel</a></td>
  </tr>
  
  
  </table>
  </from>
  
  <script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
  
  </body>
  </html>