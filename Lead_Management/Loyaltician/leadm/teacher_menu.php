<?php
session_start();
include('config.php');
//include('../access.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
        .busy * {
            cursor: wait !important;
        }
        
        .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        .button2{
            .button {
            background-color: #FBBA00;
            border: none;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            -webkit-transition-duration: 0.4s;
            /* Safari */
            transition-duration: 0.4s;
            cursor: pointer;
        }
        }
        
        .button1 {
            background-color: #FBBA00;
            color: #fff;
            font-family: "Open Sans", Helvetica, Arial, sans-serif;
            font-size: 22px;
            padding: 8px 10px;
        }
        
        
        
      
/* unvisited link */
.test2:link {
    color: #5B5B5B;
    text-decoration: none;
}
}

/* visited link */
.test2:visited {
    color: #5B5B5B;
}

/* mouse over link */
.test2:hover {
    color: #00A0E3;
     text-decoration: underline;
}

/* selected link */
.test2:active {
    color: #5B5B5B;
}
.col-md-6 {
    width: 33%;
}
.col-md-offset-3 {
    margin-left: 34%;
}
</style>
</head>
<body>

<nav class="navbar navbar-inverse" style=" height:100px;">
  <div class="container-fluid" style="height:100px;">
    <div class="navbar-header">
        
     <img src="images/logo.png" style="white:250px;  height:70px;"  alt="logo">
    </div>
    <ul class="nav navbar-nav" style="border: 0px solid; border-radius: 0px;margin-top: 40px;">
      <li class="active"><a href="testscheduleview.php">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Student details <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li style=" color:black;"><a href="studentcreation.php">Create Student</a></li>
          <li><a href="upload_student_details.php">Upload Student details</a></li>
          <li><a href="studentview.php">View Student details</a></li>
        
        </ul>
      </li>
      
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Test details <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li style=" color:black;"><a href="batch_creation.php">Create Batch</a></li>
          <li style=" color:black;"><a href="view_batch.php">View Batch details</a></li>
          <li style=" color:black;"><a href="testschedule.php">Schedule Test</a></li>
          <li style=" color:black;"><a href="testscheduleview.php">View Scheduled Test</a></li>
           <!--<li style=" color:black;"><a href="view_reports.php">View Reports</a></li>-->
            <li style=" color:black;"><a href="view_reports.php">View Class Reports</a></li>
          <li style=" color:black;"><a href="teacher_performance_graph.php">View Teacher Performance</a></li>
          <li style=" color:black;"><a href="school_feedback.php">School Feedback</a></li>
          <!--<li><a href="#">View Test details</a></li>-->
        
        </ul>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right" style="border: 0px solid; border-radius: 0px;margin-top: 40px;">
      <!--<li><a href=""><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
      <li></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout </a></li>
      <li><a href="changepassword.php"><span class="glyphicon glyphicon-log-in"></span> change password </a></li>
    </ul>
  </div>
</nav>
  
<div class="container">

</div>

</body>
</html>
