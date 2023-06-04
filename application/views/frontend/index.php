
<style>
/*scroll sections*/
section#scroll-tabs .tabs {
    display: flex;
    justify-content: center;
    width: 100%;
}
#scroll-tabs .warpper{
  display:flex;
  flex-direction: column;
  align-items: center;
  padding-top:50px;
}
#scroll-tabs .tab{
  cursor: pointer;
  padding:10px 20px;
  margin:0px 90px;
  display:inline-block;
  color:#444;
  font-weight:400;
}


#scroll-tabs .warpper .scroll-tab{
    color:#444;
    font-size:20px;
}

/*=====villas css
========*/
section#villas-types {
    padding-bottom: 40px;
    padding-top: 10px;
}
section#villas-types .compare-hotel-container .villas-pill {
    display: flex;
    justify-content: flex-start;
}
section#villas-types .compare-hotel-container select#villa_rooms{
    background: #dce3ef;
    border-radius: 50px;
    font-weight:700;
    width:10rem;
}
section#villas-types .compare-hotel-container select{
    border:none !important;
    text-align:center;
}
section#villas-types .compare-hotel-container select#select_villa_1,
select#select_villa_2, 
select#select_villa_3 {
    background:#dce3ef;
    border-radius: 50px;
    text-transform: uppercase;
    font-weight: 600;
     text-align:center;
}
section#villas-types .compare-hotel-container label.btn.expbutton {
    color: #444;
    border: none;
    background:transparent;
}
section#villas-types .compare-hotel-container label.btn.expbutton:hover {
    text-decoration: underline;
}
section#villas-types .compare-hotel-container label.btn.expbutton{
        box-shadow: 0px 0px 0px #7682b72e;
        text-transform: uppercase;
        font-weight:700;
}
section#villas-types .compare-hotel-container .badgebox:checked + span{
    background:#2ec4bb;
    border-radius:50px;
}
section#villas-types .compare-hotel-container .badgebox:checked + span:hover{
    text-decoration:none;
}
/*.compare-hotel-container label.btn.expbutton:nth-child(3){*/
/*   display:none;*/
/*}*/
/*.compare-hotel-container label.btn.expbutton:nth-child(4){*/
/*   display:none;*/
/*}*/
section#villas-types .compare-hotel-container .resort-category-name.resort-star {
    margin-left: 0 !important;
    display:inline-block;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(1){
    order:1;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(2){
    order:2;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(3){
    order:3;
    display:none
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(4){
    order:6;
        display:none
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(5){
    order:7;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(6){
    order:4;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(7){
    order:6;
}
section#villas-types .compare-hotel-container .compare-hotel-title {
    background: #fff;
}
@media screen and (max-width: 768px){
    section#nav-tabs .navTab-wrapper{
        flex-direction:column;
        width:100%;
    }
    section#villas-types .compare-hotel-container label.btn.expbutton{
        margin:5px;
    }
   section#villas-types .compare-hotel-container .HomeImage{
        height: 100px;
        max-width: 100px;
        object-fit: cover;
  }
   #scroll-tabs .tab{
       margin:0px 0px;
       padding:10px 10px;
   }
   #scroll-tabs .tab-content>.tab-pane{
       padding-top:0;
   }
  .compare-hotel-container .compare-hotel-title{
      padding:0;
  }
   #resort-filter .HomeImage{
       height:100px;
   }
}
</style>
<section class="new_home_slider ">
    
    <div class="accommodation-slider  owl-carousel owl-theme">
        <?php 
