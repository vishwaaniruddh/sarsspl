<?php
session_start();
include('config.php');
//include('menutop.php');
//if(isset($_SESSION['user']))
$mid=$_GET['movid'];

$movieid=explode(',',$mid);
//echo $_GET['dt'];
$repdt=str_replace('%20', ' ',$_GET['dt']);
$repdt1=str_replace('/', '-',$_GET['dt']);
//echo $repdt1;

$dt=date("d-m-Y H:i:s",strtotime($repdt1));
//echo $dt;

//print_r($movieid);


function format_time($t,$f=':') // t = seconds, f = separator 
{
  return sprintf("%02d%s%02d%s%02d", floor($t/3600), $f, ($t/60)%60, $f, $t%60);
}



  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>swisskraft</title>
<script type="text/javascript" async src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="adstyle.css" type="text/css" />
 <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
<link rel="stylesheet" href="style.css" type="text/css" />



 <link rel="icon" href="images/logo_part1.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/logo_part1.png" type="image/x-icon" />
		<link rel="stylesheet" href="../css/custom.css" type="text/css">
		<!---BootStrap CSS-->
		<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
		<!---Menu CSS-->
		<link rel="stylesheet" href="../css/mega-menu.css" type="text/css">
		<!---Theme Color CSS-->
		<link rel="stylesheet" href="../css/theme-color.css" type="text/css">
		<!---Responsive CSS-->
		<link rel="stylesheet" href="../css/responsive.css" type="text/css">
		<!---Owl Slider CSS-->
		<link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
		<!---BxSlider CSS-->
		<link rel="stylesheet" href="../css/jquery.bxslider.css" type="text/css">
		<!---Font Awesome CSS-->
		<link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css">
		<!---PrettyPhoto CSS-->
		<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css">
		<!---Audio Player CSS-->
		<link rel="stylesheet" href="../css/audioplayer.css" type="text/css">


 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
</head>
<script>







function addtoschedule(nm,id,chckid)
{
//alert(chckid);

if($("#"+chckid).is(':checked'))
{

var sel = document.getElementById("Select1");
var option = document.createElement("option");
option.text = nm;
option.value=id;
sel.add(option);
} 
else 
{
   
$('#Select1 option').each(function() {
    if ( $(this).val() ==id) {
        $(this).remove();
    }
});

}



}

function fnc()
{

if(confirm("Are you sure to continue"))
{

//alert("ok");
var mpath=[];
		var fields = document.getElementsByName("mpath[]");
		for(var i = 0; i < fields.length; i++) 
                   {
			mpath.push(fields[i].value);
			}

var ndt=[];
		var fields2 = document.getElementsByName("dt[]");
		for(var i = 0; i < fields2.length; i++) 
                   {
			ndt.push(fields2[i].value);
			}


var ntym=[];
		var fields3 = document.getElementsByName("tym[]");
		for(var i = 0; i < fields3.length; i++) 
                   {
			ntym.push(fields3[i].value);
			}

var ndur=[];
		var fields4 = document.getElementsByName("dur[]");
		for(var i = 0; i < fields4.length; i++) 
                   {
			ndur.push(fields4[i].value);
			}
			
	var adidarr=[];
		var fields5 = document.getElementsByName("adid[]");
		for(var i = 0; i < fields5.length; i++) 
                   {
			adidarr.push(fields5[i].value);
			}		
			

var dataPost = {mpath:mpath,mdt:ndt,mtym:ntym,ndur:ndur,adidarr:adidarr};
var dataString = JSON.stringify(dataPost);



$.ajax({
   type: 'POST',    
url:'schedulem_process.php',
data:{dat:dataString},

success: function(msg){
alert(msg);
if(msg!="Error")
{

window.opener.locrel();
window.close();
}



         }
     });

}
}


</script>

<body>
 <!--Header Start-->
        	<!--Header End-->
<!-- /#secondary-menu -->

	



<div class="container">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12" >

<table border="2" class="table table-striped m-b-none">
<th>Movie</th>
<th>Duration</th>
<th>Date</th>
<th> Start Time</th>


<?php



//$dt2=date("d/m/Y",strtotime($dt));
//$tym=date("H:i:s",strtotime($dt));

//echo count($movieid);
$strtym="";
$strtym2="";
$dur="";

for($i=0;$i<count($movieid);$i++)
{
$qrys=mysqli_query($con3,"select name,duration,videopath from ads_upload where id='".$movieid[$i]."'");
$rwss=mysqli_fetch_array($qrys);

$dt1="";

if($i==0)
{

$dt1=date("d-m-Y H:i:s",strtotime($dt));
$dt=date("d-m-Y H:i:s",strtotime($dt)+$rwss[1]);

}
else
{
$dt1=$dt;
$dt=date("d-m-Y H:i:s",strtotime($dt)+$rwss[1]);
}


?>

<tr>





<td>

<?php echo $rwss[0];?>
<input type="hidden" name="adid[]" value="<?php echo $movieid[$i];?>" >
<input type="hidden" name="mpath[]" value="<?php echo $rwss[2];?>" >
<input type="hidden" name="dt[]" value="<?php echo date("d-m-Y",strtotime($dt1));?>" >
<input type="hidden" name="tym[]" value="<?php echo date("H:i:s",strtotime($dt1));?>" >
<input type="hidden" name="dur[]" value="<?php echo $rwss[1];?>" >

</td>

<td>
<?php echo format_time($rwss[1]);?>
</td>

<td>
<?php echo date("d-m-Y",strtotime($dt1));?>
</td>


<td>

<?php echo date("h:i:s A",strtotime($dt1));?>
</td>




</tr>
<?php 
}
 ?>
<tr><td colspan="4" align="center"><input type="button" value="Schedule Ad" onclick="fnc();"></td></tr>
</table>
</div>
</div>
</div>
</div>
</body>
</html>