<?php
session_start();
include("config.php");
$pidno=$_POST['pidnum'];
$remark=$_POST['remark'];
$cnt=$_POST['cnt'];


$file = $_FILES['file'.$cnt];
        $name = $file['name'];
        $mime = $file ['type'];
        $file_size = $file ['size'];
        $file_path = $file ['tmp_name'];
        $ext = $file['extension'];
       
        
      //echo $name.'-'.$mime."-".$file_size."-".$file_path."-".$ext ;
      
       $srqry=mysqli_query($con,"select srno from login where username='".$_SESSION['user']."'");
			$srno=mysqli_fetch_row($srqry);
			//echo $srno[0];
$dt=date('Y-m-d H:i:s');    
       $fname="";
       if($name!="")
{
   $arrayf = explode(".", $name);
      $fname=$pidno.".".$arrayf[1];
}
        try{
	$query=mysqli_query($con,"insert into pod_uploads(pid,file,type,remark,req_by,entrydate)values('".$pidno."',' ".$fname."','".$mime."','".$remark."','".$srno[0]."','".$dt."')");
        if($query)
        {
        $qry=mysqli_query($con,"update ebill_package set status='2' where pid='".$pidno."'");
       		 if($qry)
      		 {
                    if($name!="")
                    {
                       if(move_uploaded_file ($file_path,'scan/'.$fname))
                       {
       		        echo "Approved";
                       }
                        else
                          {
                            echo "File upload error";
                           }

                    }
                     else
                    {
                       echo "Approved";
                    }
        	}
         	 else
       		 {
     		 echo "DB error";
            	}
	}      
       else
       {
       echo "dispute already exists for this pod";
       
       }
    }catch(Exception $e) {
    //echo "dispute already exists for this pod";
}   
      
      
      
      
        
  
        ?>