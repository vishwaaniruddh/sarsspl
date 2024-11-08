function autoresponsefile(url, data)
{
    var resultobj;
    var result;
    var URL = url;
    var formData = data;
    $.ajax({
        url: URL,
        type: "POST",
        data:  formData,
        contentType: false,
        enctype: 'multipart/form-data',
        cache: false,
        processData:false,
        async: !1,
        beforeSend : function()
        {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
            //console.log(data);
        },
        success: function(data)
        {
            resultobj = data;
        },
        error: function(xhr)
        {
            console.log(xhr.responseText);
        }
    });
    return resultobj
}

// $(document).ready(function(){
        $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
             $(this).next('.custom-file-label').html(fileName);
        });
    // });
        // $('#image').on('change',function(){
        //         //get the file name
        //         var fileName = $(this).val();
        //         //replace the "Choose a file" label
        //        
        // });
        
    $('#noform').validate({
        rules: {
            adname: {
                required: true,
                maxlength: 100
            },
            languagae: {
                required: true,
                maxlength: 100
            },
            image_name: {
                 required: true,
                //  extension: 'jpg'
             }
        },
        messages: {
            adname: {required: "Please enter Advertise name.",maxlength:"Maximum 100 characters are allowed."},
            languagae: {required: "Please enter Language.",maxlength:"Maximum 100 characters are allowed."},
            // image: {required: "Please Select jpeg,png.",maxlength:"Maximum 100 characters are allowed."},
        },
        submitHandler: function () {
          
        
            var formData=new FormData();
                var file=$('#image')[0].files[0];
                // console.log(file);
                formData.append('adname', $("#adname").val());
                formData.append('languagae', $("#languagae").val());
                formData.append('action', 'imagedata');
                // formData.append('imagepath', res)
                formData.append('file',file);
            var resp=autoresponsefile("newmembers.php",formData);
            // console.log(resp.message);
             if(resp.type=='success')
            {
                // alert(22)
                $('#noform')[0].reset();
                // $("#modal-add-company").hide();
                alert(resp.message);
                // $("#tbl-companies").flexReload();
            }
            else
            {   
                $('#noform')[0].reset();
                $('#image').val('');
                $('.custom-file-label').html('Choose File');
                alert('Data Inserted Successfull');

            }
        }
        });