<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<div class="footer">
	

	<div class="shyam-heading">
		<img id="my-id" src="img/SBD Certificate for 50000 Membership.png" alt="">

	</div>
</div>




		</div>



	</div>
</div>


<a class="btn btn-primary" id="btn-Convert-Html2Image" href="#">Download</a>


        <a class="btn btn-primary" id="printpdf" href="#" onclick="window.print(3)">print</a>

    
    <!--<button onclick="getPDF()" href="#" >Generate PDF</button>-->
    
    <button onclick="getPDF()">Generate PDF</button>
    
    <!--<button id="btn-Convert-Html2pdf">Generate PDF</button>-->

    
    <div id="previewImage" style="display: none;"></div>
    <div id="editor"></div>
<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script>
function gen_pdf(){
            var pdf = new jsPDF('p', 'pt', 'letter');
        // source can be HTML-formatted string, or a reference
        // to an actual DOM element from which the text will be scraped.
        source = $('#html-content-holder')[0];

        // we support special element handlers. Register them with jQuery-style 
        // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
        // There is no support for any other type of selectors 
        // (class, of compound) at this time.
        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };
        margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };
        // all coords and widths are in jsPDF instance's declared units
        // 'inches' in this case
        pdf.fromHTML(
            source, // HTML string or DOM elem ref.
            margins.left, // x coord
            margins.top, { // y coord
                'width': margins.width, // max width of content on PDF
                'elementHandlers': specialElementHandlers
            },

            function (dispose) {
                // dispose: object with X, Y of the last line add to the PDF 
                //          this allow the insertion of new lines after html
                pdf.save('PramanPatra.pdf');
            }, margins
        );
}
function getPDF(){

		var HTML_Width = $(".outer").width();
		var HTML_Height = $(".outer").height();
    	console.log(HTML_Height+"  "+HTML_Width);
		var top_left_margin = 15;
		var PDF_Width = HTML_Width+(top_left_margin*2);
	var PDF_Height = (HTML_Height)+(top_left_margin*2);
		var canvas_image_width = HTML_Width;
		var canvas_image_height = HTML_Height;
		
		window.parent.document.body.style.zoom = 0.85;

		html2canvas($(".outer")[0],{allowTaint:true,scale:2}).then(function(canvas) {
        // html2canvas($(".outer")[0],{scale:2}).then(function(canvas) {
			canvas.getContext('2d');
			var imgData = canvas.toDataURL("image/png", 1);
            var pdf = new jsPDF('l', 'pt',  [HTML_Width, HTML_Height]);
		  pdf.addImage(imgData, 'png', 0, 0,canvas_image_width,canvas_image_height);

			
		    pdf.save("Prman_patr.pdf");
        });
        window.parent.document.body.style.zoom = 1;
	};

</script>


</body>
</html>
