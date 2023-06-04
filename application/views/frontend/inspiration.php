<style>
   .checkRadioContainer {
   max-width: 10em;
   background: #35c1ba;
   box-shadow: 1px 1px 6px 0px #2f9aef;
   border-radius: 20px;
   }
   .checkRadioContainer  > input + i {
   visibility: hidden;
   color: #0d13b7;
   margin-left: -0.5em;
   font-size: 16px;
   }
   .checkRadioContainer  > input:checked + i {
   visibility: visible;
   }
   .demo_input{
   opacity: 0;
   }
 
 /*======resport section css=====
 ===================*/
#section-about_inspiration{
    padding-top: 20px;
}
section#Resort-section {
    padding-top:80px;
}
/*section scroll  tabs*/
.row.nav-section-tabs{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto;
    width:100%;
    margin-top:40px;
}
.row.nav-section-tabs li.tab-list{
    list-style:none;
}
.row.nav-section-tabs li.tab-list a{
    font-weight:700;
    color:#444;
    text-transform:uppercase;
}
#Resort-section .inspiration-description a.morelink {
    display: inline;
    font-family: Arial, Times, serif;
    text-decoration: underline;
    color: #1A3B64;
}
/*featured resort*/
#Resort-section .resort-wrap {
    margin-top: 30px;
}
#Resort-section .resorts-description a.morelink {
    color: #444;
    font-weight: 600;
}
section#villas-and-Suits {
    padding-top: 80px;
}
section#villas-and-Suits  .Villas-description{
    padding-bottom: 40px;
}
section#villas-and-Suits  select#villa_rooms{
    background: #2EC4BB;
    border-radius: 50px;
    font-weight:700;
}
section#villas-and-Suits  select{
    /*border: none !important;*/
}
section#villas-and-Suits  label.btn.expbutton{
    color: #444;
    font-weight: 700;
    border-radius: 50px;
    /*background: #dce3ef;*/
    text-transform:uppercase;
     border: 2px solid #2EC4BB;
}
section#villas-and-Suits .blogs-items-container label.btn.expbutton:nth-child(3), label.btn.expbutton:nth-child(4){
   display:none;
}
/*section#villas-and-Suits .blogs-items-container label.btn.expbutton:nth-child(6){*/
/*    position:absolute;*/
/*    right:10px;*/
/*}*/
/*section#villas-and-Suits .resort-inner-pill-container {*/
/*    display: flex;*/
/*    width: 60%;*/
/*    justify-content: space-evenly;*/
/*}*/
/*======featured villas css*/
.badgebox:checked + span {
    background: #2ec4bb;
    border-radius: 50px;
}
section#villas-and-Suits a.morelink{
    display: inline;
    font-family: Arial, Times, serif;
    text-decoration: underline;
    color: #1A3B64;
}
/*Experiences css*/
section#experiences {
    padding-top: 80px;
    padding-bottom:40px;
}
section#experiences .signature-experiences{
    margin-top: 30px;
}
section#experiences .resort-inner-pill-container.Exp-tab-filter{
    display: none;
}
section#experiences a.morelink{
    display: inline;
    font-family: Arial, Times, serif;
    text-decoration: underline;
    color: #1A3B64;
}
section#villas-and-Suits select#villa_rooms{
    width:10rem;
}
@media(max-width:768px){
    section#villas-and-Suits{
        padding-top:0;
    }
    section#villas-and-Suits .blogs-items-container label.btn.expbutton:nth-child(6){
        position:inherit;
    }
    .row.nav-section-tabs{
        margin-top:10px;
    }
    .row.new_inspiration_pages.nav-section-tabs li.tab-list{
        margin:0px 20px;
    }
    section#villas-and-Suits .villas-pill .resort-inner-pill-container .badgebox:checked + span{
         width: max-content;
    }
}
@media (max-width:420px){
 .row.new_inspiration_pages.nav-section-tabs li.tab-list{
    margin: 0px 4px;
   }
}
</style>
<section>
   <div class="resort-inner-header-banner inspiration_slider_inner">
      <div class="resort-inner-slider  owl-carousel owl-theme">
         <?php
            $img=0; 
            if(!empty($caption_imgs)) {
            foreach($caption_imgs as $caption_img){
                if(file_exists('uploads/caption/'.$caption_img->image_name)){
                ?>
         <div class="box"  style="background-image:url('<?php echo base_url('uploads/caption/' . $caption_img->image_name); ?>')">
            <div class="resort-inner-header-title">
               <h1><?php echo !empty($caption->caption_sub_title)?$caption->caption_sub_title:''; ?>...</h1>
               <h2><?php echo !empty($caption->caption_title)?ucwords($caption->caption_title):''; ?></h2>
               <!--<h2><?php //echo !empty($caption->caption_title)?strtoupper($caption->caption_title):''; ?></h2>-->
            </div>
         </div>
         <?php 
            }
            } }
            ?>
      </div>
   </div>
</section>
    <section id="section-about_inspiration">
	<div class="about py-2 m-0">
		<div class="about-title">
			<h2>ABOUT US</h2>
			<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="about-resort-more">
				Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve. 			</span>
		</div>
	</div>
</section>	

<div class="container">
    <div class="row new_inspiration_pages nav-section-tabs">
        <!--<div class="col-md-3">-->
            
        <!--</div>-->
        <!--<div class="col-md-2">-->
          <ul>
            <li class="tab-list"><a href="#Resort-section">Resorts</a></li>
          </ul>
        <!--</div>-->
        <!--<div class="col-md-2">-->
          <ul>
            <li class="tab-list"><a href="#villas-and-Suits">Villas</a></li>
          </ul>
        <!--</div>-->
        <!--<div class="col-md-2">-->
          <ul>
           <li class="tab-list"><a href="#experiences">Experiences</a></li>
          </ul>
        <!--</div>-->
        <!--<div class="col-md-3">-->
            
        <!--</div>-->
    </div>
