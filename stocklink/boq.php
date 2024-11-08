<?php require_once 'includes/header.php'; ?>


<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">BOQ</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage BOQ</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" data-toggle="modal" data-target="#addboqModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add BOQ </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageboqTable">
					<thead>
						<tr>							
							<th>BOQ Name</th>
							<th>Is Required Serial Number</th>
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

<div class="modal fade" id="addboqModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="submitboqForm" action="php_action/createboq.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-plus"></i> Add boq</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-boq-messages"></div>

	        <div class="form-group">
	        	<label for="productName" class="col-sm-3 control-label">BOQ Name: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="productName" placeholder="BOQ Name" name="productName" autocomplete="off">
				    </div>
	        </div>
            
            <div class="form-group">
	        	<label for="isSerialNumberRequired" class="col-sm-3 control-label">Is Product Need Serial Number ?  </label>
	        	<label class="col-sm-1 control-label">: </label>
                <div class="col-sm-8">
				      <select class="form-control" id="isSerialNumberRequired" name="isSerialNumberRequired">
				      	<option value="">SELECT</option>
				      	<option value="Yes">Yes</option>
				      	<option value="No">No</option>
				      </select>
				    </div>
	        </div>
            
            <div class="form-group">
	        	<label for="boqStatus" class="col-sm-3 control-label">Status: </label>
	        	<label class="col-sm-1 control-label">: </label>
				    <div class="col-sm-8">
				      <select class="form-control" id="boqStatus" name="boqStatus">
				      	<option value="">SELECT</option>
				      	<option value="1">Available</option>
				      	<option value="2">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createboqBtn" data-loading-text="Loading..." autocomplete="off">Save Changes</button>
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

<!-- edit boq -->
<div class="modal fade" id="editboqModel" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editboqForm" action="php_action/editboq.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit boq</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-boq-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-boq-result">
		      	<div class="form-group">
		        	<label for="editboqName" class="col-sm-3 control-label">BOQ Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="editboqName" placeholder="BOQ Name" name="editboqName" autocomplete="off">
					    </div>
		        </div>

		        <div class="form-group">
		        	<label for="editboqSerialStatus" class="col-sm-3 control-label">Serialize Product: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editboqSerialStatus" name="editboqSerialStatus">
					      	<option value="">SELECT</option>
					      	<option value="Yes">Yes</option>
					      	<option value="No">No</option>
					      </select>
					    </div>
		        </div>
                
                <div class="form-group">
		        	<label for="editboqStatus" class="col-sm-3 control-label">Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-8">
					      <select class="form-control" id="editboqStatus" name="editboqStatus">
					      	<option value="">SELECT</option>
					      	<option value="Active">Active</option>
					      	<option value="Deleted">Inactive</option>
					      </select>
					    </div>
		        </div>
                
		      </div>         	        
		      <!-- /edit boq result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editboqFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editboqBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
<!-- /edit boq -->

<!-- remove boq -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove boq</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeboqFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeboqBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove boq -->

<script src="custom/js/boq.js"></script>

<?php require_once 'includes/footer.php'; ?>