if(!empty($caption_imgs)) {
foreach($caption_imgs as $caption_img) {
	$bannerImaage = $caption_img->image_name;
?>
        <div class="item">
            <div class="header-banner" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage); ?>')">
    			<div class="header-title">
    				<h1><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?></h1>
    				<h2><?php if(!empty($caption->caption_title)) { echo ucwords($caption->caption_title, " "); } ?>
    				    <?php //echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>
    				<button type="button" class="btn header-search-btn">
    					<span id="mySeachButton">
    						<span><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Search.png" alt="Search.png" class="img-fluid mr-3" /></span>
    						Where would you like to go
    					</span>
    					<span id="divmySeachTextBox" style="display: none;">
    						<form action="<?php echo base_url();?>resorts">
    							<input type="text"  id="mySeachTextBox" name="search" placeholder="Search resort name...">
    						</form>
    					</span>
    				</button>
    				
    			</div>
    			<!--<div class="social-icon-container">-->
    			<!--	<div class="social-icon">-->
    			<!--		<a href="#">-->
    			<!--			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/facebook.png" alt="facebook.png" class="img-fluid">-->
    			<!--		</a>-->
    			<!--	</div>-->
    			<!--	<div class="social-icon">-->
    			<!--		<a href="#">-->
    			<!--			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/twitter.png" alt="twitter.png" class="img-fluid">-->
    			<!--		</a>-->
    			<!--	</div>-->
    			<!--	<div class="social-icon">-->
    			<!--		<a href="#">-->
    			<!--			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">-->
    			<!--		</a>-->
    			<!--	</div>-->
    			<!--	<div class="social-icon">-->
    			<!--		<a href="#">-->
    			<!--			<img src="<?php echo  FRONT_THEAM_PATH ;?>images/linkedin.png" alt="linkedin.png" class="img-fluid">-->
    			<!--		</a>-->
    			<!--	</div>-->
    			<!--</div>-->
    		</div>
        </div>
        <?php
}
}
?>
        
      <!--  <div class="item">-->
      <!--    <div class="header-banner" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage); ?>')">-->
    		<!--	<div class="header-title">-->
    		<!--		<h1><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?></h1>-->
    		<!--		<h2><?php echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>-->
    				
    		<!--	</div>-->
    			
    		<!--</div>-->
      <!--  </div>-->
      <!--  <div class="item">-->
      <!--     <div class="header-banner" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage); ?>')">-->
    		<!--	<div class="header-title">-->
    		<!--		<h1><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?></h1>-->
    		<!--		<h2><?php echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>-->
    				
    				
    		<!--	</div>-->
    		
    		<!--</div>-->
      <!--  </div>-->
      
        </div>
   
    
    
		
	</section>


 <!-- <section class="section-link">-->
	<!--	<div class="container">-->
	<!--		<div class="section-link-scroll owl-carousel">-->
	<!--			<div class="box">-->
	<!--				<div>-->
	<!--					<a href="#inspirations-section" class="section-link-title">Inspirations</a>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="box">-->
	<!--				<div>-->
	<!--					<a href="#blog-news-section" class="section-link-title">Blogs & News</a>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="box">-->
	<!--				<div>-->
	<!--					<a href="#insta-feed-section" class="section-link-title">Insta Feed</a>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="box">-->
	<!--				<div>-->
	<!--					<a href="#guest-reviews-section" class="section-link-title">Guest Reviews</a>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--			<div class="box">-->
	<!--				<div>-->
	<!--					<a href="#faq-section" class="section-link-title">Faqs</a>-->
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</section>-->

  <section class="about_home">
		<div class="about py-5">
			<div class="about-title">
				<h2>ABOUT US</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
			<div class="about-description">
				<span class="about-more">
					Maldives Experts is a one stop travel platform for clients and travel agents to find best matching
					holiday for themselves or for their clients. We are not a travel agency or a booking engine.
					Maldives
					Experts is a one stop travel platform for clients and travel agents to find best matching holiday
					for
					themselves or for their We are not a travel agency or a booking engine.
					
				</span>
			</div>

			<!--<div class="about-slider owl-carousel owl-theme">-->
			<!--	<div class="box">-->
			<!--		<img src="<?php echo  FRONT_THEAM_PATH ;?>images/MaskGroup26.png" alt="MaskGroup26.png" class="img-fluid">-->
			<!--	</div>-->
			<!--	<div class="box">-->
			<!--		<img src="<?php echo  FRONT_THEAM_PATH ;?>images/MaskGroup26.png" alt="MaskGroup26.png" class="img-fluid">-->
			<!--	</div>-->
			<!--	<div class="box">-->
			<!--		<img src="<?php echo  FRONT_THEAM_PATH ;?>images/MaskGroup26.png" alt="MaskGroup26.png" class="img-fluid">-->
			<!--	</div>-->
			<!--</div>-->
		</div>
	</section>
 <!-- <section id="inspirations-section">-->
	<!--	<div class="bg-light py-2">-->
	<!--		<div class="inspiration">-->
	<!--			<div class="inspiration-title">-->
	<!--				<h2>INSPIRATIONS</h2>-->
	<!--				<img src="<?php //echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">-->
	<!--			</div>-->
	<!--			<div class="inspiration-description">-->
	<!--				<span class="more">-->
	<!--					<?php //echo ucfirst(strip_tags($mal_insipiration->description));?>-->
	<!--				</span>-->
	<!--			</div>-->
	<!--			<ul class="nav nav-tabs mx-auto" id="inspiration-tab" role="tablist">-->
	<!--				<li class="nav-item" role="presentation">-->
	<!--					<a class="nav-link  active" id="resort-tab" data-toggle="tab" href="#resort" role="tab"-->
	<!--						aria-controls="resort" aria-selected="true">Resorts</a>-->
	<!--				</li>-->
	<!--				<li class="nav-item" role="presentation">-->
	<!--					<a class="nav-link" id="villa-resorts-tab" data-toggle="tab" href="#villa-resorts" role="tab"-->
	<!--						aria-controls="villa-resorts" aria-selected="false">Villa & Suites</a>-->
	<!--				</li>-->
	<!--				<li class="nav-item" role="presentation">-->
	<!--					<a class="nav-link" id="experiences-tab" data-toggle="tab" href="#experiences" role="tab"-->
	<!--						aria-controls="experiences" aria-selected="false">Experiences</a>-->
	<!--				</li>-->
	<!--			</ul>-->
	<!--			<div class="tab-content" id="myTabContent">-->
	<!--				<div class="tab-pane fade show active pt-5" id="resort" role="tabpanel"-->
	<!--					aria-labelledby="resort-tab">-->
						
	<!--				</div>-->
	<!--				<div class="tab-pane fade pt-5" id="villa-resorts" role="tabpanel" aria-labelledby="villa-resorts-tab">-->
						
	<!--				</div>-->
	<!--				<div class="tab-pane fade" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">-->
						
	<!--				</div>-->
	<!--			</div>-->
	<!--		</div>-->
	<!--	</div>-->
	<!--</section>-->
	<section class="featured_resorts_all Destop_resorts" >
	   <div class="container">
	        <div class="featured_resorts" style="text-align:center;">
				<h2>FEATURED RESORTS</h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	            <div class="row">
							<?php 
								if(!empty($resorts)){
									foreach ($resorts as $resort) {
									    //echo "<pre>"; var_dump($resort);
										$resportAmenities = !empty($resort->amenities)?explode(',', $resort->amenities):'';
										$international_airports = $this->developer_model->user_international_airports($resort->id); 
										$images = $this->common_model->get_result('images', array('item_id'=>$resort->id, 'type'=>'resort')); 
										//print_r($images[0]->image_name);
										if(!empty($images[0]->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$images[0]->image_name)) {
											$ImagePath = base_url().'uploads/resorts/thumbnails/500_'.$images[0]->image_name;
										} else {
											$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic1.jpg';
										}
										$category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));
										?>
										<div class="col-lg-4 mb-lg-4">
											<div class="box">
												<div class="img-content">
													<img src="<?php echo  $ImagePath;?>" alt="Resort" class="img-fluid HomeImage">
													
												</div>
												<div class="img-bottom-contianer inspiration-readmore accommodation-villa">
													<div class="image-text-container">
														<!--<div class="d-flex justify-content-between">-->
														<div class="d-flex">    
															<div class="img-content-title-container">
																<div class="img-content-title">
																	<a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($resort->id)); ?>">
																		<?php echo !empty($resort->resort_name)?character_limiter(ucfirst($resort->resort_name)):'';?>
																	</a>
																</div>
																<div class="d-flex">
																	<?php 
																		for($i=0;$i< $category->no_of_star;$i++){ 
																			?>
																				<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																			<?php 
																		} 
																	?>
																	<span class="description ml-0"><?php echo $category->category_name;?></span>
																</div>
																<div class="hotel-inner-profile-name">
																    <?php $state_name = $this->developer_model->resort_detail($resort->id); ?>
                                    								<?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?>
                                    							</div>
															</div>
															<div class="reviews-rating d-flex">
																<?php 
																	$avg_rates = get_rating($resort->id);
																?>
																<div class="reviews-circle"><?php echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; ?></div>
																<div class="reviews-text ml-1"><?php if(!empty($resort->total_reviews)) { echo $resort->total_reviews.' Reviews'; } ?> </div>
															</div>
														</div>
													</div>
													<br>
													<div class="img-bottom-contianer-description smalldesc">
														<span class="small_description new_resort_new_pra">
															<?php echo !empty($resort->resort_description)?character_limiter($resort->resort_description):'';?>
														</span>
														<?php 
															if(!empty($resort_highlights[$resort->id])) {?>
																<div class="facilities">
																	<div class="facilities-title">Highlights</div>
																	<!--<div class="facilities-items row mt-2">-->
																		<!--<div class="facilities-item col-6 col-md-4"><?php //echo $val;?></div>-->
																	
																	<!--</div>-->
																<div class="row">
																	<?php 
																	foreach($resort_highlights[$resort->id] as $key=>$val) {?>
																	   <div class="col-lg-6 col-md-6 col-12">
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
																		
																		<div class="col-lg-6 col-md-6 col-12">
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
														</div>
															<?php }?>	
														
														<!--<div class="transfer-types">-->
														<!--	<div class="transfer-types-title">Transfer Types</div>-->
														<!--	<div class="transfer-types-items row mt-2">-->
																<?php 
																// 	if(!empty($resort->airportType)) {
																// 		foreach($resort->airportType as $key=>$val) {
																			
																			?>
																				<!--<div class="transfer-types-item col-12"><?php echo $resort->airportType[$key]->airport_type_name;?> -->
																					<?php 
																				// 	$hours = "";
																				// 	$Minutes = "";
																					
																				// 	if($resort->airportType[$key]->hour1 > 0) {
																				// 		$hours .= $resort->airportType[$key]->hour1." Hours ";
																				// 	}
																				// 	if($resort->airportType[$key]->minuts1 > 0) {
																				// 		$Minutes .= $resort->airportType[$key]->minuts1." Minutes ";
																				// 	}
																				// 	if($resort->airportType[$key]->hour2 > 0) {
																				// 		$hours .= $resort->airportType[$key]->hour2." Hours ";
																				// 	}
																				// 	if($resort->airportType[$key]->minuts2 > 0) {
																				// 		$Minutes .= $resort->airportType[$key]->minuts2." Minutes ";
																				// 	}
																				// 	if($hours!="" || $Minutes!="") {
																				// 		echo "(".$hours.$Minutes.")";
																				// 	}
																					?>
																				<!--</div>-->
																			<?php
																// 		}

																// 	}
																?>
															
														<!--	</div>-->
														<!--</div>-->
														<div class="ideal">
															<?php //echo "<pre>"; var_dump($resort->holidays); die;
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
																		<div class="ideal-title">Ideal For: <span><?php echo implode(",",$holidayArr)?></span></div>
																	<?php
																}
															?>
															
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
													</div>
													<div class="card-read-more-container">
														<a href="#" class="card-read-more btn">Read more</a>
													</div>
												</div>
											</div>
											</div>
										<?php

									}
								}
							?>
						</div>
						<section id="scroll-tabs">				
                           <div class="warpper">
                              <div class="tabs">
						<div class="d-flex justify-content-center my-4">
							<label class="tab" id="one-tab" for="one"><a href="<?php echo base_url();?>inspiration#Resort-section" class="scroll-tab" class="view-more-link">Discover More</a></label>
			
							 <!--<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Viewmore.png" alt="Viewmore.png" class="img-fluid" />-->
						</div> 
						     </div>
                           </div>
                       </section>
			</div>			
	    
	</section>
	
	<section class="featured_resorts_all Moblie_resorts" >
	    <div class="container">
	        <div class="featured_resorts" style="text-align:center;">
				<h2>FEATURED RESORTS</h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	            <div class="inspiration-slider owl-carousel owl-theme">
							<?php 
								if(!empty($resorts)){
									foreach ($resorts as $resort) {
										$resportAmenities = !empty($resort->amenities)?explode(',', $resort->amenities):'';
										$international_airports = $this->developer_model->user_international_airports($resort->id); 
										$images = $this->common_model->get_result('images', array('item_id'=>$resort->id, 'type'=>'resort')); 
										//print_r($images[0]->image_name);
										if(!empty($images[0]->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$images[0]->image_name)) {
											$ImagePath = base_url().'uploads/resorts/thumbnails/500_'.$images[0]->image_name;
										} else {
											$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic1.jpg';
										}
										$category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));
										?>
										<!--<div class="col-lg-4">-->
											<div class="box">
												<div class="img-content">
													<img src="<?php echo  $ImagePath;?>" alt="Resort" class="img-fluid HomeImage">
													
												</div>
												<div class="img-bottom-contianer inspiration-readmore accommodation-villa">
													<div class="image-text-container">
														<div class="d-flex justify-content-between">
															<div class="img-content-title-container">
																<div class="img-content-title">
																	<a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($resort->id)); ?>">
																		<?php echo !empty($resort->resort_name)?character_limiter(ucfirst($resort->resort_name)):'';?>
																	</a>
																</div>
																<div class="d-flex">
																    
																	<?php 
																		for($i=0;$i< $category->no_of_star;$i++){ 
																			?>
																				<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																			<?php 
																		} 
																	?>
																    <span class="description ml-0"><?php echo $category->category_name;?></span>
																	
																</div>
															</div>
															<div class="reviews-rating d-flex">
																<?php 
																	$avg_rates = get_rating($resort->id);
																?>
																<div class="reviews-circle"><?php echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; ?></div>
																<div class="reviews-text ml-1"><?php if(!empty($resort->total_reviews)) { echo $resort->total_reviews.' Reviews'; } ?> </div>
															</div>
														</div>
															<div class="hotel-inner-profile-name">
															    <?php $state_name = $this->developer_model->resort_detail($resort->id); ?>
                                								<?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?>
                                							</div>
													</div>
													<br>
													<div class="img-bottom-contianer-description smalldesc">
														<span class="small_description new_resort_new_pra">
															<?php echo !empty($resort->resort_description)?character_limiter($resort->resort_description):'';?>
														</span>
														<?php 
															if(!empty($resort_highlights[$resort->id])) {?>
																<div class="facilities">
																	<div class="facilities-title">Highlights</div>
																	<div class="facilities-items row mt-2">
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
														</div>
															<?php }?>	
														<!--<div class="transfer-types">-->
															<!--<div class="transfer-types-title">Transfer Types</div>-->
															<!--<div class="transfer-types-items row mt-2">-->
																<?php 
																// 	if(!empty($resort->airportType)) {
																// 		foreach($resort->airportType as $key=>$val) {
																			
																			?>
																				<!--<div class="transfer-types-item col-12"><?php echo $resort->airportType[$key]->airport_type_name;?> -->
																					<?php 
																				// 	$hours = "";
																				// 	$Minutes = "";
																					
																				// 	if($resort->airportType[$key]->hour1 > 0) {
																				// 		$hours .= $resort->airportType[$key]->hour1." Hours ";
																				// 	}
																				// 	if($resort->airportType[$key]->minuts1 > 0) {
																				// 		$Minutes .= $resort->airportType[$key]->minuts1." Minutes ";
																				// 	}
																				// 	if($resort->airportType[$key]->hour2 > 0) {
																				// 		$hours .= $resort->airportType[$key]->hour2." Hours ";
																				// 	}
																				// 	if($resort->airportType[$key]->minuts2 > 0) {
																				// 		$Minutes .= $resort->airportType[$key]->minuts2." Minutes ";
																				// 	}
																				// 	if($hours!="" || $Minutes!="") {
																				// 		echo "(".$hours.$Minutes.")";
																				// 	}
																					?>
																				<!--</div>-->
																			<?php
																// 		}

																// 	}
																?>
															
														<!--	</div>-->
														<!--</div>-->
														<div class="ideal">
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
																		<div class="ideal-title">Ideal For: <span><?php echo implode(",",$holidayArr)?></span></div>
																	<?php
																}
															?>
															
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
													</div>
													<div class="card-read-more-container">
														<a href="#" class="card-read-more btn">Read more</a>
													</div>
												</div>
											</div>
											<!--</div>-->
										<?php

									}
								}
							?>
						</div>
						<div class="d-flex justify-content-center my-4">
						<a href="<?php echo base_url();?>resorts" class="scroll-tab" class="view-more-link">Discover More</a>
							 <!--<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Viewmore.png" alt="Viewmore.png" class="img-fluid" />-->
						</div> 
			</div>			
	    
	</section>
	
	
	
	
	<section class="Featured_villas destop_villas">
	    <div class="container"> 
	    <div class="featured_resorts" style="text-align:center;">
				<h2>FEATURED VILLAS & SUITES </h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	    <!--<div class="inspiration-slider owl-carousel owl-theme">-->
	   <div class="row">     


							<?php 
								if($accommodations) {
									foreach($accommodations as $accomm) {
									   $villa_types = $this->common_model->get_row('mal_villa_type', array('status'=>1, 'id'=>$accomm->villa_type));
		
									   $villa_type_name = $accomm->room_size." ". "sqm | ".$accomm->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $villa_types->villa_type;
     	                               $resort_villa = $this->common_model->get_row('mal_resorts', array('id'=>$accomm->resort_id));
     	                               $category = $this->common_model->get_row('mal_category', array('id'=>$resort_villa->resort_category));
     	                               
									   $ac_images =$this->common_model->get_row('images', array('item_id'=>$accomm->id, 'type'=>'accommodation'));

									   if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$ac_images->image_name)){
										   $AccImage = base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name;
										} else {
											$AccImage = FRONT_THEAM_PATH.'/images/instagram-pic6.jpg';
										}

									   ?>
									   <div class="col-lg-4 mb-lg-4">
									   		<div class="box">
												<div class="img-content">
													<img src="<?php echo  $AccImage ;?>" alt="<?php echo $ac_images->image_name;?>" class="img-fluid HomeImage">
													<div class="image-text-container">
														<div class="d-flex justify-content-between">
															<div class="img-content-title-container">
																<div class="img-content-title">
																    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>">
																            <?php echo $accomm->resort_name;?></a></div>
															

																<div class="d-flex des-star new_letter_s">
																    <?php 
																		for($i=0;$i< $category->no_of_star;$i++){ 
																			?>
																				<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																			<?php 
																		} 
																	?>
																    <span class="description"><?php echo $category->category_name;?></span>
																	<!--<span class="description"><?php echo $villa_type_name;?></span>-->
																</div>
																<div class="d-flex">
    															    <span class="description"><?php $state_name = $this->developer_model->resort_detail($accomm->resort_id); ?></span>
                                    								<span class="description"><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?></span>
                                							    </div>
															</div>
														</div>
													</div>
													<div class="img-fluid heart-icon"> 
														<span class="no-of-likes like-heart" onclick="save_accommodation_like_unlike('<?php echo $accomm->id;?>');" id="accommodation_like_unlike_btn_<?php echo $accomm->id;?>">
															<?php
																if(user_logged_in()){ 
																	if(get_all_count('accommodations_likes', array('accommodation_id'=>$accomm->id, 'user_id'=>user_id()))){
																		echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
																	} else {
																		echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
																	}
																} else {
																	echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
																}
															?> 
															<span>
																<strong><?php $acclikes = get_all_count('accommodations_likes', array('accommodation_id'=>$accomm->id));
																		echo !empty($acclikes)?number_format($acclikes, 0):'';?>
																</strong>
															</span>
														</span>
													</div>
												</div>
												<div class="img-bottom-contianer inspiration-readmore">
													<div class="img-bottom-contianer-description smalldesc">
													    <div class="featured_villas_img_title">
													        <div class="img-content-title-container">
																<div class="img-content-title"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>"><?php echo $accomm->name_of_villa?></a></div>
																<div class="d-flex">
																	<span class="description ml-1"><?php echo $villa_type_name;?></span>
																</div>
															</div>
														</div>	
														<span class="charater">
															<?php echo character_limiter($accomm->description);?>
														</span>
														<div class="facilities">
															<!--<div class="facilities-title">Highlights</div>-->
															<div class="facilities-items row mt-2">
																<?php 
																	if(isset($resort_highlights[$accomm->resort_id]) && !empty($resort_highlights[$accomm->resort_id])) {
																		foreach($resort_highlights[$accomm->resort_id] as $key=>$val) {?>
																			<!--<div class="facilities-item col-6 col-md-6"><?php echo $val;?></div>-->
																	<?php 
																		} 
																	}
																?>
															</div>
														</div>
														<div class="transfer-types">
															<div class="transfer-types-title maximum_occupancy">
															    <span class="occupancy">Maximum Occupancy</span>: 2 adults & 2 kids</div>
														</div>
														<div class="ideal madal_click">
															<div class="ideal-title">
															    <!--<a href="javascript:void(0);" class="" data-toggle="modal" data-target="#facilities_details" onclick="amenities_details('<?php echo !empty($accomm->id)?$accomm->id:''; ?>');">Amenities</a>-->
															    <a class="ideal-link facilities" href="javascript:void(0);" data-toggle="modal" data-target="#amenities_details" onclick="amenities_details('<?php echo !empty($accomm->id)?$accomm->id:''; ?>');">Amenities</a>
															</div>
															
															<?php 
																if(!empty($accomm->floor_plan)&&file_exists('uploads/resorts/'.$accomm->floor_plan)){
																	?>
																		<div><a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$accomm->floor_plan;?>"  class="ideal-link FloorPlanLink">Floor Plan</a></div>
																	<?php 
																}
															?>
														</div>
													</div>
													<div class="card-read-more-container">
														<a href="#" class="card-read-more btn">Read more</a>
													</div>
												</div>
											</div>
										</div>	
									   <?php
									}
								}
							?>	
						</div>
						<section id="scroll-tabs">				
                           <div class="warpper">
                              <div class="tabs">
    						<div class="d-flex justify-content-center my-4">
    							<label class="tab" id="two-tab" for="two"><a href="<?php echo base_url();?>inspiration#villas-and-Suits" class="scroll-tab" class="view-more-link">Discover More</a></label>
    						</div>
						    </div>
                           </div>
                        </section>
			</div>			
	    
	</section>
	
	
	<section class="Featured_villas Moblie_villas">
	   <div class="container">
	    <div class="featured_resorts" style="text-align:center;">
				<h2>FEATURED VILLAS & SUITES </h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	    <div class="inspiration-slider owl-carousel owl-theme">
	   <!--<div class="row">     -->


							<?php 
								if($accommodations) {
									foreach($accommodations as $accomm) {
									   $villa_types = $this->common_model->get_row('mal_villa_type', array('status'=>1, 'id'=>$accomm->villa_type));
									   $villa_type_name = $accomm->room_size." ". "sqm | ".$accomm->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $villa_types->villa_type;
     	                               $resort_villa = $this->common_model->get_row('mal_resorts', array('id'=>$accomm->resort_id));
     	                               $category = $this->common_model->get_row('mal_category', array('id'=>$resort_villa->resort_category));
									   $ac_images =$this->common_model->get_row('images', array('item_id'=>$accomm->id, 'type'=>'accommodation'));

									   if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$ac_images->image_name)){
										   $AccImage = base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name;
										} else {
											$AccImage = FRONT_THEAM_PATH.'/images/instagram-pic6.jpg';
										}

									   ?>
									   <!--<div class="col-lg-4">-->
									   		<div class="box">
												<div class="img-content">
													<img src="<?php echo  $AccImage ;?>" alt="<?php echo $ac_images->image_name;?>" class="img-fluid HomeImage">
													<div class="image-text-container">
														<div class="d-flex justify-content-between">
															<div class="img-content-title-container">
																<div class="img-content-title">
																    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>">
																            <?php echo $accomm->resort_name;?></a></div>
																<div class="d-flex">
    															    <span class="description"><?php $state_name = $this->developer_model->resort_detail($accomm->resort_id); ?></span>
                                    								<span class="description"><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?></span>
                                							    </div>

																<div class="d-flex des-star new_letter_s ">
																    <?php 
																		for($i=0;$i< $category->no_of_star;$i++){ 
																			?>
																				<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																			<?php 
																		} 
																	?>
																    <span class="description"><?php echo $category->category_name;?></span>
																	<!--<span class="description"><?php echo $villa_type_name;?></span>-->
																</div>
																<div class="d-flex">
    															    <span class="description"><?php $state_name = $this->developer_model->resort_detail($accomm->resort_id); ?></span>
                                    								<span class="description"><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?></span>
                                							    </div>
															</div>
														</div>
													</div>
													<div class="img-fluid heart-icon"> 
														<span class="no-of-likes like-heart" onclick="save_accommodation_like_unlike('<?php echo $accomm->id;?>');" id="accommodation_like_unlike_btn_<?php echo $accomm->id;?>">
															<?php
																if(user_logged_in()){ 
																	if(get_all_count('accommodations_likes', array('accommodation_id'=>$accomm->id, 'user_id'=>user_id()))){
																		echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
																	} else {
																		echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
																	}
																} else {
																	echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
																}
															?> 
															<span>
																<strong><?php $acclikes = get_all_count('accommodations_likes', array('accommodation_id'=>$accomm->id));
																		echo !empty($acclikes)?number_format($acclikes, 0):'';?>
																</strong>
															</span>
														</span>
													</div>
												</div>
												<div class="img-bottom-contianer inspiration-readmore">
													<div class="img-bottom-contianer-description smalldesc">
													    <div class="featured_villas_img_title">
													        <div class="img-content-title-container">
																<div class="img-content-title"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>"><?php echo $accomm->name_of_villa?></a></div>
																<div class="d-flex">
																	<span class="description ml-1"><?php echo $villa_type_name;?></span>
																</div>
															</div>
														</div>	
														<span class="charater">
															<?php echo character_limiter($accomm->description);?>
														</span>
														<!--<div class="facilities">-->
														<!--	<div class="facilities-title">Highlights</div>-->
														<!--	<div class="facilities-items row mt-2">-->
														<!--		<//?php -->
														<!--			if(isset($resort_highlights[$accomm->resort_id]) && !empty($resort_highlights[$accomm->resort_id])) {-->
														<!--				foreach($resort_highlights[$accomm->resort_id] as $key=>$val) {?>-->
														<!--					<div class="facilities-item col-6 col-md-6"><//?php echo $val;?></div>-->
														<!--			<//?php -->
														<!--				} -->
														<!--			}-->
														<!--		?>-->
														<!--	</div>-->
														<!--</div>-->
														<div class="transfer-types">
															<div class="transfer-types-title maximum_occupancy"><span class="occupancy">Maximum Occupancy</span>:- 2 adults & 2 kids</div>
														</div>
														<div class="ideal madal_click">
															<!--<div class="ideal-title"><a class="ideal-link" href="#">Facilities</a></div>-->
															<div class="ideal-title">
															    <a class="ideal-link facilities" href="javascript:void(0);" data-toggle="modal" data-target="#amenities_details" onclick="amenities_details('<?php echo !empty($accomm->id)?$accomm->id:''; ?>');">Amenities</a>
															</div>
															
															<?php 
																if(!empty($accomm->floor_plan)&&file_exists('uploads/resorts/'.$accomm->floor_plan)){
																	?>
																		<div><a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$accomm->floor_plan;?>"  class="ideal-link FloorPlanLink">Floor Plan</a></div>
																	<?php 
																}
															?>
														</div>
													</div>
													<div class="card-read-more-container">
														<a href="#" class="card-read-more btn">Read more</a>
													</div>
												</div>
											</div>
										<!--</div>	-->
									   <?php
									}
								}
							?>	
						</div>
						<div class="d-flex justify-content-center my-4">
							<a href="<?php echo base_url();?>villas_suites" class="view-more-link">Discover More</a>
						</div>
			</div>			
	    
	</section>
	
        <?php 
        $bannerImaage1 = '';
