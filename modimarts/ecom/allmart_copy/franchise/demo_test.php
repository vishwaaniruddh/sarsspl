<html>
    <head>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    </head>
    <body>
        
        
        
        <div id="shirtDiv">
            
            <img src="star_img/allmart.png">
            
            
            This HTML2CANVAS solution was not working good for me i know the scale option does increase the target div's size before capturing it but it won't work if you have something inside that div which won't resize e.g in my case it was canvas for my editing tool.
        </div>
        
        <button onclick="print();">Print</button>
        
        <script>
            function print()
{
    var node = document.getElementById('shirtDiv');
    var options = {
        quality: 0.95
    };

    domtoimage.toJpeg(node, options).then(function (dataUrl)
    {
        var doc = new jsPDF();
        doc.addImage(dataUrl, 'JPEG', -18, 20, 240, 134.12);
        doc.save('Test.png');
    });
}



        </script>
    </body>
</html>