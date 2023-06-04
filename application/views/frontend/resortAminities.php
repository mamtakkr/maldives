<?php
$amenities  = $this->common_model->get_result('amenities', array('status'=>1), array(), array('id', 'asc'));

if(!empty($amenities)){
   foreach ($amenities as $aminity) {
      //if(!empty($aminity->amenitie_icon)&& file_exists('uploads/amenities/thumbnails/'.$aminity->amenitie_icon)){?>
         <li>
            <input type="checkbox" value="<?php echo $aminity->id; ?>" name="amenities[]" class="hidden" id="aminity_<?php echo $aminity->id; ?>" 
			<?php if(!empty($resortAminities) && in_array($aminity->id, $resortAminities)){echo 'checked';} ?>>
            <label for="aminity_<?php echo $aminity->id; ?>" class="lable_text">
               <div class="amenities-icon" for="aminity_<?php echo $aminity->id; ?>">
                  <?php 
                  if(!empty($aminity->amenitie_icon)&& file_exists('uploads/amenities/thumbnails/'.$aminity->amenitie_icon)){
                     echo '<img src="'.base_url().'uploads/amenities/thumbnails/'.$aminity->amenitie_icon.'"/>';
                  }else{
                     echo '<img src="'.base_url().'assets/front/img/No_Image_Available.jpg"/>';
                  }
                  ?> 
               </div>
               <div class="amenities-title">
                  <?php echo $aminity->amenitie_name; ?> 
               </div>
            </label>
            <div class="clearfix"></div>
         </li>
      <?php 
      //}
   }
}?>