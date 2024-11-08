<?php
include("access.php");
if(!isset($_SESSION['user']))
{
echo "<script type='text/javascript'>window.location='index.php';</script>";
}

// echo $_SESSION['user']." ".$_SESSION['branch']." ".$_SESSION['designation'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS-<?php echo $_SESSION['user']; ?></title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function confirm_delete(id)
{
	if (confirm("Are you sure you want to delete this entry?"))
	{
		document.location="delete_engg.php?id="+id;
	}
	
}
</script>
<script>
/////for city
function getXMLHttp()

{

  var xmlHttp

 //alert("hi1");

  try

  {

    //Firefox, Opera 8.0+, Safari
 xmlHttp = new XMLHttpRequest();
  }

  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
   catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
       return false;
      }
   }
 }
  return xmlHttp;
}
function Approve(id)

{ 
//alert(id);
  var xmlHttp = getXMLHttp();
 

  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
if((xmlHttp.responseText)==0)
document.getElementById('app'+id).innerHTML="Done";
else
{
}
    //  HandleResponse3(xmlHttp.responseText);
    }
  }

 
  xmlHttp.open("GET", "appeng.php?id="+id, true);
//alert("appeng.php?id="+id);
  xmlHttp.send();

}

function HandleResponse3(response)

{

  document.getElementById('res').innerHTML = response;

}
</script>
</head>

<body>
<center>
<?php include("menubar.php"); ?>

<h2>View Area Engineers</h2>
<div id="header">
<table width="590" border="1" cellpadding="2" cellspacing="0" style="margin-top:5px;" class="res">
<tr><th width="86">Name</th>
<!--<th width="103">City</th>-->
<th width="82">Area</th>
<th width="80">Email</th>
<th width="92">Contact</th>
<?php if($_SESSION['designation']=='11' && $_SESSION['serviceauth']!='1'){ ?><th width="80">Resume</th>
<th width="92">Approval</th>
<th width="47">Edit</th>
<th width="56">Delete</th><?php } ?></tr>

<?php
$count=0;
include("config.php");
$br=$_SESSION['branch'];
if($_SESSION['branch']!='all')
{
$br1=str_replace(",","','",$br);//echo $br1[0]."/".$br1[1];
$br1="'".$br1."'";
//echo $br1;
//echo "select state from state where state_id in (".$br1.")";
//echo "select state from state where state_id in (".$br1.")";
$src=mysqli_query($con,"select state from state where state_id in (".$br1.")");
while($srcrow=mysqli_fetch_array($src))
{
	$bran[]=$srcrow[0];
}
$br3=implode(",",$bran);
$br2=str_replace(",","','",$br3);//echo $br1[0]."/".$br1[1];
$br2="'".$br2."'";
}
$qry="";
$str="";
//include_once('class_files/select.php');
//$sel_obj=new select();
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");
//echo $br2." ".$_SESSION['branch'];
if($_SESSION['branch']=='all')
{
$str="select * from area_engg where deleted=0 order by status ASC";
}
else
$str="select * from area_engg where deleted=0 and area in (".$_SESSION['branch'].") order by status ASC";

//echo $str;
//echo $_SESSION['designation']." ".
$qry=mysqli_query($con,$str);
while($row=mysqli_fetch_row($qry))
{
$count=$count+1;

//$qry2=mysqli_query($con,"select city from cities where city_id='".$row[3]."'");
//$row2=mysqli_fetch_row($qry2);
$qry3=mysqli_query($con,"select location from cssbranch where id='".$row[2]."'");
$row3=mysqli_fetch_row($qry3);
//$city_head=$sel_obj->select_rows('localhost','site','site','atm_site',array("*"),"area_engg","","",array(""),"y","engg_name","a");	
?>
<tr class="<?php if($count%2==0){ echo "res1"; } else{ echo "res2"; }  ?>">
<td><?php echo $row[1]; ?></td>
<!--<td><?php echo $row2[0]; ?></td>-->
<td><?php echo $row3[0]; ?></td>
<td><?php echo $row[4]; ?></td>
<td><?php echo $row[5]; ?></td>
<?php if($_SESSION['designation']=='8'){ ?><td><?php if($row[7]!=''){  ?><a href="download.php?filename=<?php echo $row[7]; ?>"><?php echo $row[1]." Resume"; ?></a><?php  }else{ echo "No Resume Uploaded"; } ?></td>
<td><?php // echo $row[9];   ?>
<div id="app<?php echo $row[0]; ?>"><?php if($row[9]==0){ ?><input class="buttn" type='button' onclick="Approve('<?php echo $row[0]; ?>');" style="background:#; height:25px" value='Approve'><?php } elseif($row[9]==1){ ?><input class="buttn" type='button' style="background:#CCCCCC; height:25px" onclick="Approve('<?php echo $row[0]; ?>');" value='Disapprove'><?php }  ?></div></td>
<td width="47" height="31"> <a href='edit_areaeng.php?id=<?php echo $row[0]; ?>'> Edit </a></td>
<?php if($_SESSION['serviceauth']=='1'){ ?>
<td width="56" height="31">  <a href="javascript:confirm_delete(<?php echo $row[0]; ?>);" class="update"> Delete </a></td><?php }  } ?>
</tr>
<?php } ?>
</table>
</div>
</center>
<script type="text/javascript" src="1.7.2.jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
