<?php
session_start();
include('header.php');
include('config.php');

 
?>

<html dir="ltr" class="ltr" lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Products</title>
          <meta name="description" content="My Store" />

    	     <link href="../catalog/view/theme/pav_bigstore/stylesheet/bootstrap.css" rel="stylesheet" />
                <link href="../catalog/view/theme/pav_bigstore/stylesheet/stylesheet.css" rel="stylesheet" />
               
  
</style>

<script>


function submfunc()
{
   
    try
    {
     var conf=true;
      
        var radioValue ="0";
  var cname=document.getElementById("cname").value;
        
        if(cname=="")
        {
        
     alert("Enter category Name");
        }
        else
        {
     if($("input[name='chk[]']:checked").length==0)
     {
         
    
         
         conf=confirm("You have not selected any category this will create a new base category, are you sure to continue");
     }
     
     else
     {
     
        radioValue=$("input[name='chk[]']:checked").attr("id");
         // alert(radioValue);
     }
     //  $('[name=chk[]]')
     
     
     
     
     if(conf)
     { //var fileToUpload=document.getElementById("fileToUpload").type;
       var property = document.getElementById('fileToUpload').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','']) == -1){
          alert("Invalid image file");
        }
var form_data ="file";
        var form_data = new FormData();
        form_data.append("file",property);                          
        //alert("anand"+cname)
    
     $.ajax({
          url:'processCreateCat.php',
          method:'POST',
         data:form_data,
         // data:'catid='+radioValue+'&cname='+cname+'&formdata='+form_data,
		contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $('#msg').html('Loading......');
          },
          success:function(data){
              alert(data);
              if(data=="1")
					 {
					     
					     alert("Category added successfully");
					 window.location.reload(true);
					     
					 }
					 else if(data=="0")
					 {
					     
					     alert("Error");
					 }
					 else if(data=="20")
					 {
					     
					     alert("Exception occured");
					 }
					 else if(data=="10")
					 {
					     
					     alert("Category alredy exists");
					 }
					 //document.getElementById("shct").innerHTML=msg;
					
	     console.log(data);
            $('#msg').html(data);
          }
        });
    
     
     
     
     /*  $.ajax(
           
				{
					type:'POST',    
					url:'processCreateCat.php',
					data:'catid='+radioValue+'&cname='+cname,
					success: function(msg)
					{
					 alert(msg);
					 
					 if(msg=="1")
					 {
					     
					     alert("Category added successfully");
					 window.location.reload(true);
					     
					 }
					 else if(msg=="0")
					 {
					     
					     alert("Error");
					 }
					 else if(msg=="20")
					 {
					     
					     alert("Exception occured");
					 }
					 else if(msg=="10")
					 {
					     
					     alert("Category alredy exists");
					 }
					 //document.getElementById("shct").innerHTML=msg;
					
					 }
					    
								});
								*/

}
}
        
    }catch(ex)
    {
        alert(ex);
    }
}



function vali(){
  var pro= document.getElementById('fileToUpload').value;
     if(pro==""){
         alert("Please Choose Image"); 
         return false;
            }
   
        var property = document.getElementById('fileToUpload').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        if(jQuery.inArray(image_extension,['gif','jpg','png','jpeg','']) == -1){
          alert("Invalid image file");
          return false;
        }
   
   
     
        var conf=true;
        var radioValue ="0";
        var cname=document.getElementById("cname").value;
        if(cname=="")
        {
         alert("Enter category Name");
        }
        else
        {
          if($("input[name='chk[]']:checked").length==0)
          {
        conf=confirm("You have not selected any category this will create a new base category, are you sure to continue");
    
          }
     
     else
     {
       radioValue=$("input[name='chk[]']:checked").attr("id");
      
     }
     //  $('[name=chk[]]')
      
     var rdio= document.getElementById('rd').value=radioValue;
     
     //===========================coding=================
      alert(rdio);
      if(rdio>0)
      {
          
          document.getElementById('basecat').value=rdio;
          
          
          
      }
   //==================================================   
      if(conf){
          
          return true;
      }else{
          return false;
         }
     
}
}
</script>






      </head>



  <body class="common-home page-common-home layout-fullwidth" onload="">
    <div class="row-offcanvas row-offcanvas-left">
      <div id="page">
        <!-- header -->
        
