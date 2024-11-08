<?php  include($_SERVER['DOCUMENT_ROOT'].'/quiztest_general/api/functions.php');

    $rgCode = "";
    if(isset($_GET["rg"])){
        $rgCode = $_GET["rg"];
    }
    $fbtitle = "Hello, I found this really cool app to check my learning in Math and Science in a fun way. Use my reference code while registration: ". $rgCode;
    $fbDesc = "Use my reference code while registration: ". $rgCode;
    
    $sql=mysqli_query($con,"SELECT class,avatar_id,school,id FROM quiz_regdetails where invite_code like '".$rgCode."'");
    $sql_result=mysqli_fetch_assoc($sql);
    $myClass=$sql_result['class'];
?>
<html>
    <head>
        <title>quiz2shine</title>
        <!--<meta property="og:url"         content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />-->
        <meta property="og:type"        content="article" />
        <meta property="og:description"       content="<?php echo $fbDesc; ?>" /> 
        <meta property="og:image"       content="http://sarmicrosystems.in/quiztest/img/Quiz2shine.png" />
        <meta property="og:title"       content="<?php echo $fbtitle; ?>" />
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        
    </head>
    <body>
        <script>
            $(document).ready(function() {
                window.location.href = "https://play.google.com/store/apps/details?id=com.quiz_2_shine.development";
               // window.location.href = "https://sarmicrosystems.in/quiztest/app/Quiz2Shine.apk";
            });
        </script>
    </body>
</html>