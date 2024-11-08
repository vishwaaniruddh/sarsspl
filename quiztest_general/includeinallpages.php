   <link rel="shortcut icon" href="favicon.png">
    
    <!-- Bootstrap 3.3.2 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/js/rs-plugin/css/settings.css">

    <link rel="stylesheet" href="assets/css/styles.css">


    <script type="text/javascript" src="assets/js/modernizr.custom.32033.js"></script>

 <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    
    <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet" />
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
 
 
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  <script>
  
  
  function promptfunc(txt,typ,sts)
  {
      
       swal({
            title: txt,
            type: typ,
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!"
        },
 function (isConfirm) {

     if (isConfirm) {

if(sts=="1")
{
         window.open("logout.php","_self")
}
     }
 });
      
  }
  
  </script>
  
  