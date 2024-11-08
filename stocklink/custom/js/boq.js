var manageboqTable;

$(document).ready(function() {
	// top bar active
	$('#navboq').addClass('active');
	
	// manage boq table
	manageboqTable = $("#manageboqTable").DataTable({
		'ajax': 'php_action/fetchBoq.php',
		'order': []		
	});

	// submit boq form function
	$("#submitboqForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var productName = $("#productName").val();
		var boqStatus = $("#boqStatus").val();
		var isSerialNumberRequired = $("#isSerialNumberRequired").val();
        

		if(productName == "") {
			$("#productName").after('<p class="text-danger">boq Name field is required</p>');
			$('#productName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#productName").find('.text-danger').remove();
			// success out for form 
			$("#productName").closest('.form-group').addClass('has-success');	  	
		}

		if(boqStatus == "") {
			$("#boqStatus").after('<p class="text-danger">boq Name field is required</p>');

			$('#boqStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#boqStatus").find('.text-danger').remove();
			// success out for form 
			$("#boqStatus").closest('.form-group').addClass('has-success');	  	
		}

        if(isSerialNumberRequired == "") {
			$("#isSerialNumberRequired").after('<p class="text-danger">boq Name field is required</p>');

			$('#isSerialNumberRequired').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#isSerialNumberRequired").find('.text-danger').remove();
			// success out for form 
			$("#isSerialNumberRequired").closest('.form-group').addClass('has-success');	  	
		}

		if(productName && boqStatus && isSerialNumberRequired) {
			var form = $(this);
			// button loading
			$("#createboqBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createboqBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						manageboqTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitboqForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-boq-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax	
		} // if

		return false;
	}); // /submit boq form function

});

function editboq(boqId = null) {
	if(boqId) {
		// remove hidden boq id text
		$('#boqId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-boq-result').addClass('div-hide');
		// modal footer
		$('.editboqFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBoq.php',
			type: 'post',
			data: {boqId : boqId},
			dataType: 'json',
			success:function(response) {
				// modal loading

                console.log(response)
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-boq-result').removeClass('div-hide');
				// modal footer
				$('.editboqFooter').removeClass('div-hide');

				// setting the boq name value 
				$('#editboqName').val(response.productName);
				// setting the boq status value
				$('#editboqStatus').val(response.status);
				$('#editboqSerialStatus').val(response.isSerialNumberRequired);
				$('#editboqId').val(response.id);
				// boq id 
                
				$(".editboqFooter").after('<input type="hidden" name="boqId" id="boqId" value="'+response.id+'" />');

				// update boq form 
				$('#editboqForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var productName = $('#editboqName').val();
					var boqStatus = $('#editboqStatus').val();

					if(productName == "") {
						$("#editboqName").after('<p class="text-danger">boq Name field is required</p>');
						$('#editboqName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editboqName").find('.text-danger').remove();
						// success out for form 
						$("#editboqName").closest('.form-group').addClass('has-success');	  	
					}

					if(boqStatus == "") {
						$("#editboqStatus").after('<p class="text-danger">boq Name field is required</p>');

						$('#editboqStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editboqStatus").find('.text-danger').remove();
						// success out for form 
						$("#editboqStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(productName && boqStatus) {
						var form = $(this);

						// submit btn
						$('#editboqBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editboqBtn').button('reset');

									// reload the manage member table 
									manageboqTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-boq-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if
									
							}// /success
						});	 // /ajax												
					} // /if

					return false;
				}); // /update boq form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit Boq function


function removeBoq(boqId = null) {
	if(boqId) {
		$('#removeboqId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedBoq.php',
			type: 'post',
			data: {boqId : boqId},
			dataType: 'json',
			success:function(response) {
				$('.removeboqFooter').after('<input type="hidden" name="removeboqId" id="removeboqId" value="'+response.id+'" /> ');

				// click on remove button to remove the boq
				$("#removeboqBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeboqBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBoq.php',
						type: 'post',
						data: {boqId : boqId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeboqBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the boq table 
								manageboqTable.ajax.reload(null, false);
								
								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the boq

				}); // /click on remove button to remove the boq

			} // /success
		}); // /ajax

		$('.removeboqFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove Boq function