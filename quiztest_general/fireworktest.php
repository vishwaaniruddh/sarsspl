<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>jQuery-fireworks Demo</title>
<style>
html,* { margin:0; padding:0}
body { width:100%; height:100%;}
.demo { margin:0 auto; width:100%; height:100%;}
h1 { margin:150px auto 30px auto; text-align:center; font-family:'Roboto';}
</style>
</head>

<body>
<h1>jQuery-fireworks Demo</h1>
<div class="demo">
</div>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="jquery.fireworks2.js"></script>
<script>
$('.demo').fireworks({ sound: true, opacity: 0.9, width: '100%', height: '100%' });
</script>

</body>
</html>
