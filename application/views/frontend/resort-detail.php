<style>
#section-transfer .measure-distance .speed-boat-container .speed-boat-container-title {
    display: contents;
}
#section-transfer .measure-distance .speed-boat-container-time.mb-2 {
    margin-top: 0;
}
#section-transfer .measure-distance .speed-boat-container .speed-boat-container-image img{
    height:110px;
    object-fit:cover;
}
#section-wellness{
    padding-top:0;
}
@media screen and (max-width: 768px){
section#section-wellness {
    padding-top: 0;
    position: relative;
    bottom: 70px;
}

</style>
<section class="first_section_detail_resort">

	<div class="new-slider  owl-carousel owl-theme">
		<?php
		if (isset($Resortimages) && !empty($Resortimages)) {
			foreach ($Resortimages as $Resortimage) {
				if (isset($Resortimage->image_name) && $Resortimage->image_name != "") {
					$imagePath = base_url('uploads/resorts/full_image/1300_' . $Resortimage->image_name);
					$image_name = 'background-image:url(' . $imagePath . ')';
				} else {
					$image_name = "";
				}
		?>
				<div class="item">
					<div class="header-banner2" style="<?php echo $image_name; ?>">
						<div class="header-title">
							<h1>
								<?php
								if (!empty($resort->resort_caption)) {
									$resort_caption_description = explode(".", $resort->resort_caption);
								}
								$cnt = 0;
								if (!empty($resort_caption_description)) {
									foreach ($resort_caption_description as $key => $val) {
										$cnt++;
								?>
										<span>
										    <?php echo !empty($resort_caption_description[$key]) ? strtolower($resort_caption_description[$key]) : ''; ?></span>
										<?php if (count($resort_caption_description) != $cnt) { ?>
											<br />
										<?php } ?>
								<?php
									}
								}
								?>
							</h1>
							<!--<h2><?php //echo !empty($resort->resort_name) ? ucfirst($resort->resort_name) : ''; ?></h2>-->
						</div>
					</div>


					<div class="hotel-inner-profile-container">
						<div class="hotel-inner-profile-image">
							<?php
							if (isset($resort->resort_logo) && $resort->resort_logo != "" && file_exists("./uploads/resorts/thumbnails/150_" . $resort->resort_logo))
							?>
							<img src="<?php echo  base_url(); ?>/uploads/resorts/thumbnails/150_<?php echo $resort->resort_logo; ?>" alt="Boy_image.png" class="img-fluid mr-1" />
						</div>
						<div class="hotel-inner-profile-text">
							<div class="hotel-inner-profile-name">
								<?php echo !empty($resort->resort_name) ? ucfirst($resort->resort_name)  : ''; ?>
							</div>
							<div class="hotel-inner-profile-rating">
								<?php $category = $this->common_model->get_row('mal_category', array('id' => $resort->resort_category));
								if (isset($category->no_of_star)) {
									for ($i = 0; $i < $category->no_of_star; $i++) { ?>
										<i class="fa fa-star YellowStar" aria-hidden="true"></i>
								<?php }
								} ?>
								<span><?php if (isset($category->category_name)) {
											echo $category->category_name;
										} ?></span>
							</div>
							<div class="hotel-inner-loc-name"><?php echo $resort->state_name; ?></div>
						</div>
					</div>
				</div>
		<?php }
		} ?>
	</div>
</section>



<section class="section-link">
	<div class="section-link-scroll2 box_link_nav owl-carousel">
		<div class="box">
			<div>
				<a href="#section-accommodation" class="section-link-title">Villas & Suites</a>
			</div>
		</div>
		<div class="box">
			<div>
				<a href="#section-Dining" class="section-link-title">Dining</a>
			</div>
		</div>

		<div class="box">
			<div>
				<a href="#section-wellness" class="section-link-title">wellness</a>
			</div>
		</div>
		
		<div class="box">
			<div>
				<a href="#section-facilities" class="section-link-title">Facilities</a>
			</div>
		</div>
		
		<div class="box">
			<div>
				<a href="#section-transfer" class="section-link-title">Location</a>
			</div>
		</div>
		
		<div class="box">
			<div>
				<a href="#section-experince" class="section-link-title">Experiences</a>
			</div>
		</div>

	</div>
</section>
<section id="section-overview" class="resort_detail_about">
	<div class="about bg-light py-2 m-0">
		<div class="about-title">
			<h2>ABOUT THE RESORT</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="about-resort-more">
				<?php
				if (!empty($resort->resort_description)) {
					echo !empty($resort->resort_description) ? $resort->resort_description : '';
				}
				?>
			</span>
		</div>
	</div>
