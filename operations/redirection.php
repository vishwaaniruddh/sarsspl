<?php
session_start();
//var_dump($_SESSION);
//echo $_SESSION['user'];die;
if(!isset($_SESSION['user']))
{
   // echo '34';die;
session_destroy();
header("location: index.php");
}
else
{
    
  if($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='4'){ 
//header("location: opermanagerapp.php");
echo "<script type='text/javascript'>window.location='opermanagerapp.php';</script>";
  }
   else if($_SESSION['designation']=="15" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4'){ header("location: quotation_tis.php");
		echo "<script type='text/javascript'>window.location='quotation_tis.php';</script>";  }
  
	  else if($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4'){ header("location: newsitelevel1.php");
		echo "<script type='text/javascript'>window.location='newsitelevel1.php';</script>";  }
	  else if($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4'){ header("location: newsitelevel1.php"); 
		echo "<script type='text/javascript'>window.location='newsitelevel1.php';</script>"; 
 }
	  else if($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='4'){ header("location: ebillreqapprovals.php");
echo "<script type='text/javascript'>window.location='ebillreqapprovals.php';</script>"; 
  }
	  else if($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4'){ header("location: ebillreqapprovals.php"); 
echo "<script type='text/javascript'>window.location='ebillreqapprovals.php';</script>"; 
 }
	  else if($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4'){ header("location: ebillreqapprovals.php");
echo "<script type='text/javascript'>window.location='ebillreqapprovals.php';</script>"; 
  }
	  else if($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='4' && $_SESSION['dept']=='4'){ header("location: ebillreqapprovals.php");
echo "<script type='text/javascript'>window.location='ebillreqapprovals.php';</script>";   }
	  else if($_SESSION['designation']=="10" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4'){ header("location: fundlevel1.php");
echo "<script type='text/javascript'>window.location='fundlevel1.php';</script>";   }
	else if($_SESSION['designation']=="9"){ header("location: ebillreqapprovals.php");
	echo "<script type='text/javascript'>window.location='ebillreqapprovals.php';</script>";   }
else if($_SESSION['designation']=="22" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='6'){ header("location: icici_quot_view.php");
echo "<script type='text/javascript'>window.location='icici_quot_view.php';</script>";   }
else
{ //echo '12';die;
session_destroy();
header("location: index.php");
}

}
?>