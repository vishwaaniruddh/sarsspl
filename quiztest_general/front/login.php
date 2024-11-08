<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

<style>
body {
    color: #fff;
    background: url(https://www.sarmicrosystems.in/quiztest/assets/img/berry/bk-berry.jpg);
    font-family: 'Roboto', sans-serif;
    overflow:hidden;
}
    .login-form-1 {
    padding: 5%;
    box-shadow: 0 5px 8px 0 
rgba(0, 0, 0, 0.2), 0 9px 26px 0
    rgba(0, 0, 0, 0.19);
    margin: auto;
    justify-content: center;
    height: 50%;
    position: absolute;
    top: 23%;
    left: 23%;
        background: #f2f3f7;
}
.login-form-1 h3 {
    text-align: center;
    color: 
    #333;
}
.login-container form {
    padding: 10%;
}
.form-group {
    margin-bottom: 1rem;
}
.login-form-1 .btnSubmit {
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.btnSubmit {
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .ForgetPwd {
    color: 
    #0062cc;
    font-weight: 600;
    text-decoration: none;
}
.custom_row{
        height: 100vh;
    position: relative;
}
</style>
</head>
    <body>

<div class="row custom_row">
        <div class="col-md-6 login-form-1">
                    <h3>Welcome back !</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Your Email *" value="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Your Password *" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login">
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
</div>
    
                
    </body>
</html>