if(!empty($banner_caption_imgs)) {
    
foreach($banner_caption_imgs as $caption_img1) {
	$bannerImaage1 = $caption_img1->image_name;
}
}
?>

	<section class="new_slider_img" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage1); ?>');background-size: cover;background-position: left center;"> 
	   <div class="text_new">
	       <h2><?php if(!empty($banner_caption->caption_title)) { echo $banner_caption->caption_title, " "; } ?></h2>
	   </div>     
	</section>    
	
	<section class="signture_exprrienes destop_exprrienes">
	  <div class="container"> 
	    <div class="featured_resorts" style="text-align:center;">
				<h2>SIGNATURE EXPERIENCES </h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	    <div class="row mt-2">
							<?php 
							if($expriences){
								foreach($expriences as $exprience){
   					// 				$ac_images =$this->common_model->get_row('images', array('item_id'=>$exprience->id, 'type'=>'accommodation'));
								// 	if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$ac_images->image_name)) {
								// 		$ImagePath = base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name;
								// 	} else {
								// 		$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic2.jpg';
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
													<img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">
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
											
											<div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa">
												<div class="about-slider-bottom-description smalldesc">
													<div class="about-slider-bottom-description-title d-flex mb-2">
														<div class="about-slider-bottom-description-title1"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($exprience->resort_id)); ?>"><?php echo $exprience->name_of_activities?></a></div>
													</div>
													<span class="">
														<?php echo $exprience->activities_description;?>
													</span>
												</div>
												<div class="card-read-more-container">
                									<a href="#" class="card-read-more btn">Read more</a>
                								</div>
											</div>
											<div class="img-fluid heart-icon"> 
												<span class="no-of-likes like-heart" onclick="save_exprince_like_unlike('<?php echo $exprience->id;?>');" id="experince_like_unlike_btn_<?php echo $exprience->id;?>">
													<?php
														if(user_logged_in()){ 
															if(get_all_count('exprience_likes', array('exprience_id'=>$exprience->id, 'user_id'=>user_id()))){
																echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
															} else {
																echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
															}
														} else {
															echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
														}
													?> 
													<span>
														<strong><?php $likes = get_all_count('exprience_likes', array('exprience_id'=>$exprience->id));
																echo !empty($likes)?number_format($likes, 0):'';?>
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
		<section id="scroll-tabs">				
                           <div class="warpper">
                              <div class="tabs">
						<div class="d-flex justify-content-center my-4">
							<label class="tab" id="two-tab" for="two"><a href="<?php echo base_url();?>inspiration#experiences"  class="scroll-tab"  class="view-more-link">Discover More</a></label>
						</div>
						    </div>
                          </div>
            </section>
			</div>			
	</section>
	
	<section id="blog-news-section" class="destop_travel_stories">
	   <div class="container">
		<div class="py-2">
			<div class="story-blog">
				<div class="story-blog-title">
					<h2>TRAVEL STORIES & NEWS</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="row mt-2">
<!--				<style>-->
<!--	    .mobile-social-share {-->
<!--    background: none repeat scroll 0 0 #EEEEEE;-->
<!--    display: block !important;-->
<!--    min-height: 70px !important;-->
<!--    margin: 50px 0;-->
<!--}-->


<!--.mobile-social-share h3 {-->
<!--    color: inherit;-->
<!--    float: left;-->
<!--    font-size: 15px;-->
<!--    line-height: 20px;-->
<!--    margin: 25px 25px 0 25px;-->
<!--}-->

<!--.share-group {-->
<!--    float: right;-->
<!--    margin: 18px 25px 0 0;-->
<!--}-->

<!--.btn-group {-->
<!--    display: inline-block;-->
<!--    font-size: 0;-->
<!--    position: relative;-->
<!--    vertical-align: middle;-->
<!--    white-space: nowrap;-->
<!--}-->

<!--.mobile-social-share ul {-->
<!--    float: right;-->
<!--    list-style: none outside none;-->
<!--    margin: 0;-->
<!--    min-width: 61px;-->
<!--    padding: 0;-->
<!--}-->

<!--.share {-->
<!--    min-width: 17px;-->
<!--}-->

<!--.mobile-social-share li {-->
<!--    display: block;-->
<!--    font-size: 18px;-->
<!--    list-style: none outside none;-->
<!--    margin-bottom: 3px;-->
<!--    margin-left: 4px;-->
<!--    margin-top: 3px;-->
<!--}-->

<!--.btn-share {-->
<!--    background-color: #BEBEBE;-->
<!--    border-color: #CCCCCC;-->
<!--    color: #333333;-->
<!--}-->

<!--.btn-twitter {-->
<!--    background-color: #3399CC !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-facebook {-->
<!--    background-color: #3D5B96 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-facebook {-->
<!--    background-color: #3D5B96 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-google {-->
<!--    background-color: #DD3F34 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-linkedin {-->
<!--    background-color: #1884BB !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-pinterest {-->
<!--    background-color: #CC1E2D !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-mail {-->
<!--    background-color: #FFC90E !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.caret {-->
<!--    border-left: 4px solid rgba(0, 0, 0, 0);-->
<!--    border-right: 4px solid rgba(0, 0, 0, 0);-->
<!--    border-top: 4px solid;-->
<!--    display: inline-block;-->
<!--    height: 0;-->
<!--    margin-left: 2px;-->
<!--    vertical-align: middle;-->
<!--    width: 0;-->
<!--}-->

<!--#socialShare {-->
<!--    max-width:59px;-->
<!--    margin-bottom:18px;-->
<!--}-->

