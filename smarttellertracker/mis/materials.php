<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials DataTable</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <style>
        table.dataTable tbody tr {
            cursor: pointer;
        }
        .update-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Materials Inventory</h1>
<table id="materialsTable" class="display">
    <thead>
        <tr>
            <th>POD</th>
            <th>Request ID</th>
            <th>Material Name</th>
            <th>Serial Number</th>
            <th>Inventory ID</th>
            <th>Status</th>
            <th>Action</th> <!-- Column for Update button -->
        </tr>
    </thead>
    <tbody>
        <!-- Data will be populated here -->
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#materialsTable').DataTable({
            ajax: {
                url: './getMyInventory.php',
                dataSrc: ''
            },
            columns: [
                { data: 'pod' },
                { data: 'id' },
                { data: 'attribute' },
                { data: 'serialNumber' },
                { data: 'invID' },
                { data: 'materialStatus' },
                {
                    data: 'id', // ID to be used for the update action
                    render: function(data) {
                        return `<button class="update-btn" onclick="updateProduct(${data})">Update</button>`;
                    }
                }
            ]
        });

        // Function to handle update button click
        window.updateProduct = function(id) {
            // Make an AJAX request to update the product status
            $.ajax({
                url: './updateProduct.php',
                method: 'POST',
                data: { id: id },
                success: function(response) {
                    alert('Product status updated successfully');
                    // Reload the table data
                    table.ajax.reload();
                },
                error: function() {
                    alert('Error updating product status');
                }
            });
        };
    });
</script>

</body>
</html>
