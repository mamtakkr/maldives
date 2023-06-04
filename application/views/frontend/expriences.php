


 <section>
		<div class="header-banner" style="background-image:url('<?php echo base_url(); ?>uploads/caption/resort-sky-bay-travel-exotic.jpg')">
			<div class="header-title">
				<!--<h1>Milaidhoo Island</h1>-->
				<h2> Experiences</h2>
			</div>
		</div>
</section> 

	
	
	
	
	<section class="signture_exprrienes destop_exprrienes new_exprrienes_sr">
	  <div class="container"> 
	    <div class="featured_resorts" style="text-align:center;">
				<h2>SIGNATURE EXPERIENCES </h2>
				<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
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
									
									?>
									<div class="col-lg-4 mb-lg-4">
										<div class="box">
										    <div class="img-content">
													<img src="<?php echo  $ImagePath ;?>" alt="<?php if(!empty($ac_images->image_name)) { echo $ac_images->image_name;}?>" class="img-fluid HomeImage">
													<div class="image-text-container">
														<div class="d-flex justify-content-between">
															<div class="img-content-title-container">
																<div class="img-content-title"><a href="<?php echo base_url('resort-detail?type=reviews&resort_id='.base64_encode($exprience->resort_id)); ?>"><?php echo $exprience->resort_name;?></a></div>
						
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
                									<a href="#" class="card-read-more btn">Read More</a>
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
						<!--<div class="d-flex justify-content-center my-4">-->
						<!--	<a href="<?php echo base_url();?>inspiration" class="view-more-link">Discover More </a>-->
						<!--</div>-->
			</div>			
	</section>
	
	
</div>

<script type="text/javascript">
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

