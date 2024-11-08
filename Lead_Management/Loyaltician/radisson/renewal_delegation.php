<?php session_start(); ?>
<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    
    <style>
        .expire,.expired{
            background:#faebd7;
        }
        .about_to_expire{
            background:#FFC107;
            color:white;
        }
        .about_to_expired{
            background:#FFC107;
        }
        
        .about_to_expired,.expired{
            height: 25px;
            width: 25px;
            margin: auto 1%;
            /*border-radius: 20px;*/
            
        }
    </style>
    
</head>
<body class="sidebar-pinned">


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Renewal Delegation 
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                                    

                        <div class="card-body">
                            
                            <form action="process_renewal_delegation.php" method="post">
                                
                            
                            <?php $sql = mysqli_query($conn,"select * from Users where roll_id='21'");
                            
                            while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                                
                                <div style="padding: 1%;font-size: 18px; margin: auto 1%;">
                                    <input type="hidden" name="member_id" value="<?php echo $_GET['id']; ?>"> 
                                    <input type="radio"  name="renewal_del" value="<?php echo $sql_result['UserId'];?>" style="height: 20px; width: 20px;margin: auto 1%;">
                                    <span><?php echo $sql_result['UserName']; ?></span>
                                </div>                                
                                
                            <?php  } ?>
                            <input type="submit" name="submit" class="btn btn-danger" value="Delegate">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include('belowScript.php');?><script src="assets/vendor/DataTables/datatables.min.js"></script>
<script src="assets/js/datatable-data.js"></script>
</body>
</html>