var manageMaterialRequestDetailsTable;

$(document).ready(function () {
	// top bar active
	$('#navboq').addClass('active');


	const url = new URL(window.location.href);
	const params = new URLSearchParams(url.search);
	const searchType = params.get('id');


	manageMaterialRequestDetailsTable = $('#manageMaterialRequestDetailsTable').DataTable({
		'ajax': {
			'url': 'php_action/fetchMaterialRequestDetails.php',
			'type': 'GET',
			'data': function (d) {
				// Append searchType to the data sent to the server
				d.searchType = searchType;
			}
		},
		'order': []
	});

	$("#submitboqForm").unbind('submit').bind('submit', function () {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var productName = $("#productName").val();
		var boqStatus = $("#boqStatus").val();
		var isSerialNumberRequired = $("#isSerialNumberRequired").val();


		if (productName == "") {
			$("#productName").after('<p class="text-danger">boq Name field is required</p>');
			$('#productName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#productName").find('.text-danger').remove();
			// success out for form 
			$("#productName").closest('.form-group').addClass('has-success');
		}

		if (boqStatus == "") {
			$("#boqStatus").after('<p class="text-danger">boq Name field is required</p>');

			$('#boqStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#boqStatus").find('.text-danger').remove();
			// success out for form 
			$("#boqStatus").closest('.form-group').addClass('has-success');
		}

		if (isSerialNumberRequired == "") {
			$("#isSerialNumberRequired").after('<p class="text-danger">boq Name field is required</p>');

			$('#isSerialNumberRequired').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#isSerialNumberRequired").find('.text-danger').remove();
			// success out for form 
			$("#isSerialNumberRequired").closest('.form-group').addClass('has-success');
		}

		if (productName && boqStatus && isSerialNumberRequired) {
			var form = $(this);
			// button loading
			$("#createboqBtn").button('loading');

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success: function (response) {
					// button loading
					$("#createboqBtn").button('reset');

					if (response.success == true) {
						// reload the manage member table 
						manageMaterialRequestDetailsTable.ajax.reload(null, false);

						// reset the form text
						$("#submitboqForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');

						$('#add-boq-messages').html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						$(".alert-success").delay(500).show(10, function () {
							$(this).delay(3000).hide(10, function () {
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





	function removeThisMaterialRequest(matId = null) {
		if (matId) {

			
			let text = "Are you sure you want to continue.";
			if (confirm(text) == true) {
			  
			$.ajax({
				url: 'php_action/removeSelectedMaterialRequest.php',
				type: 'post',
				data: { matId: matId },
				dataType: 'json',
				success: function (response) {
					if(response.success == true) {
						alert('Material Deleted From Request !');
						window.location.reload();
					}else{
						alert(' Something Error !');
						
					}


				}
			});

			} else {
			  text = "You canceled!";
			}


			
		}



	}

	
	function restoreThisMaterialRequest(matId = null) {
		if (matId) {

			
			let text = "Are you sure you want to continue.";
			if (confirm(text) == true) {
			  
			$.ajax({
				url: 'php_action/restoreSelectedMaterialRequest.php',
				type: 'post',
				data: { matId: matId },
				dataType: 'json',
				success: function (response) {
					if(response.success == true) {
						alert('Material Restored Succcessfully !');
						window.location.reload();
					}else{
						alert(' Something Error !');
						
					}


				}
			});

			} else {
			  text = "You canceled!";
			}


			
		}



	}