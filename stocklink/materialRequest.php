<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Material Request</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Material Request</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<table class="table" id="manageMaterialRequestTable">
					<thead>
						<tr>							
							<th>Sr No</th>
							<th>ATM ID</th>
							<th>Required Materials</th>
							<th>Engineer</th>
							<th>Requested At</th>
							<th>Ticket ID</th>
							<th>Status</th>
							<th style="width:15%;">Options</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<script src="custom/js/material_request.js"></script>

<?php require_once 'includes/footer.php'; ?>