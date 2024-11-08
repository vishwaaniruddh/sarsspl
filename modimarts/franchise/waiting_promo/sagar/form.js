
function autoresponse(url, data) {
//alert('inside autoresponse');
    var resultobj;
    var result;
    var URL = url;
    var formData = data;
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: 'json',
        async: !1,
        success: function(data) {
            resultobj = data;
        },
		error: function(xhr){
        //alert('Ajax Error Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
        }
    });
	//alert('The value is:' + resultobj);
    return resultobj
}

function idForm(){
    // alert();
    window.location = 'noform.php';
    return true;
}
    
    $( document ).ready(function() {
        Info = {};
        Info.action = 'dropdowndata';
        var resp=autoresponse('newmembers.php',Info);
        if (resp){
        // $('#adsname').html("<option value=''>--Select--</option>");
            $.each(resp.data,function(key,value){
                $('#adsname').append("<option value='"+value.id+"'>"+value.name+"</option>");
             });
        }
        $('#adsname').on('change',function(e){
            Info = {};
            Info.action = 'dropdowndata';
            var resp=autoresponse('newmembers.php',Info);
            if (resp){
            // $('#adsname').html("<option value=''>--Select--</option>");
            $.each(resp.data,function(key,value){
                $('#adsname').append("<option value='"+value.id+"'>"+value.name+"</option>");
             });
         }
         });
        
    });
