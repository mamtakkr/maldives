<?php if($expriences){
  
        foreach($expriences as $exprience){
           $ac_images =$this->common_model->get_row('images', array('item_id'=>$exprience->id, 'type'=>'accommodation'));
            $category = $this->common_model->get_row('mal_category', array('id'=>$exprience->resort_category));?>

                <div class="col-lg-4 col-md-4 col-12 mb-4">
                  <div class="box">
                      <?php
                        if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)) {
							$ImagePath = base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name;
						} else {
							$ImagePath = FRONT_THEAM_PATH.'/images/instagram-pic2.jpg';
						} 
                        
                        ?>
                      <?php  //if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)){?>
                                       <!--<a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($exprience->resort_id)); ?>">-->
                                       <!--<img src="<?php //echo  base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name ;?>" alt="Resort"  class="img-fluid  HomeImage">-->
                                       <!--<img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">-->
                                       <!--</a>-->
                                       <?//php //}else{ ?>
                                        <!--<img src="<?//php echo FRONT_THEAM_PATH?>images/No_Image_Available.jpg"  class="img-fluid  HomeImage">-->
                                       <?//php //} ?>
                                       <div class="img-content">
													<a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($exprience->resort_id)); ?>">
                                                       <!--<img src="<?php //echo  base_url().'uploads/resorts/full_image/1300_'.$ac_images->image_name ;?>" alt="Resort"  class="img-fluid  HomeImage">-->
                                                       <img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">
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

                    
                      <div class="about-slider-bottom signature_experiences inspiration-readmore1 accommodation-villa accommodation-villa">
                          <div class="about-slider-bottom-description smalldesc">
                              <div class="about-slider-bottom-description-title d-flex mb-2">
                                  <div class="about-slider-bottom-description-title1"><?php echo $exprience->name_of_activities;?></div>
                                  <!--<div class="about-slider-bottom-description-title2 ml-2"><?php echo $exprience->resort_name;?></div>-->
                              </div>
                              <span class=""><?php echo $exprience->resort_description;?></span>
                          </div>
                         <div class="card-read-more-container">
									<a href="#" class="card-read-more1 btn">Read More</a>
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
              </div>          
              
              






                
      <?php }
        }else{ ?>
      <div >No Record Found</div>
      <?php } ?>
      
      
      
      <script>
        $('.inspiration-readmore1').find('.card-read-more1').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more1').text(this.expand?"Hide Content":"Read More");
        $('.inspiration-readmore1').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
</script>
