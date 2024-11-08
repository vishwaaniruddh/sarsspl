<?php
    $rgCode = "";
    if(isset($_GET["rg"])){
        $rgCode = $_GET["rg"];
    }
    $fbtitle = "Hello, I found this really cool app to check my learning in Math and Science in a fun way.";
    $fbDesc = "Use my reference code while registration: ". $rgCode;
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
        
        <script>
            list.getElementsByTagName("title")[0].innerHTML = "Milk";
            var meta = document.createElement('meta');
            meta.setAttribute('property', 'og:title');
            meta.content = `Hey,
                            I found this really cool app to check my learning in Math and Science in a fun way. 
                            
                            Quiz2shine app Logo 
                            
                            1) Play topic level quizzes mapped to school syllabus
                            2) For classes 6 to 10th
                            3) Play with friends, unknown players and 4 levels of AI (i.e. against computer)
                            
                            I am registered as a player in class yyth with quiz2shine app and really love it.
                            
                            Download Quiz2shine app from this link: xxxyyyy or from playstore (for android) and register. Let the Fun begin!`;
            //document.getElementsByTagName('head')[0].appendChild(meta);
        </script>
    </head>
    <body>
        <script>
            $(document).ready(function() {
                var myId = <?php echo $_GET["rg"]; ?>;
                window.location.href = "my-account/my-account.php?rg="+myId;
            });
        </script>
    </body>
</html>