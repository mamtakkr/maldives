<?php 
   if(!empty($stories)){
       foreach($stories as $story){
       $avg_rates = get_rating($story->resort_id, $story->id);
       $images  = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$story->id, 'type'=>'traveller_story'));
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
                                                        			</div>
                                                                    </div>
                                                                </div>
                                                                <div class="reviewer-comment">
                                                                    <form action="" onsubmit="return false;" method="post">
                                                                        <div class="form-group d-flex mt-2">
                                                                            <textarea class="form-control mr-2 comment-input" id="traveller_comment_<?php echo !empty($story->id) ? $story->id : ''; ?>" name="comment" rows="2" placeholder="Add Comment"></textarea>
                                                                            <button type="submit" class="btn comment-send-btn" onclick="save_traveller_comment('<?php echo !empty($story->id) ? $story->id : ''; ?>');" >Send</button>
                                                                        </div>
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


<?php 
   }
    }else{ echo "No record found";}
    ?>