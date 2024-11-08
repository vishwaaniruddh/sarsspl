<?php 
include("access.php");
include("config.php");


session_start();
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>alert('Sorry, your session has Expired'); window.location='index.php';</script>";
}
else
{
$errors="0";
//echo "hello";
$alid=$_POST['alid'];
$clrem=$_POST['clrem'];
$cnt=$_POST['cnt'];


$file = $_FILES['file'.$cnt];
        $name = $file['name'];
        $mime = $file ['type'];
        $file_size = $file ['size'];
        $file_path = $file ['tmp_name'];
       
        
        //echo $mime;
       $extn=explode('/',$mime);
       $tym=time();
       
        $nwnm=$tym.".".$extn[1];
    if($name!="")
                    {
                    $copysnaps=move_uploaded_file ($file_path,'new_callclose_uploads/'.$nwnm);
                       if(!$copysnaps)
                       {
       		       $errors++;
                           }

                    }    
        
        

$dt=date('Y-m-d H:i:s');

mysqli_query($con,'BEGIN');
$srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_array($srqry);
			
			
			$insqry=mysqli_query($con,"insert into new_call_closedetail (`alertid`, `remark`, `reqby`, `entrydt`,filename)values('".$alid."','".$clrem."','".$srno[0]."','".$dt."','".$nwnm."')");	
		if(!$insqry)
		{
		$errors++;
		
		}
			
		$updqry=mysqli_query($con,"update alert_detail set status='1' where alertid='".$alid."' ");	
		if(!$updqry)
		{
		$errors++;
		}
		

if($errors==0)
{
mysqli_query($con,"COMMIT");
echo "Closed";

}
else
{
mysqli_query($con,"ROLLBACK");
//echo mysqli_error();
echo "error";

}		
			
			
			
			
			
	
	}	
			
?>
