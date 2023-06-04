
<section>
		<div class="maldives-header-banner">
			<div class="maldives-inner-slider owl-carousel owl-theme">
			<?php 
				if(!empty($caption_imgs)) {
				foreach($caption_imgs as $caption_img){ 
				if(file_exists('uploads/caption/'.$caption_img->image_name)){
					?>
				<div class="box" style="background-image:url('<?php echo base_url('uploads/caption/' . $caption_img->image_name); ?>')">
					<div class="maldives-header-title">
						<h1><?php echo $caption->caption_title;?>...</h1>
						<h2><span><?php echo ucwords(str_replace("-"," <br>",$caption->caption_sub_title));?></span></h2>
						<!--<h2><span><?php //echo strtoupper(str_replace("-"," <br>",$caption->caption_sub_title));?></span></h2>-->
						
					</div>
				</div>
			<?php   } } }?>

			</div>
		</div>
	</section>
	<section>
	<div class="container">
	    	<div class="about blog_news py-lg-4">
			<div class="about-title">
				<h2>MALDIVES</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
		</div>
		<div class="about-maldives">
            <div class="About container">
                         
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3 new_maldivs_pages">
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle264.png" alt="Rectangle264.png" id="maldives-img" class="img-fluid" />
                    </div>
                    <div class="col-lg-6 col-md-12 new_maldivs_pages">
                        <div class="about-maldives-description">
                            <!--<div class="about-maldives-description-title">-->
                                <h4>ABOUT MALDIVES</h4>
                            <!--</div>-->
                            <!--<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">-->
                            <div class="about-maldives-description-text">
								<span class="moremobile">The Maldives is a nation of islands in the Indian Ocean, that spans across the equator. The country is comprised of 1192 islands that stretch along a length of 871 kilometers. While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land. The islands are grouped into a double chain of 26 atolls. The Maldives is a nation of islands in the Indian Ocean, that spans across the equator. The country is comprised of 1192 islands that stretch along a length of 871 kilometers. While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land. The islands are grouped into a double chain of 26 atolls. While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land. The islands are grouped into a double chain of 26 atolls.While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land. While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land. The islands are grouped into a double chain of 26 atolls.While the country covers an area of approximately 90,000 square kilometers, only 298 square kilometers of that is dry land.</span>
                            </div>
							<br>
							
                        </div>
                    </div>
                    <div class="quickfacts-title text-center col-lg-12">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#maldives_map" class="review-btn btn">View Map</a>
                    </div>
                </div>
            </div>
        </div>
	</div>
	</section>
    <section class="quick-facts-section p-lg-1">
        <div class="container">
                    <div class="about blog_news py-lg-4">
            <div class="about-title">
                <h2>Quick Facts</h2>
                <img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
            </div>
        </div>
        <div class="quick-facts">
            <div class="Quick Facts container">
                <div class="row mt-lg-4 mt-md-4">
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title"> Location</div>
                                <div class="quickfacts-text"><?php echo !empty($row->location)?$row->location:''; ?> </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-building-o" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Capital City</div>
                                <div class="quickfacts-text"><?php echo !empty($row->capital)?$row->capital:''; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                         <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Population</div>
                                <div class="quickfacts-text"><?php echo !empty($row->population)?$row->population:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="row mt-lg-4 mt-md-4">
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-money" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Currency</div>
                                <div class="quickfacts-text"><?php echo !empty($row->currency)?$row->currency:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-flag" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Independence day</div>
                                <div class="quickfacts-text"><?php echo !empty($row->independence)?$row->independence:''; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-phone-square" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Calling Code</div>
                                <div class="quickfacts-text"><?php echo !empty($row->calling_code)?$row->calling_code:''; ?></div>
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
                <div class="row mt-lg-4 mt-md-4">
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-language" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Official Language</div>
                                <div class="quickfacts-text"><?php echo !empty($row->official_language)?$row->official_language:''; ?></div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Local Time</div>
                                <div class="quickfacts-text"><?php echo !empty($row->local_time)?$row->local_time:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-university" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Government</div>
                                <div class="quickfacts-text"><?php echo !empty($row->government)?$row->government:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
                <div class="row mt-lg-4 mt-md-4">
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-window-minimize" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Religion</div>
                                <div class="quickfacts-text">100% Sunni Muslims</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-2 col-md-6 col-sm-6">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-bolt" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">Electricity</div>
                                <div class="quickfacts-text"><?php echo !empty($row->electricity)?$row->electricity:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                </div> 
                <div class="row mt-lg-4 mt-md-4">
                    <div class="col-lg-6 mb-2 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-2 quickfacts_icon globe">
                                <i class="fa fa-globe" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10 pl-lg-0">
                                <div class="quickfacts-title">Geography</div>
                                <div class="quickfacts-text"><?php echo !empty($row->geography)?$row->geography:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 mb-2 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-2 quickfacts_icon">
                                <i class="fa fa-industry" aria-hidden="true"></i>
                            </div>    
                            <div class="col-10">
                                <div class="quickfacts-title">The largest industry</div>
                                <div class="quickfacts-text"><?php echo !empty($row->largest_industry)?$row->largest_industry:''; ?></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="about_arrival">
		<div class="container">
		    <div class="about-maldives">
            <!--<div class="container-fluid">-->
                    <div class="about blog_news py-lg-4">
                        <div class="about-title pb-lg-4">
                             <h2><?php echo $arrival_immigration->title;?></h2>
                            <img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
                        </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-3 new_maldivs_pages">
                         <div class="about-maldives-description">
                            <!--<div class="about-maldives-description-title">-->
                               
                            <!--</div>-->
                            
                            <div class="about-maldives-description-text">
                                <p><?php echo $arrival_immigration->description;?> 
								</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-6 col-md-12 new_maldivs_pages">
                       <img src="<?php echo  FRONT_THEAM_PATH ;?>images/MaskGroup13.png" alt="MaskGroup13.png" class="img-fluid arrival-image w-100" />
                    </div>
                </div>
            <!--</div>-->
        </div>
		</div>
	</section>
    <section class="travel_maldives" >
        <div class="container">
            		<div class="py-2">
			<div class="inspiration about-extra">
				<div class="inspiration-title">
					<h2>HOW TO TRAVEL WITHIN MALDIVES</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="inspiration-slider owl-carousel owl-theme mt-5">
					<?php 
						if(!empty($airports)){
               				foreach($airports as $airport){ ?>
					<div class="box">
						<div class="img-content">
							<?php
								if(!empty($airport->image_name)&&file_exists('uploads/airport_type/'.$airport->image_name)){?>
									<img src="<?php echo  base_url().'uploads/airport_type/'.$airport->image_name ;?>" class="img-fluid HomeImage" alt="Travel Maldives">
								<?php 
								}else{?>
									<img src="<?php echo  FRONT_THEAM_PATH ;?>images/speedboat.png" class="img-fluid HomeImage" alt="Travel Maldives">
								<?php 
								} 
							?>
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title"><?php echo !empty($airport->airport_type_name)?$airport->airport_type_name:''; ?></div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
								<?php echo !empty($airport->tag)?$airport->tag:''; ?>
                                </span>
                            </div>
                            <div class="card-read-more-container">
                				<a href="#" class="card-read-more btn">Read More</a>
                		    </div>
                        </div>
					</div>
					<?php }
						} ?>
				</div>
			</div>
		</div>
        </div>
	</section>
	<section class="important_information" style="background:#f8f9fa; width:100%;">
	<div class="container">
	    	<div class="about bg-light py-lg-5">
			<div class="about-title">
				<h2>IMPORTANT INFORMATION TO KNOW</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
			<div class="about-description">
				<span class="more">
					Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
				</span>
			</div>
			<?php 
		   $wear_array = array();
		   if($what_to_wear->image1!=''){
			$wear_array[]= $what_to_wear->image1;
		   } 
		   if($what_to_wear->image2!=''){
			$wear_array[]= $what_to_wear->image2;
		   } if($what_to_wear->image3!=''){
			$wear_array[]= $what_to_wear->image3;
		   } if($what_to_wear->image4!=''){
			$wear_array[]= $what_to_wear->image4;
		   } if($what_to_wear->image5!=''){
			$wear_array[]= $what_to_wear->image5;
		   }
		?>
			<div class="about-slider owl-carousel owl-theme mt-5">
				<div class="box mb-1">
					<img src="<?php echo  base_url() ;?>uploads/maldives/what_to_wear/<?php echo $wear_array[0]; ?>" alt="group-senior-friends-enjoying-their-day-beach.png`" class="img-fluid HomeImage">
					<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
						<div class="about-slider-bottom-description smalldesc">
							<div class="about-slider-bottom-description-title d-flex mb-2">
								<div class="about-slider-bottom-description-title1"><?php echo $what_to_wear->title;?></div>
							</div>
							<span class="">
								<?php echo strip_tags($what_to_wear->description);?>
							</span>
						</div>
							<div class="card-read-more-container">
                					<a href="#" class="card-read-more btn">Read More</a>
                		</div>
					</div>
				</div>
				<?php 
		   $localenv_array = array();
		   if($local_environment->image1!=''){
			$localenv_array[]= $local_environment->image1;
		   } 
		   if($local_environment->image2!=''){
			$localenv_array[]= $local_environment->image2;
		   } if($local_environment->image3!=''){
			$localenv_array[]= $local_environment->image3;
		   } if($local_environment->image4!=''){
			$localenv_array[]= $local_environment->image4;
		   } if($local_environment->image5!=''){
			$localenv_array[]= $local_environment->image5;
		   }
		?>
				<div class="box mb-1">
					<img src="<?php echo  base_url() ;?>uploads/maldives/local_environment/<?php echo $localenv_array[0]; ?>" alt="group-senior-friends-enjoying-their-day-beach.png`" class="img-fluid HomeImage">
					<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
						<div class="about-slider-bottom-description smalldesc">
							<div class="about-slider-bottom-description-title d-flex mb-2">
								<div class="about-slider-bottom-description-title1"><?php echo $local_environment->title;?></div>
							</div>
							<span class="">
								<?php echo strip_tags($local_environment->description);?>
							</span>
						</div>
						<div class="card-read-more-container">
                					<a href="#" class="card-read-more btn">Read More</a>
                		</div>
					</div>
				</div>
				<?php 
		   $people_array = array();
		   if($maldives_people->image1!=''){
			$people_array[]= $maldives_people->image1;
		   } 
		   if($maldives_people->image2!=''){
			$people_array[]= $maldives_people->image2;
		   } if($maldives_people->image3!=''){
			$people_array[]= $maldives_people->image3;
		   } if($maldives_people->image4!=''){
			$people_array[]= $maldives_people->image4;
		   } if($maldives_people->image5!=''){
			$people_array[]= $maldives_people->image5;
		   }
		?>
				<div class="box mb-1">
					<img src="<?php echo  base_url() ;?>uploads/maldives/maldives_people/<?php echo $people_array[0]; ?>" alt="group-senior-friends-enjoying-their-day-beach.png`" class="img-fluid HomeImage">
					<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
						<div class="about-slider-bottom-description smalldesc">
							<div class="about-slider-bottom-description-title d-flex mb-2">
								<div class="about-slider-bottom-description-title1"><?php echo $maldives_people->title;?></div>
							</div>
							<span class="">
								<?php 
									echo strip_tags($maldives_people->description);
								?>
							</span>
						</div>
						<div class="card-read-more-container">
                				<a href="#" class="card-read-more btn">Read More</a>
                		</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	<section>
	    <div class="container">
	        		<div class="py-lg-2">
			<div class="inspiration about-extra">
				<div class="inspiration-title">
					<h2>TOP DIVING SPOTS</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="inspiration-description">
					<span class="more">
						Maldives Experts is a one stop travel platform for clients and travel agents to find best matching
						holiday for themselves or for their clients. We are not a travel agency or a booking engine. Maldives
						Experts is a one stop travel platform for clients and travel agents to find best matching holiday for
						themselves or for their We are not a travel agency or a booking engine.
					</span>
				</div>
				<div class="inspiration-slider owl-carousel owl-theme mt-5">
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi1.png" alt="Rectangle92.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                									<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi2.png" alt="Rectangle93.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                             <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi3.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                            
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi4.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                				<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi5.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/divi6.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
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
	</section>
    <section class="last_sections">
		<div class="container">
		    <div class="py-2">
			<div class="inspiration about-extra">
				<div class="inspiration-title">
					<h2>TOP SURFING SPOTS</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="inspiration-description">
					<span class="more">
						Maldives Experts is a one stop travel platform for clients and travel agents to find best matching
						holiday for themselves or for their clients. We are not a travel agency or a booking engine. Maldives
						Experts is a one stop travel platform for clients and travel agents to find best matching holiday for
						themselves or for their We are not a travel agency or a booking engine.
					</span>
				</div>
				<div class="inspiration-slider owl-carousel owl-theme mt-5">
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing1.png" alt="Rectangle92.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing2.png" alt="Rectangle93.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing3.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing4.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing5.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
                            </div>
                            <div class="card-read-more-container">
                						<a href="#" class="card-read-more btn">Read More</a>
                			</div>
                        </div>
					</div>
					<div class="box">
						<div class="img-content">
							<img src="<?php echo  FRONT_THEAM_PATH ;?>images/surfing6.png" alt="Rectangle97.png" class="img-fluid HomeImage">
							<div class="image-text-container">
								<div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title">Cocoa South Corner</div>
										<div>
											<span class="description ml-1">South Male</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
                            <div class="about-slider-bottom-description smalldesc">
                                <span class="">
                                    LoAt around 300m/985ft long, this submerged island sitting around 12m/40ft under the surface may take you a couple of trips to fully explore. Most dive centres.
                                </span>
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
	</section>
	<div class="modal fade" id="maldives_map" tabindex="-1" role="dialog" aria-labelledby="maldives_map" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Maldives Map</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
						if(!empty($row->map_img)&&file_exists('uploads/maldives/'.$row->map_img)){?>
							<img src="<?php echo  base_url().'uploads/maldives/'.$row->map_img ;?>" alt="maldives-map" style="width:100%" />
						<?php
					}else{?>
						<img src="<?php echo  FRONT_THEAM_PATH ;?>images/maldives-map.png" alt="maldives-map"  style="width:100%" />
					<?php }?>

				</div>
			</div>
		</div>
	</div>
	
<script type="text/javascript">
   function calculate_distance1(){
      var resort_first  = $('#resort_first').val(); 
      var resort_second = $('#resort_second').val();
      $.ajax({ 
         url:base_url+"home/calculate_distance",
         type:"POST",
         data:{resort_first:resort_first,resort_second:resort_second, type:1}, 
         success: function(html){
            var response = $.parseJSON(html);  
            $('#Seaplan_Distance').html(response.seaplan);
            $('#Speed_Boat_Distance').html(response.speed_boat);
            $('#distance_result').html(response.distance);
            $('#resort_second').html(response.other_resort);
         }                
      });
   }
   function calculate_distance2(){
      var resort_first  = $('#resort_first').val(); 
      var resort_second = $('#resort_second').val();
      $.ajax({ 
         url:base_url+"home/calculate_distance",
         type:"POST",
         data:{resort_first:resort_first,resort_second:resort_second, type:2}, 
         success: function(html){
            var response = $.parseJSON(html);  
            $('#Seaplan_Distance').html(response.seaplan);
            $('#Speed_Boat_Distance').html(response.speed_boat);
            $('#distance_result').html(response.distance);
            $('#resort_first').html(response.other_resort);
         }                
      });
   }
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>