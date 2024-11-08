<?php session_start();
// var_dump($_SESSION);

if (!isset($_SESSION['username'])) {?>

    <script>
        window.location.href='https://modimart.world/franchise5/admin';
    </script>

<?
}
include '../config.php';
 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


 function unique_code($limit)
{
  return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}
// echo unique_code(8);



        if(isset($_POST['ganerate']))
        {
            $user_id=$_POST['user_id'];
            $user_type=$_POST['user_type'];
            $free_limit=$_POST['free_limit'];
            $limit=$_POST['limit'];
            $reffral_code=unique_code(8);
            $date=date('Y-m-d');

            $craetedby=$_SESSION['username'];


             $sql="INSERT INTO `greetings_referral_code`(`code`, `limit`, `user_id`, `user_type`,  `created_at`, `created_by`, `free_limit`) VALUES ('".$reffral_code."','".$limit."','".$user_id."','".$user_type."','".$date."','".$craetedby."','".$free_limit."')";
           
             
             $query=mysqli_query($con3,$sql)or die(mysqli_error($con3));

?>
                  <script>
        window.location.href='https://modimart.world/franchise5/admin/ganerate_Greeting_Ref_code.php';
    </script>
    <?php


        }

?>
 
<!DOCTYPE html>
<html>
<head>
    <title>AllMart | Franchise</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://modimart.world/franchise5/typeahead.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="https://modimart.world/franchise5/style.css">
    <!-- Sweetalert Css -->
    <link href="https://modimart.world/franchise5/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />
    <!-- Favicon-->
    <link rel="icon" href="https://modimart.world/assets/logo.png" type="image/png">

    <!-- Google Fonts -->
    <link href="../https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="../https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />

        <!-- <link href="css/themes/all-themes.css" rel="stylesheet" /> -->
   <!--  <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script> -->


<!-- <script>
    if (!!window.performance && window.performance.navigation.type === 2) {
        // value 2 means "The page was accessed by navigating into the history"
        // console.log('Reloading');
        window.location.reload(); // reload whole page

    }
</script> -->

<style>
* {
    box-sizing: border-box;
}
body{
    margin: 0;
    background-color:rgb(240,240,240);
    scroll-behavior: smooth;
}

/* Style the top navigation bar */
.heading {
    overflow: hidden;
    background-color: red;
    padding-top: 10px;
}

/* Style the topnav links */
.heading a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    text-decoration: none;
    font-size: 50px;

}

/* Change color on hover */
.heading a:hover {
    color: black;
}

.main{
    background-color: white;
    padding: 20px;
    box-shadow: 5px 10px #888888;
}


table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: center;
    padding: 8px;
    /*white-space: nowrap;*/
    border: 1px solid;
}
input{
    width: 140px;
    margin-bottom: 10px;
}


#member_pic img{
    height: 150px;
    /*width: 150px;*/
    /*border: 1px solid black;*/
}



@media only screen and (max-width: 768px) {
    .col{
        margin-top: 20px;
    }

    .row{
        display: flex;
        flex-direction:column;
    }
}




/* Style the footer */
.footer {
    background-color:red;
    padding: 10px;
    text-align: center;
    padding: 30px;
    height: 280px;
    padding-left: 20px;
    padding-right: 20px;

}

.contact_us{
    color: white;
    line-height: 30px;
    font-size: 18px;
    margin-top: 20px;

}


.social_a{
    text-decoration: none;
    color: white;
}

.social_label{
    margin-left: 10px;
    margin-right: 10px;
    padding: 20px;

}
.heading {
    display: flex;
}
.logo {
    width: 30%;
}
.menu {
    width: 70%;
}
.menu ul {
    float: right;
}

.menu_ul {
    padding: 0;
    margin: 3%;
    list-style-type: none;
}
.menu ul li a {
    font-size: 18px;
}

.menu_ul{
    width: 100%;
    display: flex;
    justify-content: flex-end;
}
.menu_ul li{
    margin: auto 2%;
}
.custom_row{
    display:flex;
}

.col input,.col select{
    width:100%;
}
.cust_col{
    padding-left:1%;
    padding-right:1%;
}

.typeahead li a{
    font-size: 14px;
}


input{
    border-left: none;
    border-top: none;
    border-right: none;
}

input:focus{
    border-left: none;
    border-top: none;
    border-right: none;
}
ul {
    /* background: lightsalmon; */
    padding: 2px;
    list-style-type: none;
    width: auto;
}

#myModal td{
    text-align:left;
}

.sweet-alert button{
    margin:0 !important;
    font-size: 12px !important;
}
.sweet-alert h2{
    font-size: 20px !important;
    margin: 10px 0 !important;
}

.confirm{
    font-size: 18px;
    color: red;
    font-weight: 700;
}
.heading a:hover {
    color: cyan;
}
.nav>li>a:focus, .nav>li>a:hover{
    background-color:red;
}


ul.typeahead{
    width:100%;
}

#franchise_of{
    text-align: center;
    color: red;
    text-decoration: underline;
    font-weight: 700;
}
</style>

<style>
  .loader{
  display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('https://modimart.world/assets/loader.gif') 
              50% 50% no-repeat rgb(246 246 246 / 52%);
}
</style>
<body>
    <div class="loader"></div>
<div class="heading" style="padding-top:0px !important;">
    <div class="logo">
        <a href="https://modimart.world/franchise5/get_members.php" style="padding:10px;"><img src="https://modimart.world/assets/logo.png" alt="" style="width: 105px;background:white;border-radius: 50%;"><span style="font-size:0.7em;padding:10px;">Modimart.world</span></a>
    </div>
    <div class="menu">
        <?php include '../menu.php';?>
    </div>
</div>

