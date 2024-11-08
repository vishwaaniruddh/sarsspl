<?php include('../header.php'); ?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="row">
    <div class="col-sm-12 grid-margin">



        <style>
            .modal-backdrop {
                z-index: -1;
            }

            .hidden {
                display: none;
            }

            .expand-button {
                cursor: pointer;
                color: blue;
                text-decoration: underline;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th,
            td {
                padding: 8px 12px;
                border: 1px solid #ddd;
            }

            th {
                background-color: #f4f4f4;
                color: black;
            }

            /* Modal styles */
            .modal {
                /* display: none; */
                position: fixed;

                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }

            .modal-content {
                background-color: #fefefe;
                /* margin: 15% auto; */
                padding: 20px;
                border: 1px solid #888;
                /* width: 80%; */
            }

            .close-button {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close-button:hover,
            .close-button:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
        <div class="row">
            <div class="col-sm-12 grid-margin">

                <h1>Material Received Records</h1>
                <hr>
                <table id="recordsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Material Send ID</th>
                            <th>Contact Person</th>
                            <th>Address</th>
                            <th>POD</th>
                            <th>Delivery Status</th>
                            <th>Status</th>
                            <th>Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be populated here by JavaScript -->
                    </tbody>
                </table>


                <script>
                    // Function to fetch records from the backend
                    function fetchRecords() {
                        fetch('get_records.php') // Adjust the URL to your backend endpoint
                            .then(response => response.json())
                            .then(data => {
                                const tableBody = document.querySelector('#recordsTable tbody');
                                tableBody.innerHTML = ''; // Clear existing rows

                                data.forEach(record => {
                                    const row = document.createElement('tr');
                                    row.innerHTML = `
                            <td>${record.id}</td>
                            <td>${record.materialSendId}</td>
                            <td>${record.contactPersonName}</td>
                            <td>${record.address}</td>
                            <td>${record.pod}</td>
                            <td>${record.isDelivered}</td>
                            <td>${record.status}</td>
                            <td>
                            <span class="expand-button" onclick="toggleDetails(${record.id})">Expand</span>
                            </td>
                            <td>
                            <button type="button" data-bs-toggle="modal" onclick="openModal(${record.id})" data-bs-target="#deliveryModal" >Update Delivery</button>

                            </td>
                        `;
                                    tableBody.appendChild(row);

                                    const detailsRow = document.createElement('tr');
                                    detailsRow.classList.add('hidden');
                                    detailsRow.id = `details-${record.id}`;
                                    detailsRow.innerHTML = `
                            <td colspan="2"></td>
                                    <td colspan="5">
                                <table border="1" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Serial Number</th>
                                            <th>Material Status</th>
                                            <th>Activity Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="details-content-${record.id}">
                                        <!-- Product details will be populated here by JavaScript -->
                                    </tbody>
                                </table>
                            </td>
                            <td colspan="2"></td>
                        `;
                                    tableBody.appendChild(detailsRow);
                                });
                            })
                            .catch(error => console.error('Error fetching records:', error));
                    }

                    // Function to toggle product details
                    function toggleDetails(recordId) {
                        const detailsRow = document.getElementById(`details-${recordId}`);
                        if (detailsRow.classList.contains('hidden')) {
                            detailsRow.classList.remove('hidden');
                            fetchDetails(recordId);
                        } else {
                            detailsRow.classList.add('hidden');
                        }
                    }

                    // Function to fetch product details
                    function fetchDetails(recordId) {
                        fetch(`get_details.php?id=${recordId}`) // Adjust the URL to your backend endpoint
                            .then(response => response.json())
                            .then(data => {
                                const detailsContent = document.getElementById(`details-content-${recordId}`);
                                detailsContent.innerHTML = data.map(item => `
                        <tr>
                            <td>${item.attribute}</td>
                            <td>${item.serialNumber}</td>
                            <td>${item.materialStatus}</td>
                            <td>${item.activityStatus}</td>
                            <td>
                            <button type="button" data-bs-toggle="modal" onclick="openModalTwo(${item.id})" data-bs-target="#deliveryModal2" >Update Delivery</button>
                            </td>
                        </tr>
                    `).join('');
                            })
                            .catch(error => console.error('Error fetching details:', error));
                    }

                    // Function to open the modal
                    function openModal(recordId) {
                        document.getElementById('recordId').value = recordId;
                        document.getElementById('deliveryModal').classList.remove('hidden');
                    }

                    function openModalTwo(recordId) {
                        document.getElementById('recordIdTwo').value = recordId;
                        document.getElementById('deliveryModal2').classList.remove('hidden');
                    }



                    // Function to close the modal
                    function closeModal() {
                        document.getElementById('deliveryModal').classList.add('hidden');
                    }

                    // Function to submit delivery details
                    function submitDeliveryDetails() {
                        const form = document.getElementById('deliveryForm');
                        const formData = new FormData(form);

                        fetch('update_delivery_details.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Delivery details updated successfully!');
                                    closeModal();
                                    fetchRecords(); // Refresh the records table
                                } else {
                                    alert('Failed to update delivery details.');
                                }
                            })
                            .catch(error => console.error('Error submitting delivery details:', error));
                    }


                    function submitDeliveryDetailsSingle() {
                        const form = document.getElementById('deliveryForm2');
                        const formData = new FormData(form);

                        fetch('update_delivery_details_single.php', {
                                method: 'POST',
                                body: formData,
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Delivery detail updated successfully!');
                                    closeModal();
                                    fetchRecords(); // Refresh the records table
                                } else {
                                    alert('Failed to update delivery details.');
                                }
                            })
                            .catch(error => console.error('Error submitting delivery details:', error));
                    }

                    

                    // Fetch records when the page loads
                    window.onload = fetchRecords;
                </script>

            </div>
        </div>




    </div>
