<section>
		<div class="reviews-header-banner">
			<div class="reviews-slider owl-carousel owl-theme">
				<?php 
                    $img=0; 
					if(!empty($caption_imgs)) {
					foreach($caption_imgs as $caption_img){
						if(file_exists('uploads/caption/'.$caption_img->image_name)){?>
                <div class="box" style="background-image:url('<?php echo base_url('uploads/caption/'.$caption_img->image_name); ?>')">
					<div class="reviews-header-title">
						<h1><span><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?>...</h1>
						<h2><?php echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>
					</div>
				</div>
                <?php } } }?>
			</div>
		</div>
	</section>
  <div class="clearfix"></div>
  
  
  <div class="faq" id="faq">
    <div class="container">
      <h2 class="text-center">GALLERY</h2>
      <div class="img-gallery">
      <div class="tz-gallery">
		<div class="gallery">
			<div class="row" id="gallery_images">
			<?php foreach($galllery_images as $gal){?>

				<!-- <div class="container-fluid">
					<div class="row"> -->
						<?php  
							//foreach($images as $key=>$val) {
								if(!empty($gal->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$gal->image_name)){
									?>
									<div class="col-md-4 col-6 my-3 gallery_item">
										<div class="insta-feed-wrapper">
										<div class="img-container bg-success">
											<a href="<?= base_url('resort-detail?&resort_id='.base64_encode($gal->item_id)); ?>">
												<img src="<?php echo  base_url().'uploads/resorts/full_image/1300_'.$gal->image_name;?>" alt="" class="img-fluid HomeImage" />
											</a>
										</div>
										</div>
									</div>
								<?php 
								}
							//}
						?>
					<!-- </div>
				</div> -->

				<!-- <div class="col-sm-6  col-md-4 col-lg-4 gallery_item"> 
					<a class="lightbox" href="<?php echo  base_url().'uploads/resorts/full_image/1300_'.$gal->image_name ;?>">
						<div class="gallery-card"> 
						<?php  //if(!empty($gal->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$gal->image_name)){?>
							<img src="<?php echo  base_url().'uploads/resorts/full_image/1300_'.$gal->image_name ;?>" alt="">
							<?php //}?>
						</div>
					</a> 
				</div> -->
			<?php }?>
			</div>
		  </div>
	  </div>
      </div>
      
      <div class="text-center">
        <button type="button" class="btn btn-primary " onclick="view_more_images();">View More</button>
      </div>
    </div>
  </div>
<script type="text/javascript">
	function view_more_images(){
		prev_record_count =  $('.gallery_item').length;
		$.ajax({
         url:'<?php echo base_url(); ?>home/get_more_images',
         type:'post',
         data:{'prev_record_count':prev_record_count}, 
         success:function(html){
			if(html){
				$("#gallery_images").append(html);
			}
         }
      });
   }  
</script>
<script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>