<!--#socialShare > a{-->
<!--    padding: 6px 10px 6px 10px;-->
<!--}-->

<!--@media (max-width : 320px) {-->
<!--    #socialHolder{-->
<!--        padding-left:5px;-->
<!--        padding-right:5px;-->
<!--    }-->
    
<!--    .mobile-social-share h3 {-->
<!--        margin-left: 0;-->
<!--        margin-right: 0;-->
<!--    }-->
    
<!--    #socialShare{-->
<!--        margin-left:5px;-->
<!--        margin-right:5px;-->
<!--    }-->
    
<!--    .mobile-social-share h3 {-->
<!--        font-size: 15px;-->
<!--    }-->
<!--}-->

<!--@media (max-width : 238px) {-->
<!--    .mobile-social-share h3 {-->
<!--        font-size: 12px;-->
<!--    }-->
<!--}-->


<!--	</style>-->
        <?php 
          if($blogs){
            $bl=0;
            foreach($blogs as $blog){
              if($bl<12){
                $share_link = base_url('blog-detail?blog_id='.$blog->id); 
                $blog_title = $blog->news_title;
                $sgimage=get_single_image_of_blog($blog->id);
                // var_dump($sgimage); 
				// if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/'.$sgimage->image_name)) {
                ?>
                <div class="col-lg-3 mb-lg-4">
                  <div class="box">
                    <div class="img-content">
                    <?php //if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/'.$sgimage->image_name)) {?>
                       <!--<img src="<?php echo base_url('uploads/blogs/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid HomeImage">-->
                      
                      <?php if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/500_'.$sgimage->image_name)) {?>
                                <img src="<?= base_url('uploads/blogs/thumbnails/500_'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php }elseif(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/'.$sgimage->image_name)) {?> 
                                <img src="<?= base_url('uploads/blogs/thumbnails/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php }else { ?>
                                <img src="<?php echo base_url('assets/front/images/No_Image_Available.jpg'); ?>" alt="image.png" class="img-fluid  HomeImage">
                              <?php  }?>
                      
                      <div class="image-text-container">
         <!--               <div class="d-flex justify-content-between">-->
         <!--                 <div class="img-content-title-container">-->
         <!--                   <div class="img-content-title">-->
         <!--                     <a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>" class="holiday_thumb_main"> -->
							  <?php //echo !empty($blog->news_title)?character_limiter(ucfirst($blog->news_title),40):''; ?>
         <!--                     </a>-->
         <!--                   </div>-->
         <!--                   <div class="d-flex">-->
         <!--                     <span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>-->
         <!--                   </div>-->
         <!--                 </div>-->
         <!--               </div>-->
                      </div>
                      <div class="new_share_blogs">
                        <div class="img-fluid heart-icon"> 
                          <span class="no-of-likes like-heart" onclick="show_show_btn('<?php echo $blog->id; ?>');" href="javascript:void(0);" data-toggle="collapse" data-target="#share_btn_menu_<?php echo $blog->id; ?>" >
                            <span class="fa fa-share-alt  MyheartIcon" aria-hidden="true"></span> 
                          </span>
                        </div>                      
                        <div class="new_share_blogs share-icon">
                          <div class="share-social">
						  <a data-toggle="dropdown" class="btn btn-info">
                                                                             <i class="fa fa-share-alt fa-inverse"></i>
                                                                        </a>
                                                        				<ul class="dropdown-menu" style="background:transparent;border:none;">
                                                            				<li>
                                                        					    <a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo $share_link.'&text='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'twitter');" class="btn btn-twitter" data-placement="left">
                                                    								<i class="fa fa-twitter"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Facebook" rel="tooltip"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left"  target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'facebook');">
                                                    								<i class="fa fa-facebook"></i>
                                                    							</a>
                                                        					</li>					
                                                        				
                                                        				    <li>
                                                        						<a data-original-title="LinkedIn" rel="tooltip"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'linkedin');" class="btn btn-linkedin" data-placement="left">
                                                    								<i class="fa fa-linkedin"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link.'&description='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'pinterest');" class="btn btn-pinterest" data-placement="left">
                                                    								<i class="fa fa-pinterest"></i>
                                                    							</a>
                                                        					</li>
                                                                            
                                                                        </ul>  
                            
                          </div>
                        </div>
                        
                      </div>

                      <!-- <div>
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/share.png" alt="share.png" class="img-fluid share-icon">
                      </div> -->
                    </div>
                    <div class="img-bottom-contianer">
                        <div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title"><a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>"><?php echo $blog_title;?></a></div>
										<div class="d-flex">
										<span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>
										</div>
									</div>
                                    <!--<div class="img-content-title-container">-->
                                    <!--    <div class="description" style="font-size:15px;"><?php echo $blog->tags;?></div>-->
                                    <!--</div>-->
								</div> 
                      <div class="img-bottom-profile my-1" style="display:none;">
                        <div class="profile-image">
						<?php
							if(!empty($blog->profile_pic)&&file_exists('uploads/users/'.$blog->profile_pic)){
								echo '<img src="'.base_url('uploads/users/'.$blog->profile_pic).'" class="img-fluid">';
							}else{
								echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" class="img-fluid"/>';
							}
							?> 
                        </div>
                        <div class="profile-details mx-2">
                          <div class="profile-name"> <?php echo $blog->first_name." ".$blog->last_name; ?></div>
						  <?php $counts = $this->common_model->getGroupBycount('mal_news_blog','news_added_user',array('news_added_user'=>$blog->news_added_user));?>
                          <div class="profile-comment">Maldives | <?php echo $counts[0]->fieldcount;?> Contributions</div>
                        </div>
                      </div>
                      <div class="img-bottom-contianer-description">
                        <span class="more-link-page" rel="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>">
						<?php //echo !empty($blog->news_description)?character_limiter(strip_tags($blog->news_description), 180):''; ?>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>  
                <?php
              	}
				// }
			  $bl++;
            }
          }
                ?>
				</div>
				<section id="scroll-tabs">				
                  <div class="warpper">
                    <div class="tabs">
				<div class="d-flex justify-content-center mt-2">
					<label class="tab" id="two-tab" for="two"><a href="<?php echo  base_url('blogs');?>"  class="scroll-tab"  class="view-more-link">Discover More</a></label>
					<!--<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Viewmore.png" alt="Viewmore.png" class="img-fluid" />-->
				</div>
				
			</div>
		</div>
	</div>	
	</section>
	
	<section class="signture_exprrienes Moblie_exprrienes">
	    <div class="container">
	    <div class="featured_resorts" style="text-align:center;">
				<h2>SIGNATURE EXPERIENCES </h2>
				<img src="<?php echo base_url();?>assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	    <div class="inspiration-slider owl-carousel owl-theme mt-2">
							<?php 
							if($expriences){
								foreach($expriences as $exprience){
   					// 				$ac_images =$this->common_model->get_row('images', array('item_id'=>$exprience->id, 'type'=>'accommodation'));
								// 	if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$ac_images->image_name)) {
								// 		$ImagePath = base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name;
								// 	} else {
								// 		$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic2.jpg';
								// 	} 
								
								
									if(!empty($exprience->activities_image)) {
										$ImagePath = base_url().'uploads/resorts/full_image/1300_'.$exprience->activities_image;
									} else {
										$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic2.jpg';
									}
     	                            $category = $this->common_model->get_row('mal_category', array('id'=>$exprience->resort_category));
									?>
									<!--<div class="col-lg-4">-->
										<div class="box">
										  <div class="img-content">   
											    <img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">
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
														<div class="about-slider-bottom-description-title1"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($exprience->resort_id)); ?>"><?php echo $exprience->name_of_activities?></a> </div>
														<!--<div class="about-slider-bottom-description-title2 ml-2"><a href="<//?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode(//$exprience->resort_id)); ?>"><//?php echo $exprience->resort_name;?></a></div>-->
													</div>
													<span class="new_more">
														<?php echo $exprience->activities_description;?>
													</span>
												</div>
											</div>
											<div class="img-fluid heart-icon"> 
												<span class="no-of-likes like-heart" onclick="save_exprince_like_unlike('<?php echo $exprience->id;?>');" id="experince_like_unlike_btn_<?php echo $exprience->id;?>">
													<?php
														if(user_logged_in()){ 
															if(get_all_count('exprience_likes', array('exprience_id'=>$exprience->id, 'user_id'=>user_id()))){
																echo '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span>';
															} else {
																echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
															}
														} else {
															echo '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true"></span>';
														}
													?> 
													<span>
														<strong><?php $likes = get_all_count('exprience_likes', array('exprience_id'=>$exprience->id));
																echo !empty($likes)?number_format($likes, 0):'';?>
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
						<div class="d-flex justify-content-center my-4">
							<a href="<?php echo base_url();?>experiences" class="view-more-link">Discover More</a>
						</div>
			</div>			
	</section>
	    
	<section id="blog-news-section" class="moblie_travel_stories">
	   <div class="container">
		<div class="py-2">
			<div class="story-blog">
				<div class="story-blog-title">
					<h2>TRAVEL STORIES & NEWS</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="story-blog-slider owl-carousel owl-theme mt-2">
<!--				<style>-->
<!--	    .mobile-social-share {-->
<!--    background: none repeat scroll 0 0 #EEEEEE;-->
<!--    display: block !important;-->
<!--    min-height: 70px !important;-->
<!--    margin: 50px 0;-->
<!--}-->


<!--.mobile-social-share h3 {-->
<!--    color: inherit;-->
<!--    float: left;-->
<!--    font-size: 15px;-->
<!--    line-height: 20px;-->
<!--    margin: 25px 25px 0 25px;-->
<!--}-->

<!--.share-group {-->
<!--    float: right;-->
<!--    margin: 18px 25px 0 0;-->
<!--}-->

<!--.btn-group {-->
<!--    display: inline-block;-->
<!--    font-size: 0;-->
<!--    position: relative;-->
<!--    vertical-align: middle;-->
<!--    white-space: nowrap;-->
<!--}-->

<!--.mobile-social-share ul {-->
<!--    float: right;-->
<!--    list-style: none outside none;-->
<!--    margin: 0;-->
<!--    min-width: 61px;-->
<!--    padding: 0;-->
<!--}-->

<!--.share {-->
<!--    min-width: 17px;-->
<!--}-->

<!--.mobile-social-share li {-->
<!--    display: block;-->
<!--    font-size: 18px;-->
<!--    list-style: none outside none;-->
<!--    margin-bottom: 3px;-->
<!--    margin-left: 4px;-->
<!--    margin-top: 3px;-->
<!--}-->

<!--.btn-share {-->
<!--    background-color: #BEBEBE;-->
<!--    border-color: #CCCCCC;-->
<!--    color: #333333;-->
<!--}-->

<!--.btn-twitter {-->
<!--    background-color: #3399CC !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-facebook {-->
<!--    background-color: #3D5B96 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-facebook {-->
<!--    background-color: #3D5B96 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-google {-->
<!--    background-color: #DD3F34 !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-linkedin {-->
<!--    background-color: #1884BB !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-pinterest {-->
<!--    background-color: #CC1E2D !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.btn-mail {-->
<!--    background-color: #FFC90E !important;-->
<!--    width: 51px;-->
<!--    color:#FFFFFF!important;-->
<!--}-->

<!--.caret {-->
<!--    border-left: 4px solid rgba(0, 0, 0, 0);-->
<!--    border-right: 4px solid rgba(0, 0, 0, 0);-->
<!--    border-top: 4px solid;-->
<!--    display: inline-block;-->
<!--    height: 0;-->
<!--    margin-left: 2px;-->
<!--    vertical-align: middle;-->
<!--    width: 0;-->
<!--}-->

<!--#socialShare {-->
<!--    max-width:59px;-->
<!--    margin-bottom:18px;-->
<!--}-->

