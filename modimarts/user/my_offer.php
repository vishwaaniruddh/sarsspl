<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{ 
$id=$_SESSION['id'];

include "config.php"; 
$qry="select * from offers where cust_id='$id'";                                              
$res=mysqli_query($con1,$qry);                
$num=mysqli_num_rows($res);
//echo $num;
/* $qry1="select name,code from cities";
 $res1=mysqli_query($con1,$qry1);                
 $num1=mysqli_num_rows($res1);*/
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
  <title>View Offers</title>
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
              <h3 class="widget-header-title"><strong>Manage Offers </strong></h3>
            </header>
            <div class="widget-body">
                <div>
                    <div >                                    
                        <table class="tables" border="1" align="center"cellspacing="0" cellpadding="4" >
                            <tr>
                                <td colspan="4"><div align="center"><span class="style258 style149"><B>MY OFFERS </B></span></div></td>
                            </tr>
                            <?php
                            for ($i=0; $i<$num; $i++) 
                            {
                            ?> 
                                <tr height="50" border="0" >
                                    <td width="20%" align="center" border="0" > 
                                    <?php
                                     $offid=mysqli_result($res,$i,"offer_id");
                           $oname = mysqli_result($res,$i,"title"); 
                                     $odesc = mysqli_result($res,$i,"description");
                                     $oimg = mysqli_result($res,$i,"off_image");
                                     $tilldate = mysqli_result($res,$i,"till_date"); 
                           $frmdate = mysqli_result($res,$i,"frm_date"); 
                       
                             //    $qry2="select name from areas where code='$carea'";
                                     
                    // $res2=mysqli_query($con1,$qry2);                
                            //     $num3=mysqli_result($res2,0,"name"); ?>
                 <img src="offers/<?php echo $id."/".$oimg; ?>" alt="image" height="50" ></td><input type="hidden" name="oldimg" value="<?php echo $oimg; ?>">
                <td width="57%"> <b>Offer Title : </b><font color="red"><?php echo $oname; ?></font><br/>
                  <b>Date From: </b><?php echo date('d/m/Y',strtotime($frmdate)); ?> &nbsp; &nbsp;&nbsp; &nbsp;<b>Till Date:</b> <?php echo date('d/m/Y',strtotime($tilldate)); ?><br/>
                  <b>Description: </b><?php echo $odesc; ?><br/>
                 <td width="10%" > <a href="edit_offer.php?offid=<?php echo $offid; ?>"><div title="Edit" class="tipsy-s btn btn-o-icon btn-small btn-info"><i>&#xf044;</i></div></a>
                                  <a href="javascript:confirm_delete('<?php echo $offid; ?>')" ><div title="Delete" class="tipsy-s btn btn-error btn-o-icon btn-small"><i>&#xf014;</i></div>
                               
                     </a></td>
                            </tr><?php
                            }
?>
                                          </table>
                                        
                                          </td>
                                        </tr>
        </table>
        <script>
    function confirm_delete(id)
    {
      document.location="deleteoffer.php?offid="+id;  
    }
    </script>
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