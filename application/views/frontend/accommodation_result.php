<div id="accommodation_result">
	<div>
		<button class="blog-filter-btn btn"><i class="fa fa-sliders-h mr-2"></i>Filter</button>
        <div class="row">
				
<?php          
	$img    = 0;
	if(!empty($accommodations)){
  		foreach($accommodations as $accommodation){
	  		$villa_type_name = $accommodation->room_size." ". "sqm | ".$accommodation->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $accommodation->villa_type;
     		$ac_images =$this->common_model->get_result('images', array('item_id'=>$accommodation->id, 'type'=>'accommodation'));
     		$img   = 0;
     		$category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));
									   
	 		?>	
	 		    <div class="col-lg-6 col-md-6">
					<div class=" mb-5 accommodation-villa villa_result p-2 new_villa_result_file">
						<div class="">
							<div class="accommodation-slider owl-carousel">
								<?php $s=0; 
									if($ac_images) {
										foreach($ac_images as $img){
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
													<div>
														
													</div>
												</div>
												<?php 
												$s++;
										} 
									} 
								?>
								
							
							</div>
							
							
                          
						</div>
						
						<div class="">
						    <div class="image-text-container new_ville_rejot">
                             <div class="d-flex justify-content-between">
                                <div class="img-content-title-container">
                                    <div class="img-content-title new_full_villa">
                                            <a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accommodation->resort_id)); ?>">
											<?php echo $resort->resort_name;?>
											</a>
                                    </div>
                                   
                                   <div class="d-flex new_letter_s">
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
    								    <span class="description"><?php $state_name = $this->developer_model->resort_detail($accommodation->resort_id); ?></span>
        								<span class="description"><?php echo !empty($state_name->state_name) ? ucfirst($state_name->state_name) : ''; ?></span>
    							    </div>
    								
                                </div>
                             </div>
                          </div>
							<div class="img-bottom-contianer inspiration-readmore accommodation-villa ">
							    <div class="img-bottom-contianer-description smalldesc">
							<div class="pb-2 ">
								<div class="accommodation-villa-title new_villa_result_file new_villa_tittle_one"><?php echo $accommodation->name_of_villa; ?></div>
								<div class="accommodation-villa-description ml-1 mb-2"><?php echo $villa_type_name;?></div>
							</div>
								<span class="">
								    <?php echo !empty($accommodation->description)?$accommodation->description:''; ?>
								</span>
								<!--<hr />-->
								<!--<div class="accommodation-villa-title">Highlights</div>-->
								<!--<div class="row accommodation-villa-items">-->
									<?php //if(!empty($accommodation->villa_with_pool)&&$accommodation->villa_with_pool==1){?>
										<!--<div class="col-6 col-md-6 accommodation-villa-item my-1">Private Pool</div>-->
									<?php //} ?>
									<?php //if($accommodation->is_living_status==1){?>
										<!--<div class="col-6 col-md-6 accommodation-villa-item my-1">Living Room</div>-->
									<?php //} ?>
									<?php //if(!empty($resportAmenities)&& in_array('13', $resportAmenities)){
					                			?>
													<!--<div class="col-6 col-md-6 accommodation-villa-item my-1">Free Wifi</div>-->
												<?php
					                  		//} 
					             	?>
									 <!--<div class="col-6 col-md-6 accommodation-villa-item my-1"><?php echo !empty($accommodation->number_of_units)?ucfirst($accommodation->number_of_units):''; ?> No. of Units</div>-->
									 <?php //if( isset($accommodation->max_occupancy) && $accommodation->max_occupancy!=0){ ?>
										<!--<div class="col-6 col-md-6 accommodation-villa-item my-1">Max. Occupancy <?php echo $accommodation->max_occupancy; ?> Guest</div>-->
									<?php //} ?>	

									<?php //if($accommodation->villa_location){?>
										<!--<div class="col-6 col-md-6 accommodation-villa-item my-1"><?php echo !empty($accommodation->villa_location)?ucfirst($accommodation->villa_location):''; ?> Location</div>-->
									<?php //} ?>
								<!--</div>-->
								<div class="accommodation-villa-bottom-text mt-3 transfer-types">
									<div class="accommodation-villa-title maximum_occupancy">
									<?php //$accoms = !empty($accommodation->ac_ideals)?explode(',', $accommodation->ac_ideals):array();
								// 		if(!empty($accoms)){
								// 			foreach($accoms as $accom){
												?><span class="occupancy">Maximum Occupancy</span>: <?php echo $accommodation->ac_ideals;?><?php 
								// 			}
										//}?>
									</div>
								</div>
								<div class="accommodation-villa-bottom-links d-flex justify-content-between new_villase">
									<a class="facilities ideal-link" href="javascript:void(0);" data-toggle="modal" data-target="#amenities_details" onclick="amenities_details('<?php echo !empty($accommodation->id)?$accommodation->id:''; ?>');">Amenities</a>
									<?php 
										if(!empty($accommodation->floor_plan)&&file_exists('uploads/resorts/'.$accommodation->floor_plan)){
											?>
												<div><a href="javascript:void(0);" myurl="<?php echo  base_url().'uploads/resorts/'.$accommodation->floor_plan;?>"  class="ideal-link FloorPlanLink">Floor Plan</a></div>
											<?php 
										}
									?>
								</div>
								</div>
								<div class="card-read-more-container">
									<a href="#" class="card-read-more btn">Read More</a>
								</div>
							</div>
						</div>
					</div>
				</div>	
			<?php  
		
      	}
   	} else {
     echo '<div class="new_rew_rell">
       			<img src="'.FRONT_THEAM_PATH.'img/no_villa.png" alt="No Found" />
     			<div class="clearfix"></div>
     			<h4>All Villas & Suites Filtered Out!</h4>
     			<span>We couldn’t find any villas & suites matching the criteria. Please remove the filters applied and try again.</span>
      		</div>';
   }
   if(!empty($accommodation_count)&&$accommodation_count>3){?>
        <div class="col-lg-12">
    		<div class="btn-view-all text-center new_dis_font" id="show_all_accommodation">
    			<a href="javascript:void(0);" class="review-btn btn" onclick="show_all_accommodation();">
       				DISCOVER MORE
       			</a>
    		</div>
    	</div>	
	<?php 
	}?>
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
   function floor_plan_details_d(img_name, file_type){
      if(file_type=='pdf'){
        $('#floor_plan_details_pdf').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/'+img_name);
      }else{
        $('#floor_plan_details_img').show().attr('src', '<?php echo base_url(); ?>uploads/resorts/'+img_name);
      }     
   }   
</script>
<script type="text/javascript">
   $(document).ready(function() {
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
    navText:['<img src="./assets/front/images/Left_side.png" alt="Left_side.png" class="img-fluid">','<img src="./assets/front/images/Right_side.png" alt="Right_side.png" class="img-fluid">'],
})
      var showChar1 = 330;
      var ellipsestext1 = "...";
      var moretext1 = "more";
      var lesstext1 = "less";
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
   $('.FloorPlanLink').on('click', function() {
        $('#FloorPlanImage').attr('src',$(this).attr('myurl'));
        $('#Modal_FloorPlan').modal('show');
    });
    
    $('.inspiration-readmore').find('.card-read-more').on('click', function (e) {
        e.preventDefault();
        this.expand = !this.expand;
        $('.card-read-more').text(this.expand?"Hide Content":"Read More");
        $('.inspiration-readmore').find('.smalldesc, .bigdesc').toggleClass('smalldesc bigdesc');
    });
</script>

   