<!--#socialShare > a{-->
<!--    padding: 6px 10px 6px 10px;-->
<!--}-->

<!--@media (max-width : 320px) {-->
<!--    #socialHolder{-->
<!--        padding-left:5px;-->
<!--        padding-right:5px;-->
<!--    }-->
    
<!--    .mobile-social-share h3 {-->
<!--        margin-left: 0;-->
<!--        margin-right: 0;-->
<!--    }-->
    
<!--    #socialShare{-->
<!--        margin-left:5px;-->
<!--        margin-right:5px;-->
<!--    }-->
    
<!--    .mobile-social-share h3 {-->
<!--        font-size: 15px;-->
<!--    }-->
<!--}-->

<!--@media (max-width : 238px) {-->
<!--    .mobile-social-share h3 {-->
<!--        font-size: 12px;-->
<!--    }-->
<!--}-->


<!--	</style>-->
        <?php 
          if($blogs){
            $bl=0;
            foreach($blogs as $blog){
              if($bl<6){
                $share_link = base_url('blog-detail?blog_id='.$blog->id); 
                $blog_title = $blog->news_title;
                $sgimage=get_single_image_of_blog($blog->id);
                // var_dump($sgimage); 
				// if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/'.$sgimage->image_name)) {
                ?>
                  <div class="box">
                    <div class="img-content">
                    <?php //if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/'.$sgimage->image_name)) {?>
                       <!--<img src="<?php echo base_url('uploads/blogs/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid HomeImage">-->
                      
                      <?php if(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/500_'.$sgimage->image_name)) {?>
                                <img src="<?= base_url('uploads/blogs/thumbnails/500_'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php }elseif(isset($sgimage->image_name) && $sgimage->image_name!="" && file_exists('uploads/blogs/thumbnails/'.$sgimage->image_name)) {?> 
                                <img src="<?= base_url('uploads/blogs/thumbnails/'.$sgimage->image_name); ?>" alt="image.png" class="img-fluid  HomeImage">
                            <?php }else { ?>
                                <img src="<?php echo base_url('assets/front/images/No_Image_Available.jpg'); ?>" alt="image.png" class="img-fluid  HomeImage">
                              <?php  }?>
                      
                      <div class="image-text-container">
         <!--               <div class="d-flex justify-content-between">-->
         <!--                 <div class="img-content-title-container">-->
         <!--                   <div class="img-content-title">-->
         <!--                     <a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>" class="holiday_thumb_main"> -->
							  <?php //echo !empty($blog->news_title)?character_limiter(ucfirst($blog->news_title),40):''; ?>
         <!--                     </a>-->
         <!--                   </div>-->
         <!--                   <div class="d-flex">-->
         <!--                     <span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>-->
         <!--                   </div>-->
         <!--                 </div>-->
         <!--               </div>-->
                      </div>
                      <div class="new_share_blogs">
                        <div class="img-fluid heart-icon"> 
                          <span class="no-of-likes like-heart" onclick="show_show_btn('<?php echo $blog->id; ?>');" href="javascript:void(0);" data-toggle="collapse" data-target="#share_btn_menu_<?php echo $blog->id; ?>" >
                            <span class="fa fa-share-alt  MyheartIcon" aria-hidden="true"></span> 
                          </span>
                        </div>                      
                        <div class="new_share_blogs share-icon">
                          <div class="share-social">
						  <a data-toggle="dropdown" class="btn btn-info">
                                                                             <i class="fa fa-share-alt fa-inverse"></i>
                                                                        </a>
                                                        				<ul class="dropdown-menu" style="background:transparent;border:none;">
                                                            				<li>
                                                        					    <a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo $share_link.'&text='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'twitter');" class="btn btn-twitter" data-placement="left">
                                                    								<i class="fa fa-twitter"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Facebook" rel="tooltip"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left"  target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'facebook');">
                                                    								<i class="fa fa-facebook"></i>
                                                    							</a>
                                                        					</li>					
                                                        				
                                                        				    <li>
                                                        						<a data-original-title="LinkedIn" rel="tooltip"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'linkedin');" class="btn btn-linkedin" data-placement="left">
                                                    								<i class="fa fa-linkedin"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link.'&description='.$blog_title ?>" target="_blank" onclick="share_socail_media('<?php echo $blog->id; ?>', 'pinterest');" class="btn btn-pinterest" data-placement="left">
                                                    								<i class="fa fa-pinterest"></i>
                                                    							</a>
                                                        					</li>
                                                                            
                                                                        </ul>  
                            
                          </div>
                        </div>
                        
                      </div>

                      <!-- <div>
                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/share.png" alt="share.png" class="img-fluid share-icon">
                      </div> -->
                    </div>
                    <div class="img-bottom-contianer">
                        <div class="d-flex justify-content-between">
									<div class="img-content-title-container">
										<div class="img-content-title"><a href="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>"><?php echo $blog_title;?></a></div>
										<div class="d-flex">
										<span class="description ml-1"><?php echo !empty($blog->created_date)?date('d M Y', strtotime($blog->created_date)):''; ?></span>
										</div>
									</div>
                                    <!--<div class="img-content-title-container">-->
                                    <!--    <div class="description" style="font-size:15px;"><?php echo $blog->tags;?></div>-->
                                    <!--</div>-->
								</div> 
                      <div class="img-bottom-profile my-1" style="display:none;">
                        <div class="profile-image">
						<?php
							if(!empty($blog->profile_pic)&&file_exists('uploads/users/'.$blog->profile_pic)){
								echo '<img src="'.base_url('uploads/users/'.$blog->profile_pic).'" class="img-fluid">';
							}else{
								echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg" class="img-fluid"/>';
							}
							?> 
                        </div>
                        <div class="profile-details mx-2">
                          <div class="profile-name"> <?php echo $blog->first_name." ".$blog->last_name; ?></div>
						  <?php $counts = $this->common_model->getGroupBycount('mal_news_blog','news_added_user',array('news_added_user'=>$blog->news_added_user));?>
                          <div class="profile-comment">Maldives | <?php echo $counts[0]->fieldcount;?> Contributions</div>
                        </div>
                      </div>
                      <div class="img-bottom-contianer-description">
                        <span class="more-link-page" rel="<?php echo base_url('blog-detail?blog_id='.base64_encode($blog->id)); ?>">
						<?php //echo !empty($blog->news_description)?character_limiter(strip_tags($blog->news_description), 180):''; ?>
                        </span>
                      </div>
                    </div>
                  </div>
                <?php
              	}
				// }
			  $bl++;
            }
          }
                ?>
				</div>
				<div class="d-flex justify-content-center mt-2">
					<a href="<?php echo  base_url('blogs');?>" class="view-more-link">Discover More</a>
					<!--<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Viewmore.png" alt="Viewmore.png" class="img-fluid" />-->
				</div>
			</div>
		</div>
	</div>	
	</section>
	
	<section id="insta-feed-section">
		<div class="insta-feed">
			<div class="insta-feed-title">
				<h2>INSTAGRAM FEED</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component1–2.png" alt="Component1–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component2–2.png" alt="Component2–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component4–2.png" alt="Component2–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component5–2.png" alt="Component2–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component6–2.png" alt="Component2–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
					<div class="col-md-4 col-6 my-3">
						<div class="insta-feed-wrapper">
							<div class="img-container bg-success">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Component7–2.png" alt="Component2–2.png" class="img-fluid" />
							</div>
							<div class="insta-feed-wrapper-inner">
								<img src="<?php echo  FRONT_THEAM_PATH ;?>images/instagram.png" alt="instagram.png" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="guest-reviews-section">
		<div class="guest-reviews">
			<div class="guest-reviews-title">
				<h2>GUEST REVIEWS</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
			<div class="container-fluid">
				<?php 
					if($stories){
						foreach($stories as $story){
							$avg_rates = get_rating($story->resort_id, $story->id);
							$images  = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$story->id, 'type'=>'traveller_story'));
							$resort_comments = $this->developer_model->getTravellerStoryComments($story->id, 0, PER_PAGE_COMMENTS);
							$comment_user_name = ucfirst($story->first_name)." ".ucfirst($story->last_name);

							?>
								<div class="row my-3 accommodation-villa">
									<div class="col-lg-12 col-md-12 col-12 mb-4">
										<div class="reviewer-details">
											<div class="reviewer-details-profile">
												<div>
													<div class="reviewer-image">
													<?php
														if(!empty($story->profile_pic)&&file_exists('uploads/users/'.$story->profile_pic)){
															echo '<img src="'.base_url('uploads/users/'.$story->profile_pic).'"  class="img-fluid">';
														}else{
															echo '<img src="'.FRONT_THEAM_PATH.'images/No_Image_Available.jpg"  class="img-fluid"/>';
														}
													?>
													</div>
												</div>
												<div>
													<div class="reviewer-name">
													<?php 
														echo !empty($story->first_name)?ucfirst($story->first_name):'';
														echo !empty($story->last_name)?' '.ucfirst($story->last_name):'';
													?>
													</div>
													<div class="reviewer-text">
														<div>Posted on <?php echo !empty($story->created_date)?date('d F Y', strtotime($story->created_date)):''; ?></div>
														<div><?php echo ucwords($story->country_name);?> | <?php $contributions = get_all_count('traveller_stories', array('user_id'=>$story->user_id)); echo !empty($contributions)?number_format($contributions,0):'';?> Contributions </div>
													</div>
												</div>
											</div>
											<div class="reviewer-exception-btn">
												<button class="btn"><?php echo !empty($avg_rates['rate_text'])?$avg_rates['rate_text']:''; ?> <?php echo !empty($avg_rates['cal_avg_rates'])?$avg_rates['cal_avg_rates']:''; ?></button>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-12">
										<div class="guest-reviews-details">
											<div class="smalldesc">
												<div class="guest-reviews-details-top">
													<a href="<?php echo base_url('resort-detail?resort_id='.base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name);?></a>
													<?php if($story->verified_status==1){ ?>
													<div>
														<img src="<?php echo  FRONT_THEAM_PATH ;?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
														<span class="verified">Stay Verified</span>
													</div>
													<?php } ?>
												</div>
												<p class="mt-2">
													<?php echo ucwords($story->my_experience);?>
												</p>
												<div class="guest-reviews-rating-details">
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Stay date</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->traveller_date)?date('d F Y', strtotime($story->traveller_date)):''; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Holiday Type</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->category_name)?' '.ucfirst($story->category_name):'-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Villa & Suite</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->name_of_villa)?ucfirst($story->name_of_villa):'-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Length of Stay</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->nights_stayed)?ucfirst($story->nights_stayed):'-';?> nights </div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Visit to Maldives</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->maldives_visits)?ucfirst($story->maldives_visits):'-';?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Visit to this property</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->hotel_visits)?ucfirst($story->hotel_visits):'-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Exceptional Staff members</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->staff_name)?ucfirst($story->staff_name):'-'; ?></div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">I recommend this property to</div>
															<div class="guest-reviews-rating-text"><?php echo !empty($story->staff_name)?ucfirst($story->staff_name):'-'; ?></div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Staff Friendliness</div>
															<div class="guest-reviews-rating-text">
															<?php 
																for($nu=1;$nu<=5;$nu++) {
   																	echo ($nu<=$story->staff_friendliness && !empty($story->staff_friendliness))?'<i class="fa fa-star YellowStar" aria-hidden="true"></i> ':'<i class="far fa-star YellowStar" aria-hidden="true"></i> ';
																} 
															?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Accommodation</div>
															<div class="guest-reviews-rating-text">
															<?php
																for($nu=1;$nu<=5;$nu++){
																	echo ($nu<=$story->villa&&!empty($story->villa))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																}
															?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Facilities</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->facilities&&!empty($story->facilities))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Kids Facilities</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->kids_facilities&&!empty($story->kids_facilities))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Snorkeling</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->over_all&&!empty($story->over_all))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Services</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->services&&!empty($story->services))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Dining</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->dine_wine&&!empty($story->dine_wine))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Wellness</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->spa&&!empty($story->spa))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Beach</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->beach&&!empty($story->beach))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
														<div class="col-lg-3 col-md-6 col-6 mb-4">
															<div class="guest-reviews-rating-title">Location</div>
															<div class="guest-reviews-rating-text">
																<?php
																	for($nu=1;$nu<=5;$nu++){
   																		echo ($nu<=$story->location&&!empty($story->location))?'<i class="fa fa-star YellowStar"></i> ':'<i class="far fa-star YellowStar"></i> ';
																	}
																?>
															</div>
														</div>
													</div>
													<hr />
												</div>
												<div class="guest-reviews-gallery">
													<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Image11.png" alt="" class="img-fluid mr-2">
													<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Image2.png" alt="" class="img-fluid mr-2">
													<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Image3.png" alt="" class="img-fluid mr-2">
													<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Image2.png" alt="" class="img-fluid mr-2">
													<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Image3.png" alt="" class="img-fluid mr-2">
												</div>
												<div class="guest-reviews-share-link my-2">
													<div class="d-flex align-items-center">
														<span>Do you find this helpful?</span>
														<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Helpful.png" alt="Helpful.png" class="img-fluid ml-2">
													</div>
													<div class="d-flex align-items-center ml-2">
														<span>Share</span>
														<img src="<?php echo  FRONT_THEAM_PATH ;?>images/share1.png" alt="share1.png" class="img-fluid ml-2">
													</div>
												</div>
											</div>
											<div class="review-read-more-container">
												<a href="#" class="review-read-more btn">Read more</a>
											</div>
										</div>
									</div>
								</div>
								<hr />
							<?php			
						}
					}
				?>
			</div>
		</div>
	</section>
	
	
	<section id="faq-section">
	    <div class="container">
		<div class="faq">
			<div class="faq-title">
				<h2>FREQUENTLY ASKED QUESTIONS</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
    			<div class="accordion_container w-100" id="faq_result">
    				<?php 
         				if($faqs) {
        					foreach($faqs as $faq){
    							?>
    								<div class="accordion-content">
    									<div class="accordion_head"><?php echo $faq->question;?>
        									<span class="plusminus"><i class="fa fa-plus"></i></span>
        									<input type="hidden" name="offset" class="faq_offset" value="0"/>
    								    </div>
    									<div class="accordion_body" style="display: none;">
    										<?php echo $faq->answer;?>
    									</div>
    								</div>
    							<?php 
    						} 
    					} 
    				?>
    			</div>
		</div>
		</div>
    	<div class="text-center mt-3 mb-3">
            <button type="button" class="new_discover_more " onclick="faq_filter_more();">View More</button>
            <input type="hidden" name="limit" id="faq_limit" value="5"/>
        </div>
	</section>
	
