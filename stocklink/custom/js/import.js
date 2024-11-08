$(document).ready(function() {
    // top nav bar 
    $('#importbrand').addClass('active');

    // manage product data table
    $("#brandfile").fileinput({
        overwriteInitial: true,
        maxFileSize: 2500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',                                
        allowedFileExtensions: ["csv", "xls", "xlsx"]
    });


	$("#categoryfile").fileinput({
        overwriteInitial: true,
        maxFileSize: 2500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},
        defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',                                
        allowedFileExtensions: ["csv", "xls", "xlsx"]
    });


	

    // Remove form-group error
    $(".text-danger").remove();
    $(".form-group").removeClass('has-error').removeClass('has-success');

    // Submit import form
    $("#submitImportForm").unbind('submit').bind('submit', function() {
        // Form validation
        $(".text-danger").remove();
        var brandfile = $("#brandfile").val();
        if (brandfile == "") {
            $("#brandfile").closest('.center-block').after('<p class="text-danger">Brand file field is required</p>');
            $('#brandfile').closest('.form-group').addClass('has-error');
        } else {
            // Remove error text field
            $("#brandfile").find('.text-danger').remove();
            // Success out for form
            $("#brandfile").closest('.form-group').addClass('has-success');      
        } // /else

        if (brandfile) {
            // Submit loading button
            $("#importBrandBtn").button('loading');

            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Submit loading button
                        $("#importBrandBtn").button('reset');
                        
                        $("#submitImportForm")[0].reset();

                        $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
                                                                    
                        // Show successful message after operation
                        $('#add-product-messages').html('<div class="alert alert-success">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
              '</div>');

                        // Remove the messages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert

                        // Remove text-error 
                        $(".text-danger").remove();
                        // Remove form-group error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                    } else {
                        $('#add-product-messages').html('<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ response.messages +
              '</div>');
                        $("#importBrandBtn").button('reset');
                        
                        $("#submitImportForm")[0].reset();
                    }
                } // /success function
            }); // /ajax function
        } // /if validation is ok 

        return false;
    });

	$("#submitImportFormCategory").unbind('submit').bind('submit', function() {
        // Form validation
        $(".text-danger").remove();
        var categoryfile = $("#categoryfile").val();
        if (categoryfile == "") {
            $("#categoryfile").closest('.center-block').after('<p class="text-danger">Category file field is required</p>');
            $('#categoryfile').closest('.form-group').addClass('has-error');
        } else {
            // Remove error text field
            $("#categoryfile").find('.text-danger').remove();
            // Success out for form
            $("#categoryfile").closest('.form-group').addClass('has-success');      
        } // /else

        if (categoryfile) {
            // Submit loading button
            $("#importCategoryBtn").button('loading');

            var form = $(this);
            var formData = new FormData(this);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        // Submit loading button
                        $("#importCategoryBtn").button('reset');
                        
                        $("#submitImportFormCategory")[0].reset();

                        $("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
                                                                    
                        // Show successful message after operation
                        $('#add-product-messages').html('<div class="alert alert-success">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
              '</div>');

                        // Remove the messages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert

                        // Remove text-error 
                        $(".text-danger").remove();
                        // Remove form-group error
                        $(".form-group").removeClass('has-error').removeClass('has-success');

                    } else {
                        $('#add-product-messages').html('<div class="alert alert-danger">'+
                '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                '<strong><i class="glyphicon glyphicon-remove-sign"></i></strong> '+ response.messages +
              '</div>');
                        $("#importCategoryBtn").button('reset');
                        
                        $("#submitImportFormCategory")[0].reset();
                    }
                } // /success function
            }); // /ajax function
        } // /if validation is ok 

        return false;
    });
	

}); // document.ready function
