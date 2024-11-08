<?php
session_start();
include('config.php');
include('adminaccess.php');
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Admin Panel</title>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
<![endif]-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">


 
<script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

<!--  checkbox styling script -->
<script src="js/jquery/ui.core.js" type="text/javascript"></script>
<script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="js/jquery/jquery.bind.js" type="text/javascript"></script>

<!--  styled select box script version 1 -->
<script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>


<!--  styled select box script version 2 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>


<!--  styled select box script version 3 --> 
<script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>


<!--  styled file upload script --> 
<script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>


<!-- Custom jquery scripts -->
<script src="js/jquery/custom_jquery.js" type="text/javascript"></script>
<!-- Tooltips -->
<script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>

<!--  date picker script -->
<link rel="stylesheet" href="css/datePicker.css" type="text/css" />
<script src="js/jquery/date.js" type="text/javascript"></script>
<script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>


<script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>

<style>
     #content-outer
  {
    background: white;
  }
</style>
</head>
<body> 

<!-- End: page-top-outer -->

<?php include('header.php');?>
<!-------------------------------- start nav-outer-repeat.... END ----------------------------->
<div class="clear"></div>
<div id="content-outer">
<!-- start content -->
<div id="content">
    <!--  start page-heading -->
    <div id="page-heading">
        <h1>Manage Homepage Ads</h1>
    </div>
    <!-- end page-heading -->
    <div class="row">
        <div class="col-md-12">
            <a href="add_homepage_advertising.php" class="btn btn-primary text-right">Add Advertisigment</a>
        </div>        
        <div class="col-md-12">

            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>name</th>
                    <th>image</th>
                    <th>Postion</th>
                    <th>Status</th>
                    <th>Action</th>                  
                </tr>
                </thead>
                <tbody >
                <?php 
                $i=1;
                  $select_sql=mysqli_query($con1,"SELECT * FROM `homepage_ads` ");
                while($order=mysqli_fetch_assoc($select_sql)){
                    ?>
                    <tr>
                        <td><?=$i+1?></td>
                        <td><?=$order['name'] ?></td>
                        <td><img src="/<?=$order['img_path']?>" alt="" style="width: 100px;"></td>                        
                        <td>
                            <?php 
                            if ($order['position']==1) {
                                echo "Left Side";
                             }
                             else if ($order['position']==2) {
                                 echo "Center Side";
                             }
                             elseif ($order['position']==3) {
                                  echo "Right Side";
                              }
                               ?></td>                        
                        <td>
                            <?php 
                            if($order['status']==1)
                             {?>
                               <span class='btn btn-success' onclick="changeStatus('<?=$order["id"]?>')">Active</span>
                            <?}
                            else
                            {
                            ?>
                             <span class='btn btn-danger'  onclick="changeStatus('<?=$order["id"]?>)">Disactive</span>
                           <?php
                            } ?>
                           </td>                        
                        <td><a href="deleteAds.php?ads_id=<?=$order['id']?>" onclick="return Delete()" class="btn btn-primary btn-sm">Delete</a> </td>                        
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    

    
</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->
<div class="clear">&nbsp;</div>
<!-- start footer -->         
<div id="footer">
    <div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


<script>
    function Delete()
    {
        return confirm("Are You Sure! Delete This Record");

    }
</script>
<script>
    function changeStatus (ad_id) {
        alert(ad_id);
    }
</script>
</body>
</html>