<!--</div>-->


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
<div class="modal fade" id="amenities_details" tabindex="-1" role="dialog" aria-labelledby="amenities_details" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="amenities_details_title">Room Amenities</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" id="amenities_details_data"></div>
      </div>
   </div>
</div>
<div class="modal fade" id="resort_map" tabindex="-1" role="dialog" aria-labelledby="resort_map" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="resort_map_details_title">Resort Map</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="resort_map_details_data">
      		    <!--<img src="http://demogswebtech.com/maldives/uploads/resorts/thumbnails/500_7785dc97bed9031ca2db2aff0b510389.jpg">-->
      		</div>
    	</div>
  	</div>
</div>


<div class="modal fade" id="Modal_FloorPlan" tabindex="-1" role="dialog" aria-labelledby="Modal_FloorPlan" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Floor Plan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			<img src="" id="FloorPlanImage" alt="FloorPlanImage" style="width:100%" />
			</div>
		</div>
	</div>
</div>

<!--<div class="modal fade show" id="resort_map" tabindex="-1" role="dialog" aria-labelledby="facilities_details" aria-modal="true" >-->
<!--	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">-->
<!--    	<div class="modal-content">-->
<!--      		<div class="modal-header">-->
<!--        		<h5 class="modal-title" id="facilities_details_title">Resort Map</h5>-->
<!--        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          			<span aria-hidden="true">×</span>-->
<!--        		</button>-->
<!--      		</div>-->
<!--      		<div class="modal-body" id="facilities_details_data"><div class="not-found">-->
                    
