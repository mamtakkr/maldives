<?php
   if (!empty($stories)) {
      foreach ($stories as $story) {
?>
   <div class="reviews-container">
      <div class="row my-3">
            <div class="col-lg-12 col-md-12 col-12">
               <div class="guest-reviews-details">
                  <div>
                        <div class="guest-reviews-details-top">
                           <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>" class="guest-reviews-name-link"><?php echo ucwords($story->resort_name); ?></a>
                           <div>
                              <img src="<?php echo  FRONT_THEAM_PATH ;?>images/click.png" alt="click.png" class="img-fluid ml-4 mr-1">
                              <a href="<?= base_url('resort-detail?&resort_id='.base64_encode($story->resort_id)); ?>"> </a>
                                    <span class="verified"><?php echo $story->title;?></span>
                           </div>
                        </div>
                        <div><?php echo ucfirst(strip_tags($story->description));?></div>
                        <div class="guest-reviews-gallery">
                           <?php
                              if (!empty($story->image_name) && $story->image_name!="") {
                                 $images = explode(",",$story->image_name);
                                 foreach ($images as $key=>$val) {
                                       if (!empty($images[$key]) && file_exists('uploads/resorts/thumbnails/150_' . $images[$key])) { ?>
                                          <img src="<?php echo base_url() . 'uploads/resorts/thumbnails/150_' . $images[$key]; ?>" alt="" class="img-fluid mr-2">
                                          <?php 
                                       } 
                                 } 
                              } ?>
                           </div>

                  </div>
               </div>
            </div>
      </div>
   </div>
   <?php   }
}?>