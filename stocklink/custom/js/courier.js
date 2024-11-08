var managecourierTable;

$(document).ready(function() {
	// top bar active
	$('#navcourier').addClass('active');
	
	// manage courier table
	managecourierTable = $("#managecourierTable").DataTable({
		'ajax': 'php_action/fetchcourier.php',
		'order': []		
	});

	// submit courier form function
	$("#submitcourierForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');			

		var courierName = $("#courierName").val();

		

		if(courierName == "") {
			$("#courierName").after('<p class="text-danger">courier Name field is required</p>');
			$('#courierName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#courierName").find('.text-danger').remove();
			// success out for form 
			$("#courierName").closest('.form-group').addClass('has-success');	  	
		}



		if(courierName) {
			var form = $(this);
			// button loading
			$("#createcourierBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createcourierBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table 
						managecourierTable.ajax.reload(null, false);						

  	  			// reset the form text
						$("#submitcourierForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');
  	  			
  	  			$('#add-courier-messages').html('<div class="alert alert-success">'+
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
	}); // /submit courier form function

});

function editcourier(courierId = null) {
	if(courierId) {
		// remove hidden courier id text
		$('#courierId').remove();

		// remove the error 
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-courier-result').addClass('div-hide');
		// modal footer
		$('.editcourierFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedcourier.php',
			type: 'post',
			data: {courierId : courierId},
			dataType: 'json',
			success:function(response) {
				// modal loading

                console.log(response)
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-courier-result').removeClass('div-hide');
				// modal footer
				$('.editcourierFooter').removeClass('div-hide');

				$('#editcourierName').val(response.courierName);
				$('#editcourierStatus').val(response.activityStatus);
				$('#editcourierId').val(response.id);
				
				$(".editcourierFooter").after('<input type="hidden" name="courierId" id="courierId" value="'+response.id+'" />');

				// update courier form 
				$('#editcourierForm').unbind('submit').bind('submit', function() {

					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');			

					var productName = $('#editcourierName').val();
					var courierStatus = $('#editcourierStatus').val();

					if(productName == "") {
						$("#editcourierName").after('<p class="text-danger">courier Name field is required</p>');
						$('#editcourierName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editcourierName").find('.text-danger').remove();
						// success out for form 
						$("#editcourierName").closest('.form-group').addClass('has-success');	  	
					}

					if(courierStatus == "") {
						$("#editcourierStatus").after('<p class="text-danger">courier Name field is required</p>');

						$('#editcourierStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editcourierStatus").find('.text-danger').remove();
						// success out for form 
						$("#editcourierStatus").closest('.form-group').addClass('has-success');	  	
					}

					if(productName && courierStatus) {
						var form = $(this);

						// submit btn
						$('#editcourierBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editcourierBtn').button('reset');

									// reload the manage member table 
									managecourierTable.ajax.reload(null, false);								  	  										
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-courier-messages').html('<div class="alert alert-success">'+
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
				}); // /update courier form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit courier function


function removecourier(courierId = null) {
	if(courierId) {
		$('#removecourierId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedcourier.php',
			type: 'post',
			data: {courierId : courierId},
			dataType: 'json',
			success:function(response) {
				$('.removecourierFooter').after('<input type="hidden" name="removecourierId" id="removecourierId" value="'+response.id+'" /> ');

				// click on remove button to remove the courier
				$("#removecourierBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removecourierBtn").button('loading');

					$.ajax({
						url: 'php_action/removecourier.php',
						type: 'post',
						data: {courierId : courierId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removecourierBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal 
								$('#removeMemberModal').modal('hide');

								// reload the courier table 
								managecourierTable.ajax.reload(null, false);
								
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
					}); // /ajax function to remove the courier

				}); // /click on remove button to remove the courier

			} // /success
		}); // /ajax

		$('.removecourierFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove courier function


function restoreCourier(courierId = null) {
    if (courierId) {

        
        let text = "Are you sure you want to continue.";
        if (confirm(text) == true) {
          
        $.ajax({
            url: 'php_action/restoreCourier.php',
            type: 'post',
            data: { courierId: courierId },
            dataType: 'json',
            success: function (response) {
                if(response.success == true) {
                    alert('Courier Succcessfully !');
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