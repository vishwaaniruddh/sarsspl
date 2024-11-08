<!--=================== code for get category which under (0)=============

<?php include('config.php');
?>

                  
<?php 

	$strr="";
							$sqlbrdcr = mysql_query("select * from main_cat where id ='432' order by name");
						//	echo "select * from main_cat where id ='430' order by name";
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
								       	$sqlbrdcr2 = mysql_query("select * from main_cat where id ='".$iddbr."' order by name");
								       //	echo "select * from main_cat where id ='".$iddbr."' order by name";
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
							         	$strr=$fbrws23['id'];
							         	
							         	}
							         	else{
							         	     $strr=$strr."->".$fbrws23['id']; 
  
							         	    }
								?>
							
								<?php
								    
								}
								
								
								?>

<?php echo $strr; ?> 
