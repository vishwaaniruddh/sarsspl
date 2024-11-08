<? include('config.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables with AJAX and Filters</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            var dataTable = $('#sitesdata').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "server_processing.php",
                    "type": "POST"
                }
            });

            // Handle form submission
            $('#sitesForm').on('submit', function(e) {
                e.preventDefault();
                dataTable.ajax.reload(); // Reload DataTable with new data
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <!-- Filter Form -->

                                <div class="card" id="filter">
                                    <div class="card-block">
                                        <form id="sitesForm" action="<?php echo basename(__FILE__); ?>" method="POST">
                                            <div class="row">
                                                 
                                                <div class="col-md-3">
                                                    <label>Status</label>
                                                    <select id="multiselect_status" class="form-control" name="status">
                                                        <option value=""> Select </option>
                                                        <option value="all" <?php if(isset($_POST['status'])) { if($_POST['status']=='all'){ echo 'selected' ;  }} ?>>All</option>
                                                        <option value="0" <?php if(isset($_POST['status'])) { if($_POST['status']=='0'){ echo 'selected' ;  } } ?>>Engineer Allocated</option>
                                                        <option value="1" <?php if(isset($_POST['status'])) { if($_POST['status']=='1'){ echo 'selected' ;  } } ?>>Engineer Not Allocated</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>ATMID</label>
                                                    <input type="text" id="atmid" class="form-control" list="atmidOptions" name="atmid" value="<?= $_REQUEST['atmid'];?>">
                                                    <datalist id="atmidOptions"></datalist>
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>Customer</label>
                                                    <select name="cust" class="form-control mdb-select md-form" searchable="Search here..">
                                                        <!--<option value="">Select</option>-->
                                                        <option value="" selected>Choose Customer</option>
                                                        
                                                        <?php 
                                                        $i = 0;
                                                        $custlist= mysqli_query($con,"SELECT id,customer from mis_newsite where customer!='' group by customer ");
    											        while($fetch_data = mysqli_fetch_assoc($custlist)){
    											     ?>
											        <option value="<?php echo $fetch_data['customer'] ?>" <?php if($_POST['cust']== $fetch_data['customer']){ echo 'selected'; }  ?>>
											         <?php echo $fetch_data['customer'];?>
											         </option>
											         <?php } ?>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>engineer</label>
                                                    <select name="engineer" class="form-control js-example-basic-single" searchable="Search here..">
                                                        <!--<option value="">Select</option>-->
                                                        <option value=""  selected>Choose Engineer</option>
                                                        <?php 
                                                        // $i = 0;
                                                        $englist= mysqli_query($con,"SELECT engineer_user_id from mis_newsite where engineer_user_id !='' and engineer_user_id != '0' group by engineer_user_id ");
    											        while($fetch_data = mysqli_fetch_assoc($englist)){
    											            if(mysqli_num_rows($englist)>0){
    											            $engid = $fetch_data['engineer_user_id'];
    											            
											            $engname = mysqli_query($con,"select id,name from mis_loginusers where id = '".$engid."' ");
											            $fetch_eng = mysqli_fetch_assoc($engname);
											            
    											            
    											            
    											     ?>
											        <option value="<?php echo $fetch_eng['id'] ?>" <?php if($_POST['engineer']== $fetch_eng['id']){ echo 'selected'; }  ?>>
											         <?php echo $fetch_eng['name'];?>
											         </option>
											         <?php } } ?>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>BM</label>
                                                    <select name="bm" class="form-control js-example-basic-single" searchable="Search here..">
                                                        <!--<option value="">Select</option>-->
                                                        <option value=""  selected>Choose BM</option>
                                                        
                                                        <?php 
                                                        $i = 0;
                                                        $bmlist= mysqli_query($con,"SELECT id,bm_name from mis_newsite where bm_name!='' and bm_name!='-' group by bm_name ");
    											        while($fetch_data = mysqli_fetch_assoc($bmlist)){
    											     ?>
											        <option value="<?php echo $fetch_data['bm_name'] ?>" <?php if($_POST['bm'] == $fetch_data['bm_name']){ echo 'selected'; }  ?>>
											         <?php echo $fetch_data['bm_name'];?>
											         </option>
											         <?php } ?>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>state</label>
                                                    <select name="state" class="form-control js-example-basic-single" searchable="Search here..">
                                                        <!--<option value="">Select</option>-->
                                                        <option value=""  selected>Choose State</option>
                                                        
                                                        <?php 
                                                        $i = 0;
                                                        $statelist= mysqli_query($con,"SELECT id,state from mis_newsite where state!='' group by state ");
    											        while($fetch_data = mysqli_fetch_assoc($statelist)){
    											     ?>
											        <option value="<?php echo $fetch_data['state'] ?>" <?php if($_POST['state'] == $fetch_data['state']){ echo 'selected'; }  ?>>
											         <?php echo $fetch_data['state'];?>
											         </option>
											         <?php } ?>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>zone</label>
                                                    <select name="zone" class="form-control mdb-select md-form" searchable="Search here..">
                                                        <!--<option value="">Select</option>-->
                                                        <option value=""  selected>Choose Zone</option>
                                                        
                                                        <?php 
                                                        $i = 0;
                                                        $zonelist= mysqli_query($con,"SELECT id,zone from mis_newsite where zone!='' and zone!='select' group by zone ");
    											        while($fetch_data = mysqli_fetch_assoc($zonelist)){
    											     ?>
											        <option value="<?php echo $fetch_data['zone'] ?>" <?php if($_POST['zone'] == $fetch_data['zone']) { echo 'selected'; }  ?>>
											         <?php echo $fetch_data['zone'];?>
											         </option>
											         <?php } ?>
                                                    </select>
                                                    
                                                </div>
                                                
                                                <div class="col-md-3">
                                                    <label>Site Status</label>
                                                    <select id="multiselect_status" class="form-control" name="site_status">
                                                        <option value=""> Select </option>
                                                        <option value="1" <?php if(isset($_POST['site_status'])) { if($_POST['site_status']=='1'){ echo 'selected' ;  }} ?>>Active</option>
                                                        <option value="0" <?php if(isset($_POST['site_status'])) { if($_POST['site_status']=='0'){ echo 'selected' ;  } } ?>>In-Active</option>
                                                    </select>
                                                </div>
                                                 
                                            </div>
                                            <br>
                                           <div class="col" style="display:flex;justify-content:center;">
                                                 <input type="submit" name="submit" value="Filter" class="btn btn-primary">
                                                <a class="btn btn-warning" id="hide_filter" style="color:white;margin:auto 10px;">Hide Filters</a>
                                             </div>
                                            
                                     </form>
                                    
                                    <!--Filter End -->
                                    <hr>
                                          
                                      </div>
                                    </div>


        <!-- DataTable -->
        <table id="sitesdata" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>