</div>
   <!--<div class = "container">-->
   <!--      <div class = "row">-->
   <!--         <nav class = "col-sm-3 col-4" id = "myScrollspy">-->
   <!--            <ul class = "nav nav-pills flex-column">-->
   <!--               <li class = "nav-item">-->
   <!--                  <a class = "nav-link active" href = "#Resort-section">Resort-section</a>-->
   <!--               </li>-->
   <!--               <li class = "nav-item">-->
   <!--                  <a class = "nav-link" href = "#villas-and-Suits">Villas</a>-->
   <!--               </li>-->
   <!--                <li class = "nav-item">-->
   <!--                  <a class = "nav-link" href = "#experiences">Experiences</a>-->
   <!--               </li>-->
   <!--            </ul>-->
   <!--         </nav>-->
   <!--     </div>-->
   <!-- </div>-->
    <!--Scrollspy tabs html end-->
    <section id="Resort-section">
      <div>
          <div class="container">
                <div class="inspiration">
        				<div class="inspiration-title" style="text-transform:uppercase">
        					<h2>FEATURED RESORTS</h2>
        					<img src="<?php echo base_url();?>/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
        				</div>
        	    </div>
         <!--<ul class="nav nav-tabs mx-auto" id="inspiration-tab" role="tablist">-->
         <!--   <li class="nav-item" role="presentation">-->
         <!--      <a class="nav-link  active" id="resort-tab" data-toggle="tab" href="#resort" role="tab"-->
         <!--         aria-controls="resort" aria-selected="true">Resorts</a>-->
         <!--   </li>-->
         <!--   <li class="nav-item" role="presentation">-->
         <!--      <a class="nav-link" id="villa-resorts-tab" data-toggle="tab" href="#villa-resorts" role="tab"-->
         <!--         aria-controls="villa-resorts" aria-selected="false">Villa & Suites</a>-->
         <!--   </li>-->
         <!--   <li class="nav-item" role="presentation">-->
         <!--      <a class="nav-link" id="experiences-tab" data-toggle="tab" href="#experiences" role="tab"-->
         <!--         aria-controls="experiences" aria-selected="false">Experiences</a>-->
         <!--   </li>-->
         <!--</ul>-->
         <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="resort" role="tabpanel"
               aria-labelledby="resort-tab">
                  <div class="blogs-items-container">
                     <div class="container">
                        <div class="row">
                           <div class="col-lg-3 col-md-12 overlay" id="myNav">
                               <div class="mr-lg-3 mr-md-3">
                              <div class="blog-sidebar mb-4">
                                 <div class="blog-sidebar-header">
                                    <span>Resort</span>
                                    <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                 </div>
                                 <form action="" id="inspiration_resort_filter_frm" method="post">
                                    <div class="blog-sidebar-items">
                                       <div class="blog-sidebar-item">
                                          <div class="form-group">
                                             <select class="custom-select" id="exp_resort" name="exp_resort" onchange="inspiration_resort_filter();">
                                                <option selected value="">Select</option>
                                                <?php if(!empty($resorts)){
                                                         foreach($resorts as $resort){?>
                                                            <option value="<?php echo $resort->id; ?>"><?php echo $resort->resort_name; ?></option>
                                                      <?php }
                                                      } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              
                              <div class="blog-sidebar">
                                 <div class="blog-sidebar-header">
                                    <span>Inspire Me By</span>
                                 </div>
                                <div class="border_new_y"> 
                                    <div class="blog-sidebar-items-title my-2">
                                       <span class="blog-sidebar-items-title-text">Holiday Styles</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    
                                    <div class="blog-sidebar-items" >
                            

                                       <?php 
                                       
                                    if(is_array($holidays)){
                                       foreach($holidays as $h){;?>
                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" class="custom-control-input" id="holidays_fil_<?php echo $h->id; ?>" <?php if($this->input->get('holiday_id')&&$this->input->get('holiday_id')==$h->id){echo 'checked';} ?> name="holidays[]" value="<?php echo $h->id; ?>" onclick="inspiration_resort_filter();">
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="holidays_fil_<?php echo $h->id;?>"><?php echo $h->holiday_name;?> </label>
												</div>
											</div>
										</div>
                  <?php } }?>                                        
                            
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4 ">
                                       <span class="blog-sidebar-items-title-text">Category</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" >

                                    <?php 
                                    if(is_array($category)){
                                    foreach($category as $c){;?>
                    <div class="blog-sidebar-item new_one_Category">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" class="custom-control-input" id="categorys_fil_<?php echo $c->id; ?>" name="categorys[]" value="<?php echo $c->id; ?>" onclick="inspiration_resort_filter();">
                      					<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="categorys_fil_<?php echo $c->id;?>">
                                                        <div class="star-rating test1"> 
                                                          <?php for($i=0;$i<$c->no_of_star;$i++){ ?>
                                                            <i class="fa fa-star" aria-hidden="true"></i> 
                                                          <?php } ?>
                                                        </div>
                                                    <?php echo $c->category_name;?>
                                                  </label>
                    						    </div>
											</div>
										</div>
                                       <?php } }?>
                                       
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Location (Atoll)</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">

                                    <?php foreach($location as $l){;?>
                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" class="custom-control-input" name="atoll[]" id="location_<?php echo $l->id;?>"  value="<?php echo $l->id; ?>"  onclick="inspiration_resort_filter();">
                      
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="location_<?php echo $l->id;?>"> <?php echo $l->state_name;?> </label>
												</div>
											</div>
										</div>
                  <?php } ?>

                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Transfer mode</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">

                                    <?php 
                                    if(is_array($transfer_mode)){
                                    foreach($transfer_mode as $t){;?>
                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" class="custom-control-input" id="airports_fil_<?php echo $t->id; ?>" name="airports[]" value="<?php echo $t->id; ?>" onclick="inspiration_resort_filter();">
                      
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="airports_fil_<?php echo $t->id;?>"> <?php echo $t->airport_type_name;?> </label>
												</div>
											</div>
										</div>
                  <?php } }?>


                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Resort facilities</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                    <?php 
                                    
                                    if(is_array($facilities)){
                                    foreach($facilities as $fac){;?>
                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" class="custom-control-input" id="facilities_fil_<?php echo $fac->id; ?>" name="facilities[]" value="<?php echo $fac->id; ?>" onclick="inspiration_resort_filter();">
                      
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="facilities_fil_<?php echo $fac->id;?>"><?php echo $fac->facility_name;?></label>
												</div>
											</div>
										</div>
                  <?php } }?> 

                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Sports & entertainment</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">

                                    <?php 
                                    
                                    if(is_array($sports)){
                                    foreach($sports as $sport){;?>
                                        <div class="blog-sidebar-item">
                        					<div class="pretty p-image p-plain">
                                                    <input type="checkbox" class="custom-control-input" id="sport_fil_<?php echo $sport->id; ?>" name="sports[]" value="<?php echo $sport->id; ?>" onclick="inspiration_resort_filter();">
                      
												<div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="sport_fil_<?php echo $sport->id;?>"> <?php echo $sport->sport_name;?> </label>
												</div>
											</div>
										</div>
                                    <?php } }?>

                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">No. Of Rooms</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="no_of_villas[]" value="1,10" class="custom-control-input" id="villas_count_10" onclick="inspiration_resort_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="villas_count_10"> 1 - 10 Villas </label>
												</div>
											</div>
										</div>

                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" name="no_of_villas[]" value="11,50" class="custom-control-input" id="villas_count_50" onclick="inspiration_resort_filter();">
                        <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="villas_count_50"> 11 - 50 Villas </label>
												</div>
											</div>
										</div>

                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" name="no_of_villas[]" value="51,100" class="custom-control-input" id="villas_count_100" onclick="inspiration_resort_filter();">
                        <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="villas_count_100"> 51 - 100 Villas </label>
												</div>
											</div>
										</div>


                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                      <input type="checkbox" name="no_of_villas[]" value="101,150" class="custom-control-input" id="villas_count_150" onclick="inspiration_resort_filter();">
                        <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="villas_count_150"> 100 - 150 Villas</label>
												</div>
											</div>
										</div>


                    <div class="blog-sidebar-item">
											<div class="pretty p-image p-plain">
                                                <input type="checkbox" name="no_of_villas[]" value="150,0" class="custom-control-input" id="villas_count_151" onclick="inspiration_resort_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="villas_count_151"> More than 151 Villas</label>
												</div>
											</div>
										</div>
                                    </div>
                                 </form>
                                </div> 
                              </div>
                              </div>
                           </div>
                           <div class="col-lg-9 col-md-12 mx-auto blog-innner-cards resort_new_dep">
                               <div class="inspiration-description">
                					<span class="more">
                						Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant c<span class="moreellipses" style="display: none;">...&nbsp;</span><span class="morecontent"><span style="display: inline;">oral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
                					</span>&nbsp;&nbsp;<a href="" class="morelink less">Read less</a></span></span>
                				</div>
                              <button class="blog-filter-btn btn my-lg-4" ><i class="fa fa-sliders-h mr-2"></i>Filter</button>
                              
                              <div class="row resort-wrap" id="inspiration_resort_result">

                              <?php 
                                                    if(!empty($resorts)){
                                                        foreach ($resorts as $resort) {
                                                            $resportAmenities = !empty($resort->amenities)?explode(',', $resort->amenities):'';
                                                            $international_airports = $this->developer_model->user_international_airports($resort->id); 
                                                            $images = $this->common_model->get_result('images', array('item_id'=>$resort->id, 'type'=>'resort')); 
                                                            if(!empty($images[0]->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$images[0]->image_name)) {
                                                                $ImagePath = base_url().'uploads/resorts/thumbnails/500_'.$images[0]->image_name;
                                                            } else {
                                                                $ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic1.jpg';
                                                            }
                                                            
                                                            ?>
                                                                <div class="col-lg-6 col-md-6 col-12 mb-lg-4 new_resorts_int">
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
                                                                                                <?php //echo !empty($resort->resort_name)?character_limiter(ucfirst($resort->resort_name),25):'';?>
                                                                                                <?php echo !empty($resort->resort_name)?$resort->resort_name:'';?>
                                                                                            </a>
                                                                                            
                                                                                        </div>
                                                                                        <div class="d-flex">
                                                                                            <?php 
										                                                        $star_category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));
                                                                                                if(!empty($star_category->no_of_star)) {
                                                                                                    for($i=0;$i< $star_category->no_of_star;$i++){ 
                                                                                                        ?>
                                                                                                            <i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
                                                                                                        <?php 
                                                                                                    } 
                                                                                                }
                                                                                            ?>
                                                                                            <span id="new_restot" class="description"><?php if(!empty($star_category->category_name)) { echo $star_category->category_name; }?></span>
                                                                                            
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
                                                                                        <?php if(!empty($avg_rates['cal_avg_rates'])) {?><div class="reviews-circle"><?php echo $avg_rates['cal_avg_rates']; ?></div> <?php }?>
                                                                                        <div class="reviews-text ml-1"><?php if(!empty($resort->total_reviews)) { echo $resort->total_reviews.' Reviews'; } ?> </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="img-bottom-contianer-description smalldesc">
                                                                                <span id="new_world_yt" class=""><?php echo !empty($resort->resort_description)?character_limiter($resort->resort_description):'';?></span>
                                                                                <?php 
                                                                                    if(!empty($resort_highlights[$resort->id])) {?>
                                                                                       <div class="facilities">
                                                                                          <div class="facilities-title">Highlights</div>
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
                                                                                 </div>
                                                                                    <?php }?>	
                                                                                <!--<div class="transfer-types">-->
                                                                                    <!--<div class="transfer-types-title">Transfer Types</div>-->
                                                                                    <!--<div class="transfer-types-items row mt-2">-->
                                                                                        <?php 
                                                                                            // if(!empty($resort->airportType)) {
                                                                                            //     foreach($resort->airportType as $key=>$val) {
                                                                                                    
                                                                                                    ?>
                                                                                                        <!--<div class="transfer-types-item col-12"><?php echo $resort->airportType[$key]->airport_type_name;?> -->
                                                                                                            <?php 
                                                                                                            // $hours = "";
                                                                                                            // $Minutes = "";
                                                                                                            
                                                                                                            // if($resort->airportType[$key]->hour1 > 0) {
                                                                                                            //     $hours .= $resort->airportType[$key]->hour1." Hours ";
                                                                                                            // }
                                                                                                            // if($resort->airportType[$key]->minuts1 > 0) {
                                                                                                            //     $Minutes .= $resort->airportType[$key]->minuts1." Minutes ";
                                                                                                            // }
                                                                                                            // if($resort->airportType[$key]->hour2 > 0) {
                                                                                                            //     $hours .= $resort->airportType[$key]->hour2." Hours ";
                                                                                                            // }
                                                                                                            // if($resort->airportType[$key]->minuts2 > 0) {
                                                                                                            //     $Minutes .= $resort->airportType[$key]->minuts2." Minutes ";
                                                                                                            // }
                                                                                                            // if($hours!="" || $Minutes!="") {
                                                                                                            //     echo "(".$hours.$Minutes.")";
                                                                                                            // }
                                                                                                            ?>
                                                                                                        <!--</div>-->
                                                                                                    <?php
                                                                                            //     }

                                                                                            // }
                                                                                        ?>
                                                                                    
                                                                                <!--    </div>-->
                                                                                <!--</div>-->
                                                                                <div class="ideal">
                                                                                    <?php //echo "<pre>"; var_dump($holidays); die;
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
                            														    <div>
                            																<a href="javascript:void(0);" class="ideal-link resort_map" data-toggle="modal" data-target="#resort_map" onclick="resort_map('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Resort Map</a>
                            															</div>
                                                                                        <div>
                                                                                            <a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#facilities_details" onclick="facilities_details('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Facilities</a>
                                                                                        </div>
                                                                                    </div>
                                                                                <!--</div>-->
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
                              <!-- <nav aria-label="..." class="pagination-container">
                                 <ul class="pagination">
                                    <li class="page-item">
                                       <span class="page-link"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Left_side.png" alt="Left_side.png"
                                          class="img-fluid"></span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                       <span class="page-link">
                                       2
                                       <span class="sr-only">(current)</span>
                                       </span>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                                    <li class="page-item"><a class="page-link" href="#">9</a></li>
                                    <li class="page-item">
                                       <a class="page-link" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Right_side.png"
                                          alt="Right_side.png" class="img-fluid"></a>
                                    </li>
                                 </ul>
                              </nav> -->
                           </div>
                        </div>
                     </div>
                  </div>
          </div>
      </div>
    </section>
    <!--End resort section html-->
    
            <!--hide not requird-->
            <!--<div class="tab-pane fade pt-5" id="villa-resorts" role="tabpanel" aria-labelledby="villa-resorts-tab">-->
            <!--   <section>-->
                  
            <!--   </section>-->
            <!--</div>-->
            <!--<div class="tab-pane fade pt-5" id="experiences" role="tabpanel" aria-labelledby="experiences-tab">-->
            <!--   <section>-->
                  
            <!--   </section>-->
            <!--</div>-->
            
    
    <!--villas section html-->
    <section id="villas-and-Suits">
                 <div class="inspiration">
        				<div class="inspiration-title" style="text-transform:uppercase">
        					<h2> VILLAS & RESIDENCES</h2>
        					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
        				</div>
        	    </div>
                <div class="blogs-items-container">
                     <div class="container">
                        <div class="row">
                           <div class="col-lg-3 col-md-12 overlay " id="myNav2">
                               <div class="mr-lg-3 mr-md-3">
                              <div class="blog-sidebar mb-4 ">
                                 <div class="blog-sidebar-header">
                                    <span>Resort</span>
                                    <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                 </div>
                                 <form action="" id="inspiration_accommodation_filter_frm" method="post" class="mr-lg-2">
                                    <input type="hidden" name="accommodation_offset" id="accommodation_offset" value="0"/>
                                    <input type="hidden" name="accommodation_limit" id="accommodation_limit" value="4"/>
                                    <input type="hidden" name="accommodation_count" id="accommodation_count" value="<?php echo count($expriencesCount); ?>"/>
                                    <div class="blog-sidebar-items">
                                       <div class="blog-sidebar-item">
                                          <div class="form-group">
                                             <select class="custom-select" id="acc_resort" name="acc_resort" onchange="inspiration_accommodation_filter();">
                                                <option value=''>Select Resort</option>
                                                <?php if(!empty($resorts)){
                                                   foreach($resorts as $resort){?>
                                                <option value="<?php echo $resort->id; ?>"><?php echo $resort->resort_name; ?></option>
                                                <?php }
                                                   } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                              </div>
                              <div class="blog-sidebar">
                                  
                                 <div class="blog-sidebar-header">
                                    <span>Inspire Me By</span>
                                 </div>
                                 <div class="border_new_y"> 
                                    <div class="blog-sidebar-items-title my-2">
                                       <span class="blog-sidebar-items-title-text">Holiday Styles</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items">
                                       <?php 
                                        if(is_array($holidays)){
                                          foreach($holidays as $h){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input"  id="acc_holidays_<?php echo $h->id;?>" name= "acc_holidays[]"  value="<?php echo $h->id; ?>"  onclick="inspiration_accommodation_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_holidays_<?php echo $h->id;?>"><?php echo $h->holiday_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } }?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4 ">
                                       <span class="blog-sidebar-items-title-text">Category</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items new_one_Category">
                                       <?php 
                                       if(is_array($category)){
                                       foreach($category as $c){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="acc_category_<?php echo $c->id;?>" name="acc_category[]" value="<?php echo $c->id;?>" onclick="inspiration_accommodation_filter();" >
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_category_<?php echo $c->id;?>">
                                                   <div class="star-rating"> 
                                                      <?php for($i=0;$i<$c->no_of_star;$i++){ ?>
                                                      <i class="fa fa-star" aria-hidden="true"></i> 
                                                      <?php } ?>
                                                   </div>
                                                   <?php echo $c->category_name;?>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } }?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Location (Atoll)</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <?php foreach($location as $l){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="acc_location_<?php echo $l->id;?>" name= "acc_location[]"  value="<?php echo $l->id; ?>"  onclick="inspiration_accommodation_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_location_<?php echo $l->id;?>"> <?php echo $l->state_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Transfer mode</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       if(is_array($transfer_mode)){
                                       foreach($transfer_mode as $t){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="acc_transfer_<?php echo $t->id;?>" name= "acc_transfer[]" value="<?php echo $t->id; ?>"   onclick="inspiration_accommodation_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_transfer_<?php echo $t->id;?>"> <?php echo $t->airport_type_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } }?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Resort facilities</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       if(is_array($facilities)){
                                       foreach($facilities as $fac){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="acc_facility_<?php echo $fac->id;?>" name= "acc_facility[]" value="<?php echo $fac->id; ?>"   onclick="inspiration_accommodation_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_facility_<?php echo $fac->id;?>"><?php echo $fac->facility_name;?></label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Sports & entertainment</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       
                                       if(is_array($sports)){
                                       foreach($sports as $sport){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="acc_sports_<?php echo $sport->id;?>" name= "acc_sports[]"  value="<?php echo $sport->id; ?>"  onclick="inspiration_accommodation_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_sports_<?php echo $sport->id;?>"> <?php echo $sport->sport_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } }?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">No. Of Rooms</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <div class="blog-sidebar-item">
											
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="acc_room_count" value="1,10" class="custom-control-input" id="acc_room_count10" onclick="inspiration_accommodation_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="acc_room_count"> 1 - 10 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="acc_room_count" value="11,50" class="custom-control-input" id="acc_room_count50" onclick="inspiration_accommodation_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="acc_room_count50"> 11 - 50 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="acc_room_count" value="51,100" class="custom-control-input" id="acc_room_count100" onclick="inspiration_accommodation_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="acc_room_count100"> 51 - 100 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="acc_room_count" value="101,150" class="custom-control-input" id="acc_room_count150" onclick="inspiration_accommodation_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="acc_room_count150"> 101 - 150 Rooms </label>
												</div>
											</div>
                                           
                                           
                                           
                                          <!--<div class="form-group">-->
                                          <!--   <select class="custom-select" name="acc_room_count" id="acc_room_count" onclick="inspiration_accommodation_filter();">-->
                                          <!--      <option value="">Select</option>-->
                                          <!--      <option value="1,10" >1 - 10 Rooms</option>-->
                                          <!--      <option value="11,50">11 - 50 Rooms</option>-->
                                          <!--      <option value="51,100">51 - 100 Rooms</option>-->
                                          <!--      <option value="101,150">100 - 150 Rooms</option>-->
                                          <!--   </select>-->
                                          <!--</div>-->
                                       </div>
                                    </div>
                                </div> 
                              </div>
                              </div>
                           </div>
                           
                           <div class="col-lg-9 col-md-12 mx-auto blog-innner-cards">
                               <div class="inspiration-description">
                					<span class="more">
                						Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant c<span class="moreellipses" style="display: none;">...&nbsp;</span><span class="morecontent"><span style="display: inline;">oral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
                					</span>&nbsp;&nbsp;<a href="" class="morelink less">Read less</a></span></span>
                				</div>
                              <button class="blog-filter-btn2 btn my-4"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
                               
                              <div class="villas-pill mb-4 my-4">
                                 <div>
                                    <select class="custom-select" name="villa_rooms" id="villa_rooms" style="border: none;" onchange="inspiration_accommodation_filter();">
                                       <option value="">No. of Villas</option>
                                          <?php 
                                             for($i=1;$i<10;$i++) {
                                             ?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                             <?php
                                             }
                                          ?>
                                          <option value="10+">10+</option>
                                    </select>
                                 </div>
                                 <div class="resort-inner-pill-container">
                                    <?php 
                                       foreach($accommodations_categories as $acc_cat){
                                          ?>
                                    <label for="<?php echo $acc_cat->villa_type."_".$acc_cat->id;?>" class="btn expbutton"  onclick="inspiration_accommodation_categories(<?php echo $acc_cat->id; ?>);">
                                    <input type="checkbox" id="<?php echo $acc_cat->villa_type."_".$acc_cat->id;?>" name="test1" value="<?= $acc_cat->id; ?>"  class="badgebox">
                                    <span><?php echo $acc_cat->villa_type; ?> <i class="fa fa-close"></i></span>
                                    </label>
                                    <?php 
                                       }?>
                                 </div>
                              </div>
                              <div class="row" id="inspiration_accommodation_result">
                                 <?php 
                                    if($accommodations){
                                    foreach($accommodations as $accomm){ 
                                    $villa_type_name = $accomm->room_size." ". "sqm | ".$accomm->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $accomm->villa_type_name;
                                    $ac_images =$this->common_model->get_row('images', array('item_id'=>$accomm->id, 'type'=>'accommodation'));
                                    $resort_villas = $this->common_model->get_row('mal_resorts', array('id'=>$accomm->resort_id));
     	                            $category = $this->common_model->get_row('mal_category', array('id'=>$resort_villas->resort_category));
									    
                                    ?>
                                 <div class="col-lg-6 col-md-6 col-12 mb-lg-4">
                                    <div class="box">
                                       <div class="img-content">
                                          <?php
                                             if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)){?>
                                          <a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                          <img src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$ac_images->image_name ;?>" alt="Resort" class="img-fluid  HomeImage">
                                          </a>
                                          <?php } else{ ?>
                                          <img src="<?php echo FRONT_THEAM_PATH?>images/No_Image_Available.jpg" class="img-fluid  HomeImage">
                                          <?php } ?>
                                          <div class="image-text-container">
                                             <div class="d-flex justify-content-between">
                                                <div class="img-content-title-container">
                                                    <div class="img-content-title new_full_villa">
                                                        <a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                                           <?php echo $accomm->resort_name;?>
                                                        </a>
                                                    </div>
                                                    <div class="img-content-title new_one">
													    <a class=""><?php $state_name = $this->developer_model->resort_detail($accomm->resort_id); ?>
                        								
                        							</div>
                                                    
                                                    
                                                   <div class="d-flex des-star new_letter_s">
                                                       <?php 
															for($i=0;$i< $category->no_of_star;$i++){ 
																?>
																	<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
																	
																<?php 
															} 
														?>
													    <span class="new_tab_hg"><?php echo $category->category_name;?></span>
                                                      <!--<span class="description ml-1"><?php //echo $villa_type_name;?></span>-->
                                                   </div>
                                                   <div class="img-content-title new_one">
                                                       <a class=""><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?>
                                                        <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                                           <?php //echo $villa_type_name;?>
                                                        </a>
                                                    </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div>
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
                                       </div>
                                       <div class="img-bottom-contianer inspiration-readmore new_vills_type_name">
                                          <div class="img-bottom-contianer-description smalldesc">
                                              <div class="featured_villas_img_title new">
                                                  <div class="img-content-title-container">
                                                        <div class="img-content-title new_villa_tittle_one">
                                                            <a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                                               <?php echo $accomm->name_of_villa?>
                                                            </a>
                                                        </div>
                                                        <div class="img-content-title ml-1 new_one_vills">
                                                            <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                                               <?php echo $villa_type_name;?>
                                                            </a>
                                                        </div>
                                                       <!--<div class="d-flex">-->
                                                       <!--   <span class="description ml-1"><?php echo $villa_type_name;?></span>-->
                                                       <!--</div>-->
                                                    </div>
                                                </div>    
                                             <span id="charater" class=""><?php echo $accomm->description;?></span>
                                             
                                             <?php 
                                             if(!empty($resort_highlights[$accomm->resort_id])) {?>
																<div class="facilities">
																	<!--<div class="facilities-title">Highlights</div>-->
																	<div class="facilities-items row mt-2">
																	<?php 
																	foreach($resort_highlights[$accomm->resort_id] as $key=>$val) {?>
																		<!--<div class="facilities-item col-6 col-md-6"><?php echo $val;?></div>-->
																	<?php }?>
																	</div>
														</div>
															<?php }
                                             //print_r($resportAmenities);
                                             ?>	
                                             <div class="transfer-types ">
                                                <div class="transfer-types-title maximum_occupancy">
                                                <span class="occupancy">Maximum Occupancy</span>: 2 adults & 2 kids</div>
                                             </div>
                                             <div class="ideal new_villase">
                                                <a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#amenities_details" onclick="amenities_details('<?php echo !empty($accomm->id)?$accomm->id:''; ?>');">Amenities</a>
                                                <?php 
                                                   if(!empty($accomm->floor_plan)&&file_exists('uploads/resorts/'.$accomm->floor_plan)){
                                                      ?>
                                                         <div><a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$accomm->floor_plan;?>" class="ideal-link FloorPlanLink">Floor Plan</a></div>
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
                                    }?>
                              </div>
                              </form>
                              <div class="text-center">
                                 <!--<button type="button" class="review-btn btn new_discover_more" onclick="inspiration_accommodation_filter_more();">Discover More</button>-->
                                 <button type="button" id="villa_more" data-cat="" class="new_discover_more" onclick="inspiration_accommodation_filter_more();">Discover More</button>
                              </div>
                              <!-- <nav aria-label="..." class="pagination-container">
                                 <ul class="pagination">
                                     <li class="page-item">
                                         <span class="page-link"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Left_side.png" alt="Left_side.png"
                                                 class="img-fluid"></span>
                                     </li>
                                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                                     <li class="page-item active" aria-current="page">
                                         <span class="page-link">
                                             2
                                             <span class="sr-only">(current)</span>
                                         </span>
                                     </li>
                                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                                     <li class="page-item"><a class="page-link" href="#">4</a></li>
                                     <li class="page-item"><a class="page-link" href="#">5</a></li>
                                     <li class="page-item"><a class="page-link" href="#">6</a></li>
                                     <li class="page-item"><a class="page-link" href="#">8</a></li>
                                     <li class="page-item"><a class="page-link" href="#">9</a></li>
                                     <li class="page-item">
                                         <a class="page-link" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Right_side.png"
                                                 alt="Right_side.png" class="img-fluid"></a>
                                     </li>
                                 </ul>
                                 </nav> -->
                           </div>
                        </div>
                     </div>
                  </div>
            </section>
            <!-End villas html--->
            
            <!--exp section html-->
            <section id="experiences">
                <div class="blogs-items-container">
                    <div class="inspiration">
        				<div class="inspiration-title" style="text-transform:uppercase">
        					<h2>SIGNATURE EXPERIENCES</h2>
        					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
        				</div>
        	        </div>
                     <div class="container">
                        <div class="row">
                           <div class="col-lg-3 col-md-12 overlay" id="myNav3">
                               <div class="mr-lg-3 mr-md-3">
                              <div class="blog-sidebar mb-4">
                                 <div class="blog-sidebar-header">
                                    <span>Resort</span>
                                    <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                 </div>
                                 <form action="" id="inspiration_experience_filter_frm"  method="post">
                                    
                                    <!--<form action="" id="resort_experience_filter_frm" method="post">-->
                                    	<input type="hidden" name="experince_offset" id="experince_offset" value="0"/>
                                        <input type="hidden" name="experince_limit" id="experince_limit" value="4"/>
                                        <input type="hidden" name="experince_count" id="experince_count" value="<?php echo count($expriencesCount); ?>"/>
                                        <input type="hidden" name="experince_total" id="experince_total" value="<?php echo !empty($expriences) ? count($expriences) : 0; ?>"/>
                                	    <input type="hidden" name="resort_id" id="resort_id" value="<?php echo !empty($resort->id) ? $resort->id : ''; ?>">
                                	<!--</form>-->
                                    
                                    
                                    
                                    <div class="blog-sidebar-items">
                                       <div class="blog-sidebar-item">
                                          <div class="form-group">
                                             <select class="custom-select" id="exp_resorts" name="exp_resort" onchange="inspiration_experience_filter();">
                                                <option value=''>Select Resort</option>
                                                <?php if(!empty($resorts)){
                                                   foreach($resorts as $resort){?>
                                                <option value="<?php echo $resort->id; ?>"><?php echo $resort->resort_name; ?></option>
                                                <?php }
                                                   } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 
                              </div>
                              <div class="blog-sidebar">
                                 <div class="blog-sidebar-header">
                                    <span>Inspire Me By</span>
                                 </div>
                                 <div class="border_new_y"> 
                                    <div class="blog-sidebar-items-title my-2">
                                       <span class="blog-sidebar-items-title-text">Holiday Styles</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <!--<div class="border_new_y"> -->
                                    <div class="blog-sidebar-items">
                                       <?php 
                                       if(is_array($holidays)){
                                          foreach($holidays as $h){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input"  id="exp_holiday_<?php echo $h->id;?>" name= "exp_holidays[]"  value="<?php echo $h->id; ?>"  onclick="inspiration_experience_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="exp_holiday_<?php echo $h->id;?>"><?php echo $h->holiday_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Category</span>
                                       <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items new_one_Category">
                                       <?php 
                                       if(is_array($category_for_exp)){
                                          foreach($category_for_exp as $c){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="exp_category_<?php echo $c->id;?>" name="exp_category[]" value="<?php echo $c->id;?>" onclick="inspiration_experience_filter();" >
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="acc_category_<?php echo $c->id;?>">
                                                   <div class="star-rating test"> 
                                                      <?php for($i=0;$i<$c->no_of_star;$i++){ ?>
                                                      <i class="fa fa-star" aria-hidden="true"></i> 
                                                      <?php } ?>
                                                   </div>
                                                   <?php echo $c->category_name;?>
                                                </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Location (Atoll)</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items" style="display:none;">
                                       <?php foreach($location as $l){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="exp_location_<?php echo $l->id;?>" name= "exp_location[]"  value="<?php echo $l->id; ?>"  onclick="inspiration_experience_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="exp_location_<?php echo $l->id;?>"> <?php echo $l->state_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } ?>
                                       
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4" >
                                       <span class="blog-sidebar-items-title-text">Transfer mode</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       if(is_array($transfer_mode)){
                                       foreach($transfer_mode as $t){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="exp_transfer_mode_<?php echo $t->id;?>" name= "exp_transfer[]" value="<?php echo $t->id; ?>"   onclick="inspiration_experience_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="exp_transfer_mode_<?php echo $t->id;?>"> <?php echo $t->airport_type_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Resort facilities</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       if(is_array($facilities)){
                                          foreach($facilities as $fac){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="exp_facility_<?php echo $fac->id;?>" name= "exp_facility[]" value="<?php echo $fac->id; ?>"   onclick="inspiration_experience_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="exp_facility_<?php echo $fac->id;?>"><?php echo $fac->facility_name;?></label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">Sports & entertainment</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                   <div class="blog-sidebar-items" style="display:none;">
                                       <?php 
                                       if(is_array($sports)){
                                          foreach($sports as $sport){;?>
                                       <div class="blog-sidebar-item">
                                          <div class="pretty p-image p-plain">
                                             <input type="checkbox" class="custom-control-input" id="exp_sports_<?php echo $sport->id;?>" name= "exp_sports[]"  value="<?php echo $sport->id; ?>"  onclick="inspiration_experience_filter();">
                                             <div class="state">
                                                <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                <label class="custom-control-label" for="exp_sports_<?php echo $sport->id;?>"> <?php echo $sport->sport_name;?> </label>
                                             </div>
                                          </div>
                                       </div>
                                       <?php } } ?>
                                    </div>
                                    <div class="blog-sidebar-items-title mt-4">
                                       <span class="blog-sidebar-items-title-text">No. Of Rooms</span>
                                       <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                    </div>
                                    <div class="blog-sidebar-items" style="display:none;">
                                       <div class="blog-sidebar-item">
                                           
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="exp_room_count" value="1,10" class="custom-control-input" id="exp_room_count10" onclick="inspiration_experience_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="exp_room_count"> 1 - 10 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="exp_room_count" value="11,50" class="custom-control-input" id="exp_room_count50" onclick="inspiration_experience_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="exp_room_count50"> 11 - 50 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="exp_room_count" value="51,100" class="custom-control-input" id="exp_room_count100" onclick="inspiration_experience_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="exp_room_count100"> 51 - 100 Rooms </label>
												</div>
											</div>
											<br>
											<div class="pretty p-image p-plain">
                                                    <input type="checkbox" name="exp_room_count" value="101,150" class="custom-control-input" id="exp_room_count150" onclick="inspiration_experience_filter();">
                                                <div class="state">
													<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
													<label class="custom-control-label" for="exp_room_count150"> 101 - 150 Rooms </label>
												</div>
											</div>
                                           
                                           
                                           
                                           
                                           
                                           
                                           
                                          <!--<div class="form-group">-->
                                          <!--   <select class="custom-select" name="exp_room_count" onclick="inspiration_experience_filter();">-->
                                          <!--      <option value="">Select</option>-->
                                          <!--      <option value="1,10">1 - 10 Rooms</option>-->
                                          <!--      <option value="11,50">11 - 50 Rooms</option>-->
                                          <!--      <option value="51,100">51 - 100 Rooms</option>-->
                                          <!--      <option value="101,150">100 - 150 Rooms</option>-->
                                          <!--   </select>-->
                                          <!--</div>-->
                                       </div>
                                    </div>
                                 </form>
                                 </div>
                              </div>
                             </div> 
                           </div>
                           <div class="col-lg-9 col-md-12 mx-auto blog-innner-cards ">
                              <button class="blog-filter-btn3 btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
                              <div class="resort-inner-pill-container Exp-tab-filter my-2">
                                 <?php 
                                    foreach($experience_categories as $exp_cat){
                                        ?>
                                 <label for="<?php echo $exp_cat->exp_cat_name."_".$exp_cat->exp_cat_id;?>" class="btn expbutton">
                                 <input type="checkbox" id="<?php echo $exp_cat->exp_cat_name."_".$exp_cat->exp_cat_id;?>" name="test" value="<?= $exp_cat->exp_cat_id; ?>"  class="badgebox">
                                 <span><?php echo $exp_cat->exp_cat_name; ?> <i class="fa fa-close"></i></span>
                                 </label>
                                 <?php 
                                    }?>
                              </div>
                              <div class="row signature-experiences" id="inspiration_experience_result">
                                 <?php 
                                    if($expriences){
                                    foreach($expriences as $exprience){
                                    //$ac_images =$this->common_model->get_row('images', array('item_id'=>$exprience->id, 'type'=>'accommodation'));?>
                                 <div class="col-lg-6 col-md-6 col-12 mb-lg-4">
                                    <div class="box">
                                        <?php
            //                             if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)) {
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
                                        
                                        
                                        
                                       <?php  //if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)){?>
                                       <!--<a href="<?php //echo base_url('resort-detail?&resort_id='.base64_encode($exprience->resort_id)); ?>">-->
                                       <!--<img src="<?php //echo  base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name ;?>" alt="Resort"  class="img-fluid  HomeImage">-->
                                       <!--<img src="<?php //echo  $ImagePath ;?>" alt="<?php //if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">-->
                                       <!--</a>-->
                                       <?php //}else{ ?>
                                        <!--<img src="<?php echo FRONT_THEAM_PATH?>images/No_Image_Available.jpg"  class="img-fluid  HomeImage">-->
                                       <?php //} ?>
                                       <div class="img-content">
													<a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($exprience->resort_id)); ?>"> <img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">
													</a>
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
                                       
                                       <div class="about-slider-bottom signature_experiences inspiration-readmore accommodation-villa accommodation-villa">
                                          <div class="about-slider-bottom-description smalldesc">
                                             <div class="about-slider-bottom-description-title d-flex mb-2">
                                                <div class="about-slider-bottom-description-title1">
                                                    <?php echo $exprience->name_of_activities;?></div>
                                                <!--<div class="about-slider-bottom-description-title2 ml-2"></div>-->
                                             </div>
                                             <span class=""><?php echo $exprience->resort_description;?></span>
                                          </div>
                                          <div class="card-read-more-container">
                									<a href="#" class="card-read-more btn">Read more</a>
                						    </div>
                                       </div>
                                       <div>
                                          <div class="no-of-likes like-heart heart-icon" onclick="save_exprince_like_unlike('<?php echo $exprience->id;?>');" id="experince_like_unlike_btn_<?php echo $exprience->id;?>">
                                             <?php 
                                                if(user_logged_in()){ 
                                                    if(get_all_count('exprience_likes', array('exprience_id'=>$exprience->id, 'user_id'=>user_id()))){
                                                        echo '<span class="fa fa-heart" aria-hidden="true"></span>';
                                                    }else{
                                                        echo '<span class="fa fa-heart-o" aria-hidden="true"></span>';
                                                    }
                                                }else{
                                                    echo '<span class="fa fa-heart-o" aria-hidden="true"></span>';
                                                }
                                                ?> 
                                             <strong>
                                             <?php 
                                                $likes = get_all_count('exprience_likes', array('exprience_id'=>$exprience->id));
                                                echo !empty($likes)?number_format($likes, 0):'';
                                                ?>
                                             </strong>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php 
                                    }
                                    }
                                    ?>
                              </div>
                              <?php 
                              //if(is_array($expriences)){
                              //if(count($expriences)>4){ ?>
                              <div class="text-center new_discover_more_btn new_button_n">
                                 <!--<button type="button" class="review-btn btn new_discover_more"  onclick="inspiration_experience_filter_more();">Discover More</button>-->
                                  <button type="button" class="ins_exp_discover_more new_discover_more"  onclick="inspiration_experience_filter_more();">Discover More</button>
                              </div>
                              <?php //} }?>
                              <!-- <nav aria-label="..." class="pagination-container">
                                 <ul class="pagination">
                                     <li class="page-item">
                                         <span class="page-link"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Left_side.png" alt="Left_side.png"
                                                 class="img-fluid"></span>
                                     </li>
                                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                                     <li class="page-item active" aria-current="page">
                                         <span class="page-link">
                                             2
                                             <span class="sr-only">(current)</span>
                                         </span>
                                     </li>
                                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                                     <li class="page-item"><a class="page-link" href="#">4</a></li>
                                     <li class="page-item"><a class="page-link" href="#">5</a></li>
                                     <li class="page-item"><a class="page-link" href="#">6</a></li>
                                     <li class="page-item"><a class="page-link" href="#">8</a></li>
                                     <li class="page-item"><a class="page-link" href="#">9</a></li>
                                     <li class="page-item">
                                         <a class="page-link" href="#"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Right_side.png"
                                                 alt="Right_side.png" class="img-fluid"></a>
                                     </li>
                                 </ul>
                                 </nav> -->
                           </div>
                        </div>
                     </div>
                  </div>
            </section>
            <!--End exp section html-->
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
</section>
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
<div class="modal fade" id="amenities_details" tabindex="-1" role="dialog" aria-labelledby="amenities_details" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="amenities_details_title">Resort Amenities</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="amenities_details_data"></div>
    	</div>
  	</div>
</div>
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
     $(".resort_toggle").click(function(){
   	 var resort_id =  $(this).attr('id');
       $(".resort-more-info_"+resort_id).slideToggle();
   	  $('.resort_toggle').addClass('shrink');
     });
     $(".get_details").click(function(){
   	 var resort_id =  $(this).attr('rel');
   	 window.location.href = "<?php echo base_url();?>resort-detail?resort_id="+resort_id;
     });
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
   
      function inspiration_accommodation_filter(){
   
       var datanew = "";
      //  if($('#room_count').val()!="") {
      //    datanew = '&room_count='+$('#room_count').val();
      //  }
   	    $.ajax({ 
            url:base_url+"home/inspiration_accommodation_filter",
            type:"POST",
            data:$("#inspiration_accommodation_filter_frm").serialize()+datanew, 
            success: function(html){
               $('#inspiration_accommodation_result').html(html);
            }                
         }); 
      }
      function inspiration_resort_filter(){
         $.ajax({ 
            url:base_url+"home/inspiration_resort_filter",
            type:"POST",
            data:$("#inspiration_resort_filter_frm").serialize(), 
            success: function(html){
               $('#inspiration_resort_result').html(html);
            }                
         }); 
      }
      
      function inspiration_accommodation_categories(acc_cat_id){
   	//   alert(acc_cat_id);
   	
   	
   	var selected = new Array();
              $("input:checkbox[name=test1]:checked").each(function() {
                  selected.push($(this).val());
                //   console.log(selected);
              });
              
             $("#villa_more").val(selected);
              
  	        //$("#villa_more").data("cat ="+selected);
   	
         $.ajax({ 
            url:base_url+"home/inspiration_accommodation_categories",
            type:"POST",
            data:{acc_cat_id:selected}, 
            // data:{acc_cat_id:acc_cat_id}, 
            success: function(html){
               $('#inspiration_accommodation_result').html(html);
            }                
         }); 
      }
      
      function inspiration_accommodation_filter_more(){
        villas_ids = '&acc_cat_id='+$('#villa_more').val();
   	    accommodation_offset =  $('#accommodation_offset').val();
   	    
        if(accommodation_offset==0) {
            accommodation_offset = parseInt(accommodation_offset)+5;
        } else {
            accommodation_offset = parseInt(accommodation_offset)+4;
        }
        
   	    $('#accommodation_offset').val(accommodation_offset);
   	    
        var datanew = "";
        
        if($('#room_count').val()!="") {
            datanew = '&room_count='+$('#room_count').val();
        }
        
        $.ajax({ 
            url:base_url+"home/inspiration_accommodation_filter_more",
            type:"POST",
            data:$("#inspiration_accommodation_filter_frm").serialize()+datanew+villas_ids, 
   		  dataType:'json',  
            success: function(data){
   			
              $("#inspiration_accommodation_result").append(data.final_output);
            }                
         }); 
      }
      
      // function inspiration_experience_categories(exp_cat_id){
   	  // console.log('exp_cat_id',exp_cat_id);
      //    $.ajax({ 
      //       url:base_url+"home/inspiration_experience_categories",
      //       type:"POST",
      //       data:{exp_cat_id:exp_cat_id}, 
      //       success: function(html){
      //          $('#inspiration_experience_result').html(html);
      //       }                
      //    }); 
      // }
      function inspiration_experience_filter(){
         $.ajax({ 
            url:base_url+"home/inspiration_experience_filter",
            type:"POST",
            data:$("#inspiration_experience_filter_frm").serialize(), 
            success: function(html){
               $('#inspiration_experience_result').html(html);
            }                
         }); 
      }
      
      function inspiration_experience_filter_more(){
   	    experince_offset =  $('#experince_offset').val();
   	    //experince_offset = parseInt(experince_offset)+1;
   	   	    
        if(experince_offset==0) {
            experince_offset = parseInt(experince_offset)+5;
        } else {
            experince_offset = parseInt(experince_offset)+4;
        }
        
   	    $('#experince_offset').val(experince_offset);
   	    
        //$('#experince_offset').val(parseInt($('#experince_offset').val())+4);
       
        $.ajax({ 
            url:base_url+"home/inspiration_experience_filter_more",
            type:"POST",
            data:$("#inspiration_experience_filter_frm").serialize(), 
   		    dataType:'json',   
            success: function(data) {
   			    $("#inspiration_experience_result").append(data.final_output);
       			 console.log($('#experince_offset').val());
       			 console.log($('#experince_count').val());
       	// 		 if($('#experince_offset').val() <= $('#experince_count').val()){
       	// 		     $('.ins_exp_discover_more').hide();
       	// 		 }
            }                
         }); 
       }
         // append exp filter 
       $('.FloorPlanLink').on('click', function() {
         $('#FloorPlanImage').attr('src',$(this).attr('myurl'));
         $('#Modal_FloorPlan').modal('show');
       });
       $(':checkbox[name=test]').on('change', function() {
         var assignedTo = $(':checkbox[name=test]:checked').map(function() {
             return this.value;
         }).get();
          var resort_id="<?php echo $resort_id; ?>";
         var category_id=assignedTo.toString();
         // console.log('category_id',category_id);
         // console.log('resort_id',resort_id);
         $.ajax({ 
            url:base_url+"home/inspiration_experience_categories2",
            type:"POST",
             data:{'resort_id':resort_id,'category_id':category_id}, 
            // data:{exp_cat_id:exp_cat_id}, 
            success: function(html){
               $('#inspiration_experience_result').html(html);
            }                
         }); 
         // $.ajax({
         //     url:'<?php echo base_url(); ?>home/experinces_filterhtml',
         //     type:'GET',
         //     data:{'resort_id':resort_id,'category_id':category_id}, 
         //     success:function(html){
         //       $('#experience_html_append').html(html);
         //     }
         // });
       });
       
</script>

<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
