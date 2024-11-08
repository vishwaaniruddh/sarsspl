<?php session_start();
include('function.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?> 

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
thead {
    background: #3939bd;
    color: white;
}

.footer {
    background-image: url("download.jpg");
    color: #FFFFFF;
    font-size:.8em;
    margin-top:25px;
    padding-top: 15px;
    padding-bottom: 10px;
    position:fixed;
    left:0;
    bottom:0;
    width:100%;
}

</style>
    <style>
    
body {
    display: flex;
  flex-direction: column;
    
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #ffd942;
}

</style>
<title>Dash Board</title>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  



<?php include 'header.php'; ?>

<link rel="stylesheet" type="text/css" href="style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="datatable/dataTables.bootstrap.css">
</head>



<body style="background-color: #e0fde0;" >
  <div class="container">  <div class="footer">
  <p align="left" style="margin-bottom: 2px;padding-left: 18px;">CSS</p>
</div></div>
<?php include('menu.php') ?>

     <script>
         $(document).ready(function() {
             $('#example').DataTable( {
        	    "order": [],
        		"processing": true,
        		"serverSide": true,
        		"ajax": "json/get_boq.php",
        		"columnDefs": [
        		    {
        		        "render": createManageBtn,
        		        "data": 5,
        		        "targets": [0]
        		    }
        		    ],
        		"search": {
                    "caseInsensitive": true
                }
        	});
         });

        function createManageBtn() {
            return '<button id="manageBtn" type="button" class="btn btn-success btn-xs"> Update </button>';
        }
        
        var table;
$(document).ready( function () {
 table  = $('#example').DataTable();
} );


$('body').on('click', '#manageBtn', function(){
        var row  = $(this).parents('tr')[0];
        let data =  table.row( row ).data() 
        var id = data[1];   
        window.location.href="update_incoming_boq.php?id="+id ; 
});



     </script>

<div style="margin:1%"></div>
<div class="container-fluid">
    <div class="card">
        <div class="card-block" style="overflow: scroll;">
            <h5>PROJECT TRACKER</h5>
            <hr>
                <table id="example" class="table">
                    <thead class="thead-dark">
                        <tr>
                            <td>Actions</td>
                            <td>Sr.No</td>
                            <td>ATMID</td>
                            <td>ATMID2</td>
                            <td>ATMID3</td>
                            <td>Serial Number</td>
                            <td>Bank</td>
                            <td>Customer</td>
                            <td>Address</td>
                            <td>City</td>
                            <td>State</td>
                            <td>Pincode</td>
                            <td>Engineer Name</td>
                            <td>Engineer Number</td>
                            <td>BM</td>
                            <td>Selection Type</td>
                            <td>Created AT</td>
                        </tr>
                    </thead>
                </table>
        </div>
    </div> 
</div>

<? } ?>


<script src="datatable/jquery.dataTables.js"></script>
<script src="datatable/dataTables.bootstrap.js"></script>
<script src="datatable/dataTables.buttons.min.js"></script>
<script src="datatable/buttons.flash.min.js"></script>
<script src="datatable/jszip.min.js"></script>

<script src="datatable/pdfmake.min.js"></script>
<script src="datatable/vfs_fonts.js"></script>
<script src="datatable/buttons.html5.min.js"></script>
<script src="datatable/buttons.print.min.js"></script>
<script src="datatable/jquery-datatable.js"></script>


</body>
</html>
