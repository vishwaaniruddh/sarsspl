<?php
include('config.php');
$cid=$_GET['cid'];
//--========================query for get category which is under "0" ======
$qrya="select * from main_cat where id='".$cid."'";
$resulta=mysql_query($qrya);
$rowa = mysql_fetch_row($resulta);
$aa=$rowa[2];
   
if($aa!=0){
    $qrya1="select * from main_cat where id='".$aa."'";
    $resulta1=mysql_query($qrya1);
    $rowa1 = mysql_fetch_row($resulta1);
    $Maincate= $rowa1[4];
}
//	==============================================================

if($Maincate==1)
{
    $qry2=mysql_query("select *  from fashion where code='".$_GET['adid']."'  and ccode='".$_GET['ccode']."' and category='".$cid."' ");
    $sql_statement = mysql_query("SELECT * FROM fashion_img where product_id='".$_GET['adid']."' and category='".$cid."'");
}
else if($Maincate==190)
{
    $sql_statement = mysql_query("SELECT * FROM electronics_img where product_id='".$_GET['adid']."' and category='".$cid."' ");
}
else if($Maincate==218)
{
    $sql_statement = mysql_query("SELECT * FROM grocery_img where product_id='".$_GET['adid']."' and category='".$cid."' ");
}
else 
{
    $sql_statement = mysql_query("SELECT * FROM product_img where product_id='".$_GET['adid']."' and category='".$cid."' ");
}
?>
 <!--============================ ck Editor ===============-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="adstyle.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
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
<form action="merchantProductEdit_Process.php"  method="post"  >
<center>
    <table>
   <tr>
    
  <?php  while($fr=mysql_fetch_array($sql_statement)) {?>
  <td>  
<img style="height:150px; width:150px;object-fit:contain"  src="../<?php echo $fr['img'];?>" >
</td>
<?php } ?>
</tr>
    <input type="hidden" id="catid" name="catid" value="<?php echo $_GET['cid'];?>">      
    <input type="hidden" id="prodid" name="prodid" value="<?php echo $_GET['adid'];?>"> 
    <input type="hidden" id="ccode" name="ccode" value="<?php echo $_GET['ccode'];?>"> 
    <?php if(mysql_num_rows($qry2)>0){ $Pdetails=mysql_fetch_array($qry2);}?>
    <tr>
        <td><div align="left">Product Brand</div></td>
        <td colspan="3"><input type="text" name="pbrand" id="pbrand" class="form form-full" value="<?php echo $Pdetails["brand"];?>" required/></td>
    </tr>
    <tr>
        <td width="300px">Long Description</td>
        <td colspan="3"><textarea  id="editor" name="editor" cols='60' value="  " ><?php echo $Pdetails['Long_desc'];?></textarea></td>
    </tr>
    <tr>
        <td width="300px">Other</td>
        <td colspan="3"><textarea  id="editor1" name="editor1"  ><?php echo $Pdetails[3];?></textarea></td>
    </tr>
    <tr>
        <td width="300px">Product Description</td>
        <td colspan="3"><input type="text" name="P_desc" value="<?php echo $Pdetails[7]; ?>" class="form form-full" /></td>
    </tr>
    <tr>
        <td width="300px">Specifications</td>
        <td>
            <?php 
            if($Maincate==1){
                    $qryspc=mysql_query("SELECT * FROM `fashionSpecification` where product_id='".$_GET['adid']."'");
                    // echo "SELECT * FROM `fashionSpecification` where product_id='".$pcode."'";
            }
            else if($Maincate==190)
            { $qryspc=mysql_query("SELECT * FROM `electronicsSpecification` where product_id='".$_GET['adid']."'");

            }
            else if($Maincate==218)
            { $qryspc=mysql_query("SELECT * FROM `grocerySpecification` where product_id='".$_GET['adid']."'");

            }
             else if($Maincate==482)
            { $qryspc=mysql_query("SELECT * FROM `ResaleSpecification` where product_id='".$_GET['adid']."'");

            }
            else
            {
            $qryspc=mysql_query("SELECT * FROM `productspecification` where product_id='".$_GET['adid']."'");
            }
            while($prspcf=mysql_fetch_array($qryspc))
            {?>
                <tr>
                    <td> </td>
                    <td> <input type="text" name="specification1[]" value= "<?php echo $prspcf[2]; ?>" class="form form-full" /></td>
                    <td><input type="text" name="specification[]"  value="<?php echo $prspcf[3]; ?>" class="form form-full" /></td>
                    <td><input type="hidden" name="id[]" value="<?php echo $prspcf[0]; ?>" class="form form-full" /></td>
                </tr>
            <?php } ?>
        </td>
    </tr>
</table><br/><br/>
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
