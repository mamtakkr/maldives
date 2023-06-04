<?php
$facilities  = $this->common_model->get_result('facilities', array('status'=>1), array(), array('id', 'asc'));
if(!empty($facilities)){
   foreach ($facilities as $facilitie) {
      if(!empty($facilitie->facility_img)&&file_exists('uploads/facilities/thumbnails/'.$facilitie->facility_img)){?>
         <li>
            <input type="checkbox" value="<?php echo $facilitie->id; ?>" name="facilities[]" class="hidden" id="facilitie_<?php echo $facilitie->id; ?>" <?php if(!empty($resortFacilities)&&in_array($facilitie->id, $resortFacilities)){echo 'checked';} ?>>
            <label for="facilitie_<?php echo $facilitie->id; ?>" class="lable_text">
               <div class="amenities-icon" for="facilitie_<?php echo $facilitie->id; ?>">
                  <?php 
                  if(!empty($facilitie->facility_img)&&file_exists('uploads/facilities/thumbnails/'.$facilitie->facility_img)){
                     echo '<img src="'.base_url().'uploads/facilities/thumbnails/'.$facilitie->facility_img.'"/>';
                  }else{
                     echo '<img src="'.base_url().'img/facilities-icon1.png"/>';
                  }
                  ?> 
               </div>
               <div class="amenities-title">
                  <?php echo $facilitie->facility_name; ?> 
               </div>
            </label>
            <div class="clearfix"></div>
         </li>
      <?php 
      }
   }
}?>