<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{ 
$id=$_SESSION['id'];

include "config.php"; 
 $qry="select * from blog where cust_id='$id'";                                              
        $res=mysqli_query($con1,$qry);                
                          $num=mysqli_num_rows($res);
//echo $num;
                     $qry1="select name,code from cities";
                     $res1=mysqli_query($con1,$qry1);                
                     $num1=mysqli_num_rows($res1);
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
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-10">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Blog Setup </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  <div >                                    
                                 <table class="tables" border="1" align="center" cellspacing="0" cellpadding="4" >
                                   <tr>
                                   <td colspan="2" width="60%" align="center"><b>YOUR BLOGS</b></td><td width="25%"><div><a href="add_blog.php" > Add New Blog</div> </a></td>
                                   </tr>
                                                <?php
                for ($i=0; $i<$num; $i++) 
                {
                  ?> <tr height="50" border="0" ><td width="20%" align="center" border="0" valign="middle"  > <?php
                     $pname = mysqli_result($res,$i,"title"); 
                     $pdesc = mysqli_result($res,$i,"discription");
                     $date = mysqli_result($res,$i,"date");
                     $pimg = mysqli_result($res,$i,"image"); 
           $bid = mysqli_result($res,$i,"blog_id"); 
           
                 //    $qry2="select name from areas where code='$carea'";
                         
        // $res2=mysqli_query($con1,$qry2);                
                //     $num3=mysqli_result($res2,0,"name"); ?>
     <img src="blog/<?php echo $cid."/".$pimg; ?>" alt="image" height="50" ></td>
    <td width="50%">   Blog Title : <font color="red"><?php echo $pname; ?></font><br/>
    Date Of post : <?php echo $date ?><br/>
    Description: <br/> <?php echo $pdesc; ?></td>
    <td width="20%"><a href="edit_blog.php?bid=<?php echo $bid; ?>"> <div title="Edit" class="tipsy-s btn btn-o-icon btn-small btn-info"><i>&#xf044;</i></div></a>
                      <a href="deleteBlog.php?bid=<?php echo $bid; ?>"><div title="Delete" class="tipsy-s btn btn-error btn-o-icon btn-small"><i>&#xf014;</i></div></a>
                   
         </td>
                </tr><?php
                }
?>
                                          </table>
                                        
                                          </td>
                                        </tr>
        </table>
   </div>
 
</div>
          </div>
        </div>
          </div>
        </div>
        
       
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