<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 

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
  <title>Edit Offer</title>
<script>
 
</script>
<?php
$offid=$_GET['offid'];

include('header.php');
$fetchqry=mysqli_query($con1,"SELECT * FROM `offers` where `offer_id`='$offid' and `cust_id`='$id'");
$res=mysqli_fetch_row($fetchqry);
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
              <h3 class="widget-header-title"><strong>Edit Offer </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   	<form id="form11" name="form11" action="processEditOffer.php" method="post" enctype="multipart/form-data" >
                                          
      <table class="tables"  align="center" cellpadding="4" cellspacing="0" >
                                                <tr>

                                                  <td align="center" colspan="2"><b><font color="#000000" size="+1">YOUR OFFER DETAILS</font></b> </td>

                                                                                             
                                                <tr>

                                                  <td>Offer Title</td>

                                                  <td colspan="3"><input type="text" name="oname" class="form form-full" value="<?php echo $res[2];?>"/></td>

                                                </tr>

                                                <tr>

                                                  <td><div align="left">Offer Description</div></td>

                                                  <td colspan="3"><textarea name="odesc" class="form form-full" ><?php echo $res[6];?></textarea></td>

                                                </tr>

		            						  <tr>

                                                  <td><div align="left"> Offer From Date</div></td>

                                                  <td colspan="3"><div id="res"><input type="text" name="frmdate" class="form form-full firstcal"  value="<?php echo date('d/m/Y',strtotime($res[4]));?>"/></div>

                                                    </td>

                </tr>
												<tr>

                                                  <td><div align="left"> Offer Till Date</div></td>

                                                  <td colspan="3"><div id="res"><input type="text" name="tilldate" class="form form-full firstcal"  value="<?php echo date('d/m/Y',strtotime($res[5]));?>"></div>

                                                    </td>

                </tr>
                                                <tr>

                                                  <td><div align="left">Offer Image</div></td>

                                                  <td colspan="3"><input type="file" name="oimg" class="form" /><input type="hidden" name="oldimg" value="<?php echo $res[3];?>" ><img src="offers/<?php echo $id."/".$res[3];?>" width="50" height="50"></td>

                                                </tr>                                                                                               

                                              
                                        <tr>
										<input type="hidden" name="offid" value="<?php echo $res[0];?>">
                                          <td colspan="2" align="center">
<input type="hidden" name="ccode" id="ccode" value="<?php echo $id; ?>">
                                            <input type="submit" value="Edit Offer" id="submit" name="submit" class="btn btn-submit" />
                                              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
    <!--  <input type="button" value="Cancel" id="submit" name="submit" class="btn btn-error" onClick="javascript:window.back()" />-->

                                        

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