<?php 
session_start();
include('config.php');
//var_dump($_POST);
//$catid=$_POST['rd'];
//$catid=$_POST['catid'];
//============== code for get category under (0) ============
$basecat=$_POST['basecat'];
$strr="";
if($basecat!="")
{
	$sqlbrdcr = mysql_query("select * from main_cat where id ='".$basecat."' order by name");
//	echo "select * from main_cat where id ='".$basecat."' order by name";
		$fbrws=mysql_fetch_array($sqlbrdcr);
		if($fbrws['under']=="0")
		{
		    //echo "ok";
		    $strr=$fbrws['id'];
		}else
		{
		    $exs=0;
		    $idbrdcrmbarr=array();
		   $iddbr=$fbrws['id'];
		   while($exs==0)
		   {
		      //echo "select * from main_cat where id ='".$iddbr."'";
		      $sqlbrdcr2 = mysql_query("select * from main_cat where id ='".$iddbr."' order by name");
		      //echo "select * from main_cat where id ='".$iddbr."' order by name";
		       	
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
         	echo "hiii".$strr;
         	} else{
     	        //  $strr=$strr."->".$fbrws23['id'];
     	    }
		}
}

//=======================================================

$bname=mysql_real_escape_string($_POST['cname']);
try{  
$chkqr=mysql_query("select * from main_cat where name='".$bname."' and under='".$catid."'");
//echo "select * from main_cat where name='".$cname."' and under='".$catid."'";
$chknrws=mysql_num_rows($chkqr);
//echo $basecat;
if($chknrws==0 )
{
	/*$qry="insert into main_cat(name,under,cat_img,base_cat) values('".mysql_real_escape_string($cname)."','".$catid."','".$thumb_src."','".$strr."')";
	$res=mysql_query($qry);
    $base=mysql_insert_id();*/
    //Check for existence of brand
    $chkBrnd=mysql_query("select * from brand where brand='".$bname."'");
    $nrws=mysql_num_rows($chkBrnd);
    //echo "select * from brand where brand='".$bname."'";exit;
    //echo $nrws;
    if($nrws==0){
        $qry="insert into brand(brand,category_id) values('".mysql_real_escape_string($bname)."','".$basecat."')";
    	$res=mysql_query($qry);
        $base=mysql_insert_id();
    
        $curr_dt=date('Y-m-d H:i:s');
    	$subAdminWork=mysql_query("insert into audit_log (user_id,action,description,date_time,srid,line_no,table_name)values('".$_SESSION['SESS_USER_NAME']."','Add','Add Brand In Brand Table','".$curr_dt."','".$_SESSION['lastSubID']."','". $base." ','brand') ");
	    $message ="Brand added successfully";
    } else {
    $message ="Brand already exist!";
    }
    	
	


$chk=mysql_query("select * from main_cat where id='".$base."'");
$fetchchk=mysql_fetch_array($chk);

if($fetchchk['under']==0){
$updateBasecat=mysql_query("update main_cat set base_cat='".$base."' where id='".$base."'");
}
if($res){
    //echo 1;
    echo '<script language="javascript">'.'alert(<?php echo $message;?>)'.'</script>';

    echo '<script language="javascript">'.'window.open("add_brand.php", "_self")'.'</script>';
    }  else{
    //echo 0;
      echo '<script language="javascript">'.'alert(<?php echo $message;?>)'.'</script>';
      echo '<script language="javascript">'.'window.open("add_brand.php", "_self")'.'</script>';

    
}
}else
{     echo '<script language="javascript">'.'alert("Brand alredy exists")'.'</script>';
      echo '<script language="javascript">'.'window.open("add_brand.php", "_self")'.'</script>';
    //echo 10;
}
                          }catch(Exception $e)

                           {
                           //  echo 'Message: ' .$e->getMessage();
      //echo 20;
       echo '<script language="javascript">'.'alert("Exception occured")'.'</script>';
       echo '<script language="javascript">'.'window.open("add_brand.php", "_self")'.'</script>';
    
       }

?>











