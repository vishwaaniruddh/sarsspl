<?php 
include("config.php");
 $qry="select * from oc_pavosliderlayers where group_id='19' and status=1 order by position";

              $res=mysqli_query($con3,$qry);   
?>
<div class="bannercontainer banner-boxed" style="padding: 0;margin: 0 0 30px 0;">
					<div id="sliderlayer1360699920" class="rev_slider boxedbanner" style="width:100%;height:645px; " >
						<ul>
						    
						    
						    <?php
						    
						    while($rws=mysqli_fetch_array($res))
						    {
						    ?>

								<li   data-masterspeed=""  data-transition="" data-slotamount="" data-thumb="<?php echo trim($ocimagepath.$rws['image']);?>">

																					
											<img src="<?php echo trim($ocimagepath.$rws['image']);?>"  alt="Image 0"/>
																				
											
										
										 
												<!-- THE MAIN IMAGE IN THE SLIDE -->
												
											
										<div class="caption softred1 fade 
											easeOutExpo   easeOutExpo 
											"
											 data-x="216"
											 data-y="162"
											 data-speed="300"
											 data-start="400"
											 data-easing="easeOutExpo"  >
											 												 	Electronics 											 	
											</div>
										
											
										
										 
												<!-- THE MAIN IMAGE IN THE SLIDE -->
												
											
										<div class="caption softred2 green fade 
											easeOutExpo   easeOutExpo 
											"
											 data-x="156"
											 data-y="211"
											 data-speed="300"
											 data-start="800"
											 data-easing="easeOutExpo"  >
											 												 	creuset											 	
											</div>
										
											
										
										 
												<!-- THE MAIN IMAGE IN THE SLIDE -->
												
											
										<div class="caption softred3 fade 
											easeOutExpo   easeOutExpo 
											"
											 data-x="221"
											 data-y="311"
											 data-speed="300"
											 data-start="1200"
											 data-easing="easeOutExpo"  >
											 												 	looks of the season											 	
										
											
										
										 
												<!-- THE MAIN IMAGE IN THE SLIDE -->
												
											
										<div class="caption btn-detail fade 
											easeOutExpo   easeOutExpo 
											"
											 data-x="235"
											 data-y="387"
											 data-speed="300"
											 data-start="1600"
											 data-easing="easeOutExpo"  >
											 												 	    <a href="#" class="btn btn-default radius-x">shop now</a>											 	
											</div>
										
												
							</li>	
							<?php } ?>
							 
						</ul>
					</div>
				</div>

 
 </div>