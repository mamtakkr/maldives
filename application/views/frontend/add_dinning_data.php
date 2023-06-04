<div class="col-sm-6">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Name of the Restaurant<span class="text-danger">*</span></label>
         <input type="text" name="name_of_restaurant" value="<?php if(!empty($row->name_of_restaurant)){echo $row->name_of_restaurant;} ?>" class="form-control" placeholder="Enter here">
      </div>
   </div>
</div>
<div class="col-sm-12 ">
   <div class="resort-option">
      <div class="form-group">
         <label>Type </label>
         <div class="row">
            <?php 
            $resort_dinnings_type = array();
            if(!empty($row->restaurant_type)){
               $resort_dinnings_type = explode(',', $row->restaurant_type);
            }
            if(!empty($dinnings_type)){
               foreach ($dinnings_type as $dinning_type) {?>
                  <div class="col-sm-4 col-md-4">
                     <div class="tick">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" name="restaurant_type[]" value="<?php echo $dinning_type->id; ?>" class="custom-control-input" id="dinning_type_<?php echo $dinning_type->id; ?>" <?php if(!empty($dinning_type->id)&&in_array($dinning_type->id, $resort_dinnings_type)){echo 'checked';} ?>>
                           <label class="custom-control-label" for="dinning_type_<?php echo $dinning_type->id; ?>">
                              <?php 
                                 echo $dinning_type->dinnings_type; 
                              ?> 
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
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Description<span class="text-danger">* (max characters: 320)</span></label>
         <textarea rows="4" cols="50" maxlength="320" type="text" class="form-control" placeholder="Enter here" name="description"><?php if(!empty($row->description)){echo $row->description;} ?></textarea>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <div class="resort-option">
      <div class="form-group">
         <label>Upload Restaurant Images</label>
         <div class="upload-doc">
            <div class="form-group">
               <div class="file-upload" id="resort_images_main_i">
                  <div class="clearfix"></div>
                  <div class="image-upload-wrap">
                     <input class="file-upload-input" type='file' onchange="resortImagesImgNew();" accept="image/*" id="resortImagesImg" multiple="multiple" />
                     <div class="drag-text">
                        <h3>
                           <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                           <div class="clearfix"></div>
                           Upload your restaurant Images
                           <div class="clearfix"></div>
                           <small>Just drop them here</small> 
                           <ul class="note-msg">
                              <li>
                                 Upload Landscape Image
                              </li>   
                             <li>                                
                                The resort images should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> file format
                             </li> 
                             <li>
                                Resort images need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                             </li> 
                             <li>
                               Resort images can be maximum <span>10 MB</span> size
                             </li>
                             <li>
                               Upload up to <span>3</span> images at a time
                             </li>
                           </ul>
                        </h3>
                     </div>
                     <div class="new_loader" style="display: none;"></div>
                  </div>
                  <div id="resort_images_error" class="error"></div>
                  <div id="resort_images_main">
                     <?php 
                     if(!empty($images)){ 
                        foreach ($images as $image) {
                           if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){
                              $randT      = rand(000,999).time();
                              $deletImg   = "deleteRestaurantImage('".$randT."','".$image->image_name."', '".$image->id."')";
                              $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';
                              echo $html;
                           }
                        }
                     }
                     ?>
                  </div>                              
                  <input type="hidden" id="resortImagesCount" value="<?php echo !empty($images)?count($images):0;?>">
                  <input type="hidden" name="resort_images" id="resort_images">
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
         <label for="exampleInputEmail1">Meal Served </label>
         <?php 
         //echo '<pre>'; print_r($meal_serveds);
         $meal_styles = $this->common_model->get_result('meals_styles', array('status'=>1));
         if(!empty($meal_serveds)){
            foreach($meal_serveds  as $meal_served){
               if(!empty($row->id)){
                  $mealRow         = $this->common_model->get_row('dinnings_meal_served', array('dinning_id'=>$row->id, 'meal_served_status'=>$meal_served->id));
               }
               if(!empty($mealRow->menu_chart)){ 
                  echo '<style type="text/css">
                     #meal_served_menu_main_'.$meal_served->id.' .image-upload-wrap{ display:none;}
                     #meal_served_menu_img_'.$meal_served->id.'{ display:block;}
                     #meal_served_menu_img_'.$meal_served->id.' .file-upload-content{ display:block;}
                  </style>';
               }
              ?>              
               <div class="menu-served">
                  <div class="row">
                     <div class="col-sm-6">
                        <div class="row">
                           <div class="col-md-3 <?php if(empty($mealRow->meal_served_status)){echo ' left_mr_100';} ?>" id="meal_served_status_up_<?php echo $meal_served->id; ?>">
                              <div class="tick">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="meal_served_status_<?php echo $meal_served->id; ?>" value="<?php echo $meal_served->id; ?>" class="custom-control-input" id="meal_served_status_<?php echo $meal_served->id; ?>" <?php if(!empty($mealRow->meal_served_status)&&$mealRow->meal_served_status==$meal_served->id){echo 'checked';} ?>
                                    onclick="meal_served('<?php echo $meal_served->id; ?>');">
                                    <label class="custom-control-label" for="meal_served_status_<?php echo $meal_served->id; ?>">
                                       <?php 
                                          echo $meal_served->meal_served_title; 
                                       ?>
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4 meal_served_sub_<?php echo $meal_served->id; if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>">
                               <h6>Starting Time</h6>
                              <select name="open_hour_<?php echo !empty($meal_served->id)?$meal_served->id:'';?>" class="form-control" style="width: 49%;float: left;">
                                 <option value="">Hours</option>
                                 <?php 
                                 for($hr=0; $hr<24;$hr++){
                                    if(!empty($mealRow->open_hour)&&$mealRow->open_hour==$hr){
                                       echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                    }else{
                                       echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                    }
                                 }
                                 ?>
                              </select>                              
                              <select name="open_minut_<?php echo !empty($meal_served->id)?$meal_served->id:''; ?>" class="form-control" style="width: 49%; float: left;">
                                 <option value="">Minutes</option>
                                 <?php 
                                 for($hr=0; $hr<60;$hr=$hr+15){
                                    if(!empty($mealRow->open_minut)&&$mealRow->open_minut==$hr){
                                       echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                    }else{
                                       echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="col-md-1 meal_served_sub_<?php echo $meal_served->id;if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>"> To </div>
                           <div class="col-md-4 meal_served_sub_<?php echo $meal_served->id;if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>">
                              <h6>Closing Time</h6>
                              <select name="closing_hour_<?php echo !empty($meal_served->id)?$meal_served->id:'';?>" class="form-control" style="width: 49%;float: left;">
                                 <option value="">Hours</option>
                                 <?php 
                                 for($hr=0; $hr<24;$hr++){
                                    if(!empty($mealRow->closing_hour)&&$mealRow->closing_hour==$hr){
                                       echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                    }else{
                                       echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                    }
                                 }
                                 ?>
                              </select>
                              <select name="closing_minut_<?php echo !empty($meal_served->id)?$meal_served->id:''; ?>" class="form-control" style="width: 49%; float: left;">
                                 <option value="">Minutes</option>
                                 <?php 
                                 for($hr=0; $hr<60;$hr=$hr+15){
                                    if(!empty($mealRow->closing_minut)&&$mealRow->closing_minut==$hr){
                                       echo ($hr<10)?'<option selected value="'.$hr.'">0'.$hr.'</option>':'<option selected value="'.$hr.'">'.$hr.'</option>';
                                    }else{
                                       echo ($hr<10)?'<option value="'.$hr.'">0'.$hr.'</option>':'<option value="'.$hr.'">'.$hr.'</option>';
                                    }
                                 }
                                 ?>
                              </select>
                           </div>
                           <div class="col-md-3 <?php if(empty($mealRow->meal_served_status)){echo ' left_mr_100';} ?>" id="meal_served_status_up_<?php echo $meal_served->id; ?>">
                              &nbsp;                                 
                           </div>
                           <div class="col-md-9 meal_served_sub_<?php echo $meal_served->id; if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>">
                              <div class="tick">
                                 <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="no_time_<?php echo $meal_served->id; ?>" value="1" class="custom-control-input" id="no_time_<?php echo $meal_served->id; ?>" <?php if(!empty($mealRow->no_time)&&$mealRow->no_time=="1"){echo 'checked';} ?>>
                                    <label class="custom-control-label" for="no_time_<?php echo $meal_served->id; ?>">
                                       no opening or closing time
                                    </label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 meal_served_sub_<?php echo $meal_served->id;if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>">
                              <div class="form-group" style="margin-top: 40px;">
                                 <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="meal_style_<?php echo $meal_served->id; ?>">
                                    <option value="">Meal style </option>
                                    <?php 
                                    if(!empty($meal_styles)){
                                       foreach ($meal_styles as $meal_style) {
                                          if(!empty($meal_style)){
                                             if(!empty($mealRow->meal_type)&&$mealRow->meal_type==$meal_style->id){
                                                echo '<option selected value="'.$meal_style->id.'">'.$meal_style->meals_styles_title.' </option>'; 
                                             }else{
                                                echo '<option value="'.$meal_style->id.'">'.$meal_style->meals_styles_title.' </option>'; 
                                             } 
                                          }
                                       }
                                    }
                                    ?>  
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 meal_served_sub_<?php echo $meal_served->id;if(empty($mealRow->meal_served_status)){echo ' hide_cl';} ?>">
                        <div class="resort-option">
                           <div class="form-group">
                              <div class="upload-menu">
                                 <div class="form-group"> 
                                    <div class="file-upload" id="meal_served_menu_main_<?php echo $meal_served->id; ?>">
                                       <div class="image-upload-wrap">
                                          <input class="file-upload-input" id="meal_served_menu_<?php echo $meal_served->id; ?>" onchange="meal_served_menu('<?php echo $meal_served->id; ?>');" type="file">
                                          <div class="drag-text">
                                             <h3>
                                                <img src="<?php echo  FRONT_THEAM_PATH ;?>images/upload-photo.png">
                                                <div class="clearfix"></div>
                                                   Upload your menu
                                                <div class="clearfix"></div>
                                                <small>Just drop them here</small> 
                                                <ul class="note-msg">
                                                  <li>                                
                                                     The menu should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> and <span> PDF </span> file format
                                                  </li> 
                                                   <li>
                                                      Menu need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                                                   </li> 
                                                   <li>
                                                      Menu can be maximum <span>10 MB</span> size
                                                   </li>
                                                </ul>
                                             </h3>
                                          </div>
                                          <div class="new_loader" style="display: none;"></div>
                                       </div>
                                       <div id="meal_served_menu_img_<?php echo $meal_served->id; ?>">
                                       <?php 
                                       if(!empty($mealRow->menu_chart)){
                                          $randT      = rand(000,999).time();
                                          $deletImg   = "deleteMealServedMenu('".$meal_served->id."','".$randT."','".$mealRow->menu_chart."')"; 
                                          $html       = '<div id="'.$randT.'" class="file-upload-content"';
                                          /*if(!empty($mealRow->menu_chart)){ 
                                             $html    .= ' style="display: block;"';
                                          }*/
                                          $fileTypes  = explode('.', $mealRow->menu_chart);
                                          $fileType   = strtolower(end($fileTypes)); 
                                          $html       .= '>';
                                          if($fileType=='pdf'){       
                                             $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$mealRow->menu_chart.'" alt="resort affiliation"></iframe>';
                                          }else{
                                             $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$mealRow->menu_chart.'" alt="resort affiliation">';
                                          }
                                          $html       .='<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button></div></div>';
                                          echo $html;
                                       }
                                    ?>
                                    </div>
                                    <div id="meal_served_menu_img_<?php echo $meal_served->id; ?>_error"></div>
                                       <input type="hidden" name="menu_chart_<?php echo $meal_served->id; ?>" id="meal_served_menu_img_val_<?php echo $meal_served->id; ?>">
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <?php
            }
         }
         ?>
      </div>
   </div>
</div>
<div class="col-sm-12">
   <?php 
      $user_food_types = array();
      if(!empty($row->food_type)){
         $user_food_types = explode(',', $row->food_type);
      }
      $food_types = $this->common_model->get_result('food_types', array('status'=>1));
      if(!empty($food_types)){
         foreach($food_types as $food_type){ ?>
            <div class="resort-option">
               <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo !empty($food_type->food_type)?ucfirst($food_type->food_type):''; ?> option </label>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="tick">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>_1" name="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>" class="custom-control-input" value="1" <?php if(!empty($row->food_type)&&in_array($food_type->id, $user_food_types)){echo 'checked';} ?>>
                                 <label class="custom-control-label" for="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>_1">Yes </label>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="tick">
                              <div class="custom-control custom-radio">
                                 <input type="radio" id="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>_2" name="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>" value="2" class="custom-control-input" <?php if(!empty(!empty($row))&&!in_array($food_type->id, $user_food_types)){echo 'checked';} ?> >
                                 <label class="custom-control-label" for="food_type_<?php echo !empty($food_type->id)?$food_type->id:''; ?>_2">No</label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php 
         }
      }
   ?>
   <!-- <div class="resort-option">
      <div class="form-group">
         <label for="exampleInputEmail1">Halal option </label>
         <div class="form-group">
            <div class="row">
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="halal_option_1" name="halal_option" class="custom-control-input" value="1" <?php if(!empty($row->halal_option)&&$row->halal_option==1){echo 'checked';} ?>>
                        <label class="custom-control-label" for="halal_option_1">Yes </label>
                     </div>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="tick">
                     <div class="custom-control custom-radio">
                        <input type="radio" id="halal_option_2" name="halal_option" class="custom-control-input" value="2" <?php if(!empty($row->halal_option)&&$row->halal_option==2){echo 'checked';} ?>>
                        <label class="custom-control-label" for="halal_option_2">No</label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
</div>
<div class="col-sm-12 ">
   <div class="resort-option">
      <div class="form-group">
         <label>Meal Plans Applicable </label>
         <div class="row">
            <?php 
            $din_meal_plans = array();
            if(!empty($row->meal_plans_applicable)){
               $din_meal_plans = explode(',', $row->meal_plans_applicable);
            }
            if(!empty($meal_plans)){
               foreach($meal_plans as $meal_plan){?>
                  <div class="col-sm-4 col-md-4">
                     <div class="tick">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox" value="<?php echo $meal_plan->id; ?>"
                           class="custom-control-input" name="meal_plans_applicables[]" id="meal_plan_type_<?php echo $meal_plan->id; ?>" <?php if(!empty($din_meal_plans)&&in_array($meal_plan->id, $din_meal_plans)) {echo 'checked';}?>>
                           <label class="custom-control-label" for="meal_plan_type_<?php echo $meal_plan->id; ?>">
                              <?php echo $meal_plan->meal_plans_name; ?>
                           </label>
                        </div>
                     </div>
                  </div>
               <?php 
               }
            }
            ?>
         </div>
      </div>
   </div>
</div>
<div class="col-sm-12 ">
   <div class="resort-option">
      <div class="form-group">
         <label>Dress Code</label>
         <div class="row">
            <?php 
            $din_dress_code = array();
            if(!empty($row->dress_code)){
               $din_dress_code = explode(',', $row->dress_code);
            }
            if(!empty($dress_codes)){
               foreach($dress_codes as $dress_code){?>
                  <div class="col-sm-6 col-md-6">
                     <div class="tick">
                        <div class="custom-control custom-checkbox">
                           <input type="checkbox"  class="custom-control-input" name="dress_codes[]" value="<?php echo $dress_code->id; ?>" id="dress_code_title_<?php echo $dress_code->id; ?>" <?php if(!empty($din_dress_code)&&in_array($dress_code->id, $din_dress_code)) {echo 'checked';}?>>
                           <label class="custom-control-label" for="dress_code_title_<?php echo $dress_code->id; ?>">
                              <?php echo $dress_code->dress_code_title; ?>
                           </label>
                        </div>
                     </div>
                  </div>
               <?php 
               }
            }
            ?>  
         </div>
      </div>
   </div>
</div><!-- 
<div class="col-sm-6">
   <div class="resort-option">
      <div class="form-group">
         <div class="upload-menu">
            <div class="form-group">
               <div class="file-upload" id="dinning_menu_main">
                  <div class="image-upload-wrap" <?php if(!empty($row->dinning_menu)){ echo 'style="display: none;"';} ?>>
                     <input class="file-upload-input" type="file" id="dinning_menu" onchange="dinning_menu_new();" accept="image/*">
                     <div class="drag-text">
                        <h3>
                           <img src="<?php echo  FRONT_THEAM_PATH ;?>img/menu-icon.png">
                           <div class="clearfix"></div>
                           Upload your menu
                           <div class="clearfix"></div>
                           <small>Just drop them here</small> 
                           <ul class="note-msg">
                             <li>                                
                                The menu should be <span>PNG</span>, <span>JPG</span>, <span> JPEG </span> and <span> PDF </span> file format
                             </li> 
                             <li>
                                Menu images need to be at least <span>100 x 100</span> pixels and maximum <span> 10,000 x 10,000</span> pixels
                             </li> 
                             <li>
                               Menu can be maximum <span>10 MB</span> size
                             </li>
                             <li>
                               Upload up to <span>10</span> images at a time
                             </li>
                           </ul>
                        </h3>
                     </div>
                  </div>
                  <div id="dinning_menu_img" <?php if(!empty($row->dinning_menu)){ echo 'style="display: block;"';} ?>>
                     <?php 
                     if(!empty($row->dinning_menu)){
                        $fileTypes  = explode('.', $row->dinning_menu);
                        $fileType   = strtolower(end($fileTypes));
                        $randT      = rand(000,999).time();
                        $deletImg   = "deleteDinningMenu('".$randT."','".$row->dinning_menu."')"; 
                        $html       = '<div id="'.$randT.'" class="file-upload-content"
                                       ';
                        if(!empty($row->dinning_menu)){ 
                           $html .= 'style="display: block;"';
                        } 
                        if($fileType=='pdf'){       
                           $html   .= '><iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->dinning_menu.'" alt="resort affiliation"></iframe>';
                        }else{
                           $html   .= '><img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$row->dinning_menu.'" alt="resort logo">';
                        }
                        $html .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button></div></div>';
                        echo $html;
                     }
                  ?>
                  </div>
                  <div id="dinning_menu_error"></div>
                  <input type="hidden" name="dinning_menu" id="dinning_menu_val">
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->