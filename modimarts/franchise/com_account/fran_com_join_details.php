<? session_start();
include('../config.php');
include('../../config.php');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



function member($parameter,$id){
    global $con;
    
    $mem_sql = mysqli_query($con,"select $parameter from new_member where id='".$id."'");
    $mem_sql_result = mysqli_fetch_assoc($mem_sql);
    
    return $mem_sql_result[$parameter];

}

function sar_amount($id){
    global $con;
    
    $sql = mysqli_query($con,"select * from joining_com_details where member_id='SAR' and joining_com_id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['amount'];
    
}

function get_level_name($level_id){    

    if($level_id==1){
        return 'Country';
    }
    if($level_id==2){
        return 'Zone';
    }
    if($level_id==3){
        return 'State';
    }
    if($level_id==4){
        return 'Division';
    }
    if($level_id==5){
        return 'District';
    }
    if($level_id==6){
        return 'Taluka';
    }
    if($level_id==7){
        return 'Pincode';
    }
    if($level_id==8){
        return 'Village';
    }
    
}



function get_position_name($level_id,$member_id){
    
    global $con;

    $level_name = strtolower(get_level_name($level_id));
    
    $sql = mysqli_query($con,"select * from new_member where id='".$member_id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    $position_id = $sql_result[$level_name];

    $pos_sql = mysqli_query($con,"select $level_name from new_$level_name where id='".$position_id."'");
    $pos_sql_result = mysqli_fetch_assoc($pos_sql);
    
    return $pos_sql_result[$level_name];

}


function get_joined_member($id){

    global $con;
    
    $sql = mysqli_query($con,"select * from joining_com where id='".$id."'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    $member_id =  $sql_result['member_id'];
    
    $level = member('level_id',$member_id);
    
    return array($member_id,$level);
}

?>


<!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">


    <!-- JQuery DataTable Css -->
    <link href="../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style>
    section.content{
        margin:0;
    }
        td{
                white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
        }
    </style>
    
        <style>
         
        
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
td{
        padding: 5px;
}
.amount{
    text-align:right;
    
}
th {
    text-align: center;
}
    </style>
    
    
    <?  $id = $_GET['id']; ?>
    
    <section class="content">
        
            <a class="btn btn-warning" onclick="$('#content').load( 'fran_com_join_details.php?id=<? echo $id; ?>');">Refresh</a>

        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">

                                
                                <? 
                                
                                $joined_mem_info = get_joined_member($id);
                                
                                $join_table_sql = mysqli_query($con,"select * from joining_com where id='".$id."'");
                                $join_table_sql_result = mysqli_fetch_assoc($join_table_sql);
                                
                                $join_datetime = $join_table_sql_result['created_at'];
                                
                                $join_date =  date("d-m-y", strtotime($join_datetime));
                                
                                $join_time = date("h:i:s A", strtotime($join_datetime));
                                
$check_sql = mysqli_query($con, "select * from joining_com_details where is_diff_branch=1 and joining_com_id='".$id."'");

if($check_sql_result = mysqli_fetch_assoc($check_sql)){
    $is_diff_branch=1;
}

                                
                                
                                ?>
                                <table border="1" style="width:40%; margin: auto;" id="html-content-holder">
                                    <thead>
                                          <th colspan="8" style="padding: 5px;text-align:center;background:#e99998;">Commission Credit report</th>
                                    </thead>
                                    <thead style="background:#e99998;">
                                        <th style="width: 10%;text-align: center;">Count</th>
                                        <th style="width: 10%; text-align: center;">Status</th>
                                        <th>Area</th>
                                        <th>Area Name</th>
                                        <th>Fr ID</th>
                                        <th>Fr Name</th>
                                        <th>Fr Mob No</th>
                                        <th>Commission Amount</th>
                                    </thead>
                                    <tbody>
                                        
                                    
                                    <tr>
                                        <th style="width: 10%;background:#f4cccc;text-align: center;"></th>
                                        <th style="width: 10%; text-align: center;background:#f4cccc;    padding: 5px;">Joining Date</th>
                                        <th style="background:#f4cccc;"></th>
                                        <th style="background:#f4cccc;"><? echo $join_date; ?></th>
                                        <th style="background:#f4cccc;"></th>
                                        <th style="background:#f4cccc;"><? echo $join_time; ?></th>
                                        <th style="background:#f4cccc;"></th>
                                        <th style="background:#f4cccc;">800</th>
                                    </tr>
                                    
                                        <tr style="background:white;">
                                        <td >#</td>
                                        <td >Available</td>
                                        <td >Software</td>
                                        <td >Software</td>
                                        <td>0</td>
                                        <td>Mr. Satyendra Sharma</td>
                                        <td>9323654529</td>
                                        <td class="amount"><?  echo number_format(sar_amount($id),2); ?></td>
                                        </tr>
                                        <? for($i=1;$i<9;$i++){ 
                                        
                                        
                                        $sql = mysqli_query($con,"SELECT * FROM `joining_com_details` where joining_com_id = '".$id."' and is_diff_branch='0' and level_id='".$i."' and status=1");
                                        
                                        if($sql_result = mysqli_fetch_assoc($sql)){
                                            $level_id = $sql_result['level_id'];
                                            $amount = $sql_result['amount'];
                                            $intro = $sql_result['is_introducer'];
                                            $member_id = $sql_result['member_id'];
                                            
                                            if(!$member_id){
                                                $pos_status='Blank';
                                            }
                                            else{
                                                $pos_status='Available';
                                            }
                                        
                                        ?>
                                        
                                        <tr style="background:white;">
                                            <td><? echo $i; ?></td>
                                            <td>
                                                <?
                                                if($intro==1){
                                                    echo '<b>Introducer<b>';
                                                }
                                                else{
                                                    echo $pos_status; 
                                                }
                                                ?>
                                                
                                            </td>
                                            <td><? echo get_level_name($i); ?></td>
                                            <td><? echo get_position_name($level_id,$member_id); ?></td>
                                            <td><? echo $member_id; ?></td>
                                            <td><? echo member('name',$member_id)?></td>
                                            <td><? echo member('mobile',$member_id)?></td>
                                            <td class="amount"><? echo number_format($amount,2); ?></td>
                                        </tr>                                            
                                        
                                        <? }
                                        
                                        elseif($joined_mem_info[1]==$i){ ?>
                                        <tr style="background:#d1e0e3;">
                                            <td ><? echo $i; ?></td>
                                            <td ><b>Introduced To</b></td>
                                            <td ><? echo get_level_name($joined_mem_info[1]); ?></td>
                                            <td ><? echo get_position_name($joined_mem_info[1],$joined_mem_info[0]); ?></td>
                                            <td><? echo $joined_mem_info[0]; ?></td>
                                            <td><? echo member('name',$joined_mem_info[0])?></td>
                                            <td><? echo member('mobile',$joined_mem_info[0]);?></td>
                                            <td class="amount">0.00</td>
                                        </tr>                                            
                                        <? }
                                        
                                        else  { ?>
                                        
                                        <tr style="background:white;">
                                            <td><? echo $i; ?></td>
                                            <td>Blank</td>
                                            <td><? echo get_level_name($i); ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="amount">0.00</td>
                                        </tr>                                            
                                        
                                        <? }
                                        
                                        } 
                                        
                                        
                                        if($is_diff_branch==1){ 
                                        
                                        
                                        // echo "select * from joining_com_details where joining_com_id='".$id."' and is_diff_branch='1' and status=1";
                                        $diff_sql = mysqli_query($con,"select * from joining_com_details where joining_com_id='".$id."' and is_diff_branch='1' and status=1");
                                        
                                        $diff_sql_result = mysqli_fetch_assoc($diff_sql);
                                        
                                         $diff_level = $diff_sql_result['level_id'];
                                         $member_id  = $diff_sql_result['member_id'];
                                        ?>

                                        <tr style="background:#d9e9d2;">
                                            <td >#</td>
                                            <td ><b>Introducer</b></td>
                                            <td ><? echo get_level_name($diff_level); ?></td>
                                            <td ><? echo get_position_name($diff_level,$member_id); ?></td>
                                            <td><? echo $member_id; ?></td>
                                        <td><? echo member('name',$member_id)?></td>
                                        <td><? echo member('mobile',$member_id)?></td>
                                        <td class="amount">400.00</td>
                                        </tr>
                                        
                                        
                                        <? } ?>
                                        

                                    </tbody>
                                </table>


<div style="display:flex;justify-content:center; margin:2%;">

<a style="margin:auto 2%;" class="btn btn-danger" id="btn-Convert-Html2Image" href="#">Download</a>

<a class="btn btn-danger"  href="https://avoservice.in/allmart/joining_com.php?id=<? echo $id; ?>" >Send To Whatsapp</a>

</div>

<div id="previewImage"><canvas width="992" height="1708"></canvas></div>
<!--style="display:none;"-->

<script> 
$(document).ready(function() {
    
    var element = $("#html-content-holder"); 
    var getCanvas;
    
    	html2canvas(element, { 
          scale: 2,
              dpi: 144,

    		onrendered: function(canvas) { 
    			getCanvas = canvas; 
    
    			$("#previewImage").append(canvas); 

    
    				$("#btn-Convert-Html2Image").on('click', function() {
    				    
    					var imgageData = 
    						getCanvas.toDataURL("image/jpeg"); 
    				
    					// Now browser starts downloading 
    					// it instead of just showing it 
    					var newData = imgageData.replace( 
    					/^data:image\/jpeg/, "data:application/octet-stream"); 
    				
    				// console.log(newData);
    					$("#btn-Convert-Html2Image").attr( 
    					"download", "myimage.jpeg").attr( 
    					"href", newData); 
    				}); 
    		}
    // 	}); 
    }); 
}); 


$(function() { 
			$(document).ready(function() { 
				html2canvas($("#html-content-holder"), { 
					onrendered: function(canvas) { 
						var imgsrc = canvas.toDataURL("image/png"); 

 						$("#newimg").attr('src', imgsrc); 
						
						$("#img").show(); 
						
						var dataURL = canvas.toDataURL(); 
						
				// 		console.log(dataURL);
						
						$.ajax({ 
						type: "POST", 
						url: "save_joining_card.php", 
						data: { 
						imgBase64: dataURL,
						id :'<? echo $id;?>'
						} 
						}).done(function(o) { 
    						console.log('saved');
    				
					}); 		
				} 
			}); 
		}); 
	});
	
	
		
</script>


                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
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
    
        <script>
                     $('#loading').hide();         
    </script>
    
