<?php
include('config.php');
$srchtxt=$_POST["srchtxt"];
echo $srchtxt;





  $View="SELECT * FROM products where 1 ";
if($srchtxt!="")
{

$View.= " and name like'%".$srchtxt."%' or  description like'%".$srchtxt."%' ";

}

 
$table=mysqli_query($con1,$View);

$Num_Rows =mysqli_num_rows($table);

//echo $Num_Rows;

?>


<?php

$Per_Page =$_REQUEST['perpg'];   // Records Per Page
 
 
 //echo $Per_Page;
$Page = $strPage;
if($strPage=="")
{
	$Page=1;
}

if($Per_Page=="")
{
    
    $Per_Page="10";
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

$View.="order by code asc";
	
if($sort!="")
{
  if($sort==1)
  {
      $View.=", name ASC ";
      
  }
    
  elseif($sort==2)
  {
      $View.=", name desc ";
      
  }
  elseif($sort==3)
  {
      $View.=", total_amt ASC ";
      
  }
  elseif($sort==4)
  {
      $View.=", total_amt DESC ";
      
  }
}


	$View.=" LIMIT $Page_Start , $Per_Page";
//	echo "hii".$View;
	
	$qrys=mysqli_query($con1,$View);

echo mysqli_error();	
	
	
	?>

<div id="products" class="product-grid">
	<div class="products-block block-content">
						<div class="row products-row">
				<input type="hidden" name="nmrws" id="nmrws" value="<?php echo $Num_Rows;?>">		    
				<input type="hidden" name="perpgforfunc" id="perpgforfunc" value="<?php echo $Per_Page;?>">		    
			
						    
<?php 
$rows = array();


while($rwss=mysqli_fetch_array($qrys))
{
 // echo "ram".$rwss[0];
 
  
  
$rows[] = $rwss;
$newh=0;
if($height>350)
{
   $newh="350px";
    
}else
{
   $newh= $height."px";
}
   

?>


<img class="img-responsive" src="<?php echo trim($prodimgpth.$rwss['photo']);?>" title="<?php echo $rwss['name'];?>" alt="" 
             style='height:350px; width: 100%; object-fit: contain'/>
<?php }?>
