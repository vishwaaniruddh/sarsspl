<?php
session_start();
if(!isset($_SESSION['user']))
{
session_destroy();
header("location: index.php");
}
else
{
 if($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='2'){ header("location: uploadedbill.php");  }
       elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='2'){ header("location:generateEbill.php");  }
       elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='2'){ header("location:viewpaidebill.php");  }
	   elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='3'){ header("location:managesite.php");  }
	   elseif($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='5'){ header("location:ebillreqapprovals.php");  }
	   elseif($_SESSION['designation']=="6" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='5'){ header("location:viewquot.php");  }
	   elseif($_SESSION['designation']=="1" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1'){ header("location:ebillreqapprovals.php");  }
	   elseif($_SESSION['designation']=="2" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1'){ header("location:epayannex.php");  }
	   elseif($_SESSION['designation']=="13" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='2'){ header("location:sup3.php");  }
       elseif($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7') ){ header("location:view_quot_fr.php");  }
 elseif($_SESSION['designation']=="21" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='5')){ header("location:rnmnorth_fr.php");  }
 elseif($_SESSION['designation']=="30" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4'){ header("location:viewsalaryn.php");  }
 elseif($_SESSION['designation']=="33" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1'){ header("location:quottransview.php");  }

       else{ session_destroy(); header("location: index.php"); }
}
?>