<? include('config.php');?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>All Mart | Members </title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
    
        <link href="css/themes/all-themes.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  
  
    <style>
        section.content{
        margin: 13% 15px 0 15px;
        }
               .navbar-nav {
     margin: 2% auto !important;
}

        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
    
        <style>
               section.content{
    margin: 13% 15px 0 15px;
        }
        
        td{
    overflow: hidden;
    text-overflow: ellipsis;
        }
        .navbar-nav {
     margin: 2% auto !important;
}
#member_pic img{
    height: 150px;
    /*width: 150px;*/
        border: 1px solid black;
}
.table tbody tr td{
    vertical-align: baseline;
    
}

@media (min-width: 991px) { 
    
.custom_row{
    display:flex;
}

}

@media (max-width: 991px) { 
    
.margin_row{
    margin: 30% auto;
}

}
#modal_body table{
    font-size:13px;
}


@media (min-width: 768px){

.modal-dialog {
    width: 900px;
    margin: 30px auto;
}    
}

 .navbar {
    background-color: #F44336;
}

 .nav > li > a {
    color: #fff;
}
table{
    width:100%;
}
    </style>
    
    
</head>
<body>
    
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header" style="min-width: 200px;">

                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand" href="http://www.allmart.world/franchise/" style="display:flex;height: 100px;margin: auto; line-height: 3;     padding: 0;
    width: 100%;">
                                    <img src="https://allmart.world/assets/allmart.2png" style="width:100px;" >
                    <span style="margin: auto 5%; color:white;">AllMart</span>
                
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <? include('menu.php');?>
                
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    
    

<section class="content">
    
    <div class="container-fluid">
        
    
<table class="table table-bordered table-striped table-hover dataTable js-exportable">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Joining Date</th>
      <th scope="col">Position Level</th>
      <th scope="col">Position Name</th>
      <th scope="col">Count</th>
      <th scope="col">Amount (In Rs.)</th>
      <th scope="col">Eligible For Commission</th>
      <th scope="col">View Joinees</th>
    </tr>
  </thead>
  <tbody>




<? 
$member_sql = mysqli_query($con,"select id,name,created_at,level_id,star from new_member where status=1  and intro_id>0");
$i = 1;
while($member_sql_result = mysqli_fetch_assoc($member_sql)){
    
    
    $name = $member_sql_result['name'];
    $date = $member_sql_result['created_at'];
    $id = $member_sql_result['id'];
    $level = $member_sql_result['level_id'];
    $star = $member_sql_result['star'];
    if($date < '2020-08-20' ){
        
        $sql = mysqli_query($con,"SELECT * FROM `new_member` WHERE  created_at < '2020-08-31' and status=1 and intro_id ='".$id."' and id <> '".$id."'");
        $intro_count = mysqli_num_rows($sql);
        $amount = $intro_count*500;
        
        
        if($level == 8){
            
                if($amount>1000){
                    $amount=1000;
                }
              if($intro_count > 1){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }
        else{
            
        if($amount>5000){
                    $amount=5000;
                }
              
                
            if($intro_count > 9){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }
        
        
        
        if($intro_count>0){
            
        
        ?>
            <tr>
      <th scope="row"><? echo $i;?></th>
      <td><? echo $id ;?></td>
      <td><? echo $name ;?></td>
      <td><? echo $date; ?></td>
      <td><? echo $level; ?></td>
      <td><? echo $star; ?></td>
      <td><? echo $intro_count; ?></td>
      <td><? echo $amount; ?></td>
      <td><? echo $eligible; ?></td>
      <td>
          <a class="btn btn-danger" onclick="window.open('https://www.allmart.world/franchise/view_joinees.php?id=<? echo $id; ?>','popUpWindow','height=500,width=400,left=00,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">See Joinees</a>
      </td>
      
    </tr>
    <? 
    $i++;
        }
    
                   

    
            
    }
    else{
        
        
        $till_date = date('Y-m-d', strtotime($date . '+10 days'));
        
        $sql = mysqli_query($con,"SELECT * FROM `new_member` WHERE  created_at <= '".$till_date."' and status=1 and intro_id ='".$id."' and id <> '".$id."'");
        $intro_count = mysqli_num_rows($sql);
        
        $amount = $intro_count*500;
        
        
        if($level == 8){
            
            if($intro_count > 1){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
            if($amount>1000){
                    $amount=1000;
                }
            
        }
        else{
            if($amount>5000){
                    $amount=5000;
                }
    
    if($intro_count > 9){
                $eligible = 'Yes';
                
            }
            else{
                $eligible = 'No';
            }
            
            
        }

        
        if($intro_count>0){
            
        
    ?>
    <tr>
      <th scope="row"><? echo $i;?></th>
      <td><? echo $id ;?></td>
      <td><? echo $name ;?></td>
      <td><? echo $date; ?></td>
      <td><? echo $level; ?></td>
      <td><? echo $star; ?></td>
      <td><? echo $intro_count; ?></td>
      <td><? echo $amount; ?></td>
      <td><? echo $eligible; ?></td>
      
    <td><a class="btn btn-danger" onclick="window.open('https://www.allmart.world/franchise/view_joinees.php?id=<? echo $id; ?>','popUpWindow','height=500,width=400,left=00,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">See Joinees</a></td>
      
    </tr><?
        $i++;
            
        }
    }
    
    
    // echo '<br>';
    
}?>


  </tbody>
</table>  
</div>
</section>




     <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>