<!--                <img src="http://demogswebtech.com/maldives/uploads/resorts/thumbnails/500_7785dc97bed9031ca2db2aff0b510389.jpg">-->
<!--                </div>-->
<!--    	</div>-->
<!--  	</div>-->
<!--</div>-->



<script type="text/javascript">
function amenities_details(id) {
      $.ajax({ 
         url:base_url+"home/accommodation_amenities_details",
         type:"GET",
         data:{id:id}, 
         success: function(html){
            $('#amenities_details_data').html(html);
         }                
      }); 
   }
  function facilities_details(resort_id) {
    $.ajax({ 
          url:"<?php echo base_url();?>home/facilities_details",
          type:"GET",
          data:{resort_id:resort_id}, 
          success: function(html){
			  $('#facilities_details_data').html(html);
          }                
    }); 
  }
  function resort_map(resort_id) {
    $.ajax({ 
          url:"<?php echo base_url();?>home/resort_map",
          type:"GET",
          data:{resort_id:resort_id}, 
          success: function(html){
			  $('#resort_map_details_data').html(html);
          }                
    }); 
  }
$(document).ready(function(){
	$( "#mySeachTextBox" ).blur(function() {
		$('#mySeachButton').show();
	  	$('#divmySeachTextBox').hide();
	});
  $("#mySeachButton").click(function(){
	  $('#mySeachButton').hide();
	  $('#divmySeachTextBox').show();
	  $('#mySeachTextBox').focus();

  });
  $(".resort_toggle").click(function(){

   var resort_id =  $(this).attr('id');

    //$(".resort-more-info_"+resort_id).slideToggle();

    $(".resort-more-info").slideToggle();

    $('.resort_toggle').addClass('shrink');

  });

  /* $(".get_details").click(function(){

   var resort_id =  $(this).attr('rel');

   window.location.href = "<?php echo base_url();?>resort-detail?resort_id="+resort_id;

  }); */

});

