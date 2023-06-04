<?php  if($accommodations){
				foreach($accommodations as $accomm){
			    $villa_type_name = $accomm->room_size." ". "sqm | ".$accomm->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $accomm->villa_type_name;
					$ac_images =$this->common_model->get_row('images', array('item_id'=>$accomm->id, 'type'=>'accommodation'));
					$resort_villas = $this->common_model->get_row('mal_resorts', array('id'=>$accomm->resort_id));
                    $category = $this->common_model->get_row('mal_category', array('id'=>$resort_villas->resort_category));
				   ?>

                <div class="col-lg-6 col-md-6 col-12 mb-4">
                  <div class="box new_villa_hgtr">
                      <div class="img-content">
                          <?php
                              if(!empty($ac_images->image_name)&&file_exists('uploads/resorts/thumbnails/500_'.$ac_images->image_name)){?>
                                  <a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($accomm->resort_id)); ?>">
                                      <img src="<?php echo  base_url().'uploads/resorts/thumbnails/500_'.$ac_images->image_name ;?>" alt="Resort" class="img-fluid HomeImage">
                                  </a>
                          <?php } else{ ?>
                              <img src="<?php echo FRONT_THEAM_PATH?>images/No_Image_Available.jpg" class="img-fluid HomeImage">
                          <?php } ?>

                          <div class="image-text-container">
                              <div class="d-flex justify-content-between">
                                  <div class="img-content-title-container">
                                      <div class="img-content-title new_full_villa"><a href="<?php echo base_url('resort-detail?&resort_id='.base64_encode($accomm->resort_id)); ?>"><?php echo $accomm->resort_name;?></a></div>
                                      
                                     
            							
            						<div class="img-content-title new_one ne_letter">
            						    <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>">
            						        <?php //echo $villa_type_name?>
            						        <?php 
												for($i=0;$i< $category->no_of_star;$i++){ 
													?>
														<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i> 
													<?php 
												} 
											?>
										    <span class="new_tab_hg"><?php echo $category->category_name;?></span>
											
            						    </a>
            						  </div>	
            						  
            						   <div class="img-content-title new_one">
    									    <a class=""><?php $state_name = $this->developer_model->resort_detail($accomm->resort_id); ?></span>
            								<a class=""><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?></span>
            							</div>
            							
                                      <div class="d-flex">
                                          <!--<span class="description ml-1"><?php echo $villa_type_name;?></span>-->
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
                      <div class="img-bottom-contianer inspiration-readmore-result">
                          <div class="img-bottom-contianer-description smalldesc">
                               <div class="featured_villas_img_title">
                                                  <div class="img-content-title-container">
                                                        <div class="img-content-title ">
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
                                                       <!--   <span class="description ml-1"><?php //echo $villa_type_name;?></span>-->
                                                       <!--</div>-->
                                                    </div>
                                                </div>  
                              <span id="charater" class=""><?php echo $accomm->description;?></span>
                              <?php if(isset($resort_highlights[$accomm->resort_id]) && !empty($resort_highlights[$accomm->resort_id])) {?>
                              <!--<div class="facilities">-->
                              <!--    <div class="facilities-title">Highlights</div>-->
                              <!--    <div class="facilities-items row mt-2">-->
                              <!--    <//?php -->
                              <!--      foreach($resort_highlights[$accomm->resort_id] as $key=>$val) {?>-->
                              <!--          <div class="facilities-item col-6 col-md-4"><//?php echo $val;?></div>-->
                              <!--      <//?php }?>-->
                              <!--    </div>-->
                              <!--</div>-->
                              <?php }?>
                              <!--<div class="transfer-types">-->
                              <!--    <div class="transfer-types-title">Maximum Occupancy 2 adults & 2 kids</div>-->
                              <!--</div>-->
                              
                              <div class="transfer-types">
									<div class="transfer-types-title maximum_occupancy">
										<span class="occupancy">Maximum Occupancy</span>: 2 adults &amp; 2 kids
									</div>
							</div>
                              <div class="ideal new_villase">
                                  <!--<a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#facilities_details" onclick="facilities_details('<?php echo !empty($resort->id)?$resort->id:''; ?>');">Facilities</a>-->
                                  <a class="ideal-link facilities" href="javascript:void(0);" data-toggle="modal" data-target="#amenities_details" onclick="amenities_details('<?php echo !empty($accomm->resort_id)?$accomm->resort_id:''; ?>');">Amenities</a>
									
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

                
					  
                 
				<?php }
				}else{ ?>
			<div >No Record Found</div>
			<?php } ?>
<script>
        $('.inspiration-readmore-result').find('.card-read-more').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more').text(this.expand?"Hide Content":"Read more");
        $('.inspiration-readmore-result').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
    $('.FloorPlanLink').on('click', function() {
        $('#FloorPlanImage').attr('src',$(this).attr('myurl'));
        $('#Modal_FloorPlan').modal('show');
    });
</script>