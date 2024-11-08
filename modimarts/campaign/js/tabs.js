 $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".card-header").find(".fa-co").text('add_circle_outline');
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa-co").text('remove_circle_outline');
            // alert("Minus");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa-co").text('add_circle_outline');
             // alert("Plus");
        });
    });