<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 
 $qry2="select max(code) as ncode from products";   

                          $res2=mysqli_query($con1,$qry2);

                          $row2=mysqli_fetch_array($res2);  
						  $qryblog=mysqli_query($con1,"select * from blog where `blog_id`='".$_GET['bid']."'");
						  $row=mysqli_fetch_row($qryblog); 
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
  <title>allmart merchant  panel</title>
<?php
include('header.php');
?>
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to Merchant Panel</span></h1>
          <div class="sitemap grid-6">
            <ul>
              <!--<li><span>1click</span><i>/</i></li>-->
              <li><a href="index.php">Merchant Panel</a></li>
            </ul>
          </div>
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Add Product </strong></h3>
            </header>
            <div class="widget-body">
                <div>
  
   	            <form id="form11" name="form11" action="processEditBlog.php?bid=<?php echo $_GET['bid'];?>" method="post" enctype="multipart/form-data" >
                    <table class="tables"  align="center" cellpadding="4" cellspacing="0" >
                        <tr>
                          <td align="center" colspan="2"><b><font color="#000000" size="+1">EDIT BLOG</font></b> </td>
                        <tr>

                                                  <td>Blog Title :</td>

                                                  <td colspan="3"><input type="text" name="title" class="form form-full" value="<?php echo $row[1];?>"/></td>

                                                </tr>

                                                <tr>

                                                  <td><div align="left">Blog Image :</div></td>

                                                  <td colspan="3"><input type="file" name="bimg" class="form" /><input type="hidden" name="oldimg" value="<?php echo $row[4];?>"><?php echo $row[4];?></td>

                                                </tr>                                                               
                                              
                                                <tr>

                                                  <td>Description :</td>

                                                  <td colspan="3"><textarea name="desc" class="form form-full" ><?php echo $row[2];?></textarea></td>

                                               

                                          

                                        </tr>

                                        <tr>

                                          <td colspan="2" align="center">

                                            <input type="submit" value="Update Blog" id="submit" name="submit" class="btn btn-submit" />
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
 
</div>
          </div>
        </div>
          </div>
        </div>
        
       
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