<!--== HERO-BANNER START ==-->
<div class="hero">
   <div class="hero-image">
      <div class="custom1 owl-carousel owl-theme">
         <?php 
         if(!empty($caption_imgs)){
            foreach($caption_imgs as $caption_img){
               if(!empty($caption_img->image_name)&&file_exists('uploads/caption/'.$caption_img->image_name)){?>
                  <div class="item"> 
                     <div class="caption_heading">
                        <?php 
                        echo !empty($caption->caption_title)?'<div class="text_holder">'.$caption->caption_title.'</div>':''; 
                        echo !empty($caption->caption_sub_title)?'<div class="text_sub_holder">'.$caption->caption_sub_title.'</div>':'';  
                        ?>
                     </div>
                     <img src="<?php echo  base_url('uploads/caption/'.$caption_img->image_name); ;?>"> 
                  </div>
               <?php 
               }
            }
         }
         ?>
      </div>
   </div>
</div>
<!--== HERO-BANNER START ==-->
<!--== RESORT START ==-->
<section class=" resort about">
   <div class="container-fluid p-0">
      <div class="container">
         <!-- <div class="title text-center mt-5">
            <div class="row">
               <div class="col-md-6">
                  <div class="comm-card">
                     <h3 class="mb-3">Vision</h3>
                     <?php echo site_info('our_vision'); ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="comm-card">
                     <h3  class="mb-3">Mission</h3>
                     <div class="clearfix"></div>
                     <?php echo site_info('our_mission'); ?>
                  </div>
               </div>
            </div>
         </div> -->
         <div class="clearfix"></div>
         <?php echo site_info('about_us'); ?>
      </div>
   </div>
   <div class="clearfix"></div>
</section>