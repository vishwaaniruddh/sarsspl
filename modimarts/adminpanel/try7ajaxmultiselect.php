<?php

$numbers = '1,2,3';

$array =  explode(',', $numbers);

foreach ($array as $item) {
    $a=$item;
}

?>

<!DOCTYPE html>
<html>
<head>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

	<style>
.multiselect {
	width: 200px;
}
.selectBox {
	position: relative;
}

.selectBox select {
	width: 100%;
	font-weight: bold;
	
}
#checkboxes{
	display: none;
	border: 1px #dadada solid;
}
#checkboxes label {
	display: block;
}
#checkboxes label:hover {
	background-color : #1e90ff;
}
</style>
	
	<script>
	var expanded = false;
	function showCheckBoxes(){
	
	var checkboxes = document.getElementById("checkboxes");
	if(!expanded){
		checkboxes.style.display = "block";
		expanded = true;
	
	}else{
		checkboxes.style.display = "none";
		expanded = false;
	
	}
	
	}
	
</script>
	
	
	<script>

            function getcategory() {

                $.ajax({
                    type: "GET",
                    url: 'regIndividual.php',
                     data:'id='+2,
                    success: function (dat) {
                        alert(dat)
                         var data=$.parseJSON(dat);
						var checkboxes = document.getElementById("checkboxes");
                        for (var i = 0; i < data.length; i++) {
							//alert(data[i]['id'])
							var node = document.createElement('div');        
							node.innerHTML = '<label id="'+ data[i]['name'] +'"><input type="checkbox"  value="'+ data[i]['name'] +'" id="'+ data[i]['id'] +'" name="sport"/>'+data[i]['id'] +'</label>';       
						    document.getElementById('checkboxes').appendChild(node);





                        }

                    },
                    error: function (msg) {

                        alert("error" + msg);
                    }

                });
            }



function a(){
    alert("hi")
 var favorite = [];

            $.each($("input[name='sport']:checked"), function(){            
                favorite.push($(this).val());
          });
            //alert("My favourite sports are: " + favorite.join(", "));

}
        </script>  
        
        
        
        
       
</head>

<body onload="getcategory();">
<div>
	<div class="multiselect">
		<div class="selectbox" onclick="showCheckBoxes()">
			<select>
				<option>Select option</option>
			</select>
			
			<div class="overSelect"></div>
	
		</div> 
		
		<div id="checkboxes" onclick="a()">
			
		</div>
		
	</div>	</div>
</body>


</html>