<header id="header-layout" class="header-v2">
      
    <div id="header-bot" class="hidden-xs hidden-sm">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <div id="pav-mainnav" class="hidden-xs hidden-sm">
                            
                                              
                                                                          </div>
                    </div>
                                            <div class="col-lg-3 col-sm-3 col-md-3 hidden-xs hidden-sm">
                                     </div>
            </div>
        </div>
    </div>
</header> 
        <!-- /header -->
        <div class="bottom-offcanvas visible-xs visible-sm space-10 space-top-10">
            <div class="container">
                <button data-toggle="offcanvas" class="btn btn-primary" type="button"><i class="fa fa-bars"></i></button>
            </div>
        </div>
        <!-- sys-notification -->
        <div id="sys-notification">
          <div class="container">
            <div id="notification"></div>
          </div>
        </div>
        <!-- /sys-notification -->
                         <div class="breadcrumbs space-30">
    <div class="container"> 
	    <div class="container-inner">
	        	        				 <ul class="list-unstyled breadcrumb-links">
								<li><a href="index.php"><i class="fa fa-home"></i></a>
								</ul>
					</div>
    </div>
</div><div class="main-columns container">
<div class="row">
				<div id="column-left" class="col-lg-3 col-md-3 col-sm-12 sidebar col-xs-12">
    <div class="panel panel-default">
  <div class="panel-heading"><h4 class="panel-title">Categories</h4></div>
  <div class="tree-menu"  id="catshow">
    
        <ul id="accordion14945721881688183652" class="box-category list-group accordion"> 
          <?php
      $frstlev=0;    
          
                    function category_tree($catid){
//global $conn;

global $con3;
global $frstlev;
$sql2 = "select * from main_cat where under ='".$catid."'";
$result = $con3->query($sql2);

while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0)?>
<ul id="collapse_214945721881688183652" class="box-category list-group accordion">

<?php
$idc=$row->id;

$chku=mysqli_query($con3,"select * from main_cat where id ='".$idc."' order by name");
 $chkufr=mysqli_fetch_array($chku);


$chkqrnrprodcts=mysqli_query($con3,"select * from products where category ='".$idc."'");
//echo "select * from products where category ='".$idc."'";
 $cprodexs=mysqli_num_rows($chkqrnrprodcts);
//echo "gdgdfg".$idc;

$chkundrexs=mysqli_query($con3,"select * from main_cat where under ='".$idc."' order by name asc");
 $chkundrexsrws=mysqli_num_rows($chkundrexs);

?>

<li name="<?php echo $chkufr[2];?>" style="display:none;" class="collapse accordion-body in" class="active"> <a href="javascript:void(0);">
    <input type="radio"  name="chk[]"  id="<?php echo $idc;?>">
    <?php echo $row->name; if($cprodexs>0){ echo " (".$cprodexs.")"; } ?>

<?php
if($chkundrexsrws>0)
{
?>
<button type="button" id="shwbtn<?php echo $chkufr[0];?>" onclick='shw("<?php echo $chkufr[0];?>","1");'  style="width:25px;height:25px;text-align:center">+</button>
<button type="button" style="display:none;width:25px;height:25px;" id="hidebtn<?php echo $chkufr[0];?>" onclick='shw("<?php echo $chkufr[0];?>","0");'>-</button>

<?php } ?>
</a>
 <?php
 $chkqrnr=mysqli_query($con3,"select * from main_cat where under ='".$idc."' order by name");
 $chkissubcat=mysqli_num_rows($chkqrnr);
 
 
 category_tree($row->id);
 echo '</li>';
 //echo $catids2;
$i++;
 if ($i > 0) echo '</ul>';
endwhile;
}
          
    ?>    
    
          
          
