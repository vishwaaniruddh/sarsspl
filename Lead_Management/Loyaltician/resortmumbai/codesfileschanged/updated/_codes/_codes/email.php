<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include("header.php")?>
<!-- Additional library for page -->
    <link rel="stylesheet" href="assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" href="assets/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    
    /*<style>*/
    /*    .expire,.expired{*/
    /*        background:#faebd7;*/
    /*    }*/
    /*    .about_to_expire{*/
    /*        background:#FFC107;*/
    /*        color:white;*/
    /*    }*/
    /*    .about_to_expired{*/
    /*        background:#FFC107;*/
    /*    }*/
        
    /*    .about_to_expired,.expired{*/
    /*        height: 25px;*/
    /*        width: 25px;*/
    /*        margin: auto 1%;*/
    /*        border-radius: 20px;*/
            
    /*    }*/
    /*</style>*/
    
</head>
<body class="sidebar-pinned">



<script>
  $(document).ready(function() {
      $.fn.dataTable.ext.errMode = 'none';
      
	var table = $('#example').DataTable( {
        	    "processing": true,
        		"serverSide": true,
        		"ajax": "json/email.php",
                "destroy": true,
                "bInfo" : false,
                "columnDefs": [{
    		        "render": editeBtn,
    		        "data": 1,
    		        "targets": [2]
        		    }],
        	}).on( 'draw', function () {
                    $('body').on('click', '.editeBtn', function(){
                        var row  = $(this).parents('tr')[0];
                        let data =  table.row( row ).data() 
                        var id = data[0];
                        window.location.href="email_step2.php?id="+id; 
                    });
                });
            });


function editeBtn() {
    return '<input type="button"  class="btn btn-primary editeBtn" value="Email">';
}


  </script>
  


<?php include("vertical_menu.php")?>
<main class="admin-main">
  <?php include('navbar.php');?>
  
    <section class="admin-content">
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-40 p-b-90">

                        <h4 class=""> <span class="btn btn-white-translucent">
                                <i class="mdi mdi-table "></i></span> Welcome Email
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="container  pull-up">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                                    
<?php include("config.php");

$qrys= mysqli_query($conn,"SELECT * FROM Members ORDER BY mem_id DESC");

    

?>
                        <div class="card-body">
                            <div style="display:flex;justify-content:center;">

                            </div>
                            <div class="table-responsive p-t-10">
                                
                                
                                <table id="example" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>srno</th>                                      
                                            <th>Full Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>srno</th>                                      
                                            <th>Full Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </tfoot>
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