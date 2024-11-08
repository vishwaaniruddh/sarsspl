<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>



<script>
jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
};
</script>
<style>
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
   
  
}
</style>
<div class="multiselect">

    <label><input type="checkbox" name="option[]" value="1" />Green</label>
    <label><input type="checkbox" name="option[]" value="2" />Red</label>
    <label><input type="checkbox" name="option[]" value="3" />Blue</label>
    <label><input type="checkbox" name="option[]" value="4" />Orange</label>
    <label><input type="checkbox" name="option[]" value="5" />Purple</label>
    <label><input type="checkbox" name="option[]" value="6" />Black</label>
    <label><input type="checkbox" name="option[]" value="7" />White</label>
</div>

<script>
$(function() {
     $(".multiselect").multiselect();
});

</script>