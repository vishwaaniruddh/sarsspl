<div class="container">
    
    
<ul class="nav">
<?php

// var_dump($_SESSION);
include("myfunction/menu.function.php");
//echo $_SESSION['designation']." ".$_SESSION['serviceauth']." ".$_SESSION['dept'];
if($_SESSION['designation']=="1" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1')
{
masteradmin();
}
else
{
if($_SESSION['designation']=="1")
{

 Admin();
}
elseif($_SESSION['designation']=="2" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1')
{
//echo "hi";
	financeop();
}
elseif($_SESSION['designation']=="2")
{
	Call();
}
elseif($_SESSION['designation']=="3")
{
	BranchHead();
}
elseif($_SESSION['designation']=="4")
{
	Engineer();
}
elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='2')
{
// echo "hi";
	ebill();
}
elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='2')
{
	ebillexec();
}
elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='2')
{
	ebilllevel1();
}
elseif($_SESSION['designation']=="7" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='3')
{
	sites();
}
elseif($_SESSION['designation']=="6" && ($_SESSION['serviceauth']=='1' || $_SESSION['serviceauth']=='2') && $_SESSION['dept']=='5')
{
	finance();
}
elseif($_SESSION['designation']=="13" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='2')
{
	ebsupv();
}
elseif($_SESSION['designation']=="20" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='7'))
{
	rnmfundtransfer();
}
elseif($_SESSION['designation']=="21" && $_SESSION['serviceauth']=='2' && ($_SESSION['dept']=='6' || $_SESSION['dept']=='5'))
{
	rnmnorthfundtransfer();
}
elseif($_SESSION['designation']=="30" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4' )
{
	salymodnew();
}
elseif($_SESSION['designation']=="31" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1')
{
	hrsalary();
}
elseif($_SESSION['designation']=="33" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='1')
{
	rnmout();
}

}

?>
 <li><a href="change_pwd.php">Change Password</a></li>
 <li><a href="logout.php">Logout</a></li>
</ul>
</div>