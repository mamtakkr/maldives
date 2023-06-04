
	<section>
		<div class="reviews-header-banner">
			<div class="reviews-slider owl-carousel owl-theme">
				<?php 
				if(!empty($caption_imgs)) {
                    foreach ($caption_imgs as $caption_img) {
						if(file_exists('uploads/caption/'.$caption_img->image_name)){
                ?>
                <div class="box" style="background-image:url('<?php echo base_url('uploads/caption/' . $caption_img->image_name); ?>')">
					<div class="reviews-header-title">
						<h1><span><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?>...</h1>
						<h2><?php echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>
					</div>
				</div>
                <?php } } }?>
			</div>
		</div>
	</section>
    <section id="inspirations-section">
        <form id="traveller_stories_frm" method="post" onsubmit="return false;">
            <input type="hidden" name="traveller_categorys" id="traveller_categorys" value="1">
        </form>
		<div>
			<div class="inspiration">
				<ul class="nav nav-tabs mx-auto" id="inspiration-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link  active" id="traveller-tab" data-toggle="tab" href="#traveller" role="tab"
							aria-controls="traveller" aria-selected="true">Traveller Reviews</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="resorts-tab" data-toggle="tab" href="#resorts" role="tab"
							aria-controls="resorts" aria-selected="false" onclick="resort_stories_new();">Resorts Stories</a>
					</li>
				</ul>
                <div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active pt-5" id="traveller" role="tabpanel" aria-labelledby="traveller-tab">
					<div class="resort-inner-pill-container my-4 d-flex justify-content-center">
							<?php 
								foreach($traveller_categorys as $exp_cat){ ?>
									<label for="<?php echo $exp_cat->category_name;?>" class="btn expbutton">
										<input type="checkbox" id="<?php echo $exp_cat->category_name;?>" name="test" value="<?= $exp_cat->id; ?>"  class="badgebox">
										<span><?php echo $exp_cat->category_name; ?><i class="fa fa-close"></i></span>
									</label>
						<?php }?>
							</div>
							
                        
                        <section>
						    <div class="blogs-items-container">
                                <div class="container-fluid">
                                    <div class="row">
                                        
                                            <div class="col-lg-3 col-md-12 overlay" id="myNav">
                                                <form id="traveller_stories_filter" method="post">
                                                    <div class="blog-sidebar">
                                                        <div class="blog-sidebar-header">
                                                            <span>FILTER BY RESORT</span>
                                                            <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                                        </div>
                                                        <div class="blog-sidebar-items">
                                                            <div class="blog-sidebar-item">
                                                                <select class="custom-select" id="resort_id" name="resort_id" onchange="selectResortStoryFilter();">
                                                                    <option value=''>Select Resort</option>
                                                                    <?php 
                                                                        if(!empty($resorts)){
                                                                            foreach($resorts as $resort){?>
                                                                                <option value="<?php echo $resort->id; ?>"><?php echo $resort->resort_name; ?></option>
                                                                                <?php 
                                                                            }
                                                                        } 
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="blog-sidebar-header">
                                                            <span>INSPIRE ME BY</span>
                                                            <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                                            <input type="hidden" id="page_num" name="page_num"  value="0">
                                                            <input type="hidden" id="section_type" value="1">
                                                        </div>
                                                        <form action="">
                                                            <div class="blog-sidebar-items-title my-2">
                                                                <span class="blog-sidebar-items-title-text">Holiday Styles</span>
                                                                <span><i class="fa fa-minus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items">
                                                                <?php foreach($holidays as $h){;?>

                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" class="custom-control-input" id="holidays_fil_<?php echo $h->id; ?>" <?php if($this->input->get('holiday_id')&&$this->input->get('holiday_id')==$h->id){echo 'checked';} ?> name="holidays[]" value="<?php echo $h->id; ?>" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="holidays_fil_<?php echo $h->id;?>"><?php echo $h->holiday_name;?> </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php }?>
                                                            </div>
                                                            <div class="blog-sidebar-items-title mt-4">
                                                                <span class="blog-sidebar-items-title-text">Category</span>
                                                                <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items" style="display:none;">
                                                                <?php foreach($categorys as $c){;?>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" class="custom-control-input" id="categorys_fil_<?php echo $c->id; ?>" name="categorys[]" value="<?php echo $c->id; ?>" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="categorys_fil_<?php echo $c->id;?>">
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
                                                                <?php }?>
                                                            </div>
                                                            <div class="blog-sidebar-items-title mt-4">
                                                                <span class="blog-sidebar-items-title-text">Transfer mode</span>
                                                                <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items" style="display:none;">
                                                                <?php foreach($airports as $t){;?>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" class="custom-control-input" id="airports_fil_<?php echo $t->id; ?>" name="airports[]" value="<?php echo $t->id; ?>" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="airports_fil_<?php echo $t->id;?>"> <?php echo $t->airport_type_name;?> </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php }?>
                                                            </div>

                                                            <div class="blog-sidebar-items-title mt-4">
                                                                <span class="blog-sidebar-items-title-text">Resort facilities</span>
                                                                <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items" style="display:none;">
                                                            <?php foreach($facilities as $fac){;?>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" class="custom-control-input" id="facilities_fil_<?php echo $fac->id; ?>" name="facilities[]" value="<?php echo $fac->id; ?>" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="facilities_fil_<?php echo $fac->id;?>"><?php echo $fac->facility_name;?></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php }?>
                                                            </div>

                                                            <div class="blog-sidebar-items-title mt-4">
                                                                <span class="blog-sidebar-items-title-text">Sports & entertainment</span>
                                                                <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items" style="display:none;">
                                                            <?php foreach($sports as $sport){;?>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" class="custom-control-input" id="sport_fil_<?php echo $sport->id; ?>" name="sports[]" value="<?php echo $sport->id; ?>" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="sport_fil_<?php echo $sport->id;?>"> <?php echo $sport->sport_name;?> </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php }?>
                                                            </div>

                                                            <div class="blog-sidebar-items-title mt-4">
                                                                <span class="blog-sidebar-items-title-text">No. Of Rooms</span>
                                                                <span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
                                                            </div>
                                                            <div class="blog-sidebar-items" style="display:none;">
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" name="no_of_villas[]" value="1,10" class="custom-control-input" id="villas_count_10" onclick="selectResortStoryFilter();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="villas_count_10"> 1 - 10 Villas </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" name="no_of_villas[]" value="11,50" class="custom-control-input" id="villas_count_50" onclick="selectResortStory();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="villas_count_50"> 11 - 50 Villas </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" name="no_of_villas[]" value="51,100" class="custom-control-input" id="villas_count_100" onclick="selectResortStory();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="villas_count_100"> 51 - 100 Villas </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" name="no_of_villas[]" value="101,150" class="custom-control-input" id="villas_count_150" onclick="selectResortStory();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="villas_count_150"> 100 - 150 Villas</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="blog-sidebar-item">
                                                                    <div class="pretty p-image p-plain">
                                                                    <input type="checkbox" name="no_of_villas[]" value="150,0" class="custom-control-input" id="villas_count_151" onclick="selectResortStory();">
                                                                        <div class="state">
                                                                            <img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>images/Checkbox.png">
                                                                            <label class="custom-control-label" for="villas_count_151"> More than 151 Villas</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                                    

                                                        </form>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php 
                                            if ($this->session->userdata('user_info')) {
                                                $review_link = base_url('user/add_story?type=add_story&resort_id=');
                                            } else {
                                                $review_link = base_url('login?type=add_story&resort_id=');
                                            }
                                            ?>
                                        <div class="col-lg-9 col-md-12 mx-auto blog-innner-cards">
                                           <div class="d-flex justify-content-end">
                                                <a class="review-btn btn my-2" href="<?php echo $review_link; ?>"><i class="fa fa-pencil mr-2"></i>Write a Review</a>
                                           </div>
                                            <button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
                                            <div id="stories_category">
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
                                                                        <div>Posted a Review on <?php echo !empty($story->created_date) ? date('d F Y', strtotime($story->created_date)) : '';?></div>
                                                                        <div><?php echo ucwords($story->country_name); ?> | <?php $contributions = get_all_count('traveller_stories', array('user_id' => $story->user_id)); echo !empty($contributions) ? number_format($contributions, 0) : '';?> Contributions</div>
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
                                                                    <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name); ?></a>
                                                                    
                                                                    <div>
                                                                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
                                                                        <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>"> </a>
				                                                            <?php if ($story->verified_status == 1) { ?>
                                                                            <span class="verified">Stay Verified</span>
                                                                            <?php } ?>
                                                                    </div>
                                                                </div>
                                                                <p class="mt-2">
                                                                <?php echo ucwords($story->my_experience.substr(1,20)); ?>
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                        for ($nu = 1;$nu <= 5;$nu++) {
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
                                                                                                echo '<img src="'.FRONT_THEAM_PATH.'images/Helpful.png" alt="Helpful.png" class="img-fluid ml-2"> ';
                                                                                            } else {
                                                                                                echo '<img src="'.FRONT_THEAM_PATH.'images/dishelpful.png" alt="dishelpful.png" class="img-fluid ml-2"> ';
                                                                                            }
                                                                                        } else {
                                                                                            echo '<img src="'.FRONT_THEAM_PATH.'images/dishelpful.png" alt="dishelpful.png" class="img-fluid ml-2"> ';
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
                                                                                <img src="<?php echo  FRONT_THEAM_PATH ;?>images/Comment.png" alt="Comment.png" class="img-fluid ml-2">
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
																		<a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo $share_link . '&text=' . $blog_title ?>" class="btn btn-twitter" data-placement="left">
																			<i class="fa fa-twitter"></i>
																		</a>
																		<a data-original-title="Facebook" rel="tooltip"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left">
																			<i class="fa fa-facebook"></i>
																		</a>
																		<a data-original-title="LinkedIn" rel="tooltip"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" class="btn btn-linkedin" data-placement="left">
																			<i class="fa fa-linkedin"></i>
																		</a>
																		<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link . '&description=' . $blog_title ?>"  class="btn btn-pinterest" data-placement="left">
																			<i class="fa fa-pinterest"></i>
																		</a>
                                                        				<ul class="dropdown-menu" style="background:transparent;border:none;">
                                                            				<li>
                                                        					    <a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo $share_link . '&text=' . $blog_title ?>" class="btn btn-twitter" data-placement="left">
                                                    								<i class="fa fa-twitter"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Facebook" rel="tooltip"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_link; ?>" class="btn btn-facebook" data-placement="left">
                                                    								<i class="fa fa-facebook"></i>
                                                    							</a>
                                                        					</li>					
                                                        				
                                                        				    <li>
                                                        						<a data-original-title="LinkedIn" rel="tooltip"  href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_link; ?>" class="btn btn-linkedin" data-placement="left">
                                                    								<i class="fa fa-linkedin"></i>
                                                    							</a>
                                                        					</li>
                                                        					<li>
                                                        						<a data-original-title="Pinterest" rel="tooltip" href="http://pinterest.com/pin/create/button/?url=<?php echo $share_link . '&description=' . $blog_title ?>"  class="btn btn-pinterest" data-placement="left">
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
																			<button type="submit" class="btn comment-send-btn" onclick="save_traveller_comment('<?php echo !empty($story->id) ? $story->id : ''; ?>');" >
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
                                                 }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
					</div>
					<div class="tab-pane fade pt-5" id="resorts" role="tabpanel" aria-labelledby="resorts-tab">
					<section>
						    <div class="blogs-items-container">
                                <div class="container-fluid">
                                    <div class="row">
                                        
                                            <div class="col-lg-3 col-md-12 overlay" id="myNav">
                                                <form id="resort_stories_frm" method="post">
                                                    <div class="blog-sidebar">
                                                        <div class="blog-sidebar-header">
                                                            <span>FILTER BY RESORT</span>
                                                            <a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
                                                        </div>
                                                        <div class="blog-sidebar-items">
                                                            <div class="blog-sidebar-item">
                                                                <select class="custom-select" id="resort_id" name="resort_id" onchange="resort_stories_new();">
                                                                    <option value=''>Select Resort</option>
                                                                    <?php 
                                                                        if(!empty($resorts)){
                                                                            foreach($resorts as $resort){?>
                                                                                <option value="<?php echo $resort->id; ?>"><?php echo $resort->resort_name; ?></option>
                                                                                <?php 
                                                                            }
                                                                        } 
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                        <div class="col-lg-9 col-md-12 mx-auto blog-innner-cards">
                                            <button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
                                            <div id="resort_storys_my_data">
                                            <?php
											    if (!empty($resort_storys)) {
				                                    foreach ($resort_storys as $story) {
				                                    //$images = $this->common_model->get_result('images', array('status' => '1', 'item_id' => $story->id, 'type' => 'traveller_story'));
				                            ?>
                                            <div class="reviews-container">
                                                <div class="row my-3">
                                                    <div class="col-lg-12 col-md-12 col-12">
                                                        <div class="guest-reviews-details">
                                                            <div>
                                                                <div class="guest-reviews-details-top">
                                                                    <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name); ?></a>
                                                                    
                                                                    <div>
                                                                        <img src="<?php echo  FRONT_THEAM_PATH ;?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
                                                                        <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>"> </a>
				                                                            <span class="verified"><?php echo $story->title;?></span>
                                                                            
                                                                    </div>
                                                                </div>
                                                                <p class="mt-2">
                                                                <?php echo ucwords($story->description.substr(1,20)); ?>
                                                                </p>
                                                                <div class="guest-reviews-gallery">
																<?php
																	//print_r($story->image_name);
																	if (!empty($story->image_name)) {
																		foreach ($story->image_name as $image) {
																			if (!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/150_' . $image->image_name)) { ?>
																				<img src="<?php echo base_url() . 'uploads/resorts/thumbnails/150_' . $image->image_name; ?>" alt="" class="img-fluid mr-2">
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
                                                 }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
					</div>
				</div>
			</div>
		</div>
	</section>
    
		        	

	<script>

	   //showmore

	   $(document).ready(function() {

	     // Configure/customize these variables.

	     var showChar = 150;  // How many characters are shown by default

	     var ellipsestext = "...";

	     var moretext = "More";

	     var lesstext = "Less";

	     

	   

	   //  $('.more1').each(function() {

	         var content = $(this).html();

	   

	         if(content.length < showChar) {

	   

	             var c = content.substr(0, showChar);

	             var h = content.substr(showChar, content.length - showChar);

	   

	             var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

	   

	             $(this).html(html);

	         }

	   

	     });

	   

	     $(".morelink").click(function(){

	         if($(this).hasClass("less")) {

	             $(this).removeClass("less");

	             $(this).html(moretext);

	         } else {

	             $(this).addClass("less");

	             $(this).html(lesstext);

	         }

	         $(this).parent().prev().toggle();

	         $(this).prev().toggle();

	         return false;

	     });

	   
	</script>

	<style>

	   .insp-tabs {

	   width: 100%;

	   display: inline-block;

	   margin-top: 50px;

	   padding-right: 7%;

	   text-align: center;

	   padding-left: 7%;

	   }

	   .tab-bar li {

	   box-shadow: 0px 0px 5px #7682B72E;

	   width: 14.66%;

	   margin-top: 30px;

	   margin-left: 21px;

	   }

	</style>

	<script type="text/javascript">

	   function loadResortMoreComment(resort_story_id){

	      var current_page = $('#resort_comment_pages_'+resort_story_id).val();

	      var total_comments = $('#resort_total_comments_'+resort_story_id).val();

	      $.ajax({

	         url:'<?php echo base_url('home/loadResortMoreComment'); ?>',

	         type:'get',

	         data:{'resort_story_id':resort_story_id, 'current_page':current_page, 'total_comments':total_comments}, 

	         success:function(html){

	            var response = $.parseJSON(html);

	            $('#resort_comment_list_'+resort_story_id).append(response.html);

	            $('#resort_comment_pages_'+resort_story_id).val(response.current_page);

	            if(response.more_comment=='show'){

	               $('#resort_comment_more_'+resort_story_id).show();

	            }else{

	               $('#resort_comment_more_'+resort_story_id).hide();

	            }

	         }

	      });

	   }

	   function selectResortStory() {

	      $('#page_num').val('0');

	      var section_type = $('#section_type').val();

	      if(section_type==2){         

	         $.ajax({

	            url:'<?php echo base_url(); ?>home/read_more_rs_story_new',

	            type:'POST',

	            data:$("#traveller_stories_frm").serialize(),

	            success:function(html){

	               var json_obj = $.parseJSON(html);

	               $('#resort_storys_data').show().html(json_obj.html);

	               $('#total_pages').val(json_obj.total_pages);

	               if(parseInt(json_obj.total_pages)>parseInt(<?php echo PER_PAGE_STORY; ?>)){

	                  $('#read_rs_more_story').show();

	               }else{

	                  $('#read_rs_more_story').hide();

	               }

	               $('#read_rs_back_story').hide();

	            }

	         });

	      }else{                  

	         $.ajax({

	            url:'<?php echo base_url(); ?>home/read_more_story_new',

	            type:'POST',

	            data:$("#traveller_stories_frm").serialize(),

	            success:function(html){

	               var json_obj = $.parseJSON(html);

	               $('#stories_category').show().html(json_obj.html);

	               $('#total_pages').val(json_obj.total_pages);

	               if(parseInt(json_obj.total_pages)>parseInt(<?php echo PER_PAGE_STORY; ?>)){

	                  $('#read_more_story').show();

	               }else{

	                  $('#read_more_story').hide();

	               }

	               $('#read_back_story').hide();

	            }

	         });

	      }

	   }

	   function selectResortStoryFilter() {

	      $('#page_num').val('0');
          
	      var section_type = $('#section_type').val();
	      if(section_type==2){         

	         $.ajax({

	            url:'<?php echo base_url(); ?>home/read_more_rs_story_filter',

	            type:'POST',

	            data:$("#traveller_stories_filter").serialize(),

	            success:function(html){
                   // console.log("eeeee"+html);
	               var json_obj = $.parseJSON(html);

	               $('#resort_storys_data').show().html(json_obj.html);

	               $('#total_pages').val(json_obj.total_pages);

	               if(parseInt(json_obj.total_pages)>parseInt(<?php echo PER_PAGE_STORY; ?>)){

	                  $('#read_rs_more_story').show();

	               }else{

	                  $('#read_rs_more_story').hide();

	               }

	               $('#read_rs_back_story').hide();

	            }

	         });

	      }else{    
			 $.ajax({

	            url:'<?php echo base_url(); ?>home/read_more_story_new',

	            type:'POST',

               data:$("#traveller_stories_filter").serialize(),

	            success:function(html){
                   
	               var json_obj = $.parseJSON(html);
                    
	               $('#stories_category').show().html(json_obj.html);

	               $('#total_pages').val(json_obj.total_pages);

	               if(parseInt(json_obj.total_pages)>parseInt(<?php echo PER_PAGE_STORY; ?>)){

	                  $('#read_more_story').show();

	               }else{

	                  $('#read_more_story').hide();

	               }

	               $('#read_back_story').hide();

	            }

	         });

	      }

	   }

	   function save_traveller_comment(story_id){

	      var comment = $('#traveller_comment_'+story_id).val();

	      var error   = 'no';

	      if(comment==''){

	         $('#traveller_comment_error_'+story_id).show().html('The comment is required');

	         var error   = 'yes';

	      }

	      if(error=='no'){         

	         $.ajax({

	            url:'<?php echo base_url('home/save_comment_traveller'); ?>',

	            type:'post',

	            data:{'story_id':story_id, 'comment':comment}, 

	            success:function(html){

	               var response = $.parseJSON(html);  

	               if(response.status=='true'){

	                  if(response.more_comment=='show'){

	                     $('#traveller_stories_comment_more_'+story_id).show();

	                  }else{

	                     $('#traveller_stories_comment_more_'+story_id).hide();

	                  }

	                  $('#traveller_stories_total_comments_'+story_id).val(response.total_comments);

	                  $('#traveller_stories_comments_'+story_id).html(response.total_comments);

	                  $('#traveller_comment_'+story_id).val('');

	                  $('#traveller_comment_list_'+story_id).html(response.html);

	                  $('#traveller_comment_error_'+story_id).hide();

	               }else{

	                  $('#traveller_comment_error_'+story_id).html(response.message);

	               }

	            }

	         });

	      }

	   }

	   function loadTravellerMoreComment(story_id=''){

	      var current_page   = $('#traveller_stories_comment_pages_'+story_id).val();

	      var total_comments = $('#traveller_stories_total_comments_'+story_id).val();

	      $.ajax({

	         url:'<?php echo base_url('home/loadTravellerMoreComment'); ?>',

	         type:'get',

	         data:{'story_id':story_id, 'current_page':current_page, 'total_comments':total_comments}, 

	         success:function(html){

	            var response = $.parseJSON(html);

	            $('#traveller_comment_list_'+story_id).append(response.html);

	            $('#traveller_stories_comment_pages_'+story_id).val(response.current_page);

	            if(response.more_comment=='show'){

	               $('#traveller_stories_comment_more_'+story_id).show();

	            }else{

	               $('#traveller_stories_comment_more_'+story_id).hide();

	            }

	         }

	      });

	   }

	   function like_unlike(story_id){

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/save_traveller_like_unlike',

	         type:'GET',

	         data:{'story_id':story_id}, 

	         success:function(html){

	            var response = $.parseJSON(html);  

	            if(response.status=='true'){

	               $('#like_unlike_btn_'+story_id).html(response.html);

	            }else{

	                $('#like_unlike_message_'+story_id).html(response.message);

	            }

	         }

	      });

	   }

	   function like_unlike_resort_story(story_id){

	      $.ajax({ 

	         url:'<?php echo base_url(); ?>home/save_resort_story_like_unlike',

	         type:'GET',

	         data:{'story_id':story_id}, 

	         success:function(html){

	            var response = $.parseJSON(html);  

	            if(response.status=='true'){

	               $('#like_unlike_btn_'+story_id).html(response.html);

	            }else{

	                $('#like_unlike_message_'+story_id).html(response.message);

	            }

	         }

	      });

	   }

	   function open_story_imgs(story_id=''){

	      $.ajax({ 

	         url:base_url+"home/get_story_imgs?story_id="+story_id,

	         type:"GET",

	         success: function(html){

	            $('#story_images_data').html(html);

	         }                

	      }); 

	   }

	   function read_more_story(){

	      var page_num = $('#page_num').val();

	      page_num = parseInt(page_num) + parseInt('<?php echo PER_PAGE_STORY; ?>');        

	      $('#page_num').val(page_num);

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_story_new?page_num='+page_num,

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){

	            var json_obj = $.parseJSON(html);

	            $('#stories_category').show().html(json_obj.html);

	            $('#read_back_story').css({'display':'block'});            

	            var total_pages = parseInt(json_obj.total_pages); 

	            page_num        = parseInt(page_num) + parseInt('<?php echo PER_PAGE_STORY; ?>');         

	            console.log('total_pages = '+total_pages+', page_num = '+page_num);  

	            if(total_pages<=page_num){

	               $('#read_more_story').hide();

	            }

	         }

	      });

	   }

	   function read_back_story(){

	      var page_num  = $('#page_num').val();

	      page_num      = parseInt(page_num) - parseInt('<?php echo PER_PAGE_STORY; ?>');

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_story_new?page_num='+page_num,

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){ 

	            var json_obj = $.parseJSON(html);

	            $('#stories_category').show().html(json_obj.html);

	            $('#total_pages').val(json_obj.total_pages);            

	            $('#page_num').val(page_num);

	            if(parseInt(page_num)<=parseInt(0)){

	               $('#read_back_story').hide();

	            }

	            $('#read_more_story').show();

	         }

	      });

	   	} 

	   	function traveller_stories(){

	      $('#traveller-stories, .traveller_story_d').show();

	      $('#hotel-stories').hide();

	      $('#page_num').val('0');

	      $('#section_type').val('1');

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_story_new',

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){

	            var json_obj = $.parseJSON(html);

	            $('#stories_category').show().html(json_obj.html);

	            $('#total_pages').val(json_obj.total_pages);

	            if(parseInt(json_obj.total_pages)>parseInt('<?php echo PER_PAGE_STORY; ?>')){

	               $('#read_more_story').show();

	            }else{

	               $('#read_more_story').hide();

	            }

	            $('#read_back_story').hide();

	         }

	      });

	   }

	   // function traveller_categorys(cat_id){

	   // $("#traveller_categorys").val(cat_id);

	   // traveller_stories();

	   // }

	   $(':checkbox[name=test]').on('change', function() {

	     	var assignedTo = $(':checkbox[name=test]:checked').map(function() {

	          return this.value;

	      	}).get();

	        var category_id=assignedTo.toString();

	        //console.log('category_id',category_id);

	        traveller_stories2(category_id);

	        // console.log('category_id',category_id);

	        // console.log('resort_id',resort_id);      

	    });

	   	function traveller_stories2(categorys){

	      $('#traveller-stories, .traveller_story_d').show();

	      $('#hotel-stories').hide();

	      $('#page_num').val('0');

	      $('#section_type').val('1');

	      //console.log('categorys',categorys);

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_story_new2',

	         type:'POST',

	         data:{categorys:categorys},

	         success:function(html){

	      //console.log('html',html);

	         	

	            var json_obj = $.parseJSON(html);

	            $('#stories_category').show().html(json_obj.html);

	            $('#total_pages').val(json_obj.total_pages);

	            if(parseInt(json_obj.total_pages)>parseInt('<?php echo PER_PAGE_STORY; ?>')){

	               $('#read_more_story').show();

	            }else{

	               $('#read_more_story').hide();

	            }

	            $('#read_back_story').hide();

	         }

	      });

	   }

	   function resort_stories_new(){

			$.ajax({
				url:'<?php echo base_url(); ?>home/resort_stories_new',
				type:'POST',
				data:$("#resort_stories_frm").serialize(),
				success:function(html){
				var json_obj = $.parseJSON(html);
				$('#resort_storys_my_data').show().html(json_obj);
				}
			});
	   }
	   function resort_stories(){

	      $('#page_num').val('0');

	      $('#traveller-stories, .traveller_story_d').hide();

	      $('#hotel-stories').show();

	      $('#section_type').val('2');

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_rs_story_new',

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){

	            var json_obj = $.parseJSON(html);

	            $('#resort_storys_data').show().html(json_obj.html);

	            $('#total_pages').val(json_obj.total_pages);

	            if(parseInt(json_obj.total_pages)>parseInt(<?php echo PER_PAGE_STORY; ?>)){

	               $('#read_rs_more_story').show();

	            }else{

	               $('#read_rs_more_story').hide();

	            }

	            $('#read_rs_back_story').hide();

	         }

	      });

	   }

	   function read_rs_more_story(){

	      var page_num = $('#page_num').val();

	      page_num = parseInt(page_num) + parseInt(<?php echo PER_PAGE_STORY; ?>);        

	      $('#page_num').val(page_num);

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_rs_story_new?page_num='+page_num,

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){

	            var json_obj = $.parseJSON(html);

	            $('#resort_storys_data').show().html(json_obj.html);

	            $('#read_rs_back_story').css({'display':'block'});

	            if(parseInt(json_obj.total_pages)<(parseInt(page_num)+parseInt(<?php echo PER_PAGE_STORY; ?>))){

	               $('#read_rs_more_story').hide();

	            }

	         }

	      });

	   }

	   function read_rs_back_story(){

	      var page_num  = $('#page_num').val();

	      page_num      = parseInt(page_num) - parseInt(<?php echo PER_PAGE_STORY; ?>);

	      $.ajax({

	         url:'<?php echo base_url(); ?>home/read_more_rs_story_new?page_num='+page_num,

	         type:'POST',

	         data:$("#traveller_stories_frm").serialize(),

	         success:function(html){ 

	            var json_obj = $.parseJSON(html);

	            $('#resort_storys_data').show().html(json_obj.html);

	            $('#total_pages').val(json_obj.total_pages);            

	            $('#page_num').val(page_num);

	            if(parseInt(page_num)<=parseInt(0)){

	               $('#read_rs_back_story').hide();

	            }

	            $('#read_rs_more_story').show();

	         }

	      });

	   } 

	   function save_comment(resort_story_id=''){

	      var comment = $('#comment_'+resort_story_id).val();

	      var error   = 'no';

	      if(comment==''){

	         $('#comment_error_'+resort_story_id).show().html('The comment is required');

	         var error   = 'yes';

	      }

	      if(error=='no'){         

	         $.ajax({

	            url:'<?php echo base_url('home/save_comment_resort'); ?>',

	            type:'post',

	            data:{'resort_story_id':resort_story_id, 'comment':comment}, 

	            success:function(html){

	               var response = $.parseJSON(html);  

	               if(response.status=='true'){

	                  if(response.more_comment=='show'){

	                     $('#resort_comment_more_'+resort_story_id).show();

	                  }else{

	                     $('#resort_comment_more_'+resort_story_id).hide();

	                  }

	                  $('#resort_total_comments_'+resort_story_id).val(response.total_comments);

	                  $('#resort_story_comments_'+resort_story_id).html(response.total_comments);

	                  $('#comment_'+resort_story_id).val('');

	                  $('#comment_error_'+resort_story_id).hide();

	                  $('#resort_comment_list_'+resort_story_id).html(response.html);

	               }else{

	                  $('#comment_error_'+resort_story_id).html(response.message);

	               }

	            }

	         });

	      }

	   }

	   function loadResortMoreComment(resort_story_id){

	      var current_page = $('#resort_comment_pages_'+resort_story_id).val();

	      var total_comments = $('#resort_total_comments_'+resort_story_id).val();

	      $.ajax({

	         url:'<?php echo base_url('home/loadResortMoreComment'); ?>',

	         type:'get',

	         data:{'resort_story_id':resort_story_id, 'current_page':current_page, 'total_comments':total_comments}, 

	         success:function(html){

	            var response = $.parseJSON(html);

	            $('#resort_comment_list_'+resort_story_id).append(response.html);

	            $('#resort_comment_pages_'+resort_story_id).val(response.current_page);

	            if(response.more_comment=='show'){

	               $('#resort_comment_more_'+resort_story_id).show();

	            }else{

	               $('#resort_comment_more_'+resort_story_id).hide();

	            }

	         }

	      });

	   }

	   <?php if ($this->input->get('resort_id')) { ?>

	      setTimeout(function(){ selectResortStory(); $(window).scrollTop(700); }, 1000);

	   <?php

	      } ?>

	</script>

	<script type="text/javascript">

	   $(document).ready(function() {

	      var showChar1 = 330;

	      var ellipsestext1 = "...";

	      var moretext1 = "less";

	      var lesstext1 = "more";

	      $('.more1').each(function() {

	         var content1 = $(this).html();

	         if(content1.length > showChar1) {

	           var c = content1.substr(0, showChar1);

	           var h = content1.substr(showChar1-1, content1.length - showChar1);

	           var html = c + '<span class="moreellipses">' + ellipsestext1+ '&nbsp;</span><span class="morecontent1"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink1">' + moretext1 + '</a></span>';

	   

	           $(this).html(html);

	         }

	      });

	      $(".morelink1").click(function(){

	         if($(this).hasClass("less1")) {

	            $(this).removeClass("less1");

	            $(this).html(moretext1);

	         } else {

	            $(this).addClass("less1");

	            $(this).html(lesstext1);

	         }

	         $(this).parent().prev().toggle();

	         $(this).prev().toggle();

	         return false;

	      });

	   });

	   function share_socail_media(story_id, type){

	      console.log('story_id ='+story_id +'type ='+type);

	      $.ajax({

	         url:'<?php echo base_url('home/share_socail_media'); ?>',

	         type:'POST',

	         data:{'story_id':story_id, 'socail_type':type, 'type':'traveller_story_share'}, 

	         success:function(data){  

	            $('#share_btn_menu_'+story_id).toggleClass('list-ul-show');     

	         }

	      });

	   }

	   function share_resort_socail_media(story_id, type){

	      console.log('blog_id ='+story_id +'type ='+type);

	      $.ajax({

	         url:'<?php echo base_url('home/share_socail_media'); ?>',

	         type:'POST',

	         data:{'story_id':story_id, 'socail_type':type, 'type':'resort_story_share'}, 

	         success:function(data){  

	            $('#share_btn_menu_rs_'+story_id).toggleClass('list-ul-show');

	         }

	      });

	   }

	   <?php

	      if ($this->input->get('type') && $this->input->get('type') == 'resort_story') { ?>

	      setTimeout(function(){ 

	         resort_stories();

	         var stories_height = parseInt($("#review_search_result").offset().top) - parseInt(180) ;

	         $('html, body').animate({scrollTop: stories_height}, 1000);

	      }, 1500);

	   <?php

	      } ?>

	   function open_traveller_stories_images(counter='',max_counter='', image_path='', story_id=''){

	      $('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>'+image_path);

	      $('#traveller_stories_images').show();

	      $('#current_traveller_img').val(counter);

	      $('#current_traveller_max').val(max_counter);

	      $('#current_traveller_story_id').val(story_id);

	      if(parseInt(counter)==parseInt(1)){

	         $('.left_traveller_storie').hide();

	      }else{

	         $('.left_traveller_storie').show();

	      }

	      if(parseInt(max_counter)==parseInt(counter)){

	         $('.right_traveller_stories').hide();

	      }else{

	         $('.right_traveller_stories').show();

	      }

	   }

	   function left_traveller_stories(){

	      var counter = parseInt($('#current_traveller_img').val())-parseInt(1);

	      var max_counter = $('#current_traveller_max').val();

	      if(parseInt(counter)==parseInt(1)){

	         $('.left_traveller_storie').hide();

	      }else{

	         $('.left_traveller_storie').show();

	      }

	      if(parseInt(max_counter)==parseInt(counter)){

	         $('.right_traveller_stories').hide();

	      }else{

	         $('.right_traveller_stories').show();

	      }

	      var current_traveller_story_id = $('#current_traveller_story_id').val();

	      var image_path = $('#traveller_stories_'+current_traveller_story_id+'_'+counter).attr('data-image');

	      $('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>'+image_path);

	      $('#current_traveller_img').val(counter);

	   }

	   function right_traveller_stories(){

	      var counter = parseInt($('#current_traveller_img').val())+parseInt(1);

	      var max_counter = $('#current_traveller_max').val();

	      if(parseInt(max_counter)==parseInt(counter)){

	         $('.right_traveller_stories').hide();

	      }else{

	         $('.right_traveller_stories').show();

	      }

	      if(parseInt(counter)==parseInt(1)){

	         $('.left_traveller_storie').hide();

	      }else{

	         $('.left_traveller_storie').show();

	      }

	      var current_traveller_story_id = $('#current_traveller_story_id').val();

	      var image_path = $('#traveller_stories_'+current_traveller_story_id+'_'+counter).attr('data-image');

	      $('#traveller_stories_images').attr('src', '<?php echo base_url() . 'uploads/resorts/full_image/1300_'; ?>'+image_path);

	      $('#current_traveller_img').val(counter);

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

	         if(content1.length > showChar1) {

	           var c = content1.substr(0, showChar1);

	           var h = content1.substr(showChar1-1, content1.length - showChar1);

	           var html = c + '<span class="moreellipses">' + ellipsestext1+ '&nbsp;</span><span class="morecontent15"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink15">' + moretext1 + '</a></span>';

	   

	           $(this).html(html);

	         }

	      });

	      $(".morelink15").click(function(){

	         if($(this).hasClass("less15")) {

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

	         if(content20.length > showChar20) {

	           var c = content20.substr(0, showChar20);

	           var h = content20.substr(showChar20-1, content20.length - showChar20);

	           var html = c + '<span class="moreellipses">' + ellipsestext20+ '&nbsp;</span><span class="morecontent20"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink20">' + moretext20 + '</a></span>';

	           $(this).html(html);

	         }

	      });

	      $(".morelink20").click(function(){

	         if($(this).hasClass("less20")) {

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

	   });

	</script>

	<script type="text/javascript">
    <?php if($this->input->get('holiday_id')){?>
      setTimeout(function(){ $(window).scrollTop(700); }, 1000);
   <?php }?>
   $(function(){
      $('body').on('click','ul#search_page_pagination>li>a',function(e){
         e.preventDefault();  // prevent default behaviour for anchor tag
         var Pagination_url = $(this).attr('href'); // getting href of <a> tag
      $('#preloaderMainss').show();
         $.ajax({
            url:Pagination_url,
            type:'GET',
            data:$("#search_filtersNews").serialize(), 
            success:function(data){
               var $page_data = $(data);
               $('#ajax_resultss').html($page_data.find('div#search_filter_result'));
               $('#preloaderMainss').hide();
               //window.scrollTo(500, 0);
            }
         });
      });
   }); 
   function accommodation_form_filter(){
      $.ajax({ 
         url:base_url+"home/accommodation_form_filter",
         type:"POST",
         data:$("#accommodation_form_filter").serialize(), 
         success: function(html){
			 $('#accommodation_result').html('');
            $('#accommodation_result').html(html);
         }                
      }); 
   }
    function form_filter(){
      $.ajax({
         url:'<?php echo base_url('home/resort_list'); ?>',
         type:'GET',
         data:$("#search_filtersNews").serialize(), 
         success:function(data){
          var $page_data = $(data);
          $('#preloaderMainss').hide();
          $('#ajax_resultss').html($page_data.find('div#search_filter_result'));
          $('#sort_order').val('');
         }
      });
   }
//    $('.carousel').carousel({
//      interval: 2000
//    });   
   
   function view_more_resorts(){
		offset =  $('#offset_val').val();
		if(offset==0){
			offset = parseInt(offset)+2;
		}else{
			offset = parseInt(offset)+1;
		}
		$.ajax(
		{
         url:'<?php echo base_url(); ?>home/ajax_resort_list',
         type:'post',
         data:{'offset':offset}, 
        dataType:'json',                  
        success: function(data){
		   $("#offset_val").val(offset);
			$("#ajax_resort_list").append(data.final_output);
        }
      }); 
   }  
</script>

<script>
    $("document").ready(function() {
  
      $(".morelink1").trigger("click");

   
});
</script>

	<div class="modal fade" id="myModal">

	   <div class="modal-dialog modal-lg">

	      <div class="modal-content">

	         <!-- Modal Header -->

	         <div class="modal-header">

	            <h4 class="modal-title"></h4>

	            <button type="button" class="close" data-dismiss="modal">&times;</button>

	         </div>

	         <!-- Modal body -->

	         <div class="modal-body" style="position: relative;">

	            <a href="javascript:void(0);" class="left_traveller_storie" onclick="left_traveller_stories();"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>

	            <a href="javascript:void(0);" class="right_traveller_stories" onclick="right_traveller_stories();"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>

	            <input type="hidden" id="current_traveller_img">

	            <input type="hidden" id="current_traveller_story_id">

	            <input type="hidden" id="current_traveller_max">

	            <img style="width:100%;" id="traveller_stories_images" src="https://www.maldivesexperts.com/uploads/resorts/57d5a795e936302216668fba828a5e23.png" class="galleryd">    

	         </div>

	      </div>

	   </div>

	</div>
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
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-facebook {
    background-color: #3D5B96 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-google {
    background-color: #DD3F34 !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-linkedin {
    background-color: #1884BB !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-pinterest {
    background-color: #CC1E2D !important;
    width: 51px;
    color:#FFFFFF!important;
}

.btn-mail {
    background-color: #FFC90E !important;
    width: 51px;
    color:#FFFFFF!important;
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
    max-width:59px;
    margin-bottom:18px;
}

#socialShare > a{
    padding: 6px 10px 6px 10px;
}

@media (max-width : 320px) {
    #socialHolder{
        padding-left:5px;
        padding-right:5px;
    }
    
    .mobile-social-share h3 {
        margin-left: 0;
        margin-right: 0;
    }
    
    #socialShare{
        margin-left:5px;
        margin-right:5px;
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
	  <script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
