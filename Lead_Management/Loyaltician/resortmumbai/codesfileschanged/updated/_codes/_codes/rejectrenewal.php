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
                                <i class="mdi mdi-table "></i></span> Close Renewal 
                        </h4>
                    </div>
                </div>
            </div>
        </div>



<?
if(isset($_POST['submit'])){
    
    $reason = $_POST['reason'];
    
    // echo "insert into CloseRenewal(CloseRenewalReason) values('".$reason."')";
    $insert_sql = mysqli_query($conn,"insert into CloseRenewal(CloseRenewalReason,status) values('".$reason."',1)");
    
}


?>
        <div class="container">

            <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 Add Reasons
                                 

                            </h5>

                        </div>


                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        	


                        <div class="card-body ">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="segment">Reason</label>
                                    <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason">
                                </div>
                            </div>



                            <div class="form-group">
                                <button name="submit" class="btn btn-primary">submit</button>
                            </div>
                        </div>


                        </form>


                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="card m-b-30">
                        <div class="card-header">
                            <h5 class="m-b-0">
                                 All Reject Renewal Reasons
                            </h5>
                           
		<div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

		    <div class="row"><div class="col-sm-12">
		        <table id="example" class="table dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="example_info">
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 1019px;" aria-label="Sr. No.: activate to sort column descending" aria-sort="ascending">#</th>
                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 1019px;" aria-label="Sr. No.: activate to sort column descending" aria-sort="ascending">Reasons</th>
                        
                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 1019px;" aria-label="Sr. No.: activate to sort column descending" aria-sort="ascending">Delete</th>
                        </tr>

</thead>
<tbody>
    
    <?php $get_sql = mysqli_query($conn,"SELECT * FROM CloseRenewal where status='1' order by closeRenewal_id ASC");
    
    $i=1;
    while($get_sql_result = mysqli_fetch_assoc($get_sql)){ ?>

    <tr role="row">
        
        <td>
            <?php echo $i;?>
        </td>
        <td>
            <?php echo $get_sql_result['CloseRenewalReason'];?>
        </td>
        
        <td>
            <a href="delete_close_renewal.php?id=<?php echo $get_sql_result['closeRenewal_id'];?>" class="btn btn-danger">
                Delete
            </a>
        </td>
        
        
    </tr>
    
    <?php $i++; } ?>



</tbody>
</table>
</div>
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