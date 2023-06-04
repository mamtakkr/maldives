

<section>
		<div class="header-banner" style="background-image:url('<?php echo base_url(); ?>uploads/caption/swimming-pool.jpg')">
			<div class="header-title">
				<!--<h1>Milaidhoo Island</h1>-->
				<h2>Villas & Suites</h2>
			</div>
		</div>
</section>
  

	
	
	
	
	<section class="Featured_villas destop_villas new_villas_sr">
	    <div class="container"> 
	    <div class="featured_resorts" style="text-align:center;">
				<h2>FEATURED  VILLAS & SUITES </h2>
				<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
			</div>
	    <!--<div class="inspiration-slider owl-carousel owl-theme">-->
	   <div class="row">     


							<?php 
								if($accommodations) {
									foreach($accommodations as $accomm) {
									   $villa_types = $this->common_model->get_row('mal_villa_type', array('status'=>1, 'id'=>$accomm->villa_type));
									   $villa_type_name = $accomm->room_size." ". "sqm | ".$accomm->number_of_rooms_per_villa." "."Bedroom"." "."Villa | ". $villa_types->villa_type;
     	                               $resort = $this->common_model->get_row('mal_resorts', array('id'=>$accomm->resort_id));
     	                               $category = $this->common_model->get_row('mal_category', array('id'=>$resort->resort_category));
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
																<div class="img-content-title"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($accomm->resort_id)); ?>"><?php echo $accomm->resort_name?></a></div>
																
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
															<?php echo character_limiter($accomm->description,190);?>
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
														<div class="ideal madal_click new_villase">
															<div class="ideal-title">
															    <!--<a class="ideal-link" href="#">Facilities</a>-->
															    <!--<a href="javascript:void(0);" class="ideal-link facilities" data-toggle="modal" data-target="#facilities_details" onclick="facilities_details('<?php echo !empty($accomm->resort_id)?$accomm->resort_id:''; ?>');">Facilities</a>-->
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
														<a href="#" class="card-read-more btn">Read More</a>
													</div>
												</div>
											</div>
										</div>	
									   <?php
									}
								}
							?>	
						</div>
						<!--<div class="d-flex justify-content-center my-4">-->
						<!--	<a href="<?php echo base_url();?>inspiration#accommodation" class="view-more-link">Discover More </a>-->
						<!--</div>-->
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
    var lesstext = "Read less";
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
    
    
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>

