<?php
session_start();

 if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];

include "config.php"; 
 $qry2="select max(code) as ncode from products";   

                          $res2=mysqli_query($con1,$qry2);

                          $row2=mysqli_fetch_array($res2);   
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
  <link href="css/date_css.css" rel="stylesheet" type="text/css" />
<script src="js/datepick_js.js" type="text/javascript" charset="utf-8"></script>

  <!-- Title -->
  <title>1clickguide user panel</title>
<script>
  </script>
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
              <h3 class="widget-header-title"><strong>Add Offer </strong></h3>
            </header>
            <div class="widget-body">
             <div>
       
  
   	<form id="form11" name="form11" action="processAddOffer.php" method="post" enctype="multipart/form-data" >
                                          
      <table class="tables"  align="center" cellpadding="4" cellspacing="0" >
                                                <tr>

                                                  <td align="center" colspan="2"><b><font color="#000000" size="+1">YOUR OFFER DETAILS</font></b> </td>

                                                                                             
                                                <tr>

                                                  <td>Offer Title</td>

                                                  <td colspan="3"><input type="text" name="oname" class="form form-full"/></td>

                                                </tr>

                                                <tr>

                                                  <td><div align="left">Offer Description</div></td>

                                                  <td colspan="3"><textarea name="odesc" class="form form-full" ></textarea></td>

                                                </tr>

		            						  <tr>

                                                  <td><div align="left"> Offer From Date</div></td>

                                                  <td colspan="3"><div id="res"><input type="text" name="frmdate" id="field-pick-date" class="form form-full firstcal" placeholder="DD/MM/YYYY"/></div>

                                                    </td>

                </tr>
												<tr>

                                                  <td><div align="left"> Offer Till Date</div></td>

                                                  <td colspan="3"><div id="res"><input type="text" name="tilldate" id="field-pick-date1" class="form form-full firstcal" placeholder="DD/MM/YYYY"/></div>

                                                    </td>

                </tr>
                                                <tr>

                                                  <td><div align="left">Offer Image</div></td>

                                                  <td colspan="3"><input type="file" name="oimg" class="form" /></td>

                                                </tr>                                                                                               

                                              
                                        <tr>

                                          <td colspan="2" align="center">
<input type="hidden" name="ccode" id="ccode" value="<?php echo $id; ?>">
                                            <input type="submit" value="Add Offer" id="submit" name="submit" class="btn btn-submit" />
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