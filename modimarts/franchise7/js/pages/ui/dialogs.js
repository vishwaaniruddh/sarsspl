$(function () {
    $('.js-sweetalert button').on('click', function () {
        var type = $(this).data('type');
        if (type === 'basic') {
            showBasicMessage();
        }
        else if (type === 'with-title') {
            showWithTitleMessage();
        }
        else if (type === 'success') {
            showSuccessMessage();
        }
        else if (type === 'confirm') {
            showConfirmMessage();
        }
        else if (type === 'cancel') {
            showCancelMessage();
        }
        else if (type === 'with-custom-icon') {
            showWithCustomIconMessage();
        }
        else if (type === 'html-message') {
            showHtmlMessage();
        }
        else if (type === 'autoclose-timer') {
            showAutoCloseTimerMessage();
        }
        else if (type === 'prompt') {
            showPromptMessage();
        }
        else if (type === 'ajax-loader') {
            showAjaxLoaderMessage();
        }
    });
});

//These codes takes from http://t4t5.github.io/sweetalert/
function showBasicMessage() {
    swal("Here's a message!");
}

function showWithTitleMessage() {
    swal("Here's a message!", "It's pretty, isn't it?");
}

function showSuccessMessage() {
    swal("Good job!", "You clicked the button!", "success");
}

function showConfirmMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        swal("Deleted!", "Your imaginary file has been deleted.", "success");
    });
}

function showCancelMessage() {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });
}

function showWithCustomIconMessage() {
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: "../../images/thumbs-up.png"
    });
}

function showHtmlMessage() {
    swal({
        title: "HTML <small>Title</small>!",
        text: "A custom <span style=\"color: #CC0000\">html<span> message.",
        html: true
    });
}

function showAutoCloseTimerMessage() {
    swal({
        title: "Auto close alert!",
        text: "I will close in 2 seconds.",
        timer: 2000,
        showConfirmButton: false
    });
}































// function showPromptMessage() {
//     swal({
//         title: "An input!",
//         text: "Write something interesting:",
//         type: "input",
//         showCancelButton: true,
//         closeOnConfirm: false,
//         animation: "slide-from-top",
//         inputPlaceholder: "Write something"
//     }, function (inputValue) {
//             if (inputValue === false) return false;
//             if (inputValue === "") {
//                 swal.showInputError("You need to write something!"); return false
//             }
//             swal("Nice!", "You wrote: " + inputValue, "success");
//     });
// }


function showPromptMessage() {
    
    var id =  $("#btn_edit").attr('mobile');



        jQuery.ajax({
                type: "POST",
                url: 'generate_otp.php',
              data: 'member_id='+id, 
                    success:function(data) {
                        console.log(data);
                }
            });
            
            
            


    swal({
        title: "Enter OTP!",
        // text: "Write something interesting:",
        type: "input",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Write something"
        
    }, function (inputValue) {


        
        jQuery.ajax({
                type: "POST",
                url: 'check_otp.php',
              data: 'member_id='+id+'&value='+inputValue, 
                    success:function(data) {
    
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("You need to write something!"); return false
                        }
    
                        if(data==1){
                            swal("Login Succesfully !" , "success");
                            setTimeout(function(){ 
                                window.location.href="admin/member_edit.php?id="+id;
                            }, 3000);

                        }
                        if(data==2){
                            swal("Not Match OTP !" , "error");
            
                        }
                        
                    }
            });
        });
}

















































function showAjaxLoaderMessage() {
    swal({
        title: "Ajax request example",
        text: "Submit to run ajax request",
        type: "info",
        showCancelButton: true,
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
    }, function () {
        setTimeout(function () {
            swal("Ajax request finished!");
        }, 2000);
    });
}