<?php require_once 'includes/header.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
			<li><a href="dashboard.php">Home</a></li>
			<li class="active">Material Request</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Material Request</div>
			</div>
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="manageMaterialRequestDetailsTable">
					<thead>
						<tr>
							<th>Sr No</th>
							<th>Required Material</th>
							<th>Quantity</th>
							<th>Condition</th>
							<th>Requested At</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<?php
		$misId = $_REQUEST['misId'];

		// MIS 
		$missql = mysqli_query($con, "Select * from mis where id='" . $misId . "'");

		if ($missqlResult = mysqli_fetch_assoc($missql)) {
			$atmid = $missqlResult['atmid'];
			$bank = $missqlResult['bank'];
			$location = $missqlResult['location'];
			$city = $missqlResult['city'];
			$state = $missqlResult['state'];
			$zone = $missqlResult['zone'];





			// MIS DETAILS
			$misdetailsql = mysqli_query($con, "Select * from mis_details where mis_id='" . $misId . "'");
			$misdetailsqlResult = mysqli_fetch_assoc($misdetailsql);
			$ticketId = $misdetailsqlResult['ticket_id'];

			$engineer = $misdetailsqlResult['engineer'];
		?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Dispatch Process</div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table m-0">
									<tbody>
										<tr>
											<th scope="row">Ticket ID </th>
											<td><?php echo $ticketId; ?></td>
										</tr>
										<tr>
											<th scope="row">ATM ID</th>
											<td> <span><?php echo $atmid; ?></span> </td>
										</tr>
										<tr>
											<th scope="row">Bank</th>
											<td><?php echo $bank; ?></td>
										</tr>
										<tr>
											<th scope="row">Location</th>
											<td><?php echo $location; ?></td>
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
											<td><?php echo $city; ?></td>
										</tr>
										<tr>
											<th scope="row">State</th>
											<td><?php echo $state; ?></td>

										</tr>
										<tr>
											<th scope="row">Engineer</th>
											<td><?php echo getUsername($engineer); ?></td>
										</tr>
										<tr>
											<th scope="row">Status</th>
											<td>
												material_requirement </td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<!-- end of table col-lg-6 -->
					</div>

					<hr>

					<?php
					$requestId = $_REQUEST['id'];
					$statement = "select a.MaterialName,a.material_qty,a.requestId from 
                                    generatefaultymaterialrequestdetails a 
                                    where a.requestId='" . $requestId . "' AND  a.materialStatus='Pending' ";


					$sql = mysqli_query($con, $statement);

					if (mysqli_num_rows($sql) > 0) {
					?>
						<form action="./material_update.php?requestId=<?php echo $requestId ?>&misId=<?php echo $misId ?>" method="POST" id="attributeForm">

							<input type="hidden" name="atmid" value="<?php echo $atmid; ?>">

							<div id="attributeFields" class="row">
								<?php
								// echo $statement;

								while ($sql_result = mysqli_fetch_assoc($sql)) {
									$material_name = $sql_result['MaterialName'];
									$material_qty = $sql_result['material_qty'];

									for ($count = 0; $count < $material_qty; $count++) {

								?>

										<div class="attribute-field col-sm-12">
											<input type="text" name="attribute[]" value="<?php echo $material_name; ?>"
												style="background-color: #e9ecef;opacity: 1;width: 25%;" readonly>
											<?php
											$serialSql = mysqli_query($con, "Select * from stocklink_boq where productName='" . $material_name . "' order by id desc");
											$serialSqlResult = mysqli_fetch_assoc($serialSql);
											$isSerialNumberRequired = $serialSqlResult['isSerialNumberRequired'];
											if ($isSerialNumberRequired == 'Yes') {



												echo '<input type="text" name="value[]" placeholder="Search Serial Number ..." style="width: 15%;">
															 <select name="serialNumber[]" class="serial-number-list" style="width: 20%;" required>
															 </select>';
											}
											?>

										</div>

								<?php }
								} ?>
							</div>
							<div class="row">

								<div class="col-sm-6" id="Contactperson_id_div">
									<label for="Contactperson_id">Contact Person Name</label>
									<select name="Contactperson_id" id="Contactperson_id" class="form-control" onchange="updateContactInfo()" required>
										<option value="">Select</option>
										<?php
										$usersql = mysqli_query($con, "SELECT * FROM user WHERE level=3");
										while ($sql_result = mysqli_fetch_assoc($usersql)) {
											$thisUserId = $sql_result['userid'];
											$thisUserName = $sql_result['name'];
											$thisUserMobile = $sql_result['contact']; // Assuming there's a contact field
											echo "<option value='$thisUserId' data-name='$thisUserName' data-mobile='$thisUserMobile'>$thisUserName</option>";
										}
										?>
									</select>
								</div>
								<input type="hidden" class="form-control" name="Contactperson_name" id="Contactperson_name_text" />
								<div class="col-sm-6" id="Contactperson_mob">
									<label for="Contactperson_mob">Contact Person Mobile</label>
									<input type="text" class="form-control" name="Contactperson_mob" id="Contactperson_mob_text" />
								</div>

								<div class="col-sm-12">
									<label>Address</label>
									<!--$mis_history_sql_result['delivery_address-->
									<input class="form-control" name="address" id="address" value="">
								</div>

								<div class="col-sm-4">
									<label>POD</label>
									<input type="text" name="pod" class="form-control" placeholder="Enter POD ..">
								</div>
								<div class="col-sm-4">
									<label>Courier Name</label>
									<select name="courier_name" class="form-control">
										<option value="">-- Select --</option>
										<?php
										$couriersql = mysqli_query($con, "select * from stocklink_courier where activityStatus='Active' order by courierName ASC");
										while ($couriersqlResult = mysqli_fetch_assoc($couriersql)) {
											$courierName = $couriersqlResult['courierName'];
										?>
											<option value="<?php echo $courierName; ?>"><?php echo $courierName; ?></option>

										<?php } ?>
									</select>
								</div>
								<div class="col-sm-4">
									<label>Dispatch Date</label>
									<input type="date" name="dispatch_date" class="form-control" value="2024-08-10">
								</div>

								<div class="col-sm-12">
									<label>Remark</label>
									<textarea name="remark" id="" rows="6" class="form-control"></textarea>
									<!-- <input type="text" name="remark" class="form-control"> -->
								</div>

								<div class="col-sm-12">
									<br>
									<p>
										<button type="submit" onclick="validateForm(event)">Submit</button>
										<!-- <input type="submit" id="submit" class="btn btn-success" name="submit" value="submit"> -->
									</p>
								</div>
							</div>
							<!-- <button type="button" onclick="addAttributeField()">Add Attribute</button> -->
						</form>
					<?php } else {
						echo '<h2 style="text-align: center;">No active material found to dispatch</h2>';
					}
					?>
				</div>
			</div>



			<script>
				// Initialize a Set to keep track of selected serial numbers
				let selectedSerialNumbers = new Set();

				// Function to fetch and update serial numbers in the dropdown
				async function fetchSerialNumbers(materialInput, valueInput, serialNumberList) {
					let material = materialInput.value;
					let value = valueInput.value;

					// Store the current selected value of the dropdown
					let selectedValue = serialNumberList.value;

					let xhr = new XMLHttpRequest();
					xhr.open("GET", `./php_action/search_serial_number.php?material=${encodeURIComponent(material)}&value=${encodeURIComponent(value)}`);
					xhr.onload = function() {
						if (xhr.status === 200) {
							let serialNumbers = JSON.parse(xhr.responseText);

							// Clear and update the dropdown options
							serialNumberList.innerHTML = "";

							// Add default option
							let selectOption = document.createElement("option");
							selectOption.text = "-- select --";
							selectOption.value = "";
							serialNumberList.appendChild(selectOption);

							if (serialNumbers && serialNumbers.length > 0) {
								for (let serialNumber of serialNumbers) {
									// Exclude already selected serial numbers except the currently selected one
									if (!selectedSerialNumbers.has(serialNumber) || serialNumber === selectedValue) {
										let option = document.createElement("option");
										option.value = serialNumber;
										option.text = serialNumber;
										serialNumberList.appendChild(option);
									}
								}
								serialNumberList.disabled = false;
							} else {
								serialNumberList.value = "";
								serialNumberList.disabled = true;
							}

							// Restore the previously selected value
							serialNumberList.value = selectedValue;
						} else {
							console.error(xhr.responseText);
						}
					};
					xhr.send();
				}

				// Function to handle serial number selection
				function handleSerialNumberSelection(serialNumberList) {
					let selectedValue = serialNumberList.value;

					if (selectedValue) {
						// Add the selected serial number to the set
						selectedSerialNumbers.add(selectedValue);

						// Update all dropdowns
						updateAllDropdowns();
					}
				}

				// Function to update all dropdowns
				function updateAllDropdowns() {
					let serialNumberLists = document.querySelectorAll('.serial-number-list');

					serialNumberLists.forEach(select => {
						fetchSerialNumbers(
							select.previousElementSibling.previousElementSibling, // material input
							select.previousElementSibling, // value input
							select
						);
					});
				}

				// Function to validate form submission
				function validateForm(event) {
					let attributeInputs = document.getElementsByName("attribute[]");
					let valueInputs = document.getElementsByName("value[]");
					let serialNumberLists = document.getElementsByClassName("serial-number-list");

					for (let i = 0; i < valueInputs.length; i++) {
						let valueInput = valueInputs[i];
						let serialNumberList = serialNumberLists[i];
						let materialInput = valueInput.previousElementSibling;

						if (valueInput.value !== "") {
							if (serialNumberList.value === "") {
								event.preventDefault();
								alert(`Please select a serial number for attribute "${attributeInputs[i].value}".`);
								return;
							}
						}
					}

					// Check for unique serial numbers
					if (areSerialNumbersUnique(serialNumberLists)) {
						return true;
					} else {
						event.preventDefault();
						alert('Serial numbers must be unique.');
						return false;
					}
				}

				// Function to check if serial numbers are unique
				function areSerialNumbersUnique(serialNumberLists) {
					let usedSerialNumbers = new Set();
					for (let select of serialNumberLists) {
						let selectedValue = select.value;
						if (selectedValue) {
							if (usedSerialNumbers.has(selectedValue)) {
								return false;
							}
							usedSerialNumbers.add(selectedValue);
						}
					}
					return true;
				}

				// Attach event listeners to serial number lists
				document.querySelectorAll('.serial-number-list').forEach(select => {
					select.addEventListener('change', function() {
						handleSerialNumberSelection(this);
					});
				});

				// Function to update contact info
				function updateContactInfo() {
					var selectElement = document.getElementById('Contactperson_id');
					var selectedIndex = selectElement ? selectElement.selectedIndex : -1;

					// Check if a valid option is selected
					if (selectedIndex === -1 || !selectElement.options[selectedIndex]) {
						document.getElementById('Contactperson_name_text').value = '';
						document.getElementById('Contactperson_mob_text').value = '';
						return;
					}

					var selectedOption = selectElement.options[selectedIndex];
					var name = selectedOption.getAttribute('data-name');
					var mobile = selectedOption.getAttribute('data-mobile');

					// Set the values to the hidden inputs
					document.getElementById('Contactperson_name_text').value = name || '';
					document.getElementById('Contactperson_mob_text').value = mobile || '';
				}

				function throttle(f, delay) {
					var timer = null;
					return function() {
						var context = this,
							args = arguments;
						clearTimeout(timer);
						timer = window.setTimeout(function() {
							f.apply(context, args);
						}, delay || 500);
					};
				}

				function addAttributeField() {
					var attributeFields = document.getElementById("attributeFields");
					var attributeField = document.createElement("div");
					attributeField.className = "attribute-field";
					attributeField.innerHTML = `
        <input type="text" name="attribute[]" value="" style="width: 25%;">
        <button class="remove-field" onclick="removeAttributeField(event)">Remove</button>
        `;
					attributeFields.appendChild(attributeField);
				}

				function removeAttributeField(event) {
					var attributeField = event.target.parentNode;
					attributeField.remove();
				}

				function submitForm() {
					var attributeInputs = document.getElementsByName("attribute[]");
					var valueInputs = document.getElementsByName("value[]");
					var serialNumberLists = document.getElementsByClassName("serial-number-list");

					var promises = Array.from(valueInputs).map((valueInput, i) => {
						var serialNumberList = serialNumberLists[i];
						var materialInput = valueInput.previousElementSibling;
						return fetchSerialNumbers(materialInput, valueInput, serialNumberList);
					});

					Promise.all(promises).then(function() {
						if (validateForm(event)) {
							document.getElementById("attributeForm").submit();
						}
					});
				}

				document.getElementById("attributeForm").addEventListener("submit", function(event) {
					event.preventDefault();
					submitForm();
				});

				var attributeFields = document.getElementById("attributeFields");
				attributeFields.addEventListener(
					"input",
					throttle(function(event) {
						var target = event.target;
						if (target.tagName === "INPUT" && target.name === "value[]") {
							var materialInput = target.previousElementSibling;
							var serialNumberList = target.nextElementSibling;
							fetchSerialNumbers(materialInput, target, serialNumberList);
						}
					})
				);
				document.addEventListener('DOMContentLoaded', function() {
					let valueInputs = document.querySelectorAll('input[name="value[]"]');

					valueInputs.forEach(input => {
						input.addEventListener('input', function() {
							let dropdown = this.nextElementSibling.nextElementSibling; // Get the corresponding dropdown
							if (dropdown && dropdown.classList.contains('serial-number-list')) {
								updateDropdown(dropdown);
							}
						});
					});
				});
			</script>
		<?php


		}


		?>





	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<script src="custom/js/material_request_details.js"></script>

<?php require_once 'includes/footer.php'; ?>