function save_accommodation_like_unlike(accommodation_id){

      $.ajax({

         url:'<?php echo base_url(); ?>home/save_accommodation_like_unlike',

         type:'GET',

         data:{'accommodation_id':accommodation_id}, 

         success:function(html){

            var response = $.parseJSON(html);

            if(response.status=='not_login_in'){

               window.location.href = response.login_url

            }else if(response.status=='true'){

               $('#accommodation_like_unlike_btn_'+accommodation_id).html(response.html);

            }else{

                $('#accommodation_like_unlike_message_'+accommodation_id).html(response.message);

            }

         }

      });

   }

   function save_exprince_like_unlike(exprience_id){ 

      $.ajax({

         url:'<?php echo base_url(); ?>home/save_exprince_like_unlike',

         type:'GET',

         data:{'exprience_id':exprience_id}, 

         success:function(html){

            var response = $.parseJSON(html);

            if(response.status=='not_login_in'){

               window.location.href = response.login_url

            }else if(response.status=='true'){

               $('#experince_like_unlike_btn_'+exprience_id).html(response.html);

            }else{

                $('#exprience_like_unlike_message_'+exprience_id).html(response.message);

            }

         }

      });

   }   
   $('.FloorPlanLink').on('click', function() {
        $('#FloorPlanImage').attr('src',$(this).attr('myurl'));
        $('#Modal_FloorPlan').modal('show');
    });
</script>

    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            autoplay:false
            autoplayTimeout:4000
            autoplayHoverPause:false
        });
    </script>
    
    <script>
        var showChar = 600;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more";
    var lesstext = "Hide Content";
    $('.about-more').each(function() {
            var content = $(this).html();
            if(content.length > showChar) {
    
                var c = content.substr(0, showChar);
                var h = content.substr(showChar, content.length - showChar);
    
                var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
    
                $(this).html(html);
            }
    
        });
        
    </script>

  
    
 <script>
    function faq_filter_more(){
        $('.faq_offset').val(parseInt($('.faq_offset').val())+5);
        
        $.ajax({ 
            url:base_url+"home/faq_filter_more",
            type:"POST",
            data:{
              offset :$('.faq_offset').val(),
              limit :$('#faq_limit').val()
            },
            dataType:'json',
            success: function(html){
              $('#faq_result').append(html);
              if($('.faq_offset').val() == 10){
                $('.new_discover_more').hide();
              }
            }                
        }); 
    }
 </script>   
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>

