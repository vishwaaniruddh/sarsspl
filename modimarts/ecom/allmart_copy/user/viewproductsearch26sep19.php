<?php
session_start();
include "config.php"; 

$strPage=$_POST['Page'];
$id=$_SESSION['id'];
$fdate=$_POST['fdate'];
$tdate=$_POST['tdate'];
$progress=$_POST['progress'];
$actionid=$_POST['actionid'];
$orderid=$_POST['orderid'];
$dt=str_replace("/","-",$fdate);
$newDate = date("Y-m-d", strtotime($dt));
$dt1=str_replace("/","-",$tdate);
$Date=date('Y-m-d', strtotime($dt1));

$catid=$_POST["catid"];
$allidsarr=array();

 function category_tree($catid){
    global $con3;
    global $allidsarr;
    $sql2 = "select * from main_cat where under ='".$catid."' order by name asc";
    //echo $sql2;
    $result = $con3->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<?php

$idc=$row->id;




$chku=mysqli_query($con3,"select * from main_cat where id ='".$idc."'");

 $chkufr=mysqli_fetch_array($chku);
//echo $chkufr[1];

$chkqrnrprodcts=mysqli_query($con3,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;


$chkundrexs=mysqli_query($con3,"select * from main_cat where under ='".$idc."'");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);

//echo $idc;
$allidsarr[]=$idc;
?>

 <?php
 $chkqrnr=mysqli_query($con3,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 category_tree($row->id);
// echo '</li>';
 //echo $strr."</br>";
 //echo $catids2;
$i++;
 
endwhile;

}       
         

category_tree($catid);




if($catid==1){
$View = "select * from fashion where ccode='$id' ";
}
else if($catid==190){
$View = "select * from electronics where ccode='$id' ";
}
else if($catid==218){
$View = "select * from grocery where ccode='$id' ";
}
else if($catid==482){
$View = "select * from Resale where ccode='$id' ";
}
else{
    $View = "select * from products where ccode='$id' ";
}







if(count($allidsarr)>0)
{
    
    $str=implode(',',$allidsarr);
  $View .=" and category in ($str)";
    
}





if($newDate!="1970-01-01")
{
    $View .= " and date >= '".$newDate."'";
    
}
if($Date!="1970-01-01")
{
    $View .= " and date <= '".$Date."'";
    
}
if($progress!="")
{
    $View .= " and status = '".$progress."'";
    
}
if($orderid!="")
{
    $View .= " and id = '".$orderid."'";
    
}
if($actionid!="")
{
    if($actionid=="pro")
    {
    $View .= " and status = 'pending'";
    }
    elseif($actionid=="dis")
    {
    $View .= " and status = 'pro'";
    }
    elseif($actionid=="c")
    {
    $View .= " and status = 'dis'";
    }
     elseif($actionid=="rej")
    {
    $View .= " and status = 'dis'";
    }
}

$table=mysql_query($View);

$Num_Rows = mysql_num_rows($table);

//echo $View;
?>
<div align="center" >
 Records Per Page :<select name="perpg" id="perpg" onChange="funcs('1','perpg');"><br>
 
 <?php
 for($i=1;$i<=$Num_Rows;$i++)
 {
 if($i%10==0)
 {
 ?>
 <option value="<?php echo $i; ?>" <?php if(isset($_POST['perpg']) && $_POST['perpg']==$i){?>  selected="selected" <?php } ?>><?php echo $i."/page"; ?></option>
 <?php
 }
 }
 
 ?>
 <option value="<?php echo $Num_Rows; ?>"><?php echo "All"; ?></option>
 </select>
 
 </div>
<?php
// pagins
//echo $_POST['perpg'];
$Per_Page =$_POST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
	


//$View.=" ORDER BY cust ASC ";
	
	$View.=" LIMIT $Page_Start , $Per_Page";
	
	$qrys=mysql_query($View);
//	echo $View;	
	
	
	


?>
      <table class="tables" border="1" align="center"cellspacing="0" cellpadding="4" >
                                   <tr>
                                   <td colspan="4"><div align="center"><span class="style258 style149">YOUR PRODUCTS </span></div></td>
                                   </tr>
                                                <?php
                while($res=mysql_fetch_array($qrys)) 
                {
                    
                    if($catid==1){
                        $slting=mysql_query("SELECT * FROM `fashion_img` where product_id='".$res[0]."' limit 0,1");
                    }
                    else if($catid==190){
                        $slting=mysql_query("SELECT * FROM `electronics_img` where product_id='".$res[0]."' limit 0,1");
                    }
                    else if($catid==218){
                        $slting=mysql_query("SELECT * FROM `grocery_img` where product_id='".$res[0]."' limit 0,1");
                    }
                     else if($catid==482){
                        $slting=mysql_query("SELECT * FROM `Resale_img` where product_id='".$res[0]."' limit 0,1");
                    }
                    else{
                        $slting=mysql_query("SELECT * FROM `product_img` where product_id='".$res[0]."' limit 0,1");
                    }
                    
                
                
$sltingf=mysql_fetch_array($slting);
                    
                  ?> <tr height="50" border="0" ><td width="20%" align="center" border="0" > <?php
                 /*    $pname = mysql_result($res,$i,"name"); 
                     $pdesc = mysql_result($res,$i,"description");
                     $pcode = mysql_result($res,$i,"code");
                     $pimg = mysql_result($res,$i,"photo"); 
		     $paudio = mysql_result($res,$i,"audio"); 			 
		     $pvideo = mysql_result($res,$i,"video"); 			 
                 //    $qry2="select name from areas where code='$carea'";
                        */ 


		    // $res2=mysql_query($qry2);                
                //     $num3=mysql_result($res2,0,"name"); ?>
                
     <img src="../<?php echo $sltingf["img"]; ?>" alt="image" height="50" ><br><?php if($paudio){ ?><a href="play.php?fil=<?php echo '../userfiles/'.$id."/audio/".$paudio; ?>" >Play Music</a><?php } if($pvideo){ ?><br><a href="play.php?fil=<?php echo '../userfiles/'.$id."/audio/".$pvideo; ?>" >Play Video</a><?php } ?></td>
    <td width="57%"> Product Name : <font color="red"><?php echo $res["name"]; ?></font><br/>
    &nbsp; &nbsp;  Product Code: <font color="red"><?php echo $res["code"]; ?></font> <br/>
    
   
    <?php
    $c=$res["category"];
    $qryctg="SELECT name FROM main_cat where id='". $c."'";

                     $catg=mysql_query($qryctg); 
                     $res7=mysql_fetch_array($catg);
                     
    ?>
    &nbsp; &nbsp;Category:<font color="red"> <?php echo $res7["name"]; ?></font><br/> 
   <!--&nbsp; &nbsp;Description:<font color="red"> <?php echo $res["description"]; ?></font><br/> -->
   
     <td width="10%" > 
     <?php if($res["status"]!=1){?>
     <a href="edit_product.php?pcode=<?php echo $res["code"]; ?>&cat=<?php echo $catid ?>"</a><div title="Edit" class="tipsy-s btn btn-o-icon btn-small btn-info"><i>&#xf044;</i></div></a>
           <? } ?>           <a href="deleteproduct.php?pcode=<?php echo $res["code"]; ?>&cat=<?php echo $catid ?>" ><div title="Delete" class="tipsy-s btn btn-error btn-o-icon btn-small"><i>&#xf014;</i></div>
                   
         </a></td>
         
   
                </tr><?php
                }
?>
                                          </table>



<div class="pagination" style="width:100%;" align="center"><font size="4" color="#000">
 <?php 

if($Prev_Page) 
{
	echo " <a href=\"JavaScript:funcs('$Prev_Page','perpg')\"> << Back</a> ";
}

if($Page!=$Num_Pages)
{
	echo " <a href=\"JavaScript:funcs('$Next_Page','perpg')\">Next >></a> ";
}
?>
	
	</div>