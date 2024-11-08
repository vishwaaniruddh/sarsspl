<?php
session_start();
include("config.php");
include("access.php");
try
{
    
$err=0;
require_once "PHPExcel/Classes/PHPExcel.php";


if(date('m')>='4'){
    $invd=date('y')."-".date('y',strtotime('+1 year')); 
    
}else{
    $invd=date('y',strtotime('-1 year'))."-".date('y');
    
    
}
$pthn="rnm_uploads_by_neeta/".$invd;
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}

$nwyr=date('Y');
$nwdt=date('m');


$pthn=$pthn."/".$nwdt."/";
if (!file_exists($pthn)) 
{
   mkdir($pthn, 0755, true);
}
$name=$_FILES['fup']['name'];

if($name!="")
{
$filenameitems = explode(".", $name);

$extn= $filenameitems[count($filenameitems) - 1];
//echo $extn;
$fname=$pthn.date("YmdHis").".".$extn;
//echo $fname;
 if (move_uploaded_file($_FILES["fup"]["tmp_name"], $fname)) 
   {
  
  
 // echo $fname;
  
  mysqli_query($con,"BEGIN");
		$excelReader = PHPExcel_IOFactory::createReader('Excel5');
		$excelObj = $excelReader->load($fname);
		$worksheet = $excelObj->getSheet(0);
		$lastRow = $worksheet->getHighestRow();
		
		//echo $lastRow;
		//echo "<table>";
		for ($row = 2; $row <= $lastRow; $row++) {
			/* echo "<tr><td>";
			 echo $worksheet->getCell('A'.$row)->getValue();
			 echo "</td><td>";
			 echo $worksheet->getCell('B'.$row)->getValue();
			 echo "</td><tr>";*/
			
			//echo  "select * from approve_amount_upload where qid='".$worksheet->getCell('AA'.$row)->getValue()."'"."</br>";
			 $chkqr=mysqli_query($con,"select * from approve_amount_upload where qid='".$worksheet->getCell('AA'.$row)->getValue()."'");
			 
			 $nr=mysqli_num_rows($chkqr);
			 
			 if($nr==0 && $worksheet->getCell('AB'.$row)->getValue()!="")
			 {
			 $qr=mysqli_query($con,"INSERT INTO `approve_amount_upload`( `qid`, `amount`, `entrydt`,excel_path) VALUES ('".$worksheet->getCell('AA'.$row)->getValue()."','".$worksheet->getCell('AB'.$row)->getValue()."','".date("Y-m-d H:i:s")."','".$fname."')");
			 
			 if(!$qr)
			 {
			     
			     $err++;
			 }
			 
			 }
		}
		//echo "</table>";	
  
  
  if($err==0)
    {
        mysqli_query($con,"COMMIT");
        ?>
        <script>
        
        alert("Upload Successfull");
        window.open("rnm_upload_new.php","_self");
        </script>
        <?php
    }
    else
    {
        
        mysqli_query($con,"ROLLBACK");
        ?>
        <script>
        
        alert("Error");
        window.open("rnm_upload_new.php","_self");
        </script>
        <?php
    }
    } else 
    {
?>
        <script>
        
        alert("Error Uploading FIle");
        window.open("rnm_upload_new.php","_self");
        </script>
        <?php
}





}
}catch(Exception $ex)
{
    
    echo $ex;
    
}
?>