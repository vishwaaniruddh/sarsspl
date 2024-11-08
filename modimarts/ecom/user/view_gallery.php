<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 
 $qry="SELECT * FROM `gallery` WHERE cust_id='$id'";                                              
			  $res=mysqli_query($con1,$qry);                
                          //$num=mysql_num_rows($res);
//echo $num;
                     /*$qry1="select name,code from cities";
                     $res1=mysql_query($qry1);                
                     $num1=mysql_num_rows($res1);*/
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Meta -->
  <meta charset="UTF-8">
  <meta name="author" content="Acura">
  <meta name="description" content="Acura - A Real Admin Template">
  <meta name="keywords" content="Acura, Admin Template, Admin, Premium, ThemeForest, Clean, Modern, Responsive">
  <!-- Responsive viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <!-- Title -->
  <title>View Products</title>
  <?php
  include('header.php');
  ?>  
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
          <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>
        </div>
      </header>
      <!-- Adding Images to gallery -->
      <div class="data grid-12">
         <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Add Image In Gallery </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   	<form id="form11" name="form11" action="processAddgallery.php" method="post" enctype="multipart/form-data" >
                                          
      <table class="tables"  align="center" cellpadding="4" cellspacing="0" >
                                                                                                                                        

                                                <tr>

                                                  <td>
                                                  <input type="file" name="bimg" class="form" /></td>

                                               

                                          <td colspan="2" align="center">

                                            <input type="submit" value="Add Image" id="submit" name="submit" class="btn btn-submit" />
                                              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error" onClick="window.back()" />

                                        

                                          </td>

                                        </tr>

                                    </table>                                     
  </td>
 </tr>
  </table>
 </form>
    </div>
 
</div></div>
        <!-- All Images -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Image Gallery </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  <div >                                    
                                 <table class="tables" border="1" align="center" cellspacing="0" cellpadding="4" >
                                   <tr>
                                   <td colspan="2" width="100%" align="center"><b>YOUR Images</b></td>
                                     </tr>
                                  <tr><td><?php while($row1=mysqli_fetch_row($res)){?><div class="grid-2" align="center"><img src="gallery/<?php echo $id."/".$row1[2];?>" width="150px" height="150px"/><br/><a href="javascript:confirm_delete('<?php echo $row1[0];?>','<?php echo $id;?>');" >Delete</a></div><?php } ?></td></tr>
                                    </table>
                                      
   </div>
 
</div>
          </div>
        </div>
          </div>
        </div>
        
      <script type="text/javascript">
<!--
function confirm_delete(id,cid)
{
if(confirm("Are you sure you want to delete this entry?"))
  {
    document.location="del_galimg.php?imgid="+id+"&cid="+cid;
  }
}
 </script>
      <!-- Footer -->
  <!-- Footer -->
      <footer class="footer grid-12">
        <ul class="footer-sitemap grid-12">
          <li><a href="http://www.1clickguide.org">Home</a><span>/</span></li>
          
          <li><a href="http://www.1clickguide.org/contact.php">Contact</a><span>/</span></li>
        </ul>
        <div class="copyright grid-12">
          Copyright © 2012-2013 1clickguide.org. All rights Reserved!
        </div>
      </footer>
    </div>
  </div>
 
  <!-- Go top -->
 
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>