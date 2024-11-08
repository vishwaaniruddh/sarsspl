<?php
session_start();
	//var_dump($_SESSION['designation']);
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['SESS_USER_NAME']) || (trim($_SESSION['SESS_USER_NAME']) == '')) 
	{
		header("location: access-denied.php");
		exit();
	}*/
?>
<?php 
//	ini_set( "display_errors", 0);

include('config.php');
include('access.php');
include('header.php'); 
$qry =mysqli_query($con1,"SELECT * FROM resale_category ");

?>
<html>
    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
        <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    </head>
    <body>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No</th>
                <th>Name</th>
                <th>Status</th>
                 <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  while($row=mysqli_fetch_assoc($qry)){?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td><i class="fa fa-trash-o" aria-hidden="true"></i>
                <td><?php if($row['status']==1){ echo 'Active';} else{ echo 'InActive';}?></td>
                <td>
                    <a href="add_resaleCategory.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil" aria-hidden="true">Edit</i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        <!--<tfoot>
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Status</th>
                
            </tr>
        </tfoot>-->
    </table>
    </body>
</html>
