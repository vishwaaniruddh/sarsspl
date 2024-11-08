
        $(document).ready(function() { 
// Global variable 
            var element = $("#html-content-holder"); 
              // Global variable 
            var getCanvas; 
            
            $(document).ready(function() { 
                html2canvas(element, { 
                    onrendered: function(canvas) { 
                        $("#previewImage").append(canvas); 
                        getCanvas = canvas; 


                            $("#btn-Convert-Html2Image").on('click', function() { 
                                var imgageData = 
                                    getCanvas.toDataURL("image/jpeg"); 
                            
                                // Now browser starts downloading 
                                // it instead of just showing it 
                                var newData = imgageData.replace( 
                                /^data:image\/jpeg/, "data:application/octet-stream"); 
                            
                                $("#btn-Convert-Html2Image").attr( 
                                "download", "Vcard.jpeg").attr( 
                                "href", newData); 
                            }); 
                            

                    } 
                }); 
            }); 
        }); 


// =========================


        
// function print() {
//         const filename  = 'apraman_patr.pdf';
    
//         html2canvas(document.querySelector('#html-content-holder'), 
//                                 {scale: 5}
//                          ).then(canvas => {
//             let pdf = new jsPDF('l', 'mm', [297, 230]);
//             pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 297, 230);
//             // pdf.addImage(canvas.toDataURL('image/png'), 'PNG', margin-left, margin-top, 311, 398);

//             pdf.save(filename);
//         });
//     }

