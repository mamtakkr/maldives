<?php 
if(!empty($caption_imgs)) {
foreach($caption_imgs as $caption_img) {
	$bannerImaage = $caption_img->image_name;
}
}
?>
<section>
	<div class="hotels-header-banner">
		<div class="">
			<div class="box"  style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage); ?>')">
				<div class="hotels-header-title">
					<h1><span><?php echo $caption->caption_title;?></h1>
					<h2><?php echo $caption->caption_sub_title;?></h2>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="section-accommodation" class="new_one_tr">
	<div class="about">
		<div class="about-title">
			<h2>RESORT & HOTELS</h2>
			<img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Rectangle6.png" alt="" class="img-fluid">
		</div>
		<div class="about-description">
			<span class="more">
				Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
			</span>
		</div>
	</div>
	<div class="accommodation">
		<div class="blogs-items-container">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-12 overlay" id="myNav">
						<div class="blog-sidebar">
            				<form id="search_filtersNews">  
            					<div class="blog-sidebar-header">
									<span>FILTER BY RESORT</span>
									<a href="javascript:void(0)" class="closebtn"><i class="fa fa-times-circle"></i></a>
								</div>
            					<div class="blog-sidebar-items">
									<div class="blog-sidebar-item">
                  						<select class="custom-select" id="exp_resorts" name="exp_resort" onchange="form_filter();">
                    						<option value=''>Select Resort</option>
			                				<?php 
                      							if(!empty($resortsList)){
				                  					foreach($resortsList as $resort){?>
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
								</div>
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
                  <input type="checkbox" class="custom-control-input" id="holidays_fil_<?php echo $h->id; ?>" <?php if($this->input->get('holiday_id')&&$this->input->get('holiday_id')==$h->id){echo 'checked';} ?> name="holidays[]" value="<?php echo $h->id; ?>" onclick="form_filter();">
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="holidays_fil_<?php echo $h->id;?>"><?php echo $h->holiday_name;?> </label>
											</div>
										</div>
									</div>
              <?php } } ?>
								</div>




              <div class="blog-sidebar-items-title mt-4">
									<span class="blog-sidebar-items-title-text">Category</span>
									<span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items" style="display:none;">

              <?php 
              if(is_array($category)){
              foreach($category as $c){;?>
                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                  <input type="checkbox" class="custom-control-input" id="categorys_fil_<?php echo $c->id; ?>" name="categorys[]" value="<?php echo $c->id; ?>" onclick="form_filter();">
                  
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
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
                  <input type="checkbox" class="custom-control-input" name="atoll[]" id="location_<?php echo $l->id;?>"  value="<?php echo $l->id; ?>"  onclick="form_filter();">
                  
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
                  <input type="checkbox" class="custom-control-input" id="airports_fil_<?php echo $t->id; ?>" name="airports[]" value="<?php echo $t->id; ?>" onclick="form_filter();">
                  
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
                  <input type="checkbox" class="custom-control-input" id="facilities_fil_<?php echo $fac->id; ?>" name="facilities[]" value="<?php echo $fac->id; ?>" onclick="form_filter();">
                  
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="facilities_fil_<?php echo $fac->id;?>"><?php echo $fac->facility_name;?></label>
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
                  <input type="checkbox" class="custom-control-input" id="sport_fil_<?php echo $sport->id; ?>" name="sports[]" value="<?php echo $sport->id; ?>" onclick="form_filter();">
                  
											<div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="sport_fil_<?php echo $sport->id;?>"> <?php echo $sport->sport_name;?> </label>
											</div>
										</div>
									</div>
              <?php } } ?>
								</div>


              <div class="blog-sidebar-items-title mt-4">
									<span class="blog-sidebar-items-title-text">No. Of Villas</span>
									<span><i class="fa fa-plus blog-sidebar-items-title-icon"></i></span>
								</div>
								<div class="blog-sidebar-items" style="display:none;">
                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                    <input type="checkbox" name="no_of_villas[]" value="1,10" class="custom-control-input" id="villas_count_10" onclick="form_filter();">
                    <div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="villas_count_10"> 1 - 10 Villas </label>
											</div>
										</div>
									</div>

                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                  <input type="checkbox" name="no_of_villas[]" value="11,50" class="custom-control-input" id="villas_count_50" onclick="form_filter();">
                    <div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="villas_count_50"> 11 - 50 Villas </label>
											</div>
										</div>
									</div>

                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                  <input type="checkbox" name="no_of_villas[]" value="51,100" class="custom-control-input" id="villas_count_100" onclick="form_filter();">
                    <div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="villas_count_100"> 51 - 100 Villas </label>
											</div>
										</div>
									</div>


                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                  <input type="checkbox" name="no_of_villas[]" value="101,150" class="custom-control-input" id="villas_count_150" onclick="form_filter();">
                    <div class="state">
												<img class="image" src="<?php echo  FRONT_THEAM_PATH ;?>/images/Checkbox.png">
												<label class="custom-control-label" for="villas_count_150"> 100 - 150 Villas</label>
											</div>
										</div>
									</div>


                <div class="blog-sidebar-item">
										<div class="pretty p-image p-plain">
                  <input type="checkbox" name="no_of_villas[]" value="150,0" class="custom-control-input" id="villas_count_151" onclick="form_filter();">
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


					<div class="col-lg-10 col-md-12 mx-auto blog-innner-cards">
        
					<?php include('resort_list.php'); ?>
						<!-- <div class="d-flex justify-content-end mt-2">
							<a href="#" class="view-more-link">View More <img src="<?php echo  FRONT_THEAM_PATH ;?>/images/Viewmore.png" alt="Viewmore.png" class="img-fluid" /></a>
						</div> -->
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
    

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
	$('#offset_val').val('0');
	offset = 0;

  $.ajax({
     url:'<?php echo base_url('home/resort_list'); ?>',
     type:'POST',
	 //data:{'offset':offset}, 
     data:$("#search_filtersNews").serialize()+'&offset='+offset, 
     success:function(data){ 
      var $page_data = $(data);
      $('#preloaderMainss').hide();
      $('#ajax_resultss').html(data);
      $('#sort_order').val('');
	  $('#offset_val').val(offset);

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
	  });
     }
  });
}
//  $('.carousel').carousel({
//    interval: 2000
//  });   

function view_more_resorts(){
	var offset =  $('#offset_val').val();
	offset = parseInt(offset)+6;
	$.ajax(
	{
     url:'<?php echo base_url(); ?>home/ajax_resort_list',
     type:'post',
     
	 data:$("#search_filtersNews").serialize()+'&offset='+offset, 
    dataType:'json',                  
    success: function(data){
		if(data=="NoRecord") {
			$('.ViewAllBtn').hide();
		} else {
			$("#offset_val").val(offset);
			$("#ajax_resort_list").append(data.final_output);
		}
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
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl-thumb.js"></script>
	