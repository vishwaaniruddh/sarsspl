<?php 
session_start();
ini_set( "display_errors", 0);

include("access.php");


// header('Location:managesite1.php?id='.$id); 


if($_SESSION['id']=="218" || $_SESSION['id']=="499")
{
include("config.php");

$result1 = mysqli_query($con,"SELECT contact_first, short_name FROM contacts where type='c' order by short_name ASC");		
$result2 = mysqli_query($con,"SELECT DISTINCT bank FROM sites");		
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sites</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<!--datepicker-->
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<script src="datepicker/datepick_js.js" type="text/javascript"></script>
<script src="excel.js" type="text/javascript"></script>

<script type="text/javascript">

</script>
</head>
<body >


<center>
<?php include("menubar.php");
//echo $_SESSION['branch'];
 ?>


  <h2 class="style1">Search</h2>

<p align="center">
<form action="new_uploadworkprocess.php" method="post" enctype="multipart/form-data">

           <select name="cid" id="cid" onchange="getproj(this.value);" required><option value="">select Client</option>
           <?php while($row1 = mysqli_fetch_row($result1)){ ?>
                                           <option value="<?php echo $row1[1]; ?>"<?php if(isset($_GET['cid']) && $_GET['cid']==$row1[1]){ ?> selected <?php }  ?> ><?php echo $row1[0]; ?></option>
           <?php } ?>   </select>
       <input type="file" name="csv" value="" required/>
Paid Date <input type="text" name="dt" value="" onclick="displayDatePicker('dt');"   required/>

<!--<p>&nbsp;<a href="exportallsite.php" >Export All Data</a></p>-->
<input type="submit" name="submit" value="Save" /></form>
</center>
<div id="search">

</div>

<script type="text/javascript" src="1.7.2.jquery.min.js"></script>

<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php 
    
}
else
{
    
     header("logout.php");

    
}

?>