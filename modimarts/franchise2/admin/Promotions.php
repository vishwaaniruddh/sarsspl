<?php
session_start();
include '../config.php';
error_reporting(0);

function get_promotion($id)
{
    global $con;

    $sql        = mysqli_query($con, "select * from promotions where id ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['promotions'];
}

function get_language($id)
{
    global $con;

    $sql        = mysqli_query($con, "select * from promotions where id ='" . $id . "'");
    $sql_result = mysqli_fetch_assoc($sql);

    return $sql_result['promotions'];
}

function lang_promo($language, $promotion)
{
    global $con;

    $sql = mysqli_query($con, "select * from total_promotions  where promotion='" . $promotion . "' and language='" . $language . "'");
    if ($sql_result = mysqli_fetch_assoc($sql)) {
        return 1;
    } else {
        return 0;
    }

}
?>
<html>
<head>
    <title>AllMart | Franchise</title>
    <link rel="shortcut icon" href="https://modimart.world/assets/logo-original.png" type="image/png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="typeahead.js"></script>
      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- Sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

        <!-- JQuery DataTable Css -->
    <link href="/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="/css/style.css" rel="stylesheet">


<style>
table, td, th {
  border: 1px solid black;
  text-align: center;
}

table {
  border-collapse: collapse;
  width: 100%;
}

td{
    /*background-color: #ffeee6;*/
    background-color: #fff;
}

th, td {
  padding: 7px;
}

</style>

<style>
    * {
    box-sizing: border-box;
    }
    body{
    margin: 0;
    background-color:rgb(240,240,240);
    
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

</head>

<body>
<?
$id = $_GET['id'];
?>
    <div class="heading">

        <div class="logo">
        <a href="https://modimart.world/franchise2/get_members.php"><img src="../2.png" alt="" style="width: 100px; padding:10px;"><span style="font-size:0.7em;">Modimart.world</span></a>
        </div>

        <div class="menu">
          <?include '../menu.php';?>
        </div>

    </div>
<br>
<br>
<div class="contaner" style="margin: 2%;">
    <a href="?id=<?=$_GET['id']?>&type=1&use=0" class="btn btn-primary">Advertisement</a>
    <a href="?id=<?=$_GET['id']?>&type=2&use=0" class="btn btn-primary">Greeting</a>
    <a href="?id=<?=$_GET['id']?>&type=2&use=1" class="btn btn-primary">Greeting Promo</a>
</div>
    <div class="container-fluid" style="overflow-x:auto;">

<?php
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $use = $_GET['use'];
    if ($type == 1) {
        $name = "Advertisement";
        $cond = '';
    } else {
        $name = "Greeting";
        $cond = ' WHERE id in (1,2)';
    }
} else {
    $type = '1';
    $use = '0';
    $name = "Advertisement";
    $cond = '';
}
?>
<div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
  <tr>
    <th>Sr.No</th>
    <th>Date</th>
    <th><?=$name?> Name</th>
<?$lang_sql = mysqli_query($con, "SELECT * FROM `language` $cond ORDER BY `language`.`order_in` ASC");
while ($lang_sql_result = mysqli_fetch_assoc($lang_sql)) {?>

   <th><?echo $lang_sql_result['language']; ?></th>

<?}

?>


  </tr>

  <?

$sql = mysqli_query($con, "SELECT * FROM promotions WHERE status='1' AND type='" . $type . "' ORDER BY ABS( DATEDIFF( created_at, NOW() ) )");
$i   = 1;
while ($sql_result = mysqli_fetch_assoc($sql)) {
    $promotion = $sql_result['id'];
//   echo $promotion;
    ?>
  <tr>
    <td><?=$i?></td>
    <td><?echo date('d-M-Y', strtotime($sql_result['created_at'])); ?></td>
    <td><?echo $sql_result['promotions']; ?> </td>

<?$lang_sql = mysqli_query($con, "SELECT * FROM `language` $cond ORDER BY `language`.`order_in` ASC");

    while ($lang_sql_result = mysqli_fetch_assoc($lang_sql)) {

        $language = $lang_sql_result['id'];

        if (lang_promo($language, $promotion) == 1) {?>
      <td >
        <?php if($use==1){ ?>
             <a href="greetview_promotion.php?id=<?echo $id; ?>&language=<?echo $language; ?>&promotion=<?echo $promotion; ?>" style="color:red;">Yes</a>
         <?php }else{ ?>
        <a href="view_promotion.php?id=<?echo $id; ?>&language=<?echo $language; ?>&promotion=<?echo $promotion; ?>" style="color:red;">Yes</a>
    <?php } ?>
    </td>
<?} else {?>
      <td style="color:red;">No</td>
<?}

    }

    ?>
  </tr>
<?
    $i++;
}

?>

</table>
</div>
</div>

    <!-- Jquery Core Js -->
    <script src="/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="/plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="/js/admin.js"></script>
    <script src="/js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="/js/demo.js"></script>

</body>
</html>