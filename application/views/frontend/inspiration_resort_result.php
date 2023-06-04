<?php 
    if(!empty($resorts)){
            // echo "<pre>"; var_dump($resorts); die; 
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
											   	
											   	$airportType = $this->developer_model->user_international_airports($resort->id);
											   	
											if(!empty($airportType)) {
												foreach($airportType as $key=>$val) {?>
												
												<div class="col-lg-6 col-md-6 col-6">
											       <div class="new_highlights d-flex">
											           <div class="first_highlights">
											               <h6 class="title_hightlights"><?php echo $airportType[$key]->airport_type_name;?></h6>
											           </div>
											           <div class="second_highlights">
											              <p class="text_new_hightlights"> 
											                <?php 
															$hours = "";
															$Minutes = "";
															
															if($airportType[$key]->hour1 > 0) {
																$hours .= $airportType[$key]->hour1." Hrs ";
															}
															if($airportType[$key]->minuts1 > 0) {
																$Minutes .= $airportType[$key]->minuts1." Mins ";
															}
															if($airportType[$key]->hour2 > 0) {
																$hours .= $airportType[$key]->hour2." Hrs ";
															}
															if($airportType[$key]->minuts2 > 0) {
																$Minutes .= $airportType[$key]->minuts2." Mins ";
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
                             <a href="#" class="card-read-more btn">Read More</a>
                          </div>
                        </div>
                    </div>
                </div>
            <?php
        }
    }
else{ ?>
	<div >No Record Found</div>
	<?php } ?>
<script>
        $('.inspiration-readmore').find('.card-read-more').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more').text(this.expand?"Hide Content":"Read More");
        $('.inspiration-readmore').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
</script>