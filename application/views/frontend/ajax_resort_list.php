
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
										   <div class="img-bottom-contianer inspiration-readmore">
											<div class="image-text-container">
                                                <div class="d-flex justify-content-between">
                                                    <div class="img-content-title-container">
                                                        <div class="img-content-title">
														<a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($resort->id)); ?>">
															<?php echo !empty($resort->resort_name)?ucfirst($resort->resort_name):'';?>
														</a>
														</div>
                                                        <div class="d-flex">
                                                            <span class="description ml-1"><?php echo $resort->atoll;?></span>
                                                        </div>
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
											<hr />
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
                                                    <!--<div class="col-4 col-md-4 accommodation-villa-item my-1">-->
                                                    <!--    Location-->
                                                    <!--    <div><?php echo $resort->atoll;?> Atoll</div>-->
                                                    <!--</div>-->
                                                    <!--<div class="col-8 col-md-4 accommodation-villa-item my-1">-->
                                                        <!--Transfer types-->
														<?php 
												// 			if(!empty($resort->airportType)) {
																// foreach($resort->airportType as $key=>$val) {
																?>
																	<!--<div>-->
																		<?php 
            																// $hours = "";
            																// $Minutes = "";
            																
            																// if($resort->airportType[$key]->hour1 > 0) {
            																// 	$hours .= $resort->airportType[$key]->hour1." Hrs ";
            																// }
            																// if($resort->airportType[$key]->minuts1 > 0) {
            																// 	$Minutes .= $resort->airportType[$key]->minuts1." Mins ";
            																// }
            																// if($resort->airportType[$key]->hour2 > 0) {
            																// 	$hours .= $resort->airportType[$key]->hour2." Hrs ";
            																// }
            																// if($resort->airportType[$key]->minuts2 > 0) {
            																// 	$Minutes .= $resort->airportType[$key]->minuts2." Mins ";
            																// }
            																// if($hours!="" && $Minutes!="") {
            																// 	echo ": ".$hours."+".$Minutes;
            																// }else{
            																//     echo ": ".$Minutes;
            																// }
            																?>
																	    <!--</div>-->
																<?php
																// }
												// 			}
														?>
                                                    <!--</div>-->
                                                <!--</div>-->
											<!--</div>-->
											<!--<div class="accommodation-villa-bottom-links d-flex justify-content-between">-->
											<div class="">
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
            <!--                                    </div>-->
										
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
	          }
			  ?>
		</div>	  
	        <div class="clearfix"></div>