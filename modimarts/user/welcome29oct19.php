<?php
session_start();
if(isset($_SESSION['adminuser']) && isset($_SESSION['id']))
{	
$id=$_SESSION['id'];
include "config.php"; 
$sql = mysql_query("SELECT * FROM `clients` WHERE code ='$id'");
$row = mysql_fetch_array($sql);
//echo $row[0];							  
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
  <title>Merchant-Welcome</title>
  <script>
  function a(){
    <?php $Q="select tilldate from Subscription where mid='".$id."'";
        $ret = mysql_query($Q);
        $rows = mysql_fetch_array($ret);
        $sdate=date("Y-m-d");
        $mont=$rows[0];
        $date1=date_create("$sdate");
        $date2=date_create("$mont");
        $diff=date_diff($date1,$date2);
         $diffck= $diff->format("%R%a ");
        $txt="";
        if($diffck==+2){$txt = "Subscription expire after two days"; }
        if($diffck==+1){$txt = "Subscription expire after one days";}
        if($txt!=""){
    ?>
        alert("<?php echo $txt ?>");<?php }?>
  }
  </script>
  </head>
  <body onload="a();">
<?php
include('header.php');
?>        
        <!-- Title & Sitemap -->
        <div class="title-sitemap grid-12">
          <h1 class="grid-6"><i>&#xf132;</i><span>Welcome to User Panel</span></h1>
         <!-- <div class="sitemap grid-6">
            <ul>
              <li><span>1click</span><i>/</i></li>
              <li><a href="index.php">User Panel</a></li>
            </ul>
          </div>-->
        </div>
      </header>
      <!-- Data -->
      <div class="data grid-12">
        <!-- Simple Chart -->
        <div class="grid-12">
          <div class="widget">
            <header class="widget-header">
              <div class="widget-header-icon">&#xf109;</div>
              <h3 class="widget-header-title"><strong>Profile details</strong></h3>
            </header>
            <div class="widget-body">
                <div>
   	                <table class="tables" align="center" cellpadding="4" cellspacing="0">
                        <tbody>
                            <tr>
                                <td  align="center" >You are successfully registered as a Merabazar user</td>
                            </tr>
                            <tr>
                                <td align="left"><p align="center"><span >Your personal details  given during  registration process are as under...</span><br />
                                    <span class="style257">(in case of modification required you need to do the same from the view profile section). </span></p></td>
                            </tr>
                            <tr>
                                <td><table class="tables" width="679" height="376" align="center">
                                    <tbody>
                                        <tr>
                                            <td >&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td >Registration Date : </td>
                                            <td ><?php $dt= $row['rdate'];
                                                echo   date('d/m/Y',strtotime($dt));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td >Company Name : </td>
                                            <td ><?php echo $row['name']; ?>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td > Address : </td>
                                            <td ><?php echo $row['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td > City : </td>
                                            <td>
                                                <?php 
                                                $selctcity=mysql_query("select name from cities where code='".$row['city']."'");
                                                //echo "select state_name from cities where code='".$row['city']."'";
                                                $selctcityf=mysql_fetch_row($selctcity);
                                                echo $selctcityf[0]; ?></td>
                                            </tr>
                                            <tr>
                                                <td >State : </td>
                                                <td ><?php 
                                                    $selctstate=mysql_query("select state_name from states where state_code='".$row['state']."'");
                                                    $selctstatef=mysql_fetch_row($selctstate);
                                                    echo $selctstatef[0]; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >Email : </td>
                                                <td ><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Category :</td>
                                                <td ><?php echo $row['category']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Contact Name : </td>
                                                <td ><?php echo $row['contact']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Mobile : </td>
                                                <td ><?php echo $row['mobile']; ?></td>
                                            </tr>
                                            <tr>
                                                <td >Phone : </td>
                                                <td ><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <?php $Q1="select amount from Subscription where mid='".$id."' and status='".Active."'";
                                            $ret1 = mysql_query($Q1);
                                            $rows1 = mysql_fetch_array($ret1);
                                            ?>
                                            <tr>
                                                <td >Amount Paid : </td>
                                                <td ><?php echo $rows1[0]; ?></td>
                                            </tr>
                                            <?php //} 
                                            ?>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
<?php
}else
{ 
 header("location: index.php");
}
?>