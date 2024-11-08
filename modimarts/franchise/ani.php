<? include('config.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 

?>
<!DOCTYPE html>
<html>

	<head>
		    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

        <link href="css/themes/all-themes.css" rel="stylesheet" />
        
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
table {
    width:100%;
}
    </style>
    
    
    
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>



		<script type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"mem_json.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".member_error").html("");
							$("#employee-grid").append('<tbody class="member_error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		</script>
	</head>
	<body>



<? 
$member_sql = mysqli_query($con,"select id,name,created_at,level_id,star from new_member where status=1  ");
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
        
        if($level != 8){
            
            if($intro_count > 9){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }
        else{
    
            if($intro_count > 1){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }

    
            
    }
    else{
        
        
        $till_date = date('Y-m-d', strtotime($date . '+10 days'));
        
        $sql = mysqli_query($con,"SELECT * FROM `new_member` WHERE  created_at <= '".$till_date."' and status=1 and intro_id ='".$id."' and id <> '".$id."'");
        $intro_count = mysqli_num_rows($sql);
        
  
  
          if($level != 8){
            
            if($intro_count > 9){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }
        else{
    
            if($intro_count > 1){
                $eligible = 'Yes';
            }
            else{
                $eligible = 'No';
            }
            
        }




    }
    mysqli_query($con,"update new_member set join_com='".$eligible."' where id = '".$id."'");
    $i++;
    
}
?>

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
        
        
		<div class="container">
		    <table  id="employee-grid"   class="table">
		        

					<thead>
						<tr>
						

      <td scope="col">ID</td>
      <td scope="col">Name</td>
      <td scope="col">Joining Date</td>
      <td scope="col">Position Level</td>
      <td scope="col">Position Name</td>
      <td scope="col">Count</td>
      <td scope="col">Eligible For Commission</td>
      <td scope="col">View Joinees</td>
						</tr>
					</thead>
			</table>
		</div>
		
		</section>

		
    
     <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>


    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
        <!-- Waves Effect Plugin Js -->
    <!--<script src="plugins/node-waves/waves.js"></script>-->
    <!-- Slimscroll Plugin Js -->
    <!--<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>-->
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
    
    
    
	</body>
</html>