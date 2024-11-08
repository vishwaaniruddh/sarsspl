/*
//$qry="select id,under from main_cat order by name asc limit ".$offset.",".$limit;


  function category_tree($catid){
 //global $conn;
 
 
   $con1 =  mysqli_connect("localhost","sarmicro_1click","Click123*","sarmicro_1click");
     
   



$sql2 = "select * from main_cat where under ='".$catid."' order by name asc";
//echo $sql2;
$result = $con1->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php

$idc=$row->id;

$chkqrnrprodcts=mysqli_query($con1,"select * from products where category ='".$idc."'");
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;
?>
<li class="collapse accordion-body in" class="active"> <a href="product.php?mdi=<?php echo $row->id;?>"><?php echo $row->name; if($cprodexs>0){ echo " (".$cprodexs.")"; } ?></a>
 <?php
 
 $strr=$strr.">>".$row->name;
 
 $chkqrnr=mysqli_query($con1,"select * from main_cat where under ='".$idc."'");
 $chkissubcat=mysqli_num_rows($chkqrnr);



 category_tree($row->id);
 echo '</li>';
 //echo $strr."</br>";
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}       
         


$qry="select id,under from main_cat where  under =0 order by name";

$result=mysql_query($qry);  
$nrd=mysql_num_rows($result);
if($nrd>0)
{

     while($row = mysql_fetch_row($result))
    
		{
?>
<div><?php echo $row[1];?></div>
<div>
<?php

category_tree($row[0]);

}
}*/
/*//echo $qry1;
$result=mysql_query($qry);  
$nrd=mysql_num_rows($result);
if($nrd>0)
{

     while($row = mysql_fetch_row($result))
    
		{

             			  
				
								$strr="";
							$sqlbrdcr = mysql_query("select * from main_cat where id ='".$row[0]."'");
								$fbrws=mysql_fetch_array($sqlbrdcr);
							
								if($fbrws['under']=="0")
								{
								    //echo "ok";
								    $strr=$fbrws['name'];
								 
								    
								}else
								{
								    $exs=0;
								    $idbrdcrmbarr=array();
								   $iddbr=$fbrws['id'];
								   while($exs==0)
								   {
								      //echo "select * from main_cat where id ='".$iddbr."'";
								       	$sqlbrdcr2 = mysql_query("select * from main_cat where id ='".$iddbr."'");
							         	$fbrws2=mysql_fetch_array($sqlbrdcr2);
							         	//$idbrdcrmbarr[]=$iddbr;
							         	array_unshift($idbrdcrmbarr, $iddbr);
							         	if($fbrws2['under']=="0")
							         	{
							         	 $iddbr="0";
							         	    	$exs=1;
							         	    	break;
							         	}else
							         	{
							         	 $iddbr= $fbrws2['under'];  
							         	}
							         
								   }
								   
								    //print_r($idbrdcrmbarr);
								}
								
							
								for($c=0;$c<count($idbrdcrmbarr);$c++)
								{
								    	$sqlbrdcr23 = mysql_query("select * from main_cat where id ='".$idbrdcrmbarr[$c]."' order by name");
							         	$fbrws23=mysql_fetch_array($sqlbrdcr23);
							         	
							         	if($strr==""){
							         	$strr=$fbrws23['name'];
							         	}
							         	else{
							         	     $strr=$strr."->".$fbrws23['name']; 
  
							         	    }
								?>
							
								<?php
								    
								}
								
								
								?>
								
                    		<option value="<?php echo $row[0]; ?>" style='sort'  <?php if(isset($_GET['catid']) && $_GET['catid']==$row[0]) echo "Selected"; ?> ><?php echo $strr; ?></option>
                    		
                    	

						  
             			 
                <?php }
                
}
                ?> 
                
        
            <?php
        */    /*
				?>
				<select id="pcat" name="pcat" class="form form-full">
<?php 


$clintct=mysql_query("SELECT id FROM `main_cat`");
//echo "SELECT cid FROM `clients` WHERE `code` = '".$_SESSTION['id']."'";
//$clintctf=mysql_fetch_row($clintct);
while($clintctf=mysql_fetch_row($clintct))
{
    if($catarr==""){
    $catarr321=$clintctf[0];
    }else{
        
      $catarr321=$catarr321.','.$clintctf[0];
        
    }
}


$catarr="";
//echo "SELECT id FROM `main_cat` where under in ($catarr321)";
$maincat=mysql_query("SELECT id FROM `main_cat` where under in ($clintctf[0])");
while($maincatf=mysql_fetch_row($maincat))
{
    if($catarr==""){
    $catarr=$maincatf[0];
    }else{
        
      $catarr=$catarr.','.$maincatf[0];
        
    }
}



$querycat=mysql_query("SELECT * FROM `main_cat` where id in ($catarr) ");

while($querycatf=mysql_fetch_array($querycat))
{
    
    ?>
    
    <optgroup label="<?php  echo $querycatf[1];?>" >
    
 <!--   <option value="<?php  echo $querycatf[0];?>" style="background-color:#66e0ff" selected disabled><?php  echo $querycatf[1];?> --></option>
    
    <?php
    $querycat1=mysql_query("SELECT * FROM `main_cat` where under ='".$querycatf[0]."' order by name ");
while($fechcat=mysql_fetch_array($querycat1))
{
    
    $querycat2=mysql_query("SELECT * FROM `main_cat` where under ='".$fechcat[0]."' order by name "); 
    $fechcatr=mysql_num_rows($querycat2);
    
    if($fechcatr>0)
    {
?>
<optgroup label="<?php  echo $fechcat[1];?>">

 <?php
   
while($fechcat2=mysql_fetch_array($querycat2))
{
    
    
?>
<option value="<?php  echo $fechcat2[0];?>"><?php  echo $fechcat2[1];?></option>

<?php 
}
}
else{
    ?>
    
    <option value="<?php  echo $fechcat[0];?>"><?php  echo $fechcat[1];?></option>
    <?php
}
?>
</optgroup>

<?php }
?>

</optgroup>
<?php
}
?>
</select>
<?php */?><?php
set_time_limit(0);
include('config.php');
$limit="25";
$offset=$_POST["offset"];



$sql2 = mysql_query("select * from main_cat where under ='0' order by name asc");
while($re=mysql_fetch_array($sql2))
{
    
    
    echo $re[1]."</br>";
}


?>