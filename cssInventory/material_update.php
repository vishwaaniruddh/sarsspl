<?php session_start();
date_default_timezone_set('Asia/Kolkata');

include('function.php');
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
include 'config.php';

?>
	<html>

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
/*#Contactperson_name{display:none;}*/
/*#Contactperson_mob{display:none;}*/
</style>
		<style>


		</style>
		<style>
			.footer {
				background-image: url("download.jpg");
				color: #FFFFFF;
				font-size: .8em;
				margin-top: 25px;
				padding-top: 15px;
				padding-bottom: 10px;
				position: fixed;
				left: 0;
				bottom: 0;
				width: 100%;
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
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<!--<script src="jquery-1.8.3.js"></script>-->
		<script>
			var tableToExcel = (function() {
				var uri = 'data:application/vnd.ms-excel;base64,',
					template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
					base64 = function(s) {
						return window.btoa(unescape(encodeURIComponent(s)))
					},
					format = function(s, c) {
						return s.replace(/{(\w+)}/g, function(m, p) {
							return c[p];
						})
					}
				return function(table, name) {
					if (!table.nodeType) table = document.getElementById(table)
					var ctx = {
						worksheet: name || 'Worksheet',
						table: table.innerHTML
					}
					window.location.href = uri + base64(format(template, ctx))
				}
			})()

		</script>
		<?php
include 'header.php';

?>
			<link rel="stylesheet" type="text/css" href="style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<link rel="stylesheet" type="text/css" href="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/dataTables.bootstrap.css">
			<link rel="stylesheet" type="text/css" href="http://cssmumbai.sarmicrosystems.com/css/dash/style.css">
			<script>
				function search(strPage, perpg) {
					var oit = document.getElementById("oit").value;
					var Page = "";
					if (strPage != "") {
						Page = strPage;
					}
					var perp = '';
					if (perpg == '') perp = '50';
					else perp = document.getElementById(perpg).value;
					$.ajax({
						type: 'POST',
						url: 'dashboard1_process.php',
						//data:'oit='+oit+'&Page='+Page+'&perpg='+perp,
						data: 'oit=' + oit + '&Page=' + Page + '&perpg=' + perp,
						success: function(msg) {
							document.getElementById("show").innerHTML = msg;
						}
					})
				}

			</script>
	</head>
	<style>
		.cust_hide {
			display: none;
		}

	</style>
	<style>
		.address_type {
			display: none;
		}
	</style>
    
    
	<body style="background-color: #e0fde0;" onload="search('','')">
		<div class="container">
			<div class="footer">
				<p align="left" style="margin-bottom: 2px;padding-left: 18px;">CSS</p>
			</div>
		</div>
		<?php include('menu.php') ?>
			<div style="margin:1%"></div>
			<div class="container">
				<div class="card">
					<div class="card-block">
						<?
            $id = $_REQUEST['id'];
            
            $request = $_REQUEST ;
            $request = json_encode($request);
            
            
            $get_sql = mysqli_query($css,"select * from material_inventory where id='".$id."'"); 
            $get_sql_result = mysqli_fetch_assoc($get_sql);
            
           // $mis_id = $get_sql_result['mis_id'];
             $mis_id = $_REQUEST['id'];
            

            $mis_sql = mysqli_query($css,"select * from mis_details where id='".$_GET['id']."'");
            $mis_sql_result = mysqli_fetch_assoc($mis_sql);
            $ticket_id = $mis_sql_result['ticket_id'];
            $main_mis = $mis_sql_result['mis_id'];
            $atmid = $mis_sql_result['atmid'];            
            $status = $mis_sql_result['status']; 
            
            
            
            
            $main_mis_sql = mysqli_query($css,"select * from mis where id='".$main_mis."'");
            $main_mis_sql_result = mysqli_fetch_assoc($main_mis_sql);
            
            $bank = $main_mis_sql_result['bank'];
            $location = $main_mis_sql_result['location'];
            $city = $main_mis_sql_result['city'];
            $state = $main_mis_sql_result['state'];
            $zone = $main_mis_sql_result['zone'];


            

            ?>
							<div class="row">
								<div class="col-md-6">
									<div class="table-responsive">
										<table class="table m-0">
											<tbody>
												<tr>
													<th scope="row">Ticket ID </th>
													<td>
														<? echo $ticket_id;?>
													</td>
												</tr>
												<tr>
													<th scope="row">ATM ID</th>
													<td> <span><? echo $atmid;?></span> </td>
												</tr>
												<tr>
													<th scope="row">Bank</th>
													<td>
														<? echo $bank;?>
													</td>
												</tr>
												<tr>
													<th scope="row">Location</th>
													<td>
														<? echo $location;?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- end of table col-lg-6 -->
								<div class="col-md-6">
									<div class="table-responsive">
										<table class="table">
											<tbody>
												<tr>
													<th scope="row">City</th>
													<td>
														<? echo $city;?>
													</td>
												</tr>
												<tr>
													<th scope="row">State</th>
													<td>
														<? echo $state;?>
													</td>
												</tr>
												<tr>
													<th scope="row">Zone</th>
													<td>
														<? echo $zone;?>
													</td>
												</tr>
												<tr>
													<th scope="row">Status</th>
													<td>
														<? echo $status;?>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- end of table col-lg-6 -->
							</div>
							<br>
							<?

$id = $_REQUEST['id'];


$mat_sql = mysqli_query($css,"SELECT * FROM `material_inventory` where mis_id='".$id."'");

$mat_sql_result = mysqli_fetch_assoc($mat_sql);
$address = $mat_sql_result['delivery_address'];
?>
								<h4><u>Address</u></h4>
								<p>
									<? echo $address ; ?>
								</p>
								<br>
								<hr>
								<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
								<?

// echo "select * from mis_history where type='material_requirement' and mis_id='".$mis_id."' order by id desc" ; 
  $mis_history_sql = mysqli_query($css,"select * from mis_history where type='material_requirement' and mis_id='".$mis_id."' order by id desc");
  $mis_history_sql_result = mysqli_fetch_assoc($mis_history_sql);
  $last_mis_history = $mis_history_sql_result['id'];

$contact_person_name = mis_history_data('contact_person_name',$mis_id) ;
$contact_person_mob = mis_history_data('contact_person_mob',$mis_id) ;

$address = mis_history_data('delivery_address',$mis_id) ;
  
if(isset($_POST['submit'])){
  
  
$materialName =  $mis_history_sql_result['material'];
  $availability = $_POST['availability'];
 // $pod = $_POST['pod'];
  $dispatch_date = $_POST['dispatch_date'];
  //$courier_name = $_POST['courier_name'];
  $remark = $_POST['remark'];
  $created_at = date('Y-m-d H:i:s');
  $userid = $_SESSION['id'];
  $date = date('Y-m-d');
  $serial_number = $_POST['serial_number'];
  
   $address = $_POST['address'];
  $contact_name= $_POST['Contactperson_name'];
  $contact_mob = $_POST['Contactperson_mob'];
  
  $statement = "insert into material_update(mis_id,availibility,dispatch_date,remark,created_at,created_by,serial_number,formdata) 
  values('".$mis_id."','".$availability."','".$dispatch_date."','".$remark."','".$created_at."','".$userid."','".$serial_number."','".$request."')";
//  $statement = "insert into material_update(mis_id,availibility,dispatch_date,courier,pod,remark,created_at,created_by,serial_number) values('".$mis_id."','".$availability."','".$dispatch_date."','".$courier_name."','".$pod."','".$remark."','".$created_at."','".$userid."','".$serial_number."')";
  
  

  $update_mis = "insert into mis_history(material,mis_id,type,remark,dispatch_date,created_at,delivery_address,serial_number,is_material_dept,contact_person_name,contact_person_mob,courier_agency,pod,formdata,material_dept_userid)
  values('".$materialName."','".$mis_id."','material_dispatch','".$remark."','".$dispatch_date."','".$created_at."','".$address."','".$serial_number."',1,'".$contact_name."','".$contact_mob."','".$courier_name."','".$pod."','".$request."','".$userid."')";  
//  $update_mis = "insert into mis_history(mis_id,type,remark,courier_agency,pod,dispatch_date,created_at,serial_number,is_material_dept) values('".$mis_id."','material_requirement','".$remark."','".$courier_name."','".$pod."','".$dispatch_date."','".$date."','".$serial_number."',1)";
//   $update_mis = "update mis_history set courier_agency='".$courier_name."',pod='".$pod."',dispatch_date='".$dispatch_date."',remark='".$remark."' where id='".$last_mis_history."'";
  
  if(mysqli_query($css,$statement) && mysqli_query($css,$update_mis)){ 
         if($availability=='available'){
            $status = 2;
            $mis_sql = "update mis_details set status='material_dispatch' where id='".$mis_id."'";
         }
         if($availability=='not_available'){
            $status = 3;
          $mis_sql = "update mis_details set status='".$availability."' where id='".$mis_id."'";
         }
          mysqli_query($css,"update material_inventory set status='".$status."' where mis_id='".$mis_id."'");

          mysqli_query($css,$mis_sql);
  
  ?>
									<script>
										swal("Great !", "Call Updated Successfully !", "success");
										setTimeout(function() {
											window.history.back();
										}, 2000);

									</script>
									<?
  
  
       mysqli_query($conn,"update enventory_Stock set Status='L' where srno like '".$serial_number."' and Status='Active'");
  
  }else{ ?>
										<script>
											swal("Oops !", "Call Updation Error !", "error");
											setTimeout(function() {
												window.history.back();
											}, 2000);

										</script>
										<? }  } ?>
											<form action="#<? echo $_SERVER['PHP_SELF'];?>?id=<? echo $id;?>" method="POST">
												<div class="row">
													<div class="col-sm-12">
														<label>Availability</label>
														<select class="form-control" name="availability" id="availability" required>
															<option value="">Select</option>
															<option value="available">Material Dispatch</option>
															<option value="not_available">Material Not Available</option>
														</select>
													</div>
													
												</div>
												<!--onchange="setaddress()"-->
													<div class="row address_type">
													    <div class="col-sm-4">
    													    <label>Address Type</label>
                                                            <select class="form-control" id="address_type" name="address_type" 
                                                            
                                                            >
                                                              <option value="Branch" id="Branch">Branch</option>
                                                              <!--<option value="Other" id="Other">Other</option>-->
                                                            </select>
    													</div>
    													<div class="col-sm-8">
    													    <label>Address</label>
    													    <!--$mis_history_sql_result['delivery_address-->
                                                            <input class="form-control" readonly name="address" id="address" value="<? echo $adress ; ?>">
    													</div>
													</div>
												<br/>
												<div class="row contact">
												    <div class="col-sm-6" id="Contactperson_name">
                                                      <label for="Contactperson_name">Contact Person Name</label>
                                                      <input type="text" class="form-control" name="Contactperson_name" value="<? echo $contact_person_name; ?>" id="Contactperson_name_text" readonly>
                                                    </div>
                                                    <div class="col-sm-6" id="Contactperson_mob">
                                                      <label for="Contactperson_mob">Contact Person Mobile</label>
                                                      <input type="text" class="form-control" name="Contactperson_mob" value="<? echo $contact_person_mob; ?>" id="Contactperson_mob_text" readonly>
                                                    </div>
												</div>
												
												<div class="row cust_hide">
                                													
                                                    <div class="col-sm-6">
                                                        <label>POD</label>
                                                        <input type="text" name="pod" class="form-control" placeholder="Enter POD ..">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Courier Name</label>
                                                        <select name="courier_name" class="form-control">
                                                            <option value="">-- Select --</option>
                                                            <option value="Delhivery">Delhivery</option>
                                                            <option value="Nandan Courier">Nandan Courier</option>
                                                            <option value="Shri Nandan Courier">Shri Nandan Courier</option>
                                                            <option value="Trackon Courier">Trackon Courier</option>
                                                            <option value="Bluedart">Bluedart</option>
                                                            <option value="DTDC">DTDC</option>
                                                        </select>
                                                    </div>
													<div class="col-sm-6">
														<label>Dispatch Date</label>
														<input type="date" name="dispatch_date" class="form-control" value="<? echo date('Y-m-d');?>"> </div>
													<div class="col-sm-6">
														<label>Serial Number</label>
														<input type="text" name="serial_number" id="serial_number" class="form-control" required> </div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<label>Remark</label>
														<input type="text" name="remark" class="form-control"> </div>
												</div>
												<br>
												<br>
												<p style="text-align:center;">
													<input type="submit" id="submit" class="btn btn-success" name="submit" value="submit">
												</p>
											</form>
					</div>
				</div>
			</div>
			<script>
								    $(".contact").css("display", "none");
				$("#availability").on("change", function() {
					var availability = $("#availability").val();
					if (availability == 'available') {
					    
					    $(".contact").css("display", "block");
						$(".cust_hide").css("display", "block");
						$(".address_type").css("display", "block");
				// 		$(".contact").css("display", "block");
				// 		$('#submit').prop("disabled", true);
					} else {
					    $(".contact").css("display", "none");
						$(".cust_hide").css("display", "none");
						$(".address_type").css("display", "none");
				// 		$('#submit').removeAttr("disabled");
					}
				});
				// $("#serial_number").on("change", function() {
				// 	var serial_number = $("#serial_number").val();
				// 	$.ajax({
				// 		type: "POST",
				// 		url: 'validate_serial.php',
				// 		data: 'serial_number=' + serial_number,
				// 		success: function(msg) {
				// 			if (msg == 0 || msg == '0') {
				// 				alert('Serial Number Not Found !');
				// 				$("#serial_number").val('');
				// 			} else if (msg == 1 || msg == '1') {
				// 				$('#submit').removeAttr("disabled");
				// 			}
				// 		}
				// 	});
				// });

			</script>
			<script>
			 //   function setaddress()
			 //   { debugger;
    //                 var address_type = $('#address_type').val();
    //                 if(address_type=='Branch'){
    //                     $('#address').val('Branch');
    //                     $('#address').attr('readonly',true);
    //                     $('#Contactperson_name').hide();
    //                     $('#Contactperson_mob').hide();
    //                     $('#Contactperson_name_text').attr('required',false);
    //                     $('#Contactperson_mob_text').attr('required',false);
    //                     $('#address').show();
    //                 }
    //                 if(address_type=='Other'){
    //                     $('#address').val('');
    //                     $('#address').attr('readonly',false);
    //                      $('#Contactperson_name').show();
    //                      $('#Contactperson_mob').show();
    //                      $('#Contactperson_name_text').attr('required',true);
    //                     $('#Contactperson_mob_text').attr('required',true);
    //                     //  $('#address').show();
    //                 }
    //             }
			</script>
			
			<? } ?>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/jquery.dataTables.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/dataTables.bootstrap.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/dataTables.buttons.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/buttons.flash.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/jszip.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/pdfmake.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/vfs_fonts.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/buttons.html5.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/buttons.print.min.js"></script>
				<script src="http://cssmumbai.sarmicrosystems.com/css/dash/datatable/jquery-datatable.js"></script>
