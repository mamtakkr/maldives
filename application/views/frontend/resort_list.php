<div id="ajax_resultss" class="hotels_new">
<div id="search_filter_result">
<input type="hidden" id="offset_val" value="<?php echo $offset;?>">
<button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
<ul class="resort-list" id="ajax_resort_list" >
    <div class="row">
 <?php
	         
	          //echo '<pre>';print_r($resorts); exit();
	          $count = 0;
	          if(!empty($resorts)){
	             foreach ($resorts as $resort) {
	             	$resportAmenities = !empty($resort->amenities)?explode(',', $resort->amenities):'';
	             	$international_airports = $this->developer_model->user_international_airports($resort->id);
	             $images = $this->common_model->get_result('images', array('item_id'=>$resort->id, 'type'=>'resort'));
	             ?>	             	
                        <div class="col-lg-6 col-md-6">
							<div class="accommodation-villa new_resort_fun">
								<div class="row mb-5 p-2">
									<div class="col-lg-12 col-md-12">
										<div class="accommodation-slider owl-carousel">
											<?php $s=0; 
												if($images) {
													foreach($images as $img){
														if($s==0){
															$carousel_item_active = 'active';
														}else{
															$carousel_item_active = '';
														}?>

														<div class="item">
																<?php 
																	if(!empty($img->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$img->image_name)){?>
																		<img class="owlsliderimage" data-thumb='<img src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$img->image_name ;?>" />'  src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$img->image_name ;?>" alt="<?php echo $img->image_name;?>">
																<?php } else{ ?>
																		<img class="owlsliderimage" data-thumb="<img src='<?php echo  FRONT_THEAM_PATH;?>/images/instagram-pic1.jpg'>" src="<?php echo  FRONT_THEAM_PATH;?>/images/instagram-pic1.jpg" >
																<?php } ?>
														</div>
														<?php $s++;
													} 
												} ?>
										</div>
									</div>
									<div class="col-lg-12 col-md-12">
										<div class="py-2 px-3">
										    <div class="img-bottom-contianer inspiration-readmore accommodation-villa">
											<div class="image-text-container">
                                                <div class="d-flex justify-content-between">
                                                    <div class="img-content-title-container">
                                                        <div class="img-content-title">
														<a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($resort->id)); ?>">
															<?php echo !empty($resort->resort_name)?ucfirst($resort->resort_name):'';?>
															<?php $category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));?>
														</a>	
														</div>
														<!--<div class="d-flex ">-->
														
                                                            
              <!--                                          </div>-->
														<div class="d-flex">
														    <span class="star-rating new_star">
															<?php 
															for($i=0;$i< 5;$i++){ 
																if($i<$category->no_of_star) {?>
																<i class="fa fa-star" aria-hidden="true"></i> 
															 <?php } else {
																 ?>
																 <i class="fa fa-star-o" aria-hidden="true"></i> 
																 <?php
															 }
															 }
															?>
															</span>
															<span class="description "><?php echo $category->category_name;?></span>
                                                            
                                                            
                                                            
                                                        </div>
                                                        <span class="hotel-inner-profile-name "><?php echo $resort->atoll;?></span>
                                                    </div>
                                                    <div class="reviews-rating d-flex">
													
													<div class="img-fluid heart-icon" style="margin-right:10px;"> 
														<span class="no-of-likes like-heart" onclick="save_resort_like_unlike('<?php echo $resort->id;?>');" id="resort_like_unlike_btn_<?php echo $resort->id;?>" style="font-size:20px;">
														<?php
															if(user_logged_in()){ 
															if(get_all_count('resorts_likes', array('resort_id'=>$resort->id, 'user_id'=>user_id()))){
																echo '<i class="fa fa-heart MyheartIcon" aria-hidden="true" style="padding-right:1px;"></i>';
															}else{
																echo '<i class="fa fa-heart-o MyheartIcon" aria-hidden="true" style="padding-right:1px;"></i>';
															}
															}else{
															echo '<i class="fa fa-heart-o MyheartIcon" aria-hidden="true" style="padding-right:1px;"></i>';
															}
															$likes = get_all_count('resorts_likes', array('resort_id'=>$resort->id));
															echo !empty($likes)?number_format($likes, 0):'';
														?>
															<span>
																<div id="resort_like_unlike_message_<?php echo $resort->id;?>"></div>
															</span>
														</span>
													</div>

													
														<?php 
															$avg_rates = get_rating($resort->id);
															if(!empty($avg_rates['cal_avg_rates'])) {
																?>
																	<div class="reviews-circle">
																		<a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($resort->id)); ?>">
																		<?php 
																			echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; 
																		?>
																		</a>
																	</div>
																<?php 
															}
														?>
                                                        <div class="reviews-text ml-1">
															<a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($resort->id)); ?>">
																<?php echo !empty($resort->total_reviews)?$resort->total_reviews.' Reviews':''; ?>
															</a>
														</div>
														
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="img-bottom-contianer-description smalldesc">
											<p class="accommodation-villa-text mt-4"><?php echo !empty($resort->resort_description)?character_limiter($resort->resort_description):'';?></p>
											<!--<hr />-->
											<?php
											
											 if(!empty($resort_highlights[$resort->id])) {?>
												<div class="accommodation-villa-title">Highlights</div>
												<div class="row">
    												<?php 
    												foreach($resort_highlights[$resort->id] as $key=>$val) {?>
    												   <div class="col-lg-6 col-md-6 col-6">
    												       <div class="new_highlights d-flex">
    												           <div class="first_highlights">
    												               <h6 class="title_hightlights"><?php echo $val;?></h6>
    												           </div>
    												       </div> 
    												      
    												   </div>
    												   <?php }?>
    												   	<?php 
    												if(!empty($resort->airportType)) {
    													foreach($resort->airportType as $key=>$val) {?>
    													
    													<div class="col-lg-6 col-md-6 col-6">
    												       <div class="new_highlights d-flex">
    												           <div class="first_highlights">
    												               <h6 class="title_hightlights"><?php echo $resort->airportType[$key]->airport_type_name;?></h6>
    												           </div>
    												           <div class="second_highlights">
    												              <p class="text_new_hightlights"> 
    												                <?php 
    																$hours = "";
    																$Minutes = "";
    																
    																if($resort->airportType[$key]->hour1 > 0) {
    																	$hours .= $resort->airportType[$key]->hour1." Hrs ";
    																}
    																if($resort->airportType[$key]->minuts1 > 0) {
    																	$Minutes .= $resort->airportType[$key]->minuts1." Mins ";
    																}
    																if($resort->airportType[$key]->hour2 > 0) {
    																	$hours .= $resort->airportType[$key]->hour2." Hrs ";
    																}
    																if($resort->airportType[$key]->minuts2 > 0) {
    																	$Minutes .= $resort->airportType[$key]->minuts2." Mins ";
    																}
    																if($hours!="" && $Minutes!="") {
    																	echo ": ".$hours."+".$Minutes;
    																}else{
    																    echo ": ".$Minutes;
    																}
    																?>
    												              </p> 
    												           </div>  
    												       </div>   
    												      
    												   </div>
    												   <?php } }?>
    												</div>   
											<?php }?>
											<!--<div class="accommodation-villa-bottom-text mt-3">-->
												<!--<div class="accommodation-villa-title">Location & Transfer types</div>-->
                                                <!--<div class="row accommodation-villa-items">-->
                                                    <!--<div class="col-12 col-md-6 accommodation-villa-item my-1">-->
                                                    <!--    Location-->
                                                    <!--    <div><?php echo $resort->atoll;?> Atoll</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="col-12 col-md-6 resort_accommodation_item accommodation-villa-item my-1">-->
                                                        <!--Transfer types-->
														<?php 
															//if(!empty($resort->airportType)) {
																//foreach($resort->airportType as $key=>$val) {
																?>
																	<div>
																		<?php 
																			//$hours = "";
																			//$Minutes = "";
																			//if($resort->airportType[$key]->hour1 > 0) {
																				//$hours .= $resort->airportType[$key]->hour1." Hours ";
																			//}
																			//if($resort->airportType[$key]->minuts1 > 0) {
																				//$Minutes .= $resort->airportType[$key]->minuts1." Minutes ";
																			//}
																			//if($resort->airportType[$key]->hour2 > 0) {
																				//$hours .= $resort->airportType[$key]->hour2." Hours ";
																			//}
																			//if($resort->airportType[$key]->minuts2 > 0) {
																				//$Minutes .= $resort->airportType[$key]->minuts2." Minutes ";
																			//}
																			//if($hours!="" || $Minutes!="") { echo $resort->airportType[$key]->airport_type_name. " (".$hours.$Minutes.")";}?></div>
																<?php
																//}
															//}
														?>
                                                    <!--</div>-->
                                                <!--</div>-->
											<!--</div>-->
											<!--<div class="accommodation-villa-bottom-links d-flex justify-content-between">-->
											<div class="ideal">    
												<div>
												<?php 
													if(!empty($resort->holidays)){
														$holidays = explode(',', $resort->holidays);
														$holidayArr = [];
														$count = 0;
														foreach($holidays as $holiday){
															$count++;
															if($count<=3) {
																array_push($holidayArr,$holiday);
															}
															if($count==4) {
																array_push($holidayArr,"...");
																break;
															}
															
															
														}
														?>
															<span class="accommodation-villa-title">Ideal For :</span>
                                                    		<span class="accommodation-villa-text"><?php echo implode(",",$holidayArr)?></span>
														<?php
													}
												?>
                                                </div>
                                            	</div>    
                                                <div class="ideal madal_click">
														 <!--   <div>-->
															<!--	<a href="#" class="ideal-link facilities" data-toggle="modal" data-target="#resort_map">Resort Map</a>-->
															<!--</div>-->
												    <div>
														<a href="javascript:void(0);" class="ideal-link resort_map" data-toggle="modal" data-target="#resort_map" onclick="resort_map('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Resort Map</a>
													</div>
												    <div>
														<a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#facilities_details" onclick="facilities_details('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Facilities</a>
													</div>
												</div>	
												
												<!--<div>-->
												<!--	<a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#facilities_details" onclick="facilities_details('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Facilities</a>-->
                                                <!--    </div>-->
                                                </div>
										        <div class="card-read-more-container">
														<a href="#" class="card-read-more btn">Read More</a>
											    </div>
											</div>    
										</div>
									</div>
								</div>
							</div>

                            </div>




