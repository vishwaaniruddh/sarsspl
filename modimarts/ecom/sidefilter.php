
              	
				  
						  
  <!--script-->
						<script>
							$(document).ready(function(){
								$(".tab1 .single-bottom").hide();
								$(".tab2 .single-bottom").hide();
								$(".tab3 .single-bottom").hide();
								$(".tab4 .single-bottom").hide();
								$(".tab5 .single-bottom").hide();
								
								$(".tab1 ul").click(function(){
									$(".tab1 .single-bottom").slideToggle(300);
									$(".tab2 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab2 ul").click(function(){
									$(".tab2 .single-bottom").slideToggle(300);
									$(".tab1 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
								})
								$(".tab3 ul").click(function(){
									$(".tab3 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab5 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})
								$(".tab4 ul").click(function(){
									$(".tab4 .single-bottom").slideToggle(300);
									$(".tab5 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})	
								$(".tab5 ul").click(function(){
									$(".tab5 .single-bottom").slideToggle(300);
									$(".tab4 .single-bottom").hide();
									$(".tab3 .single-bottom").hide();
									$(".tab2 .single-bottom").hide();
									$(".tab1 .single-bottom").hide();
								})	
							});
						</script>
						<!-- script -->		
						
						
						
						<section  class="sky-form">
					 <h4>DISCOUNTS</h4>
					 <div style="display:none">
					 <input type="radio" name="radio" value="" checked> %
					 
					 <input type="radio" name="radio"  value=""> Rs.
					 
					 
					 </div>
					 
					 
					 
					 <div class="row row1 scroll-pane">
						 
						 <div class="col col-4">
						 <?php 
						 $count=7;
						 $b=80;
						 for($a=0;$a<$count;$a++){
						 
						 ?>
								<label class="checkbox">
								    <input type="checkbox" name="checkbox[]" id="checkbox<?php echo $a;?>"  onclick="funcs('','');" value="<?php $c=$b-10; echo $c;?>">
								    <i></i><?php $b=$b-10; echo $b."%";?> or More</label>
								
						<?php 
						
						}
						 ?>
						 </div>
					 </div>
				 </section> 
				 
				 
					
				   
				   <section  class="sky-form">
						<h4></span>Price</h4>
							<ul class="dropdown-menu1">
								 <li><a href="">								               
								<div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header" style="left: 0%; width: 67.417%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 67.417%;"></a></div>							
								<input id="amount" style="border: 0; font-weight: NORMAL;   font-family: 'Arimo', sans-serif;" onchange="funcs('','','');" type="text">
							 </a></li>			
						  </ul>
				   </section>
				   <!---->
					 <script type="text/javascript" src="js/jquery-ui.min.js"></script>
					 <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
					<script type='text/javascript'>//<![CDATA[ 
					$(window).load(function(){
					 $( "#slider-range" ).slider({

								range: true,
								min: 0,
								max: 400000,
								values: [ 0, 350000 ],
								slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
funcs('','');

								}

					 });

					$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
//funcs('','','');

					});//]]> 
					</script>
					 <!--
					 <section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Type</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>1 Gram Gold (30)</label>
								</div>
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Gold Plated   (30)</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Platinum      (30)</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Silver        (30)</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Jewellery Sets  (30)</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Stone Items   (30)</label>
								</div>
							</div>
				   </section>
				   		<section  class="sky-form">
						<h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
							<div class="row row1 scroll-pane">
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Akasana Collectio</label>
								</div>
								<div class="col col-4">
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Colori</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Crafts Hub</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Jisha</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Karatcart</label>
									<label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Titan</label>
									<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Amuktaa</label>
								</div>
							</div>
				   </section>	-->	