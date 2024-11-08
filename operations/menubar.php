<div class="container" align="center">
<ul class="nav">
<?php
include("myfunction/menu.function.php");
if($_SESSION['user']=='masteradmin')
{
masteradmin();
}
else
{
if($_SESSION['designation']=="1")
{

 Admin();
}
elseif($_SESSION['designation']=="2")
{
	Call();
}
elseif($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='4')
{
	opermgr();
}
elseif($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4')
{
	Accmgr();
}
elseif($_SESSION['designation']=="8" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4')
{
	Accmgr();
}
elseif($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='1' && $_SESSION['dept']=='4')
{
	branchmgr();
}
elseif($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4')
{
	branchmgr();
}
elseif($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4')
{
	branchmgr();
}
elseif($_SESSION['designation']=="11" && $_SESSION['serviceauth']=='4' && $_SESSION['dept']=='4')
{
	branchmgr();
}
elseif($_SESSION['designation']=="10" && $_SESSION['serviceauth']=='3' && $_SESSION['dept']=='4')
{
	bankmgr();
}
elseif($_SESSION['designation']=="9")
{
	branch_manager();
}
elseif($_SESSION['designation']=="22" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='6')
{
	iciciquotation();
}
elseif($_SESSION['designation']=="15" && $_SESSION['serviceauth']=='2' && $_SESSION['dept']=='4')
{
	tis();
}

}
?>
 <li><a href="change_pwd.php">Change Password</a></li>
 <li><a href="logout.php">Logout</a></li>
</ul>
</div>