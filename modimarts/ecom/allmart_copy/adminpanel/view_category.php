<?php
include('config.php');
$tempid=$_GET['tempid'];
/*$main_cat=$_GET['main_cat'];
$sub_cat=$_GET['sub_cat'];
$cat=$_GET['cat'];*/
//--========================query for get category which is under "0" ======

$qry="select * from approval_category where temp_id='".$tempid."'";
//echo $qry;
$results=mysql_query($qry);
$rows = mysql_fetch_assoc($results);
 
$sub_cat_id =$rows['under'];
$main_cat_id=$rows['base_cat'];
//get subcategory 
$qry_sub="select name from main_cat where id='".$sub_cat_id."'";
 $sub_data=mysql_query($qry_sub);
 $row_subcategory = mysql_fetch_assoc($sub_data);
//var_dump($row_subcategory);

//get maincategory 
$qry_maincat="select name from main_cat where id='".$main_cat_id."'";
$maincat_data=mysql_query($qry_maincat);
$row_maincategory = mysql_fetch_assoc($maincat_data);
//var_dump($row_maincategory);

$category = $rows['name'];
$sub_cat =$row_subcategory['name'];
$main_cat=$row_maincategory['name'];
?>

 <!--============================ ck Editor ===============-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="adstyle.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="datepicker/date_css.css" rel="stylesheet" type="text/css" />
<link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
<script src="../user/ckeditor/ckeditor.js"></script>
<script src="../user/ckeditor/samples/js/sample.js"></script>
<link rel="stylesheet" href="../user/ckeditor/samples/css/samples.css">
    
<!--============================ ck Editor ===============-->

<div id="content-outer">
<!-- start content -->
<div id="content">
<form action="edit_approvalCategory.php"  method="post"  >
    <br><br>
<center>
    <table>
   <tr></tr>
    <input type="hidden" id="tempid" name="tempid" value="<?php echo $_GET['tempid'];?>">
    <input type="hidden" id="sub_cat_id" name="sub_cat" value="<?php echo $sub_cat_id;?>">   
    <input type="hidden" id="main_cat_id" name="main_cat" value="<?php echo $main_cat_id;?>">
   <!-- <input type="hidden" id="ccode" name="ccode" value="<?php echo $_GET['ccode'];?>"> -->
        <tr>
            <td><div align="left">Main Category</div></td>
            <td colspan="3">
                <input type="text" name="main_category" id="main_category" class="form form-full" value="<?php echo $main_cat;?>" readonly/>
            </td>
        </tr>
         <tr>
            <td width="300px">Sub Category</td>
            <td colspan="3">
              <input type="text" name="sub_category" id="sub_category" class="form form-full" value="<?php echo $sub_cat;?>" required/>
            </td>
         </tr>
        <tr>
          <td width="300px">Category</td>
          <td colspan="3"><input type="text" name="category" value="<?php echo $category ;?>" class="form form-full" /></td>
        </tr>

</table>
<br/><br/>
<input type="submit" value="Update">
</center>
</form>
</div>
</div>
<!--=================================ck editor=======================-->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script type="text/javascript" src="script.js"></script>
<script src="../user/ckeditor/ckeditor.js"></script>
	<script src="../user/ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="../user/ckeditor/samples/css/samples.css">
	<script src="../user/ckeditor/samples/js/sample1.js"></script>
<script>
	initSample();
		initSample1();
</script>
<!--=================================ck editor=======================-->
