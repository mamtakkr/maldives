    
	<section>
		<div class="transfer-header-banner">
			<div class="transfer-inner-slider owl-carousel owl-theme">
				<?php    
				$img=0; 
				if(!empty($caption_imgs)) {
				foreach($caption_imgs as $caption_img){
					if(file_exists('uploads/caption/'.$caption_img->image_name)){?>
					<div class="box" style="background-image:url('<?php echo base_url('uploads/caption/'.$caption_img->image_name);?>')">
						<div class="transfer-header-title">
							<h1><?php echo !empty($caption->caption_sub_title)?$caption->caption_sub_title:''; ?>...</h1>
							<h2><span><?php echo !empty($caption->caption_title)?strtoupper($caption->caption_title):''; ?></span></h2>
						</div>
					</div>
				<?php 
					}
				} }?>
			</div>
		</div>
	</section>
	<section>
		<div class="about">
			<div class="about-title">
				<h2>MEASURE DISTANCE</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
			</div>
			<div class="about-description">
				<span class="more">
					The few adventurous travellers who came to the Maldives in the following years were limited to exploring the pristine islands close to Male. The natural and untouched beauty of the islands started to appeal an increasing number of inquisitive travellers, and the first resorts opened in 1972, all within reach of a boat from Male.
				</span>
			</div>
		</div>
		<div class="measure-distance">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="cal-distance-container p-3">
						<h4>Calculate Distance Between Two Islands</h4>
						<div class="row my-5">
							<div class="col-md-6 col-12">
								<label>From</label>
								<div>
								<select class="custom-select mb-3" id="resort_first" name="resort_first" onchange="calculate_distance1();">
									<option value="">Select</option>
									<?php 
									if(!empty($resorts_places)){
										foreach($resorts_places as $resort){ 
											echo '<option value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';
										}
									}
									?>
								</select>
								</div>
							</div>
							<div class="col-md-6 col-12">
								<label>To</label>
								<div>
								<select class="custom-select mb-3" id="resort_second" name="resort_second" onchange="calculate_distance2();">
									<option value="">Select</option>
									<?php 
									if(!empty($resorts_places)){
										foreach($resorts_places as $resort){ 
											echo '<option value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';
										}
									}
									?>
								</select>
								</div>
							</div>
						</div>
						<div class="total-distance">
							<div class="total-distance-text1">Total Distance</div>
							<div class="dis"> <p id="distance_result"></p></div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="speed-boat-container">
						<div class="speed-boat-container-image"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Sppedboat.png" alt="Sppedboat.png" class="img-fluid my-3" /></div>
						<div class="speed-boat-container-title mb-2">Speed Boat</div>
						<div class="speed-boat-container-time mb-2"><div class="dis" id="Speed_Boat_Distance"></div></div>
						<div class="speed-boat-container-assumption mb-2">
							<span class="speed-boat-container-assumption-title">Assumption :</span>
							<span> Approximately 30 Knots</span>
						</div>
						<div class="note-container">
							<div class="note-text">Note:</div>
							<div>Speedboat may not travel for a very long distances.</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="speed-boat-container">
						<div class="speed-boat-container-image"><img src="<?php echo  FRONT_THEAM_PATH ;?>images/seaplane.png" alt="seaplane.png" class="img-fluid my-3" /></div>
						<div class="speed-boat-container-title mb-2">Seaplane</div>
						<div class="speed-boat-container-time mb-2"><div class="dis" id="Seaplan_Distance"></div></div>
						<div class="speed-boat-container-assumption mb-2">
							<span class="speed-boat-container-assumption-title">Assumption :</span>
							<span> Approximately 30 Knots</span>
						</div>
						<div class="note-container">
							<div class="note-text">Note:</div>
							<div>Speedboat may not travel for a very long distances.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="about bg-light py-5">
			<div class="about-title">
				<h2>TRAVEL SERVICE PROVIDERS</h2>
				<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="Rectangle6.png" class="img-fluid">
			</div>
			<div class="about-description">
				<span class="more">
					The few adventurous travellers who came to the Maldives in the following years were limited to exploring the pristine islands close to Male. The natural and untouched beauty of the islands started to appeal an increasing number of inquisitive travellers, and the first resorts opened in 1972, all within reach of a boat from Male.
				</span>
			</div>
			<div class="about-slider owl-carousel owl-theme mt-5">
				<?php 
					if($travel_partner){
		  				foreach($travel_partner as $part){
			  				$airport_type = $this->common_model->get_row('international_airport_type', array('id'=>$part->airport_type));?>
							<div class="box">
								<?php if(!empty($part->image)&&file_exists('uploads/transfer/travel_partner/'.$part->image)){ 
									echo '<img src="'.base_url('uploads/transfer/travel_partner/'.$part->image).'"  class="img-fluid  HomeImage" />'; 
									}
								?>
								<div class="about-slider-bottom">
									<div class="about-slider-bottom-description">
										<div class="about-slider-bottom-description-title d-flex mb-2">
											<div class="about-slider-bottom-description-title1"><?php echo ucfirst($part->title);?></div>
											<div class="about-slider-bottom-description-title2 ml-2"><?php echo ucfirst($airport_type->airport_type_name);?></div>
										</div>
										<span class="more"><?php echo ucfirst(strip_tags($part->description));?></span>
										
									</div>
								</div>
							</div>
				<?php }
					}
				?>
			</div>
		</div>
	</section>
	<section>
		<div class="py-2">
			<div class="inspiration">
				<div class="inspiration-title">
					<h2>AIRPORTS IN MALDIVES</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="inspiration-description">
					<span class="more">
						Maldives Experts is a one stop travel platform for clients and travel agents to find best matching
						holiday for themselves or for their clients. We are not a travel agency or a booking engine. Maldives
						Experts is a one stop travel platform for clients and travel agents to find best matching holiday for
						themselves or for their We are not a travel agency or a booking engine.
					</span>
				</div>
				<div class="inspiration-slider owl-carousel owl-theme mt-5">
					<?php 
					if($international_airports) {
		  				foreach($international_airports as $int_airport){?>
							<div class="box">
								<div class="img-content">
									<?php
										if(!empty($int_airport->image)&&file_exists('uploads/transfer/airport/'.$int_airport->image)){ 
										echo '<img src="'.base_url('uploads/transfer/airport/'.$int_airport->image).'"  class="img-fluid  HomeImage" />'; 
									} ?>
									<div class="image-text-container">
										<div class="d-flex justify-content-between">
											<div class="img-content-title-container">
												<div class="img-content-title"><?php echo $int_airport->name;?></div>
												<div>
													<span class="description ml-1"><?php echo $int_airport->address;?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="img-bottom-contianer inspiration-readmore">
									<div class="img-bottom-contianer-description smalldesc">
										<span class=""><?php echo $int_airport->description;?></span>
										<div class="facilities">
											<div class="facilities-title">Highlights</div>
											<div class="facilities-items row mt-2">
												<?php 
													if($int_airport->highlights){
														$inhighlights = explode("##", $int_airport->highlights);
														foreach($inhighlights as $inhigh){;?>
															<div class="facilities-item col-6 col-md-6"><?php echo $inhigh;?></div>
															<?php 
														}
													}
													?>
											</div>
										</div>
									</div>
									<div class="card-read-more-container">
										<a href="#" class="card-read-more btn">Read More</a>
									</div>
								</div>
							</div>
					<?php }
					}?>
					<?php 
					if($domestic_airports) {
		  				foreach($domestic_airports as $dom_airport){?>
						  <div class="box">
								<div class="img-content">
									<?php
									if(!empty($dom_airport->image)&&file_exists('uploads/transfer/airport/'.$dom_airport->image)){ 
										echo '<img src="'.base_url('uploads/transfer/airport/'.$dom_airport->image).'"  class="img-fluid  HomeImage" />'; 
									} ?>
									<div class="image-text-container">
										<div class="d-flex justify-content-between">
											<div class="img-content-title-container">
												<div class="img-content-title"><?php echo $dom_airport->name;?></div>
												<div>
													<span class="description ml-1"><?php echo $dom_airport->address;?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="img-bottom-contianer inspiration-readmore">
									<div class="img-bottom-contianer-description smalldesc">
										<span class=""><?php echo $dom_airport->description;?></span>
										<div class="facilities">
											<div class="facilities-title">Highlights</div>
											<div class="facilities-items row mt-2">
												<?php 
													if($dom_airport->highlights){
														$domhighlights = explode("##", $dom_airport->highlights);
														foreach($domhighlights as $dhigh){;?>
															<div class="facilities-item col-6 col-md-6"><?php echo $dhigh;?></div>
															<?php 
														}
													}
													?>
											</div>
										</div>
									</div>
									<div class="card-read-more-container">
										<a href="#" class="card-read-more btn">Read More</a>
									</div>
								</div>
							</div>
						  <?php 
						}
					}?>

				</div>
			</div>
		</div>
	</section>

    
    <script>
  //showmore
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 250;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "More";
    var lesstext = "Less";
    

    $('.more1').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
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
});
  </script>
  <script type="text/javascript">
   function calculate_distance1(){
      var resort_first  = $('#resort_first').val(); 
      var resort_second = $('#resort_second').val();
      $.ajax({ 
         url:base_url+"home/calculate_distance",
         type:"POST",
         data:{resort_first:resort_first,resort_second:resort_second, type:1}, 
         success: function(html){
            var response = $.parseJSON(html);  
            $('#Seaplan_Distance').html(response.seaplan);
            $('#Speed_Boat_Distance').html(response.speed_boat);
            $('#distance_result').html(response.distance);
            $('#resort_second').html(response.other_resort);
         }                
      });
   }
   function calculate_distance2(){
      var resort_first  = $('#resort_first').val(); 
      var resort_second = $('#resort_second').val();
      $.ajax({ 
         url:base_url+"home/calculate_distance",
         type:"POST",
         data:{resort_first:resort_first,resort_second:resort_second, type:2}, 
         success: function(html){
            var response = $.parseJSON(html);  
            $('#Seaplan_Distance').html(response.seaplan);
            $('#Speed_Boat_Distance').html(response.speed_boat);
            $('#distance_result').html(response.distance);
            $('#resort_first').html(response.other_resort);
         }                
      });
   }
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
