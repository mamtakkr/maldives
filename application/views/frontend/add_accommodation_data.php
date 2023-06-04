<style type="text/css">
   <?php 
   if(!empty($resort_id)){
      $accommodation_status = get_all_count('accommodation', array('resort_id'=>$resort_id));
   }
   if(!empty($images)){
      echo '#accommodation_photos_mains .file-upload-content{ display: block; }';
   }
   if(!empty($accommodationRow->floor_plan)){
      echo '#accommodation_floor_plan_mains35 .file-upload-content{ display: block; }
            #accommodation_floor_plan_mains_i .image-upload-wrap{ display: none; }';
   }
   ?>
</style>
<div class="col-sm-12 name_villa_section">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">
            Name of Villa <span class="text-danger">*</span>
         </label>
         <input type="text" class="form-control" name="name_of_villa" value="<?php if(!empty($accommodationRow->name_of_villa)){echo $accommodationRow->name_of_villa;} ?>" placeholder="Enter here">
      </div>
   </div>
</div>
<div class="col-sm-12 name_villa_section">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1"> 
            Description <span class="text-danger">* (max characters: 320)</span>
         </label>
         <textarea type="text" class="form-control" maxlength="320" placeholder="Enter here" name="description"><?php if(!empty($accommodationRow->description)){echo $accommodationRow->description;} ?></textarea>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Villa Type </label><span class="text-danger">*</span>
         <div class="form-group">
            <div class="row">
               <?php 
               if(!empty($villa_types)){
                  foreach($villa_types as $villa_type){?>
                  <div class="col-sm-4">
                     <div class="tick">
                        <div class="custom-control custom-radio ">
                           <input type="radio" id="villa_type_n_<?php echo $villa_type->id; ?>" name="villa_type" class="custom-control-input" value="<?php echo $villa_type->id; ?>" <?php if(!empty($accommodationRow->villa_type)&&$accommodationRow->villa_type==$villa_type->id){echo 'checked';} ?>>
                           <label class="custom-control-label" for="villa_type_n_<?php echo $villa_type->id; ?>">
                              <?php echo $villa_type->villa_type; ?>
                           </label>
                        </div>
                     </div>
                  </div>
                  <?php 
                  }
               }?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="row">
      <div class="col-md-12">
         <div class="resort-option">
            <div class="form-group">
               <label for="exampleInputEmail1">Number of rooms per Villa <span class="text-danger">*</span></label>
               <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="number_of_rooms_per_villa">
                  <option value="">Select Room</option>
                  <?php 
                  for($room=1; $room<=10;$room++){
                     if(!empty($accommodationRow->number_of_rooms_per_villa)&&$accommodationRow->number_of_rooms_per_villa==$room){
                        echo '<option selected value="'.$room.'">'.$room.' Room </option>';
                     }else{
                        echo '<option value="'.$room.'">'.$room.' Room </option>';
                     }
                  }?>
               </select>
            </div>
         </div>
      </div>
      <div class="col-md-12">
         <div class="resort-option">
            <div class="form-group">
               <label for="exampleInputEmail1">No of Units</label>
               <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="number_of_units">
                  <option value="">Select</option>
                  <?php 
                  for($un=1; $un<=100;$un++){
                     if(!empty($accommodationRow->number_of_units)&&$accommodationRow->number_of_units==$un){
                        echo ($un<10)?'<option selected value="'.$un.'">0'.$un:'<option selected value="'.$un.'">'.$un.'</option>';
                     }else{
                        echo ($un<10)?'<option value="'.$un.'">0'.$un:'<option value="'.$un.'">'.$un.' </option>';
                     }
                  ?>
                  <?php }?>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Villa with living room?</label>
         <div class="form-group">
            <div class="row">
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="is_living_status1" name="is_living_status" value="1" class="custom-control-input" <?php if(!empty($accommodationRow->is_living_status)&&$accommodationRow->is_living_status==1){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="is_living_status1">Yes</label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="is_living_status2" name="is_living_status" value="2" class="custom-control-input" <?php if(!empty($accommodationRow->is_living_status)&&$accommodationRow->is_living_status==2){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="is_living_status2">No</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Room size sqm</label>
         <input type="text" class="form-control only_number" placeholder="Enter here" name="room_size" value="<?php if(!empty($accommodationRow->room_size)){echo $accommodationRow->room_size;} ?>">
      </div>
   </div>
</div> 
<div class="col-sm-6">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Villa with a Pool?</label>
         <div class="form-group">
            <div class="row">
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_with_pool1" name="villa_with_pool" value="1" class="custom-control-input" <?php if(!empty($accommodationRow->villa_with_pool)&&$accommodationRow->villa_with_pool==1){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="villa_with_pool1">Yes</label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_with_pool2" name="villa_with_pool" value="2" class="custom-control-input" <?php if(!empty($accommodationRow->villa_with_pool)&&$accommodationRow->villa_with_pool==2){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="villa_with_pool2">No</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Villa location? </label>
         <div class="form-group">
            <div class="row">
               <div class="col-sm-3">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_location1" name="villa_location" value="sunset" class="custom-control-input" <?php if(!empty($accommodationRow->villa_location)&&$accommodationRow->villa_location=='sunset'){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="villa_location1">Sunset </label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_location2" name="villa_location" value="sunrise" class="custom-control-input" <?php if(!empty($accommodationRow->villa_location)&&$accommodationRow->villa_location=='sunrise'){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="villa_location2">Sunrise</label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_location4" name="villa_location" value="sunrise_sunset" class="custom-control-input" <?php if(!empty($accommodationRow->villa_location)&&$accommodationRow->villa_location=='sunrise_sunset'){ echo 'checked';}?>>
                        <label class="custom-control-label" for="villa_location4">Sunrise/Sunset</label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-3">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="villa_location3" name="villa_location" value="other" class="custom-control-input" <?php if(!empty($accommodationRow->villa_location)&&$accommodationRow->villa_location=='other'){ echo 'checked';} ?>>
                        <label class="custom-control-label" for="villa_location3">Other</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12 ">
   <div class="resort-option">
      <div class="form-group">
         <label>Ideal for </label>
         <div class="row">
            <?php 
            $accommodationRow_ideals = array();
            if(!empty($accommodationRow->ideal_for)){
               $accommodationRow_ideals = explode(',', $accommodationRow->ideal_for);
            }
            if(!empty($ideals)){
               foreach($ideals as $ideal){?>
               <div class="col-sm-6 col-md-6">
                  <div class="tick">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="ideal_<?php echo $ideal->id; ?>" name="ideal_for[]" value="<?php echo $ideal->id; ?>" <?php if(in_array($ideal->id, $accommodationRow_ideals)){echo 'checked';} ?>>
                        <label class="custom-control-label" for="ideal_<?php echo $ideal->id; ?>"><?php echo $ideal->ideal_name; ?></label>
                     </div>
                  </div>
               </div>
               <?php 
                  if($ideal->ideal_name==3){
                     echo '<small class="color-gry">Note: Kids below 12 years</small>';
                  }
               }
             }
            ?> 
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label> Upload Photos</label>
         <div class="upload-doc">
            <div class="form-group">
               <div class="file-upload" id="accommodation_photos_mains_i">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input"  type='file' id="accommodation_photos" onchange="accommodation_photos_new();" accept="image/*" multiple="multiple"/>
                     <div class="drag-text">
                        <h3>
                           <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                           <div class="clearfix"></div>
                           Upload your photos
                           <div class="clearfix"></div>
                           <small>Just drop them here</small> 
                           <ul class="note-msg">
                              <li>
                                 Upload Landscape Image
                              </li>   
                             <li>                                
                                The photos should be <span>PNG</span>, <span>JPG</span> and <span> JPEG  file format
                             </li> 
                             <li>
                                Photos need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                             </li> 
                             <li>
                               Photo can be maximum <span>10 MB</span> size
                             </li>
                           </ul>
                        </h3>
                     </div>
                     <div class="new_loader" style="display: none;"></div>
                  </div>
                  <div id="resort_images_main">
                     <?php 
                     if(!empty($images)&&$this->input->post('accommodation_id')){ 
                        foreach ($images as $image) {
                           if(!empty($image->image_name)&&file_exists('uploads/resorts/'.$image->image_name)){
                              $randT      = rand(000,999).time();
                              $deletImg   = "deleteAcommodationImage('".$randT."','".$image->image_name."', '".$image->id."')";
                              $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                              echo $html;
                           }
                        }
                     }
                     ?>
                  </div>                              
                  <input type="hidden" id="resortImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                  <div id="accommodation_photos_error" class="error"></div>
                  <input type="hidden" name="photos" id="accommodation_photos_val">
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label> Upload floor plan</label>
         <div class="upload-doc">
            <div class="form-group">
               <div class="file-upload" id="accommodation_floor_plan_mains_i">
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type="file" onchange="accommodation_floor_plan_new();" id="accommodation_floor_plan" accept="image/*">
                     <div class="drag-text">
                        <h3>
                           <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                           <div class="clearfix"></div>
                           Upload your floor plan
                           <div class="clearfix"></div>
                           <small>Just drop them here</small> 
                           <ul class="note-msg">
                              <li>
                                 Upload Landscape Image
                              </li>   
                             <li>                                
                                The floor plan should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span>, <span> PDF </span>, <span>docx</span> and <span>doc</span> file format
                             </li> 
                             <li>
                                Floor plan need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                             </li> 
                             <li>
                               Floor plan can be maximum <span>10 MB</span> size
                             </li>
                           </ul>
                        </h3>
                     </div>
                     <div class="new_loader1" style="display: none;"></div>
                  </div>
                  <div id="accommodation_floor_plan_mains35">
                     <?php 
                     if(!empty($accommodationRow->floor_plan)){
                        $fileTypes  = explode('.', $accommodationRow->floor_plan);
                        $fileType   = strtolower(end($fileTypes)); 
                        $randT      = rand(000,999).time();
                        $deletImg   = "delete_accommodation_floor_plan('".$randT."','".$accommodationRow->floor_plan."')"; 
                        $html       = '<div id="'.$randT.'" class="file-upload-content">';
                        if($fileType=='pdf'){                           
                           $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$accommodationRow->floor_plan.'" alt="floor plan"></iframe>';
                        }else if($fileType=='doc'||$fileType=='docx'){                           
                           $html   .= '<a href="' .base_url() . 'uploads/resorts/'.$accommodationRow->floor_plan.'" target="_blank"><img class="file-upload-image" src="'.base_url().'assets/front/img/document_icon.png" alt="floor plan"></a>';
                        }else{
                           $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$accommodationRow->floor_plan.'" alt="floor plan">';
                        }
                        $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                        echo $html;
                     }
                     ?>
                  </div>
                  <div id="accommodation_floor_plan_error"></div>
                  <input type="hidden" name="floor_plan" id="accommodation_floor_plan_val">
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="col-md-12">
   <div class="wizard-left pr-0">
      <h6>Choose the Aminities</h6>
      <div class="clearfix"></div>
      <div class="resort-option facilities">
         <div class="form-group">
            <?php 
            if(!empty($accommodation_status)){?>
               <label for="old_faclility">               
                  <input type="checkbox" id="old_aminity" name="old_aminity" onclick="old_aminities();" value="1">
                  Previous Accommodation Aminities
               </label>
            <?php }?>
            <div class="amenities">
               <div class="clearfix"></div>
               <ul id="aminities_data">
                  <?php 
                  $resortAminities = array();
                  if(!empty($accommodationRow->amenities)){
                     $resortAminities = explode(',', $accommodationRow->amenities);
                  }
                  include('resortAminities.php');
                  ?>                    
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>