<div class=" main" style="margin: 20px; width: auto; height: auto;">

    <?php 
      $user_id=$_SESSION['userid'];
                                $query=mysqli_query($con3,"SELECT * FROM `greetings_referral_code` WHERE user_id='".$user_id."' AND status='1'");
                                $count=mysqli_num_rows($query); 
                                if($count==0){
                                ?>

  <h4>Ganerate Reffral Code</h4>
    <form  action="#" method="POST">
        <div class="row mem_info" id="meminfo">
           <div class="col-md-5">
            <label>Joinning Limit</label>
            <input type="number" class="form-control" name="limit" value="100" readonly>
            <input type="hidden" class="form-control" name="user_id" value="<?=$_SESSION['userid']?>">
            <input type="hidden" class="form-control" name="user_type" value="<?=$_SESSION['rollid']?>">
           </div>
           <div class="col-md-5">
            <label>Free Trial (in days)</label>
            <input type="number" class="form-control" name='free_limit' value="3" readonly>
           </div>
           <div class="col-md-2">
            <br/>
            <input type="submit" class="btn btn-info" name="ganerate" value="Ganerate">
           </div>
        </div>

        
    </form>
    <br>
<?php } ?>
    <!-- <button id="get">Get</button> -->
    <hr>

    <div id="data_table"  >
        <h3>Below Code Share With User For Free Greeting Registration</h3>
        <table style="cursor: pointer;" id="example">
         <thead>
             <tr>
                                            <th>S. No.</th>
                                            <th>Referral Code</th>
                                            <th>Copy Code</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
                                $user_id=$_SESSION['userid'];
                                $query=mysqli_query($con3,"SELECT * FROM `greetings_referral_code` WHERE user_id='".$user_id."'");

                            // var_dump($query);
                                // $sql_result = mysqli_fetch_assoc($query);
                               foreach($query as $key => $value) {
                                  
                                ?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$value['code']?></td>
                                        <td><a href="https://wa.me/?text=<?=urlencode('https://modimart.world/franchise5/Greetings/User/Register?refcode='.$value['code'])?>" target="_blank"> https://modimart.world/franchise5/Greetings/User/Register?refcode=<?=$value['code']?></a></td>
                                    </tr>
                                    <?php
                                    }
                                      ?>
                                </tbody>
                                    
                                </table>

        <br>
        <br>
        <br>
        <br>

    </div>
    <div   >
        <h3>Below Code Share With Franchise For  Registration</h3>
        <table style="cursor: pointer;" id="example">
         <thead>
             <tr>
                                            <th>S. No.</th>
                                            <th>Referral Code</th>
                                            <th>Copy Code</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
                                $user_id=$_SESSION['userid'];
                                $query=mysqli_query($con3,"SELECT * FROM `greetings_referral_code` WHERE user_id='".$user_id."'");

                            // var_dump($query);
                                // $sql_result = mysqli_fetch_assoc($query);
                               foreach($query as $key => $value) {
                                  
                                ?>
                                    <tr>
                                        <td><?=$key+1?></td>
                                        <td><?=$value['code']?></td>
                                        <td><a href="https://wa.me/?text=<?=urlencode('https://modimart.world/franchise5/Greetings/Register/RegisterFranchise?refcode='.$value['code'])?>" target="_blank"> https://modimart.world/franchise5/Greetings/Register/RegisterFranchise?refcode=<?=$value['code']?></a></td>
                                    </tr>
                                    <?php
                                    }
                                      ?>
                                </tbody>
                                    
                                </table>

        <br>
        <br>
        <br>
        <br>

    </div>
    <div   >
        <h3>List of Register  Users</h3>
        <table style="cursor: pointer;" id="example">
        <thead></thead> 
                                <th>Sno.</th>
                                <th>ID</th>
                                <th>Customer</th> 
                                <th>Mobile</th> 
                                <th>Type </th>
                                <th>Status</th>
                                <tbody>
                                    <?php 
                                   
                                    $user_id=$_SESSION['userid'];
                                    $getdata=mysqli_query($con3,"SELECT * FROM `greetings_referral_code` Where user_id='".$user_id."'");
                                    $dataresult=mysqli_fetch_assoc($getdata);
                                  $refcode=$dataresult['code'];

                                    $getrefdata=mysqli_query($con3,"SELECT * FROM `customer_promotion` where refcode='".$refcode."' AND refcode<>''");
                                    // $refdataresult=$getrefdata->result();
                                   foreach ($getrefdata as $key => $value) {
                                      if($value['status']==0)
                                      {
                                          $status= "InActive";
                                         
                                      }
                                      else
                                      {
                                        $status= "Active";

                                      }
                                      
                                      if($value['is_franchisee']==0)
                                      {
                                          $type= "Free Customer";
                                         
                                      }
                                      elseif($value['is_franchisee']==1)
                                      {
                                        $type= "Franchise";

                                      }
                                      else{
                                          $type = "Paid Customer";
                                      }
                                     ?>
                                        <tr> 
                                        
                                            <td> <?=$key+1?></td>
                                            <td><?=$value['customer_id']?></td>
                                            <td><?=$value['customer_name']?></td>
                                            <td><?=$value['mobile_number']?></td>
                                            <td><?=$type?></td>
                                            <td><?=$status?></td>
                                            
                                        </tr>
                                    <?php } ?>
                                </tbody> 
                                </table>

        <br>
        <br>
        <br>
        <br>

    </div>

</div>
<br>

<hr>

</div>

<br>


<style>
    .loader_img{
        height:100px;
    }
</style>






<!-- SweetAlert Plugin Js -->
<script src="https://modimart.world/franchise5/plugins/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="https://modimart.world/franchise5/js/pages/ui/dialog2.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>

    
</body>
</html>