</section>
<section id="section-accommodation">
	<div class="accommodation">
	    	<div class="about-title">
				<h2>VILLAS & RESIDENCES</h2>
				<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
		<div class="blogs-items-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-12 overlay" id="myNav">
					     <div class="mr-lg-3 mr-md-3">
						<div class="blog-sidebar">
							<div class="blog-sidebar-header">
								<span>INSPIRE ME BY</span>
								<a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
							</div>
							<form action="" id="accommodation_form_filter" method="post">
								<input type="hidden" name="resort_id" value="<?php echo !empty($resort->id) ? $resort->id : ''; ?>">
								<div class="blog-sidebar-items-title my-2">
									<span class="blog-sidebar-items-title-text">Villa Type</span>
									<span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items">

									<?php
									if (!empty($villa_types)) {
										foreach ($villa_types as $villa_type) { ?>
											<div class="blog-sidebar-item">
												<div class="pretty p-image p-plain">
													<input type="checkbox" name="villa_types[]" value="<?php echo $villa_type->id; ?>" class="custom-control-input" id="villa_type_fil_<?php echo $villa_type->id; ?>" onclick="accommodation_form_filter();">
													<div class="state">
														<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">
														<label><?php echo $villa_type->villa_type; ?></label>
													</div>
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
								<div class="blog-sidebar-items-title mt-4">
									<span class="blog-sidebar-items-title-text">Location</span>
									<span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items" style="display:none;">



									<div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
											<input type="checkbox" value="sunrise" onclick="accommodation_form_filter();" name="villa_locations[]" class="custom-control-input" id="sunrise">
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">
												<label>Sunrise</label>
											</div>
										</div>
									</div>
									<div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
											<input type="checkbox" value="sunset" onclick="accommodation_form_filter();" name="villa_locations[]" class="custom-control-input" id="sunset">
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">
												<label>Sunset</label>
											</div>
										</div>
									</div>


								</div>
								<div class="blog-sidebar-items-title mt-4">
									<span class="blog-sidebar-items-title-text">Amenities</span>
									<span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items" style="display:none;">
									<?php
									$all_amenitys = array();
									if (!empty($amenitys)) {
										foreach ($amenitys as $amenity) {
											foreach ($amenity['amenities'] as $ami) {
												$all_amenitys[$ami['id']] = $ami['amenitie_name'];
											}
										}
									}
									asort($all_amenitys);
									foreach ($all_amenitys  as  $key => $ami) {
									?>
										<div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
												<input type="checkbox" onclick="accommodation_form_filter();" class="custom-control-input" id="accommodationFac<?php echo $key; ?>" value="<?php echo $key; ?>" name="amenities[]">
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">
													<label><?php echo $ami; ?></label>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<div class="blog-sidebar-items-title mt-4">
									<span class="blog-sidebar-items-title-text">No. Of Rooms</span>
									<span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items" style="display:none;">
									<select name="room_count" style="width:100%;border: none;padding:10px;" onchange="accommodation_form_filter();">
										<option value="">select</option>
										<?php
										for ($i = 1; $i < 10; $i++) {
										?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
										}
										?>
										<option value="10+">10+</option>
									</select>

								</div>
								<br>
							</form>
						</div>
					</div>	
					</div>
					<div class="col-lg-9 col-md-12 mx-auto blog-innner-cards section_villas_residences">
					    
						<div class="about">
							<div class="about-description" style="width:96%;">
								<span class="more">
									<?php echo !empty($resort->accommodation_heading) ? $resort->accommodation_heading : ''; ?>
								</span>
							</div>
						</div>
						
						<div class="villas-pill new_villas_tab_section vills_tab_fd mb-4">
                                <form action="" id="accommodation_form_filter1" method="post">
								<input type="hidden" name="resort_id" value="<?php echo !empty($resort->id) ? $resort->id : ''; ?>">
                                 <!--<div class="villes_choose">-->
                                 
                                <div class="row"> 
                                <div class="col-lg-4"> 
                                
								<div class="blog-sidebar-items">
                                    <!--<select class="custom-select" name="villa_rooms" id="villa_rooms" style="width:100%;border:none;" onchange="inspiration_accommodation_filter();">-->
                                    <!--    <option value="">No of villas</option>-->
                                    <!--    <option value="1">1</option>-->
                                    <!--    <option value="2">2</option>-->
                                    <!--    <option value="3">3</option>-->
                                    <!--    <option value="4">4</option>-->
                                    <!--    <option value="5">5</option>-->
                                    <!--    <option value="6">6</option>-->
                                    <!--    <option value="7">7</option>-->
                                    <!--    <option value="8">8</option>-->
                                    <!--    <option value="9">9</option>-->
                                    <!--    <option value="10+">10+</option>-->
                                    <!--</select>-->
                                    <select class="custom-select" name="room_count" style="width:100%;border: none;padding:4px;" onchange="accommodation_form_filter();">
										<option value="">No. of Villas</option>
										<?php
										for ($i = 1; $i < 10; $i++) {
										?>
											<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php
										}
										?>
										<option value="10+">10+</option>
									</select>
									
                                 </div>
                                </div> 
                                 
                                <div class="col-lg-8"> 
                                 <div class="resort-inner-pill-container" id="filter-btn">
                                     
                                    <!--<label for="Beach_1" class="btn expbutton" onclick="inspiration_accommodation_categories(1);">-->
                                    <!--    <input type="checkbox" id="Beach_1" name="test1" value="1" class="badgebox">-->
                                    <!--    <span>Beach <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    <!--<label for="Overwater_2" class="btn expbutton" onclick="inspiration_accommodation_categories(2);">-->
                                    <!--    <input type="checkbox" id="Overwater_2" name="test1" value="2" class="badgebox">-->
                                    <!--    <span>Overwater <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    <!--<label for="Underwater_5" class="btn expbutton" onclick="inspiration_accommodation_categories(5);">-->
                                    <!--    <input type="checkbox" id="Underwater_5" name="test1" value="5" class="badgebox">-->
                                    <!--    <span>Underwater <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    <!--<label for="Other_7" class="btn expbutton" onclick="inspiration_accommodation_categories(7);">-->
                                    <!--    <input type="checkbox" id="Other_7" name="test1" value="7" class="badgebox">-->
                                    <!--    <span>Other <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->

								<?php
									if (!empty($villa_types)) {
										foreach ($villa_types as $villa_type) { ?>
											<div class="blog-sidebar-item">
												<div class="pretty p-image p-plain">
													<input type="checkbox" name="villa_types[]" value="<?php echo $villa_type->id; ?>" class="custom-control-input" id="villa_type_fil_<?php echo $villa_type->id; ?>" onclick="accommodation_form_filter1();">
													<!--<div class="state">-->
													<!--	<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">-->
														<span><?php echo $villa_type->villa_type; ?> <i class="fa fa-close"></i></span>
														<!--<label><?php echo $villa_type->villa_type; ?></label>-->
													<!--</div>-->
												</div>
											</div>
									<?php
										}
									}
									?>
								</div>
								</div>
								</div>
							</form>
                                
                                
                              </div>
						
						<?php include('accommodation_result.php'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="section-Dining">
	<div class="about">
		<div class="about-title">
			<h2>DINE & WINE</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="more">
				<?php echo $resort->dinning_heading; ?>
			</span>
		</div>
	</div>
	<div class="accommodation">
		<div class="blogs-items-container" id="Dine-inner">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12 col-md-12 mx-auto blog-innner-cards new_dine_and_wize">
					    <div class="villas-pill dine_new_section mb-4">
					      <div class="resort-inner-pill-container">
                                    <!--<label style="font-weight:700;" for="Beach_1" class="btn expbutton" onclick="inspiration_accommodation_categories(1);">-->
                                    <!--    <input type="checkbox" id="Beach_1" name="test1" value="1" class="badgebox">-->
                                    <!--    <span>BREAKFAST <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    <!--<label  style="font-weight:700;" for="Overwater_2" class="btn expbutton" onclick="inspiration_accommodation_categories(2);">-->
                                    <!--    <input type="checkbox" id="Overwater_2" name="test1" value="2" class="badgebox">-->
                                    <!--    <span>LUNCH <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    <!--<label  style="font-weight:700;" for="Underwater_5" class="btn expbutton" onclick="dinning_form_filter();">-->
                                    <!--    <input type="checkbox" id="Underwater_5" name="test1" value="5" class="badgebox">-->
                                    <!--    <span>DINNER <i class="fa fa-close"></i></span>-->
                                    <!--</label>-->
                                    
                                    <form action="" id="dinning_form_filter1" method="post">
        								<input type="hidden" name="resort_id" value="<?php echo !empty($resort->id) ? $resort->id : ''; ?>">
        									<?php
        									if (!empty($meal_serveds)) {
        										foreach ($meal_serveds as $meal_served) { ?>
        											<div class="blog-sidebar-item">
        												<div class="pretty p-image p-plain">
        												   	<label class="btn expbutton">
        													<input type="checkbox" class="custom-control-input badgebox" id="meal_served_<?php echo !empty($meal_served->id) ? $meal_served->id : ''; ?>" name="meal_served[]" onclick="dinning_form_filter1();" value="<?php echo $meal_served->id; ?>">
        													<!--<div class="state">-->
        													<!--	<img class="image" src="<?php echo  FRONT_THEAM_PATH; ?>images/Checkbox.png">-->
        													<span><?php echo !empty($meal_served->meal_served_title) ? $meal_served->meal_served_title : ''; ?> </span>
        													</label>
        													<!--</div>-->
        												</div>
        											</div>
        									<?php
        										}
        									}
        									?>
        							</form>
                                    
                                </div>
                        </div>
                        
						<button class="blog-filter-btn2 btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
						<div>
							<div id="dinning_result">
								<?php include('dinning_result.php'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="my-5" id="section-wellness">
	<div class="about">
		<div class="about-title">
			<h2>HEALTH & WELLNESS</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="more">
				<?php echo $resort->signature_treatment; ?>
			</span>
		</div>
	</div>
	<div class="welness-container">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 pr-0 pl-0">
					<?php
					$img    = 0;
					if (!empty($spa_images)) {
						if (!empty($spa_images[0]->image_name) && file_exists('uploads/resorts/full_image/1300_' . $spa_images[0]->image_name)) { ?>
							<img src="<?php echo base_url() . 'uploads/resorts/full_image/1300_' . $spa_images[0]->image_name; ?>" class="img-fluid">
					<?php
						}
					} ?>
				</div>
				<div class="col-lg-6 col-md-12 py-4 px-4 wellness_fre">
					<div class="wellness-title text-center">
						<h4><?php echo !empty($resort->name_of_the_spa) ? ucfirst($resort->name_of_the_spa) : ''; ?></h4>
						<!--<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="Rectangle6.png" class="img-fluid" />-->
					</div>
					<div class="wellness-text mt-2">
						<p><?php echo !empty($resort->spa_description) ? ucfirst($resort->spa_description) : ''; ?></p>
					</div>
					<div class="wellness-details d-flex justify-content-between">
						<div class="wellness-details-left">
							&nbsp;
						</div>
						
					</div>
					<div class="wellness-title mt-4 text-center">
						<h4>Highlights</h4>
						<!--<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="Rectangle6.png" class="img-fluid" />-->
						
					</div>
						<?php
						$signature_treatment_description = explode("###", $resort->signature_treatment_description);
						foreach ($signature_treatment_description as $k => $spaHighlight) {
							if ($spaHighlight != "") {
						?>
								<div class="spa-highlights-item col-lg-6 col-md-6 col-12"><?php echo $spaHighlight; ?></div>
						<?php }
						} ?>
						<div class="wellness-details-right text-right">
							<a href="javascript:void(0);" myurl="<?php echo  base_url() . 'uploads/resorts/' . $resort->spa_menu; ?>" class="ideal-link SpaMenuLink new_spa_menu">Spa Menu</a>
					</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>



<section id="section-facilities">
    <div class="about">
			<div class="about-title">
				<h2>RESORT FACILITIES</h2>
				<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
		</div>
	<div class="hotel-inner-facilities">
		<div class="container">
		   <div class="row sr-left"> 
    		    <div class="col-lg-6 point_text" id="new_text_new">
        			<div class="row inner-data" >
        				<?php //var_dump($resort->facilities_img); 
        				$SelectedFacility = explode(",", $resort->facilities);
        				$SelectedFacilityNameArr = [];
        				foreach ($SelectedFacility as $k => $v) {
        				    if(is_array($facilities)){
            					foreach ($facilities as $key => $value) {
            						if ($SelectedFacility[$k] == $facilities[$key]->id) {
            							array_push($SelectedFacilityNameArr, $facilities[$key]->facility_name);
            							break;
            						}
            					}
        				    }
        				}
        				foreach ($SelectedFacilityNameArr as $k => $SelectedFacilityName) { ?>
        					<div class="col-lg-6 col-md-6 col-6 mb-4">
        						<div class="hotel-inner-facilities-items">
        							<div class="hotel-inner-facilities-item"><?php echo $SelectedFacilityName; ?></div>
        						</div>
        					</div>
        				<?php } ?>
        
        			</div>
    			</div>
    		<div class="col-lg-6 col-md-12 pr-0 pl-0 point_images">
    				    <?php
        					$img    = 0;
        					if (!empty($fac_images)) {
        						if (!empty($fac_images[0]->image_name) && file_exists('uploads/resorts/full_image/1300_' . $fac_images[0]->image_name)) { ?>
        							<img id="new_images_new" src="<?php echo base_url() . 'uploads/resorts/full_image/1300_' . $fac_images[0]->image_name; ?>" class="img-fluid">
        					<?php
        						}
        					} ?>
    			</div> 
    		</div>	
		</div>
	</div>
    	<div class="complimentary">
    		<div class="about">
    			<div class="about-title">
    				<h2>Complimentary Benefits</h2>
    				<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
    			</div>
    		</div>
    		<div class="container mt-5">
    			<div class="row">
    				<?php foreach ($complimentary_services as $complimentary_name) {
    					if ($complimentary_name->complimentary_name != "") {
    				?>
    						<div class="col-lg-3 col-md-6 col-6 mb-4">
    							<div class="hotel-inner-facilities-items">
    								<div class="hotel-inner-facilities-item"><?php echo $complimentary_name->complimentary_name; ?></div>
    							</div>
    						</div>
    				<?php }
    				} ?>
    			</div>
    		</div>
    	</div>	
	</div>
</section>
<section id="section-reviews">
	<div class="sports-entertainment">
		<div class="about">
			<div class="about-title">
				<h2>SPORTS & ENTERTAINMENT</h2>
				<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
		</div>
		<div class="container">
			<div class="row sr-right">
				<div class="col-lg-6 col-md-12 pr-0 pl-0">
    				    <div class="img_facilities">
    				        <?php
        					$img    = 0;
        					if (!empty($sport_images)) {
        						if (!empty($sport_images[0]->image_name) && file_exists('uploads/resorts/full_image/1300_' . $sport_images[0]->image_name)) { ?>
        							<img id="new_images"  src="<?php echo base_url() . 'uploads/resorts/full_image/1300_' . $sport_images[0]->image_name; ?>" class="img-fluid new_sytle_img">
        					<?php
        						}
        					} ?>
    				        <!--<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Sports_pic1.jpg" class="img-fluid">-->
    				    </div>    
    			</div>   
			     <div class="col-lg-6" id="new_text"  >
        			<div class="row sort-items" >
        				<?php
        				if (!empty($sports)) {
        					foreach ($sports as $sport) { ?>
        						<div class="col-lg-6 col-md-12 mb-4 item-left">
        							<div class="sports-items">
        								<div class="sports-item"><?php echo $sport->sport_name; ?></div>
        							</div>
        						</div>
        				<?php }
        				} ?>
        				<?php if (!empty($water_sports)) {
        					foreach ($water_sports as $sport) { ?>
        						<div class="col-lg-6 col-md-12 mb-4 item-right">
        							<div class="sports-items">
        								<div class="sports-item"><?php echo $sport->water_sports_name; ?></div>
        							</div>
        						</div>
        
        				<?php }
        				} ?>
        			</div>
        		</div>
        		
			</div>
		</div>
	</div>
</section>

<!--<section id="section-transfer">-->
<!--	<div class="about">-->
<!--		<div class="about-title">-->
<!--			<h2>LOCATION & HOW TO GET THERE?</h2>-->
<!--			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">-->
<!--		</div>-->
<!--		<div class="about-description">-->
<!--			<span class="more">-->
<!--				Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.-->
<!--			</span>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="measure-distance">-->
<!--		<div class="container">-->
<!--			<div class="row location-info">-->
<!--                <div class="col-lg-6 col-md-12 location-info">-->
				<?php
				//if (!empty($international_airports)) {
					//foreach ($international_airports as $international_airport) { ?>
						<!--<div class="col-lg-6 col-md-6">-->
						<!--	<div class="speed-boat-container py-5">-->
						<!--		<div class="speed-boat-container-image">-->
									<?php
									//if (!empty($international_airport->image_name) && file_exists('uploads/airport_type/thumbnails/' . $international_airport->image_name)) { ?>
										<!--<img src="<?php echo  base_url() . 'uploads/airport_type/thumbnails/' . $international_airport->image_name; ?>" alt="speed-bot" class="img-fluid my-3" />-->
									<?php
									//} else { ?>
										<!--<img src="<?php echo  FRONT_THEAM_PATH; ?>img/speed-bot.png" alt="speed-bot" class="img-fluid my-3" />-->
									<?php //} ?>
								<!--</div>-->
								<!--<div class="speed-boat-container-title mb-2">-->
									<?php
									//if (!empty($international_airport->airport_type) && $international_airport->airport_type == 1) {
										//echo !empty($international_airport->airport_type_name) ? $international_airport->airport_type_name : '';
									//} else {
										//echo ' speedboat';
									//}
									?>
								<!--</div>-->
								<!--<div class="speed-boat-container-time mb-2">-->
									<?php
								// 	echo !empty($international_airport->hour1) ? $international_airport->hour1 . ' hour ' : '';
								// 	echo !empty($international_airport->minuts1) ? $international_airport->minuts1 . ' minutes ' : '';
								// 	echo !empty($international_airport->hour2) ? $international_airport->hour2 . ' hour ' : '';
								// 	echo !empty($international_airport->minuts2) ? $international_airport->minuts2 . ' minutes ' : '';

									?>
						<!--		</div>-->
						<!--		<div class="speed-boat-container-assumption mb-2">-->
						<!--			<span><?php echo !empty($international_airport->tag) ? $international_airport->tag : ''; ?></span>-->
						<!--		</div>-->
						<!--	</div>-->
						<!--</div>-->
				<?php //}
				//}
				?>
    <!--            </div>-->
				<!--<div class="col-lg-6 col-md-12 pr-0 pl-0">-->
				<!--	<div>-->
						<?php
						//if (!empty($resort->physical_lat) && !empty($resort->physical_lng)) { ?>
							<!--<iframe width="100%" height="320" frameborder="0" style="border:0;display:block;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBUjboVRgdHyDpICXehpvWYo0wywUAheMQ&q=<?php echo !empty($resort->physical_lat) ? $resort->physical_lat : ''; ?>,<?php echo !empty($resort->physical_lng) ? $resort->physical_lng : ''; ?>" allowfullscreen></iframe>-->
						<?php //} else {
				// 			echo '<div class="not-found">
    //                             <img src="' . FRONT_THEAM_PATH . 'img/no_loc.png" alt="No Found" />
    //                               <div class="clearfix"></div>
    //                               <h4>No location!</h4>
    //                               <span>We couldn’t find any location matching the criteria</span>
    //                          </div>';
						//}
						?>
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</section>-->

<section id="section-transfer">
	<div class="about">
		<div class="about-title">
			<h2>LOCATION & HOW TO GET THERE?</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="more">
				Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
			</span>
		</div>
	</div>
	<div class="measure-distance">
		<div class="container">
			<div class="row location-info">
                <div class="col-lg-6 col-md-12 location-info">
				
						<div class="col-lg-12 col-md-12 mt-4">
							<!--<div class="speed-boat-container py-5">-->
							    <div class="row">
							        <div class="col-lg-4">
							            <div class="loc_text_new">
							                <p class="new_blod">LOCATION:</p>
							             </div>   
							        </div> 
							        <div class="col-lg-8">
							            <div class="location_find">
							                <p><?php echo !empty($resort->state_name) ? ucfirst($resort->state_name) : ''; ?></p>
							             </div>   
							        </div> 
							     </div>
							     <div class="row">
							         <div class="col-12">
							            <p class="new_blod">TRANSFER TYPES:-</p>
							         </div>
							         <?php
							         if (!empty($international_airports)) {
							             foreach ($international_airports as $international_airport) { ?>
							        <div class="col-lg-4">
							            <div class="loc_text_new">
							                <p class="new_blod">
							                <?php
            									if (!empty($international_airport->airport_type) && $international_airport->airport_type == 1) {
            										echo !empty($international_airport->airport_type_name) ? $international_airport->airport_type_name : '';
            									} else {
            										echo ' Speedboat:';
            									}
            									?>    
							                </p>
							             </div>   
							        </div> 
							        <div class="col-lg-8">
							            <div class="location_find">
							                <p>
							                <?php
        									echo !empty($international_airport->hour1) ? $international_airport->hour1 . ' hour ' : '';
        									echo !empty($international_airport->minuts1) ? $international_airport->minuts1 . ' minutes ' : '';
        									echo !empty($international_airport->hour2) ? $international_airport->hour2 . ' hour ' : '';
        									echo !empty($international_airport->minuts2) ? $international_airport->minuts2 . ' minutes ' : '';
        
        									?>
							                </p>
							             </div>   
							        </div> 
							        <?php
							             }
							         }
							        ?>
							     </div>
							     <div class="row">
							        <div class="col-lg-8">
							            <div class="loc_text_new">
							                <p class="new_blod">Distance to Velana International Airport:</p>
							             </div>   
							        </div> 
							        <div class="col-lg-4">
							            <div class="location_find">
							                <p><?php echo $resort->distance_to_closest_international_airport;?></p>
							             </div>   
							        </div> 
							     </div>
							     <div class="row">
							        <div class="col-lg-7">
							            <div class="loc_text_new">
							                <p class="new_blod">CLOSEST DOMESTIC AIRPORT:</p>
							             </div>   
							        </div> 
							        <div class="col-lg-5">
							            <div class="location_find">
							                <p><?php echo $resort->name_to_closest_domestic_airport;?></p>
							             </div>   
							        </div> 
							     </div>
							     <?php if($resort->transfers_for_night_international_flights==1){?>
							     <div class="row">
							        <div class="col-lg-12">
							            <div class="loc_text_new">
							                <p>This resort arranges transfers for international night arrivals</p>
							             </div>   
							        </div> 
							     </div>
							     <?php } ?>
							     
						</div>
				
                </div>
                
				<div class="col-lg-6 col-md-12 pr-0 pl-0">
					<div>
						<?php
						if (!empty($resort->physical_lat) && !empty($resort->physical_lng)) { ?>
							<iframe width="100%" height="320" frameborder="0" style="border:0;display:block;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBUjboVRgdHyDpICXehpvWYo0wywUAheMQ&q=<?php echo !empty($resort->physical_lat) ? $resort->physical_lat : ''; ?>,<?php echo !empty($resort->physical_lng) ? $resort->physical_lng : ''; ?>&zoom=28" allowfullscreen></iframe>
						<?php } else {
							echo '<div class="not-found">
                                <img src="' . FRONT_THEAM_PATH . 'img/no_loc.png" alt="No Found" />
                                   <div class="clearfix"></div>
                                   <h4>No location!</h4>
                                   <span>We couldn’t find any location matching the criteria</span>
                             </div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="signture_exprrienes destop_exprrienes" id="section-experince">
	<div class="container">
		<div class="featured_resorts" style="text-align:center;">
			<h2>SIGNATURE EXPERIENCES </h2>
			<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		
        <form action="" id="resort_experience_filter_frm" method="post">
        	<input type="hidden" name="experince_offset" class="experince_offset" value="3"/>
            <input type="hidden" name="experince_limit" id="experince_limit" value="3"/>
            <input type="hidden" name="experince_count" id="experince_count" value="<?php echo count($expriencesCount); ?>"/>
            <input type="hidden" name="experince_total" id="experince_total" value="<?php echo !empty($expriences) ? count($expriences) : 0; ?>"/>
    	    <input type="hidden" name="resort_id" id="resort_id" value="<?php echo !empty($resort->id) ? $resort->id : ''; ?>">
    	</form>
        <div class="row signature-experiences" id="resort_experience_result">
			<?php
			if ($expriences) {
				foreach ($expriences as $exprience) {
				// 	$ac_images = $this->common_model->get_row('images', array('item_id' => $exprience->id, 'type' => 'accommodation'));
				// 	if (!empty($ac_images->image_name) && file_exists('uploads/resorts/full_image/1300_' . $ac_images->image_name)) {
				// 		$ImagePath = base_url() . 'uploads/resorts/full_image/1300_' . $ac_images->image_name;
				// 	} else {
				// 		$ImagePath = FRONT_THEAM_PATH . '/images/instagram-pic2.jpg';
				// 	}
				if(!empty($exprience->activities_image)) {
					$ImagePath = base_url().'uploads/resorts/full_image/1300_'.$exprience->activities_image;
				} else {
					$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic2.jpg';
				}
				$category = $this->common_model->get_row('mal_category', array('id'=>$exprience->resort_category)); 
			?>
					<div class="col-lg-4 mb-lg-4">
						<div class="box">
							<div class="img-content">
								<img src="<?php echo  $ImagePath; ?>" alt="<?php if (!empty($ac_images->image_name)) {
																				echo $ac_images->image_name;
																			} ?>" class="img-fluid HomeImage">
								<div class="image-text-container">
									<div class="d-flex justify-content-between">
										<div class="img-content-title-container">
											<div class="img-content-title">
											    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($exprience->resort_id)); ?>">
											        <?php echo $exprience->resort_name;?>
											    </a>
											</div>
											<div class="d-flex des-star new_letter_s">
											    <?php 
													for($i=0;$i< $category->no_of_star;$i++){ 
														?>
															<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
														<?php 
													} 
												?>
											    <span class="description"><?php echo $category->category_name;?></span>
											</div>
										    <div class="d-flex">
											    <span class="description">
											        <?php echo !empty($exprience->state_name) ? ucfirst($exprience->state_name) : ''; ?>
											    </span>
											</div>

										</div>
									</div>
								</div>
							</div>

							<div class="about-slider-bottom signature_experiences inspiration-readmore2 accommodation-villa">
								<div class="about-slider-bottom-description smalldesc">
									<div class="about-slider-bottom-description-title  d-flex mb-2">
										<div class="about-slider-bottom-description-title1"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id=' . base64_encode($exprience->resort_id)); ?>"><?php echo $exprience->name_of_activities ?></a></div>
									</div>
									<span class="">
										<?php echo $exprience->activities_description; ?>
									</span>
								</div>
								<div class="card-read-more-container">
									<a href="#" class="card-read-more2 btn">Read more</a>
								</div>
							</div>
							<div class="img-fluid heart-icon">
								<span class="no-of-likes like-heart" onclick="save_exprince_like_unlike('<?php echo $exprience->id; ?>');" id="experince_like_unlike_btn_<?php echo $exprience->id; ?>">
									<?php
									if (user_logged_in()) {
										if (get_all_count('exprience_likes', array('exprience_id' => $exprience->id, 'user_id' => user_id()))) {
											echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
										} else {
											echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
										}
									} else {
										echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
									}
									?>
									<span>
										<strong><?php $likes = get_all_count('exprience_likes', array('exprience_id' => $exprience->id));
												echo !empty($likes) ? number_format($likes, 0) : ''; ?>
										</strong>
									</span>
								</span>
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
          <?php 
          if(is_array($expriences)){
          if(count($expriences)>2){ ?>
		<div class="d-flex justify-content-center my-4 new_discover_more_btn new_button_n">
			<!--<a href="<?php echo base_url(); ?>inspiration" class="Exp discover-more-btn new_discover_more">Discover More </a>-->
			<button type="button" class="exp_discover_more review-btn btn"  onclick="resort_experience_filter_more();">Discover More</button>
		</div>
        <?php } }?>
	</div>
</section>


<section class="signture_exprrienes Moblie_exprrienes">
	<div class="container">
		<div class="featured_resorts" style="text-align:center;">
			<h2>SIGNATURE EXPERIENCES </h2>
			<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="inspiration-slider owl-carousel owl-theme mt-2">
			<?php
			if ($expriencesCount) {
				foreach ($expriencesCount as $exprience) {
     	            $category = $this->common_model->get_row('mal_category', array('id'=>$exprience->resort_category));
					$ac_images = $this->common_model->get_row('images', array('item_id' => $exprience->id, 'type' => 'accommodation'));
					if (!empty($ac_images->image_name) && file_exists('uploads/resorts/full_image/1300_' . $ac_images->image_name)) {
						$ImagePath = base_url() . 'uploads/resorts/full_image/1300_' . $ac_images->image_name;
					} else {
						$ImagePath = FRONT_THEAM_PATH . '/images/instagram-pic2.jpg';
					}
			?>
					<!--<div class="col-lg-4">-->
					<div class="box">
					 <div class="img-content"> 
						<img src="<?php echo  $ImagePath; ?>" alt="<?php if (!empty($ac_images->image_name)) {
																		echo $ac_images->image_name;
																	} ?>" class="img-fluid HomeImage">
																	<div class="image-text-container">
														<div class="d-flex justify-content-between">
															<div class="img-content-title-container">
																<div class="img-content-title">
																    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($exprience->resort_id)); ?>">
																        <?php echo $exprience->resort_name;?>
																    </a>
																</div>
																<div class="d-flex des-star new_letter_s">
																    <?php 
																		for($i=0;$i< $category->no_of_star;$i++){ 
																			?>
																				<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																			<?php 
																		} 
																	?>
																    <span class="description"><?php echo $category->category_name;?></span>
																</div>
															    <div class="d-flex">
																    <span class="description">
																        <?php echo !empty($exprience->state_name) ? ucfirst($exprience->state_name) : ''; ?>
																    </span>
																</div>
						
															</div>
														</div>
													</div>
						</div>							
						<div class="about-slider-bottom">
							<div class="about-slider-bottom-description">
								<div class="about-slider-bottom-description-title d-flex mb-2">
									<div class="about-slider-bottom-description-title1"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id=' . base64_encode($exprience->resort_id)); ?>"><?php echo $exprience->name_of_activities ?></a></div>
									<!--<div class="about-slider-bottom-description-title2 ml-2"><a href="<//?php echo base_url('resort-detail?type=reviews&resort_id=' . base64_encode($exprience->resort_id)); ?>"><//?php echo $exprience->resort_name; ?></a></div>-->
								</div>
								<span class="new_more">
									<?php echo $exprience->activities_description; ?>
								</span>
							</div>
						</div>
						<div class="img-fluid heart-icon">
							<span class="no-of-likes like-heart" onclick="save_exprince_like_unlike('<?php echo $exprience->id; ?>');" id="experince_like_unlike_btn_<?php echo $exprience->id; ?>">
								<?php
								if (user_logged_in()) {
									if (get_all_count('exprience_likes', array('exprience_id' => $exprience->id, 'user_id' => user_id()))) {
										echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
									} else {
										echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
									}
								} else {
									echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
								}
								?>
								<span>
									<strong><?php $likes = get_all_count('exprience_likes', array('exprience_id' => $exprience->id));
											echo !empty($likes) ? number_format($likes, 0) : ''; ?>
									</strong>
								</span>
							</span>
						</div>
					</div>
					<!--</div>	-->
			<?php
				}
			}
			?>
		</div>
		<!--<div class="d-flex justify-content-center my-4">-->
		<!--	<a href="<?php echo base_url(); ?>inspiration" class="view-more-link">Discover More </a>-->
		<!--</div>-->
	</div>
</section>





<section id="section-stories" class="resort_stories_section">
	<div>
		<div class="inspiration bg-light py-4">
			<div class="about">
				<div class="about-title">
					<h2>RESORT STORIES</h2>
					<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
			</div>
			<ul class="nav nav-tabs mx-auto" id="inspiration-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link  active" id="traveller-tab" data-toggle="tab" href="#traveller" role="tab" aria-controls="traveller" aria-selected="true">Traveller Reviews</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="resorts-tab" data-toggle="tab" href="#resorts" role="tab" aria-controls="resorts" aria-selected="false">Resorts Stories</a>
				</li>
			</ul>
			<style>
				.mobile-social-share {
					background: none repeat scroll 0 0 #EEEEEE;
					display: block !important;
					min-height: 70px !important;
					margin: 50px 0;
				}


				.mobile-social-share h3 {
					color: inherit;
					float: left;
					font-size: 15px;
					line-height: 20px;
					margin: 25px 25px 0 25px;
				}

				.share-group {
					float: right;
					margin: 18px 25px 0 0;
				}

				.btn-group {
					display: inline-block;
					font-size: 0;
					position: relative;
					vertical-align: middle;
					white-space: nowrap;
				}

				.mobile-social-share ul {
					float: right;
					list-style: none outside none;
					margin: 0;
					min-width: 61px;
					padding: 0;
				}

				.share {
					min-width: 17px;
				}

				.mobile-social-share li {
					display: block;
					font-size: 18px;
					list-style: none outside none;
					margin-bottom: 3px;
					margin-left: 4px;
					margin-top: 3px;
				}

				.btn-share {
					background-color: #BEBEBE;
					border-color: #CCCCCC;
					color: #333333;
				}

				.btn-twitter {
					background-color: #3399CC !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-facebook {
					background-color: #3D5B96 !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-facebook {
					background-color: #3D5B96 !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-google {
					background-color: #DD3F34 !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-linkedin {
					background-color: #1884BB !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-pinterest {
					background-color: #CC1E2D !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.btn-mail {
					background-color: #FFC90E !important;
					width: 51px;
					color: #FFFFFF !important;
				}

				.caret {
					border-left: 4px solid rgba(0, 0, 0, 0);
					border-right: 4px solid rgba(0, 0, 0, 0);
					border-top: 4px solid;
					display: inline-block;
					height: 0;
					margin-left: 2px;
					vertical-align: middle;
					width: 0;
				}

				#socialShare {
					max-width: 59px;
					margin-bottom: 18px;
				}

				#socialShare>a {
					padding: 6px 10px 6px 10px;
				}

				@media (max-width : 320px) {
					#socialHolder {
						padding-left: 5px;
						padding-right: 5px;
					}

					.mobile-social-share h3 {
						margin-left: 0;
						margin-right: 0;
					}

					#socialShare {
						margin-left: 5px;
						margin-right: 5px;
					}

					.mobile-social-share h3 {
						font-size: 15px;
					}
				}

				@media (max-width : 238px) {
					.mobile-social-share h3 {
						font-size: 12px;
					}
				}
			</style>
			<?php if (0) { ?>
				<div class="resort-inner-pill-container my-4">
					<?php
					$trv_cat = 0;
					$traveller_stories_arr = array();

					foreach ($traveller_categorys as $cat) {
						if ($trv_cat == 0) {
							$story_active = 'active';
						} else {
							$story_active = '';
						} ?>
						<label for="<?php echo $cat->category_name . $cat->id; ?>" class="btn expbutton">
							<input type="checkbox" id="<?php echo $cat->category_name . $cat->id; ?>" name="test" value="<?php echo $cat->id; ?>" class="badgebox">
							<span><?php echo $cat->category_name; ?><i class="fa fa-close"></i></span>
						</label>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="traveller" role="tabpanel" aria-labelledby="traveller-tab">
					<div class="d-flex justify-content-end">
						<?php
						if ($this->session->userdata('user_info')) {
							$review_link = base_url('user/add_story?type=add_story&resort_id=');
						} else {
							$review_link = base_url('login?type=add_story&resort_id=');
						}
						?>
						<a class="review-btn btn my-2" href="<?php echo $review_link; ?>"><i class="fa fa-pencil mr-2"></i>Write a Review</a>
					</div>
					<?php

					if (!empty($stories)) {
						foreach ($stories as $story) {
							$avg_rates = get_rating($story->resort_id, $story->id);
							$images = $this->common_model->get_result('images', array('status' => '1', 'item_id' => $story->id, 'type' => 'traveller_story'));
					?>
							<div class="reviews-container">
								<div class="row my-3">
									<div class="col-lg-12 col-md-12 col-12 mb-4">
										<div class="reviewer-details">
											<div class="reviewer-details-profile">
												<div>
													<div class="reviewer-image">
														<?php
														if (!empty($story->profile_pic) && file_exists('uploads/users/' . $story->profile_pic)) {
															echo '<img src="' . base_url('uploads/users/' . $story->profile_pic) . '"  class="img-fluid">';
														} else {
															echo '<img src="' . FRONT_THEAM_PATH . 'images/No_Image_Available.jpg"  class="img-fluid"/>';
														}

														?>
													</div>
												</div>
												<div>
													<div class="reviewer-name">
														<?php
														echo !empty($story->first_name) ? ucfirst($story->first_name) : '';
														echo !empty($story->last_name) ? ' ' . ucfirst($story->last_name) : '';
														?>
													</div>
													<div class="reviewer-text">
														<div>Posted a Review on <?php echo !empty($story->created_date) ? date('d F Y', strtotime($story->created_date)) : ''; ?></div>
														<div><?php echo ucwords($story->country_name); ?> | <?php $contributions = get_all_count('traveller_stories', array('user_id' => $story->user_id));
																											echo !empty($contributions) ? number_format($contributions, 0) : ''; ?> Contributions</div>
													</div>
												</div>
											</div>
											<div class="reviewer-exception-btn">
												<button class="btn">Exceptional 10</button>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-12">
										<div class="guest-reviews-details">
											<div>
												<div class="guest-reviews-details-top">
													<a href="<?= base_url('resort-detail?&resort_id=' . base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name); ?></a>

													<div>
														<img src="<?php echo  FRONT_THEAM_PATH; ?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
														<a href="<?= base_url('resort-detail?&resort_id=' . base64_encode($story->resort_id)); ?>"> </a>
														<?php if ($story->verified_status == 1) { ?>
															<span class="verified">Stay Verified</span>
														<?php } ?>
													</div>
												</div>
												<p class="mt-2">
													<?php echo ucwords($story->my_experience . substr(1, 20)); ?>
												</p>
												<div class="guest-reviews-rating-details">
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Stay date</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->traveller_date) ? date('d F Y', strtotime($story->traveller_date)) : ''; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Holiday Type</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->category_name) ? ' ' . ucfirst($story->category_name) : '-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Villa & Suite</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->name_of_villa) ? ucfirst($story->name_of_villa) : '-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Length of Stay</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->nights_stayed) ? ucfirst($story->nights_stayed) : '-'; ?> nights </div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Visit to Maldives</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->maldives_visits) ? ucfirst($story->maldives_visits) : '-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Visit to this property</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->hotel_visits) ? ucfirst($story->hotel_visits) : '-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Exceptional Staff members</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->staff_name) ? ucfirst($story->staff_name) : '-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">I recommend this property to</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->staff_name) ? ucfirst($story->staff_name) : '-'; ?></div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Staff Friendliness</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->staff_friendliness && !empty($story->staff_friendliness)) ? '<i class="fa fa-star-o" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Accommodation</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->villa && !empty($story->villa)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Facilities</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->facilities && !empty($story->facilities)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Kids Facilities</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->kids_facilities && !empty($story->kids_facilities)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Snorkeling</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->over_all && !empty($story->over_all)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Services</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->services && !empty($story->services)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Dining</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->dine_wine && !empty($story->dine_wine)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Wellness</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->spa && !empty($story->spa)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Beach</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->beach && !empty($story->beach)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Location</div>
															<div class="guest-reviews-rating-text">
																<div class="star-rating">
																	<?php
																	for ($nu = 1; $nu <= 5; $nu++) {
																		echo ($nu <= $story->location && !empty($story->location)) ? '<i class="fa fa-star" aria-hidden="true"></i> ' : '<i class="fa fa-star-o" aria-hidden="true"></i> ';
																	}
																	?>
																</div>
															</div>
														</div>
													</div>
													<hr />
												</div>
												<div class="guest-reviews-gallery">
													<?php
													$counterI = 0;
													if (!empty($images)) {
														$counts = count($images);
														foreach ($images as $image) {
															$counterI++;
															if (!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/150_' . $image->image_name)) { ?>
																<img src="<?php echo base_url() . 'uploads/resorts/thumbnails/150_' . $image->image_name; ?>" alt="" class="img-fluid mr-2">
													<?php
															}
														}
													} ?>
												</div>
												<div class="guest-reviews-share-link mt-4">
													<div class="d-flex align-items-center">
														<div class="review-icons">
															<a href="javascript:void(0);" onclick="like_unlike('<?php echo $story->id; ?>');" id="like_unlike_btn_<?php echo $story->id; ?>">
																<div class="like-up ">
																	<?php
																	if (user_logged_in()) {
																		if (get_all_count('traveller_stories_like', array('story_id' => $story->id, 'user_id' => user_id()))) {
																			echo '<img src="' . FRONT_THEAM_PATH . 'images/Helpful.png" alt="Helpful.png" class="img-fluid ml-2"> ';
																		} else {
																			echo '<img src="' . FRONT_THEAM_PATH . 'images/dishelpful.png" alt="dishelpful.png" class="img-fluid ml-2"> ';
																		}
																	} else {
																		echo '<img src="' . FRONT_THEAM_PATH . 'images/dishelpful.png" alt="dishelpful.png" class="img-fluid ml-2"> ';
																	}
																	$likes = get_all_count('traveller_stories_like', array('story_id' => $story->id));
																	?><span><?php
																								echo !empty($likes) ? $likes : '1';
																								?></span>
																</div>
															</a>
														</div>
													</div>
													<div class="d-flex align-items-center ml-2">
														<div class="review-icons">
															<a href="javascript:void(0);" onclick="open_comment_sec('<?php echo $story->id; ?>');">
																<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Comment.png" alt="Comment.png" class="img-fluid ml-2">
																<span class="number-like comment" id="traveller_stories_comments_<?php echo $story->id; ?>">
																	<?php
																	$comments = get_all_count('traveller_stories_comments', array('status' => '1', 'story_id' => $story->id));
																	echo !empty($comments) ? $comments : '';
																	?>
																</span>
															</a>

														</div>
													</div>
													<?php
													$share_link = base_url('home/share_story?story_id=' . base64_encode($story->id));;
													$blog_title = !empty($story->story_title) ? ucfirst($story->story_title) : '';
													?>
													<div class="d-flex align-items-center ml-2">
														<div id="socialShare" class="btn-group share-group">
															<a class="btn btn-info">
																<i class="fa fa-share-alt fa-inverse"></i>
															</a>
															<a data-original-title="Twitter" rel="tooltip" href="https://twitter.com/share?url=<?php echo $share_link . '&text=' . $blog_title ?>" class="btn btn-twitter" data-placement="left">
																<i class="fa fa-twitter"></i>
															</a>
															<a data-original-title="Facebook" rel="tooltip" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left">
																<i class="fa fa-facebook"></i>
															</a>
															<a data-original-title="LinkedIn" rel="tooltip" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" class="btn btn-linkedin" data-placement="left">
																<i class="fa fa-linkedin"></i>
															</a>
															<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link . '&description=' . $blog_title ?>" class="btn btn-pinterest" data-placement="left">
																<i class="fa fa-pinterest"></i>
															</a>
															<ul class="dropdown-menu" style="background:transparent;border:none;">
																<li>
																	<a data-original-title="Twitter" rel="tooltip" href="https://twitter.com/share?url=<?php echo $share_link . '&text=' . $blog_title ?>" class="btn btn-twitter" data-placement="left">
																		<i class="fa fa-twitter"></i>
																	</a>
																</li>
																<li>
																	<a data-original-title="Facebook" rel="tooltip" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left">
																		<i class="fa fa-facebook"></i>
																	</a>
																</li>

																<li>
																	<a data-original-title="LinkedIn" rel="tooltip" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" class="btn btn-linkedin" data-placement="left">
																		<i class="fa fa-linkedin"></i>
																	</a>
																</li>
																<li>
																	<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link . '&description=' . $blog_title ?>" class="btn btn-pinterest" data-placement="left">
																		<i class="fa fa-pinterest"></i>
																	</a>
																</li>

															</ul>
														</div>
													</div>
												</div>
												<div class="reviewer-comment">
													<form action="" onsubmit="return false;" method="post">
														<div class="form-group d-flex mt-2">
															<textarea class="form-control mr-2 comment-input" id="traveller_comment_<?php echo !empty($story->id) ? $story->id : ''; ?>" name="comment" rows="2" placeholder="Add Comment"></textarea>
															<button type="submit" class="btn comment-send-btn" onclick="save_traveller_comment('<?php echo !empty($story->id) ? $story->id : ''; ?>');">
																Send</button>
														</div>
														<div id="traveller_comment_error_<?php echo !empty($story->id) ? $story->id : ''; ?>" class="text-danger"></div>
													</form>
												</div>

												<div class="add_comment more_dddsss">


													<div id="traveller_comment_message_<?php echo !empty($story->id) ? $story->id : ''; ?>"></div>

													<div class="clearfix"></div>

												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
					<?php   }
					} ?>
				</div>
				<div class="tab-pane fade pt-5" id="resorts" role="tabpanel" aria-labelledby="resorts-tab">
					<?php
					if (!empty($Resortstories)) {
						foreach ($Resortstories as $story) {
							//$images = $this->common_model->get_result('images', array('status' => '1', 'item_id' => $story->id, 'type' => 'traveller_story'));
					?>
							<div class="reviews-container">
								<div class="row my-3">
									<div class="col-lg-12 col-md-12 col-12">
										<div class="guest-reviews-details">
											<div>
												<div class="guest-reviews-details-top">
													<a href="<?= base_url('resort-detail?&resort_id=' . base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name); ?></a>
													<div>
														<img src="<?php echo  FRONT_THEAM_PATH; ?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
														<a href="<?= base_url('resort-detail?&resort_id=' . base64_encode($story->resort_id)); ?>"> </a>
														<span class="verified"><?php echo $story->title; ?></span>
													</div>
												</div>
												<div><?php echo ucfirst(strip_tags($story->description)); ?></div>
												<div class="guest-reviews-gallery">
													<?php
													if (!empty($story->image_name) && $story->image_name != "") {
														$images = explode(",", $story->image_name);
														foreach ($images as $key => $val) {
															if (!empty($images[$key]) && file_exists('uploads/resorts/thumbnails/150_' . $images[$key])) { ?>
																<img src="<?php echo base_url() . 'uploads/resorts/thumbnails/150_' . $images[$key]; ?>" alt="" class="img-fluid mr-2">
													<?php
															}
														}
													} ?>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
					<?php   }
					} ?>
				</div>
			</div>

		</div>
	</div>