<?php 
	             $count++;
	             }
	          }else{
	          	echo '<div class="not-found">
					     <div class="clearfix"></div>
					   <h4>All Resorts Filtered Out!</h4>
						<span>We couldn’t find any resort matching the criteria. Please remove the filters applied and try again.</span>
					    </div>';
	          }?>
	   </div>       
	        <div class="clearfix"></div>
         </ul>
	</div>
	    <div class="btn-view-all text-center ViewAllBtn">
			<!--<a href="javascript:void(0);" class="review-btn btn new_discover_more" onclick="view_more_resorts();">-->
			<!--		Discover More-->
			<!--</a>-->
			<a href="javascript:void(0);" class="new_discover_more" onclick="view_more_resorts();">
					Discover More
			</a>
		</div>
						
	</div>
<div class="modal fade" id="facilities_details" tabindex="-1" role="dialog" aria-labelledby="facilities_details" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="facilities_details_title">Resort Amenities</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="facilities_details_data"></div>
    </div>
  </div>
</div>		
<script type="text/javascript">
	$(document).ready(function(){
		$('.accommodation-slider').owlCarousel({
			autoplay: false,
			autoplayTimeout: 4000,
			loop: true,
			items: 1,
			center: true,
			nav: true,
			thumbs: true,
			thumbImage: false,
			thumbsPrerendered: true,
			thumbContainerClass: 'owl-thumbs',
			thumbItemClass: 'owl-thumb-item',
			navText:['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">','<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
		})
	});
	function facilities_details(resort_id) {
		$.ajax({ 
         	url:base_url+"home/facilities_details",
         	type:"GET",
         	data:{resort_id:resort_id}, 
         	success: function(html){
            	$('#facilities_details_data').html(html);
         	}                
      	}); 
	}
	function save_resort_like_unlike(resort_id){
		$.ajax({
         	url:'<?php echo base_url(); ?>home/save_resort_like_unlike',
         	type:'GET',
         	data:{'resort_id':resort_id}, 
         	success:function(html){
	            var response = $.parseJSON(html);  
	            if(response.status=='not_login_in'){
	            	window.location.href= response.login_url;
	            }else if(response.status=='true'){
	               $('#resort_like_unlike_btn_'+resort_id).html(response.html);
	            }else{
	                $('#resort_like_unlike_message_'+resort_id).html(response.message);
	            }
         	}
      	});
	}
</script>