<?php
$sql23 = mysql_query("select * from main_cat where under ='0' order by name");
while($result23 =mysql_fetch_array($sql23))
{
?>
          
          <li class="list-group-item accordion-group">
                <a href="javascript:void(0);">
                    
                    <input type="radio" name="chk[]" id="<?php echo $result23[0];?>">
                    <b><?php echo $result23[1]; ?></b>
                
                <button type="button" id="shwbtn<?php echo $result23[0];?>" onclick='shw("<?php echo $result23[0];?>","1");' style="width:25px;height:25px;text-align:center">+</button>
                <button type="button" style="display:none;width:20px;height:20px;" id="hidebtn<?php echo $result23[0];?>"  onclick='shw("<?php echo $result23[0];?>","0");'>-</button>
                </a>
                      </li>
                      
                      
          
          <div style="margin-left:13px;">
          <?php 
  
     
     
     
          category_tree($result23[0]);
          
     ?>
     
     </div>
    
    <?php } ?>
    </ul>      
          
          
          

          
  </div>
  
  
  
  
  
</div>
<script type="text/javascript">
   
</script>


 <script type="text/javascript">  
</script>




    <div class="panel panel-default">
	<div class="panel-heading block-borderbox">
	
</div>
</div>  </div>
  
   <div id="sidebar-main" class="col-md-9 col-sm-12 col-xs-12">
       
       
	<div class="product-filter no-shadow">
    <div class="inner clearfix">
        <div class="display col-lg-2 col-md-2 col-sm-2 hidden-xs">
            <div class="btn-group group-switch">
                <button type="button" id="list-view" class="btn btn-switch" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                <button type="button" id="grid-view" class="btn btn-switch active" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
            </div>
        </div>
        <div class="filter-right col-lg-10 col-md-10 col-sm-10 col-xs-12">
            <div class="sort col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right">
                <form action='processCreateCat.php' method='post' enctype="multipart/form-data" onsubmit="return vali();">
                  
                 
                    
                    
<table align="center"   border="0" width="100%" id="id-form">
<tr height='30'>

<td align='center'>Category Name</td>
<input type="hidden" id="basecat" name="basecat" />
<td><input name='cname' id='cname' size='50' type='text' class="inp-form" required focus/></td>

</tr>
<tr><input type="hidden" id="rd" name="rd"/>
    <td align='center'>Category Image</td>
    <td><input type="file" name="fileToUpload" id="fileToUpload"></td>
</tr>


<tr height='30' style="display:none">

<td align='center' >Keywords</td>

<td><input name='add1' id='add1' size='50' type='text' class="inp-form" /></td></tr>

<tr>

<td colspan='2' align='center'><input value='Submit' class="btn"  type='Submit'  />
<input  value="Back" type="button" class="btn" onclick="window.open('sub_cat.php','_self');"  /></td></tr>

 </table></form>
                                                                      
            </div>
            
        </div>
    </div>
</div>

   <script>
              
              
          </script>    
      <div id="content">
      <div class="clearfix"></div>
      
                  
                 
      
        
      
      </div>
   </div> 
		</div>
</div>


 
<footer id="footer" class="nostylingboxs">
 
  


</footer>
 
 
<div id="powered">
</div>

  
<script type="text/javascript">
</script>


<script type="text/javascript">

</script>
</div>
<div class="sidebar-offcanvas visible-xs visible-sm">
    <div class="offcanvas-inner panel-offcanvas">
        <div class="offcanvas-heading clearfix">
            <button data-toggle="offcanvas" class="btn btn-v2 pull-right" type="button"><span class="zmdi zmdi-close"></span></button>
        </div>
        <div class="offcanvas-body">
            <div id="offcanvasmenu"></div>
        </div>
    </div>
</div>
<div id="top"><a class="scrollup" href="#"><i class="fa fa-angle-up"></i>TOP</a></div>
</div>
<script>
function shw(id,sts)
{
   // alert(sts);
    try
    {
    if(sts=="1")
    {
        
        $('#shwbtn'+id).hide();
        $('#hidebtn'+id).show();
     $('[name='+id+']').show();
    }
else
{
    $('#shwbtn'+id).show();
        $('#hidebtn'+id).hide();
         $('[name='+id+']').hide();

}
}catch(ex)
{
    alert(ex);
}
   // $('[name=when_is_escrow_set_to_close]').hide();
   // document.getElementById(id).style.display="block";
}
</script>
</body></html>




















<!--<form action="try2.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload"/>
    <input type="submit" name="submit" value="Upload"/>
</form>-->
