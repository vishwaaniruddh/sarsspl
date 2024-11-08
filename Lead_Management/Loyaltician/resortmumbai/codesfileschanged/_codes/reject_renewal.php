<?php session_start(); ?>
<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="http://www.allmart.world/franchise/css/style.css">
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
                                <i class="mdi mdi-table "></i></span> Reasons To Reject
                                
                                <?
                                
                                $date = date("Y-m-d H:i:s");
                                // echo $date;
                                
                                $id = $_GET['id'];
                                if(isset($_POST['submit'])){
                                    
                                    $reasons = $_POST['reasons'];
                                    
                                    $reasons = implode(', ', $reasons); 

                    $update = "update Members set canceledMember='1',CancelationDate='".$date."', MemberCancelationReason='".$reasons."' where Static_LeadID='".$id."'";
                           
                           if(mysqli_query($conn,$update)){ ?>
                                <script>
                                alert("Rejected Succesfully !");
                                window.location.href="renewals.php";
                                </script>
 
                           <?php }
                           else{ ?>
                           
                            <script>
                            alert("Reject Error ! Please try Again !");
                            window.location.href="renewals.php";
                            </script>

                           <?php } } ?>
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
            
        <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $id;?>" method="post">
            
        <br>

        <h1>Please Select The Reasons To Reject </h1>
        <br>
        <br>
            <div class="demo-checkbox">
        
                    <?
                        // var_dump($_GET);
                                    
                        $sql = mysqli_query($conn,"select * from CloseRenewal where status='1'");
                        $i=1;
                                    
                        while($sql_result = mysqli_fetch_assoc($sql)){ ?>
                
                
                <input type="checkbox" name="reasons[]" value="<?php echo $sql_result['closeRenewal_id'];?>" id="basic_checkbox_<?php echo $i;?>" class="filled-in">
                
                <label for="basic_checkbox_<?php echo $i;?>"><?php echo $sql_result['CloseRenewalReason'];?></label>
                
                <br>
                
                                    <?php $i++; } ?>
                                    
                                    
                
                        </div>
                        <br>

                        <input type="submit" name="submit" value="Reject" class="btn btn-danger">
                        <br>

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