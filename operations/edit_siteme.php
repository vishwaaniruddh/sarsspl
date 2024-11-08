<?php
include("access.php");
include("config.php");
// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />

<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
	
	<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<?php
$cid=$_GET['cid'];
$tid=$_GET['id'];
echo "Select takeover_date,handover_date,housekeeping_tkdt,housekeeping_hodt,maintenance_tkdt,maintenance_hodt,caretaker,maintenance,housekeeping,ebill from ".$_GET['cid']."_sites where id='".$tid."'";
$sql=mysqli_query($con,"Select takeover_date,handover_date,housekeeping_tkdt,housekeeping_hodt,maintenance_tkdt,maintenance_hodt,caretaker,maintenance,housekeeping,ebill from ".$_GET['cid']."_sites where id='".$tid."'");
$sqlres=mysqli_fetch_row($sql);
//echo $cid;
//echo $tid;
?>
</head>

<body>
<center>
<?php include("menubar.php");

//echo $_SESSION['branch'];
 ?></center>
<div align="center">
  <h2 class="style1">EDIT</h2>
</div><br /><br />
<form id="form1" name="form1" method="post" action="editmenew.php">
<table width="790" border="1" align="center" cellpadding="4" cellspacing="0">
<tr>
 <td><div align="center"><b>Caretaker</b></div></td>
    <td><div align="center">
      <input type="checkbox" name="ctchk" value="Y" <?php if($sqlres[6]=='Y'){ echo "checked='checked'"; } ?> />
      
      <td><div align="center"><b>Caretaker Takeover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="ctake" value="<?php if($sqlres[0]=='0000-00-00') echo ""; else echo date("d/m/Y",strtotime($sqlres[0])); ?>" onclick="displayDatePicker('ctake');"  />
      
      <!--<td><div align="center"><b>Caretaker Handover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="chand" value="<?php if($sqlres[1]=='0000-00-00') echo ""; else echo date("d/m/Y",strtotime($sqlres[1])); ?>" onclick="displayDatePicker('chand');" />-->
      </tr>
      
      
   <tr>
 <td><div align="center"><b>Maintenance</b></div></td>
    <td><div align="center">
      <input type="checkbox" name="mtchk" value="Y"  <?php if($sqlres[7]=='Y'){ echo "checked='checked'"; } ?>/>
      
     <td><div align="center"><b>Maintenance Takeover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="mtake" value="<?php if($sqlres[4]=='0000-00-00') echo ""; else echo date("d/m/Y",strtotime($sqlres[4])); ?>" onclick="displayDatePicker('mtake');"  />
      
     <!-- <td><div align="center"><b>Maintenance Handover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="mhand" value="<?php if($sqlres[5]=='0000-00-00') echo ""; else echo date("d/m/Y",strtotime($sqlres[5])); ?>" onclick="displayDatePicker('mhand');"  />-->
      </tr>   
      
      
       <tr>
 <td><div align="center"><b>Housekeeping</b></div></td>
    <td><div align="center">
      <input type="checkbox" name="hkchk" value="Y" <?php if($sqlres[8]=='Y'){ echo "checked='checked'"; } ?> />
      
      <td><div align="center"><b>Housekeeping Takeover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="htake" value="<?php if($sqlres[2]=='0000-00-00') echo ""; else echo date("d/m/Y",strtotime($sqlres[2])); ?>" onclick="displayDatePicker('htake');"  />
      
      <!--<td><div align="center"><b>Housekeeping Handover Date</b></div></td>
    <td><div align="center">
      <input type="text" name="hhand" value="<?php if($sqlres[3]=='0000-00-00') echo ""; else  echo date("d/m/Y",strtotime($sqlres[3])); ?>" onclick="displayDatePicker('hhand');" />-->
      </tr>  
      
      
      <tr>
 <td><div align="center"><b>Ebill</b></div></td>
    <td><div align="center">
      <input type="checkbox" name="ebill" value="Y" <?php if($sqlres[9]=='Y'){ echo "checked='checked'"; } ?> />
      <td colspan='4'></td>
      </tr>
      
       <tr>
 
    <td colspan="6" align="center"><input type="hidden" name="custid" value="<?php echo $cid; ?>" /><input type="hidden" name="autoid" value="<?php echo $tid; ?>" /><input type="submit" value="submit" /> </td>
      </tr>
      
     </table>
     </form>
     <script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
     </body>
     </html>
     
      
      
      
      
      
      
      
      
      
      
      
      
      