<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">courier</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage courier</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addcourierModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add courier </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="managecourierTable">
					<thead>
						<tr>							
							<th>Courier Name</th>
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

<div class="modal fade" id="addcourierModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitcourierForm" action="php_action/createcourier.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add courier</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-courier-messages"></div>

	        <div class="form-group">
	        	<label for="courierName" class="col-sm-3 control-label">Courier Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="courierName" placeholder="Courier Name" name="courierName" autocomplete="off">
				    </div>
	        </div>
            
     
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createcourierBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- edit courier -->
<div class="modal fade" id="editcourierModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editcourierForm" action="php_action/editcourier.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit courier</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-courier-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-courier-result">
		      	<div class="form-group">
		        	<label for="editcourierName" class="col-sm-3 control-label">Courier Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editcourierName" placeholder="Courier Name" name="editcourierName" autocomplete="off">
					    </div>
		        </div>                
                <div class="form-group">
		        	<label for="editcourierStatus" class="col-sm-3 control-label">Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editcourierStatus" name="editcourierStatus">
					      	<option value="">Select</option>
					      	<option value="Active">Active</option>
					      	<option value="Deleted">Inactive</option>
					      </select>
					    </div>
		        </div>
                
		      </div>         	        
		      <!-- /edit courier result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editcourierFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editcourierBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit courier -->

<!-- remove courier -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove courier</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removecourierFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removecourierBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove courier -->

<script src="custom/js/courier.js"></script>

<?php require_once 'includes/footer.php'; ?>