</div>

<?php include('../footer.php'); ?>



${item.invID}
<div class="modal fade" id="deliveryModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">New message</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deliveryForm">
                    <input type="hidden" id="recordId" name="recordId">
                    <label for="newDeliveryStatus">New Delivery Status:</label>
                    <select id="newDeliveryStatus" class="form-control" name="newDeliveryStatus" required>
                        <option value="">Select Status</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Returned">Returned</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <br>
                    <label for="deliveryDate">Delivery Date:</label>
                    <input type="date" id="deliveryDate" value="<?php echo date('Y-m-d', strtotime($datetime)); ?>" class="form-control" name="deliveryDate">
                    <br>
                    <label for="contactperson">Contact Person:</label>
                    <input type="text" id="contactperson" value="<?php echo $username; ?>" class="form-control" name="contactperson">
                    <br>
                    <label for="deliveryRemarks">Remarks:</label>
                    <textarea id="deliveryRemarks" class="form-control" name="deliveryRemarks" rows="4"></textarea>
                    <br>
                    <label for="Delivery Challan">Delivery Challan:</label>
                    <input type="file" id="deliveryChallan" name="deliveryChallan" class="form-control">
                    <br>
                    <button type="button" onclick="submitDeliveryDetails()">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deliveryModal2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">Single Material</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deliveryForm2">
                    <input type="hidden" id="recordIdTwo" name="singleRecord">
                    <label for="newDeliveryStatus">New Delivery Status:</label>
                    <select id="newDeliveryStatus" class="form-control" name="newDeliveryStatus" required>
                        <option value="">Select Status</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Returned">Returned</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <br>
                    <label for="deliveryDate">Delivery Date:</label>
                    <input type="date" id="deliveryDate" value="<?php echo date('Y-m-d', strtotime($datetime)); ?>" class="form-control" name="deliveryDate">
                    <br>
                    <label for="contactperson">Contact Person:</label>
                    <input type="text" id="contactperson" value="<?php echo $username; ?>" class="form-control" name="contactperson">
                    <br>
                    <label for="deliveryRemarks">Remarks:</label>
                    <textarea id="deliveryRemarks" class="form-control" name="deliveryRemarks" rows="4"></textarea>
                    <br>
                    <label for="Delivery Challan">Delivery Challan:</label>
                    <input type="file" id="deliveryChallan" name="deliveryChallan" class="form-control">
                    <br>
                    <button type="button" onclick="submitDeliveryDetailsSingle()">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>