</section>
<section id="section-gallery" class="resort_garllay">
	<div class="insta-feed">
		<div class="insta-feed-title">
			<h2>RESORT IMAGES</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="container-fluid">
			<div class="row">
				<?php
				if (!empty($Resortimages)) {
					foreach ($Resortimages as $key => $val) {
						if (!empty($Resortimages[$key]->image_name) && file_exists('uploads/resorts/thumbnails/500_' . $Resortimages[$key]->image_name)) {
				?>
							<div class="col-md-4 col-6 my-3">
								<div class="insta-feed-wrapper">
									<div class="img-container bg-success">
										<img src="<?php echo  base_url() . 'uploads/resorts/thumbnails/500_' . $Resortimages[$key]->image_name; ?>" alt="" class="img-fluid HomeImage" />
									</div>
								</div>
							</div>
				<?php
						}
					}
				}
				?>
			</div>
		</div>
	</div>
</section>

<section id="section-faqs" class="resort_fag">
	<div class="faq">
		<div class="faq-title">
			<h2>FREQUENTLY ASKED QUESTIONS</h2>
			<img src="<?php echo  FRONT_THEAM_PATH; ?>images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="accordion_container w-100">
			<?php
			if (!empty($resort_faqs)) {
				foreach ($resort_faqs as $resort_faq) {
			?>
					<div class="accordion-content">
						<div class="accordion_head"><?php echo $resort_faq->question; ?><span class="plusminus"><i class="fa fa-plus"></i></span></div>
						<div class="accordion_body" style="display: none;">
							<p><?php echo $resort_faq->answer; ?></p>
						</div>
					</div>
				<?php
				}
			} else {
				?>
				<div class="accordion-content">
					<div class="accordion_body">
						<p>No Record Found</p>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</section>
<div class="modal fade" id="Modal_SpaMenu" tabindex="-1" role="dialog" aria-labelledby="Modal_SpaMenu" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Spa Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!--<img src="" id="SpaMenuImage" alt="SpaMenuImage" style="width:100%" />-->
				
				<embed src="" id="SpaMenuImage" style="width:100%" />
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	function accommodation_form_filter() {
		$.ajax({
			url: base_url + "home/accommodation_form_filter",
			type: "POST",
			data: $("#accommodation_form_filter").serialize(),
			success: function(html) {
				$('#accommodation_result').html('');
				$('#accommodation_result').html(html);
			}
		});
	}
	function accommodation_form_filter1() {
		$.ajax({
			url: base_url + "home/accommodation_form_filter",
			type: "POST",
			data: $("#accommodation_form_filter1").serialize(),
			success: function(html) {
				$('#accommodation_result').html('');
				$('#accommodation_result').html(html);
			}
		});
	}

	function dinning_form_filter() {
		$.ajax({
			url: base_url + "home/dinning_form_filter",
			type: "POST",
			data: $("#dinning_form_filter").serialize(),
			success: function(html) {
				$('#dinning_result').html(html);
			}
		});
	}

	function dinning_form_filter1() {
		$.ajax({
			url: base_url + "home/dinning_form_filter",
			type: "POST",
			data: $("#dinning_form_filter1").serialize(),
			success: function(html) {
				$('#dinning_result').html(html);
			}
		});
	}

	function show_all_accommodation() {
		$.ajax({
			url: '<?php echo base_url(); ?>home/show_all_accommodation?resort_id=<?php echo !empty($resort->id) ? $resort->id : ''; ?>',
			type: "POST",
			data: $("#accommodation_form_filter").serialize(),
			success: function(html) {
				$('#accommodation_result').show().html(html);
				$('#show_all_accommodation').hide();
			}
		});
	}

	function show_all_dinnings() {

		$.ajax({
			url: '<?php echo base_url(); ?>home/show_all_dinnings?resort_id=<?php echo !empty($resort->id) ? $resort->id : ''; ?>',
			type: "POST",
			data: $("#dinning_form_filter").serialize(),
			success: function(html) {
				$('#dinning_result').show().html(html);
				$('#show_all_dinnings').hide();

				$('.accommodation-slider').owlCarousel({
					autoplay: false,
					autoplayTimeout: 4000,
					loop: true,
					items: 1,
					center: true,
					nav: true,
					thumbs: true,
					thumbImage: true,
					thumbsPrerendered: true,
					thumbContainerClass: 'owl-thumbs',
					thumbItemClass: 'owl-thumb-item',
					navText: ['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">', '<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
				});

			}
		});
	}
</script>
<script type="text/javascript">
	function share_socail_media(story_id, type) {
		console.log('story_id =' + story_id + 'type =' + type);
		$.ajax({
			url: '<?php echo base_url('home/share_socail_media'); ?>',
			type: 'POST',
			data: {
				'story_id': story_id,
				'socail_type': type,
				'type': 'traveller_story_share'
			},
			success: function(data) {
				$('#share_btn_menu_' + story_id).toggleClass('list-ul-show');
			}
		});
	}

	function share_resort_socail_media(story_id, type) {
		console.log('blog_id =' + story_id + 'type =' + type);
		$.ajax({
			url: '<?php echo base_url('home/share_socail_media'); ?>',
			type: 'POST',
			data: {
				'story_id': story_id,
				'socail_type': type,
				'type': 'resort_story_share'
			},
			success: function(data) {
				$('#share_btn_menu_rs_' + story_id).toggleClass('list-ul-show');
			}
		});
	}

	function resort_factsheet_details(img_name, file_type) {
		if (file_type == 'pdf') {
			$('#resort_factsheet_details_pdf').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		} else {
			$('#resort_factsheet_details_img').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		}
	}

	function resort_map_details(img_name, file_type) {
		if (file_type == 'pdf') {
			$('#resort_map_details_pdf').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		} else {
			$('#resort_map_details_img').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		}
	}

	function meal_menu(img_name, file_type, menu_title) {
		$('#meal_menu_details_title').html(menu_title);
		if (file_type == 'pdf') {
			$('#meal_menu_details_pdf').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		} else {
			$('#meal_menu_details_img').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		}
	}

	function spa_menu_details(img_name, file_type) {
		if (file_type == 'pdf') {
			$('#spa_menu_details_pdf').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		} else {
			$('#spa_menu_details_img').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/' + img_name);
		}
	}

	function save_comment(resort_story_id = '') {
		var comment = $('#comment_' + resort_story_id).val();
		var error = 'no';
		if (comment == '') {
			$('#comment_error_' + resort_story_id).show().html('The comment is required');
			var error = 'yes';
		}
		if (error == 'no') {
			$.ajax({
				url: '<?php echo base_url('home/save_comment_resort'); ?>',
				type: 'post',
				data: {
					'resort_story_id': resort_story_id,
					'comment': comment
				},
				success: function(html) {
					var response = $.parseJSON(html);
					if (response.status == 'true') {
						if (response.more_comment == 'show') {
							$('#resort_comment_more_' + resort_story_id).show();
						} else {
							$('#resort_comment_more_' + resort_story_id).hide();
						}
						$('#resort_total_comments_' + resort_story_id).val(response.total_comments);
						$('#resort_story_comments_' + resort_story_id).html(response.total_comments);
						$('#comment_' + resort_story_id).val('');
						$('#comment_error_' + resort_story_id).hide();
						$('#resort_comment_list_' + resort_story_id).html(response.html);
					} else {
						$('#comment_error_' + resort_story_id).html(response.message);
					}
				}
			});
		}
	}

	function loadResortMoreComment(resort_story_id) {
		var current_page = $('#resort_comment_pages_' + resort_story_id).val();
		var total_comments = $('#resort_total_comments_' + resort_story_id).val();
		$.ajax({
			url: '<?php echo base_url('home/loadResortMoreComment'); ?>',
			type: 'get',
			data: {
				'resort_story_id': resort_story_id,
				'current_page': current_page,
				'total_comments': total_comments
			},
			success: function(html) {
				var response = $.parseJSON(html);
				$('#resort_comment_list_' + resort_story_id).append(response.html);
				$('#resort_comment_pages_' + resort_story_id).val(response.current_page);
				if (response.more_comment == 'show') {
					$('#resort_comment_more_' + resort_story_id).show();
				} else {
					$('#resort_comment_more_' + resort_story_id).hide();
				}
			}
		});
	}

	function open_story_imgs(story_id = '') {
		$.ajax({
			url: base_url + "home/get_story_imgs?story_id=" + story_id,
			type: "GET",
			success: function(html) {
				$('#story_images_data').html(html);
			}
		});
	}

	function save_traveller_comment(story_id) {
		var comment = $('#traveller_comment_' + story_id).val();
		var error = 'no';
		if (comment == '') {
			$('#traveller_comment_error_' + story_id).show().html('The comment is required');
			var error = 'yes';
		}
		if (error == 'no') {
			$.ajax({
				url: '<?php echo base_url('home/save_comment_traveller'); ?>',
				type: 'post',
				data: {
					'story_id': story_id,
					'comment': comment
				},
				success: function(html) {
					var response = $.parseJSON(html);
					if (response.status == 'true') {
						if (response.more_comment == 'show') {
							$('#traveller_stories_comment_more_' + story_id).show();
						} else {
							$('#traveller_stories_comment_more_' + story_id).hide();
						}
						$('#traveller_stories_total_comments_' + story_id).val(response.total_comments);
						$('#traveller_stories_comments_' + story_id).html(response.total_comments);
						$('#traveller_comment_' + story_id).val('');
						$('#traveller_comment_list_' + story_id).html(response.html);
						$('#traveller_comment_error_' + story_id).hide();
					} else {
						$('#traveller_comment_error_' + story_id).html(response.message);
					}
				}
			});
		}
	}

	function loadTravellerMoreComment(story_id = '') {
		var current_page = $('#traveller_stories_comment_pages_' + story_id).val();
		var total_comments = $('#traveller_stories_total_comments_' + story_id).val();
		$.ajax({
			url: '<?php echo base_url('home/loadTravellerMoreComment'); ?>',
			type: 'get',
			data: {
				'story_id': story_id,
				'current_page': current_page,
				'total_comments': total_comments
			},
			success: function(html) {
				var response = $.parseJSON(html);
				$('#traveller_comment_list_' + story_id).append(response.html);
				$('#traveller_stories_comment_pages_' + story_id).val(response.current_page);
				if (response.more_comment == 'show') {
					$('#traveller_stories_comment_more_' + story_id).show();
				} else {
					$('#traveller_stories_comment_more_' + story_id).hide();
				}
			}
		});
	}

	function like_unlike(story_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>home/save_traveller_like_unlike',
			type: 'GET',
			data: {
				'story_id': story_id
			},
			success: function(html) {
				var response = $.parseJSON(html);
				if (response.status == 'true') {
					$('#like_unlike_btn_' + story_id).html(response.html);
				} else {
					$('#like_unlike_message_' + story_id).html(response.message);
				}
			}
		});
	}

	function viewAllExperience(total_exe) {
		for (ex_count = 1; ex_count < total_exe; ex_count++) {
			$('#experience_' + ex_count).show();
		}
		$('#viewAllExperience').hide();
	}

	function save_dinning_like_unlike(dinning_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>home/save_dinning_like_unlike',
			type: 'GET',
			data: {
				'dinning_id': dinning_id
			},
			success: function(html) {
				var response = $.parseJSON(html);
				if (response.status == 'not_login_in') {
					window.location.href = response.login_url
				} else if (response.status == 'true') {
					$('#dinning_like_unlike_btn_' + dinning_id).html(response.html);
				} else {
					$('#dinning_like_unlike_message_' + dinning_id).html(response.message);
				}
			}
		});
	}

	function read_more_story(category_id) {
		var page_next_num = $('#page_next_num_' + category_id).val();
		var page_prev_num = $('#page_prev_num_' + category_id).val();
		var total_pages = $('#total_pages_' + category_id).val();
		var resort_id = '<?php echo !empty($resort->id) ? $resort->id : ''; ?>';
		$.ajax({
			url: '<?php echo base_url(); ?>home/read_more_story',
			type: 'GET',
			data: {
				category_id: category_id,
				page_num: page_next_num,
				resort_id: resort_id
			},
			success: function(html) {
				$('#stories_category_' + category_id).show().html(html);
				page_next_num = parseInt(page_next_num) + parseInt('<?php echo PER_PAGE_COMMENTS; ?>');
				page_prev_num = parseInt(page_prev_num) + parseInt('<?php echo PER_PAGE_COMMENTS; ?>');
				$('#page_next_num_' + category_id).val(page_next_num);
				$('#page_prev_num_' + category_id).val(page_prev_num);
				$('#read_back_story_' + category_id).css({
					'display': 'block'
				});
				if (parseInt(total_pages) == parseInt(page_next_num)) {
					$('#read_more_story_' + category_id).hide();
				}
			}
		});
	}

	function read_back_story(category_id) {
		var page_next_num = $('#page_next_num_' + category_id).val();
		var page_prev_num = $('#page_prev_num_' + category_id).val();
		page_next_num = parseInt(page_next_num) - parseInt('<?php echo PER_PAGE_COMMENTS; ?>');
		page_prev_num = parseInt(page_prev_num) - parseInt('<?php echo PER_PAGE_COMMENTS; ?>');
		var resort_id = '<?php echo !empty($resort->id) ? $resort->id : ''; ?>';
		$.ajax({
			url: '<?php echo base_url(); ?>home/read_more_story',
			type: 'GET',
			data: {
				category_id: category_id,
				page_num: page_prev_num,
				resort_id: resort_id
			},
			success: function(html) {
				if (parseInt(page_prev_num) < parseInt(1)) {
					$('#read_back_story_' + category_id).hide();
				}
				$('#read_more_story_' + category_id).show();
				$('#stories_category_' + category_id).show().html(html);
				$('#page_next_num_' + category_id).val(page_next_num);
				$('#page_prev_num_' + category_id).val(page_prev_num);
			}
		});
	}

	function like_unlike_resort_story(story_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>home/save_resort_story_like_unlike',
			type: 'GET',
			data: {
				'story_id': story_id
			},
			success: function(html) {
				var response = $.parseJSON(html);
				if (response.status == 'true') {
					$('#r_like_unlike_btn_' + story_id).html(response.html);
				} else {
					$('#r_like_unlike_message_' + story_id).html(response.message);
				}
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var showChar1 = 330;
		var ellipsestext1 = "...";
		var moretext1 = "more";
		var lesstext1 = "less";
		$('.more15').each(function() {
			var content1 = $(this).html();
			if (content1.length > showChar1) {
				var c = content1.substr(0, showChar1);
				var h = content1.substr(showChar1 - 1, content1.length - showChar1);
				var html = c + '<span class="moreellipses">' + ellipsestext1 + '&nbsp;</span><span class="morecontent15"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink15">' + moretext1 + '</a></span>';

				$(this).html(html);
			}
		});
		$(".morelink15").click(function() {
			if ($(this).hasClass("less15")) {
				$(this).removeClass("less15");
				$(this).html(moretext1);
			} else {
				$(this).addClass("less15");
				$(this).html(lesstext1);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});
		var showChar20 = 330;
		var ellipsestext20 = "...";
		var moretext20 = "more";
		var lesstext20 = "less";
		$('.more20').each(function() {
			var content20 = $(this).html();
			if (content20.length > showChar20) {
				var c = content20.substr(0, showChar20);
				var h = content20.substr(showChar20 - 1, content20.length - showChar20);
				var html = c + '<span class="moreellipses">' + ellipsestext20 + '&nbsp;</span><span class="morecontent20"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink20">' + moretext20 + '</a></span>';
				$(this).html(html);
			}
		});
		$(".morelink20").click(function() {
			if ($(this).hasClass("less20")) {
				$(this).removeClass("less20");
				$(this).html(moretext1);
			} else {
				$(this).addClass("less20");
				$(this).html(lesstext1);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});

		var showCharaboutresort = 600;
		var ellipsestext3 = "...";
		var moretext3 = "more";
		var lesstext3 = "less";


		$('.about-resort-more').each(function() {
			var content = $(this).html();
			if (content.length > showCharaboutresort) {

				var c = content.substr(0, showCharaboutresort);
				var h = content.substr(showCharaboutresort, content.length - showCharaboutresort);

				var html = c + '<span class="moreellipses">' + ellipsestext3 + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext3 + '</a></span>';

				$(this).html(html);
			}

		});

	});
</script>
<script>
	$(document).ready(function() { //accommodations_likes
		<?php
		if ($this->input->get('type') && $this->input->get('type') == 'reviews') { ?>
			setTimeout(function() {
				var stories_height = parseInt($("#stories").offset().top) - parseInt(180);
				$('html, body').animate({
					scrollTop: stories_height
				}, 1000)
			}, 1500);
		<?php
		}
		if ($this->input->get('type') && $this->input->get('type') == 'traveller_story_comment') { ?>
			setTimeout(function() {
				var stories_height = parseInt($("#stories").offset().top) - parseInt(180);
				$('html, body').animate({
					scrollTop: stories_height
				}, 1000)
			}, 1500);
		<?php
		}
		if ($this->input->get('type') && $this->input->get('type') == 'resort_story_comment') { ?>
			setTimeout(function() {
				var stories_height_n = parseInt($("#Resort_Stories_list").offset().top) - parseInt(180);
				$('html, body').animate({
					scrollTop: stories_height_n
				}, 1000)
			}, 1500);
		<?php
		}
		if ($this->input->get('type') && $this->input->get('type') == 'accommodations_likes') { ?>
			setTimeout(function() {
				var stories_height = parseInt($("#villas-suites").offset().top) - parseInt(180);
				$('html, body').animate({
					scrollTop: stories_height
				}, 1000)
			}, 1500);
		<?php }
		if ($this->input->get('type') && $this->input->get('type') == 'dinnings') { ?>
			setTimeout(function() {
				var stories_height = parseInt($("#dine-wine").offset().top) - parseInt(180);
				$('html, body').animate({
					scrollTop: stories_height
				}, 1000)
			}, 1500);
		<?php } ?>
	}); //traveller_stories_
	function open_traveller_stories_images(counter = '', max_counter = '', image_path = '', story_id = '') {
		$('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>' + image_path);
		$('#traveller_stories_images').show();
		$('#current_traveller_img').val(counter);
		$('#current_traveller_max').val(max_counter);
		$('#current_traveller_story_id').val(story_id);
		if (parseInt(counter) == parseInt(1)) {
			$('.left_traveller_storie').hide();
		} else {
			$('.left_traveller_storie').show();
		}
		if (parseInt(max_counter) == parseInt(counter)) {
			$('.right_traveller_stories').hide();
		} else {
			$('.right_traveller_stories').show();
		}
	}

	function left_traveller_stories() {
		var counter = parseInt($('#current_traveller_img').val()) - parseInt(1);
		var max_counter = $('#current_traveller_max').val();
		if (parseInt(counter) == parseInt(1)) {
			$('.left_traveller_storie').hide();
		} else {
			$('.left_traveller_storie').show();
		}
		if (parseInt(max_counter) == parseInt(counter)) {
			$('.right_traveller_stories').hide();
		} else {
			$('.right_traveller_stories').show();
		}
		var current_traveller_story_id = $('#current_traveller_story_id').val();
		var image_path = $('#traveller_stories_' + current_traveller_story_id + '_' + counter).attr('data-image');
		$('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>' + image_path);
		$('#current_traveller_img').val(counter);
	}

	function right_traveller_stories() {
		var counter = parseInt($('#current_traveller_img').val()) + parseInt(1);
		var max_counter = $('#current_traveller_max').val();
		if (parseInt(max_counter) == parseInt(counter)) {
			$('.right_traveller_stories').hide();
		} else {
			$('.right_traveller_stories').show();
		}
		if (parseInt(counter) == parseInt(1)) {
			$('.left_traveller_storie').hide();
		} else {
			$('.left_traveller_storie').show();
		}
		var current_traveller_story_id = $('#current_traveller_story_id').val();
		var image_path = $('#traveller_stories_' + current_traveller_story_id + '_' + counter).attr('data-image');
		$('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>' + image_path);
		$('#current_traveller_img').val(counter);
	}

	function go_to_traveller_stories() {
		$('#stories').show();
		$('#story_tb2').hide();
	}

	function go_to_hotel_stories() {
		$('#stories').hide();
		$('#story_tb2').show();
	}

	function save_exprince_like_unlike(exprience_id) {
		$.ajax({
			url: '<?php echo base_url(); ?>home/save_exprince_like_unlike',
			type: 'GET',
			data: {
				'exprience_id': exprience_id
			},
			success: function(html) {
				var response = $.parseJSON(html);
				if (response.status == 'not_login_in') {
					window.location.href = response.login_url
				} else if (response.status == 'true') {
					$('#experince_like_unlike_btn_' + exprience_id).html(response.html);
				} else {
					$('#exprience_like_unlike_message_' + exprience_id).html(response.message);
				}
			}
		});
	}
	// append exp filter 
	$(':checkbox[name=test]').on('change', function() {
		var assignedTo = $(':checkbox[name=test]:checked').map(function() {
				return this.value;
			})
			.get();
		var resort_id = "<?php echo $resort_id; ?>";
		var category_id = assignedTo.toString();
		$.ajax({
			url: '<?php echo base_url(); ?>home/experinces_filterhtml',
			type: 'GET',
			data: {
				'resort_id': resort_id,
				'category_id': category_id
			},
			success: function(html) {
				$('#experience_html_append').html(html);
				$('.inspiration-slider').owlCarousel({
					stagePadding: 20,
					margin: 10,
					nav: true,
					navText: ['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">', '<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
					responsive: {
						0: {
							items: 1
						},
						768: {
							items: 2
						},
						1000: {
							items: 3
						}
					}
				})
			}
		});
	});
	$(document).ready(function() {
		$('.SpaMenuLink').on('click', function() {
			$('#SpaMenuImage').attr('src', $(this).attr('myurl'));
			$('#Modal_SpaMenu').modal('show');
		});
		var resort_id = "<?php echo $resort_id; ?>";
		var category_id = '';
		$.ajax({
			url: '<?php echo base_url(); ?>home/experinces_filterhtml',
			type: 'GET',
			data: {
				'resort_id': resort_id,
				'category_id': category_id
			},
			success: function(html) {
				$('#experience_html_append').html(html);
				$('.inspiration-slider').owlCarousel({
					stagePadding: 20,
					margin: 10,
					nav: true,
					navText: ['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">', '<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
					responsive: {
						0: {
							items: 1
						},
						768: {
							items: 2
						},
						1000: {
							items: 3
						}
					}
				})
			}
		});
	})

	function save_accommodation_like_unlike(accommodation_id) {
		$.ajax({

			url: '<?php echo base_url(); ?>home/save_accommodation_like_unlike',

			type: 'GET',

			data: {
				'accommodation_id': accommodation_id
			},

			success: function(html) {

				var response = $.parseJSON(html);

				if (response.status == 'not_login_in') {

					window.location.href = response.login_url

				} else if (response.status == 'true') {
					$('#accommodation_like_unlike_btn_' + accommodation_id).html(response.html);
				} else {

					$('#accommodation_like_unlike_message_' + accommodation_id).html(response.message);

				}

			}

		});

	}
	
    $('.inspiration-readmore1').find('.card-read-more1').on('click', function (e) {
        e.preventDefault();
        //alert("Clicked");
        this.expand = !this.expand;
        console.log(this.expand);
        $('.card-read-more1').text(this.expand?"Hide Content":"Read More awrwer");
        $('.inspiration-readmore1').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
    
	 $('.inspiration-readmore').find('.card-read-more').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more').text(this.expand?"Hide Content":"Read More");
        $('.inspiration-readmore').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
	
    $('.inspiration-readmore2').find('.card-read-more2').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more2').text(this.expand?"Hide Content":"Read more");
        $('.inspiration-readmore2').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
  
 
</script>
<script>
    var desc = document.getElementById("new_text"),
        descImg = document.getElementById("new_images"),
        descHeight = desc.offsetHeight;
        //console.log("height - "+descHeight);
        descImg.style.height = descHeight+'px';
</script>

<script>
    var desc1 = document.getElementById("new_text_new"),
        descImg1 = document.getElementById("new_images_new"),
        descHeight1 = desc1.offsetHeight;
        //console.log("height - "+descHeight);
        descImg1.style.height = descHeight1+'px';
</script>
<script>
    function resort_experience_filter_more(){
        $('.experince_offset').val(parseInt($('.experince_offset').val())+3);
         $.ajax({ 
            url:base_url+"home/resort_experience_filter_more",
            type:"POST",
            data:{
              resort_id :$('#resort_id').val(),
              offset :$('.experince_offset').val(),
              limit :$('#experince_limit').val()
            },
   		  dataType:'json',   
            success: function(data){
   			 $("#resort_experience_result").append(data.final_output);
   			 console.log($('.experince_offset').val());
   			 console.log($('#experince_count').val());
   			 if($('.experince_offset').val() > $('#experince_count').val()){
   			     $('.exp_discover_more').hide();
   			 }
            }                
         }); 
       }
</script>
<script src="<?php echo  FRONT_THEAM_PATH; ?>js/owl.carousel.min.js"></script>
<script src="<?php echo  FRONT_THEAM_PATH; ?>js/owl-thumb.js"></script>